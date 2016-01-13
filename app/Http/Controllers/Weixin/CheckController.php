<?php

namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * 与微信公众平台对接
 * @author        Steven Guo
 * @version       v1.0
 */
class CheckController extends Controller{

    public $wechatObj;
    const TOKEN = "guoshijie";

    public function __construct(){

    }

    /**
     * 公众账号接入入口
     * @param Request $request
     * @return array|string
     */
    public function valid(Request $request) {
        $reqUrl = $request->fullUrl();
        $method = $request->method();
        Log::info("$method $reqUrl");

        $input = $request->all();
        $signature = $request->input('signature');
        $echoStr = $request->input('echostr');
        $timestamp = $request->input('timestamp');
        $nonce = $request->input('nonce');
        Log::info($input);
        if ($this->checkSignature($signature,$timestamp,$nonce)) {
            Log::info("connect with weixin success");
            if($method == 'GET'){
                return $echoStr;
            }
            $respStr = $this->responseMsg($request);
            return $respStr;
        }else{
            Log::info("connect with weixin failed");
        }
    }

    /**
     * 验签
     * @param $signature
     * @param $timestamp
     * @param $nonce
     * @return bool
     * @throws Exception
     */
    private function checkSignature($signature,$timestamp,$nonce){
        if (!self::TOKEN) {
            throw new Exception('TOKEN is not defined!');
        }
        $tmpArr = array(self::TOKEN, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = sha1(implode($tmpArr));
        Log::info("temStr==>".$tmpStr);
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 回复文本类(text)消息
     * @param Request $request
     * @return null|string
     */
    public function responseMsg(Request $request){
        //获取POST数据包
        $postStr = $request->getContent();
        Log::info($postStr);

        if (!empty($postStr)) {
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            if (!empty($keyword)) {
                $msgType = "text";
                $contentStr = "Welcome to wechat world!";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                Log::info($resultStr);
                return $resultStr;
            } else {
                Log::info("Input something...");
                return null;
            }
        } else {
            Log::info("Post Xml data is null");
            return null;
        }
    }

}
