<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refferal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'refferal',
        'user_ref_1',
        'user_ref_2',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
