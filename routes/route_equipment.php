<?php

use App\Http\Controllers\EquipmentController;

Route::get('listequipment', [EquipmentController::class, 'listEquipment']);

Route::get('listequipment/search', [EquipmentController::class, 'searchEquipment']);

Route::post('addequipment', [EquipmentController::class, 'addEquipment']);

Route::get('showeditequipment/{id}', [EquipmentController::class, 'showEditEquipment']);

Route::post('editequipment', [EquipmentController::class, 'editEquipment']);

Route::get('deletequipment/{id}', [EquipmentController::class, 'deleteEquipment']);

Route::post('exportequipment', [EquipmentController::class, 'exportEquipment']);

Route::get('sourceequipment/{id}', [EquipmentController::class, 'sourceEquipment']);


?>