var app = getApp();
Page({
    data: {
        statusType: ["待付款", "待发货", "待收货", "待评价", "已完成","已关闭"],
        status:[ "-8","-7","-6","-5","1","0" ],
        currentType: 0,
        tabClass: ["", "", "", "", "", ""]
    },
    statusTap: function (e) {
        var curType = e.currentTarget.dataset.index;
        this.data.currentType = curType;
        this.setData({
            currentType: curType
        });
        this.onShow();
    },
    orderDetail: function (e) {
        wx.navigateTo({
            url: "/pages/my/order_info"
        })
    },
    onLoad: function (options) {
        // 生命周期函数--监听页面加载

    },
    onReady: function () {
        // 生命周期函数--监听页面初次渲染完
    },
    onShow: function () {
        var that = this;
        that.getMyOrderList()
    },
    toPay: function(e){
        let order_sn = e.currentTarget.dataset.id
        let that = this
        app.loading()
        wx.request({
            url: app.buildUrl('/v1/order/pay'),
            header: app.getRequestHeader(),
            method: 'POST',
            data: {
                'order_sn': order_sn
            },
            success: function (res) {
                app.hideLoading()
                let resp = res.data;
                if (resp.code != 200) {
                    app.alert({"content": resp.msg});
                    return;
                }
                let pay_info = resp.results;
                wx.requestPayment({
                    'timeStamp': pay_info.timeStamp,
                    'nonceStr': pay_info.nonceStr,
                    'package': pay_info.package,
                    'signType': 'MD5',
                    'paySign': pay_info.paySign,
                    'success': function (res) {
                    },
                    'fail': function (res) {
                    }
                });
            }
        })
    },
    getMyOrderList: function () {
        app.loading();
        let that = this
        let status = that.data.status[that.data.currentType]
        let data = {'status': status}
        wx.request({
            url: app.buildUrl('/v1/my/order'),
            data:data,
            header:app.getRequestHeader(),
            success: function (res) {
                app.hideLoading()
                var resp = res.data;
                if (resp.code != 200) {
                    app.alert({"content": resp.msg});
                    return;
                }
                that.setData({
                    order_list:resp.results.order_list,
                });
            }
        })
    }
})
