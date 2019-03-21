<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <title>信息发布</title> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width" /> 
  <meta name="format-detection" content="telephone=no" /> 
  <meta name="format-detection" content="email=no" /> 
  <meta name="format-detection" content="address=no;" /> 
  <meta name="apple-mobile-web-app-capable" content="yes" /> 
  <meta name="apple-mobile-web-app-status-bar-style" content="default" /> 
  <link rel="stylesheet" href="<?php echo ($static_path); ?>classify/mball.css" /> 
  <link rel="stylesheet" href="<?php echo ($static_path); ?>classify/publishall.css" /> 
  <script src="<?php echo C('JQUERY_FILE');?>"></script>
  <style type="text/css">
  .item .danfux{display:block;padding-left: 10px;}
  .danfux label{padding-left:10px;line-height: 25px;display: inline-block;}
  input:focus{background:#ececec;outline:0}
  </style>
 </head> 
 <body> 
  <div class="dl_nav"> 
   <span> <a href="/wap.php?g=Wap&c=Classify&a=index">首页</a>&gt; <a href="/wap.php?g=Wap&c=Classify&a=SelectSub&cid=<?php echo ($fcid); ?>">重选类别</a>&gt; <a href="javascript:;"><h1 style="color:#F76120">填写 <?php echo ($fabuset['cat_name']); ?> 信息</h1></a> </span> 
  </div> 
  <hr /> 
  <div class="bind_mark"></div> 
  <div style="margin: 0px 0px 10px 10px;"><span>注意：有红色星号的为必填项</span></div>
  <!-- form start --> 
  <form id="mpostForm" name="mpostForm" action="<?php echo U('Classify/fabuTosave',array('cid'=>$cid));?>" method="post" style="margin-bottom: 100px;"> 
   <ul class="list">
     <li class="item"> 
     <div class="title">
      <span><strong style="color:red;">*</strong>标题：</span>
      <div class="placeholder"></div>
     </div> 
     <div class="input"> 
      <input name="tname" id="tname"  value="" type="text" style="width: 90%;height: 30px;"/> 
     </div> 
     <div class="tip"></div>
	 </li>
	 <li class="item"> 
     <div class="title">
      <span><strong style="color:red;">*</strong>联系人名字：</span>
      <div class="placeholder"></div>
     </div> 
     <div class="input"> 
      <input name="lxname" id="lxname"  value="" type="text" style="width: 90%;height: 30px;"/> 
     </div> 
     <div class="tip"></div>
	 </li>
	<li class="item"> 
     <div class="title">
      <span><strong style="color:red;">*</strong>联系手机号：</span>
      <div class="placeholder"></div>
     </div> 
     <div class="input"> 
      <input name="lxtel" id="lxtel"  value="" onkeyup="value=value.replace(/[^1234567890]+/g,'')" placeholder="请填正确联系手机号" type="text" style="width: 90%;height: 30px;"/> 
     </div> 
     <div class="tip"></div>
	 </li>
	 <!----1单文本框--2单选框--3复选框--4下拉框--5多文本框---->
	 <?php if(!empty($subdir)): ?><li class="item"> 
			<div class="title">
			<span>选择分类：</span>
			<div class="placeholder"></div>
			</div> 
			<div class="input"> 
			<div class="select">
			<label class="psu">请选择</label>
			<select class="decorate" name="subdir">
			<option value="">请选择</option>
			<?php if(is_array($subdir)): $i = 0; $__LIST__ = $subdir;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$opt): $mod = ($i % 2 );++$i;?><option value="<?php echo ($opt['cid']); ?>"><?php echo ($opt['cat_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
			</div>
			<span></span> 
			<div class="select" style="display: none;" type="subcate">
			<label class="psu">请选择</label>
			</div>
			</div> 
			<div class="tip"></div>
		</li><?php endif; ?>
	 <?php if(!empty($catfield)): if(is_array($catfield)): $kk = 0; $__LIST__ = $catfield;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk; if($vv['type'] == 1): ?><li class="item"> 
			<div class="title">
			<span><?php if($vv['iswrite']>0)echo '<strong style="color:red;">*</strong>'; echo ($vv['name']); ?>：</span>
			<div class="placeholder"></div>
			</div> 
			<div class="input"> 
			 <input name="input[<?php echo ($kk); ?>][vv]"  value="" type="text" <?php if($vv['inarr']==1)echo 'onkeyup="value=value.replace(/[^1234567890]+/g,'."''".')" placeholder="请填数字"'; ?> <?php if(($vv['inarr']==1) && !empty($vv['inunit'])){echo 'class="inputtext01"';}else{echo 'class="inputtext02"';} ?>/> <?php if(($vv['inarr']==1) && !empty($vv['inunit']))echo "&nbsp;".$vv['inunit']; ?>
			 <input name="input[<?php echo ($kk); ?>][tn]"  value="<?php echo ($vv['name']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][unit]"  value="<?php echo ($vv['inunit']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][inarr]"  value="<?php echo ($vv['inarr']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][input]"  value="<?php echo ($vv['input']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][iswrite]"  value="<?php echo ($vv['iswrite']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][isfilter]"  value="<?php echo ($vv['isfilter']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][type]"  value="1"  type="hidden" />
			</div> 
			<div class="tip"></div>
		</li>
	  <?php elseif($vv['type'] == 2): ?>
		<li class="item"> 
			<div class="title">
			<span><?php echo ($vv['name']); ?>：<?php if($vv['iswrite']>0)echo '<strong style="color:red;">*</strong>'; ?></span>
			<div class="placeholder"></div>
			</div> 
			<div class="input danfux">
			<?php if(is_array($vv['opt'])): $i = 0; $__LIST__ = $vv['opt'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$opt): $mod = ($i % 2 );++$i;?><label><input name="input[<?php echo ($kk); ?>][vv]" type="radio" value="<?php echo ($opt); ?>" /> <?php echo ($opt); ?></label> 
			<?php if($mod==1) echo '<br/>'; endforeach; endif; else: echo "" ;endif; ?>
			 <input name="input[<?php echo ($kk); ?>][tn]"  value="<?php echo ($vv['name']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][input]"  value="<?php echo ($vv['input']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][iswrite]"  value="<?php echo ($vv['iswrite']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][isfilter]"  value="<?php echo ($vv['isfilter']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][type]"  value="2"  type="hidden" />
			</div> 
			<div class="tip"></div> 
		</li> 
	  <?php elseif($vv['type'] == 3): ?>
		<li class="item"> 
			<div class="title">
			<span><?php echo ($vv['name']); ?>：</span>
			<div class="placeholder"></div>
			</div> 
			<div class="input danfux"> 
			<?php if(is_array($vv['opt'])): $i = 0; $__LIST__ = $vv['opt'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$opt): $mod = ($i % 2 );++$i;?><label><input name="input[<?php echo ($kk); ?>][vv][]" type="checkbox"  value="<?php echo ($opt); ?>"/> <?php echo ($opt); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
			 <input name="input[<?php echo ($kk); ?>][tn]"  value="<?php echo ($vv['name']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][input]"  value="<?php echo ($vv['input']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][iswrite]"  value="<?php echo ($vv['iswrite']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][isfilter]"  value="<?php echo ($vv['isfilter']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][type]"  value="3"  type="hidden" />
			</div> 
			<div class="tip"></div> 
		</li> 
	  <?php elseif($vv['type'] == 4): ?>
		<li class="item"> 
			<div class="title">
			<span><?php echo ($vv['name']); ?>：<?php if($vv['iswrite']>0)echo '<strong style="color:red;">*</strong>'; ?></span>
			<div class="placeholder"></div>
			</div> 
			<div class="input"> 
			<div class="select">
			<label class="psu">请选择</label>
			<select class="decorate" name="input[<?php echo ($kk); ?>][vv]">
			<option value="">请选择</option>
			<?php if(is_array($vv['opt'])): $i = 0; $__LIST__ = $vv['opt'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$opt): $mod = ($i % 2 );++$i;?><option value="<?php echo ($opt); ?>"><?php echo ($opt); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
			 <input name="input[<?php echo ($kk); ?>][tn]"  value="<?php echo ($vv['name']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][input]"  value="<?php echo ($vv['input']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][iswrite]"  value="<?php echo ($vv['iswrite']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][isfilter]"  value="<?php echo ($vv['isfilter']); ?>"  type="hidden" />
			 <input name="input[<?php echo ($kk); ?>][type]"  value="4"  type="hidden" />
			</div>
			<span></span> 
			<div class="select" style="display: none;" type="subcate">
			<label class="psu">请选择</label>
			</div>
			</div> 
			<div class="tip"></div>
		</li> 
	  <?php elseif($vv['type'] == 5): ?>
		<li class="item"> 
		<div class="title">
		<span><?php echo ($vv['name']); ?>：<?php if($vv['iswrite']>0)echo '<strong style="color:red;">*</strong>'; ?></span>
		<div class="placeholder"></div>
		</div> 
		<div class="input"> 
		<textarea id="Content" name="input[<?php echo ($kk); ?>][vv]" class="myborder"  style="width: 90%;"></textarea> 
		 <input name="input[<?php echo ($kk); ?>][tn]"  value="<?php echo ($vv['name']); ?>"  type="hidden" />
		 <input name="input[<?php echo ($kk); ?>][input]"  value="<?php echo ($vv['input']); ?>"  type="hidden" />
		 <input name="input[<?php echo ($kk); ?>][iswrite]"  value="<?php echo ($vv['iswrite']); ?>"  type="hidden" />
		 <input name="input[<?php echo ($kk); ?>][isfilter]"  value="<?php echo ($vv['isfilter']); ?>"  type="hidden" />
		 <input name="input[<?php echo ($kk); ?>][type]"  value="5"  type="hidden" />
		</div> 
		<div class="tip"></div> 
		</li><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
    <li class="item"> 
		<div class="title">
		<span>说明描述：</span>
		<div class="placeholder"></div>
		</div> 
		<div class="input"> 
		<textarea id="Content" name="description" class="myborder"  placeholder="写上一些想要说明的内容" style="width: 90%;"></textarea>
		</div> 
		<div class="tip"></div> 
		</li>
  <?php if($fabuset['isupimg'] == 1): ?><li class="item uploadNum" id="uploadNum">还可上传<span class="leftNum orange">8</span>张图片，已上传<span class="loadedNum orange">0</span>张(非必填)</li> 
    <li class="item"> 
     <div class="upload_box"> 
      <ul class="upload_list clearfix" id="upload_list"> 
       <li class="upload_action"> <img src="<?php echo ($static_path); ?>classify/upimg.png" /> <input type="file" accept="image/jpg,image/jpeg,image/png,image/gif" id="fileImage" name="" /> </li> 
      </ul> 
     </div>
    </li><?php endif; ?>
   </ul> 
   <div class="post"> 
    <input type="hidden" id="Pic" name="" /> 
    <input type="hidden" name="cid" value="<?php echo ($cid); ?>" /> 
	<input type="hidden" name="fcid" value="<?php echo ($fcid); ?>" /> 
    <input id="btnPost" type="submit" value="发 布" onclick="return submit_FBI()"/> 
   </div> 
  </form> 
  <script src="<?php echo ($static_path); ?>classify/exif.js"></script> 
  <script src="<?php echo ($static_path); ?>classify/imgUpload.js"></script> 
  <!--<div id="pubOK">
   <div>
    <div class="message">
     发布成功，您可以在“个人中心-我的发布”中查看和操作该信息。
    </div>
    <div class="btn">
     <input type="button" value="我的发布" onclick="" />
     <input type="button" value="关闭" onclick="" />
    </div>
   </div>
  </div>
  <div id="pubFail">
   <div>
    <div class="message">
     信息发布失败。
    </div>
    <div class="btn">
     <input type="button" value="关闭" />
    </div>
   </div>
  </div>--->
  <?php if(!empty($classifyslider)): ?><link rel="stylesheet" href="<?php echo ($static_path); ?>classify/showcase.css" /> 
<style type="text/css">
 .nav-item{border: 0;}
</style>
   <!--<div class="nav-item">
    <a class="mainmenu js-mainmenu" href="<?php echo ($svv['url']); ?>"><span class="mainmenu-txt"><?php echo ($svv['name']); ?></span></a>
   </div>-->
  <div class="footermenu"> 
  <ul>
	<?php if(is_array($classifyslider)): $i = 0; $__LIST__ = $classifyslider;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$svv): $mod = ($i % 2 );++$i;?><li>
     <a href="<?php echo ($svv['url']); ?>">
        <!--<img src="">-->
       <p><?php echo ($svv['name']); ?></p>
        </a>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>
  </ul> 
 </div><?php endif; ?>
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
 <script type="text/javascript">
   function submit_FBI(){
	 var telnum=$.trim($('#lxtel').val());
	 if(!/^0[0-9\-]{10,13}$/.test(telnum) && !/^((\+86)|(86))?(1)\d{10}$/.test(telnum)){
		   alert('联系手机号格式不对');
	       return false;
		}else{
			return true;
		}
		//document.ostForm.submit();	
	}


        $("select").bind("change",
        function() {
            selectChange($(this))
        })
    
    function selectChange(obj, objtext) {
        var value = obj.val();
		var htmlobj=obj.get(0);		
        var text = $(htmlobj.options[htmlobj.selectedIndex]).text();
        var msg = obj.attr("msg");
        var pattern2 = obj.attr("pattern2");
        obj.parent().children("label").text(text);
            var subcate = obj.parent().parent().children("[type=subcate]");
            var selects = subcate.find("select");
            if (selects) {
                selects.remove()
            }
            if (subcate.length > 0) {
                subcate.children("label").text("请选择").parent().css("display", "none")
            }
       
    }
$(function() {
    if ($(".upload_list").length) {
        var imgUpload = new ImgUpload({
            fileInput: "#fileImage",
            container: "#upload_list",
            countNum: "#uploadNum",
			url:"http://" + location.hostname + "/wap.php?g=Wap&c=Classify&a=ajaxImgUpload"
        })
    }
});
 </script>
 </body>
</html>