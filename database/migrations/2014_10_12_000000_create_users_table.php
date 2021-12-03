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
            $table->longText('name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->default('images/user.jpg');
            $table->string('otp',10);
            $table->string('short_bio')->comment('short summary');
            $table->longText('about');
            $table->string('gender',20)->comment('Male,Female,Not specified');
            $table->date('dob');
            $table->longText('hobbies')->comment('User Hobbies with Comma-Separated');
            $table->string('marital',20)->comment('Single,Married,Divorced');
            $table->date('aniversary');
            $table->tinyInteger('is_verified')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->string('user_slug')->index();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $data = [
            [
                'user_role' => 1,
                'name' => 'Admin',
                'first_name' => 'Admin',
                'email' => 'admin@localtale.com',
                'password' => Hash::make('secret'),
                'is_verified' => 1,
                'email_verified_at' => date('Y-m-d h:i:s'),
            ],
        ];
        foreach ($data as $key => $user) {
            \App\Models\User::create($user);
        }
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
