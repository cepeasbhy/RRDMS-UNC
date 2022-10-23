<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DbHelperController;

class StudCredController extends Controller
{
    public function index(DbHelperController $db){
        $students = $db->getStudents(0);
        return view('StudentCredential/index', ['students' => $students]);
    }

    public function addStudent(){
        return view('StudentCredential/add_stud');
    }

    public function create(Request $request, DbHelperController $db){
        $db->insertStudent($request);
        $db->uploadStudentCredentials($request);

        return redirect('/stud_cred_mngmnt')->with('msg', 'Student Successfully Added');
    }
 
    public function viewStudent(DbHelperController $db, $id){
        
        $student = $db->getStudentInfo($id);
        $picturePath = $db->getStudentPicturePath($id);
        $credentials = $db->getStudentCredenials($id);
        
        return view('StudentCredential/view_stud', [
            'student' => $student,
            'credentials' => $credentials,
            'picturePath' =>  $picturePath
        ]);
    }

    public function update($id, Request $request, DbHelperController $db){
        $db->updateStudent($request, $id);
        return redirect('/stud_cred_mngmnt/view_student/'.$id)->with('msg', 'Student Information Successfully Updated');
    }

    public function destroy(DbHelperController $db, $id){
        $db->deleteStudent($id);
        return redirect('/stud_cred_mngmnt')->with('msg', 'Student successfully removed from the record');
    }

}