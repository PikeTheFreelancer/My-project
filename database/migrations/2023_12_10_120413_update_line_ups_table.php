<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLineUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('line_ups', function(Blueprint $table){
            $table->string('nature');
            $table->string('ability');
        });
        Schema::table('bosses', function(Blueprint $table){
            $table->text('rewards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('line_ups', function(Blueprint $table){
            $table->dropColumn('nature');
            $table->dropColumn('ability');
        });
        Schema::table('bosses', function(Blueprint $table){
            $table->dropColumn('rewards');
        });
    }
}
