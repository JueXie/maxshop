// pages/cart/cart.js
var app = getApp()
var max = require('../../utils/max-request')
Page({

    /**
     * 页面的初始数据
     */
    data: {
        cart: [],
        title:'购物车',
        tip:'',
        radio:0
    },
    onSubmit() {
        if(this.data.cart==[]){
            this.setData({
                tip:'购物车里没有任何产品~'
            })
            return
        }else{
        
            wx.setStorage({
              data: this.data.cart,
              key: 'checkout_cart',
              success:(res)=>{
                wx.navigateTo({
                  url: '/pages/checkout/checkout',
                })
              }
            })
        }
    },
    //先偷懒，后期不要change事件，改成mins，plus，blur事件处理购物车逻辑
    onCountChange(e) {
        var product_id = e.currentTarget.id
        var count = e.detail
        app.cartUpdate(product_id, count, (res) => {
            this.setData({
                cart: res.data
            })
        })
    },
    
   

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
        var order_id = options.order_id;
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
        // app.data.cart.price = parseFloat(app.data.cart.price)
        this.setData({
            cart: app.data.cart
        })
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

    },

    /**
     * 用户点击右上角分享
     */
    onShareAppMessage: function () {

    }
})