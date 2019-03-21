
<include file="Public:header"/>

<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-credit-card"></i>
                <a href="{pigcms{:U('DiscountSpead/index')}">优惠劵推广</a>
            </li>
            <li class="active">添加优惠券</li>
        </ul>
    </div>
    <!-- 内容头部 -->
     <link href="./tpl/Merchant/default/static/css/weui.css" rel="stylesheet" type="text/css" />
     <style type="text/css">
    #Recharge {text-decoration:none;color: #fff;}
    #Recharge:hover{color: #fff;}

     </style>
  
    <div class="page-content">
        <div class="page-content-area">
            <div class="row">
                <div class="col-xs-12">
                    <div class="tab-content">
                        <div class="grid-view">
                            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="">
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>优惠名称</label></label>
                                    <input type="text" class="col-sm-3" name="name" value="{pigcms{$vip.ds_name}" />
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="canrqnums">优惠类别</label></label>
                                    <div class="radio">
                                        <label>
                                            <input name="ds_type" value="0" type="radio" <if  condition="$vip['ds_type'] eq '0' or $vip['ds_type'] eq ''">checked="checked"</if>>
                                            <span class="lbl" style="z-index: 1">抵用券</span>
                                        </label>
                                        <label>
                                            <input name="ds_type" value="1" type="radio" <if  condition="$vip['ds_type'] eq '1'">checked="checked"</if>>
                                            <span class="lbl" style="z-index: 1">折扣</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="canrqnums" class="youhui">优惠金额</label><label for="canrqnums" style="display:none;" class="zhekou">优惠折扣</label></label>
                                    <div class="radio" style="margin-left: 20px;">
                                        <span><input type="text"   id="have" onkeypress="if((event.keyCode<48||event.keyCode>57) && event.keyCode!=46){alert('只能输入数字和小数点');return false;}" style="width: 80px;text-align: center;"  class="px"  value="{pigcms{$vip.ds_scale}" name="ds_scale" style="width:50px;">&nbsp;&nbsp;<span class="youhui">元</span><span class="zhekou" style="display:none;">折&nbsp;&nbsp;<span style="color: red;">(填写的折扣必须在0-1之间，小数点后面不得大于两位数)</span></span></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="adress">优惠时间</label></label>
                                    <input type="text" class="hasDatepicker" id="statdate" atime="{pigcms{$vip.statdate}" value="{pigcms{$vip.statdate|date='Y-m-d',###}" onClick="WdatePicker()" name="statdate" />
                                    到
                                    <input type="text" class="hasDatepicker" id="enddate" atime="{pigcms{$vip.enddate}" value="{pigcms{$vip.enddate|date='Y-m-d',###}" name="enddate" onClick="WdatePicker()"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="">限制优惠金额</label></label>
                                    <input type="number" class="" id="ds_minmoney" value="{pigcms{$vip.ds_minmoney|default='0'}"  name="ds_minmoney" />
                                    到
                                    <input type="number" class="" id="ds_maxmoney" value="{pigcms{$vip.ds_maxmoney}" name="ds_maxmoney" />
                                </div>
                                <div class="form-group couponpic" style="margin-bottom:35px;display:none;">
                                    <label class="col-sm-3"><label for="AutoreplySystem_img">上传优惠券图片</label></label>
                                </div>
                                <div class="form-group couponpic" style="width:417px;padding-left:140px;">
                                    <label class="ace-file-input">
										<span class="ace-file-container" data-title="选择" onclick="upyunPicUpload('pic',720,200,'card')">
											<span class="ace-file-name" data-title="上传图片..."><i class=" ace-icon fa fa-upload"></i></span>
										</span>
                                    </label>
                                    <div><img style="width:417px;height:150px;border: 0;" id="pic_src" src="<if condition="$vip.ds_img eq '' and $vip.type eq 1">/static/images/cart_info/youhui.jpg<elseif condition="$vip.ds_img eq '' and $vip.type eq 0"/>/static/images/cart_info/youhui.jpg<else/>{pigcms{$vip.ds_img}</if>"></div>
                                    <input type="hidden" name="pic" id="pic" value="<if condition="$vip.ds_img eq '' and $vip.type eq 1">/static/images/cart_info/youhui.jpg<elseif condition="$vip.ds_img eq '' and $vip.type eq 0"/>/static/images/cart_info/youhui.jpg<else/>{pigcms{$vip.ds_img}</if>" />
                                </div>
                               <div class="form-group">
                                    <label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;"></span>推广URL</label></label>
                                    <input type="url" class="col-sm-3" required name="ds_url" value="{pigcms{$vip.ds_url}" />
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="endinfo">优惠描述</label></label>
                                    <textarea  class="col-sm-3" id="info" name="info"  style="height:125px" >{pigcms{$vip.ds_description}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">优惠总金额</label>
                                    <div class="radio" style="margin-left: 20px;margin-top: -10px;">
                                        <span><input type="number"<if condition="$disid">readonly</if> id="zong" style="width: 100px;text-align: center;"  class="px"  value="{pigcms{$vip.ds_money}" name="ds_money" style="width:50px;">&nbsp;&nbsp;元</span>
                                        <span>当前余额<input type="text" name="money" value="{pigcms{$money}元" style="border:none;background:white!important;" readonly="readonly"/>&nbsp;<a href="{pigcms{:U('Recharge/index')}" class="weui_btn weui_btn_mini weui_btn_primary" id="Recharge">账户充值</a> </span>                             
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="canrqnums">优惠范围</label></label>
                                    <div class="radio" style="margin-left: 15px;margin-top: -3px;">
                                        <label>
                                            <input name="ds_scope" value="0" type="radio" <if  condition="$vip['ds_scope'] eq '0' or $vip['ds_scope'] eq ''">checked="checked"</if>>
                                            <span class="lbl" style="z-index: 1">全站</span>
                                        </label>
                                        <label>
                                            <input name="ds_scope" value="1" type="radio" <if  condition="$vip['ds_scope'] eq '1'">checked="checked"</if>>
                                            <span class="lbl" style="z-index: 1">会员</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button class="btn btn-info" type="submit" id="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            保存
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="./static/js/upyun.js"></script>
<script type="text/javascript" src="/static/js/date/WdatePicker.js"></script>

<link rel="stylesheet" href="./static/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="./static/kindeditor/plugins/code/prettify.css" />
<script src="./static/kindeditor/kindeditor.js" type="text/javascript"></script>
<script src="./static/kindeditor/lang/zh_CN.js" type="text/javascript"></script>
<script src="./static/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function(){
//        判断其编辑
        var ds_type = "{pigcms{$vip['ds_type']}";
        if(ds_type=="1"){
            $(".youhui").hide();
            $(".zhekou").show();
        }else{
            $(".youhui").show();
            $(".zhekou").hide();
        }
        //	选择优惠类别
        $('input[name=ds_type]').click(function(){
            if($(this).val()=="1"){
                $(".youhui").hide();
                $(".zhekou").show();
            }else{
                $(".youhui").show();
                $(".zhekou").hide();
            }
        });
        function get_unix_time(dateStr)
        {
            var newstr = dateStr.replace(/-/g,'/');
            var date =  new Date(newstr);
            var time_str = date.getTime().toString();
            return time_str.substr(0, 10);
        }
        $("#statdate").blur(function(){
            var statdate = get_unix_time($('input[name=statdate]').val());
            var enddate = get_unix_time($('input[name=enddate]').val());
            var atime = (enddate-statdate)/(3600*24)*100;
            if(atime<=0){
                layer.msg("您选择的时间有误",{icon:0});
            }
        });
        $("#enddate").blur(function(){
            var statdate = get_unix_time($('input[name=statdate]').val());
            var enddate = get_unix_time($('input[name=enddate]').val());
            var atime = (enddate-statdate)/(3600*24)*100;
            if(atime<=0){
                layer.msg("您选择的时间有误",{icon:0});
            }
        })
		$("#zong").blur(function(){
            var ds_money=$('input[name=ds_money]').val();
            var money=$('input[name=money]').val();
            if(parseFloat(ds_money)>parseFloat(money)){
                layer.msg("不能超出当前余额!",{icon:0});
            }
        })
        $("#submit").click(function(){
            var statdate = get_unix_time($('input[name=statdate]').val());
            var enddate = get_unix_time($('input[name=enddate]').val());
            var name = $.trim($('input[name=name]').val());
            var ds_minmoney = $.trim($('input[name=ds_minmoney]').val());
            var ds_maxmoney = $.trim($('input[name=ds_maxmoney]').val());
            var ds_type = $('input[name=ds_type]:checked').val();
            var youhui = $("#have").val();
            var zong = $("#zong").val();
            var pic = $.trim($('input[name=pic]').val());
            var atime = (enddate-statdate)/(3600*24)*100;
			var ds_money=$('input[name=ds_money]').val();
            var money=$('input[name=money]').val();
            if(name==""){
                layer.msg("优惠名称必须填写",{icon:0});
                return false;
            }
            if(ds_minmoney!=""){
                if(ds_minmoney<0){
                    layer.msg("金额最小限制不能小于0",{icon:0});
                    return false;
                }
            }
            if(pic==""){
                layer.msg("请上传图片",{icon:0});
                return false;
            }
            if(atime<=0){
                layer.msg("您选择的时间有误",{icon:0});
                return false;
            }
            if(zong==""){
                layer.msg("总金额不能为空",{icon:0});
                return false;
            }
            if(parseFloat(youhui)>parseFloat(zong)){
                layer.msg("总金额必须大于优惠金额",{icon:0});
                return false;
            }
            if(ds_maxmoney!=""){
                if(parseFloat(ds_maxmoney)<parseFloat(youhui)){
                    layer.msg("金额最大限制不能小于优惠金额！",{icon:0});
                    return false;
                }
                if(parseFloat(ds_maxmoney)<parseFloat(ds_minmoney)){
                    layer.msg("金额最大限制不能小于最小金额！",{icon:0});
                    return false;
                }
            }
            if(ds_type=="1"){
                if(youhui>1){
                    layer.msg("优惠折扣不能大于1",{icon:0});
                    return false;
                }
            }
			if(parseFloat(ds_money)>parseFloat(money)){
                layer.msg("优惠总金额不可大于商户余额",{icon:0});
                return false;
            }
            $("#need").val(atime);
            var have = parseInt($("#have").val());
            var need = parseInt($("#need").val());
            if(have<need){
                $("#nuzu").show();
            }else{
                $("#nuzu").hide();
            }
            $(form).submit();
        })

    });
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#info', {
            resizeType : 1,
            allowPreviewEmoticons : false,
            allowImageUpload : true,
            uploadJson : '/merchant.php?g=Merchant&c=Upyun&a=kindedtiropic',
            items : [
                'source','undo','redo','copy','plainpaste','wordpaste','clearhtml','quickformat','selectall','fullscreen','fontname', 'fontsize','subscript','superscript','indent','outdent','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline','hr',
                '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image','emoticons', 'link', 'unlink']
        });
    });
</script>
<include file="Public:footer"/>