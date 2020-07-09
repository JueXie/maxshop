<style>
    h2{
        font-weight: bold;
    }
    p{
        margin: 0;
    }
    .wrap{
        width: 900px;
        margin: 50px auto;
        display: flex;
        flex-direction: column;
    }
    .item{
        margin: 20px 20px;
        display: flex;
        flex-direction: column;
    }
    .max-input{
        border: 1px #ccc solid;
        width: 100%;
        height: 36px;
        border-radius: 5px;
    }
    .max-input:focus{
        box-shadow: 5px 5px  #0e90d2;
    }
    .max-select{
        width: 100%;
        height: 36px;
        border:1px #ccc solid;
        border-radius: 5px;
    }
    .max-select option{
        padding: 18px 0;
    }
    .content-wrap{
        margin: 20px;
        display: flex;
        flex-direction: column;
    }
    .content-item{
        margin: 5px 0;
        display: flex;
    }
    .content-item p{
        flex: 1;
    }
    .content-item input{
        flex: 1;
    }
    .content-item select{
        flex: 1;
    }
    .content-item button{
        flex: 1;
    }
    .max-button{
        margin:0 20px;
        border: 0;
        border-radius: 5px;
        width: 50px;
    }
    .content-bottom{
        margin: 5px 0;
        display: flex;
    }
    .content-bottom input{
        flex: 1;
    }
    .content-bottom select{
        flex: 1;
    }
    .content-bottom button{
        flex: 1;
    }
</style>

<div class="wrap">
    <div class="item">
        <h2>运输的名字:</h2> <input class="max-input" name="name" style="margin-top: 20px;" type="text" placeholder="示例:顺丰速运" value="">
    </div>
    <div class="item">
        <h2>状态：</h2>
        <select class="max-select" style="margin-top: 20px;" name="status" id="status">
            <option value="allow">启用</option>
            <option value="disallow">禁用</option>
        </select>
    </div>
    <div class="item">
        <h2>运费详情 <span style="font-size: 14px;font-weight: normal">(0.00或者不填为包邮)</span>：</h2>
        <div class="content-wrap">
            <div class="content-bottom">
                <p>批量设置运费：</p>
                <input class="max-input" style="margin: 0 30px" type="text" placeholder="0.00">
                <button onclick="setVal(this)" class="max-button">确定</button>
            </div>
            <div class="content-item">
                <p>广东</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="number" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>广西</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>江苏</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>浙江</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>上海</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>福建</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>北京</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>湖北</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>山东</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>安徽</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>江西</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>湖南</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>河南</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>河北</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>四川</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>海南</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>天津</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>重庆</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>云南</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>贵州</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>山西</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>陕西</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>辽宁</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>吉林</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>黑龙江</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>甘肃</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>青海</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>宁夏</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>内蒙古</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>新疆</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-item">
                <p>西藏</p>
                <select onchange="select_change(this)" class="max-select" style="margin: 0 40px" name="" id="">
                    <option value="allow">配送</option>
                    <option value="disallow">不配送</option>
                </select>
                <input class="max-input cost" type="text" placeholder="邮费：0.00">
            </div>

            <div class="content-bottom" style="text-align: center">
                <button onclick="shipping_submit()" style="border: 0;margin: 20px 300px;padding: 20px 0px;border-radius: 5px">提交</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
<script>
    function select_change(self) {
        var val = $(self).val()
        var input = $(self).next()
        if (val=='disallow'){
            input.attr('disabled',true)
            input.val('')
        }else{
            input.attr('disabled',false)
        }
    }
    function setVal(self) {
        var val = $(self).prev().val()
        $('.cost:enabled').val(val)
    }
    function shipping_submit() {
        var status_arr = []
        var cost_arr = []
        var address_arr = []
        $('.content-item').each(function (i,e) {
            var status = $(this).find('.max-select').val()
            var cost = $(this).find('.cost').val()
            var address =  $(this).find('p').html()
            status_arr.push(status)
            cost_arr.push(cost)
            address_arr.push(address)
        })
        var status = $('#status option:checked').val()
        var name = $('input[name=name]').val()
        $.ajax({
            url:'/service/shipping/add',
            data:{name:name,status:status,status_arr:status_arr,cost_arr:cost_arr,address_arr:address_arr,_token:'{{csrf_token()}}'},
            method:'POST',
            success:function (res) {
                alert(res)
                location.reload()
            }
        })
    }
</script>
