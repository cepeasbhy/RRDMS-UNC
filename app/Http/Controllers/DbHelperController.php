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
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class DbHelperController extends Controller
{
    public function getDeptRecords($deptID){
        $deptName = Department::select('dept_name')->where('department_id', $deptID)->firstOrFail();

        $deptRecords = Student::select(
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
        )->where('students.department_id', $deptID)->get();


        return([
            'deptName' => $deptName,
            'deptRecords' => $deptRecords
        ]);
    }

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
            return $students->where('departments.department_id', $staff['staffInfo']->assigned_dept)->get();
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
                        'archives.department_id', $staff['staffInfo']->assigned_dept
                    )->where('available_status', 1)->get();
        }
    }

    public function getStaffInfo($staffID){
        $staffInfo = Staff::select(
            'staff_id',
            'assigned_dept',
            'first_name',
            'last_name',
            'middle_name',
            'email',
            'phone_number',
            'assigned_dept',
            'dept_name',
            'account_role'
        )->leftJoin(
            'users', 'users.user_id', '=', 'staff.staff_id'
        )->leftJoin(
            'departments', 'department_id', '=', 'staff.assigned_dept'
        )->where('user_id', $staffID)->firstOrFail();

        $staffPicture = $this->getStaffPicture($staffID);

        return[
            'staffInfo' => $staffInfo,
            'staffPicture' => $staffPicture
        ];
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
                'address',
                'phone_number',
                'email',
                'status',
                'account_role',
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
                'address',
                'phone_number',
                'status',
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

    public function getCountDepartment(){
        $asCount = Student::where('department_id', '001')->count();
        $cbaCount = Student::where('department_id', '002')->count();
        $csCount = Student::where('department_id', '003')->count();
        $cjeCount = Student::where('department_id', '004')->count();
        $educCount = Student::where('department_id', '005')->count();
        $eaCount = Student::where('department_id', '006')->count();
        $nursingCount = Student::where('department_id', '007')->count();
        $gradCount = Student::where('department_id', '008')->count();
        $lawCount = Student::where('department_id', '009')->count();

        return([
            'asCount' => $asCount,
            'cbaCount' => $cbaCount,
            'csCount' => $csCount,
            'cjeCount' => $cjeCount,
            'educCount' => $educCount,
            'eaCount' =>  $eaCount,
            'nursingCount' => $nursingCount,
            'gradCount' => $gradCount,
            'lawCount' => $lawCount
        ]);
    }

    public function getStaffPicture($staffID){
        return Staff::select('picture_path')->where(
            'staff_id', $staffID,
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
            'status' => ['required', 'integer', 'min:0','max:2'],
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
            'status' => $request->input('status')
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

        $certFees = 0;
        $copyOfGradeFees = 0;
        $torFees = 0;

        $diplomaFees = Self::computeDiplomaFees($request);
        $authenticationFees = Self::computeAuthenticationFees($request);
        $photocopyFees = Self::computePhotocopyFees($request);

        if($request->input('certificate') != null){
            $certificates = $this -> createJsonCertificate($request);
            foreach ($request->input('numCopies') as $certs => $quantity){
                if($quantity > 0){
                    $certFees += (int)$quantity * 110;
                }
            }
        }

        if($request->input('reqCopyGrade') != null){
            $copyGrades = $request->input('copyGrades');
            foreach ($request->input('copyGrades') as $grades => $copies){
                if($grades == "copies" && $copies > 0){
                    $copyOfGradeFees += (int)$copies * 110;
                }
            }
        }

        if($request->input('reqTOR') != null){
            $tor = $request->input('tor');
            foreach ($request->input('tor') as $torRequest => $copies){
                if($torRequest == "copies" && $copies > 0){
                    $torFees += (int)$copies * 110;
                }
            }
        }

        $studentDeptCourse = Student::select(
            'department_id',
            'course_id'
        )->where('student_id', $studentID)->first();

        ModelsRequest::create([
            'request_id' => $requestID,
            'student_id' => $studentID,
            'course_id' => $studentDeptCourse->course_id,
            'department_id' => $studentDeptCourse->department_id
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
            'total_fee' => ($certFees + $copyOfGradeFees + $torFees + $diplomaFees + $authenticationFees + $photocopyFees)
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

    public function deleteRequestedArchive($requestID){
        $archive = $this->getRequestedArchiveInfo($requestID);

        RequestedArchive::select()->where('request_id', $archive['requestInfo']->request_id)->delete();

        Archive::where('archive_id', $archive['requestedArchived']->archive_id)->update([
            'available_status' => 1
        ]);
    }

    public function accpetRequestedArchive($requestID){
        RequestedArchive::where('request_id', $requestID)->update(['status' => 1]);
    }

    public function getRequestedArchives(){
            if(Auth::user()->account_role != 'cic'){
                return RequestedArchive::all();
            }else{
                return RequestedArchive::where('staff_id', Auth::user()->user_id)->get();
            }
    }

    public function getRequestedArchiveInfo($id){
        $requestInfo = RequestedArchive::where('request_id', $id)->firstOrFail();
        $requestedArchived = Archive::where('archive_id', $requestInfo->archive_id)->firstOrFail();

        return [
            'requestInfo' => $requestInfo,
            'requestedArchived' => $requestedArchived
        ];
    }

    public function returnToArchive($id){
        $archive = $this->getRequestedArchiveInfo($id);

        Archive::where('archive_id', $archive['requestedArchived']->archive_id)->update([
            'available_status' => 1
        ]);

        RequestedArchive::where('request_id', $id)->delete();
    }

    public function getRequestedDocuments(){

        return ModelsRequest::select(
            'request_id',
            'requests.student_id',
            'first_name',
            'last_name',
            'course_name',
            'release_date',
            'requests.status'
        )->leftJoin(
            'users', 'users.user_id', '=', 'requests.student_id'
        )->leftJoin(
            'courses', 'courses.course_id', '=', 'requests.course_id'
        )->leftJoin(
            'students', 'students.student_id', '=', 'requests.student_id'
        )->get();

    }

    public function getRequesteeInfo($id){
        $requestInfo = ModelsRequest::select('student_id', 'request_id', 'status')->where('request_id', $id)->firstOrFail();
        $studentInfo = Student::where('student_id', $requestInfo->student_id)->firstOrFail();

        $requestedDocumentDetails = RequestedDocument::where('request_id', $requestInfo->request_id)->firstOrFail();

        return [
            'requestInfo' => $requestInfo,
            'studentInfo' => $studentInfo,
            'requestedDocumentDetails' => $requestedDocumentDetails
        ];
    }

    public function rejectStudentRequest($denialReason ,$requestID){
        ModelsRequest::where('request_id', $requestID)->update([
            'status' => 'DENIED',
            'reason_for_rejection' => $denialReason
        ]);
    }

    public function acceptStudentRequest($requestID, $releaseDate){
        ModelsRequest::where('request_id', $requestID)->update([
            'status' => 'SET FOR RELEASE',
            'release_date' => $releaseDate
        ]);
    }

    public function completeStudentRequest($requestID){
        ModelsRequest::where('request_id', $requestID)->update([
            'status' => 'COMPLETED',
        ]);
    }

    public function computeDiplomaFees($request){
        $totalDiplomaFees = 0;
        if($request->input('diploma') != null){
            foreach($request->input('diploma') as $diploma){
                if($diploma == 'Bachelor/Law Degree'){
                    $totalDiplomaFees += 516;
                }
                if($diploma == 'Masteral Degree'){
                    $totalDiplomaFees += 729;
                }
                if($diploma == 'TESDA'){
                    $totalDiplomaFees += 302;
                }
                if($diploma == 'Caregiving'){
                    $totalDiplomaFees += 250;
                }
            }
        }

        return $totalDiplomaFees;
    }

    public function computeAuthenticationFees($request){
        $authFees = 0;
        if($request->input('authentication') != null){
            foreach($request->input('authentication') as $auth){
                if($auth == 'Transcript of Record'){
                    $authFees += 89.50;
                }
                if($auth == 'Diploma'){
                    $authFees += 89.50;
                }
                if($auth == 'Certificate'){
                    $authFees += 89.50;
                }
            }
        }

        return $authFees;
    }

    public function computePhotocopyFees($request){
        $photocopyFees = 0;
        $photocopyCount = 0;
        if($request->input('photocopy') != null){
            foreach($request->input('photocopy') as $photocopy){
                if($photocopy == 'Transcript of Record'){
                    $photocopyCount += 1;
                }
                if($photocopy == 'Diploma'){
                    $photocopyCount += 1;
                }
                if($photocopy == 'Certificate'){
                    $photocopyCount += 1;
                }

                if($photocopy == 'ordinary'){
                    $photocopyFees = $photocopyCount * 1.20;
                }
                else if($photocopy == 'colored'){
                    $photocopyFees = $photocopyCount * 20;
                }
            }
        }

        return $photocopyFees;
    }

}
