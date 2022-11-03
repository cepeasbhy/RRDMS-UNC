<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\DbHelperController;
use App\Models\Student;
use Illuminate\Support\Facades\Log;

class ArchivedRecordsController extends Controller
{
    public function index(DbHelperController $db)
    {
        $students = $db->getStudents(1);
        return view('ArchivedRecords.index', ['students' => $students]);
    }

    public function getCredentials(DbHelperController $db)
    {
        $students = $db->getStudents(0);
        return view('ArchivedRecords.unarchived_credential',  ['students' => $students]);
    }

    public function viewRecord(DbHelperController $db, $id)
    {

        $student = $db->getStudentInfo($id);
        $picturePath = $db->getStudentPicture($id);
        $credentials = $db->getStudentCredenials($id);


        $fromIndexPage = Student::select('archive_status')->where('student_id', $id)->firstOrFail();

        if (substr($fromIndexPage, -2, 1) == 0) {
            return view('ArchivedRecords.view_record', [
                'student' => $student,
                'credentials' => $credentials,
                'picturePath' =>  $picturePath
            ]);
        }

        return view('ArchivedRecords.view_archived_record', [
            'student' => $student,
            'credentials' => $credentials,
            'picturePath' =>  $picturePath
        ]);
    }

    public function deleteRecord(DbHelperController $db, $studID)
    {
        $db->deleteStudent($studID, true);
        return redirect('/archived_records')->with('msgCred', 'Record Successfully Removed');
    }

    public function updateRecord($id, Request $request, DbHelperController $db)
    {
        $db->updateStudent($request, $id);
        return redirect('/archived_records/view_record/' . $id)->with('msg', 'Record Successfully Updated');
    }

    public function archiveSingleRecord(DbHelperController $db, $id)
    {
        $db->singleArchive($id);
        return redirect('/archived_records')->with('msg', 'Record Successfully Archived');
    }

    public function addSingleRec(DbHelperController $db, Request $request){
        $db->saveFile($request, $request->keyName, $request->fileName);

        return redirect('/archived_records/view_record/'.$request->student_id)->header('Cache-Control',
        'no-store, no-cache, must-revalidate')->with('msgCred', 'Credential Successfully Added');
    }

    public function updateCredential(DbHelperController $db, Request $request, $studID, $docID)
    {
        $db->updateCredential($request, $studID, $docID);
        return redirect('/archived_records/view_record/' . $studID)->header(
            'Cache-Control',
            'no-store, no-cache, must-revalidate'
        )->with('msgCred', 'Credential Successfully Updated');
    }

    public function deleteCredential(DbHelperController $db, $studID, $docID)
    {
        $db->deleteCredential($docID);

        return redirect('/archived_records/view_record/' . $studID)->with('msgCred', 'Credential Successfully Removed');
    }
}