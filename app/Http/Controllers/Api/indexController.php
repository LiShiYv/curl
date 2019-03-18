<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
class indexController extends Controller
{
    //
    public function test1(){
        $url= 'http://api.com/index.php?type=2';
        $client = new Client();
        $response = $client->request('GET',$url);
        echo $response->getBody();
    }
}
