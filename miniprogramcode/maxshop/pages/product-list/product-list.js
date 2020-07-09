var app = getApp()
var max = require('../../utils/max-request')
Page({
    page:0,//页数
    no_more:false,//没有更多时候触底不再加载
    notify:'',//通知信息
    mode:'products',//进入页面的模式，默认是产品列表，category是分类模式,search是搜索模式
    params:{},//根据模式变换的参数
    name:'',//搜索模式下的关键字
    id:0,//分类模式下的需要检索分类id
    /**
     * 页面的初始数据
     */
    data: {
        title:'产品列表',
        products:[],
        no_more:false,
    },
    addToCart(e){
        var id = e.currentTarget.id
        app.addToCart(id,1,(res)=>{
            console.log(res)
        })
    },
    //封装请求产品的方法
    getProducts(){
        var params = Object.assign({},this.params,{page:this.page})
        max.request({
            url:app.API('products'),
            data:params,
        }).then((res)=>{
            this.setData({
                products:this.data.products.concat(res.data)
            })
            if(res.data.length==0){
                this.no_more = true
                if(this.data.products.length==0){
                    this.setData({
                        no_more:true
                    })
                }
            }
            this.page++
        })
    },
    GoBack(){
        wx.navigateBack()
    },
    goToDetail(e){
        var id = e.currentTarget.id
        wx.navigateTo({
          url: '/pages/product-detail/product-detail?product_id='+id,
        })
    },
    secletItem(e){
        var id = e.currentTarget.id
        wx.navigateTo({
            url: '/pages/product-detail/product-detail?product_id='+id,
          })
    },
    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
        //给页面属性赋值
        this.mode = options.mode
        this.name = options.name
        this.id = options.id

        //区分模式
        switch(this.mode){
            case "products":
                this.params = {pre_page:5}
                this.getProducts()
                break;
            case "category":
                //大概率没写好用到这里再写
                this.setData({title:this.name})
                this.params = {pre_page:5,category_id:this.id}
                this.getProducts()
                break;
            case "search":
                //大概率没写好用到这里再写
                this.setData({title:'含有'+name+'的产品'})
                this.getProducts()
                break;
        }
    },

    /**
     * 生命周期函数--监听页面初次渲染完成
     */
    onReady: function () {
        
    },

    /**
     * 生命周期函数--监听页面显示
     */
    onShow: function () {
        
    },

    /**
     * 生命周期函数--监听页面隐藏
     */
    onHide: function () {

    },

    /**
     * 生命周期函数--监听页面卸载
     */
    onUnload: function () {
        
    },

    /**
     * 页面相关事件处理函数--监听用户下拉动作
     */
    onPullDownRefresh: function () {
        
    },

    /**
     * 页面上拉触底事件的处理函数
     */
    onReachBottom: function () {
        if(!this.no_more){
            this.getProducts()
        }else{
            wx.showToast({
              title: '没有更多了~',
              icon:'none'
            })
        }
    },

    /**
     * 用户点击右上角分享
     */
    onShareAppMessage: function () {

    }
})