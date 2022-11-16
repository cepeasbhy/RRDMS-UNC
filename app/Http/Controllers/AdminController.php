<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DbHelperController;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(DbHelperController $db){
        $deptCount = $db->getCountDepartment();
        return view('admin/admin_home', ['deptCount' => $deptCount]);
    }
}
