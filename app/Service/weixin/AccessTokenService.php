<?php
/**
 * Created by PhpStorm.
 * User: guoshijie
 * Date: 16/1/12
 * Time: 下午8:23
 */

namespace App\Service\weixin;

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

    }
}