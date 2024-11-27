<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opened_bubbles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_user_id');
            $table->foreign('from_user_id')->on('users')->references('id');
            $table->unsignedBigInteger('to_user_id');
            $table->foreign('to_user_id')->on('users')->references('id');
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
        Schema::dropIfExists('opened_bubbles');
    }
};
