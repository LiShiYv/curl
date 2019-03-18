<?php
/**
 * Created by PhpStorm.
 * User: 李师雨
 * Date: 2019/3/18
 * Time: 10:04
 */
namespace App\Http\Controllers\md5;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
class Mds extends Controller
{
    public function mds(){
        $url ="http://laraapi.com/user?t=".time();
        $str="hello";
        $key='pass';
        $time=time();
        $api='AES-128-CBC';
        $argc=OPENSSL_RAW_DATA;
        $salt='sssss';
        $iv=substr(md5($time.$salt),5,16);
        $json=json_encode($str);
        $enc_str=openssl_encrypt($json,$api,$key,$argc,$iv);
        $post_data=base64_encode($enc_str);
         //初始化
     $curl = curl_init();
    //设置抓取的url
      curl_setopt($curl, CURLOPT_URL, $url);
     //设置头文件的信息作为数据流输出
      curl_setopt($curl, CURLOPT_HEADER, 0);
      //设置获取的信息以文件流的形式返回，而不是直接输出。
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
     //设置post方式提交
     curl_setopt($curl, CURLOPT_POST, 1);
     curl_setopt($curl, CURLOPT_POSTFIELDS, ['data'=>$post_data]);
     //执行命令
     $data = curl_exec($curl);
    print_r($data);die;
    $response=json_encode($data,true);
    $iv2=substr(md5($response['t'].$salt),5,16);
    $dec_data=openssl_decrypt(base64_decode($response['data']),$api,$key,OPENSSL_RAW_DATA,$iv2);
    var_dump($dec_data);
    }


}