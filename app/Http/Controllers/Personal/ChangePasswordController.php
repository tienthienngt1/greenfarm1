<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Session, DB;

class ChangePasswordController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index() {
    return view('personal.changePassword');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request) {
    if(\Auth::attempt(['password' => $request -> passwordold, 'email' => \Auth::user()->email]))
    {
      //validate password new
      $this->validator($request->all())->validate();
      //update password
      DB::table('users')->where('id',\Auth::user()->id)->update([
        'password' => Hash::make($request->password),
      ]);
      //return notification
      Session::flash('success','Mật khẩu đã được thay đổi!');
      return back();
    }else{
        Session::flash('error','Mật khẩu cũ không chính xác');
        return back();
    }
  }

  public function validator(array $data)
    {
        $mess = [
            'password.min' => 'Mật khẩu phải ít nhất 6 kí tự',
            'password.confirmed' => 'Mật khẩu không trùng nhau',
        ];
        return Validator::make($data, [
            'password' => ['bail', 'required', 'string', 'min:6', 'confirmed'],
        ], $mess);
    }
}