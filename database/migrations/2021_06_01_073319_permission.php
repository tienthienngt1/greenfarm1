<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Permission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('cat1');
            $table->integer('cat2');
            $table->integer('dog1');
            $table->integer('dog2');
            $table->integer('bird1');
            $table->integer('bird2');
            $table->integer('horse1');
            $table->integer('horse2');
            $table->integer('dragon1');
            $table->integer('dragon2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
