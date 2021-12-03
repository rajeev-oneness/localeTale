<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('business_category_id');
            $table->string('name');
            $table->longText('description');
            $table->string('website');
            $table->string('image');
            $table->text('address_line_1');
            $table->text('address_line_2');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('post_code');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->longText('youtube_link');
            $table->longText('facebook_link');
            $table->longText('instagram_link');
            $table->longText('twitter_link');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
