@extends('installer.master')

@section('content')
    {{--{{dd($permissions)}}--}}
<div class="container" style="margin: 50px auto">
    <ul class="nav nav-pills nav-justified">
        <li><a href="/install/step1">检查系统需求环境</a></li>
        <li class="active"><a href="javascript:;">检查文件夹目录权限</a></li>
        <li><a href="/install/step3">设置商城后台环境变量</a></li>
        <li><a href="/install/step4">安装数据库</a></li>
        <li><a href="/install/step5">完成</a></li>
    </ul>
    <div class="container" style="width: 80%;margin: 50px auto">
        <p style="text-align: center">检查文件夹目录权限</p>
        <table class="table table-striped" style="text-align: center">
            <tbody>
            @foreach($permissions['permissions'] as $permission)
                <tr>
                <td>{{$permission['folder']}}</td>
                <td>{{$permission['permission']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if(!isset($permission['errors']))
            <p style="text-align: center"><a class="btn btn-primary" href="/install/step3">下一步</a></p>
        @endif
    </div>
</div>

@endsection