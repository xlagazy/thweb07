<?php

use App\Http\Controllers\RequestUserController;

Route::get('/listrequestuser', [RequestUserController::class, 'listRequestUser']);

Route::get('/listrequestuser/search', [RequestUserController::class, 'searchlistRequestUser']);

Route::get('/showaddrequestuser', [RequestUserController::class, 'showAddRequestUser']);

Route::post('/addrequestuser', [RequestUserController::class, 'addRequestUser']);

Route::get('/editrequestuserit/{no}', [RequestUserController::class, 'showEditRequestUserIT']);

Route::get('/editrequestuser/{no}', [RequestUserController::class, 'showEditRequestUser']);

Route::get('/deleterequestuser/{no}', [RequestUserController::class, 'deleteRequestUser']);

Route::post('/updaterequestuserit', [RequestUserController::class, 'editRequestUser']);

Route::get('/listrequestuser/it', [RequestUserController::class, 'listRequestUserIT']);

Route::get('/listrequestuser/it/search', [RequestUserController::class, 'searchlistRequestUserIT']);

Route::post('/listrequestuser/it/assign', [RequestUserController::class, 'assignRequestUser']);

Route::post('/listrequestuser/it/refuse', [RequestUserController::class, 'refuseRequestUser']);

Route::get('/listrequestuser/receieved', [RequestUserController::class, 'listRequestUserReceieved']);

Route::get('/listrequestuser/receieved/search', [RequestUserController::class, 'searchlistRequestUserReceieved']);

Route::post('/listrequestuser/receieved/update', [RequestUserController::class, 'updateRequestUser']);

Route::get('/listrequestuser/confirmrequestuser/{fk_request_user}/{employee_no}', [RequestUserController::class, 'addConfirmRequestUser']);

Route::get('/recieverequestuser/{no}', [RequestUserController::class, 'recieveRequestUserIT']);

Route::get('/listrequestuser/approve', [RequestUserController::class, 'listRequestUserApprove']);

Route::get('/listrequestuser/approve/search', [RequestUserController::class, 'searchlistRequestUserApprove']);

Route::get('/listrequestuser/approve/section', [RequestUserController::class, 'listRequestUserApproveSection']);

Route::get('/listrequestuser/approve/section/search', [RequestUserController::class, 'searchlistRequestUserApproveSection']);

Route::get('/listrequestuser/approve/relatesect', [RequestUserController::class, 'listRequestUserApproveRelatesect']);

Route::get('/listrequestuser/approve/relatesect/search', [RequestUserController::class, 'searchlistRequestUserApproveRelatesect']);

Route::get('/listrequestuser/approve/chief/{request_user_no}/{user_id}', [RequestUserController::class, 'addApproveRequestUserChief']);

Route::get('/listrequestuser/approve/manager/{request_user_no}/{user_id}', [RequestUserController::class, 'addApproveRequestUserManager']);

Route::get('/listrequestuser/approve/endcharge/{request_user_no}/{user_id}', [RequestUserController::class, 'addApproveEndRequestUserCharge']);

Route::get('/listrequestuser/approve/endchief/{request_user_no}/{user_id}', [RequestUserController::class, 'addApproveEndRequestUserChief']);

Route::get('/listrequestuser/approve/endmanager/{request_user_no}/{user_id}', [RequestUserController::class, 'addApproveEndRequestUserManager']);

Route::get('/listrequestuser/approve/sectchief/{fk_request_user}/{employee_no}', [RequestUserController::class, 'addApproveRequestUserSectChief']);

Route::get('/listrequestuser/approve/sectmanager/{fk_request_user}/{employee_no}', [RequestUserController::class, 'addApproveRequestUserSectManager']);

Route::get('/listrequestuser/approve/relatesect/{fk_request_user}/{employee_no}/{seq}', [RequestUserController::class, 'addApproveRequestUserRelateSect']);

Route::get('/pdfrequestuser/{request_user_no}', [RequestUserController::class, 'reportPDFRequestUser']);

?>