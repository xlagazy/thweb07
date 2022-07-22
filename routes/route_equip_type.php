<?php 

use App\Http\Controllers\EquiptypeController;

Route::get('listequiptype', [EquiptypeController::class, 'listEquiptype']);

Route::post('addequiptpye', [EquiptypeController::class, 'addEquiptype']);

Route::post('editequiptype', [EquiptypeController::class, 'editEquiptype']);

Route::get('deleteequiptype/{id}', [EquiptypeController::class, 'deleteEquiptype']);

?>