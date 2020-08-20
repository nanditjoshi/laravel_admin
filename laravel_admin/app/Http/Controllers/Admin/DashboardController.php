<?php
/**
 * Created by PhpStorm.
 * User: Jiten Patel
 * Date: 4/12/2019
 * Time: 11:33 AM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {

    public function getIndex() {
        return view('admin.home');
    }
}