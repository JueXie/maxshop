@extends('installer.master')

@section('my-css')

@endsection
@section('content')
<div class="container" style="margin: 50px auto">
    <ul class="nav nav-pills nav-justified">
        <li><a href="/install/step1">检查系统需求环境</a></li>
        <li><a href="/install/step2">检查文件夹目录权限</a></li>
        <li class="active"><a href="javascript:;">设置商城后台环境变量</a></li>
        <li><a href="/install/step4">安装数据库</a></li>
        <li><a href="/install/step5">完成</a></li>
    </ul>

    <div class="container" style="width: 600px;margin: 50px auto">
        <form action="/install/data_submit" method="post" class="form-horizontal" role="form" id="env-form">
            {{csrf_field()}}
            <legend>环境配置：</legend>
            <div class="form-group">
                <label for="appname" class="col-sm-2 control-label">商城名字</label>
                <div class="col-sm-10">
                    <input type="text" name="appname" class="form-control" id="appname" placeholder="商城名字">
                </div>
            </div>
            <div class="form-group">
                <label for="appurl" class="col-sm-2 control-label">商城域名</label>
                <div class="col-sm-10">
                    <input type="text" name="appurl" class="form-control" id="appurl" placeholder="https://">
                </div>
            </div>
            <div class="form-group">
                <label for="minipro_id" class="col-sm-2 control-label">APPID</label>
                <div class="col-sm-10">
                    <input type="text" name="minipro_id" class="form-control" id="minipro_id" placeholder="小程序APPID">
                </div>
            </div>
            <div class="form-group">
                <label for="minipro_secrect" class="col-sm-2 control-label">APPsecrect</label>
                <div class="col-sm-10">
                    <input type="text" name="minipro_secrect" class="form-control" id="minipro_secrect" placeholder="小程序的密钥">
                </div>
            </div>
            <div class="form-group">
                <label for="appenv" class="col-sm-2 control-label">运行环境</label>
                <div class="col-sm-10">
                    <select name="appenv" id="appenv" class="form-control">
                        <option value="production">production</option>
                        <option value="local">local</option>
                        <option value="testing">testing</option>
                        <option value="staging">staging</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="debug" class="col-sm-2 control-label">调试模式</label>
                <div class="col-sm-10">
                    <select name="debug" id="debug" class="form-control">
                        <option value="false">false</option>
                        <option value="true">true</option>
                    </select>
                </div>
            </div>
            <legend>数据库配置：</legend>
            <div class="form-group">
                <label for="db_type" class="col-sm-2 control-label">数据库类型</label>
                <div class="col-sm-10">
                    <select name="db_type" id="db_type" class="form-control">
                        <option value="mysql">mysql</option>
                        <option value="sqlite">sqlite</option>
                        <option value="pgsql">pgsql</option>
                        <option value="sqlsrv">sqlsrv</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="db_host" class="col-sm-2 control-label">数据库地址</label>
                <div class="col-sm-10">
                    <input type="text" name="db_host" class="form-control" id="db_host" placeholder="127.0.0.1">
                </div>
            </div>
            <div class="form-group">
                <label for="db_port" class="col-sm-2 control-label">数据库端口</label>
                <div class="col-sm-10">
                    <input type="text" name="db_port" class="form-control" id="db_port" placeholder="3306">
                </div>
            </div>
            <div class="form-group">
                <label for="db_name" class="col-sm-2 control-label">数据库名字</label>
                <div class="col-sm-10">
                    <input type="text" name="db_name" class="form-control" id="db_name" placeholder="maxshop">
                </div>
            </div>
            <div class="form-group">
                <label for="db_username" class="col-sm-2 control-label">数据库账号</label>
                <div class="col-sm-10">
                    <input type="text" name="db_username" class="form-control" id="db_username" placeholder="root">
                </div>
            </div>
            <div class="form-group">
                <label for="db_password" class="col-sm-2 control-label">数据库密码</label>
                <div class="col-sm-10">
                    <input type="password" name="db_password" class="form-control" id="db_password">
                </div>
            </div>
            <legend>应用配置：</legend>
            <div class="form-group">
                <label for="cache_driver" class="col-sm-2 control-label">缓存驱动</label>
                <div class="col-sm-10">
                    <input type="text" name="cache_driver" class="form-control" id="cache_driver" placeholder="file">
                </div>
            </div>
            <div class="form-group">
                <label for="session_driver" class="col-sm-2 control-label">会话驱动</label>
                <div class="col-sm-10">
                    <input type="text" name="session_driver" class="form-control" id="session_driver" placeholder="file">
                </div>
            </div>
            <div class="form-group">
                <label for="queue_driver" class="col-sm-2 control-label">队列驱动</label>
                <div class="col-sm-10">
                    <input type="text" name="queue_driver" class="form-control" id="queue_driver" placeholder="sync">
                </div>
            </div>
            <div class="form-group">
                <label for="redis_host" class="col-sm-2 control-label">RedisHost</label>
                <div class="col-sm-10">
                    <input type="text" name="redis_host" class="form-control" id="redis_host" placeholder="127.0.0.1">
                </div>
            </div>
            <div class="form-group">
                <label for="redis_password" class="col-sm-2 control-label">Redis密码</label>
                <div class="col-sm-10">
                    <input type="password" name="redis_password" class="form-control" id="redis_password">
                </div>
            </div>
            <div class="form-group">
                <label for="redis_port" class="col-sm-2 control-label">Redis端口</label>
                <div class="col-sm-10">
                    <input type="text" name="redis_port" class="form-control" id="redis_port" placeholder="6379">
                </div>
            </div>
            <div class="form-group">
                <p style="text-align: center"><button type="submit" class="btn btn-primary">下一步</button></p>
            </div>
        </form>
    </div>

</div>
@endsection

@section('my-js')
    <script>
        validator = $('#env-form').validate({
            // debug:true,
            success:function (succ,element) {
                if (element.name == "db_password") {
                    succ.text("验证通过，数据库连接成功").addClass("success");
                }
            },
            rules:{
                appurl:{
                    required:true,
                    url:true,
                },

                db_password:{
                    remote:{
                        url:'/install/db_validate',
                        type:'get',
                        data:{
                            db_username:function () {
                                return $('input[name=db_username]').val()
                            },
                            db_name:function () {
                                return $('input[name=db_name]').val()
                            },
                            db_port:function () {
                                return $('input[name=db_port]').val()
                            },
                            db_host:function () {
                                return $('input[name=db_host]').val()
                            }
                        },
                    },
                }
            },
            messages:{
                db_password:{
                    remote:"数据库连接失败，请输入正确的值",
                    success:"demo"
                }
            },
        });
        $.validator.addClassRules({
            'form-control':{
                required:true
            }
        });
    </script>
@endsection
