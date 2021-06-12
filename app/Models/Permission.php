<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "permissions";

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'cat1',
        'cat2',
        'dog1',
        'dog2',
        'bird1',
        'bird2',
        'horse1',
        'horse2',
        'dragon1',
        'dragon2',
    ];



    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
