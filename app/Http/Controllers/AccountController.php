<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DbHelperController;
use App\Http\Controllers\CredentialController;
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
            'old_password' => ['required', 'max:255', 'string', 'current_password'],
            'new_password' => ['required', 'confirmed', 'min:8','max:255', 'string', 'different:old_password']
        ]);

        User::where('user_id', Auth::user()->user_id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('msg', 'Password Successfully Changed!');
    }
}
