<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>在线收银</title>
    <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/header.tpl.php';?>
    <link href="<?php echo $this->RlStaticResource;?>money/css/style.css" rel="stylesheet">
</head>
<style type="text/css">
    .rh{
        font-size:15px; font-family:'微软雅黑'; color:#8895a9;
    }
    .ra{
        font-size:15px; font-family:'微软雅黑'; color:#0f7fde;
    }
    .re{
        font-size:26px; font-family:'微软雅黑';
    }
    .gg{
        color:#84c6ff; font-family:'微软雅黑'; font-size:18px;
    }
    .ga{
        color:#ffffff; font-family:'微软雅黑'; font-size:18px;
    }
    .aa{
        color:#ffde00; font-family:'微软雅黑'; font-size:30px;
    }
    .cq{
        color:#84c6ff; font-family:'微软雅黑'; font-size:18px;
    }
    .hd{
        font-family:'微软雅黑'; font-size:18px; color:#FFFFFF; height:35px; line-height:35px;
    }
    .zz{
        font-family:'微软雅黑'; font-size:14px; color:#FFFFFF; height:30px; line-height:30px; text-align:center;
    }
    .wc{
        font-family:'微软雅黑'; font-size:28px; color:#FFFFFF; height:40px; line-height:40px; text-align:center;
    }
    .la{
        font-family:'微软雅黑'; font-size:14px; color:#FFFFFF; height:30px; line-height:30px; text-align:center;
    }
    .hy{
        font-family:'微软雅黑'; font-size:28px; color:#FFFFFF; height:40px; line-height:40px; text-align:center;
    }

