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
use App\Models\RecordPrice;
use App\Models\log;
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
            'dept_name',
            'account_role',
            'activated_status'
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
                'archive_status',
                'account_role',
                'activated_status',
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
                'archive_status',
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

        $description = "Added new student to the database with a student ID of ".$request->input('student_id');
        $this->createLog($description);
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

        $description = "Updated student information with a student ID of ".$id;
        $this->createLog($description);
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

        $description = "Disposed student record with a student ID of ".$studentID;
        $this->createLog($description);
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

        $description = "Archived student with a student ID of ".$studentID;
        $this->createLog($description);

    }

    public function getRecordPrices(){
        $bachelorLawDegreePrice = RecordPrice::select('price')->where('description', 'Bachelor/Law Degree')->firstOrFail();
        $masteralDegreePrice = RecordPrice::select('price')->where('description', 'Masteral Degree')->firstOrFail();
        $tesdaDegreePrice = RecordPrice::select('price')->where('description', 'TESDA')->firstOrFail();
        $caregivingDegreePrice = RecordPrice::select('price')->where('description', 'Caregiving')->firstOrFail();
        $torPrice = RecordPrice::select('price')->where('description', 'Transcript of Record')->firstOrFail();
        $copyGradePrice = RecordPrice::select('price')->where('description', 'Copy of Grades')->firstOrFail();
        $certPrice = RecordPrice::select('price')->where('description', 'Certificate')->firstOrFail();
        $authPrice = RecordPrice::select('price')->where('description', 'Authentication')->firstOrFail();
        $photoOrdinaryPrice = RecordPrice::select('price')->where('description', 'Photocopy (Ordinary)')->firstOrFail();
        $photoColoredPrice = RecordPrice::select('price')->where('description', 'Photocopy (Colored)')->firstOrFail();

        return([
            'bachelorLawDegreePrice' => $bachelorLawDegreePrice->price,
            'masteralDegreePrice' => $masteralDegreePrice->price,
            'tesdaDegreePrice' => $tesdaDegreePrice->price,
            'caregivingDegreePrice' => $caregivingDegreePrice->price,
            'torPrice' => $torPrice->price,
            'copyGradePrice' => $copyGradePrice->price,
            'certPrice' => $certPrice->price,
            'authPrice' => $authPrice->price,
            'photoOrdinaryPrice' => $photoOrdinaryPrice->price,
            'photoColoredPrice' => $photoColoredPrice->price
        ]);
    }


    public function updatePrices(Request $request){

        $descriptions = [
            'Bachelor/Law Degree' => 'bachelorLawDegreePrice',
            'Masteral Degree' => 'masteralDegreePrice',
            'TESDA' => 'tesdaPrice',
            'Caregiving' => 'caregivingPrice', 
            'Transcript of Record' => 'torPrice',
            'Copy of Grades' => 'copyGradePrice',
            'Certificate' => 'certPrice',
            'Authentication' => 'authPrice',
            'Photocopy (Ordinary)' => 'photoOrdindaryPrice',
            'Photocopy (Colored)' => 'photoColoredPrice'

        ];

        foreach($descriptions as $description => $inputName){
            RecordPrice::where('description', $description
            )->update(['price' => $request->input($inputName)]);
    
        }
    }

    public function insertRequest($request, $studentID){
        $recordPrices = Self::getRecordPrices();
        $certificates = null;
        $copyGrades = null;
        $tor = null;
        $requestID = 'REQ'.'-'.date("Y")."_".random_int(0, 1000)+random_int(0, 1000);

        $certFees = 0;
        $copyOfGradeFees = 0;
        $torFees = 0;
        $diplomaFees = Self::computeDiplomaFees($request, $recordPrices);

        $totalCertCopies = 0;
        $totalDiplomaCopies = $request->input('diploma') ? count($request->input('diploma')):null;
        $totalTorCopies = 0;

        if($request->input('certificate') != null){
            $certificates = $this -> createJsonCertificate($request);
            foreach($certificates as $certificate){
                foreach($certificate as $certName => $copies){
                    $certFees += $copies*$recordPrices['certPrice'];
                    $totalCertCopies += $copies;
                }
            }

            $json = array('TOTAL PRICE' => $certFees);
            array_push($certificates, $json);
        }

        if($request->input('reqCopyGrade') != null){
            $copyGrades = $request->input('copyGrades');
            $copyOfGradeFees = $copyGrades['copies']*$recordPrices['copyGradePrice'];

            $json = array('price' => $copyOfGradeFees);
            array_push($copyGrades, $json);
        }

        if($request->input('reqTOR') != null){
            $tor = $request->input('tor');
            $torFees = $tor['copies']*$recordPrices['torPrice'];
            $totalTorCopies = $tor['copies'];

            $json = array('price' => $torFees);
            array_push($tor, $json);
        }

        $diplomas = $this->createJsonDilpoma($request, $recordPrices);
        $authentication = $this->createJsonAuth($request, $recordPrices, $totalCertCopies, $totalDiplomaCopies, $totalTorCopies);
        $photocopy = $this->createJsonPhotoCopy($request, $recordPrices, $totalCertCopies, $totalDiplomaCopies, $totalTorCopies);

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
            'diploma' => $diplomas,
            'transcript_of_record' => $tor,
            'certificate' => $certificates,
            'authentication' => $authentication['jsonAuth'],
            'photocopy' => $photocopy['jsonPhotoCopy'],
            'copy_of_grades' =>$copyGrades,
            'total_fee' => ($certFees + $copyOfGradeFees + $torFees + $diplomaFees + $authentication['authFees'] + $photocopy['photoCopyFees'])
        ]);

    }

    public function createJsonPhotoCopy(Request $request, $recordPrices, $totalCertCopies, $totalDiplomaCopies, $totalTorCopies){
        $jsonPhotoCopy = [];
        $photoCopies = $this->checkNull($request, 'photocopy');
        $photocopyFees = 0;
        $basePrice = 0;

        if($photoCopies != null){
            if($photoCopies['photocopyType'] == "colored"){
                $basePrice = $recordPrices['photoColoredPrice'];
            }else{
                $basePrice = $recordPrices['photoOrdinaryPrice'];
            }

            foreach($photoCopies as $photoCopy){
                if($photoCopy == 'Transcript of Record'){
                    $photocopyFees += $basePrice*$totalTorCopies;
                    $json = array('description' => $photoCopy,
                                  'value' => $basePrice*$totalTorCopies
                                 );
                    array_push($jsonPhotoCopy, $json);
                }
                
                if($photoCopy == 'Diploma'){
                    $photocopyFees += $basePrice*$totalDiplomaCopies;
                    $json = array('description' => $photoCopy, 
                                  'value' => $basePrice*$totalDiplomaCopies
                                 );
                    array_push($jsonPhotoCopy, $json);
                }
    
                if($photoCopy == 'Certificate'){
                    $photocopyFees += $basePrice*$totalCertCopies;
                    $json = array('description' => $photoCopy,
                                  'value' => $basePrice*$totalCertCopies
                                 );
                    array_push($jsonPhotoCopy, $json);
                }
            }

            $json = array('description' => 'Photocopy Type', 'value' => $photoCopies['photocopyType']);
            array_push($jsonPhotoCopy, $json);

            $json = array('description' => 'TOTAL PRICE', 'value' => $photocopyFees);
            array_push($jsonPhotoCopy, $json);

            return['jsonPhotoCopy' => $jsonPhotoCopy, 'photoCopyFees' => $photocopyFees];

        }

        return['jsonPhotoCopy' => null, 'photoCopyFees' => 0];
    }

    public function createJsonAuth(Request $request, $recordPrices, $totalCertCopies, $totalDiplomaCopies, $totalTorCopies){
        $jsonAuth = [];
        $authentications = $this->checkNull($request, 'authentication');
        $authFees = 0;

        if($authentications != null){
            foreach($authentications as $authentication){
                if($authentication == 'Transcript of Record'){
                    $authFees += $recordPrices['authPrice']*$totalTorCopies;
                    $json = array('description' => $authentication,
                                  'price' => $recordPrices['authPrice']*$totalTorCopies
                                 );
                    array_push($jsonAuth, $json);
                }
                
                if($authentication == 'Diploma'){
                    $authFees += $recordPrices['authPrice']*$totalDiplomaCopies;
                    $json = array('description' => $authentication, 
                                  'price' => $recordPrices['authPrice']*$totalDiplomaCopies
                                 );
                    array_push($jsonAuth, $json);
                }
    
                if($authentication == 'Certificate'){
                    $authFees += $recordPrices['authPrice']*$totalCertCopies;
                    $json = array('description' => $authentication,
                                  'price' => $recordPrices['authPrice']*$totalCertCopies
                                 );
                    array_push($jsonAuth, $json);
                }
            }

            $json = array('description' => 'TOTAL PRICE', 'price' => $authFees);
            array_push($jsonAuth, $json);

            return ['jsonAuth' => $jsonAuth, 'authFees' => $authFees];
        }

        return ['jsonAuth' => null, 'authFees' => $authFees];
    }

    public function createJsonDilpoma(Request $request, $recordPrices,){

        $jsonDiploma = [];
        $diplomas = $this->checkNull($request, 'diploma');
        $totalPrice = 0;

        if($diplomas != null){
            foreach($diplomas as $diploma){
                if($diploma == 'Bachelor/Law Degree'){
                    $totalPrice += $recordPrices['bachelorLawDegreePrice'];
                    $json = array('description' => $diploma, 
                                  'price' => $recordPrices['bachelorLawDegreePrice']
                                 );
                    array_push($jsonDiploma, $json);
                }
                
                if($diploma == 'Masteral Degree'){
                    $totalPrice += $recordPrices['masteralDegreePrice'];
                    $json = array('description' => $diploma, 
                                  'price' => $recordPrices['masteralDegreePrice']
                                 );
                    array_push($jsonDiploma, $json);
                }
    
                if($diploma == 'TESDA'){
                    $totalPrice += $recordPrices['tesdaDegreePrice'];
                    $json = array('description' => $diploma, 
                                  'price' => $recordPrices['tesdaDegreePrice']
                                 );
                    array_push($jsonDiploma, $json);
                }
    
                if($diploma == 'Caregiving'){
                    $totalPrice += $recordPrices['caregivingDegreePrice'];
                    $json = array('description' => $diploma, 
                                  'price' => $recordPrices['caregivingDegreePrice']
                                 );
                    array_push($jsonDiploma, $json);
                }
            }

            $json = array('description' => 'TOTAL PRICE', 'price' => $totalPrice);
            array_push($jsonDiploma, $json);

            return $jsonDiploma;
        }

        return null;
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

        $description = "Requested an archived with an ID of ".$id;
        $this->createLog($description);

    }

    public function deleteRequestedArchive($requestID){
        $archive = $this->getRequestedArchiveInfo($requestID);

        RequestedArchive::select()->where('request_id', $archive['requestInfo']->request_id)->delete();

        Archive::where('archive_id', $archive['requestedArchived']->archive_id)->update([
            'available_status' => 1
        ]);

        $description = "Cancelled request for an archived record with an ID of ".$archive['requestedArchived']->archive_id;
        $this->createLog($description);
    }

    public function rejectRequestedArchive($requestID, Request $request){
        RequestedArchive::where('request_id', $requestID)->update([
            'reason_for_rejection' => $request->input('reason'),
            'status' => 2
        ]);

        $description = "Rejected request for an archived with a request ID of ".$requestID;
        
        $this->createLog($description);
    }

    public function accpetRequestedArchive($requestID){
        RequestedArchive::where('request_id', $requestID)->update(['status' => 1]);

        $description = "Granted request for an archived with a request ID of ".$requestID;
        $this->createLog($description);
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

        $description = "Returned the record to archive with an archive ID of ".$archive['requestedArchived']->archive_id;
        $this->createLog($description);
    }

    public function getRequestedDocuments(){

        $requestedDocument = ModelsRequest::select(
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
        );

        if(Auth::user()->account_role == 'student'){
            return $requestedDocument->where('requests.student_id', Auth::user()->user_id)->get();
        }else{
            $staff = $this->getStaffInfo(Auth::user()->user_id);
            return $requestedDocument->where('requests.department_id', $staff['staffInfo']->assigned_dept)->get();
        }
    }

    public function getRequesteeInfo($id){
        $requestInfo = ModelsRequest::where('request_id', $id)->firstOrFail();
        $studentInfo = Student::where('student_id', $requestInfo->student_id)->firstOrFail();

        $requestedDocumentDetails = RequestedDocument::where('request_id', $requestInfo->request_id)->firstOrFail();

        return [
            'requestInfo' => $requestInfo,
            'studentInfo' => $studentInfo,
            'requestedDocumentDetails' => $requestedDocumentDetails,
        ];
    }

    public function rejectStudentRequest($denialReason ,$requestID){
        ModelsRequest::where('request_id', $requestID)->update([
            'status' => 'DENIED',
            'reason_for_rejection' => $denialReason
        ]);

        $description = "Rejected student request with a request ID of ".$requestID;
        $this->createLog($description);
    }

    public function acceptStudentRequest($requestID, $releaseDate){
        ModelsRequest::where('request_id', $requestID)->update([
            'status' => 'SET FOR RELEASE',
            'release_date' => $releaseDate
        ]);

        $description = "Sets released date for request with a request ID of ".$requestID;
        $this->createLog($description);
    }

    public function completeStudentRequest($requestID){
        ModelsRequest::where('request_id', $requestID)->update([
            'status' => 'COMPLETED',
        ]);

        $description = "Completed student's request with a request ID of ".$requestID;
        $this->createLog($description);
    }

    public function cancelStudentRequest($requestID){
        RequestedDocument::where('request_id', $requestID)->delete();
        ModelsRequest::where('request_id', $requestID)->delete();
    }

    public function computeDiplomaFees($request, $recordPrices){
        $totalDiplomaFees = 0;
        if($request->input('diploma') != null){
            foreach($request->input('diploma') as $diploma){
                if($diploma == 'Bachelor/Law Degree'){
                    $totalDiplomaFees += $recordPrices['bachelorLawDegreePrice'];
                }
                if($diploma == 'Masteral Degree'){
                    $totalDiplomaFees += $recordPrices['masteralDegreePrice'];
                }
                if($diploma == 'TESDA'){
                    $totalDiplomaFees += $recordPrices['tesdaDegreePrice'];
                }
                if($diploma == 'Caregiving'){
                    $totalDiplomaFees += $recordPrices['caregivingDegreePrice'];
                }
            }
        }

        return $totalDiplomaFees;
    }

    public function setAccountActiveStatus($userID, $activeStatus){
        User::where('user_id', $userID)->update(['activated_status' => $activeStatus]);
    }

    public function createLog($description){

        $logID = 'LOG'.'_'.date("Y")."_".random_int(0, 1000)+random_int(0, 1000);
        log::create([
            'log_id' => $logID,
            'staff_id' => Auth::user()->user_id,
            'description' => $description
        ]);
    }
}
