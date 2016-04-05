<?php
/**
 * 自定义菜单
 * User: guoshijie
 * Date: 16/1/12
 * Time: 下午8:23
 */

namespace App\Service\weixin;

use App\Service\common\HttpClientService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class MenuService {

    /**
     * 创建自定义菜单
     */
    public function createMenu(){
        $menuJson = $this->generateMenu();
        $accessToken = AccessTokenService::getAccessToken();

        $url = Config::get('constants.CreateMenuUrl');
        $url = $url."?access_token=".$accessToken;
        $res = HttpClientService::curlPost($url,$menuJson,true);
        Log::info($res);
        return $res;
    }

    /**
     * 查询自定义菜单
     */
    public function getMenu(){
        //GetMenuUrl
        $accessToken = AccessTokenService::getAccessToken();
        $url = Config::get('constants.GetMenuUrl');
        $url = $url."?access_token=".$accessToken;
        $res = HttpClientService::curlGet($url);
        return $res;
    }

    /**
     * 自定义菜单内容
     */
    public function generateMenu(){
        $appid = Config::get('constants.AppID');
        $scope = 'snsapi_base';
        $state = 'gsj';
        $redirect_uri = urlencode('http://weixin.duobaohui.com/');
        $index_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=$scope&state=$state#wechat_redirect";
        $arr = array(
            'button' =>array(
                array(
                    'name'=>urlencode("个人作品"),
                    'sub_button'=>array(
                        array(
                            'name'=>urlencode("拾谷网"),
                            'type'=>'view',
                            'key'=>'VCX_WEATHER',
                            'url'=>$index_url
                        ),
                        array(
                            'name'=>urlencode("夺宝会"),
                            'type'=>'click',
                            'key'=>'VCX_IDENT'
                        )
                    )
                ),
                array(
                    'name'=>urlencode("轻松娱乐"),
                    'sub_button'=>array(
                        array(
                            'name'=>urlencode("刮刮乐"),
                            'type'=>'click',
                            'key'=>'VCX_GUAHAPPY'
                        ),
                        array(
                            'name'=>urlencode("幸运大转盘"),
                            'type'=>'click',
                            'key'=>'VCX_LUCKPAN'
                        )
                    )
                ),
                array(
                    'name'=>urlencode("我的信息"),
                    'sub_button'=>array(
                        array(
                            'name'=>urlencode("关于我"),
                            'type'=>'click',
                            'key'=>'me'
                        ),
                        array(
                            'name'=>urlencode("工作信息"),
                            'type'=>'click',
                            'key'=>'VCX_JOBINFORMATION'
                        )
                    )
                )
            )
        );
//        $jsondata = urldecode(json_encode($arr));
        $jsondata = urldecode(json_encode($this->getShiguMenuArray($index_url)));
        return $jsondata;
    }

    public function getShiguMenuArray($index_url){
        $arr = array(
            'button' =>array(
                array(
                    'name'=>urlencode("易成交"),
                    'type'=>'view',
                    'key'=>'VCX_WEATHER',
                    'url'=>$index_url
//                    'sub_button'=>array(
//                        array(
//                            'name'=>urlencode("拾谷网"),
//                            'type'=>'view',
//                            'key'=>'VCX_WEATHER',
//                            'url'=>$index_url
//                        ),
//                        array(
//                            'name'=>urlencode("夺宝会"),
//                            'type'=>'click',
//                            'key'=>'VCX_IDENT'
//                        )
//                    )
                ),
//                array(
//                    'name'=>urlencode("产品介绍"),
//                    'sub_button'=>array(
//                        array(
//                            'name'=>urlencode("食材链"),
//                            'type'=>'click',
//                            'key'=>'VCX_GUAHAPPY'
//                        ),
//                        array(
//                            'name'=>urlencode("夺宝会"),
//                            'type'=>'click',
//                            'key'=>'VCX_LUCKPAN'
//                        )
//                    )
//                ),
//                array(
//                    'name'=>urlencode("关于我们"),
//                    'sub_button'=>array(
//                        array(
//                            'name'=>urlencode("联系我们"),
//                            'type'=>'click',
//                            'key'=>'me'
//                        ),
//                        array(
//                            'name'=>urlencode("企业文化"),
//                            'type'=>'click',
//                            'key'=>'VCX_JOBINFORMATION'
//                        )
//                    )
//                )
            )
        );

        return $arr;
    }

}