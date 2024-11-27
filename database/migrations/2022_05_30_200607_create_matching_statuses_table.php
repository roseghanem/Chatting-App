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
        Schema::create('matching_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::table('matching_statuses')
            ->insert([
                ['name' => 'Like', 'code' => 'like'],
                ['name' => 'Super like', 'code' => 'super_like'],
                ['name' => 'Dislike', 'code' => 'dislike'],
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matching_statuses');
    }
};
