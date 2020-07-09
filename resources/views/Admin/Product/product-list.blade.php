@extends('Admin.Component.master')
@section('sidebar3')
    class="selected"
@endsection
@section('sidebar3-1')
    style="display: block;"
@endsection
@section('sidebar3-1-3')
    class="current"
@endsection

@section('content')
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
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
                    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="detedel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="product_add('添加产品','/admin/product-add')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加产品</a></span> <span class="r">共有数据：<strong>{{count($products)}}</strong> 条</span> </div>
                    <div class="mt-20">
                        <table class="table table-border table-bordered table-bg table-hover table-sort">
                            <thead>
                            <tr class="text-c">
                                <th width="40"><input name="" type="checkbox" value=""></th>
                                <th width="40">ID</th>
                                <th width="60">缩略图</th>
                                <th width="100">产品名称</th>
                                <th width="100">产品分类</th>
                                <th width="100">单价</th>
                                <th width="60">发布状态</th>
                                <th width="100">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr class="text-c va-m">
                                        <td><input class="product_id" name="product_id" type="checkbox" value="{{$product['product_id']}}"></td>
                                        <td>{{$product['product_id']}}</td>
                                        <td><img width="60" class="product-thumb" src="{{$product['main_img']}}"></td>
                                        <td class="text-l">{{$product['title']}}</td>
                                        <td class="text-l">{{$product['category_id']=='0'?'未分类':$product['category_id']}}</td>
                                        @if($product['type']=='variable')
                                            <td>{{$product['price_limit']}}</td>
                                        @else
                                            <td>{{$product['normal_price']}}</td>
                                        @endif

                                        @if($product['status']=='public')
                                            <td class="td-status"><span class="label label-success radius">{{'上架'}}</span></td>
                                        @else
                                            <td class="td-status"><span class="label label-defaunt radius">{{'已下架'}}</span></td>
                                        @endif
                                        <td class="td-manage">
                                            @if($product['status']=='public')
                                                <a style="text-decoration:none" onClick="product_change_status(this,'{{$product["product_id"]}}','{{$product["status"]}}')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
                                            @else
                                                <a style="text-decoration:none" onClick="product_change_status(this,'{{$product["product_id"]}}','{{$product["status"]}}')" href="javascript:;" title="上架"><i class="Hui-iconfont">&#xe6dc;</i></a>
                                            @endif
                                            <a style="text-decoration:none" class="ml-5" onClick="product_edit('产品编辑','/admin/edit-product/{{$product["product_id"]}}')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
                                            <a style="text-decoration:none" class="ml-5" onClick="product_del(this,'{{$product["product_id"]}}')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="text-align:center">
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection


@section('js')
    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="/lib/laypage/1.2/laypage.js"></script>
    <script type="text/javascript">
        /*图片-添加*/
        function product_add(title,url){
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }
        /*图片-查看*/
        function product_show(title,url,id){
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }
        /*图片-审核*/
        function product_shenhe(obj,id){
            layer.confirm('审核文章？', {
                    btn: ['通过','不通过'],
                    shade: false
                },
                function(){
                    $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
                    $(obj).remove();
                    layer.msg('已发布', {icon:6,time:1000});
                },
                function(){
                    $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
                    $(obj).remove();
                    layer.msg('未通过', {icon:5,time:1000});
                });
        }
        /*产品更改状态*/
        function product_change_status(obj,id,status){
           $.ajax({
               url:'/service/product/change_status',
               method:'POST',
               data:{
                   _token:'{{csrf_token()}}',
                   id:id,
                   status:status
               },
               success:function () {
                   layer.msg('修改成功', {icon:6,time:1000});
                   location.reload(2000)
               }
           })
        }

        /*图片-发布*/
        function product_start(obj,id){
            layer.confirm('确认要发布吗？',function(index){
                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
                $(obj).remove();
                layer.msg('已发布!',{icon: 6,time:1000});
            });
        }
        /*图片-申请上线*/
        function product_shenqing(obj,id){
            $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
            $(obj).parents("tr").find(".td-manage").html("");
            layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
        }
        /*图片-编辑*/
        function product_edit(title,url,id){
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }
        /*图片-删除*/
        function product_del(obj,id){
            $.ajax({
                url:'/service/product/delete',
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
        function detedel() {
            var ids = []
            $('.product_id:checked').each(function (i,e) {
                var input = $(e)
                ids.push(input.val())
            })
            $.ajax({
                url:'/service/product/delete',
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
    </script>
    <!--/请在上方写此页面业务相关的脚本-->
@endsection
