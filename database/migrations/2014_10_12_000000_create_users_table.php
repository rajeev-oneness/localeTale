<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_role');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->default('images/user.jpg');
            $table->string('otp',10);
            $table->rememberToken();
            $table->string('gender',20)->comment('Male,Female,Not specified');
            $table->date('dob');
            $table->string('marital',20)->comment('Single,Married,Divorced');
            $table->date('aniversary');
            $table->tinyInteger('is_verified')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $data = [
            [
                'user_role' => 1,
                'name' => 'Admin',
                'email' => 'admin@localtale.com',
                'password' => Hash::make('secret'),
                'is_verified' => 1,
            ],
        ];

        DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
