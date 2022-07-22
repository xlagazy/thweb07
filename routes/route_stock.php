<?php

use App\Http\Controllers\StockController;

Route::get('liststock', [StockController::class, 'listStock']);

Route::post('addstock', [StockController::class, 'addStock']);

Route::post('editstock', [StockController::class, 'editStock']);

Route::get('deletestock/{id}', [StockController::class, 'deleteStock']);

Route::get('liststock/search', [StockController::class, 'searchStock']);

Route::post('exportstock', [StockController::class, 'exportStock']);

Route::get('sourcestock/{id}', [StockController::class, 'sourceStock']);

?>