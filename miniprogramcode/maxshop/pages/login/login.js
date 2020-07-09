// pages/demo/demo.js
var app = getApp()
var max = require('../../utils/max-request.js')
Page({

  /**
   * 页面的初始数据
   */
  data: {

  },

  getUserInfo(res) {
    app.data.userInfo = res.detail.userInfo
    if (app.data.userInfo == undefined) {
      wx.showToast({
        title: '授权登陆才能获得更好的体验',
        icon: 'none'
      })
      return
    }
    wx.setStorageSync('userInfo', res.detail.userInfo)
    app.maxLogin((res)=>{
      console.log(res)
      if(res.statusCode==200){
        wx.reLaunch({
          url: '/pages/index/index',
        })
      }else{
        wx.showToast({
          title: '发生错误',
          icon:'none'
        })
      }
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var user_id = wx.getStorageSync('user_id')
    if(user_id != ''&&user_id != null){
      wx.reLaunch({
        url: '/pages/index/index',
      })
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

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})