<?php 

	namespace App\Http\Controllers\Admin;
	use Illuminate\Support\Facades\Route;
	use Illuminate\Support\Facades\Auth;

	Route::get('dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');

?>