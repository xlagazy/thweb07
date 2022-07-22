<?php

use App\Http\Controllers\DepartController;

Route::get('listdepartment', [DepartController::class, 'listDepartment']);

Route::post('adddepartment', [DepartController::class, 'addDepartment']);

Route::post('editdepartment', [DepartController::class, 'editDepartment']);

Route::get('deletedepartment/{id}', [DepartController::class, 'deleteDepartment']);

?>