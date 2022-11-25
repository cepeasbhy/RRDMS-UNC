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

    public function index(DbHelperController $db){

        $studentRequests = $db->getRequestedDocuments();
        return view('RequestRecord/Student/index', [
            'studentRequests' => $studentRequests,
        ]);
    }

    public function viewStudentRequest(DbHelperController $db, $requestID){
        $studentRequest = $db->getRequesteeInfo($requestID);
        $student = $db->getStudentInfo($studentRequest['studentInfo']->student_id);
        return view('RequestRecord/cic/view_request_details', [
            'student' => $student['studentInfo'],
            'credentials' => $student['credentials'],
            'picturePath' =>  $student['picturePath'],
            'requestID' => $requestID,
            'requestedDocumentDetails' => $studentRequest['requestedDocumentDetails'],
            'requestInfo' => $studentRequest['requestInfo'],
        ]);
    }

    public function cancelRequest(DbHelperController $db, $requestID){
        $db->cancelStudentRequest($requestID);
        return redirect('/request')->with('msgCred', 'Request Has Been Deleted.');
    }

    public function makeRequest(DbHelperController $db){
        $recordPrices = $db->getRecordPrices();
        $student = $db->getStudentInfo(Auth::user()->user_id);

        return view('RequestRecord/Student/request', [
            'student' => $student['studentInfo'],
            'picturePath' =>$student['picturePath'],
            'recordPrices' => $recordPrices
        ]);
    }

    public function submitRequest(Request $request, DbHelperController $db){
        $db->insertRequest($request, Auth::user()->user_id);
        return redirect('/request')->with('msgCred', 'Request Has Been Submitted.');
    }

    public function studAccountSetup(){
        if(!is_null(Auth::user()->change_pass_at)){
            return redirect()->route('stud.request');
        }

        return view('RequestRecord/Student/change_stud_pass');
    }
}
