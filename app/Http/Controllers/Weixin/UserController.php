<?php

namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\Controller;
use App\Service\weixin\AccessTokenService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class UserController extends Controller{

    /**
     * 拉取用户信息(需scope为 snsapi_userinfo)
     */
    public function getUserInfo(){
        $accessToken = AccessTokenService::getAccessToken();
        Log::info('AccessToken==>'.$accessToken);
    }


}
