<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2019/7/16
 * Time: 10:15 AM
 */

namespace App\Http\Controllers\Api;


use App\Models\Model;

class FoodController extends ApiController{

    public function index(){
        $where = [];
        $where['cat_id'] = $this->req('cat_id', 0);
        $where['q'] = $this->req('q', '');
        $foods = Model::Food()->getFoodsByParams($where, $this->pageSize);
        $lists = [];
        if (!empty($foods['data'])){
            foreach ($foods['data'] as $key=>$item) {
                $lists[$key]['id'] = $item->id;
                $lists[$key]['name'] = $item->name;
                $lists[$key]['price'] = $item->price;
                $lists[$key]['min_price'] = $item->price;
                $lists[$key]['pic_url'] = $item->main_image;
            }
        }
        $data = [
            'lists' => $lists,
            'current_page' => $foods['current_page']?? 0,
            'total' => $foods['total']?? 0,
            'last_page' => $foods['last_page']?? 0,
        ];
        return $this->json($data);
    }
    public function category(){
        $category = Model::Food()->getFoodCate();
        $banners = Model::Food()->getFoodBanner(3);
        $cate_list = [
            ['id'=>0,'name'=>'全部']
        ];
        $banner = [];
        if (!empty($category)){
            foreach ($category as $key=>$item) {
                $cate_list[$key+1]['id'] = $item->id;
                $cate_list[$key+1]['name'] = $item->name;
            }
        }
        if (!empty($banners)){
            foreach ($banners as $key=>$item) {
                $banner[$key]['id'] = $item->id;
                $banner[$key]['pic_url'] = $item->main_image;
            }
        }
        $data= [
            'cate_list'=>$cate_list,
            'banners' => $banner
        ];
        return $this->json($data);
    }

}