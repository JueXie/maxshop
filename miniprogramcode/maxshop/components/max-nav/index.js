var app = getApp()
Component({
    properties: {
        title: String,
        backgroundColor:String
    },
    data:{
        height:'44px',
    },
    attached: function () {
        this.setData({
          height: app.data.max_nav_height,
        })
      },
    methods:{
        _navigateBack(){
            wx.navigateBack({
                //当没有上一页的时候跳转到index
                fail:()=>{
                    wx.switchTab({
                      url: '/pages/index/index',
                    })
                }
            })
        },

    }
})