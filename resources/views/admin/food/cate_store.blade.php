@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>@if(!empty($id)) 更新信息 @else 新增信息 @endif</h2>
        </div>
        <div class="layui-card-body">
            <form action="{{route('admin.food.cate.store',['id'=>$id])}}" method="post" class="layui-form">
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">分类名称</label>
                    <div class="layui-input-block">
                        <input class="layui-input" type="text" name="name" lay-verify="required" value="{{$info->name??old('name')}}" placeholder="如:小鸡炖蘑菇">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">权重</label>
                    <div class="layui-input-block">
                        <input class="layui-input" type="number" name="weight" value="{{$info->weight??old('weight')}}" placeholder="如:123">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">状态</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="status" @if(!$info || ($info && $info->status == 1)) checked @endif  lay-skin="switch" lay-filter="switchTest" lay-text="有效|无效" value="1">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="">确 认</button>
                        <a href="{{route('admin.food.cate')}}?page={{$page}}" class="layui-btn">返 回</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('style')
    <style>
        .layui-upload-img{
            width: 92px;
            height: 92px;
            margin: 0 10px 10px 0;

        }
        .layui-upload-dd{
            display: inline-block;
            position: relative;
            margin: 0 10px 10px 0;
        }
        .layui-upload-dd .layui-icon{
            position: absolute;
            z-index: 999;
            right: 0;
            top: -20px;
        }
    </style>
@endsection
@section('script')
    <script>
        layui.use(['laydate','upload'], function () {
            var $ = layui.jquery
                ,upload = layui.upload,
                laydate = layui.laydate;
        });
    </script>
@endsection
