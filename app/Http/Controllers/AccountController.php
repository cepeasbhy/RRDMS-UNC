<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DbHelperController;
use App\Http\Controllers\CredentialController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{   
    public function index(DbHelperController $db){
    
        if(Auth::user()->account_role == 'student'){
            $userInfo = $db->getStudentInfo(Auth::user()->user_id);
            $picturePath = $userInfo['picturePath'];
            $columnName = 'document_loc';
        }else{
            $picturePath = $db->getStaffPicture(Auth::user()->user_id);
            $columnName = 'picture_path';
        }   
        
        return view('AccountViews/accountHome', [
            'picturePath' =>  $picturePath,
            'columnName' => $columnName
        ]);
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
}
