<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Request as ModelsRequest;
use App\Models\RequestedArchive;
use App\Models\RequestedDocument;
use App\Models\Staff;
use App\Models\User;
use App\Http\Controllers\CredentialController;

use Illuminate\Support\Facades\Auth;

class DbHelperController extends Controller
{
    public function getUnarchivedRecords(){

        $students = Student::select(
            'student_id',
            'first_name',
            'last_name',
            'dept_name',
            'course_name',
            'admission_year',
        )->leftJoin(
            'departments', 'departments.department_id', '=', 'students.department_id'
        )->leftJoin(
            'courses', 'courses.course_id', '=', 'students.course_id'
        )->leftJoin(
            'users', 'users.user_id', '=', 'students.student_id'
        )->where('archive_status', 0);

        if(Auth::user()->account_role != 'cic'){
            return $students->get();
        }else{
            $staff = $this->getStaffInfo(Auth::user()->user_id);
            return $students->where('departments.department_id', $staff->assigned_dept)->get();
        }
    }

    public function getArchives(){
        
        $archivedRecords = Archive::select(
            'archive_id',
            'archives.student_id',
            'first_name',
            'last_name',
            'dept_name',
            'course_name',
        )->leftJoin(
            'departments', 'departments.department_id', '=', 'archives.department_id'
        )->leftJoin(
            'courses', 'courses.course_id', '=', 'archives.course_id'
        )->leftJoin(
            'users', 'users.user_id', '=', 'archives.student_id'
        );

        if(Auth::user()->account_role != 'cic'){
            return $archivedRecords->get();
        }else{
            $staff = $this->getStaffInfo(Auth::user()->user_id);
            return $archivedRecords->where(
                        'archives.department_id', $staff->assigned_dept
                    )->where('available_status', 1)->get();
        }
    }

    public function getStaffInfo($userID){
        return Staff::select(
            'staff_id',
            'assigned_dept',
            'first_name',
            'last_name',
            'middle_name',
            'email',
            'phone_number',
            'assigned_dept'
        )->leftJoin(
            'users', 'users.user_id', '=', 'staff.staff_id'
        )->where('user_id', $userID)->firstOrFail();
    }

    public function getStudentInfo($studentID){
        $credentialController = new CredentialController;

        $credentials = $credentialController->getStudentCredenials($studentID);
        $stduentPicture = $credentialController->getStudentPicture($studentID);

        $studentInfo = Student::select(
                'student_id',
                'first_name',
                'last_name',
                'middle_name',
                'dept_name',
                'course_name',
                'email',
                'admission_year',
                'students.created_at',
                'students.updated_at'
            )->leftJoin(
                'departments', 'departments.department_id', '=', 'students.department_id'
            )->leftJoin(
                'courses', 'courses.course_id', '=', 'students.course_id'
            )->leftJoin(
                'users', 'users.user_id', '=', 'students.student_id'
            )->where('student_id', $studentID)->firstOrFail();

        return[
            'studentInfo' => $studentInfo,
            'picturePath' => $stduentPicture,
            'credentials' => $credentials
        ];
    }

    public function getArchivedStudentInfo($studentID){
        $credentialController = new CredentialController;

        $credentials = $credentialController->getStudentCredenials($studentID);
        $stduentPicture = $credentialController->getStudentPicture($studentID);

        $studentInfo = Archive::select(
                'archive_id',
                'archives.student_id',
                'first_name',
                'last_name',
                'middle_name',
                'dept_name',
                'course_name',
                'email',
                'admission_year',
                'archives.created_at AS date_archived',
                'students.created_at AS date_filed',
                'archives.updated_at'
            )->leftJoin(
                'students', 'students.student_id', '=', 'archives.student_id'
            )->leftJoin(
                'departments', 'departments.department_id', '=', 'archives.department_id'
            )->leftJoin(
                'courses', 'courses.course_id', '=', 'archives.course_id'
            )->leftJoin(
                'users', 'users.user_id', '=', 'archives.student_id'
            )->where('archives.student_id', $studentID)->firstOrFail();

        return[
            'studentInfo' => $studentInfo,
            'picturePath' => $stduentPicture,
            'credentials' => $credentials
        ];
    }

    public function getStaffPicture($id){
        return Staff::select('picture_path')->where(
            'staff_id', $id,
            )->firstOrFail();
    }

