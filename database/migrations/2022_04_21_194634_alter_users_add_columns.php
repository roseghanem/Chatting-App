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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('name')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('university')->nullable();
            $table->string('college')->nullable();
            $table->string('high_school')->nullable();
            $table->string('position')->nullable();
            $table->string('firm')->nullable();
            $table->string('horoscope')->nullable();
            $table->string('religion')->nullable();
            $table->string('county')->nullable();
            $table->string('city')->nullable();
            $table->string('bio')->nullable();
            $table->integer('height')->nullable();
            $table->string('exercise')->nullable();
            $table->boolean('have_kids')->nullable();
            $table->boolean('want_kids')->nullable();
            $table->string('martial_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
