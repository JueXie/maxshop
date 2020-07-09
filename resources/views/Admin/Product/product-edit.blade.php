<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
@include('Admin.Component.header')
<meta name="csrf-token" content="{{csrf_token()}}">
<body>
<div class="page-container">
    <form action="" method="post" class="form form-horizontal" id="form-article-add">
        <legend>产品基本信息：</legend>
        <div class="row cl">
            <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>产品标题：</label>
            <div class="formControls col-xs-2 col-sm-2">
                <input type="text" class="input-text" value="{{$product['title']}}" placeholder="" id="title" name="title">
            </div>
            <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>产品信息：</label>
            <div class="formControls col-xs-2 col-sm-2">
                <input type="text" class="input-text" value="{{$product['info']}}" placeholder="" id="info" name="info">
            </div>
            <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>产品分类：</label>
            <div class="formControls col-xs-2 col-sm-2">
                <span class="select-box">
                    <select class="select" name="cid" id="cid">
                        @foreach($categories as $category)
                            <option value="{{$category['category_id']}}">{{$category['name']}}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>
        {{--主图开始--}}
        <div class="row cl" style="display: flex;align-items: center">
            <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>产品主图：</label>
            <div class="formControls col-xs-4 col-sm-6" style="margin-left: 10px">
                <img id="main_img" style="width: 120px" src="{{$product['main_img']}}" alt=""
                     onclick="img_click(this)">
                <input type="file" style="display: none" name="preview" class="input-text" id="main_img_btn"
                       onchange="return input_change(this)">
            </div>
        </div>
        {{--主图结束--}}
        {{--轮播图开始--}}
        <div class="row cl" style="display: flex">
            <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>产品轮播图：</label>
            <div class="formControls col-xs-4 col-sm-6" style="display: flex;flex-direction: column">
                <div class="slide-wrap" style="display: flex">
                    @foreach($product['slide_img'] as $item)
                    <div class="slide-item" style="margin-left: 10px">
                        <img id="slide_img" class="slide_img" style="width: 120px" src="{{$item}}" alt=""
                             onclick="img_click(this)">
                        <input type="file" name="preview" style="display: none" id="slide_img_btn" class="slide_img_btn"
                               onchange="return input_change(this)">
                    </div>
                    @endforeach
                </div>
                <button onclick="add_slide_img()" type="button"
                        style="margin-top: 20px;width:10%;border: 0;padding: 10px;border-radius: 5px;font-weight: bold ">
                    添加轮播图
                </button>
            </div>
        </div>
        {{--轮播图结束--}}
        {{--详情页开始--}}
        <div class="row cl" style="display: flex">
            <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>产品详情图：</label>
            <div class="formControls col-xs-4 col-sm-6" style="display: flex;flex-direction: column">
                <div class="content-wrap" style="display: flex">
                    @foreach($product['content'] as $item)
                    <div class="content-item" style="margin-left: 10px">
                        <img id="content_img" class="content_img" style="width: 120px" src="{{$item}}" alt=""
                             onclick="img_click(this)">
                        <input type="file" name="preview" style="display: none" id="content_img_btn"
                               class="content_img_btn" onchange="return input_change(this)">
                    </div>
                    @endforeach
                </div>
                <button onclick="add_content_img()" type="button"
                        style="margin-top: 20px;width:10%;border: 0;padding: 10px;border-radius: 5px;font-weight: bold ">
                    添加详情图
                </button>
            </div>
        </div>
        {{--详情页结束--}}

        <legend>产品高级信息：</legend>
        <div class="row cl" style="display: flex;align-items: center">
            <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>产品类型：</label>
            <div class="formControls col-xs-2 col-sm-2">
                <span class="select-box">
                    <select class="select" name="type" id="type" onchange="type_change()">
                        @if($product['type']=='simple')
                            <option value="simple">单一商品</option>
                            <option value="variable">商品组</option>
                        @else
                            <option value="variable">商品组</option>
                            <option value="simple">单一商品</option>
                        @endif
                    </select>
                </span>
            </div>
            <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>状态：</label>
            <div class="formControls col-xs-1 col-sm-1">
                    <span class="select-box">
                        <select class="select status" name="status" id="status">
                            @if($product['status']=='public')
                                <option value="public">上架</option>
                                <option value="pending">下架</option>
                            @else
                                <option value="pending">下架</option>
                                <option value="public">上架</option>
                            @endif
                        </select>
                    </span>
            </div>
            <div class="formControls col-xs-4 col-sm-6 add-attr-btn" style="display: none;">
                <button onclick="add_attr()" type="button"
                        style="width:10%;border: 0;padding: 10px;border-radius: 5px;font-weight: bold ">添加属性
                </button>
            </div>
        </div>
        <div class="attr-wrap cl" style="margin-top: 20px;display: none">
        @if($attr != [])
            @foreach($attr as $item)
            <div class="row cl attr-item">
                <input class="attr_id" type="hidden" value="{{$item['product_id']}}">
                <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>缩略图：</label>
                <div class="formControls col-xs-1 col-sm-1">
                    <img id="attr_img" class="attr_img" style="width: 50px" src="{{$item['main_img']==null?'/images/icon-add.png':$item['main_img']}}" alt=""
                         onclick="img_click(this)">
                    <input type="file" name="preview" style="display: none" id="attr_img_btn" class="attr_img_btn"
                           onchange="return input_change(this)">
                </div>
                <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>名字：</label>
                <div class="formControls col-xs-1 col-sm-1">
                    <input type="text" class="input-text attr_name" value="{{$item['title']}}" id="attr_name" name="attr_name">
                </div>
                <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>价格：</label>
                <div class="formControls col-xs-1 col-sm-1">
                    <input type="text" class="input-text attr_price" value="{{$item['normal_price']}}" id="attr_price" name="attr_price">
                </div>
                <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>库存：</label>
                <div class="formControls col-xs-1 col-sm-1">
                    <input type="text" class="input-text attr_stock" value="{{$item['stock']}}" id="attr_stock" name="attr_stock">
                </div>
                <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>状态：</label>
                <div class="formControls col-xs-1 col-sm-1">
                    <span class="select-box">
                        <select class="select attr_status" name="attr_status" id="attr_status">
                            @if($item['status']=='public')
                                <option value="public">上架</option>
                                <option value="pending">下架</option>
                            @else
                                <option value="pending">下架</option>
                                <option value="public">上架</option>
                            @endif
                        </select>
                    </span>
                </div>
            </div>
            @endforeach
        @else
                <div class="row cl attr-item">
                    <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>缩略图：</label>
                    <div class="formControls col-xs-1 col-sm-1">
                        <img id="attr_img" class="attr_img" style="width: 50px" src="/images/icon-add.png" alt=""
                             onclick="img_click(this)">
                        <input type="file" name="preview" style="display: none" id="attr_img_btn" class="attr_img_btn"
                               onchange="return input_change(this)">
                    </div>
                    <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>名字：</label>
                    <div class="formControls col-xs-1 col-sm-1">
                        <input type="text" class="input-text attr_name" value="" id="attr_name" name="attr_name">
                    </div>
                    <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>价格：</label>
                    <div class="formControls col-xs-1 col-sm-1">
                        <input type="text" class="input-text attr_price" value="" id="attr_price" name="attr_price">
                    </div>
                    <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>库存：</label>
                    <div class="formControls col-xs-1 col-sm-1">
                        <input type="text" class="input-text attr_stock" value="" id="attr_stock" name="attr_stock">
                    </div>
                    <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>状态：</label>
                    <div class="formControls col-xs-1 col-sm-1">
                    <span class="select-box">
                        <select class="select attr_status" name="attr_status" id="attr_status">
                            <option value="public">上架</option>
                            <option value="pending">下架</option>
                        </select>
                    </span>
                    </div>
                </div>
        @endif
        </div>
        <div class="row cl simple-wrap" style="display: none">
            <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>价格：</label>
            <div class="formControls col-xs-1 col-sm-1">
                <input type="text" class="input-text" value="{{$product['normal_price']}}" placeholder="" id="normal_price" name="normal_price">
            </div>
            <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>促销价：</label>
            <div class="formControls col-xs-1 col-sm-1">
                <input type="text" class="input-text" value="{{$product['hot_sale_price']}}" placeholder="" id="hot_sale_price" name="hot_sale_price">
            </div>
            <label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>库存：</label>
            <div class="formControls col-xs-1 col-sm-1">
                <input type="text" class="input-text" value="{{$product['stock']}}" placeholder="" id="stock" name="stock">
            </div>
        </div>
        <div class="row cl" style="text-align:center;margin-bottom: 100px">
            <button type="button" onclick="product_submit()" class="btn btn-lg btn-primary">保存商品</button>
        </div>
    </form>
