<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DbHelperController;
use Illuminate\Support\Facades\Auth;

class StudRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if(is_null(Auth::user()->change_pass_at)){
            return redirect()->route('stud.forceChangePass');
        }
        return view('RequestRecord/Student/index');
    }

    public function makeRequest(DbHelperController $db){

        if(is_null(Auth::user()->change_pass_at)){
            return redirect()->route('stud.forceChangePass');
        }

        $student = $db->getStudentInfo(Auth::user()->user_id);
        
        return view('RequestRecord/Student/request', [
            'student' => $student['studentInfo'],
            'picturePath' =>$student['picturePath']
        ]);
    }

    public function submitRequest(Request $request, DbHelperController $db){
        $db->insertRequest($request, Auth::user()->user_id);
    }

    public function forceChangePass(){
        if(!is_null(Auth::user()->change_pass_at)){
            return redirect()->route('stud.request');
        }
        
        return view('RequestRecord/Student/change_stud_pass');
    }
}
