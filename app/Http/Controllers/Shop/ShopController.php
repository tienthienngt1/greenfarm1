<?php

namespace App\Http\Controllers\Shop;

use App\Cache\CacheController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GetTimeController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Feeding;
use App\Models\HistoryBuy;
use App\Models\Refferal;
use App\Models\Money;
use App\Models\User;
use DB;
use Session;

class ShopController extends Controller
{
    use GetTimeController, CacheController;
    public $id;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shop.index', [
            'users' => $this->userCache(),
            'userFeeding' => $this->userRelationCache('feedings'),
            'userPermission' => $this->userRelationCache('permissions'),
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
        if (isset($_POST['buy'])) {
            $this->handleBuy($request);
        }
        return back();
    }

    public function handleBuy($request)
    {
        // CHECK REQUIRE
        if($request->_id == 5){
            if(\Auth::user()->permission->dog2 == 0){
                Session::flash('error', 'Bạn chưa mua Chó Cấp 2!');
                return;
            }
        }
        if($request->_id == 7){
            if(\Auth::user()->permission->bird2 == 0){
                Session::flash('error', 'Bạn chưa mua Chim Cấp 2!');
                return;
            }
        }

        $shop = $this->shop($request->_id);
        $nameper = $request->_namepermission;
        if ($shop === null || empty($nameper)) {
            Session::flash('error', 'ERROR!');
            return;
        }

        $user = $this->user();
        foreach($shop as $s){
            $limited = $s->limited;
            $cost = $s->cost;
            $time = $s->time;
            $id = $s->id;
        }
        if ($user->permission->$nameper >= $limited) {
            Session::flash('error', 'Bạn đã hết lượt mua!');
            return;
        };
        if ($this->checkFeeding($user->id)) {
            Session::flash('error', 'Bạn đang nuôi một con vật rồi!');
            return;
        };

        if ($user->money->balance < $cost) {
            Session::flash('error', 'Bạn không đủ tiền!');
            return ;
        };
        
        //check refferal1
        $this->checkRefferal1($shop);
        //check refferal2
        $this->checkRefferal2($shop);
        //forget Cache
        $this->forgetCache('moneys');
        $this->forgetCache('historybuys');

        //add feeding
        $this->feeding($user, $time, $id);
        //forget Cache
        $this->forgetCache('feedings');

        //minus balance
        $this->minusBalance($user->id, $cost);
        //forget Cache
        $this->forgetCache('moneys');
        
        // notifibuys
        $this->notifibuys($shop);
        //forget Cache
        $this->forgetCache('notifibuys');
        
        //remember cache
        $this->usersCache();

        Session::flash('success', 'Mua thành công!');
        return back();
    }

    public function user()
    {
        return \Auth::user();
    }

    public function shop($id)
    {
        $this->id = $id;
        $shop = $this->shopCache();
        return $shop->filter(function ($shop) {
            return (int) $shop->id === (int) $this->id;
        });
    }

    public function notifibuys($shop){
        foreach($shop as $s){
            $name = $s -> name;
        };
        DB::table('notifibuys')->insert([
            'name' => $this->user()->name,
            'animal' => $name,
        ]);
    }

    public function checkFeeding($id)
    {
        return Feeding::where('user_id', $id)->first();
    }

    public function minusBalance($id, $amount)
    {
        return DB::table('moneys')->where('user_id', $id)->update([
            'balance' => $this->user()->money->balance - $amount,
        ]);
    }

    public function feeding($user, $time, $id)
    {
        $addhour = $time;
        $addtime = date('Y-m-d H:i:s', strtotime('+' . $addhour . ' day', strtotime($this->gettime())));
        return Feeding::create([
            'user_id' => $user->id,
            'name' => $id,
            'time' => json_encode([
                'time' => $this->gettime(),
                'timelimit' => $addtime,
            ]),
        ]);
    }

    //refferal1
    public function checkRefferal1($shop)
    {
        if(!$user_ref_1 = $this->userRefCache('user_ref_1')){
           return;
        }
        foreach($shop as $sh){
            $profit = $sh->profit;
            $time = $sh->time;
            $name = $sh->name;
        };
        if($profit){
            //get balance
            $balance = Money::find($user_ref_1)->balance;
            $refferal = Money::find($user_ref_1)->refferal;
            $money = round($time*$profit*0.07);
            // update db
            Money::where('id',$user_ref_1)->update([
                'balance' => $balance + $money,
                'refferal' => $refferal + $money,
            ]);
            // update db history buy
            HistoryBuy::create([
                'user_id' => \Auth::user()->id,
                'user_ref' => $user_ref_1,
                'money' => $money,
                'level' => 1,
                'name' => $name,
            ]);
            return;
        }

        // return failed
        Session::flash('error','Lỗi vui lòng thử lại1');
        throw ValidationException::withMessages([]);
    }

    //refferal2
    public function checkRefferal2($shop)
    {
        if(!$user_ref_2 = $this->userRefCache('user_ref_2')){
            return;
        }
        foreach($shop as $sh){
            $name = $sh->name;
            $profit = $sh->profit;
            $time = $sh->time;
        };
        if($profit){
            //get balance
            $balance = Money::find($user_ref_2)->balance;
            $refferal = Money::find($user_ref_2)->refferal;
            $money = round($time*$profit*0.04);
            // update db
            Money::where('id',$user_ref_2)->update([
                'balance' => $balance + $money,
                'refferal' => $refferal + $money,
            ]);
             // update db history buy
             HistoryBuy::create([
                'user_id' => \Auth::user()->id,
                'user_ref' => $user_ref_2,
                'money' => $money,
                'level' => 2,
                'name' => $name,
            ]);
            return;
        }
        
        // return failed
        Session::flash('error','Lỗi vui lòng thử lại2');
        throw ValidationException::withMessages([]);
    }
}
