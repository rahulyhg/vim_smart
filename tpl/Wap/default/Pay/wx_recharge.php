<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>会员充值</title>

<link href="{pigcms{$static_path}css/child_page.css" rel="stylesheet" type="text/css" />
<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
<style type="text/css">
<!--
.form .form-actions, .portlet-form .form-actions {
    padding: 20px;
    margin: 0;
    background-color: #36c6d3;
    border-top: 1px solid #2bb8c4;
}
.form-control {
    widows: 80%;
}
.header {
        position: absolute;
        top: 0px;
        left: 0px;
        right: 0px;
        height: 60px;
        background-color: #36c6d3;
        color: #2bb8c4;
    }

    .content {
        margin-top: 20px;
    }

    .greenbg {
        width: 100%;
        background-color: #36c6d3;
    }

    .greenbr {
        text-align: center;
        border: solid;
        border-radius: 8px;
        border-color: #36c6d3;
        color: #2bb8c4;
        /*width: 45%;
        float: left;*/
    }

    .submit {
        height: 45px;
    }

    .fit {
        width: 100%;
    }

    .row {
        margin-top: 5px;
    }

    .panal {
        width: 80%;
        margin: 0 auto;
        margin-bottom: 20px;
    }

    .box {
        margin-bottom: 20px;
        padding: 5px 10px;
        width: 90%;
        margin-left: 2%;
    }

    .col-xs-offset-2 {
      /*margin-left: 9%;*/
      margin-top: 5px;
    }

    .col-xs-3 {
      float: left;
    }

    .col-xs-9 {
      /*float: left;*/
      /*margin-left: 15px;*/
    }
-->
</style>

<div class="page-content-wrapper">

    <div class="page-content">
        
        <div class="portlet light bordered">
        <div class="row" style="width: 90%; margin: auto;">
            
            <div class="content">
                <div class="panal">
                    <div class="row">
                        <div class="col-xs-5 greenbr" onclick="get(0)" style="background-color: #36c6d3; color: #fff;">
                            <strong>1条</strong>
                            <br> 售价：10.00元
                            <br> 10
                        </div>
                        <div class="col-xs-offset-2 col-xs-5 greenbr" onclick="get(1)">
                            <strong>5条</strong>
                            <br> 售价：45.00元
                            <br> 45
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5 greenbr" onclick="get(2)">
                            <strong>10条</strong>
                            <br> 售价：80.00元
                            <br> 80
                        </div>
                        <div class="col-xs-offset-2 col-xs-5 greenbr" onclick="get(3)">
                            <strong>20条</strong>
                            <br> 售价：150.00元
                            <br> 150
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5 greenbr" onclick="get(4)">
                            <strong>月度会员</strong>
                            <br> 售价：200.00元
                            <br> 200
                        </div>
                        <div class="col-xs-offset-2 col-xs-5 greenbr" onclick="get(5)">
                            <strong>年度会员</strong>
                            <br> 售价：1800.00元
                            <br> 1800
                        </div>
                    </div>
                </div>
                <hr>
                <form action="javascript:next();" method="post" class="form-horizontal" id="form_sample_1">
                    <!-- <div class="form-group row box" style="margin-left: 23%;">  {:U('Pay/pay_order_check')}
                        <label for="uid" class="col-xs-3 control-label">账户</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" id="user" name="user" value="{$admin.ad_name}" readonly style="width: 80%;"> 
                        </div>
                    </div><br/> -->

                    <div class="form-group row box">
                        <label for="count" class="col-xs-3 control-label" style="margin-top: 8px;">金额：</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" id="count" name="count" readonly value="10" style="width: 80%; line-height: 25px;">
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <!-- <div class="col-md-offset-2 col-md-9"> -->
                                <input type="hidden" name="id" value="{$admin.ad_id}">
                                <div class="wrapper buy-wrapper">
                                    <button type="submit" class="btn mj-submit btn-strong btn-larger btn-block">微信支付</button>
                                </div>
                                <div class="wrapper buy-wrapper" style="margin-top: 5px;">
                                    <button type="button" class="btn mj-submit btn-strong btn-larger btn-block" onclick="window.location.href='http://dt.vhi99.com/wap.php?m=Home&c=User&a=index'">返回</button>
                                </div>
                                <!-- <button type="submit" class="btn green">确认充值</button>
                                <button type="reset" class="btn default" onclick="window.location.href='http://dt.vhi99.com/index.php?g=Admin&c=Admin&a=admin_list&status=1'">返 回</button> -->
                            <!-- </div> -->
                        </div>
                    </div>

                    <!-- <div class="form-group row box">
                        <input type="hidden" name="id" value="{$admin.ad_id}">
                        <div class="col-xs-12 fit">
                            <button type="submit" class="btn btn-success fit">充值</button>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
  </div>
</div>

<script src="{pigcms{$static_path}js/safety/jquery.min.js"></script>
<script>
  function getByClass(parent, cls) {
      if (parent.getElementsByClassName) {
          return parent.getElementsByClassName(cls);
      } else {
          var res = [];
          var reg = new RegExp(' ' + cls + ' ', 'i')
          var ele = parent.getElementsByTagName('*');
          for (var i = 0; i < ele.length; i++) {
              if (reg.test(' ' + ele[i].className + ' ')) {
                  res.push(ele[i]);
              }
          }
          return res;
      }
  }

  function get(index) {
      var choose = getByClass(document, 'greenbr');
      for (let i = 0; i < choose.length; i++) {            
          choose[i].style.backgroundColor = "#fff";
          choose[i].style.color = "#36c6d3";
      }
      choose[index].style.backgroundColor = "#36c6d3";
      choose[index].style.color = "#fff";

      var count = document.getElementById("count");
      if(index == 1) { 
          money = 45; 
      } else if(index == 2) { 
          money = 80; 
      } else if(index == 3) { 
          money = 150; 
      } else if(index == 4) { 
          money = 200; 
      } else if(index == 5) { 
          money = 1800; 
      } else  { 
          money = 10; 
      }
      count.value = money;
  }

  function next() {
      var money = document.getElementById("count").value;
      console.log(money);
      if(money>0){    
          $.ajax({
              type: "POST",
              url: "{pigcms{:U('Pay/save_order')}",
              data: {"money":money},             
              success: function(res){
              console.log(res);                
                  if (res) { 
                      window.location.href = "{pigcms{:U('Pay/wxpay')}"+'&orderid='+res;
                  } else {
                      alert(res.msg);
                  }
              },           
          });
      } else {
        return false;
      }
  }
</script>

</body>

</html>

