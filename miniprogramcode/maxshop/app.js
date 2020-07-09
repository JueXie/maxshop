//app.js
var max = require('./utils/max-request')
App({
  /**
   * 商城data
   */
  data: {
    host: 'http://maxshop.natapp1.cc',
    userInfo: null,
    cart: null,
    order: null,
    js_code: '',
    title:'maxshop',//标题栏
    coupon: null,
    max_nav_height: '', //nav-bar的高度
    shop_info: [],
    pathname: {
      info: '/store/info', //店铺信息 GET
      products: '/store/products', //获取商品列表 GET
      product: '/store/product/', //获取单个商品/store/product/+id GET
      category:'/store/category', //获取分类 GET
      index: '/store/index', //主页数据 GET
      login: '/miniprogram/login', //登陆返回max_token用于获取数据，后续还需要返回cart数据，order数据 GET
      logout:'/miniprogram/logout',
      cart: '/store/cart', //购物车数据 GET
      cart_add: '/store/cart/add', //向购物车添加产品 POST
      cart_update: '/store/cart/update_with_count', //根据数量更新购物车 POST
      cart_reduce: '/store/cart/reduce', //减去产品 post
      get_payment:'/store/payment/get',//获取支付网关 GET
      order_create:'/store/order/create',//创建订单 POST
      order_get:'/store/order/get', //获取订单详情  GET
      order_info:'/store/order/info',//订单信息
    },
  },
  API(path) {
    return this.data.host + this.data.pathname[path]
  },
  checkCode() {
    console.log("进入checkcode")
    wx.checkSession({
      success: res => {
        if(wx.getStorageSync('code')==""){
          wx.login({
            success: (res) => {
              wx.setStorageSync('code', res.code)
              this.data.js_code = res.code
            },
            fail:(res)=>{
              console.log('登陆失败')
            }
          })
        }else{
          this.data.js_code = wx.getStorageSync('code')
        }
      },
      fail: res => {
        wx.login({
          success: (res) => {
            wx.setStorageSync('code', res.code)
            this.data.js_code = res.code
          },
          fail:(res)=>{
            console.log('登陆失败')
          }
        })
      }
    })
  },

  checkLogin() {
    var userInfo = wx.getStorageSync('userInfo');
    var user_id = wx.getStorageSync('user_id')
    if (userInfo == '' || userInfo == null || user_id == '' || user_id == null) {
      wx.navigateTo({
        url: '/pages/login/login',
      })
    } else {
      //获取购物车信息
      this.getCart()
      //获取商店的基本信息
      this.getShopInfo()
    }
  },
  maxLogin(callback) {
    
    wx.getSetting({
      success: res => {
        if (res.authSetting["scope.userInfo"] == true) {
          wx.getUserInfo({
            success: res => {
              var code, encryptedData, iv, user_id
              code = this.data.js_code
              user_id = wx.getStorageSync('user_id')
              encryptedData = res.encryptedData
              iv = encodeURIComponent(res.iv)
              wx.request({
                url: this.API('login'),
                data: {
                  code: code,
                  user_id: user_id,
                  encryptedData: encryptedData,
                  iv: iv
                },
                success: res => {
                  if (res.statusCode == 200) {
                    wx.setStorageSync('max_token', res.data.max_token)
                    wx.setStorageSync('user_id', res.data.user_id)
                    wx.setStorageSync('laravel_session', res.cookies[1])
                  }
                  if (callback) {
                    callback(res)
                  }
                }
              })
            },
            fail: res => {
              console.log('获取用户信息失败')
            }
          })
        }

      }
    })

  },
  maxLogout() {
    wx.clearStorageSync()
    max.request({
      url:this.API('logout'),
    })
    wx.navigateTo({
      url: '/pages/login/login',
    })
  },
  addToCart(product_id, count, callback) {
    max.request({
      url: this.API('cart_add'),
      method: 'POST',
      showLoading: true,
      loadTitle: '正在加入购物车',
      data: {
        product_id: product_id,
        count: count
      },
    }).then((res) => {
      if (res.statusCode == 200) {
        wx.showToast({
          title: '添加成功',
        })
        this.data.cart = res.data
        if (callback) callback(res)
      } else {
        console.log('请求发生错误')
      }
    })
  },
  cartUpdate(product_id, count, callback) {
    max.request({
      url: this.API('cart_update'),
      method: 'POST',
      data: {
        product_id: product_id,
        count: count
      },
    }).then((res) => {
      this.data.cart = res.data
      if (callback) {
        callback(res)
      }
    })
  },
  getCart(callback) {
    max.request({
      url: this.API('cart'),
    }).then((res) => {
      if (res.statusCode == 200) {
        this.data.cart = res.data
        if (callback) {
          callback(res)
        }
      } else {
        console.log('请求发生错误')
      }
    })
  },

  getShopInfo() {
    max.request({
      url: this.API('info')
    }).then((res) => {
      this.data.shop_info = res.data
    })
  },
  initNavBarHeight() {
    wx.getSystemInfo({
      success: (e) => {
        // 获取右上角胶囊的位置信息
        let info = wx.getMenuButtonBoundingClientRect()
        this.data.max_nav_height = info.bottom + info.top - e.statusBarHeight+'px'
      },
    })
  },
  onLaunch: function () {

    //检查以及刷新code
    this.checkCode()
    //检查登陆
    this.checkLogin()
    //初始化navbar高度
    this.initNavBarHeight()

  }
})