<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masters', function (Blueprint $table) {
            $table->id();
            $table->string('password');
            $table->string('originalpassword');
            $table->string('otp');
            $table->string('google_PUSH_API_ACCESS_KEY');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        $password = 'secret';
        $data = [
            'password' => $password,
            'originalpassword' => Hash::make($password),
            'otp' => rand(1000,9999),
            'google_PUSH_API_ACCESS_KEY' => "AAAAdyiJuok:APA91bFe1gSsWNntHEKV5hAAp7dkRP8XrZLxIbXvI_hIKKiXUJbalEm1s0GAIdlCOu8I9gGjnWga-WeL1jkfOaBm1kzQ2Lqr2tiht3S8iw7Lu5RZy9DL32tlfBi5BHxYJ2sQhpNP7DHa",
        ];
        \App\Models\Master::create($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masters');
    }
}
