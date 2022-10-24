<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\DbHelperController;

class ArchivedRecordsController extends Controller
{
    public function index(DbHelperController $db){
        $students = $db->getStudents(1);
        return view('ArchivedRecords.index', ['students' => $students]);
    }

    public function getCredentials(DbHelperController $db){
        $students = $db->getStudents(0);
        return view('ArchivedRecords.unarchived_credential',  ['students' => $students]);
    }

    public function viewRecord(DbHelperController $db, $id){

        $student = $db->getStudentInfo($id);
        $picturePath = $db->getStudentPicture($id);
        $credentials = $db->getStudentCredenials($id);

        return view('ArchivedRecords.view_record', [
            'student' => $student,
            'credentials' => $credentials,
            'picturePath' =>  $picturePath
        ]);
    }

}
