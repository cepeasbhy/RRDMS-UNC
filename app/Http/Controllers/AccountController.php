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
            'email' => ['required', 'email', 'max:255'],
            'phoneNumber' => ['required', 'string', 'max:11', 'min:11']
        ]);

        User::where('user_id', $id)->update([
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
            'password' => Hash::make($request->new_password),
            'change_pass_at' => now()
        ]);

        return back()->with('msg', 'Password Successfully Changed!');
    }

    public function changePassFirstTimeLogin(Request $request){
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8', 'max:255', 'string'],
        ]);

        if(Hash::check($request->password, Auth::user()->password)){
            return redirect()->route('stud.forceChangePass')->with('msg', 'You cannot use your old password');
        }

        User::where('user_id', Auth::user()->user_id)->update([
            'password' => Hash::make($request->password),
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
        )->where(
            'account_role', '!=', 'admin'
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

    public function getAccountInfo(DbHelperController $db, $role, $userID){
        if($role == 'student'){
            $studentInfo = $db->getStudentInfo($userID);
            
            return [
                'studentInfo' => $studentInfo['studentInfo'],
                'picturePath' =>  $studentInfo['picturePath'],
                'columnName' => 'document_loc'
            ];

        }else{
            $staff = $db->getStaffInfo($userID);
            $picturePath = $staff['staffPicture'];

            return [
                'staffInfo' => $staff['staffInfo'],
                'picturePath' =>  $picturePath,
                'columnName' => 'picture_path'
            ];
        }   
    }
}
