<?php
/**
 * Created by PhpStorm.
 * User: Jiten Patel
 * Date: 4/12/2019
 * Time: 11:33 AM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Helpers\Helpers;
use Illuminate\Validation\Rule;

class CompanyController extends Controller {

    public function index() {
        return view('admin.companies.index');
    }

    public function browse(Request $request){
        $query = Company::select('*');
        return Datatables::of($query)
            ->editColumn('id', function($query) {
                return '<input type="checkbox" name="row_id" id="checkbox_'.$query->id.'" value="'.$query->id.'">';
            })
            ->editColumn('action', function($query) {
                return Helpers::getGeneralActions($query, 'companies');
            })
            ->rawColumns(['action', 'id'])
            ->make(true);
    }

    public function create() {
        $companies = Company::all();
        $data = ['companies' => $companies];
        return view('admin.companies.form')->with($data);
    }

    public function store(Request $request){
        $data = $request->all();

        if(Auth::user()->role->id != User::SUPER_ADMIN){
            $data['company_id'] = Auth::user()->company->id;
        }

        DB::beginTransaction();

        if(Company::validator($data)->validate()){
            $company =  Company::create($data);
            if ($company instanceof Company) {
                $data['company_id'] = $company->id;
                $companyProfile =  CompanyProfile::create($data);
                if($companyProfile instanceof CompanyProfile){
                    $user =  User::create([
                        'first_name' => $data['name'],
                        'email' => $data['email'],
                        'role_id' => User::COMPANY_ADMIN,
                        'company_id' => $data['company_id'],
                    ]);
                    $password = User::generatePassword();
                    $user->password = Hash::make($password);

                    if($user->save()){
                        DB::commit();
                        Mail::to($user->email)->send(new WelcomeMail($user, $password));
                    } else {
                        DB::rollBack();
                    }
                } else {
                    DB::rollBack();
                }
            } else {
                DB::rollBack();
            }
            $users = User::all();
            return view('admin.companies.index', ['users' => $users]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $company = Company::find($id);

        if($company instanceof Company) {
            $company->delete();
            $response = [
                'success' => false,
                'data' => 'Record Deleted successfully!!'
            ];
        } else {
            $response = [
                'success' => false,
                'data' => 'Record not found!!'
            ];
        }
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // get the company
        $company = Company::find($id);
        $companyProfile = CompanyProfile::where('company_id', '=', $id)->first();
        $user = $report = User::where('company_id', '=', $id)
            ->where('role_id', '=', User::COMPANY_ADMIN)->first();

        return view('admin.companies.edit')->with(
            [
                'company' => $company,
                'companyProfile' => $companyProfile,
                'user' => $user
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $data = Input::all();

        $rules = array(
            'name' => [
                'required',
                'max:255',
                Rule::unique('companies')->ignore($id),
            ],
            'type' => 'required|in:' . implode(',', array(Company::COMPANY_ORGANIZATION,Company::COMPANY_CHARITY)),
            'email' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if(!$validator->fails()){
            // store
            $company = Company::find($id);
            $company->name       = Input::get('name');
            $company->type       = Input::get('type');
            $company->save();

            $companyProfile = CompanyProfile::where('company_id', '=', $id)->first();
            $companyProfile->website = Input::get('website');
            $companyProfile->phone = Input::get('phone');
            $companyProfile->description = Input::get('description');
            $companyProfile->save();

            $users = User::all();
            return view('admin.companies.index', ['users' => $users]);
        } else {
            return redirect()->to('admin/companies/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(Input::all());
        }
    }
}