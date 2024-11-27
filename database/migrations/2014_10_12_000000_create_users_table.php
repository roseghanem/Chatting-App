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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('login_times')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::table('users')
            ->insert([
                'name' => 'admin',
                'email' => 'admin@admin-mobile.com',
                'phone' => '+9611',
                'password' => \Illuminate\Support\Facades\Hash::make('1')
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
