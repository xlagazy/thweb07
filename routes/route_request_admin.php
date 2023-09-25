<?php 

use App\Http\Controllers\RequestController;
use App\Http\Controllers\RequestAdminController;

Route::get('/listrequestadmin', [RequestAdminController::class, 'listRequestAdmin']);

Route::get('/showaddrequestadmin', [RequestAdminController::class, 'showAddRequestAdmin']);

Route::post('/addrequestadmin', [RequestAdminController::class, 'addRequestAdmin']);

Route::get('/listrequestadmin/approve/section', [RequestAdminController::class, 'listRequestAdminApproveSection']);

Route::get('/listrequestadmin/approve/sectchief/{fk_request_admin}/{employee_no}', [RequestAdminController::class, 'addApproveRequestAdminSectChief']);

Route::get('/listrequestadmin/approve/sectmanager/{fk_request_admin}/{employee_no}', [RequestAdminController::class, 'addApproveRequestAdminSectManager']);

Route::get('/listrequestadmin/approve/relatesect', [RequestAdminController::class, 'listRequestUserApproveRelatesect']);

Route::get('/listrequestadmin/approve/relatesect/{fk_request_admin}/{employee_no}/{seq}', [RequestAdminController::class, 'addApproveRequestAdminRelateSect']);

Route::get('/listrequestadmin/it', [RequestAdminController::class, 'listRequestAdminIT']);

Route::post('/listrequestadmin/it/assign', [RequestAdminController::class, 'assignRequestAdmin']);

Route::post('/listrequestadmin/it/refuse', [RequestAdminController::class, 'refuseRequestAdmin']);

Route::get('/listrequestadmin/receieved', [RequestAdminController::class, 'listRequestAdminReceieved']);

Route::get('/listrequestadmin/approve', [RequestAdminController::class, 'listRequestAdminApprove']);

Route::get('/listrequestadmin/approve/chief/{request_admin_no}/{user_id}', [RequestAdminController::class, 'addApproveRequestAdminChief']);

Route::get('/listrequestadmin/approve/manager/{request_admin_no}/{user_id}', [RequestAdminController::class, 'addApproveRequestAdminManager']);

Route::post('/listrequestadmin/receieved/update', [RequestAdminController::class, 'updateRequestAdmin']);

Route::get('/editrequestadmin/{no}', [RequestAdminController::class, 'showEditRequestAdmin']);

Route::get('/editrequestadminit/{no}', [RequestAdminController::class, 'showEditRequestAdminIT']);

Route::get('/deleterequestadmin/{no}', [RequestAdminController::class, 'deleteRequestAdmin']);

Route::post('/updaterequestadminit', [RequestAdminController::class, 'editRequestAdminIT']);

Route::post('/updaterequestadmin', [RequestAdminController::class, 'editRequestAdmin']);

Route::get('/listrequestadmin/confirmrequestadmin/{fk_request_admin}/{employee_no}', [RequestAdminController::class, 'addConfirmRequestAdmin']);

Route::get('/listrequestadmin/approve/endcharge/{request_admin_no}/{user_id}', [RequestAdminController::class, 'addApproveEndRequestAdminCharge']);

Route::get('/listrequestadmin/approve/endchief/{request_admin_no}/{user_id}', [RequestAdminController::class, 'addApproveEndRequestAdminChief']);

Route::get('/listrequestadmin/approve/endmanager/{request_admin_no}/{user_id}', [RequestAdminController::class, 'addApproveEndRequestAdminManager']);

Route::get('/pdfrequestadmin/{request_admin_no}', [RequestAdminController::class, 'reportPDFRequestAdmin']);
?>