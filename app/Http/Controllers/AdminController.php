<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DbHelperController;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(DbHelperController $db){
        $deptCount = $db->getCountDepartment();
        return view('admin/admin_home', ['deptCount' => $deptCount]);
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

    public function viewAccountInfo(AccountController $account, $role, $userID){
        $accountInfo = $account->getAccountInfo($role, $userID);
        return view('/admin/view_account', ['accountInfo' => $accountInfo]);
    }

    public function exportGradList(){
        return view('maintenance');
    }

    public function exportAllGraduates(){
        return view('maintenance');
    }

    public function exportStudList(){
        return view('maintenance');
    }

    public function exportAllStudents(){
        return view('maintainance');
    }
}
