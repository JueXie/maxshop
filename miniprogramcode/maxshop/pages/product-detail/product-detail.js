// pages/product-detail/product-detail.js
var app = getApp()
var max = require('../../utils/max-request')
Page({
  //定义常用页面属性
 select_product_id:'',
  /**
   * 页面的初始数据
   */
  data: {
    title:"产品详情",
    sys_width:wx.getSystemInfoSync().windowWidth+'px',
    shop_info:[],
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    this.select_product_id = options.product_id;
    max.request({
      url: app.API('product')+options.product_id,
    }).then((res)=>{
      var product = res.data
      product.slide_img.unshift(product.main_img)
      this.setData({
        product:product
      })
    })
  },
  // 商品导航方法
  onClickIcon() {
    console.log('点击图标');
  },

  onClickButton() {
    console.log('点击按钮');
  },
  addToCart(){
    app.addToCart(this.select_product_id,1,(res)=>{console.log(res)})
  },
  productAttr(e){
    console.log(e)
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