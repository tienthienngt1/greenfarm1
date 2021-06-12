<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cache\CacheController;
use App\Http\Controllers\GetTimeController;
use App\Models\Feeding;
use App\Models\Permission;
use App\Models\Money;
use App\Models\Feeded;
use Cache, Session;

class HomeController extends Controller
{
    use CacheController, GetTimeController;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'users' => $this->userCache(),
            'feedings' => $this->userRelationCache('feedings'),
            'permissions' => $this->userRelationCache('permissions'),
        ]);
    }

    public function store(Request $request)
    {
        if(isset($_POST['getProfit'])){
            //check Time
            $differenceTime = strtotime(now()) - strtotime($this->getTime());
            if($differenceTime > 10){
                Session::flash('error','Chưa đủ thời gian, bạn vui lòng điều chỉnh đúng ngày giờ cho phép!');
                return back();
            }
            
            $getfeeding = $this->userRelationCache('feedings');
            if($getfeeding->isEmpty()){
                Session::flash('error','Lỗi! Bạn vui lòng thử lại sau.');
                return back();
            }

            foreach($getfeeding as $gf){
                $idShop = $gf->name;
            }

            if($idShop){
                
                //--------Add balance------------
                foreach($this->userShopCache() as $shop){
                    $money = $shop->time * $shop->profit + $shop->cost;
                    $namepermissShop= $shop -> namepermission;
                };
                //get balance
                foreach($this->userRelationCache('moneys') as $moneys){
                    $balance = $moneys->balance;
                };
                //update balance
                Money::where('user_id', \Auth::user()->id)->update([
                    'balance' => (int)$balance + (int)$money,
                ]);
                //forgetCache
                $this->forgetCache('moneys');
                
                //-----------Add Permission ---------------
                // get namepermission
                foreach($this->userRelationCache('permissions') as $permission){
                    $permiss = $permission -> $namepermissShop;
                }
                //update permission
                Permission::where('user_id', \Auth::user()->id) -> update([
                    $namepermissShop => (int)$permiss +1,
                    ]);
                    //forgetCache
                $this->forgetCache('permissions');
                
                // delete feedings
                Feeding::where('user_id', \Auth::user()->id)->delete();
                //delete cache
                $this->forgetCache('feedings');
                
                // create feededs
                Feeded::create([
                    'user_id' => \Auth::user()->id,
                    'name' => $idShop,
                    ]);
                //delete cache
                $this->forgetCache('feededs');
               
                // remember cache
                $this->usersCache();
                
                Session::flash('success','Nhận lợi nhuận thành công!');
                return back();
            }else{
                Session::flash('error','Lỗi! Bạn vui lòng thử lại sau.');
                return back();
            }
        }
        
        Session::flash('error','Lỗi! Bạn vui lòng thử lại sau.');
        return back();
    }
}