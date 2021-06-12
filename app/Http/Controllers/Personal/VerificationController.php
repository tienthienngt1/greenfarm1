<?php

namespace App\Http\Controllers\Personal;

use App\Cache\CacheController;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use DB;
use Illuminate\Http\Request;
use Session;

class VerificationController extends Controller
{
    use CacheController;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('personal.verification');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->sendemail) {
            if ($this->checkVerified()) {
                Session::flash('error', 'Tài khoản đã kích hoạt rồi!');
                return back();
            };
            // create otp
            $id = \Auth::user()->id;
            $otp = rand(10000000, 99999999);
            $hash = sha1($otp . strtotime(now()));
            $issetUser = DB::table('verifications')->where('user_id', $id)->count();
            // check and delete DB
            if ($issetUser >= 1) {
                DB::table('verifications')->where('user_id', $id)->delete();
            }
            // update into DB
            DB::table('verifications')->insert([
                'user_id' => $id,
                'otp' => $otp,
                'hash' => $hash,
                'created_at' => now(),
            ]);
            //send email to verifi acount
            SendEmail::dispatch($request->email, $otp)->delay(now()->addSeconds(10));
            return redirect('/ca-nhan/kich-hoat-tai-khoan?hash=' . $hash . '&email=' . $request->email);
        }

        if ($request->sendOtp) {
            return $this->handlesendOtp($request);
        }
    }
    
    public function handlesendOtp($request)
    {
        $issetHash = DB::table('verifications')->where('hash', $request->hash)->first();
        if (!$issetHash) {
            Session::flash('error', 'Phiên giao dịch đã hết hạn!');
            return redirect('/ca-nhan');
        }
        
        if(strtotime(now()) > strtotime($issetHash->created_at) + 600){
            //delete DB
            DB::table('verifications')->where('user_id', \Auth::user()->id)->delete();
            //return
            Session::flash('error', 'Phiên giao dịch đã hết hạn!');
            return redirect('/ca-nhan');
        };

        $checkOtp = DB::table('verifications')->where(
            [
                'hash' => $request->hash,
                'otp' => $request->otp,
            ]
        )->count();

        if ($checkOtp < 1) {
            Session::flash('error', 'Mã otp sai!');
            return back();
        }

        DB::table('users')->where('id', \Auth::user()->id)->update([
            'email_verified_at' => now(),
        ]);
        //delete DB
        DB::table('verifications')->where('user_id', \Auth::user()->id)->delete();
        // forget user cache
        $this->forgetCache('users');
        // remember cach
        $this->usersCache();
        Session::flash('success', 'Tài khoản được kích hoạt thành công!');
        return redirect('/ca-nhan');
    }

    public function checkVerified()
    {
        return (DB::table('users')->where('id', \Auth::user()->id)->first())->email_verified_at;
    }
}
