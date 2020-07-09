
var max_http = opt => {
  //是否显示loading
  if (opt.showLoading == true) {
    wx.showLoading({
      title: opt.loadTitle==undefined?'正在加载...':opt.loadTitle,
      mask: true
    })
  }
  //手动加入cookie来使用laravel的session
  var laravel_session = wx.getStorageSync('laravel_session')
  if (laravel_session == '' || laravel_session == null) {
    var header = {}
  } else {
    var header = {
      'Cookie': laravel_session
    }
  }
  var max_token = wx.getStorageSync('max_token')
  var user_id = wx.getStorageSync('user_id')
  //合并max_token,没有此值请求不了API接口
  var data = Object.assign({}, {
    max_token: max_token,
    user_id:user_id
  }, opt.data)
  return new Promise((resolve, reject) => {
    
    wx.request({
      url: opt.url,
      header: header,
      method: opt.method,
      data: data,
      success: (res => {
        var app = getApp()
        if (opt.showLoading == true) {
          wx.hideLoading()
        }
        var nowSession = wx.getStorageSync('laravel_session')
        if(nowSession!=res.cookies[1]){
          wx.setStorageSync('laravel_session', res.cookies[1])
          wx.setStorageSync('debug', 'session_change')
        }
        if(res.statusCode==200)resolve(res)
        //如果是403无权访问就重新登陆
        if(res.statusCode==403){
          app.maxLogout()
        }
        //定期刷新max_token，加强安全
        if(res.header['Max-need-login']=='true'){
          app.maxLogin()
        }
        if(res.header['Max-token-invalid']=='true'){
          // todo 用户退出方法，app.js
          app.maxLogout()
        }
      }),
      fail: (res => {
        reject(res)
      }),
      complete: (res => {
        console.log('请求url:', opt.url, '请求的方法:', opt.method==undefined?'GET':opt.method, '参数:', data, '响应数据:', res)
      })
    })
  })
}

module.exports = {
  request: max_http
}