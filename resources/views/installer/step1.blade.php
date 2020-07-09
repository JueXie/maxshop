@extends('installer.master')

@section('content')
    {{--{{ dd($requirements)  }}--}}
    {{--{{dd($phpSupportInfo)}}--}}
<div class="container" style="margin: 50px auto">
    <ul class="nav nav-pills nav-justified">
        <li class="active"><a href="javascript:;">检查系统需求环境</a></li>
        <li><a href="/install/step2">检查文件夹目录权限</a></li>
        <li><a href="/install/step3">设置商城后台环境变量</a></li>
        <li><a href="/install/step4">安装数据库</a></li>
        <li><a href="/install/step5">完成</a></li>
    </ul>
    <div class="container" style="width: 80%;margin: 50px auto">
        {{--<p style="text-align: center;">检查PHP版本以及扩展</p>--}}
            <table class="table table-striped" style="text-align: center">
                <tbody>
                <tr>
                    <td>当前php版 <span style="font-size: 8px">(最低需求{{$phpSupportInfo['minimum']}})</span></td>
                    <td>{{$phpSupportInfo['current']}}{{$phpSupportInfo['supported']?"√":"×"}}</td>
                </tr>
                @foreach($requirements['requirements']['php'] as $extention => $enable)
                <tr>
                    <td>{{$extention}}</td>
                    @if($enable)
                        <td>已开启</td>
                        @else
                        <td>未开启</td>
                        {{Session::push('extention_error',$extention.'未开启')}}
                    @endif
                </tr>
                @endforeach
                </tbody>
            </table>
        @if(Session::has('extention_error'))
            <p style="text-align: center">要求未达到，请安装扩展后在重新安装</p>
            {{Session::forget('extention_error')}}
            @else
            <p style="text-align: center"><a class="btn btn-primary" href="/install/step2">下一步</a></p>
        @endif

    </div>
</div>
@endsection