<?php

use App\Http\Controllers\OtherEquipmentController;


Route::get('/listotherequipment', [OtherEquipmentController::class, 'listotherequipment']);

Route::get('/listotherequipment/search', [OtherEquipmentController::class, 'searchotherequipment']);

Route::get('/test2', [OtherEquipmentController::class, 'otherEquipNumber']);

Route::post('/addotherequipment', [OtherEquipmentController::class, 'addOtherEquipment']);

Route::get('/deleteotherequipment/{id}', [OtherEquipmentController::class, 'deleteOtherEquipment']);

Route::get('/showeditotherequipment/{id}', [OtherEquipmentController::class, 'showEditOtherEquipment']);

Route::post('/editotherequipment', [OtherEquipmentController::class, 'editOtherEquipment']);

?>