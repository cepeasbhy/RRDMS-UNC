<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DbHelperController;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{   
    public function index(DbHelperController $db){
    
        if(Auth::user()->account_role == 'student'){
            $studentInfo = $db->getStudentInfo(Auth::user()->user_id);
            
            return view('AccountViews/accountHome', [
                'studentInfo' => $studentInfo['studentInfo'],
                'picturePath' =>  $studentInfo['picturePath'],
                'columnName' => 'document_loc'
            ]);

        }else{
            $staff = $db->getStaffInfo(Auth::user()->user_id);
            $picturePath = $staff['staffPicture'];

            return view('AccountViews/accountHome', [
                'staffInfo' => $staff['staffInfo'],
                'picturePath' =>  $picturePath,
                'columnName' => 'picture_path'
            ]);
        }   
    }

    public function update(Request $request, $id){
        $request->validate([
            'address' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phoneNumber' => ['required', 'string', 'max:11', 'min:11']
        ]);

        User::where('user_id', $id)->update([
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phoneNumber')
        ]);

        return redirect('/account')->with('msg', 'Account Successfully Updated');
    }

    public function changePassword(Request $request){

        $request->validate([
            'old_password' => ['required', 'max:255', 'min:8', 'string', 'current_password'],
            'new_password' => ['required', 'confirmed', 'min:8','max:255', 'string', 'different:old_password']
        ]);

        User::where('user_id', Auth::user()->user_id)->update([
            'password' => Hash::make($request->input('new_password')),
            'change_pass_at' => now()
        ]);

        return back()->with('msg', 'Password Successfully Changed!');
    }

    public function finishAccountSetup(Request $request){
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'max:11', 'min:11'],
            'password' => ['required', 'confirmed', 'min:8', 'max:255', 'string'],
        ]);

        if(Hash::check($request->password, Auth::user()->password)){
            return redirect()->route('stud.firstSetup')->with('msg', 'You cannot use your old password');
        }

        User::where('user_id', Auth::user()->user_id)->update([
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phoneNumber'),
            'password' => Hash::make($request->input('password')),
            'change_pass_at' => now()
        ]);

        return redirect()->route('stud.request');
    }

    public function getStaffAccounts(){
        return Staff::select(
            'staff_id',
            'first_name',
            'last_name',
            'dept_name',
            'account_role'
        )->leftJoin(
            'users', 'users.user_id', '=', 'staff.staff_id'
        )->leftJoin(
            'departments', 'departments.department_id', '=', 'staff.assigned_dept'
        )->get();
    }


    public function getStudentAccounts(){
        return Student::select(
            'student_id',
            'first_name',
            'last_name',
            'dept_name',
            'course_name'
        )->leftJoin(
            'users', 'users.user_id', '=', 'students.student_id'
        )->leftJoin(
            'departments', 'departments.department_id', '=', 'students.department_id'
        )->leftJoin(
            'courses', 'courses.course_id', '=', 'students.course_id'
        )->get();
    }

    public function getAccountInfo($role, $userID){
        $db = new DbHelperController;

        if($role == 'student'){
            $studentInfo = $db->getStudentInfo($userID);
            
            return [
                'accountInfo' => $studentInfo['studentInfo'],
                'picturePath' =>  $studentInfo['picturePath']->document_loc,
            ];

        }else{
            $staff = $db->getStaffInfo($userID);
            $picturePath = $staff['staffPicture'];

            return [
                'accountInfo' => $staff['staffInfo'],
                'picturePath' =>  $picturePath->picture_path,
            ];
        }   
    }

    public function adminUpdateStaffAccount(Request $request, $userID){
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'middleName' => ['nullable', 'string', 'max:255'],
            'accountRole' => ['required', 'string', 'max:255'],
            'assignedDept' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phoneNumber' => ['required', 'string', 'max:11', 'min:11']
        ]);

        User::where('user_id', $userID)->update([
            'first_name' =>$request->input('firstName'),
            'middle_name' =>$request->input('middleName'),
            'last_name' =>$request->input('lastName'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phoneNumber'),
            'account_role' => $request->input('accountRole')
        ]);

        Staff::where('staff_id', $userID)->update([
            'assigned_dept' => $request->input('assignedDept')
        ]);

        return back()->with('msg', 'Account Successfully Updated');
    }

    public function admindeleteStaffAccount($userID){
        $db = new DbHelperController;
        $staffPicture = $db->getStaffPicture($userID);

        unlink(storage_path('app\public\\'.$staffPicture->picture_path));
        Staff::where('staff_id', $userID)->delete();
        User::where('user_id', $userID)->delete();

        return redirect()->route('admin.viewAccounts')->with('msg', 'Account Successfully Deleted');
    }

    public function updateAccountPicture(Request $request, $userID){
        $db = new DbHelperController;

        $staff = $db->getStaffPicture($userID);
        unlink(storage_path('app\public\\'.$staff->picture_path));

        $newPath = $request->file('picture')->storeAs(
            'staff',
            '['.$userID.'] Picture'.'.'.$request->file('picture')->getClientOriginalExtension(),
            'public'
        );

        Staff::where('staff_id', $userID)->update([
            'picture_path' => $newPath
        ]);

        return back()->with('msg', 'Account Picture Successfully Updated');
    }
}
