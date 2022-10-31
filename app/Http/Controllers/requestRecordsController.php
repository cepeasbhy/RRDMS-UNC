<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DbHelperController;
use Illuminate\Support\Facades\Auth;

class requestRecordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('RequestRecord/index');
    }

    public function makeRequest(DbHelperController $db){
        $student = $db->getStudentInfo(Auth::user()->user_id);
        $picturePath = $db->getStudentPicture(Auth::user()->user_id);
        
        return view('RequestRecord/request', [
            'student' => $student,
            'picturePath' => $picturePath
        ]);
    }

    public function submitRequest(Request $request, DbHelperController $db){
        $db->insertRequest($request, Auth::user()->user_id);
    }
}
