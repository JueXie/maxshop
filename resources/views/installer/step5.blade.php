@extends('installer.master')

@section('content')
    <div class="container" style="margin: 50px auto">
    <ul class="nav nav-pills nav-justified">
        <li><a href="/install/step1">检查系统需求环境</a></li>
        <li><a href="/install/step1">检查文件夹目录权限</a></li>
        <li><a href="/install/step3">设置商城后台环境变量</a></li>
        <li><a href="/install/step4">安装数据库</a></li>
        <li class="active"><a href="javascript:;">完成</a></li>
    </ul>

    <div class="container" style="width: 500px;margin:200px auto">
        <p style="text-align: center">
            <a class="btn btn-lg btn-primary" href="/"><=前往商城首页</a>
            <a class="btn btn-lg btn-primary" href="/admin/index">前往后台首页=></a>
        </p>
    </div>
    </div>
@endsection