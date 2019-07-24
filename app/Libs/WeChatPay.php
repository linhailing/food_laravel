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
    public function create_sign($pay_data = []){
        ksort($pay_data);
        $stringA = http_build_query($pay_data);
        $stringSignTemp = $stringA.'&key='.$this->config['paykey'];
        $sign = strtoupper(md5($stringSignTemp));
        return $sign;
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
        if ((isset($result['return_code']) && $result['return_code'] == 'SUCCESS') && (isset($result['result_code']) && $result['result_code'] == 'SUCCESS')){
            return $result;
        }
        $resp['code']=210;
        $resp['msg'] = '其他错误';
        return $resp;
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