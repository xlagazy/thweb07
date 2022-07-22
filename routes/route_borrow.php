<?php 

use App\Http\Controllers\BorrowController;

Route::get('listborrow', [BorrowController::class, 'listBorrow']);

Route::post('addborrow', [BorrowController::class, 'addBorrow']);

Route::post('editborrow', [BorrowController::class, 'editBorrow']);

Route::get('deleteborrow/{id}&{st}&{no}', [BorrowController::class, 'deleteBorrow']);

Route::get('searchborrow', [BorrowController::class, 'searchBorrow']);

Route::post('exportborrow', [BorrowController::class, 'exportBorrow']);

Route::get('showeditborrow/{id}', [BorrowController::class, 'showEditBorrow']);

?>