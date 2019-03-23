<?php
/**
 * Created by PhpStorm.
 * User: 李师雨
 * Date: 2019/3/18
 * Time: 10:04
 */
namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;
class Login extends Controller
{
    public function index(){
   $u_name=$_POST['u_name'];
   $u_pwd=$_POST['u_pwd'];
        $data=[
            'u_name'=>$u_name,
            'u_pwd'=>$u_pwd
        ];
        //var_dump($data);die;
        //var_dump($sign);die;
         //初始化
         $url ="http://lsy.52self.cn/login";
     $curl = curl_init();
    //设置抓取的url
      curl_setopt($curl, CURLOPT_URL, $url);
     //设置头文件的信息作为数据流输出
      curl_setopt($curl, CURLOPT_HEADER, 0);
      //设置获取的信息以文件流的形式返回，而不是直接输出。
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
     //设置post方式提交
     curl_setopt($curl, CURLOPT_POST, 1);
     curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
     //执行命令
     $r = curl_exec($curl);
     $re=json_decode($r,true);
     //print_r($re);die;
return $re;
    }
    public function reg(){
        $u_name=$_POST['u_name'];
         $u_pwd=$_POST['u_pwd'];
         $u_pwd1=$_POST['u_pwd1'];
         $u_email=$_POST['u_email'];
        $data1=[
            'u_name'=>$u_name,
            'u_pwd'=>$u_pwd,
            'u_pwd1'=>$u_pwd1,
            'u_email'=>$u_email
        ];
        //var_dump($data);die;
        //var_dump($sign);die;
         //初始化
         $url ="http://lsy.52self.cn/reg";
     $curl = curl_init();
    //设置抓取的url
      curl_setopt($curl, CURLOPT_URL, $url);
     //设置头文件的信息作为数据流输出
      curl_setopt($curl, CURLOPT_HEADER, 0);
      //设置获取的信息以文件流的形式返回，而不是直接输出。
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
     //设置post方式提交
     curl_setopt($curl, CURLOPT_POST, 1);
     curl_setopt($curl, CURLOPT_POSTFIELDS, $data1);
     //执行命令
     $r2 = curl_exec($curl);
     $re2=json_decode($r2,true);
     //print_r($re2);die;
return $re2;
 }

public function center(Request $request){
    $token=$request->input('token');
    $id=$request->input('id');
    $data=[
        'id'=>$id,
        'token'=>$token
    ];
    if(empty($data)){
        $response=[
            'errno'=>4001,
            'msg'=>'请先登录'
        ];
    }else{
        $redis_key_web_token='str:u:token:'.$id;
        Redis::hGet($redis_key_web_token,'app');
        if($token==$redis_key_web_token){
           $response=[
            'errno'=>0,
            'msg'=>'ok'

        ];  
        }else{
            $response=[
                'errno'=>4001,
                'msg'=>'请先登录'
            ];

        }
       
    }
    
    return $response;
    
}
}