<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "infos";

    protected $fillable = [
        'user_id',
        'bank',
        'stk',
        'brand',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
