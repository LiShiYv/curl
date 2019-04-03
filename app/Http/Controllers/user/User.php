<?php
/**
 * Created by PhpStorm.
 * User: 李师雨
 * Date: 2018/12/29
 * Time: 9:17
 */
namespace  App\Http\Controllers\user;
use Illuminate\Http\Request;
use App\Model\Cmsmodel;
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
    public function center(Request $request){
        $where=[
            'is_del'=>1,
        ];
        $res=Cmsmodel::where($where)->get();
        //print_r($res);
        $data=[
            'res'=>$res
        ];
        return view('home.user',$data);
    }
    public function quit(Request $request){
      $request->session()->pull('id',null);
        $request->session()->pull('u_name',null);
        $request->session()->pull('u_token',null);
        Cmsmodel::where(['id'=>$_COOKIE['id']])->update(['is_login'=>0]);
        echo '已退出';
    header('Refresh:2;url=/mvc/test1');
        
        
    }

}