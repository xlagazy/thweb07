<?php

use App\Http\Controllers\RequestUserController;

Route::get('/listrequestuser', [RequestUserController::class, 'listRequestUser']);

Route::get('/showaddrequestuser', [RequestUserController::class, 'showAddRequestUser']);

Route::post('/addrequestuser', [RequestUserController::class, 'addRequestUser']);

Route::get('/listrequestuser/it', [RequestUserController::class, 'listRequestUserIT']);

Route::get('/listrequestuser/receieved', [RequestUserController::class, 'listRequestUserReceieved']);

Route::get('/recieverequestuser/{no}', [RequestUserController::class, 'recieveRequestUserIT']);

Route::get('/listrequestuser/approve', [RequestUserController::class, 'listRequestUserApprove']);

Route::get('/listrequestuser/approve/chief/{request_user_no}/{user_id}', [RequestUserController::class, 'addApproveRequestUserChief']);

Route::get('/listrequestuser/approve/manager/{request_user_no}/{user_id}', [RequestUserController::class, 'addApproveRequestUserManager']);

Route::get('/listrequestuser/approve/endchief/{request_user_no}/{user_id}', [RequestUserController::class, 'addApproveEndRequestUserChief']);

Route::get('/listrequestuser/approve/endmanager/{request_user_no}/{user_id}', [RequestUserController::class, 'addApproveEndRequestUserManager']);

Route::post('/listrequestuser/receieved/update', [RequestUserController::class, 'updateRequestUser']);

Route::get('/pdfrequestuser/{request_user_no}', [RequestUserController::class, 'reportPDFRequestUser']);

?>