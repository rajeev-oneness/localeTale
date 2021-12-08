<?php 

	namespace App\Http\Controllers\Business;
	use Illuminate\Support\Facades\Route;
	use Illuminate\Support\Facades\Auth;

	Route::get('dashboard',[BusinessController::class,'dashboard'])->name('business.dashboard');

?>