<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBossesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bosses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('region');
            $table->text('location');
            $table->text('cooldown');
            $table->timestamps();
        });
        
        Schema::create('line_ups', function (Blueprint $table) {
            $table->id();
            $table->string('level');
            $table->unsignedBigInteger('boss_id');
            $table->json('line_up');
            $table->json('rewards');
            $table->text('notes');
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
        Schema::dropIfExists('bosses');
        Schema::dropIfExists('line_ups');
    }
}
