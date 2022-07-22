<?php

use App\Http\Controllers\NotifyrepairController;

Route::get('notifyrepair', [NotifyrepairController::class, 'notifyRepair']);

Route::post('addnotifyrepair', [NotifyrepairController::class, 'addNotifyRepair']);

Route::get('listnotifyrepair', [NotifyrepairController::class, 'listNotifyRepair']);

Route::get('recievenotifyrepair', [NotifyrepairController::class, 'recieveNotifyRepair']);

Route::get('addrecievenotifyrepair/{status}/{noti_repair_no}', [NotifyrepairController::class, 'addReceiveNotifyRepair']);

Route::post('editnotifyrepair', [NotifyrepairController::class, 'editNotifyRepair']);

Route::post('updatenotifyrepair', [NotifyrepairController::class, 'updateNotifyrepair']);

Route::get('tracknotifyrepair', [NotifyrepairController::class, 'trackNotifyRepair']);

Route::post('updatesignature', [NotifyrepairController::class, 'updateSignature']);

Route::get('deletenotifyrepair/{id}', [NotifyrepairController::class, 'deleteNotifyrepair']);

Route::get('showsign/{id}', [NotifyrepairController::class, 'showSign']);

?>