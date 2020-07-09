<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>maxshop-媒体管理</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            width: 100%;
            height: 100%;
            background-color: #f2f2f2;
        }

        .max-media-wrapper {
            margin: 80px auto;
            width: 70%;
            /*height: 720px;*/
            background-color: #ffffff;
            padding: 5px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .max-media-wrapper .max-media-head-wrapper {
            height: 48px;
            padding: 0px 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .max-media-wrapper .max-media-footer-wrapper {
            height: 48px;
            padding: 0px 5px;
            display: flex;
            margin-bottom: 5px;
            justify-content: center;
            align-items: center;
        }

        .max-input {
            height: 34px;
            vertical-align: top;
        }

        .max-checkbox {
            /*vertical-align: top;*/
            width: 26px;
            height: 26px;
            margin: 0px !important;
        }

        .max-media-wrapper .max-media-content-wrapper {
            /*height: 100%;*/
            width: 100%;
            padding: 10px;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
        }

        .max-media-wrapper .max-media-content-wrapper .max-media-item {
            width: 180px;
            height: 180px;
            margin: 10px 10px 0px 10px;
            /*position: absolute;*/
        }

        .max-media-wrapper .max-media-content-wrapper .max-media-item .max-media-item-head {
            position: relative;
            z-index: 998;
            width: 100%;
            height: 26px;
            opacity: 0.5;
            display: flex;
            align-items: center;
        }

        .max-media-wrapper .max-media-content-wrapper .max-media-item .max-media-item-head span {
            margin-left: 5px;
            font-size: 14px;
            font-weight: bold;
        }

        .max-media-wrapper .max-media-content-wrapper .max-media-item .max-media-item-content {
            padding: 0px;
            height: 100%;
            width: 100%;
            margin-top: -26px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
    </style>
</head>
<body>
<div class="max-media-wrapper">
    <div class="max-media-head-wrapper">
        <div>
            <button class="btn btn-info">上传</button>
            <button class="btn btn-warning">删除</button>
        </div>
        <div>
            <input class="max-input" type="text" placeholder="请输入查找的标题">
            <button class="btn btn-primary">查找</button>
        </div>
    </div>
    <div class="max-media-content-wrapper">
        @foreach($images as $image)
            <div class="max-media-item">
                <div style="position: absolute;width: 180px;height: 180px">
                    <div class="max-media-item-head">
                        <input class="max-checkbox" type="checkbox">
                    </div>
                    <div class="max-media-item-content">
                        <img style="width: 100%" src="{{$image['path']}}" alt="">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="max-media-footer-wrapper">
        <ul class="pagination">
            <li><a href="#">&laquo;</a></li>
            @for($i=1;$i<=$have_page;$i++)
            <li><a href="/admin/media/management/{{$i}}">{{$i}}</a></li>
            @endfor
            <li><a href="#">&raquo;</a></li>
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
    {{--按键功能--}}

</script>
</body>
</html>
