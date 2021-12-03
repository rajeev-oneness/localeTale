<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('page_key');
            $table->string('meta_title');
            $table->string('meta_keyword');
            $table->longText('meta_description');
            $table->string('heading');
            $table->longText('description');
            $table->string('image');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $data = [
            [
                'page_key' => 'home',
            ],
            [
                'page_key' => 'about_us',
            ],
            [
                'page_key' => 'contact_us',
            ],
            [
                'page_key' => 'faqs',
            ],
            [
                'page_key' => 'testimonials',
            ],
            [
                'page_key' => 'terms_and_conditions',
            ],
            [
                'page_key' => 'privacy_policy',
            ],
            [
                'page_key' => 'leads',
            ],
            [
                'page_key' => 'offers',
            ],
            [
                'page_key' => 'events',
            ],
        ];
        \App\Models\PageSetting::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_settings');
    }
}
