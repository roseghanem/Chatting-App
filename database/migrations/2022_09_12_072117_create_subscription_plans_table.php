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
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::table('subscription_plans')->insert([
            [
                'name' => 'Basic',
                'created_at' => \Carbon\Carbon::now(),
            ], [
                'name' => 'Gold',
                'created_at' => \Carbon\Carbon::now(),
            ], [
                'name' => 'Premium',
                'created_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_plans');
    }
};
