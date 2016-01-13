<?php
/**
 * Created by PhpStorm.
 * User: guoshijie
 * Date: 16/1/12
 * Time: 下午8:23
 */

namespace App\Service\weixin;

use App\Service\common\HttpClientService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class AccessTokenService {

    /**
     * 获取AccessToken
     */
    public static function getAccessToken(){
        $appId = Config::get('constants.AppID');
        $appSecret = Config::get('constants.AppSecret');
        $AccessTokenUrl = Config::get('constants.AccessTokenUrl');
        Log::info('AppId:'.$appId);
        Log::info('AppSecret:'.$appSecret);
        $url = $AccessTokenUrl."?grant_type=client_credential&appid=$appId&secret=$appSecret";
        $res = HttpClientService::curlGet($url);
        Log::info('Result:'.$res);
        $resObj = json_decode($res);
        $accessToken = $resObj->access_token;
        return $accessToken;
    }
}