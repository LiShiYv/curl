<?php
namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redis;
use GuzzleHttp;
use Illuminate\Support\Facades\Storage;

class weixinJsController extends Controller
{
    protected $redis_weixin_access_token = 'str:weixin_access_token';
    public function form(){
        return view('weixin.form');
    }
    /**
 * 创建服务号菜单
 */
    public function forms(Request $request){
        $bst1=$request->input('bst1');
        $logs=$request->input('logs');
        $userk=$request->input('userk');
        $op=$request->input('op');
        $urls=$request->input('urls');

            //echo __METHOD__;
            // 1 获取access_token 拼接请求接口
            $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->getWXAccessToken();
            //echo $url;echo '</br>';

            //2 请求微信接口
            $client = new GuzzleHttp\Client(['base_uri' => $url]);

            $data = [
                "button"    => [
                    [
                        "name"=>$bst1,
                        "sub_button"=>[
                            [
                                "type"  => $op,      // view类型 跳转指定 URL
                                "name"  => $logs,
                                "url"   => $urls

                            ],

                     ]
                        ],
                    ]
            ];
            $body = json_encode($data,JSON_UNESCAPED_UNICODE);      //处理中文编码
            $r = $client->request('POST', $url, [
                'body' => $body
            ]);

            // 3 解析微信接口返回信息

            $response_arr = json_decode($r->getBody(),true);
            echo '<pre>';print_r($response_arr);echo '</pre>';

            if($response_arr['errcode'] == 0){
                echo "菜单创建成功";
            }else{
                echo "菜单创建失败，请重试";echo '</br>';
                echo $response_arr['errmsg'];

            }



        }

    public function getWXAccessToken()
    {

        //获取缓存
        $token = Redis::get($this->redis_weixin_access_token);
        if(!$token){        // 无缓存 请求微信接口
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WEIXIN_APPID').'&secret='.env('WEIXIN_APPSECRET');
            $data = json_decode(file_get_contents($url),true);

            //记录缓存
            $token = $data['access_token'];
            Redis::set($this->redis_weixin_access_token,$token);
            Redis::setTimeout($this->redis_weixin_access_token,3600);
        }
        return $token;

    }
    // 刷新access_token

    public function refreshToken()
    {
        Redis::del($this->redis_weixin_access_token);
        echo $this->getWXAccessToken();
    }


}
