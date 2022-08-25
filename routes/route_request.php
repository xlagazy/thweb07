<?php 

use App\Http\Controllers\RequestController;

Route::get('/userloginrequest', [RequestController::class, 'userLoginRequest']);

Route::post('/loginrequest', [RequestController::class, 'loginRequest']);

Route::get('/logoutrequest', [RequestController::class, 'logoutRequest']);

Route::get('/indexrequest', [RequestController::class, 'indexRequest']);

Route::post('/profilerequest', [RequestController::class, 'profileRequest']);

?>