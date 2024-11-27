<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_from');
            $table->unsignedBigInteger('request_to');
            $table->enum('status', [0, 1, 2])->nullable();
            $table->foreign('request_from')
                ->on('users')->references('id')
                ->onDelete('cascade');
            $table->foreign('request_to')
                ->on('users')->references('id')
                ->onDelete('cascade');
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
        Schema::dropIfExists('match_requests');
    }
};
