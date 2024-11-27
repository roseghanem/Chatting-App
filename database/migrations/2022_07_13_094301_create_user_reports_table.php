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
        Schema::create('user_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_from_user_id');
            $table->foreign('report_from_user_id')
                ->on('users')->references('id')
                ->onDelete('cascade');
            $table->unsignedBigInteger('report_to_user_id');
            $table->foreign('report_to_user_id')
                ->on('users')->references('id')
                ->onDelete('cascade');
            $table->string('reason');
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
        Schema::dropIfExists('user_reports');
    }
};
