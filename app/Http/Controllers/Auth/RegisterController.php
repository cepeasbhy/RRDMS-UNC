<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*public function __construct()
    {
        $this->middleware(['role:admin', 'auth']);
    }*/
    
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_id' => ['required', 'string', 'max:255', 'unique:users'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'account_role' => ['required', 'string', 'max:255'],
            'assigned_dept' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:11'],
            'email' => ['required', 'email', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $picturePath = $this->saveStaffPicture($data['picture'], $data['user_id']);

        Staff::create([
            'staff_id' => $data['user_id'],
            'assigned_dept' => $data['assigned_dept'],
            'picture_path' => $picturePath
        ]);

        User::create([
            'user_id' => $data['user_id'],
            'account_role' => $data['account_role'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'middle_name' => $data['middle_name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'password' => Hash::make('welcometounc'),
        ]);
    }

    public function saveStaffPicture($picture, $userID){

        return $docPath = $picture->storeAs(
            'staff',
            '['.$userID.'] Picture'.'.'.$picture->getClientOriginalExtension(),
            'public'
        );
    }

    
}
