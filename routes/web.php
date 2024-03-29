<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SignatureController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\QueryController;

//show
    Route::get('/show', function () { 
        return view('show'); 
    });
//

//monitors
Route::get('/network-monitor', function(){
    return view('monitors.network_monitor');
});

//error ie
Route::get('/errorie', function(){
    return view('error_ie');
});
//

//as400 query
Route::get('/query', [QueryController::class, 'queryData']);

//test
Route::get('/test', [Controller::class, 'test']);

Route::get('/testftp', [Controller::class, 'testftp']);

Route::get('/as400', function(){
    return view('as400_status');
});

//login-logout

include "route_login.php";

//user

include "route_user.php";

//equipment

include "route_equipment.php";

//other equipment

include "route_other_equipment.php";

//vendor

include "route_vendor.php";

//section

include "route_section.php";

//department

include "route_department.php";

//OS

include "route_os.php";

//equiptype

include "route_equip_type.php";

//stock

include "route_stock.php";

//material

include "route_material.php";

//borrow

include "route_borrow.php";

//software

include "route_software.php";


//notify repair

include "route_notify_repair.php";

//com type

include "route_com_type.php";

//ftp

include "route_ftp.php";

//request system

include "route_request.php";

//request user

include "route_request_user.php";

//request user

include "route_request_admin.php";

//planet press

include "route_planetpress.php";