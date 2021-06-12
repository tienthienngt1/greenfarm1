<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Refferal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refferals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('refferal');
            $table->integer('user_ref_1')->nullable();
            $table->integer('user_ref_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refferals');
    }
}
