<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2019/7/23
 * Time: 5:03 PM
 */

namespace App\Libs;


class WeChatPay{
    public  $config = null;
    public function __construct(){
        $this->config = $GLOBALS['mina_app'];
    }
    // 生成签名
    public function create_sign($pay_data = [], $isencode = false){
        /***
        ksort($pay_data);
        $stringA = http_build_query($pay_data);
        $stringSignTemp = $stringA.'&key='.$this->config['paykey'];
        dd($stringSignTemp);
        $sign = strtoupper(md5($stringSignTemp));
        return $sign;
        ***/
        $paramStr = '';
        ksort($pay_data);
        $i = 0;
        foreach ($pay_data as $key => $value) {
            if ($key == 'Signature'){ continue;}
            if ($i == 0){
                $paramStr .= '';
            }else{
                $paramStr .= '&';
            }
            $paramStr .= $key . '=' . ($isencode ? urlencode($value) : $value);
            ++$i;
        }
        $stringSignTemp=$paramStr."&key=".$this->config['paykey'];
        return strtoupper(md5($stringSignTemp));
    }
    // 获取支付信息
    public function get_pay_info($pay_data = []){
        $resp = ['code'=>200, 'msg'=> '操作成功~', 'data'=> []];
        $sign = $this->create_sign($pay_data);
        $pay_data['sign'] = $sign;
        $xml_data = $this->xml_encode($pay_data);
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $r = Util::curlPost($url, $xml_data);
        if (empty($r)){
            $resp['code']=210;
            $resp['msg'] = '请求支付错误';
            return $resp;
        }
        $result = $this->dataFromXml($r);
        if (empty($result)) {
            $resp['code']=210;
            $resp['msg'] = '请求支付错误';
            return $resp;
        }
        if (isset($result['return_code']) && $result['return_code'] == 'FAIL'){
            $resp['code']=210;
            $resp['msg'] = $result['return_msg'];
            return $resp;
        }
        if ((isset($result['return_code']) && $result['return_code'] == 'SUCCESS') && (isset($result['result_code']) && $result['result_code'] == 'FAIL')){
            $resp['code']=210;
            $resp['msg'] = $result['err_code_des'] ?? '系统错误';
            return $resp;
        }
        $pay_sign_data = [];
        $pay_sign_data['appId'] = isset($result['appid']) ? $result['appid'] :'';
        $pay_sign_data['timeStamp'] = "'".TIMESTAMP."'";
        $pay_sign_data['nonceStr'] = isset($result['nonce_str']) ? $result['nonce_str'] :'';
        $pay_sign_data['package'] = isset($result['prepay_id']) ? 'prepay_id='.$result['prepay_id'] :'';
        $pay_sign_data['signType'] = 'MD5';
        $pay_sign = $this->create_sign($pay_sign_data);
        $pay_sign_data['paySign'] = $pay_sign;
        $pay_sign_data['prepay_id'] = isset($result['prepay_id']) ? $result['prepay_id'] :'';
        unset($pay_sign_data['appId']);
        $pay_sign_data['code'] = 200;
        return $pay_sign_data;
    }
    /**
     * XML编码
     * @param mixed $data 数据
     * @param string $encoding 数据编码
     * @param string $root 根节点名
     * @return string
     */
    function xml_encode($data) {
        $xml    = '<xml>';
        $xml   .= $this->data_to_xml($data);
        $xml   .= '</xml>';
        return $xml;
    }

    /**
     * 数据XML编码
     * @param mixed $data 数据
     * @return string
     */
    function data_to_xml($data) {
        $xml = '';
        foreach ($data as $key => $val) {
            is_numeric($key) && $key = "item id=\"$key\"";
            $xml    .=  "<$key>";
            $xml    .=  ( is_array($val) || is_object($val)) ? $this->data_to_xml($val) : $val;
            # list($key, ) = explode(' ', $key);
            $xml    .=  "</$key>";
        }
        return $xml;
    }
    public function dataFromXml($xml){
        //将XML转为array
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $data;
    }
}