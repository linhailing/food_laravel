//index.js
//获取应用实例
var app = getApp();
Page({
    data: {
        indicatorDots: true,
        autoplay: true,
        interval: 3000,
        duration: 1000,
        loadingHidden: false, // loading
        swiperCurrent: 0,
        categories: [],
        activeCategoryId: 0,
        goods: [],
        scrollTop: "0",
        loadingMoreHidden: true,
        searchInput: '',
        banners: [],
        hasMore: 0,
        p: 1,
        processing:false
    },
    onLoad: function () {
        wx.setNavigationBarTitle({
            title: app.globalData.shopName
        });
    },
    onShow: function(){
        this.getBannerAndCat()
    },
    getBannerAndCat(){
        let that = this
        wx.request({
            url: app.buildUrl("/v1/food/category"),
            header: app.getRequestHeader(),
            success: function (res) {
                var resp = res.data;
                if (resp.code != 200) {
                    app.alert({"content": resp.msg});
                    return;
                }
                that.setData({
                    banners: resp.results.banners,
                    categories: resp.results.cate_list,
                });
                that.getFoodList();
            }
        });
    },
    getFoodList() {
        let that = this
        if (that.data.processing) return
        if (!that.data.loadingMoreHidden) return
        that.setData({
            processing: true
        })
        if ((that.data.p > that.data.hasMore) && that.data.hasMore > 0) {
            that.setData({
                loadingMoreHidden: false
            })
        }
        wx.request({
            url: app.buildUrl("/v1"),
            header: app.getRequestHeader(),
            data: {
                cat_id: that.data.activeCategoryId,
                q: that.data.searchInput,
                page: that.data.p
            },
            success: function (res) {
                var resp = res.data;
                if (resp.code != 200) {
                    app.alert({"content": resp.msg});
                    return;
                }
                var goods = resp.results.lists;
                that.setData({
                    goods: that.data.goods.concat( goods ),
                    p: that.data.p + 1,
                    processing:false,
                    hasMore: resp.results.last_page
                });
                if( resp.results.last_page == 0 ){
                    that.setData({
                        loadingMoreHidden: false
                    });
                }
            }
        });

    },
    onReachBottom: function(){
        this.getFoodList()
    },
    catClick: function (e) {
        this.setData({
            activeCategoryId: e.currentTarget.id
        });
        this.setData({
            loadingMoreHidden: true,
            p:1,
            goods:[]
        });
        this.getFoodList();
    },
    //事件处理函数
    swiperchange: function (e) {
        this.setData({
            swiperCurrent: e.detail.current
        })
    },
	listenerSearchInput:function( e ){
        app.console(e.detail.value)
        this.setData({
            searchInput: e.detail.value
        });
	 },
	 toSearch:function( e ){
        this.setData({
            p:1,
            goods:[],
            loadingMoreHidden:true
        });
        this.getFoodList();
	},
    tapBanner: function (e) {
        if (e.currentTarget.dataset.id != 0) {
            wx.navigateTo({
                url: "/pages/food/info?id=" + e.currentTarget.dataset.id
            });
        }
    },
    toDetailsTap: function (e) {
        wx.navigateTo({
            url: "/pages/food/info?id=" + e.currentTarget.dataset.id
        });
    }
});
