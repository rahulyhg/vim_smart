<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
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
      <!--            <span class="weui-form-preview__value"><?php echo ($info["msg_type_name"]); ?>/<?php echo ($info["send_type_name"]); ?></span>-->
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
  <div v-if="loading.on">{{loading.msg}}</div>
  <div class="weui-progress">
    {{progress_info.scale}}
    <div class="weui-progress__bar">
      <div class="weui-progress__inner-bar js_progress" :style="{width:progress_info.percent}"></div>
    </div>
    <a href="javascript:;" class="weui-progress__opr" @click="closeWindow">
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
      progress_info:{
        percent:'0%',
        scale:'0/'+ app_json.msg_info.ruser_num,
        status:-1, //-1 等待开始  0 暂停中 1 发送中 2 发送完成
      },
      loading:{
        on:true,
        msg:"等待开始..."
      }

    },
    computed:{
      action_name:function(){
        var desc = "";
        switch (this.progress_info.status){
          case 2 :
            desc = "发送完成"
            break;
          case 1 : //进行中
            desc = "暂停发送"
            break;
          case 0 :
            desc = "继续发送"
            break
          case -1 :
            desc = "等待开始"
            break
          default:
            break;
        }
        return desc;

      },
    },

    mounted: function () {
      if(this.msg_info.send_type==="fixed"){

      }


      var func = this.set_progress,
          self = this;
      setTimeout(self.set_progress, 1000)
      console.log(this.msg_info);

    },

    methods: {
      closeWindow:function(){
        if(window.confirm("关闭后将暂停发送，确认关闭？")){
          this.stop_send();
          WeixinJSBridge.call('closeWindow');
        }

      },
      set_progress: function () {
        var msg_id = this.msg_info.id,
            self = this;

        this._get("<?php echo U('get_send_msg_progress');?>", {msg_id: msg_id}, function (re) {
          if(re.data===null){//未开始
            self.loading = {
              on:true,
              msg:"等待开始..."
            }

            window.setTimeout(self.set_progress,1000,1000);
          }else{
            self.loading =  self.loading = {
              on:false,
              msg:"等待开始..."
            }
            this.progress_info = Object.assign(self.progress_info,re.data);

            if(re.data.openids_count>0){//进行中

              window.setTimeout(self.set_progress,1000);

            }else{//已完成

              alert("已完成");
            }

          }
          console.log(self.progress_info)
        });
      },
      ctr:function(){
        switch (this.progress_info.status){
          case 1 :
            this.stop_send();
            break;
          case 0 :
            this.go_on_send();
            break
          default:
            break;
        }
      },
      stop_send:function(){
        var msg_id = this.msg_info.id,
            self = this;
        self.loading =  self.loading = {
          on:true,
          msg:"暂停中..."
        }
        this._get("<?php echo U('stop_send');?>", {msg_id: msg_id}, function (re) {
         //

        });
      },

      go_on_send:function(){
        var msg_id = this.msg_info.id,
            self = this;
        self.loading =  self.loading = {
          on:true,
          msg:"即将发送..."
        }
        this._get("<?php echo U('go_on_send');?>", {msg_id: msg_id}, function (re) {
          //
        });
      }

    }
  });




</script>
</body>
</html>