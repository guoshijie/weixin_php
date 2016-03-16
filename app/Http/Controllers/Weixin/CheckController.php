<?php

namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\Controller;
use App\Service\weixin\ResponseMsgService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

/**
 * 与微信公众平台对接
 * @author        Steven Guo
 * @version       v1.0
 */
class CheckController extends Controller{

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
        Log::info($input);
        if ($this->checkSignature($request)) {
            Log::info("connect with weixin success");
            return $method == 'GET'? $request->input('echostr'):$this->switchRespMsg($request);
        }else{
            Log::info("connect with weixin failed");
        }
    }

    /**
     * 验签
     * @param Request $request
     * @return bool
     * @throws Exception
     */
    private function checkSignature(Request $request){
        $signature = $request->input('signature');
        $timestamp = $request->input('timestamp');
        $nonce = $request->input('nonce');
        $token = Config::get('constants.Token');
        if (!$token) {
            throw new Exception('Token is not defined!');
        }
        $tmpArr = array($token, $timestamp, $nonce);
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
     * 根据消息的类型，回复不同内容
     * @param Request $request
     * @return null
     */
    public function switchRespMsg(Request $request){
        //获取POST数据包
        $postStr = $request->getContent();
        Log::info($postStr);

        if (!empty($postStr)) {
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $msgType = $postObj->MsgType;
            $content = trim($postObj->Content);
            if($msgType=="text"){
                return ResponseMsgService::responseTextMsg($fromUsername,$toUsername,$content);
            }
            if($msgType=="event"){
                $event = $postObj->Event;
                Log::info("====event===".$event);
                if($event=="subscribe"){
                    $respStr = "您好,我是郭世杰，欢迎关注我的微信个人公众号";
                    return ResponseMsgService::responseTextMsg($fromUsername,$toUsername,$respStr);
                }
                if($event=="CLICK"){
                    $eventKey = $postObj->EventKey;
                    return $this->responseMenuMsg($fromUsername, $toUsername, $eventKey);
                }
            }
            return null;
        } else {
            Log::info("Post Xml data is null");
            return null;
        }
    }

    //根据点击不同的菜单，回复不同消息
    public function responseMenuMsg($fromUsername, $toUsername, $eventKey){
        if($eventKey == "me"){
            $respStr = "Hello, 我是郭世杰，2年JAVA开发经验。";
            return ResponseMsgService::responseTextMsg($fromUsername,$toUsername,$respStr);
        }else{
            $respStr = "暂未设置，请尝试其它菜单";
            return ResponseMsgService::responseTextMsg($fromUsername,$toUsername,$respStr);
        }
        return null;
    }

}
