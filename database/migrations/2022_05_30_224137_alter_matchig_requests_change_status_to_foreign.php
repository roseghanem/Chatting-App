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
        Schema::table('match_requests', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('status')->change()->nullable();
            $table->foreign('status')
                ->on('matching_statuses')->references('id')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('match_requests', function (Blueprint $table) {
            //
        });
    }
};
