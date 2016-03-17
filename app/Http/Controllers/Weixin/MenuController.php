<?php

namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\Controller;
use App\Service\weixin\AccessTokenService;
use App\Service\weixin\MenuService;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller{

    private $menuService;

    public function __construct(){
        $this->menuService = new MenuService();
    }

    /**
     * 创建自定义菜单
     * @return mixed
     */
    public function createMenu(){
        $res = $this->menuService->createMenu();
        return response($res)->header('Content-Type', 'JSON');
    }

}
