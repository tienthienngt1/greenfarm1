<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "withdraws";
    protected $fillable = [
        'user_id',
        'money',
        'hash',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
