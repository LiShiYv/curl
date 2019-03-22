<?php
/**
 * Created by PhpStorm.
 * User: 李师雨
 * Date: 2018/12/29
 * Time: 9:17
 */
namespace  App\Http\Controllers\user;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
class User extends Controller{

    public function index(Request $request){
        $current_url ='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $data =[
            'login'=>$request->get('is_login'),
            'current_url'=>urlencode($current_url),
        ];
        return view('home.index',$data);
    }


}