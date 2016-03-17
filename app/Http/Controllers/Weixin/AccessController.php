<?php

namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\Controller;
use App\Service\weixin\AccessTokenService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AccessController extends Controller{

    public function getAccessToken(){
        $accessToken = AccessTokenService::getAccessToken();
        Log::info('AccessToken==>'.$accessToken);
    }

    /**
     * 通过code换取网页授权access_token
     * {
     *  "access_token": "OezXcEiiBSKSxW0eoylIeLbTirX__QgA7uW8WJE0Z2izAbnXV7DHbdHni-j9OoCq2Xqh5gLlPt0uAHtfYByOH80h1dwMrq74iALd_K359JYEN5KWKB7_sEz3T19V86sP9lSO5ZGbc-qoXUD3XZjEPw",
     *  "expires_in": 7200,
     *  "refresh_token": "OezXcEiiBSKSxW0eoylIeLbTirX__QgA7uW8WJE0Z2izAbnXV7DHbdHni-j9OoCqgBFR_ApctbH4Tk5buv8Rr3zb7T3_27zZXWIdJrmbGFoFzGUfOvnwX249iPoeNJ2HYDbzW5sEfZHkC5zS4Qr8ug",
     *  "openid": "oMzBIuI7ctx3n-kZZiixjchzBKLw",
     *  "scope": "snsapi_base"
     * }
     **/
    public function getOAuth2AccessToken(Request $request){
        $code = $request->input('code');
        $res = AccessTokenService::getOAuth2AccessToken($code);
        Log::info($res);
        return response($res)->header('Content-Type', 'JSON');
    }

}
