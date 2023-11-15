<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->json('blocks');
            $table->timestamps();
        });

        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->text('name');
        });

        Schema::create('text_image_blocks', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('content');
            $table->text('image');
            $table->tinyInteger('image_pos');
            $table->unsignedBigInteger('page_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('blocks');
        Schema::dropIfExists('text_image_blocks');
    }
}
