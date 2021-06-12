<?php

namespace App\Http\Controllers\Admin;

use App\Cache\CacheController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session, DB, Cache;

class AdminController extends Controller
{
    use CacheController;
    public $id;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deposits = Cache::get('deposits')->sortByDesc('created_at');
        $withdraws = Cache::get('withdraws')->sortByDesc('created_at');
        if(isset($_GET['a'])){
            if($_GET['a'] == 'user'){
                return view('admin.user', ['users' => $this->usersCache()->sortByDesc('created_at')]);
            }
            if($_GET['a'] == 'naptien'){
                return view('admin.naptien',['deposits' => $deposits]);
            }
            if($_GET['a'] == 'ruttien'){
                return view('admin.ruttien',['withdraws' => $withdraws]);
            }
            if($_GET['a'] == 'edit'){
                return view('admin.edit',['infos' => Cache::get('infos')->sortByDesc('created_at')]);
            }
            if($_GET['a'] == 'sodu'){
                return view('admin.sodu',['moneys' => Cache::get('moneys')]);
            }
        }
        return view('admin.index', [
            'deposits' =>$deposits,
            'withdraws' => $withdraws
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->khoa)){
            return $this->khoa($request);
        }
        if(isset($request->mo)){
            return $this->mo($request);
        }
        if(isset($request->chapnhan)){
            return $this->chapnhan($request);
        }
        if(isset($request->tuchoi)){
            return $this->tuchoi($request);
        }
        if(isset($request->successWithdraw)){
            return $this->successWithdraw($request);
        }
        if(isset($request->failedWithdraw)){
            return $this->failedWithdraw($request);
        }
        if(isset($request->infoEdit)){
            return $this->infoEdit($request);
        }
        if(isset($request->searchEmail)){
            return $this->searchEmail($request);
        }
        if(isset($request->addnotifi)){
            return $this->addnotifi($request);
        }
    }

    //  ADD NOTIFIBUY
    public function addnotifi($request){
        DB::table('notifibuys')->insert([
            'name' => $request->name,
            'animal' => $request->animal,
        ]);
        //forget Cache
        $this->forgetCache('notifibuys');
        $this->usersCache();
        Session::flash('success','ok');
        return back();
    }

    // SEARCH EMAIL
    public function searchEmail($request){
        dd(DB::table('users')->where('email', $request->email)->get());
    }

    // SUA THONG TIN 
    public function infoEdit($request){
        $update = DB::table('infos')->where('user_id', $request->user_id)->update([
            $request->content => $request->contentEdit,
        ]);

        //forget Cache
        $this->forgetCache('infos');
        $this->usersCache();
        //return
        if(!$update){
            Session::flash('error', 'error!');
        }
        Session::flash('success', 'Thành công!');
        return back();
    }

    // SUCCESS WITHDRAW
    public function successWithdraw($request){
        DB::table('withdraws')->where('id', $request->_id)->update([
            'status' => 1,
        ]);

        //forget Cache
        $this->forgetCache('withdraws');
        //remember cache
        $this->usersCache();
        Session::flash('success','Thành công');
        return back();
    }
    
    // FAILED WITHDRAW
    public function failedWithdraw($request){
        DB::table('withdraws')->where('id', $request->_id)->update([
            'status' => 2,
        ]);
        
        //forget Cache
        $this->forgetCache('withdraws');
        //remember cache
        $this->usersCache();
        Session::flash('error','Thất bại');
        return back();
    }

    // KHOA
    public function khoa($request){
        DB::table('users')->where('id',$request->_id)->update([
            'status' => 1,
        ]);
        Session::flash('success','Khóa!');
        return back();
    }
    
    // MO
    public function mo($request){
        DB::table('users')->where('id',$request->_id)->update([
            'status' => null,
        ]);
        Session::flash('error','Mở khóa!');
        return back();
    }

    //CHAP NHAN
    public function chapnhan($request){
        //get Balance DB
        $getUser = DB::table('moneys')->where('user_id', $request->user_id)->first();
        $balance = $getUser->balance;
        $deposit = $getUser->deposit;
        DB::table('moneys')->where('user_id', $request->user_id)->update([
            'balance' => $balance + $request->money,
            'deposit' => $deposit + $request->money,
        ]);
        
        DB::table('deposits')->where('id', $request->_id)->update([
            'status' => 1,
        ]);
        //forget Cache
        $this->forgetCache('moneys');
        $this->forgetCache('deposits');
        //remember Cache
        $this->usersCache();
        
        Session::flash('success', 'Thành công');
        return back();
    }
    
    // TU CHOI
    public function tuchoi($request){
        DB::table('deposits')->where('id', $request->_id)->update([
            'status' => 2,
        ]);
        
        //forget Cache
        $this->forgetCache('deposits');
        //remember Cache
        $this->usersCache();
        Session::flash('error', 'Thất bại');
        return back();
    }

}
