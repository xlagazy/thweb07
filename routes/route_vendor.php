<?php

use App\Http\Controllers\VendorController;

Route::get('listvendor', [VendorController::class, 'listVendor']);

Route::post('addvendor', [VendorController::class, 'addVendor']);

Route::post('editvendor', [VendorController::class, 'editVendor']);

Route::get('deletevendor/{id}', [VendorController::class, 'deleteVendor']);

?>