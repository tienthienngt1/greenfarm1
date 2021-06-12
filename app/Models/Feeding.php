<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Feeding extends Model
{
  use HasFactory,
    Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  public $table = "feedings";

  public $timestamps = false;
  protected $fillable = [
    'id',
    'user_id',
    'name',
    'time',
  ];

  public function user()
  {
    return belongsTo('App\Models\User');
  }
}
