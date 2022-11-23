<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CicReqRecordManagmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('RequestRecord/cic/index');
    }

    public function studentRequestsLog(DbHelperController $db){

        //TO BE FIXED
        $requestedDocuments = $db->getRequestedDocuments();
        $studentID;
        foreach($requestedDocuments as $obj){
            $studentID = $obj->student_id;
        }
        $studentInfo = $db->getStudentInfo($studentID);
        return view('RequestRecord/cic/index', [
            'requestedDocuments' => $requestedDocuments,
            'studentInfo' => $studentInfo
        ]);
    }
}
