var max = require('../../utils/max-request')
var app = getApp()
Page({

    /**
     * 页面的初始数据
     */
    data: {
        title:"订单详情",
        order_info:[],
        address:""
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
        console.log(options.orderid)
        max.request({
            url: app.API('order_get'),
            data: {
                order_id:options.orderid
            },
        }).then((res) => {
            res.data.order_data.cart_data.price = parseFloat(res.data.order_data.cart_data.price/100).toFixed(2)
            res.data.order_data.cart_data.normal_price = parseFloat(res.data.order_data.cart_data.normal_price/100).toFixed(2)
            var addressinfo = res.data.order_data.address
            var address = addressinfo.provinceName+addressinfo.cityName+addressinfo.countyName+addressinfo.detailInfo
            this.setData({
                order_info:res.data,
                address:address
            })
        })
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

    },

    /**
     * 用户点击右上角分享
     */
    onShareAppMessage: function () {

    }
})