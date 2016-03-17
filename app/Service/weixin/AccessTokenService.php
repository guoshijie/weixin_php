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
        $resObj = json_decode($res);
        $accessToken = $resObj->access_token;
        return $accessToken;
    }

    /**
     * 通过code换取网页授权access_token
     * getOAuth2AccessToken
     * @param $code
     * @return mixed
     */
    public static function getOAuth2AccessToken($code){
        $appId = Config::get('constants.AppID');
        $appSecret = Config::get('constants.AppSecret');
        $url = Config::get('constants.OAuth2AccessTokenUrl');
        $url = $url."?appid=$appId&secret=$appSecret&code=$code&grant_type=authorization_code";
        $res = HttpClientService::curlGet($url);
        return $res;
    }
}