<?php 

	namespace App\Http\Controllers\Customer;
	use Illuminate\Support\Facades\Route;
	use Illuminate\Support\Facades\Auth;

	Route::get('dashboard',[CustomerController::class,'dashboard'])->name('customer.dashboard');

?>