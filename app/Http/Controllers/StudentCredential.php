<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentCredential extends Controller
{
    public function index(){
        return view('StudentCredential/index');
    }
}
