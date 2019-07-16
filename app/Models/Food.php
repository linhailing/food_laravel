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

}