<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DbHelperController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(DbHelperController $db){

        if(Auth::user()->account_role == 'STUDENT'){
            $picturePath = $db->getStudentPicture(Auth::user()->user_id);
            $columName = 'document_loc';
        }else{
            $picturePath = $db->getStaffPicture(Auth::user()->user_id);
            $columName = 'picture_path';
        }   
        
        return view('AccountViews/accountHome', [
            'picturePath' => $picturePath,
            'columnName' => $columName
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
