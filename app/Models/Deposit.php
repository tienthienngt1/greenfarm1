<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "deposits";
    
    protected $fillable = [
        'id',
        'user_id',
        'money',
        'hash',
        'status',
        'image',
    ];



    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