</style>
<body>
<div id="zwidth">
	<div id="top"></div>
	<div id="zw">
		<div id="bt">在线收款</div>
		<div id="bt2">
			<div id="lk">
			  <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:38px;">
                <tbody id="last">
                <tr>
                  <td height="66"><img src="<?php if($lastResult['headimgurl'])echo $lastResult['headimgurl'];else{echo $this->RlStaticResource.'money/images/human.jpg';}?>" width="66" height="66" style="border-radius:10px;"/>
                  </td>
                  <td height="66" style="color:#FFFFFF;">
                      <span style="font-size:18px; font-family:'微软雅黑';"><?php if(!empty($lastResult['nickname'])){
                              echo $lastResult['nickname'];
                          }elseif(!empty($lastResult['truename'])){
                              echo htmlspecialchars_decode($lastResult['truename'],ENT_QUOTES);
                          }else{
                              echo '匿名用户';
                          }?>
                      </span><br/>
                      <span style="color:#84c6ff; font-family:'微软雅黑'; font-size:18px;"><?php if($lastResult['refund']==0){echo '支付';}elseif($lastResult['refund']==2){echo '已退款';}?></span>
                      <span style="color:#ffffff; font-family:'微软雅黑'; font-size:18px;">￥</span><span style="color:#ffde00; font-family:'微软雅黑'; font-size:30px;"><?php echo $lastResult['goods_price'];?></span> <span style="color:#84c6ff; font-family:'微软雅黑'; font-size:18px;">元</span>
                  </td>
                </tr>
                <tr>
                  <td height="68" colspan="2" align="left" valign="bottom">
				  	 <div style="float:left; width:83%;">
					 	 <div style="font-family:'微软雅黑'; font-size:18px; color:#FFFFFF; height:35px; line-height:35px;"><?php $paytime=$lastResult['paytime'] > 0 ? $lastResult['paytime'] : $lastResult['add_time']; echo date('Y-m-d H:i:s',$paytime);?></div>
						 <div style="border-radius:1120px; height:3px; background-color:#2f6591;"></div>
					 </div>
					 <div style="width:43px; height:22px; float:right; margin-top:16px;"><img src=<?php echo $this->RlStaticResource;?>money/images/time.jpg width="43" height="22" /></div>
					 <div class="both"></div>
				  </td>
                </tr>
                <tr>
                  <td colspan="2">
				  	  <div style="width:100%; margin-top:35px;">
					  	  <div style="float:left; width:45%;">
						  	  <div style="font-family:'微软雅黑'; font-size:14px; color:#FFFFFF; height:30px; line-height:30px; text-align:center;">本月收入</div>
							  <div style="font-family:'微软雅黑'; font-size:28px; color:#FFFFFF; height:40px; line-height:40px; text-align:center;"><?php echo $allpay?></div>
						  </div>
						  <div style="float:right; width:45%;">
						  	  <div style="font-family:'微软雅黑'; font-size:14px; color:#FFFFFF; height:30px; line-height:30px; text-align:center;">本日收入</div>
							  <div style="font-family:'微软雅黑'; font-size:28px; color:#FFFFFF; height:40px; line-height:40px; text-align:center;"><?php if($daypay){echo $daypay;}else{echo 0.00.'元'; }?></div>
						  </div>
						  <div class="both"></div>
					  </div>
				  </td>
                </tr>
                </tbody>
              </table>
            </div>
        <form id="pay">
            <div id="lk2">
                <div class="fk"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="49" style="border-bottom:1px #eeeeee solid;"><span style="color:#0077d6; font-family:'微软雅黑'; font-size:18px;">扫码收款</span></td>
              </tr>
              <tr>
                <td height="81"><input name="goods_name" style="width:100%; height:32px; border-radius:4px; background-color:#eeeeee; border:1px #e5e6e7 solid; line-height:32px; color:#a8a8a8; font-size:16px;  font-family:'微软雅黑'; padding-left:2%; outline:none;" value="在线收款" readonly="readonly" /></td>
              </tr>
              <tr>
                <td><input name="goods_price" id="price" onKeyDown="if(event.keyCode==13) return false;"  style="width:100%; height:42px; border-radius:4px; border:1px #e5e6e7 solid; line-height:42px; color:#307dbf; font-size:30px;  font-family:'微软雅黑'; padding-left:2%; outline:none;" placeholder="请输入支付金额" /></td>
              </tr>
              <tr>
                <td height="82"><input name="auth_code" id="zhiFu"   style="width:100%; height:32px; border-radius:4px; border:1px #e5e6e7 solid; line-height:32px; color:#a8a8a8; font-size:16px;  font-family:'微软雅黑'; padding-left:2%; outline:none;" placeholder="扫码获取条码数据" maxlength="18"/></td>
              </tr>
              <tr>
                <td height="30" align="right"><input type="button" class="but" value="扫码支付" id="submit"/></td>
              </tr>
            </table>
                </div>
            </div>
        </form>
        <div class="both"></div>
    </div>
        <div id="bt3"><div id="lk3">
			<div class="cw">
				<div class="cw2">
					<div style="float:left; line-height:62px; font-family:'微软雅黑'; font-size:18px; color:#0077d6;">近期5条收款记录</div>
					<div style="float:right; padding-top:17px;"><a href="http://www.hdhsmart.com/Cashier/merchants.php?m=User&c=statistics&a=index"><img src=<?php echo $this->RlStaticResource;?>money/images/more.jpg border="0" /></a></div>
					<div class="both"></div>
				</div>
				<div style="width:100%;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" height="35" align="left" style="border-bottom:1px #eeeeee solid; font-family:'微软雅黑'; font-size:15px; color:#8895a9;"><span style="padding-left:20px;">֧支付人</span></td>
    <td width="15%" height="35" align="center" style="border-bottom:1px #eeeeee solid; font-family:'微软雅黑'; font-size:15px; color:#8895a9;">支付方式</td>
    <td width="33%" height="35" align="center" style="border-bottom:1px #eeeeee solid; font-family:'微软雅黑'; font-size:15px; color:#8895a9;">֧支付时间</td>
    <td width="20%" height="35" align="center" style="border-bottom:1px #eeeeee solid; font-family:'微软雅黑'; font-size:15px; color:#8895a9;">支付金额</td>
    <td width="13%" height="35" align="center" style="border-bottom:1px #eeeeee solid; font-family:'微软雅黑'; font-size:15px; color:#8895a9;">操作</td>
  </tr>
    <tbody class="" id="dd">
    <?php if(!empty($neworder)){
        foreach($neworder as $key=>$ovv){
            ?>
            <tr>
                <td height="50" align="left">
                    <div class="q1"><img src="<?php if($ovv['headimgurl'])echo $ovv['headimgurl'];else {echo $this->RlStaticResource.'money/images/q1.jpg';}?>" width="30" height="30"  style="border-radius:6px;"/></div>
                    <div class="q2"><?php if(!empty($ovv['nickname'])){
                            echo $ovv['nickname'];
                        }elseif(!empty($ovv['truename'])){
                            echo htmlspecialchars_decode($ovv['truename'],ENT_QUOTES);
                        }else{
                            echo '匿名用户';
                        }?></div>
                    <div class="both"></div>
                </td>
                <td height="50" align="center" style="font-size:15px; font-family:'微软雅黑'; color:#0f7fde;"><?php if($ovv['pay_way']=='weixin'){
                        echo '微信';
                    }elseif($ovv['pay_way']=='ali'){
                        echo '支付宝';
                    }else{
                        echo '余额付';
                    }?></td>
                <td height="50" align="center" style="font-size:15px; font-family:'微软雅黑'; color:#8895a9;"><?php $paytime=$ovv['paytime'] > 0 ? $ovv['paytime'] : $ovv['add_time']; echo date('Y-m-d H:i:s',$paytime);?></td>
                <td height="50" align="center" style="font-size:15px; font-family:'微软雅黑'; color:#0f7fde;"><?php echo $ovv['goods_price'];?>元</td>
                <td height="50" align="center"><div style="padding-top:5px;"><?php if($ovv['comefrom']>0){ ?> <button class="btn btn-sm btn-success btn-st"><strong> 已支付 </strong></button> <?php }elseif($ovv['refund']!=2 && $ovv['refund']!=1 && $ovv['refund']!=3){?> <button class="btn btn-sm btn-warning" onClick="wxRefundBtn(this,<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);"><strong> 退&nbsp;&nbsp;&nbsp;款 </strong></button>  <?php }elseif($ovv['refund']==2){?><button class="btn btn-sm btn-success btn-st"><strong> 已退款 </strong></button><?php }?></div></td>
            </tr>
        <?php }}else{?>
        <tr class=""><td colspan="7">暂无订单</td></tr>
    <?php }?>
    </tbody>
