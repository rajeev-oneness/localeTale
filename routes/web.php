<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [DefaultController::class, 'welcome'])->name('welcome');
Route::get('administrator',[LoginController::class,'adminLoginView'])->name('admin.login');

Auth::routes(['login' => true,'register' => true,'logout' => false,'verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::any('logout', [LoginController::class, 'logout'])->name('logout');

// Auth Routes
Route::group(['prefix' => 'user','middleware' => ['auth','verified']], function () {

    /*********************** Admin Routes ************************/
    Route::group(['prefix' => 'admin',], function () {
        require 'custom/admin.php';
    });

    /*********************** Business Route *********************/
    Route::group(['prefix' => 'business', 'middleware' => 'business'], function () {
        require 'custom/business.php';
    });

    /*********************** Customer Route *********************/
    Route::group(['prefix' => 'customer', 'middleware' => 'customer'], function () {
        require 'custom/customer.php';
    });

});
