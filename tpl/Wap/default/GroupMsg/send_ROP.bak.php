<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>消息发送</title>
  <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
  <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
  <style>
    .container {
      padding: 15px;
      background-color: #FFF;
    }

    .container img {
      width: 100% !important;
      margin: 0 auto;
      display: block
    }
  </style>

</head>
<body>

<div id="app">
  <div class="weui-form-preview">
    <!--    发起人-->
    <div class="weui-form-preview__bd">
      <div class="weui-form-preview__item">
        <label class="weui-form-preview__label">发起人</label>
        <span class="weui-form-preview__value">{{msg_info.publish_admin_name}}</span>
      </div>

      <!--        群发类型-->
      <!--        <div class="weui-form-preview__item">-->
      <!--            <label class="weui-form-preview__label">群发类型</label>-->
      <!--            <span class="weui-form-preview__value">{pigcms{$info.msg_type_name}/{pigcms{$info.send_type_name}</span>-->
      <!--        </div>-->
      <!--        发布时间-->
      <div class="weui-form-preview__item">
        <label class="weui-form-preview__label">发布时间</label>
        <span class="weui-form-preview__value">
               <span v-if="msg_info.status==1">{{msg_info.send_date_str}}</span>
                <span v-else>{{msg_info.status_name2}}</span>
            </span>
      </div>
      <!--        发布对象-->
      <div class="weui-form-preview__item">
        <label class="weui-form-preview__label">发布社区</label>
        <span class="weui-form-preview__value">{{msg_info.village_name}}</span>
      </div>
      <div class="weui-form-preview__item">
        <label class="weui-form-preview__label">发布公司</label>
        <span class="weui-form-preview__value">{{msg_info.company_name}}</span>
      </div>
      <div class="weui-form-preview__item">
        <label class="weui-form-preview__label">总人数</label>
        <span class="weui-form-preview__value">{{msg_info.ruser_num}}人</span>
      </div>
    </div>
  </div>
  <br>
  <div v-if="loading">等待开始...</div>
  <div class="weui-progress">
    {{msg_progress_num}}
    <div class="weui-progress__bar">
      <div class="weui-progress__inner-bar js_progress" :style="{width:msg_progress}"></div>
    </div>
    <a href="javascript:;" class="weui-progress__opr">
      <i class="weui-icon-cancel"></i>
    </a>
  </div>
  <div class="weui-footer weui-footer_fixed-bottom">
    <div class="weui-form-preview">
      <div class="weui-form-preview__ft">
        <button type="submit"  @click="ctr()"  class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">{{action_name}}</button>
      </div>
    </div>
  </div>
</div>
<!-- body 最后 -->
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script src="./static/js/vue-resource.min.js"></script>
<script src="./static/js/vuex.js"></script>
<script>
  //get
  Vue.prototype._get = function (url, params, callback) {
    var opt = {
      'params': params
    }
    this.$http.get(url, opt).then(function (response) {
      // 响应成功回调
      if (response.body.err == 0) {
        callback(response.body);
      } else {
        console.log(response.body);
        alert("发生错误");
      }
    }, function (response) {
      alert(response.status + " 发生错误");
    });

  };
  //post
  Vue.prototype._post = function (url, params, callback) {
    this.$http.post(url, params).then(function (response) {
      // 响应成功回调
      if (response.body.err == 0) {
        callback(response.body);
      } else {
        alert("发生错误:" + response.body.msg);
      }
    }, function (response) {
      alert(response.status + " 发生错误");
    });

  };


  new Vue({
    el: '#app',
    data: {
      msg_info: app_json.msg_info,
      msg_progress: '0%',//进度条信息
      msg_progress_num: '0/0',//进度条信息
      ctr_on: app_json.ctr_on,
      loading:true,
      t: null,//定时器

    },
    computed:{
      action_name:function(){
        var desc = "";
        switch (this.ctr_on){
          case 2 :
            desc = "发送完成"
            break;
          case '1' :
            desc = "暂停发送"
            break;
          case '0' :
            desc = "继续发送"
            break
          default:
            break;
        }
        return desc;

      },
    },

    mounted: function () {
      var func = this.set_progress,
          self = this;
      this.t = setTimeout(self.set_progress, 1000)
      console.log(this.msg_info);

    },

    methods: {
      set_progress: function () {
        var msg_id = this.msg_info.id,
            self = this;
        this._get("{pigcms{:U('get_send_msg_progress')}", {msg_id: msg_id}, function (re) {
          if(re.data !== null && re.data.openids.length === 0){//
            self.msg_progress = "100%";
            self.msg_progress_num = re.data.ruser_count.toString() + '/' + re.data.ruser_count.toString();
            self.ctr_on = 2;
            self.loading = false;
          }else {
            if(re.data !== null) self.loading = false;
            self.msg_progress = re.data ? re.data.progress : '0%';
            self.msg_progress_num =  re.data ? re.data.progress_num : '0/0';
            self.ctr_on  = re.data ? re.data.on : self.ctr_on;
            self.t = setTimeout(self.set_progress, 1000)
          }
        });
      },
      ctr:function(){
        switch (this.ctr_on){
          case '1' :
            this.stop_send();
            break;
          case '0' :
            this.go_on_send();
            break
          default:
            break;
        }
      },
      stop_send:function(){
        var msg_id = this.msg_info.id;
        this._get("{pigcms{:U('stop_send')}", {msg_id: msg_id}, function (re) {
          if(re.err!==0){
            alert("发生错误")
          }else{
            console.log('stop_send');

          }

        });
      },

      go_on_send:function(){
        var msg_id = this.msg_info.id;
        this._get("{pigcms{:U('go_on_send')}", {msg_id: msg_id}, function (re) {
          console.log(re);
        });
      }

    }
  });

</script>
</body>
</html>