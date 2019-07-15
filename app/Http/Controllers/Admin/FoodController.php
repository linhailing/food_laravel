<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2019/7/15
 * Time: 2:42 PM
 */

namespace App\Http\Controllers\Admin;


use App\Models\Model;
use Illuminate\Http\Request;

class FoodController extends Controller{
    public function getData(Request $request){
        $model = $request->get('model');
        switch (strtolower($model)){
            case 'food':
                $result = $this->getFoods($request->get('q', ''),$request->get('limit', $this->limit));
                break;
            case 'cate':
                $result = $this->getFoodCate($request->get('q', ''),$request->get('limit', $this->limit));
                break;
        }
        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $result['total']??0,
            'data' => $result['data']??[]
        ];
        return response()->json($data);
    }
    public function index(){
        $page = 1;
        return view('admin.food.index', compact('page'));
    }
    public function store(Request $request){
        if (!$this->isPermissions('admin.food.store')) return back()->withErrors(['status'=>'您无权限删除，请联系管理员']);
        $page = $request->get('page', 1);
        $id = $request->get('id', 0);
        if ($request->isMethod('GET')){
            $info = Model::Food()->getFood($id);
            $cate = Model::Food()->getFoodCate();
            return view('admin.food.food_store', compact('info', 'id', 'page','cate'));
        }
        $data = $request->except(['_token','file']);
        if (isset($data['id'])) unset($data['id']);
        if (!isset($data['status'])) $data['status'] = 0;
        if (!empty($id)){
            Model::Food()->updateFood($id, $data);
            return back()->with(['status'=>'修改成功']);
        }
        Model::Food()->insertFood($data);
        return back()->with(['status'=>'新增成功']);
    }
    public function del(){
        return [];
    }
    public function cate(){
        $page = 1;
        return view('admin.food.cate_index', compact('page'));
    }
    public function cateStore(Request $request){
        $page = $request->get('page', 1);
        $id = $request->get('id', 0);
        if (!$this->isPermissions('admin.food.cate.store')) return back()->withErrors(['status'=>'您无权限删除，请联系管理员']);
        if ($request->isMethod('GET')){
            $info = Model::Food()->getFoodCat($id);
            return view('admin.food.cate_store', compact('info', 'id', 'page'));
        }
        $data = $request->except(['_token','file']);

        if (isset($data['id'])) unset($data['id']);
        if (!isset($data['status'])) $data['status'] = 0;
        if (!empty($id)){
            Model::Food()->updateFoodCat($id, $data);
            return back()->with(['status'=>'修改成功']);
        }
        Model::Food()->insertFoodCat($data);
        return back()->with(['status'=>'新增成功']);
    }
    public function cateDel(Request $request){
        $id = intval($request->input('id', 0));
        if( !$this->isPermissions('admin.food.cate.del')) return response()->json(['code'=>1,'msg'=>'您无权限删除，请联系管理员']);
        if (empty($id)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        if (Model::Food()->delFoodCat($id)){
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
        return response()->json(['code'=>1,'msg'=>'删除失败']);
    }
    private function getFoods($q, $limit){
        $result = Model::Food()->getFoodParams($q, $limit);
        $list = ['data'=>[], 'total'=>0];
        if (!$result) return $list;
        $data = [];
        foreach ($result['data'] as $key=>$item){
            $data[$key]['id'] = $item->id;
            $data[$key]['name'] = $item->name;
            $data[$key]['cname'] = $item->cname;
            $data[$key]['main_image'] = ($item && $item->main_image) ? '<img style="width:50px;height:50px" src="'.$item->main_image.'">' : '';
            $data[$key]['price'] = $item->price;
            $data[$key]['stock'] = $item->stock;
            $data[$key]['tags'] = $item->tags;
            $data[$key]['status'] = ($item && $item->status) ? '<span class="layui-badge layui-bg-green">有效</span>' : '<span class="layui-badge">无效</span>';
        }
        $list['data'] = $data;
        $list['total'] = $result['total'];
        return $list;
    }
    private function getFoodCate($q, $limit){
        $result = Model::Food()->getFoodCateParams($q, $limit);
        $list = ['data'=>[], 'total'=>0];
        if (!$result) return $list;
        $data = [];
        foreach ($result['data'] as $key=>$item){
            $data[$key]['id'] = $item->id;
            $data[$key]['name'] = $item->name;
            $data[$key]['weight'] = $item->weight;
            $data[$key]['status'] = ($item && $item->status) ? '<span class="layui-badge layui-bg-green">有效</span>' : '<span class="layui-badge">无效</span>';
        }
        $list['data'] = $data;
        $list['total'] = $result['total'];
        return $list;
    }

}