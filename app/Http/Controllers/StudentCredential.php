<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentCredential extends Controller
{
    public function index(){
        return view('StudentCredential/index');
    }

    public function addStudent(){
        return view('StudentCredential/add_stud');
    }

    public function create(){
        $student = new Student();

        $student->student_id = request('studentID');
        $student->first_name = request('firstName');
        $student->last_name = request('lastName');
        $student->middle_name = request('middleName');
        $student->department_id = request('department');
        $student->course_id = request('course');
        $student->admission_year = request('addmissionYear');

        $student->save();

        return redirect('/stud_cred_mngmnt');
    }
}
