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

    public function viewRequest(DbHelperController $db, $requestID){
        $requestedDocument = $db->getRequesteeInfo($requestID);
        $student = $db->getStudentInfo($requestedDocument['studentInfo']->student_id);
        return view('RequestRecord/cic/view_request_details', [
            'student' => $student['studentInfo'],
            'credentials' => $student['credentials'],
            'picturePath' =>  $student['picturePath'],
            'requestID' => $requestID,
            'requestedDocumentDetails' => $requestedDocument['requestedDocumentDetails'],
            'requestInfo' => $requestedDocument['requestInfo'],
        ]);
    }

    public function studentRequestsLog(DbHelperController $db){

        $requestedDocuments = $db->getRequestedDocuments();
        return view('RequestRecord/cic/index', [
            'requestedDocuments' => $requestedDocuments,
        ]);
    }

    public function rejectRequest(Request $request, DbHelperController $db, $requestID){
        $db->rejectStudentRequest($request->input('denyReason'), $requestID);
        return redirect('/cic/request')->with('msgCred', 'Request Has Been Rejected.');
    }

    public function acceptRequest(Request $request, DbHelperController $db, $requestID){
        $db->acceptStudentRequest($requestID, $request->input('releaseDate'));
        return redirect('/cic/request')->with('msgCred', 'Request Has Been Accepted.');
    }

    public function completeRequest(DbHelperController $db, $requestID){
        $db->completeStudentRequest($requestID);
        return redirect('/cic/request')->with('msgCred', 'Request Has Been Completed.');
    }

}
