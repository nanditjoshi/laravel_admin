<?php
/**
 * Created by PhpStorm.
 * User: Jiten Patel
 * Date: 4/12/2019
 * Time: 11:33 AM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;
use App\Helpers\Helpers;

class RoleController extends Controller {

    public function index() {
        return view('admin.roles.index');
    }

    public function create() {
        return view('admin.roles.form');
    }

    public function browse(Request $request){
        $query = Role::select('*');
        return Datatables::of($query)
            ->editColumn('id', function($query) {
                return '<input type="checkbox" name="row_id" id="checkbox_'.$query->id.'" value="'.$query->id.'">';
            })
            ->editColumn('action', function($query) {
                return Helpers::getGeneralActions($query, 'roles');
            })
            ->rawColumns(['action', 'id'])
            ->make(true);
    }

    public function store(Request $request){
        $data = $request->all();

        $validator = Role::validator($data);
        if($validator->fails()){
            return redirect()->to('admin/roles/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $role =  Role::create(['name' => $data['name']]);
            return redirect()->to('admin/roles')
                ->withSuccess('Role added Successfully!!');
        }
    }

    public function update(Request $request, $id){
        $data = $request->all();

        $validator = Role::validator($data);
        if($validator->fails()){
            return redirect()->to('admin/roles/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $role = Role::find($id);
            $role->update([
                'name' => $data['name']
            ]);
            return redirect()->to('admin/roles')
                ->withSuccess('Role updated Successfully!!');
        }
    }

    public function edit($id){
        $role = Role::find($id);
        if($role instanceof Role) {
            return view('admin.roles.form', ['role' => $role]);
        } else {
            return redirect()->to('admin/roles')
                ->withErrors('Record not found!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $role = Role::find($id);
        if($role instanceof Role) {
            $role->delete();
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
}