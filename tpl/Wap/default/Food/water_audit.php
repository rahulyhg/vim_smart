<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>桶装水</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
    <style>
        .container{  padding:15px;  background-color: #FFF;}
        .container img{ width:100% !important; margin: 0 auto;display: block}
    </style>

</head>
<body>
<div class="weui-form-preview">
    <!--    发起人-->
    <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">订单号</label>
            <span class="weui-form-preview__value">{pigcms{$data[0]['orderid']}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">发起人</label>
            <span class="weui-form-preview__value">{pigcms{$data[0]['name']}</span>
        </div>

        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">联系方式</label>
            <span class="weui-form-preview__value"><a href="tel:{pigcms{$data[0]['phone']}">{pigcms{$data[0]['phone']}</a></span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">送货地址</label>
            <span class="weui-form-preview__value">{pigcms{$data[0]['true_address']}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">发起时间</label>
            <span class="weui-form-preview__value">{pigcms{$data[0]['redeem_time']|date="Y-m-d H:i",###}</span>
        </div>
        <if condition="$data[0]['fulfill_time']">
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">送达时间</label>
                <span class="weui-form-preview__value">{pigcms{$data[0]['fulfill_time']|date="Y-m-d H:i",###}</span>
            </div>
        </if>
    </div>
</div>
<!--内容-->
<div class="weui-panel weui-panel_access">
    <div class="weui-media-box weui-media-box_text">
        <h4 class="weui-media-box__title">商品详情</h4>
<!--        <p class="weui-media-box__desc">456</p>-->
    </div>
    <div class="weui-form-preview">
        <div class="weui-form-preview__bd">
            <volist name="data" id="row">
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">
                        <img style="vertical-align:bottom;height:30px;width:30px" src="{pigcms{$row.meal_info.pic}" alt="">
                        <span>{pigcms{$row.meal_info.name}</span>
                    </label>
                    <span class="weui-form-preview__value">X{pigcms{$row.redeem_num} 桶</span>
                </div>
            </volist>
        </div>
    </div>
</div>
<form action="{pigcms{:U('audit_fulfill')}" method="post">
    <!--操作栏-->
    <div class="weui-footer weui-footer_fixed-bottom">
        <div class="weui-form-preview__ft">
            <input type="hidden" name="group_hash" value="{pigcms{:I('group_hash')}">
            <button type="submit" id="audit_1" name="status" value="1" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">通知用户送货中</button>
            <button type="submit" id="audit_100" name="status" value="100" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">确认送达</button>
        </div>
    </div>
</form>


<!-- body 最后 -->
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script>
  var redeem_status = parseInt("{pigcms{$data[0]['redeem_status']}");
  console.log(typeof redeem_status);
  console.log(redeem_status===1);
  if(redeem_status>=1){
      $('#audit_1').text("已通知用户");
      $('#audit_1').hide();
      $('#audit_1').click(function(){
          return false;
      });
  }

  if(redeem_status===100){
      $('#audit_100').text("已送达");
      $('#audit_100').click(function(){
          return false;
      });
  }
</script>
</body>
</html>