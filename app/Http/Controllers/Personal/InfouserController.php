<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cache\CacheController;
use App\Models\Info;
use Session;

class InfouserController extends Controller
{
    use CacheController;
    public function index()
    {
        return view('personal.infouser',[
            'infos' => $this->userRelationCache('infos')
        ]);
    }

    public function store(Request $request){
        if(isset($_POST['save'])){
            //check is_info
            if(!$this->userRelationCache('infos') -> isEmpty()){
                Session::flash('error','Bạn đã cập nhật trước đó rồi!');
                return back();
            }
            // create database
            $stk =(int) $request -> stk;
            Info::create([
                'user_id' => \Auth::user()->id,
                'stk' => $stk,
                'bank' =>$request->bank,
                'brand' => $request->brand,
                'status' => 1,
            ]);
            //forget Cache
            $this->forgetCache('infos');
            //remember cache
            $this->usersCache();
            Session::flash('success','Lưu thành công!');
            return back();
        }
        Session::flash('error','Bạn đã cập nhật trước đó rồi!');
        return back();
    }
}
