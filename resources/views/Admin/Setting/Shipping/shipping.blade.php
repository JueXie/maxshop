@extends('Admin.Component.master')
@section('sidebar8')
    class="selected"
@endsection
@section('sidebar8-1')
    style="display: block;"
@endsection
@section('sidebar8-1-1')
    class="current"
@endsection

@section('content')
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统设置 <span class="c-gray en">&gt;</span> 运费设置 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-hover table-sort">
                <thead>
                <tr class="text-c">
                    <th width="40"><input name="" type="checkbox" value=""></th>
                    <th width="20">ID</th>
                    <th width="60">名字</th>
                    <th width="100">状态</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="text-c va-m">
                        <td><input class="product_id" name="product_id" type="checkbox" value=""></td>
                        <td>id</td>
                        <td class="text-l">名字</td>
                        <td class="text-l">状态</td>
                        <td class="td-manage">
                            {{--@if($product['status']=='public')--}}
                                <a style="text-decoration:none" onClick="product_change_status(this,'','')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
                            {{--@else--}}
                                <a style="text-decoration:none" onClick="product_change_status(this,'','')" href="javascript:;" title="上架"><i class="Hui-iconfont">&#xe6dc;</i></a>
                            {{--@endif--}}
                            <a style="text-decoration:none" class="ml-5" onClick="shipping_edit('运输编辑','/admin/shipping-edit/')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
                            <a style="text-decoration:none" class="ml-5" onClick="product_del(this,'')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection


@section('js')
    <script>
        function shipping_edit(title,url) {
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

    </script>

@endsection
