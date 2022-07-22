<?php

use App\Http\Controllers\SectionController;

Route::get('listsection', [SectionController::class, 'listSection']);

Route::post('addsection', [SectionController::class, 'addSection']);

Route::post('editsection', [SectionController::class, 'editSection']);

Route::get('deletesection/{id}', [SectionController::class, 'deleteSection']);

?>