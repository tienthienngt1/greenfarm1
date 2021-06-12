<?php

namespace App\Http\Controllers\Auth;

use App\Models\Refferal;
use App\Models\Money;
use App\Models\Permission;
use Illuminate\Validation\ValidationException;
use App\Cache\CacheController;
use Session;

trait MoreRegisterController
{
    use CacheController;

    public $user_ref_1;
    public $user_ref_2;

    public function checkRefferal($data)
    {
        if ($ref = $this->getUserRefId($data['refferal'])) {
            $this->user_ref_1 = $ref->user_id;
            $this->user_ref_2 = $ref->user_ref_1;
            return;
        }
        if ($data['refferal']) {
            throw ValidationException::withMessages([
                'ref' => ' Mã giới thiệu không hợp lệ'
            ]);
        }
    }


    public function createMore($user)
    {
        //session notify success
        $this->sessionSuccess();

        //REFERAL
        Refferal::create([
            'user_id' => $user->id,
            'refferal' => rand(10000001, 99999999),
            'user_ref_1' => $this->user_ref_1,
            'user_ref_2' => $this->user_ref_2,
        ]);
        // forget Refferal Cache
        $this->forgetCache('refferals');

        //MONEY
        Money::create([
            'user_id' => $user->id,
            'balance' => 0,
            'refferal' => 0,
            'pending' => 0,
            'deposit' => 0,
            'withdraw' => 0,
        ]);
        //forget cache money
        $this->forgetCache('moneys');

        //PERMISSION
        Permission::create([
            'user_id' => $user->id,
            'cat1' => 0,
            'cat2' => 0,
            'dog1' => 0,
            'dog2' => 0,
            'bird1' => 0,
            'bird2' => 0,
            'horse1' => 0,
            'horse2' => 0,
            'dragon1' => 0,
            'dragon2' => 0,
        ]);
        //forget cache permission
        $this->forgetCache('permissions');
        //forget cache user
        $this->forgetCache('users');

        //remember Cache
        $this->usersCache();
    }

    public function getUserRefId($refferal)
    {
        return Refferal::where('refferal', $refferal)->first();
    }

    public function sessionSuccess()
    {
        return Session::flash('success', 'Đăng kí thành công!');
    }
}
