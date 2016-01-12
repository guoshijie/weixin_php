<?php

namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\Controller;
use App\Service\weixin\AccessTokenService;
use Illuminate\Support\Facades\Log;

class AccessController extends Controller{

    public function getAccessToken(){
        $accessToken = AccessTokenService::getAccessToken();
        Log::info('AccessToken==>'.$accessToken);
    }

}
