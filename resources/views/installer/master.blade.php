<!DOCTYPE html>
<html>
<head>
    <title>mb商城环境安装向导</title>
    <link rel="stylesheet" href="/css/commo.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="/js/jquery-1.10.0.js"></script>
    <script src="/js/jquery.validate-1.13.1.js"></script>
    <script src="/js/messages_zh.js"></script>
    <style>
        body{
            background-color: #ccdbe4;
        }
        label.error{
            font-size: 12px;
            color:red;
        }
    </style>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    @yield('my-css')
</head>

<body>
@yield('content')

@yield('my-js')
</body>
</html>
