<?php 

use App\Http\Controllers\LoginController;

//login-logout

Route::get('login', [LoginController::class, 'login']);

Route::post('loginuser', [LoginController::class, 'loginUser']);

Route::get('logout', [LoginController::class, 'logOut']);

?>