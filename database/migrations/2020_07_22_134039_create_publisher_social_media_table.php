<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublisherSocialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publisher_social_media', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('publisher_id');
            $table->string('social_media_name');
            $table->string('social_media_type');
            $table->string('social_media_url');
            $table->boolean('is_verified')->default(0);
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
        Schema::dropIfExists('publisher_social_media');
    }
}
