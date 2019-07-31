<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2019/7/19
 * Time: 10:10 AM
 */

namespace App\Http\Controllers\Api;


use App\Libs\Util;
use App\Libs\WechatHandle;
use App\Libs\WeChatPay;
use App\Models\Model;

class MemberController extends ApiController{
    public function index(){
        if($this->checkLogin()) return $this->checkLogin();
        $member = Model::Member()->getMemberById($this->uid);
        return $this->json(['member'=>$member]);
    }
    // 用户分享页面
    public function share(){
        $uid = $this->uid ?? 0;
        $url = $this->req('url', '');
        $data = [];
        $data['member_id'] = $uid;
        $data['share_url'] = $url;
        if (Model::Food()->insertMemberShare($data)){
            return $this->json([],'分享成功');
        }
        return $this->error('分享失败', 201);
    }
    public function orderList(){
        $uid = $this->uid ?? 0;
        $status = $this->req('status', 0);
        $pay_status = 0;
        $express_status = 0;
        $comment_status = 0;
        if ($status == -8){  // 等待付款
            $pay_status = $status;
            $express_status = $status;
        }elseif ($status == -7){ // 待发货
            $pay_status = 1;
            $express_status = -7;
        }elseif ($status == -6){ // 待确认
            $pay_status = 1;
            $express_status = -6;
        }elseif ($status == -5){ // 待评价
            $pay_status = 1;
            $express_status = 1;

        }elseif ($status == 1){ // 已完成
            $pay_status = 1;
            $express_status = 1;
            $comment_status = 1;
        }else{
            $pay_status = 0;
        }
        $pay_orders = Model::Food()->getPayOrderByStatus($uid, $pay_status,$express_status,$comment_status);
        $pay_order_ids = [];
        $order_list = [];
        foreach ($pay_orders as $key=>$item) {
            $pay_order_ids[] = $item->id;
            $order_list[$key] = [
                'id'=> $item->id,
                'status'=> $status,
                'status_desc'=> $GLOBALS['pay_status'][$status],
                'date'=> $item->created_time,
                'order_number'=> $item->order_sn,
                'order_sn'=> $item->order_sn,
                'note' => $item->note,
                'total_price'=> $item->total_price,
                'goods_list'=> []
            ];
        }
        $pay_order_items = Model::Food()->getPayOrderItemFoodByOrderIds($pay_order_ids);
        $tmp_order_item = [];
        if (!empty($pay_order_items)){
            foreach ($pay_order_items as $key=>$item) {
                $tmp_order_item[$item->pay_order_id][] = [
                    'pic_url' => $item->main_image
                ];
            }
        }
        //合并数组
        foreach ($order_list as &$item) {
            if (isset($tmp_order_item[$item['id']])){
                $item['goods_list'] = $tmp_order_item[$item['id']];
            }
        }
        return $this->json(['order_list'=>$order_list]);
    }
    //用户登录
    public function memberLogin(){
        $code = $this->req('code', '');
        if (empty($code)) return $this->error('需要code', 210);
        //通过code获取用户openid
        $wechatHandle = new WechatHandle();
        $openid = $wechatHandle->getWeChatOpenId($code);
        if (empty($openid)) return $this->error('调用微信出错', 210);
        $nickName = $this->req('nickName', '');
        $gender = $this->req('gender', '');
        $avatarUrl = $this->req('avatarUrl', '');
        if (empty($nickName) || empty($gender) || empty($avatarUrl)) return $this->error('调用微信出错', 210);
        $member = [];
        $member['nickname'] = $nickName;
        $member['sex'] = $gender;
        $member['avatar'] = $avatarUrl;
        $result = Model::Member()->checkMemberOrUpdateMember($member, $openid);
        if (empty($result)) return $this->error('调用微信出错', 210);
        $token = Util::makePkey($result->id,time(), $result->salt);
        $data = ['token'=>$token];
        return $this->json($data);
    }
    //检查用户是否注册
    public function memberCheckReg(){
        $code = $this->req('code', '');
        if (empty($code)) return $this->error('需要code', 210);
        //通过code获取用户openid
        $wechatHandle = new WechatHandle();
        $openid = $wechatHandle->getWeChatOpenId($code);
        if (empty($openid)) return $this->error('调用微信出错', 210);
        $bind_info = Model::Member()->getOauthMemberBindByOpenId($openid);
        if (empty($bind_info)) return $this->error('未绑定', 210);
        $member_info = Model::Member()->getMemberById($bind_info->member_id);
        if (empty($member_info)) return $this->error('未查询到绑定信息',210);
        $token = Util::makePkey($member_info->id, time(), $member_info->salt);
        return $this->json(['token'=>$token]);
    }
}