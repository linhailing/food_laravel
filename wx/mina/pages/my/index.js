//获取应用实例
var app = getApp();
Page({
    data: {
        user_info: []
    },
    onLoad() {},
    onShow() {
        let that = this;
        that.getUserInfo()
    },
    getUserInfo: function(){
        let that = this
        app.loading()
        wx.request({
            url: app.buildUrl('/v1/member'),
            data: {},
            header: app.getRequestHeader(), // 设置请求的 header
            success: function(res){
                app.hideLoading()
                if(res.data.code != 200){
                    app.alert({'content': res.data.msg,'code': res.data.code})
                    return
                }
                that.setData({
                    user_info: res.data.results.member
                })
            }
        })
    }
});