var app = getApp();
var max = require('../../utils/max-request')
Page({

    /**
     * 页面的初始数据
     */
    data: {
        title: "分类",
        categories:[],
        activeKey: 0,
        isActive:0
    },
    onChange(e) {
        console.log(e)
       this.setData({
            isActive:e.detail
       })
    },
    toProductList(e){
        var category_id = e.currentTarget.dataset.id
        var name = e.currentTarget.dataset.name
        wx.navigateTo({
          url: '/pages/product-list/product-list?mode=category&id='+category_id+'&name='+name,
        })
    },
    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
        max.request({
            url:app.API('category')
        }).then((res)=>{
            this.setData({
                categories:res.data
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