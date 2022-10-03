<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentCredential extends Controller
{
    public function index(){
        return view('StudentCredential/index');
    }

    public function create(){
        return view('StudentCredential/add_stud');
    }
}
