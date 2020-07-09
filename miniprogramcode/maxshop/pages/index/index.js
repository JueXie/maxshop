//index.js
//获取应用实例
const app = getApp()
var max = require('../../utils/max-request')
Page({
  data: {
    title:'测试的商城',
    products:[],
    cart_total:0,
    hotsaleproducts:{},
    titlebannerheight:wx.getSystemInfoSync().screenWidth/2.4+'px',
    swiperheight:wx.getSystemInfoSync().screenWidth/2.88+'px',
    itemheight:wx.getSystemInfoSync().screenWidth*0.8/2.4+'px',
    hotsaleheight:wx.getSystemInfoSync().screenWidth*0.85/2*3.5+'rpx',
    isActive:1
  },
  goToProductList(){
    wx.navigateTo({
      url: '/pages/product-list/product-list?mode=products',
    })
  },
  goToSearch(){
    wx.navigateTo({
      url: '/pages/search/search',
    })
  },
  scroll(){

  },
  clickitem(e){
    this.setData({
      isActive:e.currentTarget.dataset.id
    })
  },
  // goToCart(){
  //   wx.switchTab({
  //     url: '/pages/cart/cart',
  //   })
  // },
  addToCart(e){
    var product_id = e.currentTarget.dataset.id
    app.addToCart(product_id,1,(res)=>{
      this.setData({
        cart_total:res.data.total
      })
    })
  },
  navigtarToDetail(e){
    console.log(e)
    var produtc_id = e.currentTarget.dataset.id
    wx.navigateTo({
      url: '/pages/product-detail/product-detail?product_id='+produtc_id,
    })
  },
  onLoad: function () {
    //产品列表
    max.request({
      url:app.API('products'),
      data:{pre_page:4},
      method:'GET',
    }).then(res=>{
      this.setData({
        products:res.data
      })
    })
    //后期这段逻辑处理合并到上面的产品列表，减少setData次数
    if(app.data.cart==null){
      app.getCart((res)=>{
        console.log(res)
        this.setData({
          cart_total:res.data.total
        })
      })
    }else{
      this.setData({
        cart_total:app.data.cart.total
      })
    }
  },
  
})
