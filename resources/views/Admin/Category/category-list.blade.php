@extends('Admin.Component.master')
@section('sidebar3')
    class="selected"
@endsection
@section('sidebar3-1')
    style="display: block;"
@endsection
@section('sidebar3-1-2')
    class="current"
@endsection

@section('content')
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 分类列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="Hui-article">
            <div>
                <div class="pd-20">
                    <div class="text-c"> 日期范围：
                        <input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" id="logmin" class="input-text Wdate" style="width:120px;">
                        -
                        <input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" id="logmax" class="input-text Wdate" style="width:120px;">
                        <input type="text" name="" id="" placeholder=" 产品名称" style="width:250px" class="input-text">
                        <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜产品</button>
                    </div>
                    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="category_deletes()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="category_add('添加分类','/admin/category-add',900,700)" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a></span> <span class="r">共有数据：<strong>10</strong> 条</span> </div>
                    <div class="mt-20">
                        <table class="table table-border table-bordered table-bg table-hover table-sort">
                            <thead>
                            <tr class="text-c">
                                <th width="5"><input name="" type="checkbox" value=""></th>
                                <th width="5">ID</th>
                                <th width="60">缩略图</th>
                                <th width="100">分类名字</th>
                                <th width="100">父类ID</th>
                                <th width="100">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr class="text-c va-m">
                                    <td><input class="category_id" name="category_id" type="checkbox" value="{{$category->category_id}}"></td>
                                    <td>{{$category->category_id}}</td>
                                    <td><img width="60" class="product-thumb" src="{{$category->preview_img}}"></td>
                                    <td class="text-l">{{$category->name}}</td>
                                    <td class="text-l">{{$category->parent_name}}</td>
                                    <td class="td-manage">
                                        <a style="text-decoration:none" class="ml-5" onClick="category_edit('分类编辑','/admin/edit-category/{{$category->category_id}}',900,700)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
                                        <a style="text-decoration:none" class="ml-5" onClick="category_del('{{$category->category_id}}')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align:center">
                            {{$categories->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script type="text/javascript" src="/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="/lib/laypage/1.2/laypage.js"></script>
    <script type="text/javascript">
        function category_add(title,url,w,h) {
            layer_show(title,url,w,h)
        }
        function category_edit(title,url,w,h) {
            layer_show(title,url,w,h)
        }
        function category_deletes() {
            var ids = []
            $('.category_id:checked').each(function (i,e) {
                var input = $(e)
                ids.push(input.val())
            })
            $.ajax({
                url:'/service/category/delete',
                method:'POST',
                data:{
                    _token:'{{csrf_token()}}',
                    id:ids,
                },
                success:function () {
                    layer.msg('已删除!',{icon:1,time:1000});
                    location.reload(2000)
                }
            })
        }
        function category_del(id) {
            $.ajax({
                url:'/service/category/delete',
                method:'POST',
                data:{
                    _token:'{{csrf_token()}}',
                    id:id,
                },
                success:function () {
                    layer.msg('已删除!',{icon:1,time:1000});
                    location.reload(2000)
                }
            })
        }
    </script>

@endsection
