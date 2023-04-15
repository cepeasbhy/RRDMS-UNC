<?php

namespace App\Http\Controllers;

use App\Exports\ExportStudList;
use App\Models\Department;
use App\Http\Controllers\DbHelperController;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(DbHelperController $db){
        $deptCount = $db->getCountDepartment();
        $recordPrices = $db->getRecordPrices();
        
        return view('admin/admin_home', [
            'deptCount' => $deptCount,
            'recordPrices' => $recordPrices
        ]);
    }

    public function viewDepartment(DbHelperController $db, $deptID){
        $deptRecords = $db->getDeptRecords($deptID);

        return view('admin/view_department', [
            'deptID' => $deptID,
            'deptName' => $deptRecords['deptName'],
            'deptRecords' => $deptRecords['deptRecords']
        ]);
    }

    public function viewStudent(DbHelperController $db, $deptID, $studentID){
        
        $student = $db->getStudentInfo($studentID);
        
        return view('admin/view_stud', [
            'deptID' => $deptID,
            'student' => $student['studentInfo'],
            'credentials' => $student['credentials'],
            'picturePath' =>  $student['picturePath'],
        ]);
    }

    public function viewAccounts(AccountController $account){
        $staffAccounts = $account->getStaffAccounts();
        $studentAccounts = $account->getStudentAccounts();

        return view('admin/account_mngmnt', [
            'staffAccounts' => $staffAccounts,
            'studentAccounts' => $studentAccounts
        ]);
    }

    public function viewAccountInfo(DbHelperController $db, AccountController $account, $role, $userID){
        $accountInfo = $account->getAccountInfo($role, $userID);
        $transacLogs = $db->getTransacLogs($userID);

        return view('/admin/view_account', [
            'accountInfo' => $accountInfo,
            'transacLogs' => $transacLogs
        ]);
    }

    public function exportGradList(DbHelperController $db, Request $request){
        $fileName = $this->getFileName($request->input('department_id'), 'GRADUATES_LIST');
        $department = Department::select('dept_name')->where('department_id', $request->input('department_id'))->firstOrFail();;

        $description = "Exported list of grudates for the ".$department->dept_name;
        $db->createLog($description);

        if(is_null($request->input('department_id')) && is_null($request->input('admissionYear')) &&
        is_null($request->input('admissionYear'))){
            return redirect()->route('admin.home')->with('errorMsg', 'No data provided for exporting');
        }else{
            return Excel::download(new ExportStudList(
                isGraduated: true,
                isEpoxrtAll: false,
                request: $request
            ), $fileName);
        }
    }

    public function exportAllGraduates(DbHelperController $db, Request $request){
        $description = "Exported a master list of graduates";
        $db->createLog($description);

        return Excel::download(new ExportStudList(
            isGraduated: true,
            isEpoxrtAll: true,
            request: $request
        ), 'GRADUATES-MASTER-LIST.xlsx');
    }

    public function exportStudList(DbHelperController $db, Request $request){
        $fileName = $this->getFileName($request->input('department_id'), 'STUDENT_LIST');

        $department = Department::select('dept_name')->where('department_id', $request->input('department_id'))->firstOrFail();

        $description = "Exported list of students for the ".$department->dept_name;
        $db->createLog($description);

        if(is_null($request->input('department_id')) && is_null($request->input('admissionYear')) &&
        is_null($request->input('admissionYear'))){
            return redirect()->route('admin.home')->with('errorMsg', 'No data provided for exporting');
        }else{
            return Excel::download(new ExportStudList(
                isGraduated: false,
                isEpoxrtAll: false,
                request: $request
            ), $fileName);
        }
    }

    public function exportAllStudents(DbHelperController $db,Request $request){

        $description = "Exported a master list of students";
        $db->createLog($description);

        return Excel::download(new ExportStudList(
            isGraduated: false,
            isEpoxrtAll: true,
            request: $request
        ), 'STUDENTS-MASTER-LIST.xlsx');
    }

    public function getFileName($department_id, $partName){
        switch($department_id){
            case '001':
                return $partName.'[Arts and Science].xlsx';
            case '002':
                return $partName.'[Business and Accountancy].xlsx';
            case '003':
                return $partName.'[Computer Studies].xlsx';
            case '004':
                return $partName.'[Criminal Justice Education].xlsx';
             case'005':
                return $partName.'[Education]';
            case '006':
                return $partName.'[Engineering and Architecture].xlsx';
            case '007':
                return $partName.'[Nursing].xlsx';
            case '008':
                return $partName.'[Graduate Studies].xlsx';
            case '009':
                return $partName.'[School of Law].xlsx';
            default:
                return $partName.'.xlsx';
        }
    }

    public function updatePrices(Request $request, DbHelperController $db){
        $db->updatePrices($request);

        $description = "Updated record prices";
        $db->createLog($description);

        return redirect()->route('admin.home')->with('successMsg', 'Prices Successfully Updated');
    }
}
