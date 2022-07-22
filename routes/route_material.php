<?php

use App\Http\Controllers\MaterialController;

Route::get('listmaterial', [MaterialController::class, 'listMaterial']);

Route::get('listmaterial/search', [MaterialController::class, 'searchMaterial']);

Route::post('addmaterial', [MaterialController::class, 'addMaterial']);

Route::post('editmaterial', [MaterialController::class, 'editMaterial']);

Route::get('deletematerial/{id}', [MaterialController::class, 'deleteMaterial']);

Route::get('liststockmaterial', [MaterialController::class, 'listStockMaterial']);

Route::get('liststockmaterial/search', [MaterialController::class, 'searchStockMaterial']);

Route::post('addstockmaterial', [MaterialController::class, 'addStockMaterial']);

Route::post('editstockmaterial', [MaterialController::class, 'editStockMaterial']);

Route::get('deletestockmaterial/{id}', [MaterialController::class, 'deleteStockMaterial']);

Route::get('listwithdrawmaterial', [MaterialController::class, 'listWithdrawMaterial']);

Route::get('listwithdrawmaterial/search', [MaterialController::class, 'searchWithdrawMaterial']);


Route::post('addwithdrawmaterial', [MaterialController::class, 'addWithdrawMatrial']);

Route::post('editwithdrawmaterial', [MaterialController::class, 'editWithdrawMaterial']);

Route::get('deletewithdrawmaterial/{id}/{id2}', [MaterialController::class, 'deleteWithdrawMaterial']);

Route::get('listdetailwithdrawmaterial/{id}', [MaterialController::class, 'listDetailWithdrawMaterial'])

?>