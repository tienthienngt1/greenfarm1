<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Money extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moneys', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('balance');
            $table->integer('refferal');
            $table->integer('deposit');
            $table->integer('pending');
            $table->integer('withdraw');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moneys');
    }
}
