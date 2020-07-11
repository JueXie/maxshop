<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>maxshop登陆页面</title>

    <link rel="stylesheet" type="text/css" href="/css/style.css">

    <script type="text/javascript" src="/js/jquery-1.10.0.js"></script>
    <script type="text/javascript" src="/js/vector.js"></script>

</head>
<body>

<div id="container">
    <div id="output">
        <div class="containerT">
            <h1>管理员登陆</h1>
            <form class="form" id="entry_form" action="/service/admin/login" method="post">
                {{csrf_field()}}
                <input name="adminname" type="text" placeholder="用户名" id="adminname">
                <input name="password" type="password" placeholder="密码" id="password">
                <button type="submit" id="entry_btn">登录</button>
                <div id="prompt" class="prompt"></div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        Victor("container", "output");   //登录背景函数
        $("#entry_name").focus();
        $(document).keydown(function(event){
            if(event.keyCode==13){
                $("#entry_btn").click();
            }
        });
    });
</script>
</body>
</html>