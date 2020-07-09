@extends('Admin.Component.master')
@section('sidebar8')
    class="selected"
@endsection
@section('sidebar8-1')
    style="display: block;"
@endsection
@section('sidebar8-1-2')
    class="current"
@endsection

@section('css')
    <style>
        .content-item{
            margin: 20px 0px;
            display: flex;
            align-items: center;
        }
        .content-item input{
            flex: 2;
        }
        .content-item label{
            flex: 1;
        }
        .content-item button{
            flex: 1;
            width: 90px;
        }
        .max-input{
            border: 1px #ccc solid;
            width: 100%;
            height: 36px;
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统设置 <span class="c-gray en">&gt;</span> 支付设置 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="mt-20 ml-20 mr-20">
            <div class="top-bar">
                {{--<button class="btn btn-primary radius">添加支付方式</button>--}}
            </div>
            <div class="payment-wrap" style="width: 600px;">
                <div class="panel panel-success mt-20">
                    <div class="panel-header">微信支付</div>
                    <div class="panel-body">
                        <div class="content-item">
                            <label for="app_id">APPID：</label>
                            <input class="max-input" name="app_id" type="text" value="{{isset($wechatData['app_id'])?$wechatData['app_id']:''}}">
                        </div>
                        <div class="content-item">
                            <label for="mch_id">商户ID：</label>
                            <input class="max-input" name="mch_id" type="text" value="{{isset($wechatData['mch_id'])?$wechatData['mch_id']:''}}">
                        </div>
                        <div class="content-item">
                            <label for="mch_key">商户密钥：</label>
                            <input class="max-input" name="mch_key" type="text" value="{{isset($wechatData['mch_key'])?$wechatData['mch_key']:''}}">
                        </div>
                        <div class="content-item">
                            <label for="mch_title">商户标题：</label>
                            <input class="max-input" name="mch_title" type="text" value="{{isset($wechatData['mch_title'])?$wechatData['mch_title']:''}}">
                        </div>
                        <div style="width: 100%;text-align: center">
                           <button onclick="wechatPayment()" class="btn btn-success radius">保存</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('js')
    <script>
        function wechatPayment() {
            $.ajax({
                url:'/service/payment/update',
                method:'POST',
                data:{
                    name:'微信支付',
                    app_id:$('input[name=app_id]').val(),
                    mch_id:$('input[name=mch_id]').val(),
                    mch_key:$('input[name=mch_key]').val(),
                    mch_title:$('input[name=mch_title]').val(),
                    _token:'{{csrf_token()}}'
                },
                success:function (res) {
                    layer.msg(res,{time:1200,icon:1})
                }
            })
        }

    </script>
@endsection
