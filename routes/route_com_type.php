<?php
use App\Http\Controllers\ComtypeController;

Route::get('listcomtype', [ComtypeController::class, 'listComtype']);

Route::post('addcomtype', [ComtypeController::class, 'addComtype']);

Route::post('editcomtype', [ComtypeController::class, 'editComtype']);

Route::get('deletecomtype/{id}', [ComtypeController::class, 'deleteComtype']);

?>