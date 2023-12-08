<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\Types;

class UpdateBossesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bosses', function(Blueprint $table){
            $table->text('notes')->nullable()->change();
        });
        
        Schema::table('line_ups', function(Blueprint $table){
            $table->json('line_up')->nullable()->change();
            $table->json('rewards')->nullable()->change();
            $table->string('level')->nullable()->change();
            $table->unsignedBigInteger('boss_id')->nullable()->change();
            $table->text('notes')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
