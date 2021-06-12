<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function money()
    {
        return $this->hasOne('App\Models\Money');
    }

    public function info()
    {
        return $this->hasOne('App\Models\Info');
    }

    public function refferal()
    {
        return $this->hasOne('App\Models\Refferal');
    }

    public function permission()
    {
        return $this->hasOne('App\Models\Permission');
    }

    public function feeding()
    {
        return $this->hasOne('App\Models\Feeding');
    }

    public function deposit()
    {
        return $this->hasOne('App\Models\Deposit');
    }
}
