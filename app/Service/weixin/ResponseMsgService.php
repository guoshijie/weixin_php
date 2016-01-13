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

class ResponseMsgService {


    /**
     * 回复文本类(text)消息
     * @param $fromUsername
     * @param $toUsername
     * @param $contentStr
     * @return null|string
     */
    public static function responseTextMsg($fromUsername,$toUsername,$contentStr){
        $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
        if (!empty($contentStr)) {
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), "text", $contentStr);
            Log::info($resultStr);
            return $resultStr;
        } else {
            Log::info("Input something...");
            return null;
        }
    }

}