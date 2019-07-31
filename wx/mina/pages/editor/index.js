let app = getApp()
Page({
    data: {
        formats: {},
        bottom: 0,
        readOnly: false,
        placeholder: '开始输入...',
        _focus: false,
    },
      readOnlyChange() {
        this.setData({
          readOnly: !this.data.readOnly
        })
      },
      onLoad() {
        // wx.loadFontFace({
        //   family: 'Pacifico',
        //   //source: 'url("./assets/Pacifico.ttf")',
        //   success: console.log
        // })
      },
      onEditorReady() {
        const that = this
        wx.createSelectorQuery().select('#editor').context(function (res) {
          that.editorCtx = res.context
        }).exec()
      },
      undo() {
        this.editorCtx.undo()
      },
      redo() {
        this.editorCtx.redo()
      },
      format(e) {
        let { name, value } = e.target.dataset
        if (!name) return
        console.log('format', name, value)
        this.editorCtx.format(name, value)
    
      },
      onStatusChange(e) {
        const formats = e.detail
        this.setData({ formats })
      },
      insertDivider() {
        this.editorCtx.insertDivider({
          success: function () {
            console.log('insert divider success')
          }
        })
      },
      clear() {
        this.editorCtx.clear({
          success: function (res) {
            console.log("clear success")
          }
        })
      },
      removeFormat() {
        this.editorCtx.removeFormat()
      },
      onSubmit: function(e){
        this.editorCtx.getContents({
          success: function(res){
            console.log(res)
          }
        })
      },
      insertDate() {
        const date = new Date()
        const formatDate = `${date.getFullYear()}/${date.getMonth() + 1}/${date.getDate()}`
        this.editorCtx.insertText({
          text: formatDate
        })
      },
      insertImage() {
        const that = this
        wx.chooseImage({
          count: 9,
          sizeType: ['original', 'compressed'],
          sourceType: ['album', 'camera'],
          success: function (res) {
            let data = res.tempFilePaths
            if (data.length < 0){
              app.alert({'content': '请选择图片'})
              return
            }
            for (let i=0;i< data.length; i++){
              wx.uploadFile({
                url: app.buildUrl('/v1/upload/file'),
                filePath: data[i],
                name:'file',
                header: app.getRequestHeader(),
                success: function(res){
                  let resp = JSON.parse(res.data)
                  console.log(resp)
                  if(resp.code == 200){
                    that.editorCtx.insertImage({
                      src: resp.results.url,
                      success: function () {
                        console.log(resp.results.url)
                      }
                    })
                  }
                },
                fail: function(err) {
                  // fail
                  console.log(err)
                }
              })
            }
          }
        })
      }
})