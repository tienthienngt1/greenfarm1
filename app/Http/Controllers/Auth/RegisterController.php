<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Auth\MoreRegisterController;
use Illuminate\Http\Request;
use App\Models\User;
use Session;

class RegisterController extends Controller
{
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

    use RegistersUsers, MoreRegisterController;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $mess = [
            'name.regex' => ' Họ và tên chỉ được chứa chữ cái và khoảng trắng',
            'name.max' => ' Họ và tên không được quá 50 kí tự',
            'password.min' => 'Mật khẩu phải ít nhất 6 kí tự',
            'password.confirmed' => 'Mật khẩu không trùng nhau',
            'email.unique' => 'Email này đã tồn tại',
            'email.max' => 'Email không được quá 50 kí tự',
        ];
        return Validator::make($data, [
            'name' => ['bail', 'required', 'max:255', 'regex:/^[a-zA-Z\s]*$/'],
            'email' => ['bail', 'required', 'email', 'max:50', 'unique:users'],
            'password' => ['bail', 'required', 'string', 'min:6', 'confirmed'],
        ], $mess);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data,)
    {
          //check refferal;
          $this->checkRefferal($data);
        $user = User::create([
            'image' => 'personal' . rand(1, 10) . '.png',
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Create more
        $this->createMore($user);

	Session::flash('success','Đăng kí thành công!');
        return $user;
    }
}
