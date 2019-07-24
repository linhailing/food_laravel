<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2019/7/22
 * Time: 9:16 AM
 */

namespace App\Http\Controllers\Api;


use App\Libs\Util;
use App\Libs\WeChatPay;
use App\Models\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends ApiController{
    public function info(Request $request){
        $uid = $this->uid ?? 0;
        $type = $this->req('type', '');
        $foods = $request->get('foods', '');
        if (empty($type) || empty($foods)) return $this->error('参数错误', 210);
        $foods = json_decode($foods, true);
        //获取
        $food_ids = [];
        foreach ($foods as $item) {
            $food_ids[$item['food_id']] = $item['number'];
        }
        $food_id = array_keys($food_ids);
        $data_food = Model::Food()->getFoodByInId($food_id);
        if (count($data_food) <= 0) return $this->error('参数错误', 210);
        $yun_price = $pay_price = 0.00;
        $data_food_list = [];
        foreach ($data_food as $key=>$item) {
            $data_food_list[$key] = [
                "id"=>$item->id,
				"name"=> $item->name,
				"price"=> floatval($item->price),
				'pic_url'=> $item->main_image,
				'number'=> $food_ids[$item->id]
            ];
            $pay_price += intval($item->price) * intval($food_ids[$item->id]);
        }
        $default_address = [
            'id'=> 1,
            'name'=> "编程浪子",
            'mobile'=> "12345678901",
            'detail'=> "上海市浦东新区XX",
        ];
        $data = [];
        $data['food_list'] = $data_food_list;
        $data['pay_price'] = floatval($pay_price);
        $data['yun_price'] = floatval($yun_price);;
        $data['total_price'] = floatval(intval($yun_price + $pay_price));
        $data['default_address'] = $default_address;
        return $this->json($data);
    }
    //create order
    public function createOrder(Request $request){
        //创建订单
        $uid = $this->uid ?? 0;
        $type = $this->req('type', '');
        $note = $this->req('note', '');
        $yun_price = $this->req('yun_price', 0);
        $express_address_id = $this->req('express_address_id', 0);
        $foods = $request->get('foods','');
        if (empty($type) || empty($foods) || empty($express_address_id)) return $this->error('参数错误', 210);
        $get_foods = json_decode($foods, true);
        if (count($get_foods) <= 0) return $this->error('下单失败：没有选择商品~~', 210);
        $params = [];
        $params['note'] = $note;
        $params['yun_price'] = $yun_price;
        $params['express_address_id'] = $express_address_id;
        $params['express_info'] = [
            'name'=> "编程浪子",
            'mobile'=> "12345678901",
            'detail'=> "上海市浦东新区XX",
        ];
        $resp = $this->_createOrders($uid, $get_foods, $params);
        if ($resp['code'] === 200 and $type=='cart'){
            $del_ids = [];
            foreach ($get_foods as $key=>$item){
                $del_ids[$key] = $item['food_id'];
            }
            Model::Food()->delMemberCartByFoodId($uid, $del_ids);
        }
        if ($resp['code'] === 200){
            return $this->json($resp['results']);
        }
        return $this->error($resp['msg'], $resp['code']);
    }

    private function _createOrders($uid, $foods, $params=[]){
        $pay_price = 0;
        $continue_cnt = 0;//中断次数
        $food_ids = []; //food id
        $result = [
            'status' => 'success',
            'code' => 200,
            'msg'=> '',
            'results' => []
        ];
        foreach ($foods as $key=>$item) {
            if ($item['price'] < 0){
                $continue_cnt += 1;
                continue;
            }
            $pay_price = $pay_price + (intval($item['price']) * intval($item['number']));
            $food_ids[$key] = $item['food_id'];
        }
        if (count($food_ids) <= 0){
            $result['code'] = 210;
            $result['status'] = 'error';
            $result['msg'] = '商品不能为空~~';
            return $result;
        }
        //判断是否改变了商品价格
        if (intval($continue_cnt) >= count($foods)){
            $result['code'] = 210;
            $result['status'] = 'error';
            $result['msg'] = '商品items为空~~';
            return $result;
        }
        $yun_price = isset($params['yun_price']) ? $params['yun_price'] : 0;
        $note = isset($params['note']) ? $params['note'] : '';
        $express_address_id = isset($params['express_address_id']) ? $params['express_address_id'] : 0;
        $express_info = isset($params['express_info']) ? $params['express_info'] : '';
        $total_price = intval($pay_price) + intval($yun_price);
        // 为了防止并发库存出问题了，我们坐下selectfor update, 这里可以给大家演示下
        try{
            DB::beginTransaction();
            $select_foods = Model::Food()->getFoodByInIdsForUpdate($food_ids);
            $tmp_food_stock_mapping = [];
            foreach ($select_foods as $item) {
                $tmp_food_stock_mapping[$item->id] = $item->stock;
            }
            $now_time = DATETIME;
            $order_sn = Util::randOrderID6();
            $insert_pay_order = [];
            $insert_pay_order['member_id'] = $uid;
            $insert_pay_order['order_sn'] = $order_sn;
            $insert_pay_order['total_price'] = number_format($total_price, 2);
            $insert_pay_order['yun_price'] = number_format($yun_price, 2);
            $insert_pay_order['pay_price'] = number_format($pay_price, 2);
            $insert_pay_order['note'] = $note;
            $insert_pay_order['status'] = '-8';
            $insert_pay_order['express_status'] = '-8';
            $insert_pay_order['express_address_id'] = $express_address_id;
            $insert_pay_order['express_info'] = json_encode($express_info, true);
            $insert_pay_order['updated_time'] = $now_time;
            $insert_pay_order['updated_time'] = $now_time;
            $pay_order_id = Model::Food()->insertPayOrder($insert_pay_order);
            if (empty($pay_order_id)){
                throw new \Exception('订单生成失败-1');
            }
            foreach ($foods as $item){
                $tmp_left_stock = $tmp_food_stock_mapping[$item['food_id']];
                if (intval($item['price']) < 0){
                    continue;
                }
                if (intval($item['number']) > intval($tmp_left_stock)){
                    throw new \Exception("您购买的这美食太火爆了，剩余：".$tmp_left_stock.",你购买".$item['number']);
                }
                //减去库存
                $stock = intval($tmp_left_stock) - $item['number'];
                $tmp_ret = Model::Food()->updateFoodStock($item['food_id'], $stock);
                if (!$tmp_ret) {
                    throw new \Exception("下单失败请重新下单");
                }
                $insert_pay_order_item = [];
                $insert_pay_order_item['pay_order_id'] = $pay_order_id;
                $insert_pay_order_item['member_id'] = $uid;
                $insert_pay_order_item['quantity'] = $item['number'];
                $insert_pay_order_item['price'] = $item['price'];
                $insert_pay_order_item['food_id'] = $item['food_id'];
                $insert_pay_order_item['note'] = $note;
                $insert_pay_order_item['updated_time'] = $now_time;
                $insert_pay_order_item['created_time'] = $now_time;
                Model::Food()->insertPayOrderItem($insert_pay_order_item);
            }
            Db::commit();
            $data = [];
            $data['id'] = $pay_order_id;
            $data['order_sn'] = $order_sn;
            $data['total_price'] = $total_price;
            $result['results'] = $data;

        }catch (\Exception $e){
            Db::rollBack();
            Util::writeLog('create_order', $e->getMessage());
            $result['code'] = 210;
            $result['status'] = 'error';
            $result['msg'] = $e->getMessage();
            return $result;
        }
        return $result;
    }

    //订单支付
    public function orderPay(){
        $uid = $this->uid ?? 0;
        $order_sn = $this->req('order_sn', 0);
        if (empty($order_sn)) return $this->error('系统繁忙。请稍后再试~~', 210);
        $orderPay = Model::Food()->getOrderPayByOrderSnUid($uid, $order_sn);
        if (empty($orderPay)) return $this->error('系统繁忙。请稍后再试~~', 210);
        //获取个人oppid
        $notify_url = $GLOBALS['domain_api'] . $GLOBALS['mina_app']['callback_url'];
        //微信支付
        $target_wechat = new WeChatPay();
        $data = [
            'appid' => $GLOBALS['mina_app']['appid'],
            'mch_id'=> $GLOBALS['mina_app']['mch_id'],
            'nonce_str'=> Util::randCode(32),
            'body'=> '订餐',  # 商品描述
            'out_trade_no'=> $orderPay->order_sn,  # 商户订单号
            'total_fee'=> intval( $orderPay->total_price * 100 ),
            'notify_url'=> $notify_url,
            'trade_type'=> "JSAPI",
            'openid'=> '1233455555'
        ];
        $pay_info = $target_wechat->get_pay_info($data);
        if (empty($pay_info)) return $this->error('系统繁忙。请稍后再试~~', 210);
        if ($pay_info['code'] != 200){
            return $this->error($pay_info['msg'], 210);
        }
        return $this->json($pay_info);
    }
    //支付回调
    public function orderCallback(){
        $resp = [
            'return_code'=> 'SUCCESS',
            'return_msg'=> 'OK'
        ];
        $result_data = file_get_contents('php://input');
        $target_wechat = new WeChatPay();
        if (empty($result_data)){
            $resp['return_code'] = $resp['return_msg'] = 'FAIL';
            return $target_wechat->data_to_xml($resp);
        }
        $xmlToArr = $target_wechat->dataFromXml($result_data);
        if (empty($xmlToArr)){
            $resp['return_code'] = $resp['return_msg'] = 'FAIL';
            return $target_wechat->data_to_xml($resp);
        }
        $sign = $xmlToArr['sign'] ?? '';
        //del sign
        unset($xmlToArr['sign']);
        $gene_sign = $target_wechat->create_sign($xmlToArr);
        if ($sign !== $gene_sign){
            $resp['return_code'] = $resp['return_msg'] = 'FAIL';
            return $target_wechat->data_to_xml($resp);
        }
        if (($xmlToArr['return_code'] != 'SUCCESS') || ($xmlToArr['result_code'] != 'SUCCESS') ){
            $resp['return_code'] = $resp['return_msg'] = 'FAIL';
            return $target_wechat->data_to_xml($resp);
        }
        //一下操作修改订单
        dd($xmlToArr);
        return $this->json($resp);
    }
}