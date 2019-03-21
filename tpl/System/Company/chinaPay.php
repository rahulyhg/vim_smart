<layout name="layout"/>
<!--引入日历插件样式 -->
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Home/Public/statics/plublic/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/css/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>银联充值</h1>
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{pigcms{:U('index_news')}">商户列表</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{pigcms{:U('user_list',array('company_id'=>$company_id,'mid'=>$mid))}">员工列表</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">银联充值</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <form action="{pigcms{$pay_url}" method="post" class="form-horizontal" id="form_sample_1" target="_blank">
                <input type="hidden" name="MerId" value="{pigcms{$MerId}"/>
                <input type="hidden" name="MerOrderNo" value="{pigcms{$MerOrderNo}"/>
                <input type="hidden" name="TranDate" value="{pigcms{$TranDate}"/>
                <input type="hidden" name="TranTime" value="{pigcms{$TranTime}"/>
                <input type="hidden" name="TranType" value="0002" maxlength="4"/>
                <input type="hidden" name="BusiType" value="0001" maxlength="4"/>
                <input type="hidden" name="Version" value="20140728"/>
                <input type="hidden" name="Signature" />
                <input type="hidden" name="MerBgUrl" value="http://www.hdhsmart.com/admin.php?g=System&c=Company&a=bgReturn"/>
                <input type="hidden" name="MerPageUrl" value="http://www.hdhsmart.com/admin.php?g=System&c=Company&a=pgReturn&company_id={pigcms{$company_id}&mid={pigcms{$mid}"/>
                <input type="hidden" name="SplitType" value="0001" maxlength="4"/>
                <input type="hidden" name="SplitMethod" value="0"/>
                <input type="hidden" name="MerSplitMsg" value=""/>
                <div class="col-md-12" style="float: left">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">银联充值</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-cloud-upload"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-wrench"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-trash"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->

                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> 您填写的信息可能存在问题，请再检查 </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> 添加成功，请查看记录列表 </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">订单金额
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="OrderAmt" /><input  type="text" id="money" style="display: none;width:100%; outline:none; border:1px #44b549 solid; background-color:#FFFFFF; color:#676a6c; font-size:13px; padding:10px;">
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-9">
                                            <button type="submit" class="btn green" id="tijiao">提交订单</button>
                                            <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Company&a=index_news'">返 回</button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </form>
        </div>

    </div>
</div>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer" style="text-align: center">
    <div class="page-footer-inner" style="width: 100%"> 2017 &copy; 汇得行智慧助手系统
        <a target="_blank" href="http://www.vhi99.com">邻钱科技</a> &nbsp;|&nbsp;
        <a href="http://www.metronic.com" target="_blank">Metronic</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<div class="quick-nav-overlay"></div>
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/excanvas.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/Car/Admin/Public/js/jquery.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!--表单提交检查js-->
<!--<script src="{$Think.config.ADMIN_ASSETS_URL}pages/scripts/form-validation-md.min.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--引入百度文件上传JS开始-->
<script src="/Car/Admin/Public/js/baiduwebuploader/webuploader.js" type="text/javascript"></script>
<!--引入百度文件上传JS结束-->

<!--引入日历jquery插件开始-->
<!--
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.js" type="text/javascript"></script>
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.min.js" type="text/javascript"></script>-->

<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/js/layer.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/sweetalert.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/ui-sweetalert.min.js" type="text/javascript"></script>
<!--引入日历jquery插件结束-->

<script>

    $('#form_sample_1').submit(function () {
        var MerId='{pigcms{$MerId}';
        var MerOrderNo='{pigcms{$MerOrderNo}';
        var TranDate='{pigcms{$TranDate}';
        var TranTime='{pigcms{$TranTime}';
        //console.log(typeof (TranTime));
        var OrderAmt=$("input[name='OrderAmt']").val();
        var sub_mid='{pigcms{$sub_mid}';
        var company_id='{pigcms{$company_id}';
        var mid='{pigcms{$mid}';
        if(OrderAmt<0 || OrderAmt==0){
            alert('请输入正确金额！');
            return false;
        }
        var result=confirm('您确定为当前商户充值'+OrderAmt+'元？');
        var MerSplitMsg=sub_mid+'^'+(OrderAmt*100);
        //var ret;
        if(result==true){
            $.ajax({
                'url':"{pigcms{:U('chinaPay_submit')}"+'&random='+Math.random(),
                'data':{'OrderAmt':OrderAmt,'MerOrderNo':MerOrderNo,'TranDate':TranDate,'TranTime':TranTime,'MerId':MerId,'MerSplitMsg':MerSplitMsg,'company_id':company_id,'mid':mid},
                'type':'POST',
                'dataType':'JSON',
                'async':false,
                'success':function(ret){
                    if(ret.error==0){
                       //console.log(ret.msg);
                        $("input[name='MerSplitMsg']").val(MerSplitMsg);
                        var Signature=ret.msg;
                        $("input[name='Signature']").val(Signature);
                        var money=OrderAmt*100;
                        $("input[name='OrderAmt']").val(money);
//                        $("#money").val(OrderAmt);
//                        $("input[name='OrderAmt']").hide();
//                        $("#money").show();
                       //window.location.href="{pigcms{:U('index_news')}";
                        //window.location.reload();
                    }else{
                        console.log(ret.msg);
                    }
                },
                'error':function(){
                    alert('loading error');
                }
            });

            swal({  title: "请在新打开的页面完成支付",
                    text: "如果您已经完成支付，请点击下方完成支付按钮！谢谢！",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "完成支付",
                    cancelButtonText: "遇到问题，支付失败",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url:"{pigcms{:U('china_pay_select')}",
                            data:{'MerOrderNo':MerOrderNo,'TranDate':TranDate,'TranTime':TranTime,'MerId':MerId,'company_id':company_id,'mid':mid},
                            type:'POST',
                            success:function (msg) {
                                if(msg == 1){
                                    swal({   title: "支付成功",   text: "支付已经完成！",   type: "success",  confirmButtonColor: "#DD6B55",   confirmButtonText: "好的",   closeOnConfirm: false }, function(){ window.location.href="{pigcms{:U('index_news')}" });
                                }else if(msg==2){
                                    swal({   title: "支付失败",   text: "您本次的支付失败了",   type: "error",  confirmButtonColor: "#DD6B55",   confirmButtonText: "完成",   closeOnConfirm: false }, function(){ window.location.href="{pigcms{:U('index_news')}" });
                                }else if(msg==3){
                                    swal({   title: "查询失败",   text: "系统故障，请联系管理员解决",   type: "error",  confirmButtonColor: "#DD6B55",   confirmButtonText: "完成",   closeOnConfirm: false }, function(){ window.location.href="{pigcms{:U('index_news')}" });
                                }else{
                                    console.log(msg);
                                }
                            }

                        });

                    } else {
                        swal("遇到问题", "请您联系公司管理员反应问题", "error");

                    }
            });
            $("input[name='OrderAmt']").hide();

        }else{
            return false;
        }
//        if(ret.error==0){
//            return true;
//        }else{
//            return false;
//        }

//        var OrderStatus=$("input[name='OrderStatus']").val();
//        var tmp_mid=<?php //echo $_SESSION['tmp']['mid'];?>//;
//        var mid=<?php //echo $mid;?>//;
//        if(OrderStatus=='0000' && tmp_mid==mid){
//            window.location.href="<?php //echo $this->SiteUrl;?>///merchants.php?m=User&c=company&a=success_chinaPay&company_id=<?php //echo $company_id;?>//&mid=<?php //echo $mid;?>//";
//            <?php //$_SESSION['tmp']=null;?>
//        }

    });
</script>

</body>

</html>