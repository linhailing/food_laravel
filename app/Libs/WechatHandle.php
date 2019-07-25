<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2019/7/25
 * Time: 10:04 AM
 */

namespace App\Libs;

//微信公共处理类
class WechatHandle{
    public $config;
    public function __construct(){
        $this->config = $GLOBALS['mina_app'];
    }
    public function getWeChatOpenId($code=''){
        if (empty($code)) return '';
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$this->config['appid']."&secret=".$this->config['appkey']."&js_code=".$code."&grant_type=authorization_code";
        $result = Util::curl($url);
        if (empty($result)) return '';
        $result = json_decode($result, true);
        if (empty($result)) return '';
        if (isset($result['openid']) && !empty($result['openid'])) return $result['openid'];
        return '';
    }
}