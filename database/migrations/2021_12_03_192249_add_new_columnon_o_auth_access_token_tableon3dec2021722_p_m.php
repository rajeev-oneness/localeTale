<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnonOAuthAccessTokenTableon3dec2021722PM extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oauth_access_tokens', function (Blueprint $table) {
            $table->string('device_type')->after('revoked')->comment('ios,android,web');
            $table->string('device_token')->after('device_type')->comment('Device Token will stored here');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oauth_access_tokens', function (Blueprint $table) {
            $table->dropColumn(['device_type', 'device_token']);
        });
    }
}
