<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InfoVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_videos', function (Blueprint $table) {
            $table->increments('info_id');
            $table->string('video_name');
            $table->string('video_event');
            $table->string('video_user')->nullable();
            $table->integer('video_fromJump')->nullable();
            $table->integer('video_current_timeStart');
            $table->integer('video_current_timeEnd')->nullable();
            $table->integer('video_progress');
            $table->integer('video_progress5');
            $table->integer('video_duration');
            $table->string('video_date');
            $table->string('video_datetime');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_videos');
    }
}
