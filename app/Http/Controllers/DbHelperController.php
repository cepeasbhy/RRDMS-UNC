<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Credential;
use App\Models\Request as ModelsRequest;
use App\Models\RequestedArchive;
use App\Models\RequestedDocument;
use App\Models\Staff;
use App\Models\User;
use App\Models\ReuquestedArchive;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class DbHelperController extends Controller
{
    public function getStudents($archiveStatus){
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
        )->where('archive_status', $archiveStatus);

        if(Auth::user()->account_role != 'CIC'){
            return $students->get();
        }else{
            $staff = $this->getStaffInfo(Auth::user()->user_id);
            return $students->where('departments.department_id', $staff->assigned_dept)->get();
        }
    }

    public function getArchives(){
        $staff = $this->getStaffInfo(Auth::user()->user_id);

        return Archive::select(
            'archive_id',
            'archives.student_id',
            'department_id',
            'first_name',
            'last_name'
        )->leftJoin(
            'students', 'students.student_id', '=', 'archives.student_id'
        )->leftJoin(
            'users', 'users.user_id', '=', 'archives.student_id'
        )->where(
            'department_id', $staff->assigned_dept
        )->where('available_status', 1)->get();
    }

    public function getStaffInfo($id){
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
        )->where('user_id', $id)->firstOrFail();
    }

    public function getStudentInfo($id){
        return Student::select(
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
        )->where('student_id', $id)->firstOrFail();
    }

    public function getStudentPicture($id){
        return Credential::select('document_id','document_loc')->where(
            'student_id', $id,
            )->where(
            'document_name', 'Picture'
            )->firstOrFail();
    }

    public function getStaffPicture($id){
        return Staff::select('picture_path')->where(
            'staff_id', $id,
            )->firstOrFail();
    }

    public function getStudentCredenials($id){
        return Credential::select(
            'document_id',
            'document_name',
            'input_name',
            'document_loc'
        )->where(
            'student_id', $id,
        )->get();
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
            'account_role' => 'STUDENT',
            'email' => $request->input('email'),
        ]);
    }

    public function uploadStudentCredentials(Request $request){
        if($request->hasFile('picture')){$this->saveFile($request, 'picture', 'Picture');}
        if($request->hasFile('birthCertificate')){$this->saveFile($request, 'birthCertificate', 'Birth Certificate');}
        if($request->hasFile('marriageCertificate')){$this->saveFile($request, 'marriageCertificate', 'Marriage Certificate');}
        if($request->hasFile('goodMoralCharacter')){$this->saveFile($request, 'goodMoralCharacter', 'Certificate of Good Moral Character');}
        if($request->hasFile('honorDismisal')){$this->saveFile($request, 'honorDismisal', 'Honorable Dismisal');}
        if($request->hasFile('form137')){$this->saveFile($request, 'form137', 'Form 137');}
        if($request->hasFile('form138')){$this->saveFile($request, 'form138', 'Form 138');}
        if($request->hasFile('copyGrade')){$this->saveFile($request, 'copyGrade', 'Copy of Grades');}
        if($request->hasFile('tor')){$this->saveFile($request, 'tor', 'Transcript of Record');}
        if($request->hasFile('NbiClearance')){$this->saveFile($request, 'NbiClearance', 'NBI Clearance');}
        if($request->hasFile('PoliceClearance')){$this->saveFile($request, 'PoliceClearance', 'Police Clearance');}
        if($request->hasFile('C1')){$this->saveFile($request, 'C1', 'C1 Receipt');}
        if($request->hasFile('permitCrossEnroll')){$this->saveFile($request, 'permitCrossEnroll', 'Permit to Cross Enroll');}
    }

    public function saveFile($request, $keyName, $fileName){

        $folderPath = '';

        if($keyName == 'picture'){
            $folderPath = 'Picture';
        }else{
            $folderPath = $request->student_id;
        }

        $docPath = $request->file($keyName)->storeAs(
            $folderPath,
            '['.$request->student_id.'] '.$fileName.'.'.$request->file($keyName)->getClientOriginalExtension(),
            'public'
        );

        $id = 'DOC'.'-'.date("Y")."_".random_int(0, 1000)+random_int(0, 1000);

        Credential::create([
            'document_id' => $id,
            'student_id' => $request->input('student_id'),
            'input_name' => $keyName,
            'document_name' => $fileName,
            'document_loc' => $docPath
        ]);

    }

    public function updateStudent(Request $request, $id){
        $request -> validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable','required', 'string', 'max:255'],
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
    }

    public function deleteStudent($id, $isFromArchive){

        /*$picturePath = $this->getStudentPicture($id);
        File::deleteDirectory(storage_path('app\public\\'.$id));
        unlink(storage_path('app\public\\'.$picturePath->document_loc));*/

        if($isFromArchive){
            $archive = Archive::select('archive_id')->where('student_id', $id)->first();

            if($archive != null){
                RequestedArchive::where('archive_id', $archive->archive_id)->delete();
            }

            Archive::where('student_id', $id)->delete();
        }

        Credential::where('student_id', $id)->delete();
        Student::where('student_id', $id)->delete();
        User::where('user_id', $id)->delete();
    }

    public function deleteCredential($id){

       $credential = Credential::select(
            'document_loc'
        )->where('document_id', $id)->firstOrFail();

        unlink(storage_path('app\public\\'.$credential->document_loc));

        Credential::where('document_id', $id)->delete();
    }

    public function updateCredential($request, $studID, $docID){

        $credential = Credential::where('document_id', $docID)->firstOrFail();

        if($credential->input_name == 'picture'){
            $folderPath = 'Picture';
        }else{
            $folderPath = $studID;
        }

        $request->file($credential->input_name)->storeAs(
            $folderPath,
            '['.$studID.'] '.$credential->document_name.'.'.$request->file($credential->input_name)->getClientOriginalExtension(),
            'public'
        );

        Credential::where('document_id', $docID)->touch();
    }

    public function singleArchive($id){

        $archiveID = 'ARCHIVE'.'-'.date("Y")."_".random_int(0, 1000)+random_int(0, 1000);

        Student::where('student_id', $id)->update([
            'archive_status' => 1
        ]);

        Archive::create([
            'student_id' => $id,
            'archive_id' => $archiveID
        ]);

        $unnecessaryCredentials = Credential::select(
            'document_loc'
            )->where('student_id', $id)->whereNotIn('document_name',[
                'Birth Certificate',
                'Form 137',
                'Transcript of Record',
                'Form 9',
                'Picture'])->get();

        foreach($unnecessaryCredentials as $creds){
            unlink(storage_path('app\public\\'.$creds->document_loc));
        }

        Credential::where('student_id', $id)->whereNotIn('document_name',
        ['Birth Certificate', 'Picture', 'Form 137', 'Form 9', 'Transcript of Record'])->delete();

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
            if(Auth::user()->account_role != 'CIC'){
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
