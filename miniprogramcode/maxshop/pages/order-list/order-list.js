var max = require('../../utils/max-request')
var app = getApp()
Page({

    /**
     * 页面的初始数据
     */
    //0:待支付，1：待发货，2：运输中，3：已完成
    index: 0,
    data: {
        title: '订单列表',
        itemheight: wx.getSystemInfoSync().screenWidth * 0.8 / 2.4 + 'px',
        order_list: null,
        index: 0,
        //订单列表数据
        pending_list: [],
        paid_list: [],
        logistics_list: [],
        success_list: [],
        //订单列表页数
        pending_list_page:0,
        paid_list_page:0,
        logistics_list_page:0,
        success_list_page:0
    },

    onOrderChange(e) {
        console.log(e)
        this.switchIndex(e.detail.index)
        this.index = e.detail.index
        this.setData({
            index:e.detail.index
        })
    },
    /**
     * 去订单详情页面
     */
    goToOrderDetail(e){
        console.log(e)
        var order_id = e.currentTarget.dataset.orderid;
        console.log(order_id)
        wx.navigateTo({
          url: '/pages/order-detail/order-detail?orderid='+order_id,
        })
    },
    switchIndex(index) {
        switch (index) {
            case 0:
                    this.loadOrder('pending','待支付',this.data.pending_list_page, (res) => {
                        if(res.data=="nomore"){
                            console.log('进入了结尾')
                            wx.showToast({
                              title: '没有更多了',
                              icon:'none'
                            })
                        }else{
                            this.setData({
                                pending_list: this.data.pending_list.concat(res.data),
                                pending_list_page:this.data.pending_list_page+1
                            })
                        }
                    })
                break;
            case 1:
                    this.loadOrder('paid', '待发货',this.data.paid_list_page,(res) => {

                        if(res.data=="nomore"){
                            wx.showToast({
                              title: '没有更多了',
                              icon:'none'
                            })
                        }else{
                            this.setData({
                                paid_list: this.data.paid_list.concat(res.data),
                                paid_list_page:this.data.paid_list_page+1
                            })
                        }
                    })
                break;
            case 2:
                    this.loadOrder('logistics','运输中',this.data.logistics_list_page, (res) => {
                        if(res.data=="nomore"){
                            wx.showToast({
                              title: '没有更多了',
                              icon:'none'
                            })
                        }else{
                            this.setData({
                                logistics_list:this.data.logistics_list.concat(res.data),
                                logistics_list_page: this.data.logistics_list_page+1
                            })
                        }
                    })
                break;
            case 3:
                    this.loadOrder('success','已完成',this.data.success_list_page, (res) => {
                        if(res.data=="nomore"){
                            wx.showToast({
                              title: '没有更多了',
                              icon:'none'
                            })
                        }else{
                            this.setData({
                                success_list:this.data.success_list.concat(res.data),
                                success_list_page:this.data.success_list_page+1
                            })
                        }
                    })
                break;
            default:
                return;
                break;
        }
    },
    /**
     * 加载订单列表的请求封装
     */
    loadOrder(status,tag,page, callback) {
        max.request({
            url: app.API('order_get'),
            data: {
                status: status,
                page:page
            },
        }).then((res) => {
            console.log(res)
            if(res.data instanceof Array){
                res.data.forEach((e, i) => {
                    e.order_data.cart_data.price = e.order_data.cart_data.price / 100
                    e.status = tag
                })
            }
            callback(res)
        })
    },
    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
        var index = parseInt(options.index)
        this.index = index
        this.setData({
            index: index
        })
        this.switchIndex(index)
    },

    /**
     * 生命周期函数--监听页面初次渲染完成
     */
    onReady: function (options) {

    },

    /**
     * 生命周期函数--监听页面显示
     */
    onShow: function () {
        this.setData({
            index: this.index
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
        this.switchIndex(this.data.index)
    },

    /**
     * 用户点击右上角分享
     */
    onShareAppMessage: function () {

    }
})