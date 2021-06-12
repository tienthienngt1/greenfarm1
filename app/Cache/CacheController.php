<?php

namespace App\Cache;

use App\Models\Feeding;
use App\Models\Info;
use App\Models\Money;
use App\Models\Permission;
use App\Models\Feeded;
use App\Models\Deposit;
use App\Models\Refferal;
use App\Models\HistoryBuy;
use App\Models\User;
use App\Models\Withdraw;
use Cache;
use DB;

trait CacheController
{
    /**
     * get user if haven't.
     *
     * @return App\Models\User;
     */
    public function usersCache()
    {
        //users
        if (!Cache::has('users')) {
            Cache::rememberForever('users', function () {
                return User::all();
            });
        }

        //feedings
        if (!Cache::has('feedings')) {
            Cache::rememberForever('feedings', function () {
                return Feeding::all();
            });
        }

        //infos
        if (!Cache::has('infos')) {
            Cache::rememberForever('infos', function () {
                return Info::all();
            });
        }

        //refferals
        if (!Cache::has('refferals')) {
            Cache::rememberForever('refferals', function () {
                return Refferal::all();
            });
        }

        //moneys
        if (!Cache::has('moneys')) {
            Cache::rememberForever('moneys', function () {
                return Money::all();
            });
        }

        //permissions
        if (!Cache::has('permissions')) {
            Cache::rememberForever('permissions', function () {
                return Permission::all();
            });
        }

        // feededs
        if (!Cache::has('feededs')) {
            Cache::rememberForever('feededs', function () {
                return Feeded::all();
            });
        }

        //Deposit
        if (!Cache::has('deposits')) {
            Cache::rememberForever('deposits', function () {
                return Deposit::all();
            });
        }
        
        // historybuy
        if (!Cache::has('historybuys')) {
            Cache::rememberForever('historybuys', function () {
                return HistoryBuy::all();
            });
        }
        
        // withdraw
        if (!Cache::has('withdraws')) {
            Cache::rememberForever('withdraws', function () {
                return Withdraw::all();
            });
        }
        
        // notifi buy
        if (!Cache::has('notifibuys')) {
            Cache::rememberForever('notifibuys', function () {
                return DB::table('notifibuys')->get();
            });
        }
        

        return Cache::get('users');
    }

    public function userCache()
    {
        $users = $this->usersCache();
        return $users->filter(function ($users) {
            return (int) $users->id === (int) \Auth::user()->id;
        });
    }

    public function shopFeededCache()
    {
        if (!Cache::has('feededs')) {
            $this->usersCache();
        }

        $feededs = $this->userRelationCache('feededs');
        return $feededs->filter(function($feededs){
            return (int)$feededs->user_id === (int)\Auth::user()->id;
        });
    }

    /**
     * get shops if haven't.
     *
     * @return App\Models\User;
     */
    public function shopCache()
    {
        if (!Cache::has('shop')) {
            Cache::rememberForever('shop', function () {
                return DB::table('shops')->get();
            });
        }
        return Cache::get('shop');
    }

    /**
     * get user by shop if haven't.
     *
     * @return App\Models\User;
     */
    public function userShopCache()
    {
        if(!Cache::get('shop')){
            $this->usersCache();
        }
        $id = null;
        foreach($this->userRelationCache('feedings') as $feed){
            $id = $feed->name;
        };

        $shop = $this->shopCache();
        return $shop->filter(function($shop) use($id) {
            return (int)$shop->id === (int)$id;
        });
    }

    
    /**
     * get user collection.
     *
     * @return collection user;
     */
    public function userRelationCache($re)
    {
        if (!Cache::get($re)) {
            $this->usersCache();
        }
        $collection = Cache::get($re);
        return $collection->filter(function($collection){
            return (int)$collection->user_id === (int)\Auth::user()->id;
        });
    }
    
    /**
     * get user_ref collection.
     *
     * @return collection user;
     */
    public function userRefCache($re)
    {
        $collection = $this->userRelationCache('refferals');
        foreach($collection as $collec){
            return $result = $collec->$re;
        };
    }
    
    /**
     * get list user_ref collection.
     *
     * @return collection user;
     */
    public function historybuyCache()
    {
        if (!Cache::get('historybuys')) {
            $this->usersCache();
        }
        $collection = Cache::get('historybuys');
        return $collection->filter(function($collection){
            return $collection -> user_ref == \Auth::user() -> id;
        });
    }
    
    /**
     * get user collection.
     *
     * @return forget Cache;
     */
    public function forgetCache($value){
        if (Cache::has($value)) {
            return Cache::forget($value);
        }
    }
    
    
}
