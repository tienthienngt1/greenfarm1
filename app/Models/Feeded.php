<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Feeded extends Model
{
  use HasFactory,
    Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  public $table = "feededs";

  protected $fillable = [
    'id',
    'user_id',
    'name',
  ];

  public function user()
  {
    return belongsTo('App\Models\User');
  }
}
