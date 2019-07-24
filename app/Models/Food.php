<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2019/7/15
 * Time: 3:35 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Food extends Model{
    public function insertFoodCat($data){
        return self::table('food_cat')->insert($data);
    }
    public function getFoodCat($id){
        return self::table('food_cat')->where(['id'=>$id])->first();
    }
    public function updateFoodCat($id, $data){
        return self::table('food_cat')->where(['id'=>$id])->update($data);
    }
    public function delFoodCat($id){
        return self::table('food_cat')->where(['id'=>$id])->delete();
    }
    public function insertFood($data){
        return self::table('food')->insert($data);
    }
    public function updateFood($id, $data){
        return self::table('food')->where(['id'=>$id])->update($data);
    }
    public function delFood($id){
        return self::table('food')->where(['id'=>$id])->delete();
    }
    public function getFoodCateParams($q, $limit){
        $query = self::table('food_cat');
        if (!empty($q)){
            $query->where('name', 'like' , '%'.$q.'%');
        }
        return $query->orderBy('id', 'desc')->paginate($limit)->toArray();
    }
    public function getFoodCate(){
        $query = self::table('food_cat');
        $query->where(['status'=>1]);
        return $query->orderBy('weight', 'desc')->get()->toArray();
    }
    public function getFood($id){
        return self::table('food')->where(['id'=>$id])->first();
    }
    public function updateFoodViewCount($id){
        return self::table('food')->where(['id'=>$id])->increment('view_count');
    }
    public function getFoodParams($q, $limit){
        $query = self::table('food');
        $query->leftJoin('food_cat', 'food_cat.id', '=', 'food.cat_id');
        $query->select('food.*','food_cat.name as cname');
        if (!empty($q)){
            $query->where('food.name', 'like' , '%'.$q.'%');
        }
        return $query->orderBy('food.id', 'desc')->paginate($limit)->toArray();
    }
    public function getFoodBanner($limit=3){
        return self::table('food')->orderBy('total_count', 'desc')->limit($limit)->get()->toArray();
    }
    public function getFoodsByParams($params=[],$pageSize=10){
        $query = self::table('food');
        if (isset($params['cat_id']) && !empty($params['cat_id'])) $query->where(['cat_id'=>$params['cat_id']]);
        if (isset($params['q']) && !empty($params['q'])) $query->where('name', 'like', "%".$params['q']."%")->orWhere('tags','like',"%".$params['q']."%");
        return $query->orderBy('total_count', 'desc')->paginate($pageSize)->toArray();
    }
    public function insertMemberShare($data){
        return self::table('wx_share_history')->insert($data);
    }
    public function insertMemberCart($data){
        return self::table('member_cart')->insert($data);
    }
    public function checkMemberCart($uid=0,$food_id=0){
        return self::table('member_cart')->where(['member_id'=>$uid, 'food_id'=>$food_id])->count();
    }
    public function updateMemberCartQuantity($uid=0,$food_id=0, $quantity=1){
        return self::table('member_cart')->where(['member_id'=>$uid, 'food_id'=>$food_id])->increment('quantity',$quantity);
    }
    public function getMemberCartCount($uid=0){
        return self::table('member_cart')->where(['member_id'=>$uid])->count();
    }
    public function getMemberCart($uid=0){
        return self::table('member_cart')->where(['member_id'=>$uid])->get();
    }
    public function getMemberCartFood($uid=0){
        $query = self::table('member_cart');
        $query->select('member_cart.*','food.id as food_id','food.name','food.price','food.main_image');
        $query->leftJoin('food','food.id','=','member_cart.food_id');
        return $query->where(['member_cart.member_id'=>$uid])->get()->toArray();
    }
    public function updateMemberCartQuantityById($uid=0,$id=0, $quantity=1){
        $data = [];
        $data['quantity'] = $quantity;
        return self::table('member_cart')->where(['member_id'=>$uid, 'id'=>$id])->update($data);
    }
    public function delMemberCartByIds($uid=0, $ids = []){
        return self::table('member_cart')->where('member_id',$uid)->whereIn('id', $ids)->delete();
    }
    public function delMemberCartByFoodId($uid=0, $ids = []){
        return self::table('member_cart')->where('member_id',$uid)->whereIn('food_id', $ids)->delete();
    }
    public function getFoodByInId($id=[]){
        return self::table('food')->whereIn('id', $id)->get()->toArray();
    }
    public function getFoodByInIdsForUpdate($id=[]){
       return self::table('food')->whereIn('id', $id)->lockForUpdate()->get();
    }
    public function insertPayOrder($data){
        return self::table('pay_order')->insertGetId($data);
    }
    public function getPayOrderByStatus($uid=0, $status=0,$express_status=0,$comment_status=0){
        return self::table('pay_order')->where(['member_id'=>$uid, 'status'=>$status,'express_status'=>$express_status,'comment_status'=>$comment_status])->orderBy('id', 'desc')->get()->toArray();
    }
    public function insertPayOrderItem($data){
        return self::table('pay_order_item')->insert($data);
    }

    //减去库存
    public function updateFoodStock($id, $stock=0){
        $data = [];
        $data['stock'] = $stock;
        return self::table('food')->where(['id'=>$id])->update($data);
    }

    public function getPayOrderItemFoodByOrderIds($pay_order_ids=[]){
        $query = self::table('pay_order_item');
        $query->select('pay_order_item.*', 'food.main_image');
        $query->leftJoin('food', 'food.id','=','pay_order_item.food_id');
        return $query->whereIn('pay_order_item.pay_order_id', $pay_order_ids)->orderBy('pay_order_item.id', 'desc')->get()->toArray();
    }
    public function getOrderPayByOrderSnUid($uid = 0, $order_sn=0){
        return self::table('pay_order')->where(['member_id'=>$uid, 'order_sn'=>$order_sn])->first();
    }

}