</table>
</div>
			</div>
		</div></div>
    </div>
	<div style="width:100%; text-align:center; line-height:80px; font-family:'微软雅黑'; font-size:14px; color:#818181;">Copyright © 2016vhi99.com 鄂ICP备15013759号-2 技术支持：汇得行控股（中国）有限公司</div>
</div>
<script>
    $(function () {
        $("#price,#zhiFu").keyup(function(){
            $(this).val($(this).val().replace(/[^0-9.]/g,''));
        }).bind("paste",function(){  //CTR+V事件处理
            $(this).val($(this).val().replace(/[^0-9.]/g,''));
        }).css("ime-mode", "disabled"); //CSS设置输入法不可用

        $("input[name=goods_price]").focus();//获取焦点

//        $(document).keydown(function (event) {
//            if (event.keyCode == 13) {
//                $("#zhiFu").focus();
//            }
//        });

        $("#submit").click(function() {
            $.ajax({
                'url': "?m=User&c=cashier&a=skPay",
                'data': $("#pay").serialize(),
                'type': "POST",
                'dataType': "json",
                success: function (data) {//ajax返回的数据
                    console.log(data);
                    if (data.error == 0) {
                        //alert(1);
                        $('input[name="goods_price"]').val("");
                        $('input[name="auth_code"]').val("");
                        $("#price").focus();
                        document.getElementById("price").focus();
                        $('embed').remove();
                        $('body').append('<embed src="<?php echo PIGCMS_TPL_STATIC_PATH;?>music/alert.mp3" autostart="true" hidden="true" loop="false">');
                        if(data.orderList && data.lastOne && data.daypay && data.allpay){
                            $('#dd').text("");
                            $('#last').text("");
                            var contentList="";
                            var newResult = "";
                            for(var i=0;i<data.orderList.length;i++){
                                if(data.orderList[i].nickname){
                                    var username=data.orderList[i].nickname;
                                }else if(data.orderList[i].truename){
                                    var username=data.orderList[i].truename;
                                }else{
                                    var username="匿名用户";
                                }
                                if(data.orderList[i].pay_way=='weixin'){
                                    var method='微信';
                                }else if(data.orderList[i].pay_way=='ali'){
                                    var method='支付宝';
                                }else{
                                    var method='余额付';
                                }
                                if(data.orderList[i].headimgurl){
                                    var img=data.orderList[i].headimgurl;
                                }else{
                                    var img="<?php echo $this->RlStaticResource;?>money/images/q1.jpg";
                                }
                                var timeVal=(data.orderList[i].paytime>0) ? data.orderList[i].paytime : data.orderList[i].add_time;
                                if(data.orderList[i].comefrom > 0){
                                    var pay_status='<button class="btn btn-sm btn-success btn-st"><strong> 已支付 </strong></button> ';
                                }else if(data.orderList[i].refund!=2 && data.orderList[i].refund!=1){
                                    var pay_status='<button class="btn btn-sm btn-warning" onclick="wxRefundBtn(this,'+data.orderList[i].id+','+data.orderList[i].mid+');"><strong> 退&nbsp;&nbsp;&nbsp;款 </strong></button> ';
                                }else{
                                    var pay_status='<button class="btn btn-sm btn-success btn-st"><strong> 已退款 </strong></button> ';
                                }
                                contentList+='<tr>';
                                contentList+='<td height="50" align="left"><div class="q1"><img src="'+img+'" width="30" height="30" style="border-radius:6px;" /></div><div class="q2">'+username+'</div><div class="both"></div></td>';
                                contentList+='<td height="50" align="center" class="ra">'+method+'</td>';
                                contentList+='<td height="50" align="center" class="rh">'+timeVal+'</td>';
                                contentList+='<td height="50" align="center" class="ra">'+data.orderList[i].goods_price+'</td>';
                                contentList+='<td height="50" align="center"><div style="padding-top:5px;">'+pay_status+'</div></td></tr>';
                            }
                            if(data.lastOne.nickname){
                                var username=data.lastOne.nickname;
                            }else if(data.lastOne.truename){
                                var username=data.lastOne.truename;
                            }else{
                                var username="匿名用户";
                            }
                            if(data.lastOne.refund==0){
                                var result="支付";
                            }else if(data.lastOne.refund==2){
                                var result="已退款";
                            }
                            var timeVal=(data.lastOne.paytime>0) ? data.lastOne.paytime : data.lastOne.add_time;
                            if(data.lastOne.headimgurl){
                                var lastimg=data.lastOne.headimgurl;
                            }else{
                                var lastimg="<?php echo $this->RlStaticResource;?>money/images/human.jpg";
                            }
                            var price=data.lastOne.goods_price;
                            var img="<?php echo $this->RlStaticResource;?>money/images/time.jpg";
                            newResult+='<tr><td height="66"><img src="'+lastimg+'" width="66" height="66" style="border-radius:10px;"/></td><td height="66" style="color:#FFFFFF;"><span class="re">'+username+'</span><br/><span class="gg">'+result+'</span><span class="ga">￥</span><span class="aa">'+price+'</span><span class="cq">元</span></td></tr>';
                            newResult+='<tr><td height="68" colspan="2" align="left" valign="bottom"><div style="float:left; width:83%;"><div class="hd">'+timeVal+'</div><div style="border-radius:1120px; height:3px; background-color:#2f6591;"></div></div><div style="width:43px; height:22px; float:right; margin-top:16px;"><img src="'+img+'" width="43" height="22"/></div><div class="both"></div></td></tr>';
                            newResult+='<tr><td colspan="2"><div style="width:100%; margin-top:35px;"><div style="float:left; width:45%;"><div class="zz">本月收入</div><div class="wc">'+data.allpay+'</div></div><div style="float:right; width:45%;"><div class="la">本日收入</div><div class="hy">'+data.daypay+'</div></div><div class="both"></div></div></td></tr>';
                            $('#last').append(newResult);
                            $('#dd').append(contentList);
                        }
                    }else{
                        if(data.mid==28){
                            alert(data.msg);
                            if(data.arr=='USERPAYING'){
                                var postdata=data.data;
                                $.post('?m=User&c=cashier&a=search',postdata,function(ret){
                                    //alert(ret.msg);
                                    if(!ret.error){
                                        console.log(ret);
                                        $('input[name="goods_price"]').val("");
                                        $('input[name="auth_code"]').val("");
                                        $("#price").focus();
                                        document.getElementById("price").focus();
                                        $('embed').remove();
                                        $('body').append('<embed src="<?php echo PIGCMS_TPL_STATIC_PATH;?>music/alert.mp3" autostart="true" hidden="true" loop="false">');
                                        if(ret.orderList && ret.lastOne && ret.daypay && ret.allpay){
                                            $('#dd').text("");
                                            $('#last').text("");
                                            var contentList="";
                                            var newResult = "";
                                            for(var i=0;i<ret.orderList.length;i++){
                                                if(ret.orderList[i].nickname){
                                                    var username=ret.orderList[i].nickname;
                                                }else if(ret.orderList[i].truename){
                                                    var username=ret.orderList[i].truename;
                                                }else{
                                                    var username="匿名用户";
                                                }
                                                if(ret.orderList[i].pay_way=='weixin'){
                                                    var method='微信';
                                                }else if(ret.orderList[i].pay_way=='ali'){
                                                    var method='支付宝';
                                                }else{
                                                    var method='余额付';
                                                }
                                                if(ret.orderList[i].headimgurl){
                                                    var img=ret.orderList[i].headimgurl;
                                                }else{
                                                    var img="<?php echo $this->RlStaticResource;?>money/images/q1.jpg";
                                                }
                                                var timeVal=(ret.orderList[i].paytime>0) ? ret.orderList[i].paytime : ret.orderList[i].add_time;
                                                if(ret.orderList[i].comefrom > 0){
                                                    var pay_status='<button class="btn btn-sm btn-success btn-st"><strong> 已支付 </strong></button> ';
                                                }else if(ret.orderList[i].refund!=2 && ret.orderList[i].refund!=1){
                                                    var pay_status='<button class="btn btn-sm btn-warning" onclick="wxRefundBtn(this,'+ret.orderList[i].id+','+ret.orderList[i].mid+');"><strong> 退&nbsp;&nbsp;&nbsp;款 </strong></button> ';
                                                }else{
                                                    var pay_status='<button class="btn btn-sm btn-success btn-st"><strong> 已退款 </strong></button> ';
                                                }
                                                contentList+='<tr>';
                                                contentList+='<td height="50" align="left"><div class="q1"><img src="'+img+'" width="30" height="30" style="border-radius:6px;" /></div><div class="q2">'+username+'</div><div class="both"></div></td>';
                                                contentList+='<td height="50" align="center" class="ra">'+method+'</td>';
                                                contentList+='<td height="50" align="center" class="rh">'+timeVal+'</td>';
                                                contentList+='<td height="50" align="center" class="ra">'+ret.orderList[i].goods_price+'</td>';
                                                contentList+='<td height="50" align="center"><div style="padding-top:5px;">'+pay_status+'</div></td></tr>';
                                            }
                                            if(ret.lastOne.nickname){
                                                var username=ret.lastOne.nickname;
                                            }else if(ret.lastOne.truename){
                                                var username=ret.lastOne.truename;
                                            }else{
                                                var username="匿名用户";
                                            }
                                            if(ret.lastOne.refund==0){
                                                var result="支付";
                                            }else if(ret.lastOne.refund==2){
                                                var result="已退款";
                                            }
                                            var timeVal=(ret.lastOne.paytime>0) ? ret.lastOne.paytime : ret.lastOne.add_time;
                                            if(ret.lastOne.headimgurl){
                                                var lastimg=ret.lastOne.headimgurl;
                                            }else{
                                                var lastimg="<?php echo $this->RlStaticResource;?>money/images/human.jpg";
                                            }
                                            var price=ret.lastOne.goods_price;
                                            var img="<?php echo $this->RlStaticResource;?>money/images/time.jpg";
                                            newResult+='<tr><td height="66"><img src="'+lastimg+'" width="66" height="66" style="border-radius:10px;"/></td><td height="66" style="color:#FFFFFF;"><span class="re">'+username+'</span><br/><span class="gg">'+result+'</span><span class="ga">￥</span><span class="aa">'+price+'</span><span class="cq">元</span></td></tr>';
                                            newResult+='<tr><td height="68" colspan="2" align="left" valign="bottom"><div style="float:left; width:83%;"><div class="hd">'+timeVal+'</div><div style="border-radius:1120px; height:3px; background-color:#2f6591;"></div></div><div style="width:43px; height:22px; float:right; margin-top:16px;"><img src="'+img+'" width="43" height="22"/></div><div class="both"></div></td></tr>';
                                            newResult+='<tr><td colspan="2"><div style="width:100%; margin-top:35px;"><div style="float:left; width:45%;"><div class="zz">本月收入</div><div class="wc">'+ret.allpay+'</div></div><div style="float:right; width:45%;"><div class="la">本日收入</div><div class="hy">'+ret.daypay+'</div></div><div class="both"></div></div></td></tr>';
                                            $('#last').append(newResult);
                                            $('#dd').append(contentList);
                                        }
                                    }else{
                                        alert(ret.msg);
                                    }
                                },'json');
                            }
                            $('input[name="goods_price"]').val("");
                            $('input[name="auth_code"]').val("");
                            $("#price").focus();
                        }else{
                            if(data.arr=='USERPAYING'){
                                var postdata=data.data;
                                $.post('?m=User&c=cashier&a=search',postdata,function(ret){
                                    //alert(ret.msg);
                                    if(!ret.error){
                                        $('input[name="goods_price"]').val("");
                                        $('input[name="auth_code"]').val("");
                                        $("#price").focus();
                                        document.getElementById("price").focus();
                                        $('embed').remove();
                                        $('body').append('<embed src="<?php echo PIGCMS_TPL_STATIC_PATH;?>music/alert.mp3" autostart="true" hidden="true" loop="false">');
                                        if(ret.orderList && ret.lastOne && ret.daypay && ret.allpay){
                                            $('#dd').text("");
                                            $('#last').text("");
                                            var contentList="";
                                            var newResult = "";
                                            for(var i=0;i<ret.orderList.length;i++){
                                                if(ret.orderList[i].nickname){
                                                    var username=ret.orderList[i].nickname;
                                                }else if(ret.orderList[i].truename){
                                                    var username=ret.orderList[i].truename;
                                                }else{
                                                    var username="匿名用户";
                                                }
                                                if(ret.orderList[i].pay_way=='weixin'){
                                                    var method='微信';
                                                }else if(ret.orderList[i].pay_way=='ali'){
                                                    var method='支付宝';
                                                }else{
                                                    var method='余额付';
                                                }
                                                if(ret.orderList[i].headimgurl){
                                                    var img=ret.orderList[i].headimgurl;
                                                }else{
                                                    var img="<?php echo $this->RlStaticResource;?>money/images/q1.jpg";
                                                }
                                                var timeVal=(ret.orderList[i].paytime>0) ? ret.orderList[i].paytime : ret.orderList[i].add_time;
                                                if(ret.orderList[i].comefrom > 0){
                                                    var pay_status='<button class="btn btn-sm btn-success btn-st"><strong> 已支付 </strong></button> ';
                                                }else if(ret.orderList[i].refund!=2 && ret.orderList[i].refund!=1){
                                                    var pay_status='<button class="btn btn-sm btn-warning" onclick="wxRefundBtn(this,'+ret.orderList[i].id+','+ret.orderList[i].mid+');"><strong> 退&nbsp;&nbsp;&nbsp;款 </strong></button> ';
                                                }else{
                                                    var pay_status='<button class="btn btn-sm btn-success btn-st"><strong> 已退款 </strong></button> ';
                                                }
                                                contentList+='<tr>';
                                                contentList+='<td height="50" align="left"><div class="q1"><img src="'+img+'" width="30" height="30" style="border-radius:6px;" /></div><div class="q2">'+username+'</div><div class="both"></div></td>';
                                                contentList+='<td height="50" align="center" class="ra">'+method+'</td>';
                                                contentList+='<td height="50" align="center" class="rh">'+timeVal+'</td>';
                                                contentList+='<td height="50" align="center" class="ra">'+ret.orderList[i].goods_price+'</td>';
                                                contentList+='<td height="50" align="center"><div style="padding-top:5px;">'+pay_status+'</div></td></tr>';
                                            }
                                            if(ret.lastOne.nickname){
                                                var username=ret.lastOne.nickname;
                                            }else if(ret.lastOne.truename){
                                                var username=ret.lastOne.truename;
                                            }else{
                                                var username="匿名用户";
                                            }
                                            if(ret.lastOne.refund==0){
                                                var result="支付";
                                            }else if(ret.lastOne.refund==2){
                                                var result="已退款";
                                            }
                                            var timeVal=(ret.lastOne.paytime>0) ? ret.lastOne.paytime : ret.lastOne.add_time;
                                            if(ret.lastOne.headimgurl){
                                                var lastimg=ret.lastOne.headimgurl;
                                            }else{
                                                var lastimg="<?php echo $this->RlStaticResource;?>money/images/human.jpg";
                                            }
                                            var price=ret.lastOne.goods_price;
                                            var img="<?php echo $this->RlStaticResource;?>money/images/time.jpg";
                                            newResult+='<tr><td height="66"><img src="'+lastimg+'" width="66" height="66" style="border-radius:10px;"/></td><td height="66" style="color:#FFFFFF;"><span class="re">'+username+'</span><br/><span class="gg">'+result+'</span><span class="ga">￥</span><span class="aa">'+price+'</span><span class="cq">元</span></td></tr>';
                                            newResult+='<tr><td height="68" colspan="2" align="left" valign="bottom"><div style="float:left; width:83%;"><div class="hd">'+timeVal+'</div><div style="border-radius:1120px; height:3px; background-color:#2f6591;"></div></div><div style="width:43px; height:22px; float:right; margin-top:16px;"><img src="'+img+'" width="43" height="22"/></div><div class="both"></div></td></tr>';
                                            newResult+='<tr><td colspan="2"><div style="width:100%; margin-top:35px;"><div style="float:left; width:45%;"><div class="zz">本月收入</div><div class="wc">'+ret.allpay+'</div></div><div style="float:right; width:45%;"><div class="la">本日收入</div><div class="hy">'+ret.daypay+'</div></div><div class="both"></div></div></td></tr>';
                                            $('#last').append(newResult);
                                            $('#dd').append(contentList);
                                        }
                                    }else{
                                        alert(ret.msg);
                                    }
                                },'json');
                            }
                            $('input[name="goods_price"]').val("");
                            $('input[name="auth_code"]').val("");
                            $("#price").focus();
                        }
                    }
                }
            })
        });

        $("input[name=auth_code]").keydown(function(e){//获取条形码后按enter提交表单
            var value=$(this).val();
            var e = e || event,
                keycode = e.which || e.keyCode;
            if (value.length==18) {//只有当位数到了18位  才会触发enter事件
                if(keycode==13){
                    $("#submit").trigger("click");//触发click
                }
            }
        });

        $("input[name=goods_price]").keydown(function(f){
            var value=$(this).val();
            var f = f || event,
                keycode = f.which || f.keyCode;
            if(value.length>10){//只要长度大于10，enter事件后就就清空并获取焦点
                if(keycode==13){
                    $('input[name="goods_price"]').val("");
                    $("#price").focus();
                }
            }else{
                if(keycode==13){
                    $("#zhiFu").focus();
                }
            }
        });
    })

</script>
</body>
</html>
<script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>cashier/commonfunc.js"></script>

