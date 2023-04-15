<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DbHelperController;
use App\Http\Controllers\CredentialController;
use Illuminate\Support\Facades\Auth;

class StudCredController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(DbHelperController $db){
        $students = $db->getUnarchivedRecords();
        return view('StudentCredential/index', ['students' => $students]);
    }

    public function addStudent(DbHelperController $db){
        $staff = $db->getStaffInfo(Auth::user()->user_id);
        return view('StudentCredential/add_stud',['staff' => $staff['staffInfo']]);
    }

    public function create(Request $request, DbHelperController $db){
        $db->insertStudent($request);
        return redirect('/stud_cred_mngmnt')->with('msg', 'Student Successfully Added');
    }
 
    public function viewStudent(DbHelperController $db, $id){
        
        $student = $db->getStudentInfo($id);
        $staff = $db->getStaffInfo(Auth::user()->user_id);
        
        return view('StudentCredential/view_stud', [
            'student' => $student['studentInfo'],
            'credentials' => $student['credentials'],
            'picturePath' =>  $student['picturePath'],
            'staff' => $staff['staffInfo']
        ]);
    }

    public function update($id, Request $request, DbHelperController $db){
        $db->updateStudent($request, $id, false);
        return redirect('/stud_cred_mngmnt/view_student/'.$id)->with('msg', 'Student Information Successfully Updated');
    }

    public function destroy(DbHelperController $db, $id){
        $db->deleteStudent($id, false);
        return redirect('/stud_cred_mngmnt')->with('msg', 'Student successfully removed from the record');
    }

    public function deleteCred(CredentialController $credController, $studID, $docID){
        $credController->deleteCredential($docID);
        return redirect('/stud_cred_mngmnt/view_student/'.$studID)->with('msgCred', 'Credential Successfully Removed');
    }

    public function updateCred(CredentialController $credController, Request $request, $studID, $docID){
        $credController->updateCredential($request, $studID, $docID);
        return redirect('/stud_cred_mngmnt/view_student/'.$studID)->header('Cache-Control',
        'no-store, no-cache, must-revalidate')->with('msgCred', 'Credential Successfully Updated');
    }

    public function addSingleRec(DbHelperController $db, CredentialController $credController, Request $request){
        $credController->saveCredential($request, $request->keyName, $request->fileName);
        
        $description = "Added a new credential named ".$request->fileName." for student with an ID of ".$request->student_id;
        $db->createLog($description);

        return redirect('/stud_cred_mngmnt/view_student/'.$request->student_id)->header('Cache-Control',
        'no-store, no-cache, must-revalidate')->with('msgCred', 'Credential Successfully Added');
    }

    public function requestArchive(DbHelperController $db){
        $requestedArchives = $db->getRequestedArchives();
        $archives = $db->getArchives();
        return view('StudentCredential/request_archives', [
            'archives' => $archives,
            'requestedArchives' => $requestedArchives
        ]);
    }

    public function makeRequestArchive(DbHelperController $db, $id){
        $db->submitArchiveRequest($id);
        return redirect('/stud_cred_mngmnt/request_archive')->with('msg', 'Successfully Submitted Request');
    }

    public function viewRequestDetails(DbHelperController $db, $requestID){
        $requestedArchive = $db->getRequestedArchiveInfo($requestID);
        $student = $db->getArchivedStudentInfo($requestedArchive['requestedArchived']->student_id);
        $staff = $db->getStaffInfo($requestedArchive['requestInfo']->staff_id);

        return view('StudentCredential.view_request_details', [
            'requestInfo' => $requestedArchive['requestInfo'],
            'staff' => $staff['staffInfo'],
            'student' => $student['studentInfo'],
            'picturePath' =>  $student['picturePath'],
            'staffPicture' =>  $staff['staffPicture']
        ]);
    }

    public function cancelRequestedArchive(DbHelperController $db, $requestID){
        $db->deleteRequestedArchive($requestID);
        return redirect('/stud_cred_mngmnt/request_archive')->with('msg', 'Request has been cancelled');
    }

    public function viewRequestedArchive(DbHelperController $db, $requestID){
        $requestedArchive = $db->getRequestedArchiveInfo($requestID);
        $student = $db->getArchivedStudentInfo($requestedArchive['requestedArchived']->student_id);

        return view('StudentCredential/view_requested_archive', [
            'student' => $student['studentInfo'],
            'credentials' => $student['credentials'],
            'picturePath' =>  $student['picturePath'],
            'requestID' => $requestID
        ]);
    }

    public function returnToArchive(DbHelperController $db, $id){
        $db->returnToArchive($id);
        return redirect('/stud_cred_mngmnt/request_archive')->with('msg', 'Archive Successfully Returned');
    }

}
