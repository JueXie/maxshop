@extends('installer.master')

@section('content')
    <div class="container" style="margin: 50px auto">
    <ul class="nav nav-pills nav-justified">
        <li><a href="/install/step1">检查系统需求环境</a></li>
        <li><a href="/install/step1">检查文件夹目录权限</a></li>
        <li><a href="/install/step3">设置商城后台环境变量</a></li>
        <li class="active"><a href="javascript:;">安装数据库</a></li>
        <li><a href="/install/step5">完成</a></li>
    </ul>
    @if(Session::get('results') == "失败")
        <p style="text-align: center;margin-top: 50px;color: red">环境配置出现错误，请返回上一步重新确认信息</p>
    @endif
    <div class="container" style="width: 600px;margin: 50px auto">
        <form action="/install/install_db" method="post" role="form" class="form-horizontal" id="db_install_form">
            {{csrf_field()}}
            <div class="form-group">
                <label for="admin_name" class="col-sm-4 control-label">Admin账号</label>
                <div class="col-sm-8">
                    <input type="text" name="admin_name" id="admin_name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="admin_password" class="col-sm-4 control-label">Admin密码</label>
                <div class="col-sm-8">
                    <input type="text" name="admin_password" id="admin_password" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <p style="text-align: center"><button type="submit" class="btn btn-primary">提交</button></p>
            </div>
        </form>
        {{--<div style="background-color: white;width: 100%;height: 500px">--}}

        {{--</div>--}}
    </div>
    </div>
@endsection


@section('my-js')

@endsection
