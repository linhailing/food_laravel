<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2019/7/22
 * Time: 9:14 AM
 */

namespace App\Http\Controllers\Api;


use App\Models\Model;

class CartController extends ApiController{
    public function index(){
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
    public function cart_add(){
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
    //修改购物车
    public function cart_set(){
        $uid = $this->uid ?? 1;
        $id = $this->req('id', 0);
        $number = $this->req('number', 0);
        if (empty($id) || empty($number)) return $this->error('参数错误', 210);
        if (Model::Food()->updateMemberCartQuantityById($uid, $id, $number)){
            return $this->json(['msg'=>'操作成功']);
        }
        return $this->error('操作失败', 220);
    }
    //删除购物车
    public function cart_del(){
        $uid = $this->uid ?? 1;
        $req_data =  isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
        $req_decode = urldecode($req_data);
        parse_str($req_decode, $output);
        if (!isset($output['ids'])) return $this->error('参数错误', 210);
        $cart_ids = json_decode($output['ids'],JSON_UNESCAPED_UNICODE);
        if (count($cart_ids) <= 0) return $this->error('参数错误', 210);
        $ids = [];
        foreach ($cart_ids as $key=>$item){
            $ids[] = $item['id'];
        }
        if (Model::Food()->delMemberCartByIds($uid, $ids)){
            return $this->json(['msg'=>'操作成功']);
        }
        return $this->error('操作失败', 220);
    }
}