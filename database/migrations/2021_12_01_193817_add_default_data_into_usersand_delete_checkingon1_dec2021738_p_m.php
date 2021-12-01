<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultDataIntoUsersandDeleteCheckingon1Dec2021738PM extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $array = [
            ['user_role' => 3,'email' => 'abc@gmail.com'],
            ['user_role' => 3,'email' => 'def@gmail.com'],
        ];

        DB::table('users')->insert($array);

        $address = [
            ['user_id' => 2, 'type' => 1],
            ['user_id' => 3, 'type' => 1],
        ];
        DB::table('addresses')->insert($address);

        \App\Models\User::whereIn('email',['abc@gmail.com','def@gmail.com'])->delete();
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
