<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [DefaultController::class, 'welcome'])->name('welcome');

Auth::routes(['login' => false,'register' => false,'logout' => false,'verify' => true]);

/***************************** Login View Routes **************************/
Route::get('admin/login',[LoginController::class,'userLoginView'])->name('admin.login');
Route::get('b2b/login',[LoginController::class,'userLoginView'])->name('business.login');
Route::get('customer/login',[LoginController::class,'userLoginView'])->name('customer.login');
/***************************** Login Post Routes **************************/
Route::post('login/user',[LoginController::class,'login'])->name('user.login');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// authenticated Routes do`not remove these both middleware otherwise verify request will not work
Route::group(['middleware' => ['auth','verified']], function () {

    /*********************** Admin Routes ************************/
    Route::group(['prefix' => 'admin','middleware' => 'admin'], function () {
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
Route::any('logout', [LoginController::class, 'logout'])->name('logout');
