//获取应用实例
var app = getApp();

Page({
    data: {
        goods_list: [],
        default_address: {},
        yun_price: "0.00",
        pay_price: "0.00",
        total_price: "0.00",
        params: null,
        note: ''
    },
    onShow: function () {
        var that = this;
        that.getOrderInfo()
    },
    onLoad: function (e) {
        var that = this;
        if (e.hasOwnProperty('data')){
            that.setData({
                params: JSON.parse(e.data)
            })
        }
    },
    getOrderInfo: function(){
        let that = this
        let data = {
            'type': that.data.params.type,
            'foods': JSON.stringify((that.data.params.foods))
        }
        wx.request({
            url: app.buildUrl("/v1/order/info"),
            header: app.getRequestHeader(),
            method: 'POST',
            data: data,
            success: function (res) {
                var resp = res.data;
                if (resp.code != 200) {
                    app.alert({"content": resp.msg});
                    return;
                }
                that.setData({
                    goods_list: resp.results.food_list,
                    default_address: resp.results.default_address,
                    yun_price: resp.results.yun_price,
                    pay_price: resp.results.pay_price,
                    total_price: resp.results.total_price,
                });
                // if( that.data.default_address ){
                //     that.setData({
                //         express_address_id: that.data.default_address.id
                //     });
                // }
            }
        });

    },
    inputRemark: function (e){
        this.setData({
            note: e.detail.value
        })
    },
    createOrder: function (e) {
        wx.showLoading();
        let that = this;
        let data = {
            'type': that.data.params.type,
            'foods': JSON.stringify(that.data.params.foods),
            'note': that.data.note,
            'yun_price': that.data.yun_price,
            'express_address_id': that.data.default_address.id
        }
        wx.request({
            url: app.buildUrl('/v1/order/createOrder'),
            header:app.getRequestHeader(),
            method: 'POST',
            data: data,
            success: function (res) {
                wx.hideLoading()
                let resp = res.data;
                if (resp.code !== 200){
                    app.alert({'content': resp.msg})
                    return
                }
                wx.navigateTo({
                    url: "/pages/my/order_list"
                });
            }
        })
    },
    addressSet: function () {
        wx.navigateTo({
            url: "/pages/my/addressSet"
        });
    },
    selectAddress: function () {
        wx.navigateTo({
            url: "/pages/my/addressList"
        });
    }

});
