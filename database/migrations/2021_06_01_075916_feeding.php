<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Feeding extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up() {
    Schema::create('feedings', function (Blueprint $table) {
      $table->id();
      $table->integer('user_id');
      $table->integer('name')->nullable();
      $table->json('time');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down() {
    Schema::dropIfExists('feedings');
  }
}