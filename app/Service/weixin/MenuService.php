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
     * 自定义菜单内容
     */
    public function generateMenu(){
        $arr = array(
            'button' =>array(
                array(
                    'name'=>urlencode("个人作品"),
                    'sub_button'=>array(
                        array(
                            'name'=>urlencode("拾谷网"),
                            'type'=>'view',
                            'key'=>'VCX_WEATHER',
                            'url'=>'http://edumgmt.duobaohui.com:3001/'
                        ),
                        array(
                            'name'=>urlencode("身份证查询"),
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
                            'key'=>'VCX_ABOUTME'
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
        $jsondata = urldecode(json_encode($arr));
        return $jsondata;
    }

}