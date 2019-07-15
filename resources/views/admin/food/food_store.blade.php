@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>@if(!empty($id)) 更新信息 @else 新增信息 @endif</h2>
        </div>
        <div class="layui-card-body">
            <form action="{{route('admin.food.store',['id'=>$id])}}" method="post" class="layui-form">
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">美食分类</label>
                    <div class="layui-input-block">
                        <div class="layui-input-inline">
                            <select name="cat_id"  lay-search="">
                                <option value="0">请选择分类</option>
                                @foreach($cate as $item)
                                    <option value="{{$item->id}}" @if($info && $info->cat_id== $item->id) selected @endif>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">美食名称</label>
                    <div class="layui-input-block">
                        <input class="layui-input" type="text" name="name" value="{{$info->name??old('name')}}" placeholder="如:小鸡炖蘑菇">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">美食价格</label>
                    <div class="layui-input-block">
                        <input class="layui-input" type="number" name="price" lay-verify="required" value="{{$info->price??old('price')}}" placeholder="如:123.4">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">封面图</label>
                    <button type="button" class="layui-btn" id="pic_file"><i class="layui-icon"></i>上传封面图</button>
                    <div class="layui-input-block">
                        <div class="layui-upload-list">
                            <div class="layui-upload-list">
                                <img class="layui-upload-img" id="pic_img" src="{{$info->main_image??''}}">
                                <input class="layui-input" id="pic_value" type="hidden" name="main_image"  value="{{$info->main_image??old('main_image')}}">
                                <p id="pic_text"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">美食描述</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入内容" id="descript" class="layui-textarea" style="height: 300px;width: 1000px;border: 0;padding: 0;" name="summary">{{$info->summary??old('summary')}}</textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">美食库存</label>
                    <div class="layui-input-block">
                        <input class="layui-input" type="number" name="stock" value="{{$info->stock??old('stock')}}" placeholder="如：100">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">美食标签</label>
                    <div class="layui-input-block">
                        <input class="layui-input" type="text" name="tags" value="{{$info->tags??old('tags')}}" placeholder="如:好吃">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">状态</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="status" @if($info && $info->status == 1) checked @endif  lay-skin="switch" lay-filter="switchTest" lay-text="有效|无效" value="1">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">月销售量</label>
                    <div class="layui-input-block">
                        <input class="layui-input" type="number" name="month_count" value="{{$info->month_count??old('month_count')}}" placeholder="如:100">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">总销售量</label>
                    <div class="layui-input-block">
                        <input class="layui-input" type="number" name="total_count" value="{{$info->total_count??old('total_count')}}" placeholder="如:100">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">总浏览数</label>
                    <div class="layui-input-block">
                        <input class="layui-input" type="number" name="view_count" value="{{$info->view_count??old('view_count')}}" placeholder="如:120">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">总评论量</label>
                    <div class="layui-input-block">
                        <input class="layui-input" type="number" name="comment_count" value="{{$info->comment_count??old('comment_count')}}" placeholder="如：2019">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="">确 认</button>
                        <a href="{{route('admin.food')}}?page={{$page}}" class="layui-btn">返 回</a>
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
    <script type="text/javascript" charset="utf-8" src="/static/plugin/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/plugin/ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/static/plugin/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" charset="utf-8" src="/js/editorConfig.js"></script>
    <script>
        var _token = '{{csrf_token()}}';
        var ue = UE.getEditor('descript', config(_token));
        layui.use(['laydate','upload'], function () {
            var $ = layui.jquery
                ,upload = layui.upload,
                laydate = layui.laydate;
            //开启公历节日
            laydate.render({
                elem: '#production_date'
            });
            //普通图片上传
            var pic = upload.render({
                elem: '#pic_file'
                ,url: '/admin/uploadImage'
                ,before: function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){
                        $('#pic_img').attr('src', result); //图片链接（base64）
                    });
                }
                ,done: function(res){
                    //如果上传失败
                    if(res.code > 0){
                        return layer.msg('上传失败');
                    }
                    //上传成功
                    $('#pic_value').val(res.url)
                }
                ,error: function(){
                    //演示失败状态，并实现重传
                    var demoText = $('#pic_text');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function(){
                        pic.upload();
                    });
                }
            });
            // //多图片上传
            // upload.render({
            //     elem: '#ppimglist'
            //     ,url: '/admin/uploadImage'
            //     ,multiple: true
            //     ,before: function(obj){
            //         layer.msg('图片上传中...', {
            //             icon: 16,
            //             shade: 0.01,
            //             time: 0
            //         })
            //     }
            //     ,done: function(res){
            //         layer.close(layer.msg('上传成功！'));
            //         $('#ppimglist_div').append('<dd class="layui-upload-dd"><i onclick="deleteImg($(this))"   class="layui-icon"></i>' +
            //             '<img src="' + res.url + '" class="layui-upload-img" ><input type="hidden" name="pics_url[]" value="' + res.url + '" />' +
            //             '</dd>');
            //     },
            //     error: function () {
            //         layer.msg('上传错误！');
            //     }
            // });
        });
        function deleteImg(obj){
            obj.parent('.layui-upload-dd').remove();
        }
    </script>
@endsection
