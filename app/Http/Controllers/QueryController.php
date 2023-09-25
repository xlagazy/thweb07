<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QueryController extends Controller
{
    function queryData(){
        
        $url = "http://10.230.1.32:10010/web/services/MSEC01P";
        $json = file_get_contents($url);
        $data = json_decode($json);

        return view('query', ['data' => $data]);
        
    }
}
