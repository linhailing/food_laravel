<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2019/7/19
 * Time: 10:10 AM
 */

namespace App\Http\Controllers\Api;


use App\Models\Model;

class MemberController extends ApiController{
    // 用户分享页面
    public function share(){
        $uid = $this->uid;
        $url = $this->req('url', '');
        $data = [];
        $data['member_id'] = $uid;
        $data['share_url'] = $url;
        if (Model::Food()->insertMemberShare($data)){
            return $this->json([],'分享成功');
        }
        return $this->error('分享失败', 201);
    }
    public function member_cart_list(){
        $uid = $this->uid ?? 1;
        $carts = Model::Food()->getMemberCartFood($uid);
        $cart_list = [];
        if ($carts){
            foreach ($carts as $key=>$item){
                $cart_list[$key]['id'] = $item->id;
                $cart_list[$key]['food_id'] = $item->food_id;
                $cart_list[$key]['pic_url'] = $item->main_image;
                $cart_list[$key]['name'] = $item->name;
                $cart_list[$key]['price'] = $item->price;
                $cart_list[$key]['active'] = true;
                $cart_list[$key]['number'] = $item->quantity;
            }
        }
        $data = [];
        $data['list'] = $cart_list;
        return $this->json($data);
    }
    //加入购物车
    public function member_cart_add(){
        $uid = $this->uid ?? 1;
        $food_id = $this->req('food_id', 0);
        $quantity = $this->req('quantity', 0);
        if (empty($food_id) || empty($quantity)) return $this->error('参数错误', 210);
        $data = [];
        $data['member_id'] = $uid;
        $data['food_id'] = $food_id;
        $data['quantity'] = $quantity;
        //检查是否已经存在,如果存在就修改数量
        if (Model::Food()->checkMemberCart($uid, $food_id) > 0){
            if (Model::Food()->updateMemberCartQuantity($uid,$food_id, $quantity)){
                return $this->json(['msg'=>'操作成功']);
            }
        }else {
            if (Model::Food()->insertMemberCart($data)){
                return $this->json(['msg'=>'操作成功']);
            }
        }
        return $this->error('操作失败', 220);
    }
}