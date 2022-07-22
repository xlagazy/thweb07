<?php 

use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\MailsendController;


Route::get('listsoftware', [SoftwareController::class, 'listSoftware']);

Route::post('addsoftware', [SoftwareController::class, 'addSoftware']);

Route::post('editsoftware', [SoftwareController::class, 'editSoftware']);

Route::get('deletesoftware/{id}', [SoftwareController::class, 'deleteSoftware']);

Route::get('expiresoftwaremail', [MailsendController::class, 'sendExpireSoftwareMail']);

Route::get('exportsoftware', [SoftwareController::class, 'exportSoftware']);


?>