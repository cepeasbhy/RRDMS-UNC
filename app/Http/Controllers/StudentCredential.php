<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentCredential extends Controller
{
    public function index(){
        $students = Student::select(
            'student_id',
            'first_name',
            'last_name',
            'dept_name',
            'course_name',
        )->join(
            'departments', 'departments.department_id', '=', 'students.department_id'
        )->join(
            'courses', 'courses.course_id', '=', 'students.course_id'
        )->get();

        return view('StudentCredential/index', ['students' => $students]);
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

    public function search(){
        return view('StudentCredential/view_stud', ['student' => $this->findStudent(request('studentID'))]);
    }

    public function sort(){
        $students = Student::select(
            'student_id',
            'first_name',
            'last_name',
            'dept_name',
            'course_name',
        )->join(
            'departments', 'departments.department_id', '=', 'students.department_id'
        )->join(
            'courses', 'courses.course_id', '=', 'students.course_id'
        )->orderBy(request('sort'), 'ASC')->get();

        return view('StudentCredential/index', ['students' => $students]);
    }

    public function viewStudent($id){
        return view('StudentCredential/view_stud', ['student' => $this->findStudent($id)]);
    }

    private function findStudent($id){
        return  $student = Student::select(
            'student_id',
            'first_name',
            'last_name',
            'middle_name',
            'dept_name',
            'course_name',
            'admission_year'
        )->join(
            'departments', 'departments.department_id', '=', 'students.department_id'
        )->join(
            'courses', 'courses.course_id', '=', 'students.course_id'
        )->where('student_id', $id)->firstOrFail();
    }

}
