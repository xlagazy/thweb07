<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckListController;


Route::get('/', [UserController::class, 'home']);

Route::get('/organization', [UserController::class, 'organization']);

Route::get('/listuser', [UserController::class, 'listUser']);

Route::post('/adduser', [UserController::class, 'addUser']);

Route::get('/showedituser/{id}', [UserController::class, 'showEditUser']);

Route::post('/edituser', [UserController::class, 'editUser']);

Route::get('/deleteuser/{id}', [UserController::class, 'deleteUser']);

Route::get('/checklist', [CheckListController::class, 'checkList']);

Route::post('addchecklist', [CheckListController::class, 'addCheckList']);

Route::get('/showeditchecklist', [CheckListController::class, 'showEditChecklist']);

Route::post('/filterchecklist', [CheckListController::class, 'filterChecklist']);

Route::post('/editchecklist', [CheckListController::class, 'editChecklist']);

Route::get('/checklisteveryday', [CheckListController::class, 'checkEveryDay']);


?>