</div>

@include('Admin.Component.footer')


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/js/uploadFile.js"></script>
<script type="text/javascript">
    $(function () {
        var type = $('#type option:selected').val()
        if (type=='simple'){
            $('.simple-wrap').show(200)
        }else{
            $('.attr-wrap').show(200)
        }
    })
    function reset_slide_index() {
        $('.slide-item').each(function (i, e) {
            $(this).find('.slide_img').attr('id', 'slide_img' + i)
            $(this).find('.slide_img_btn').attr('id', 'slide_img_btn' + i)
        })
    }

    function reset_content_index() {
        $('.content-item').each(function (i, e) {
            $(this).find('.content_img').attr('id', 'content_img' + i)
            $(this).find('.content_img_btn').attr('id', 'content_img_btn' + i)

        })
    }

    function reset_attr_index() {
        $('.attr-item').each(function (i, e) {
            $(this).find('.attr_img').attr('id', 'attr_img' + i)
            $(this).find('.attr_img_btn').attr('id', 'attr_img_btn' + i)
            $(this).find('.attr_name').attr('id', 'attr_name' + i)
            $(this).find('.attr_price').attr('id', 'attr_price' + i)
            $(this).find('.attr_stock').attr('id', 'attr_stock' + i)
            $(this).find('.attr_status').attr('id', 'attr_status' + i)
        })
    }

    function img_click(self) {
        $(self).next().click()
    }

    function input_change(self) {
        var self_id = $(self).attr('id')
        var pre_id = $(self).prev().attr('id')
        uploadImageToServer(self_id, 'images', pre_id)
    }

    function add_slide_img() {
        var count = $('.slide-item').length
        if (count == 5) {
            return
        }
        $slide_item = $('.slide-item:first').clone(true)
        $slide_item.find('.slide_img').attr('src', '/images/icon-add.png')
        $('.slide-wrap').append($slide_item);
        reset_slide_index()
        return false
    }

    function add_content_img() {
        var count = $('.content-item').length
        if (count == 7) {
            return
        }
        $content_item = $('.content-item:first').clone(true)
        $content_item.find('.content_img').attr('src', '/images/icon-add.png')
        $('.content-wrap').append($content_item)
        reset_content_index()
        return false
    }

    function add_attr() {
        $attr = $('.attr-item:first').clone(true)
        $attr.find('.attr_img').attr('src', '/images/icon-add.png')
        $attr.find('.attr_id').val('0')
        $attr.find('.attr_price').val('')
        $attr.find('.attr_name').val('')
        $attr.find('.attr_stock').val('')
        $('.attr-wrap').append($attr)
        reset_attr_index()
        return false
    }

    function type_change() {
        var type = $('#type option:selected').val()
        console.log(type)
        if (type == 'variable') {
            console.log($('.attr-wrap'))
            $('.simple-wrap').hide(200)
            $('.attr-wrap').show(200)
            $('.add-attr-btn').show(200)
        } else {
            $('.attr-wrap').hide(200)
            $('.add-attr-btn').hide(200)
            $('.simple-wrap').show(200)
        }
    }

    function product_submit() {
        //产品基础信息
        var title = $('#title').val()
        var info = $('#info').val()
        var cid = $('#cid option:selected').val()
        var main_img = $('#main_img').attr('src') == '/images/icon-add.png' ? '' : $('#main_img').attr('src')
        var slide_img = []
        var content_img = []
        //产品高级信息
        var type = $('#type option:selected').val()
        var status = $('#status option:selected').val()
        var normal_price = $('#normal_price').val()
        var hot_sale_price = $('#hot_sale_price').val()
        var stock = $('#stock').val()
        var attr_preview_img = []
        var attr_name = []
        var attr_price = []
        var attr_stock = []
        var attr_status = []
        var attr_id = []
        $('.slide_img').each(function (i, e) {
            //转化成jquery对象
            var img = $(e)
            var src = img.attr('src')
            if (src != '/images/icon-add.png') {
                slide_img.push(src)
            }
        })
        $('.content_img').each(function (i, e) {
            //转化成jquery对象
            var img = $(e)
            var src = img.attr('src')
            if (src != '/images/icon-add.png') {
                content_img.push(src)
            }
        })

        //商品组获取属性变量
        if (type == 'variable') {
            //缩略图
            $('.attr_img').each(function (i, e) {
                var img = $(e)
                var src = img.attr('src')
                if (src != '/images/icon-add.png') {
                    attr_preview_img.push(src)
                }
            })
            $('.attr_id').each(function (i, e) {
                var input = $(e)
                attr_id.push(input.val())
            })
            //名字
            $('.attr_name').each(function (i, e) {
                var input = $(e)
                attr_name.push(input.val())
            })
            //价格
            $('.attr_price').each(function (i, e) {
                var input = $(e)
                attr_price.push(input.val())
            })
            //价格
            $('.attr_stock').each(function (i, e) {
                var input = $(e)
                attr_stock.push(input.val())
            })
            //状态
            $('.attr_status').each(function (i, e) {
                var select = $(e)
                attr_status.push(select.val())
            })
            $.ajax({
                url: '/service/product_edit',
                method: 'POST',
                data: {
                    product_id:'{{$product['product_id']}}',
                    title: title,
                    info: info,
                    cid: cid,
                    main_img: main_img,
                    slide_img: slide_img,
                    content_img: content_img,
                    type: type,
                    status: status,
                    attr_preview_img: attr_preview_img,
                    attr_name:attr_name,
                    attr_price:attr_price,
                    attr_stock:attr_stock,
                    attr_status:attr_status,
                    attr_id:attr_id,
                    _token:'{{csrf_token()}}'
                },
                success:function (res) {
                    console.log(res)
                    // location.reload()
                }
            })
        }else{
            $.ajax({
                url: '/service/product_edit',
                method: 'POST',
                data: {
                    product_id:'{{$product['product_id']}}',
                    title: title,
                    info: info,
                    cid: cid,
                    main_img: main_img,
                    slide_img: slide_img,
                    content_img: content_img,
                    type: type,
                    status: status,
                    normal_price:normal_price,
                    hot_sale_price:hot_sale_price,
                    stock:stock,
                    _token:'{{csrf_token()}}'
                },
                success:function (res) {
                    console.log(res)
                    // location.reload()
                }
            })
        }
    }
</script>
</body>
</html>

