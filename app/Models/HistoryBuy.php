<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class HistoryBuy extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "historybuys";

    protected $fillable = [
        'id',
        'user_id',
        'user_ref',
        'level',
        'money',
        'name',
    ];



    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
