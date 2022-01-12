<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title')->required()->default('ERROR: No Title Given');
            $table->text('description')->nullable();
            $table->time('duration')->nullable();
            $table->string('uid');
            $table->unsignedSmallInteger('series')->nullable();
            $table->unsignedSmallInteger('episode')->nullable();
            $table->unsignedBigInteger('channel_id')->default(0);
            $table->unsignedBigInteger('user_id')->default(0);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('videos');
    }
}
