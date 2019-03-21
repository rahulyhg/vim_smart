<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-credit-card"></i>
                <a href="{pigcms{:U('Promote/discountSpead')}">优惠劵推广</a>
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
                        <button class="btn btn-success" onclick="CreateShop()">优惠劵推广</button>
                        <div class="grid-view">
                            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="">
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>优惠名称</label></label>
                                    <label  type="text" class="col-sm-3" name="name" style="border: 0;margin-left: -10px;" readonly  />{pigcms{$vip.ds_name}</label>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="canrqnums">优惠类别</label></label>
                                    <div style="margin-top: 5px;">
                                        <span>
                                            <if  condition="$vip['ds_type'] eq '0' or $vip['ds_type'] eq ''">抵用券<else/>折扣</if>
                                            <span for="canrqnums" style="padding-left: 50px;font-size:15px;" class="youhui">优惠金额</span><span for="canrqnums" style="padding-left: 50px;font-size:15px;" style="display:none;" class="zhekou">优惠折扣</span>
                                            <span><label type="text" style="border: 0;padding-left: 25px;" readonly   id="have"  style="width: 80px;text-align: center;"  class="px"  value="" name="ds_scale" style="width:50px;">{pigcms{$vip.ds_scale}<span class="youhui">元</span><span class="zhekou">折</span></label>
                                            </span>
                                            </div>
                                    
                                </div>
                             <!--    <div class="form-group">
                                    <label class="col-sm-1"><label for="canrqnums" class="youhui">优惠金额</label><label for="canrqnums" style="display:none;" class="zhekou">优惠折扣</label></label>
                                    <div class="radio" style="margin-left: 20px;">
                                        <span><input type="text" style="border: 0;" readonly   id="have" onkeypress="if((event.keyCode<48||event.keyCode>57) && event.keyCode!=46){alert('只能输入数字和小数点');return false;}" style="width: 80px;text-align: center;"  class="px"  value="{pigcms{$vip.ds_scale}" name="ds_scale" style="width:50px;">&nbsp;&nbsp;<span class="youhui">元</span></span>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="adress">优惠时间</label></label>
                                    <div style="margin-top: 5px;">
                                    <label type="text" class="" id="" style="border: 0;" readonly value=""  >{pigcms{$vip.statdate|date='Y-m-d',###}</label>
                                    到
                                    <label type="text" class="" id="" style="border: 0;" readonly value="">{pigcms{$vip.enddate|date='Y-m-d',###}</label>
                                    </div>
                                </div>
                                <div class="form-group couponpic" style="margin-bottom:35px;display:none;">
                                    <label class="col-sm-3"><label for="AutoreplySystem_img">上传优惠券图片</label></label>
                                </div>
                                <div class="form-group couponpic" style="width:417px;padding-left:140px;">
                                    <div><img style="width:417px;height:150px;border: 0;" id="pic_src" src="<if condition="$vip.ds_img eq '' and $vip.type eq 1">/static/images/cart_info/youhui.jpg<elseif condition="$vip.ds_img eq '' and $vip.type eq 0"/>/static/images/cart_info/youhui.jpg<else/>{pigcms{$vip.ds_img}</if>"></div>
                                    <input type="hidden" name="pic" id="pic" value="<if condition="$vip.ds_img eq '' and $vip.type eq 1">/static/images/cart_info/youhui.jpg<elseif condition="$vip.ds_img eq '' and $vip.type eq 0"/>/static/images/cart_info/youhui.jpg<else/>{pigcms{$vip.ds_img}</if>" />
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;"></span>推广URL</label></label>
                                    <label type="url" class="col-sm-3" required name="ds_url" value=""  style="margin-left: -10px;"/>{pigcms{$vip.ds_url}</label>
                                </div>
                            
                                <div class="form-group">
                                    <label class="col-sm-1">优惠总金额</label>
                                    <div class="radio" style="margin-left: 20px;margin-top: -5px;">
                                        <span style=" margin-left: -32px;"><label type="text" id="zong"  readonly style="boder:0; width: 100px;text-align: center;"  class="px"  value="" name="ds_money" style="width:50px;">{pigcms{$vip.ds_money}&nbsp;&nbsp;元</label>
                                    <span for="canrqnums" style=" padding-left:50px;font-size:15px;">优惠范围</span>
                                    <span style="padding-left: 25px;">
                                            <if  condition="$vip['ds_scope'] eq '0' or $vip['ds_scope'] eq ''">全站<else/>会员</if>
                                            </span>
                                    </div>
                                </div>
                         <!--        <div class="form-group">
                                    <label class="col-sm-1"><label for="canrqnums">优惠范围</label></label>
                                    <div class="radio" style="margin-left: 15px;margin-top: -3px;">
                                        <label>
                                            <span>
                                            <if  condition="$vip['ds_scope'] eq '0' or $vip['ds_scope'] eq ''">全站<else/>会员</if>
                                            </span>
                                        </label>

                                    </div>
                                </div> -->
                                    <div class="form-group">
                                    <label class="col-sm-1"><label for="endinfo">优惠描述</label></label>
                                    <textarea  class="col-sm-3"  style="border: 0;" readonly >{pigcms{$vip.ds_description}</textarea>
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
    function CreateShop(){
        window.location.href = "{pigcms{:U('Promote/discountSpead')}";
    }
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
                layer.msg("您选择的时间有误!",{icon:0});
            }
        });
        $("#enddate").blur(function(){
            var statdate = get_unix_time($('input[name=statdate]').val());
            var enddate = get_unix_time($('input[name=enddate]').val());
            var atime = (enddate-statdate)/(3600*24)*100;
            if(atime<=0){
                alert("您选择的时间有误");
            }
        })
        $("#submit").click(function(){
            var statdate = get_unix_time($('input[name=statdate]').val());
            var enddate = get_unix_time($('input[name=enddate]').val());
            var name = $.trim($('input[name=name]').val());
            var ds_type = $('input[name=ds_type]:checked').val();
            var youhui = $("#have").val();
            var zong = $("#zong").val();
            var pic = $.trim($('input[name=pic]').val());
            var atime = (enddate-statdate)/(3600*24)*100;
            if(name==""){
                alert("优惠名称必须填写");
                return;
            }
            if(pic==""){
                alert("请上传图片");
                return;
            }
            if(atime<=0){
                alert("您选择的时间有误");
                return false;
            }
            if(zong==""){
                alert("总金额不能为空");
                return false;
            }
            if(parseInt(youhui)>parseInt(zong)){
                alert("总金额必须大于优惠金额");
                return false;
            }
            $("#need").val(atime);
            var have = parseInt($("#have").val());
            var need = parseInt($("#need").val());
            if(have<need){
//                alert("您的点值不足！");
//                return false;
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