<!DOCTYPE html>
<html>
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
    <style>
        .max-wrap{
            display: flex;
            flex-direction: column;
            width: 80%;
            margin: 10px auto;
        }
        .max-item{
            display: flex;
            margin-top: 20px;
        }
        .max-label{
            font-size: 20px;
        }
        .max-input-text{
            width: 120px;
            height: 20px;
            margin-left: 10px;
        }
        .max-select{
            width: 125px;
            height: 26px;
            margin-left: 10px;
        }
        .max-select option{
            width: 125px;
            height: 20px;
        }
        .max-label-wrap{
            width: 80px;
            width: 120px;
        }
        .max-btn{
            border: 0;
            padding: 10px 20px;
            border-radius: 5px;

        }
    </style>
</head>
<body>
    <div class="max-wrap">
        <div class="max-item">
            <div class="max-label-wrap"><label class="max-label" for="name">分类名字</label></div><input class="max-input-text" type="text" name="name">
        </div>
        <div class="max-item">
            <div class="max-label-wrap"><label class="max-label" for="parent_id">父分类</label></div>
            <select class="max-select" name="parent_id" id="parent_id">
                <option value="0">无</option>
                @foreach($categories as $category)
                    <option value="{{$category->category_id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="max-item">
            <div class="max-label-wrap"><label class="max-label" for="parent_id">分类页显示</label></div>
            <select class="max-select" name="display" id="display">
                <option value="sub_category">子分类</option>
                <option value="product">产品</option>
                <option value="both">两者都显示</option>
            </select>
        </div>
        <div class="max-item">
            <div class="max-label-wrap"><label class="max-label" for="preview">缩略图</label></div>
            <img id="preview" style="width: 80px"  src="/images/icon-add.png" onclick="$('#preivew_btn').click()" alt="">
            <input id="preivew_btn" type="file" name="preview" style="display: none" onchange="return uploadImageToServer('preivew_btn','images','preview')">
        </div>
        <div class="max-item" style="align-items: center;justify-content: center">
            <button class="max-btn" onclick="category_create()" >创建分类</button>
        </div>
    </div>
@include('Admin.Component.footer')
    <script type="text/javascript" src="/js/uploadFile.js"></script>
    <script type="text/javascript">
        function category_create() {
            var name = $('input[name=name]').val()
            var parent_id = $('#parent_id option:selected').val()
            var display = $('#display option:selected').val()
            var preview_img = $('#preview').attr('src')=="/images/icon-add.png"?'null':$('#preview').attr('src')
            $.ajax({
                url:'/service/category_add',
                method:'POST',
                data:{
                    name:name,
                    parent_id:parent_id,
                    preview_img:preview_img,
                    display:display,
                    _token:'{{csrf_token()}}'
                },
                success:function () {
                    var index = parent.layer.getFrameIndex(window.name)
                    parent.layer.close(index)
                }
            })
        }
    </script>
</body>
</html>
