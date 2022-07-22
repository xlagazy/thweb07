<?php 

use App\Http\Controllers\OsController;

Route::get('listos', [OsController::class, 'listOs']);

Route::post('addos', [OsController::class, 'addOs']);

Route::post('editos', [OsController::class, 'editOs']);

Route::get('deleteos/{id}', [OsController::class, 'deleteOs']);

?>