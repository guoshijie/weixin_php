<?php
/**
 * 使用curl库之前，可能需要查看一下php.ini是否已经打开了curl扩展
 * Created by PhpStorm.
 * User: Steven Guo
 * Date: 16/1/12
 * Time: 下午8:00
 */
namespace App\Service\common;

use Illuminate\Support\Facades\Log;

class HttpClientService {

    /**
     * curl模拟post请求，使用json格式
     * @param $url
     * @param $param
     * @return mixed
     */
    public static function curlPost($url, $param){
        Log::info($url);
        Log::info($param);
        $param  = json_encode($param);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($param))
        );
        $output = curl_exec($ch);
        Log::info($output);
        curl_close($ch);
        return $output;
    }

    /**
     * curl模拟get请求，使用json格式
     * $param, $url
     * return json
     */
    public static function curlGet($url){
        Log::info($url);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $output = curl_exec($ch);
        curl_close($ch);
        Log::info($output);
        return $output;
    }

}