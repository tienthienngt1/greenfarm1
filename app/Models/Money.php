<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "moneys";

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'balance',
        'refferal',
        'deposit',
        'withdraw',
        'pending',
    ];



    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
