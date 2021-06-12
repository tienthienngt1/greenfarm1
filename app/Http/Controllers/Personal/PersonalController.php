<?php

namespace App\Http\Controllers\Personal;

use App\Cache\CacheController;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Session, DB;

class PersonalController extends Controller
{
    use CacheController;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userCache();
        $user = $users->filter(function ($users) {
            return (int) $users->id === (int) \Auth::user()->id;
        });
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 1) {
                return view('personal.paying', [
                    'users' => $user,
                    'deposits' => $this->userRelationCache('deposits'),
                ]);
            }
            if ($_GET['action'] == 2) {
                return view('personal.withdraw', [
                    'withdraws' => $this->userRelationCache('withdraws'),
                    'infos' => $this->userRelationCache('infos'),
                ]);
            }
        }
        return view('personal.index', [
            'users' => $user,
            'moneys' => $this->userRelationCache('moneys'),
            'feedings' => $this->userRelationCache('feedings')
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
        if (isset($_POST['paying'])) {
            //check money
            if($request->money < 85688){
                Session::flash('error', 'Số tiền nạp ít nhất là 85.688đ!');
                return back();
            }
            // check is_image
            if (!$request->hasFile('image')) {
                Session::flash('error', 'Bạn chưa chọn ảnh!');
                return back();
            }
            //check is_array
            $array = ['png', 'jpg', 'jpeg'];
            $nameImage = $request->file('image')->getClientOriginalName();
            $getTypeImage = explode(".", $nameImage);
            if (!in_array(end($getTypeImage), $array)) {
                Session::flash('error', 'Định dạng ảnh chỉ chấp nhận jpg, png, jpeg!');
                return back();
            }
            //check size
            $sizeImage = $request->file('image')->getSize();
            if ($sizeImage / 1000 > 5000) {
                Session::flash('error', 'Dung lượng ảnh quá lớn, chỉ chấp nhận dung lượng ảnh dưới 5Mb!');
                return back();
            }
            // save image into public
            $request->file('image')->move('images/deposit/', $nameImage, 'local');
            // create to database
            Deposit::create([
                'user_id' => \Auth::user()->id,
                'money' => $request->money,
                'hash' => sha1(rand(11111111, 9999999999)),
                'image' => 'images/deposit/' . $nameImage,
                'status' => 0,
            ]);
            // forget Cache
            $this->forgetCache('deposits');
            //remember Cache
            $this->usersCache();

            //return
            Session::flash('success', 'Tạo đơn thành công. Bạn vui lòng chờ trong giây lát!');
            return back();
        }

        if (isset($_POST['withdraw'])) {
            $this->withdraw($request);
            return back();
        }
    }

    public function withdraw($request)
    {
        if(!\Auth::user()->email_verified_at){
            Session::flash('error','Tài khoản chưa kích hoạt. Xin mời kích hoạt!');
            return;
        }
        if(!\Auth::user()->info){
            Session::flash('error','Bạn chưa cập nhật thông tin!');
            return;
        }
        
        $getMoney = DB::table('moneys')->where('user_id', \Auth::user()->id)->first();
 
        if((int)$request->money < 100000){
            Session::flash('error',' Số tiền rút phải lớn hơn 100.000đ!');
            return;
        }

        if((int)$getMoney->balance < (int)$request->money){
            Session::flash('error',' Số dư không đủ!');
            return;
        }
        // handle money
        DB::table('moneys')->update([
            'balance' => $getMoney->balance - $request->money,
            'pending' => $getMoney->pending + $request->money,
        ]);
        //forget Cache
        $this->forgetCache('moneys');
        // create DB withdraw
        Withdraw::create([
            'user_id' => \Auth::user()->id,
            'hash' => sha1(rand(11111111, 9999999999).strtotime(now())),
            'money' => $request->money,
            'status' => 0,
        ]);
        //forget Cache withdraws
        $this->forgetCache('withdraws');
        //rememer Cache
        $this->usersCache();
        Session::flash('success', 'Rút tiền thành công. Vui lòng chờ hệ thống xử lý!');
    }
}
