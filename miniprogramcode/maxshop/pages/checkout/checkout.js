// pages/checkout/checkout.js
var app = getApp()
var max = require('../../utils/max-request')
Page({

    /**
     * 页面的初始数据
     */
    data: {
        addressAuth:true,
        address:null,
        title:'订单结算',
        payment:null,
        tip:'',
        choosenPayment: '微信支付',
        radio:0,
        order_info:null,
        addressTitle:'请选择收货地址'
    },
    //订单结账按钮
    onSubmit(){
      if(this.data.address==null){
          this.setData({
            tip:"你要选择收货地址才能提交订单"
          })
          return
      }
            max.request({
                url:app.API('order_create'),
                method:'POST',
                data:{cart_data:this.data.order_info,
                    address:this.data.address,
                    payment:this.data.choosenPayment}
            }).then((res)=>{
                console.log(res)
                var order_id = res.data.order_id
                app.data.cart = null
                //支付
                wx.requestPayment({
                  nonceStr: res.data.data.nonceStr,
                  package: res.data.data.package,
                  paySign: res.data.data.paySign,
                  signType:res.data.data.signType,
                  timeStamp: res.data.data.timeStamp,
                  success:(res)=>{
                    if(res.errMsg=="requestPayment:ok"){
                      wx.navigateTo({
                        url: '/pages/order-list/order-list?index=1',
                      })
                    }
                  },
                  complete:(res)=>{
                    wx.removeStorageSync('checkout_cart')
                    this.setData({
                      order_info:null
                    })
                    if(res.errMsg!="requestPayment:ok"){
                      //失败，取消，直接跳转到未完成的订单列表
                      wx.navigateTo({
                        url: '/pages/order-list/order-list?index=0',
                      })
                    }
                  }
                })
            })
    },
    //wx.authorize后期修改 成这个API
    chooseAddress(e) {
        wx.chooseAddress({
            success: (res) => {
              if(res.errMsg=="chooseAddress:ok"){
                this.setData({
                  address:res,
                  tip:"",
                  addressTitle:"点击更换地址",
                })
              }
            },
            fail: (res) => {
                wx.getSetting({
                  success: (res) => {
                      if(res.authSetting['scope.address']=='false'){
                        wx.showToast({
                            title: '未授权！请点击授权',
                            icon:'none'
                          })
                         this.setData({
                          addressAuth:false
                         })
                      }else{
                        wx.showToast({
                            title: '你还未选择收获地址',
                            icon:'none'
                          })
                      }
                  },
                })
            },
        })
        
    },
    openSetting(){
        wx.openSetting({
          success: (res) => {
              if(res.authSetting['scope.address']==true){
                this.setData({
                    addressAuth:true
                })
              }
          },
        })
    },
    onClick(event) {
        var name = event.currentTarget.dataset.name;
        var index = event.currentTarget.dataset.index;
        this.setData({
          radio: index,
          choosenPayment: name
        });
    },
    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
        var checkout_cart = wx.getStorageSync('checkout_cart')

        if(checkout_cart!=''){
          this.setData({
            order_info:checkout_cart
          })
        }
        max.request({
          url: app.API('get_payment'),
          data:{type:'wechatMiniProgram'}
        }).then((res)=>{
            // app.data.cart.price = parseFloat(app.data.cart.price)
            this.setData({
                payment:res.data,
                cart: app.data.cart
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
      if(this.data.order_info==null){
        wx.showModal({
          title: '订单消息',
          content: '订单已经结算或者不存在',
          showCancel:false,
          success (res) {
            if (res.confirm) {
              wx.reLaunch({
                url: '/pages/cart/cart',
              })
            }
          }
        })
      }
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