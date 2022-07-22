<?php 

use App\Http\Controllers\FtpController;

Route::get('/ftp', [FtpController::class, 'ftp']);

Route::get('/put', [FtpController::class, 'put']);

Route::get('/getandput', [FtpController::class, 'getandput']);

Route::post('/getftp', [FtpController::class, 'getftp']);

Route::post('/putftp', [FtpController::class, 'putftp']);

Route::post('/getandputftp', [FtpController::class, 'getandputftp']);

Route::get('/downloadfile/{file}', [FtpController::class, 'downloadfile']);

?>