    public function insertStudent(Request $request){
        $request -> validate([
            'student_id' => ['required', 'string', 'unique:students'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'admission_year' => ['required', 'integer', 'min:1948'],
            'course_id' => ['required', 'string', 'max:255'],
            'department_id' => ['required', 'string', 'max:255'],
        ]);

        Student::create([
            'student_id' => $request->input('student_id'),
            'admission_year' => $request->input('admission_year'),
            'course_id' => $request->input('course_id'),
            'department_id' => $request->input('department_id')
        ]);

        User::create([
            'user_id' => $request->input('student_id'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'middle_name' => $request->input('middle_name'),
            'account_role' => 'student',
            'email' => $request->input('email'),
        ]);

        $credController = new CredentialController;
        $credController->uploadStudentCredentials($request);
    }

    public function updateStudent(Request $request, $id, $isFromArchive){
        $request -> validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'admission_year' => ['required', 'integer', 'min:1948'],
            'course_id' => ['required', 'string', 'max:255'],
            'department_id' => ['required', 'string', 'max:255'],
        ]);

        User::where('user_id', $id)->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' =>$request->input('email'),
            'middle_name' => $request->input('middle_name'),
        ]);

        Student::where('student_id', $id)->update([
            'department_id' => $request->input('department_id'),
            'course_id' => $request->input('course_id'),
            'admission_year' => $request->input('admission_year'),
        ]);

        if($isFromArchive){
            Archive::where('student_id', $id)->update([
                'department_id' => $request->input('department_id'),
                'course_id' => $request->input('course_id'),
            ]);
        }
    }

    public function deleteStudent($studentID, $isFromArchive){

        if($isFromArchive){
            $archive = Archive::select('archive_id')->where('student_id', $studentID)->first();

            if($archive != null){
                RequestedArchive::where('archive_id', $archive->archive_id)->delete();
            }

            Archive::where('student_id', $studentID)->delete();
        }

        $credController = new CredentialController;

        $credController->deleteAllStudCreds($studentID);
        Student::where('student_id', $studentID)->delete();
        User::where('user_id', $studentID)->delete();
    }

    public function singleArchive($studentID){

        $archiveID = 'ARCHIVE'.'-'.date("Y")."_".random_int(0, 1000)+random_int(0, 1000);
        $studentDeptCourse = Student::select(
            'department_id',
            'course_id'
        )->where('student_id', $studentID)->first();

        Student::where('student_id', $studentID)->update([
            'archive_status' => 1
        ]);

        Archive::create([
            'student_id' => $studentID,
            'archive_id' => $archiveID,
            'department_id' => $studentDeptCourse->department_id,
            'course_id' => $studentDeptCourse->course_id,
        ]);

        $credController = new CredentialController;
        $credController->archiveCredentials($studentID);

    }

    public function insertRequest($request, $studentID){
        $certificates = null;
        $copyGrades = null;
        $tor = null;
        $diploma = $this->checkNull($request, 'diploma');
        $authentication = $this->checkNull($request, 'authentication');
        $photocopy = $this->checkNull($request, 'photocopy');
        $requestID = 'REQ'.'-'.date("Y")."_".random_int(0, 1000)+random_int(0, 1000);

        if($request->input('certificate') != null){
            $certificates = $this -> createJsonCertificate($request);
        }

        if($request->input('reqCopyGrade') != null){
            $copyGrades = $request->input('copyGrades');
        }

        if($request->input('reqTOR') != null){
            $tor = $request->input('tor');
        }

        ModelsRequest::create([
            'request_id' => $requestID,
            'student_id' => $studentID,
        ]);

        RequestedDocument::create([
            'student_id' => $studentID,
            'request_id' => $requestID,
            'diploma' => $diploma,
            'transcript_of_record' => $tor,
            'certificate' => $certificates,
            'authentication' => $authentication,
            'photocopy' => $photocopy,
            'copy_of_grades' =>$copyGrades,
            'total_fee' => 0 //This is just for a test
        ]);
    }

    public function checkNull(Request $request, $keyName){
        if($request->input($keyName) == null){
            return null;
        }else{
            return $request->input($keyName);
        }
    }

    public function createJsonCertificate(Request $request){
        $certificates = $request->input('certificate');
        $numCopies = array_filter($request->input('numCopies'));

        $jsonCertificates = [];
    
        foreach($certificates as $certificate){
            $json = array($certificate => $numCopies[$certificate]);
            array_push($jsonCertificates, $json );
        }

        return $jsonCertificates;
    }

    public function submitArchiveRequest($id){
        
        $requestID = 'REQ'.'-'.random_int(0, 1000)+random_int(0, 1000);

        RequestedArchive::create([
            'request_id' => $requestID,
            'archive_id' => $id,
            'staff_id' => Auth::user()->user_id
        ]);
        
        Archive::where('archive_id', $id)->update([
            'available_status' => 0
        ]);
    }

    public function getRequestedArchives(){
            if(Auth::user()->account_role != 'cic'){
                return RequestedArchive::all();
            }else{
                return RequestedArchive::where('staff_id', Auth::user()->user_id)->get();
            }
    }

    public function getRequestedArchiveInfo($id){
        $requestedArchived = RequestedArchive::select('archive_id')->where('request_id', $id)->firstOrFail();
        return Archive::where('archive_id', $requestedArchived->archive_id)->firstOrFail();
    }

    public function returnToArchive($id){
        $archive = $this->getRequestedArchiveInfo($id);

        Archive::where('archive_id', $archive->archive_id)->update([
            'available_status' => 1
        ]);

        RequestedArchive::where('request_id', $id)->delete();
    }

}
