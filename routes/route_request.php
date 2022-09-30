<?php 

use App\Http\Controllers\RequestController;
use App\Http\Controllers\RequestAppController;

Route::get('/userloginrequest', [RequestController::class, 'userLoginRequest']);

Route::post('/loginrequest', [RequestController::class, 'loginRequest']);

Route::get('/logoutrequest', [RequestController::class, 'logoutRequest']);

Route::get('/indexrequest', [RequestController::class, 'indexRequest']);

Route::post('/profilerequest', [RequestController::class, 'profileRequest']);

Route::get('/updateuserprofilead', [RequestController::class, 'updateUserProfileAD']);

//route request application 

Route::post('/addrequestapp', [RequestAppController::class, 'addRequestApp']);

Route::get('/listrequestapp/user', [RequestAppController::class, 'listRequestAppUser']);

Route::get('/listrequestapp/approvechiefuser/{id}/{employee_no}', [RequestAppController::class, 'addApproveChiefUser']);

?>