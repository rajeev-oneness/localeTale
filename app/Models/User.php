<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, CascadeSoftDeletes;

    protected $fillable = ['name','email','password'];

    protected $hidden = ['password','remember_token',];

    protected $casts = ['email_verified_at' => 'datetime'];

    protected $cascadeDeletes = ['address'];

    public function address()
    {
        return $this->hasMany(Address::class);
    }
}
