<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DbHelperController;
use Illuminate\Support\Facades\Auth;

class StudCredController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(DbHelperController $db){
        $students = $db->getStudents(0);
        return view('StudentCredential/index', ['students' => $students]);
    }

    public function addStudent(DbHelperController $db){
        $staff = $db->getStaffInfo(Auth::user()->user_id);
        return view('StudentCredential/add_stud',['staff' => $staff]);
    }

    public function create(Request $request, DbHelperController $db){
        $db->insertStudent($request);
        $db->uploadStudentCredentials($request);

        return redirect('/stud_cred_mngmnt')->with('msg', 'Student Successfully Added');
    }
 
    public function viewStudent(DbHelperController $db, $id){
        
        $student = $db->getStudentInfo($id);
        $picturePath = $db->getStudentPicture($id);
        $credentials = $db->getStudentCredenials($id);
        $staff = $db->getStaffInfo(Auth::user()->user_id);
        
        return view('StudentCredential/view_stud', [
            'student' => $student,
            'credentials' => $credentials,
            'picturePath' =>  $picturePath,
            'staff' => $staff
        ]);
    }

    public function update($id, Request $request, DbHelperController $db){
        $db->updateStudent($request, $id);
        return redirect('/stud_cred_mngmnt/view_student/'.$id)->with('msg', 'Student Information Successfully Updated');
    }

    public function destroy(DbHelperController $db, $id){
        $db->deleteStudent($id, false);
        return redirect('/stud_cred_mngmnt')->with('msg', 'Student successfully removed from the record');
    }

    public function deleteCred(DbHelperController $db, $studID, $docID){
        $db->deleteCredential($docID);

        return redirect('/stud_cred_mngmnt/view_student/'.$studID)->with('msgCred', 'Credential Successfully Removed');
    }

    public function updateCred(DbHelperController $db, Request $request, $studID, $docID){
        $db->updateCredential($request, $studID, $docID);
        return redirect('/stud_cred_mngmnt/view_student/'.$studID)->header('Cache-Control',
        'no-store, no-cache, must-revalidate')->with('msgCred', 'Credential Successfully Updated');
    }

    public function addSingleRec(DbHelperController $db, Request $request){
        $db->saveFile($request, $request->keyName, $request->fileName);

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

    public function viewRequestedArchive(DbHelperController $db, $id){
        $requestedArchive = $db->getRequestedArchiveInfo($id);
        $student = $db->getStudentInfo($requestedArchive->student_id);
        $picturePath = $db->getStudentPicture($requestedArchive->student_id);
        $credentials = $db->getStudentCredenials($requestedArchive->student_id);
        return view('StudentCredential/view_requested_archive', [
            'student' => $student,
            'credentials' => $credentials,
            'picturePath' =>  $picturePath,
        ]);
    }

}
