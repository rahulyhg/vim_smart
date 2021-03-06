<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>
        <notempty name="left_top_msg">
            我的车辆
            <else />
            车辆绑定
        </notempty>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{$Think.config.STATICS_URL}plublic/css/googleapis.css" rel="stylesheet" type="text/css" />
    <link href="{$Think.config.STATICS_URL}plublic/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{$Think.config.STATICS_URL}plublic/css/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{$Think.config.STATICS_URL}plublic/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{$Think.config.STATICS_URL}plublic/css/bootstrap/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="{$Think.config.STATICS_URL}plublic/css/sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{$Think.config.STATICS_URL}plublic/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{$Think.config.STATICS_URL}plublic/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{$Think.config.STATICS_URL}plublic/css/layout/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="{$Think.config.STATICS_URL}plublic/css/layout/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{$Think.config.STATICS_URL}plublic/css/layout/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="{$Think.config.STATICS_URL}plublic/css/style.css" rel="stylesheet" type="text/css" />
    <link href="{$Think.config.STATICS_URL}plublic/css/weui.min.css" rel="stylesheet" type="text/css" />
    <link href="{$Think.config.STATICS_URL}plublic/css/weui.css" rel="stylesheet" type="text/css" />
    <link href="{$Think.config.STATICS_URL}plublic/css/weui2.css" rel="stylesheet" type="text/css" />
    <script src="{$Think.config.STATICS_URL}plublic/js/zepto.min.js"></script>
    <!-- END THEME LAYOUT STYLES -->
    <style type="text/css">
        <!--
        .fez.active, .fez:active:focus, .fez:active:hover, .fez:focus, .fez:hover {border-color: #278ff0;
            color: #ffffff;
            background-color: #278ff0;}
        .mt20 {margin-top:20px;}
        .zi {width:48px; height:48px; border:1px #eaeaea solid; text-align:center; color:#848484; font-size:16px; line-height:48px; float:left; margin:5px; background-color:#FFFFFF;}
        .zi:link {background-color:#389ffd; color:#FFFFFF; border:1px #389ffd solid; text-align:center;}
        .zi:visited {background-color:#389ffd; color:#FFFFFF; border:1px #389ffd solid; text-align:center;}
        .zi:hover {background-color:#389ffd; color:#FFFFFF; border:1px #389ffd solid; text-align:center;}
        .zi:active  {background-color:#389ffd; color:#FFFFFF; border:1px #389ffd solid; text-align:center;}
        .kid {padding: 14px 10px 5px!important;}
        .col-md-6 {width:100%;}
        .portlet {
            margin-top: 0;
            margin-bottom: 5px;
            padding: 0;
            border-radius: 4px;
        }
        @media (min-width:414px) and (max-width:500px) {
            .dropdown-menu {
                min-width: 528%;
                padding: 5px 0 8px 8px;
            }
        }
        @media (min-width:375px) and (max-width:411px) {
            .dropdown-menu {
                min-width: 470%;
                padding: 5px 0 8px 16px;
            }
        }
        @media (min-width:320px) and (max-width:359px) {
            .dropdown-menu {
                min-width: 412%;
                padding: 5px 0 8px 13px;
            }
        }
        @media (min-width:360px) and (max-width:374px) {
            .dropdown-menu {
                min-width: 480%;
                padding: 5px 0 8px 10px;
            }
        }
        @media (width:412px) {
            .dropdown-menu {
                min-width: 580%;
                padding: 5px 0 8px 10px;
            }
        }
        @media (width:768px) {
            .dropdown-menu {
                min-width: 1110%;
                padding: 5px 0 8px 30px;
            }
        }
        .input-group-addon, .input-group-btn {
            width: 1%;
            vertical-align: top;
        }
        .btn.btn-outline.blue {
            border-color: #ededed;
            color: #389ffe;
            background: 0 0;
            padding: 12px 0;
            background-color:#f6f6f6;
        }
        .btn-circle {
            border-radius: 4px 0 0 4px!important;
            overflow: hidden;
        }
        .btn.btn-outline.blue.active, .btn.btn-outline.blue:active, .btn.btn-outline.blue:active:focus, .btn.btn-outline.blue:active:hover, .btn.btn-outline.blue:focus, .btn.btn-outline.blue:hover {
            border-color: #5ca8ee;
            color: #ffffff;
            background-color: #5ca8ee;
        }
        .dwe {float:left; width:22%; line-height:1; border-left:1px #f6f6f6 solid; border-right:1px #5ca8ee solid; border-top:1px #5ca8ee solid; border-bottom:1px #5ca8ee solid; border-radius:0 4px 4px 0; text-align:center; font-size:16px; padding: 11px 0;background-color: #5ca8ee; color:#FFFFFF;}
        .dwe:link {background-color:#217ebd; border:1px #217ebd solid;}
        .dwe:visited {background-color:#217ebd; border:1px #217ebd solid;}
        .dwe:hover {background-color:#217ebd; border:1px #217ebd solid;}
        .dwe:active  {background-color:#217ebd; border:1px #217ebd solid;}

        hr, p {
            margin:0;
        }

        a:hover {
            text-decoration: none;
        }

        a {
            color: #337ab7;
            text-decoration: none;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        [class*=" fa-"]:not(.fa-stack), [class*=" glyphicon-"], [class*=" icon-"], [class^=fa-]:not(.fa-stack), [class^=glyphicon-], [class^=icon-] {
            font-size: 20px;
            color:#389ffe;
        }

        .weui_tabbar_icon {
            text-align: center;
            padding-top:6px;
        }
        .wb_arrow{
            border-right: 3px solid #bfbec3;
            border-top: 3px solid #bfbec3;
            height: 10px;
            width: 10px;
            float:right;
            margin:42px auto 0;
            margin-right: 15px;
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            /*不加这两个属性三角会比上一个略丑, 大家可以试一下*/
            border-left: 2px solid transparent;
            border-bottom: 2px solid transparent;
        }
        -->
    </style></head>
<script>
    $(function(){
        //weui_bar_item_on 高亮
//weui_tabbar_item
        $('.weui_tabbar_item').click(function(){
            $('.weui_tabbar_item').removeClass('weui_bar_item_on');
            $(this).addClass('weui_bar_item_on');
        });


        TagNav('#tagnav',{
            type: 'scrollToFirst',
        });
        $('.weui_tab').tab({
            defaultIndex: 0,
            activeClass:'weui_bar_item_on',
            onToggle:function(index){
                if(index>0){
                    alert(index)
                }
            }
        });
    });

</script>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<!-- END HEAD -->

<body style="background-color:#FFFFFF;">
<!-- BEGIN HEADER -->
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container" >
    <!-- BEGIN SIDEBAR -->
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper" id="center">
        <!-- BEGIN CONTENT BODY -->
        <div style="padding: 20px 10px 10px!important;">
            <div style="margin:5px 10px 0px 15px; padding-left:30px; font-size:18px; color:#242424; background:url({$Think.config.STATICS_URL}car_bind/images/car.png) no-repeat left; background-size:24px;">
                <notempty name="left_top_msg">
                    我的车辆
                    <div style="height:30px; float:right;">
                        <div style="margin-left:3%; float:right; font-size:12px; line-height:30px;"><a href="__APP__?s=/Home/car/choose_garage">{$garage_array.garage_name}</a></div>
                        <div style="float:right; width:7%;"><img src="{$Think.config.STATICS_URL}car_bind/images/tthy.png" style="width:100%; height:auto; margin-top:-2px;"></div>
                        <div style="clear:both"></div>
                    </div>
                    <else />
                    车辆绑定</a>
                    <div style="height:30px; float:right;">
                        <div style="margin-left:3%; float:right; font-size:14px; line-height:30px;"><a href="__APP__?s=/Home/car/choose_garage">{$garage_array.garage_name}</a></div>
                        <div style="float:right; width:7%;"><img src="{$Think.config.STATICS_URL}car_bind/images/tthy.png" style="width:100%; height:auto; margin-top:-2px;"></div>
                        <div style="clear:both"></div>
                    </div>
                </notempty>
            </div>

            <a href="{$Think.config.web_domain}/index.php?m=Home&c=User&a=user_index"><div style="margin:15px 10px 5px 10px; height:95px; background-color:#f6f6f6; border-radius: 4px; border: 1px #ededed solid;">
                    <div style="margin:12px 10px 10px 12px; float:left; width:70px; height:70px;"><img src="{$Think.session.headimgurl}" style="width:100%; height:auto;"></div>
                    <div style="margin:24px 0px 10px 0px; float:left;">
                        <div style="line-height:25x; color:#2c2c2c; height:25px; width:180px; overflow:hidden; font-size:16px;">{$Think.session.nickname}</div>
                        <if condition="$user_info['user_phone'] and $user_info['user_t_name']">
                            <div style="line-height:25px; color:#9c9c9c; height:25px; width:180px; overflow:hidden; font-size:14px;">会员：{$user_info['user_t_name']}[{$user_info['user_phone']}]</div>
                            <else/>
                            <div style="line-height:25px; color:#9c9c9c; height:25px; width:180px; overflow:hidden; font-size:14px;">[请完善资料]</div>
                        </if>

                    </div>
                    <div class="wb_arrow"></div>
                    <div style="float:right; margin-right:5px; width:15px; margin-top:34px;"><img src="{$Think.config.STATICS_URL}car_bind/images/rwm.png" style="width:100%; height:auto;"></div>
                    <div style="clear:both"></div>
                </div>
            </a>

            <div class="kid"><div class="row">
                    <div class="col-md-6 ">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="portlet-body">
                                    <form role="form" action="" method="post" formborder="0" >
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <div id="car_no_pre_div" class="input-group-btn">
                                                        <button type="button" class="btn green dropdown-toggle" data-toggle="dropdown">
                                                            <span id="button_html">
                                                                <span id="car_no_along">鄂</span>
                                                                <span id="car_no_A">A</span>
                                                            </span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <input type="hidden"  name="car_no_pre" value="鄂-A">
                                                        <div id="car_A" class="dropdown-menu" style="display: none;width: 400%;">

                                                            <?php for($i=65;$i<91;$i++){ ?>
                                                                <div class="zi"><?php echo strtoupper(chr($i)); ?></div>
                                                            <?php } ?>

                                                        </div>

                                                        <div id="dropdown-menu2" class="dropdown-menu">
                                                            <div class="zi">鄂</div>
                                                            <div class="zi">湘</div>
                                                            <div class="zi">京</div>
                                                            <div class="zi">津</div>
                                                            <div class="zi">沪</div>
                                                            <div class="zi">冀</div>
                                                            <div class="zi">豫</div>
                                                            <div class="zi">云</div>
                                                            <div class="zi">辽</div>
                                                            <div class="zi">黑</div>
                                                            <div class="zi">皖</div>
                                                            <div class="zi">鲁</div>
                                                            <div class="zi">新</div>
                                                            <div class="zi">苏</div>
                                                            <div class="zi">浙</div>
                                                            <div class="zi">赣</div>
                                                            <div class="zi">桂</div>
                                                            <div class="zi">甘</div>
                                                            <div class="zi">晋</div>
                                                            <div class="zi">蒙</div>
                                                            <div class="zi">陕</div>
                                                            <div class="zi">吉</div>
                                                            <div class="zi">闵</div>
                                                            <div class="zi">贵</div>
                                                            <div class="zi">粤</div>
                                                            <div class="zi">川</div>
                                                            <div class="zi">青</div>
                                                            <div class="zi">藏</div>
                                                            <div class="zi">琼</div>
                                                            <div class="zi">宁</div>
                                                            <div class="zi">渝</div>
                                                        </div>
                                                    </div>

                                                    <!-- /btn-group -->
                                                    <input type="text" class="form-control" placeholder="车牌后5位" maxlength="5" name="c_no" style="background-color:#f6f6f6; border:1px #ededed solid; border-left:none; height:43px; line-height:43px; -webkit-appearance: none; border-right:none; font-size:15px;">
                                                    <span class="input-group-btn">
                                                        <button class="btn blue fez" type="submit" id="showLoadingToast">&nbsp;&nbsp;&nbsp;新增&nbsp;&nbsp;&nbsp;</button>
                                                    </span>
                                                    <!-- /btn-group -->
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                            <!-- /.col-md-6 -->
                                        </div>
                                        <!-- /.row -->
                                    </form>
                                </div>
                            </div>
                            <div style="width:100%;display: none; padding:2%; margin: 10px auto; font-size:14px; line-height: 1.5; border:1px #ededed solid; border-radius: 4px; color:#929292;"><span style="color:#fb4746;">通知：</span>由于停车场收费系统于今日（2月20日）下午15点至16点20进行系统升级，届时无法使用微信缴费功能，给您带来的不便深表歉意，敬请谅解。</div>
                            <div class="portlet-title" id="old_car">
                                <div style="height:44px;background-color: #f6f6f6;border-radius:4px; text-align:center; line-height:44px; color:#389ffe; border: 1px #ededed solid; font-family:'微软雅黑'; font-weight:500; font-size:16px; margin-top:10px;">
                                    <notempty name="result_msg">
                                        {$result_msg}
                                        <else />
                                        欢迎使用本服务
                                    </notempty>
                                </div>
                                <!--显示(模糊查询)(用户输入车牌号)的结果-->
                                <notempty name="result_datas">
                                    <div style="height:44px;background-color: #f6f6f6;border: 1px #ededed solid; border-radius:4px; text-align:center; line-height:44px; color:#389ffe; font-family:'微软雅黑'; font-size:16px; margin-top:10px;" onClick="get_this_val_new(this)">{$result_datas}</div>

                                </notempty>

                                <!--旧用户显示已经绑定的车辆-->
                                <notempty name="car_infos">
                                    <foreach name="car_infos" item="v">
                                        <div class="binded_carno" style="margin-top:12px;">
                                            <div style="float:left; width:78%;"><button class="btn btn-circle blue btn-block btn-outline " onClick="get_this_val(this)">{$v.car_no}</button></div>
                                            <div class="dwe" onClick="remove_car_no(this)"><img src="{$Think.config.STATICS_URL}car_bind/images/rub.png" style="width:15px; height:16px;"></div>
                                            <div style="clear:both"></div>
                                        </div>
                                    </foreach>
                                </notempty>
                                <div style="width:96%; margin: 0px auto; padding-top: 15px; line-height: 1.5;"><span style="color: #337ab7; font-weight:bold;">温馨提示：</span><span style="color: #666666;">如在系统使用过程中遇到任何问题，请拨打</span><a href="tel:027-87779655" style="font-weight:bold;">027-87779655(点击拨号)</a><span style="color: #666666;">与我们联系！</span></div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="ki"><span style="font-family:AriaL;">Power by:</span>汇得行控股（中国）有限公司</div>-->
                    <!-- END PAGE BASE CONTENT -->
                </div></div>
            <div class="kid">
                <notempty name="show_spell">
                    <!--
                    <div class="portlet-title">
                        <a href="{:U('maybe_spell_showlist')}">
                        <div style="height:44px;background-color: #f6f6f6;border: 1px #ededed solid; border-radius:4px; text-align:center; line-height:44px; color:#389ffe; font-family:'微软雅黑'; font-size:16px; margin-top:10px;">解绑车牌</div>
                        </a>
                    </div>
                    -->
                </notempty>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!--<div class="ki"><span style="font-family:AriaL;">Power by:</span>汇得行控股（中国）有限公司</div>-->
        <!-- END CONTENT -->
        <!-- BEGIN QUICK SIDEBAR -->
        <!-- END QUICK SIDEBAR -->
    </div>
</div>
<!--加载提示框开始-->
<div id="loadingToast" style="display:none;">
    <div class="weui-mask_transparent"></div>
    <div class="weui-toast">
        <i class="weui-loading weui-icon_toast"></i>
        <p class="weui-toast__content">数据加载中</p>
    </div>
</div>

<div class="tab-bottom">

    <div class="weui_tabbar ">
        <a href="{$Think.config.web_domain}/index.php?m=Home&c=Car&a=use_service" class="weui_tabbar_item weui_bar_item_on">
            <div class="weui_tabbar_icon">
                <i class="fa fa-car"></i>
            </div>
            <p class="weui_tabbar_label">我的车辆</p>
        </a>
        <!--<a href="{$Think.config.web_domain}/index.php?m=Home&c=Bill&a=record" class="weui_tabbar_item">-->
        <!--<div class="weui_tabbar_icon">-->
        <!--<i class="fa fa-ticket"></i>-->
        <!--</div>-->
        <!--<p class="weui_tabbar_label">发票申领</p>-->
        <!--</a>-->
        <a href="{$Think.config.web_domain}/index.php?m=Home&c=User&a=user_index" class="weui_tabbar_item">
            <div class="weui_tabbar_icon">
                <i class="fa fa-user"></i>
            </div>
            <p class="weui_tabbar_label">个人中心</p>
        </a>
        <!--<a href="{$Think.config.web_domain}/index.php?m=Home&c=Feedback&a=index&user_id={$Think.session.user_id}" class="weui_tabbar_item">
            <div class="weui_tabbar_icon">
                <i class="fa fa-question-circle"></i>
            </div>
            <p class="weui_tabbar_label">问题反馈</p>
        </a>-->
    </div>
</div>

<script>
    var load = document.getElementById("loadingToast");
    load.style.display="block";
    window.onload=function(){

        load.style.display ="none";
    }
</script>
<!--加载提示框结束-->
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{$Think.config.STATICS_URL}plublic/js/example.js"></script>
<script src="{$Think.config.STATICS_URL}plublic/js/jquery/jquery.min.js" type="text/javascript"></script>
<script src="{$Think.config.STATICS_URL}plublic/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
<script src="{$Think.config.STATICS_URL}plublic/js/sweetalert.min.js" type="text/javascript"></script>
<script src="{$Think.config.STATICS_URL}plublic/js/ui-sweetalert.min.js" type="text/javascript"></script>
<!--插入layer弹层js开始-->
<script src="{$Think.config.HOME_JS_URL}layer.js" type="text/javascript"></script>
<script src="{$Think.config.HOME_JS_URL}defined.js" type="text/javascript"></script>
<!--插入layer弹层js结束-->
<script type="text/javascript">
    $(function(){
        $("#dropdown-menu2").children().click(function(){
            $('#car_no_along').html($(this).html());
            $('#car_A').css('display','block');
        });
        $('#car_A').children().click(function(){
            $('#car_no_A').html($(this).html());
            $('#car_A').css('display','none');
            $("input[name='car_no_pre']").val($('#car_no_along').html()+"-"+$('#car_no_A').html());
        });
        var $loadingToast = $('#loadingToast');
        $('#showLoadingToast').on('click', function(){
            if ($loadingToast.css('display') != 'none') return;

            $loadingToast.fadeIn(100);
            setTimeout(function () {
                $loadingToast.fadeOut(100);
            }, 2000);
        });
    });

    var web_url = "{$web_url}";

    //当点击“新增”按钮时，将车牌前缀和输入的内容拼接起来
    $('form').submit(function(evt){
        var car_no_length=($("input[name='c_no']").val()).length;
        var regst = /[a-zA-Z_0-9]{5}$/;
        var $loadingToast = $('#loadingToast');
        //当车牌输入不合法时，阻止提交
        if(car_no_length!=5){
            $loadingToast.fadeOut(100);
            swal({
                title: "输入格式不合法",
                text: "请输入5位英文或者数字",
                type: "info",
                closeOnConfirm: false,
                confirmButtonText: "好的",
                confirmButtonColor: "#ec6c62",
            }, function() {
                //跳转到首页
                window.location.reload();
            });
            evt.preventDefault();
        }else if(!regst.test($("input[name='c_no']").val())){
            $loadingToast.fadeOut(100);
            swal({
                title: "输入格式不合法",
                text: "请输入5位英文或者数字",
                type: "error",
                closeOnConfirm: false,
                confirmButtonText: "好的",
                confirmButtonColor: "#ec6c62",
            });
            evt.preventDefault();
        }
    });

    function get_this_val(obj){
        var car_no=$(obj).text();
        //alert(car_no);
        //$("input[name='c_no']").val($(obj).html());
        //$('#car_no_pre_div').remove();
        var $loadingToast = $('#loadingToast');
        $("#old_car").on('click',obj,function(){
            //alert(obj.parentNode.nextSibling.nodeName);
            if ($loadingToast.css('display') != 'none') return;

            $loadingToast.fadeIn(100);
            setTimeout(function () {
                $loadingToast.fadeOut(100);

            }, 3500);
        });

        //判断是否能精确匹配，如果不能精确匹配
        $.ajax({
            url:"{:U('ajax_is_go_order_detail')}",
            data:{'car_no2':car_no},
            dataType:'json',
            type:'post',
            timeout:45000,
            beforeSend:function(){
                $loadingToast.fadeIn(100);
            },
            success:function(msg){
                if(msg!='2'&&msg!='4'){
                    //精确匹配，直接提交，跳转到详情页
                    //window.location.href("{:U('Payrecord/order_detail?')}"+"pay_id="+card);

                    //submit之前进行数据制作
                    //alert(car_no.substring(0,3));
                    //alert(car_no.substring(3));
                    /* $("input[name='car_no_pre']").val(car_no.substring(0,3));
                     $("input[name='c_no']").val(car_no.substring(3));

                     $('form').submit();*/
                    window.location.href= "__APP__?m=Home&c=Payrecord&a=order_detail&pay_id="+msg.pay_record+"&car_no="+msg.car_no;
                }else if(msg == '2'){
                    //车辆不在停车场内
                    //①：判断此车辆是否已经绑定，如果没有绑定先进行绑定操作
                    check_card_is_binding($(obj).html());
                }else if(msg == '4'){
                    //错误警告直接报警
                    send_warning_message();
                }
            },
            complete:function(XMLHttpRequest,status){
                if(status == 'timeout'){

                    //如果超时的话直接向我们发送警告消息
                    send_warning_message();
                }
                $loadingToast.fadeOut(100);
            }
        });
    }

    //判断当前车牌是否已经被当前用户绑定过！
    function check_card_is_binding(car_no){
        var $loadingToast = $('#loadingToast');
        $.ajax({
            url:"{:U('check_card_is_binding')}",
            data:{'car_no4':car_no},
            dataType:'json',
            type:'post',
            beforeSend:function(){
                $loadingToast.fadeIn(100);
            },
            success:function(msg){
                if(msg==2){
                    //未绑定
                    $loadingToast.fadeOut(100);
                    binding_car(car_no);
                }else if(msg==1){
                    //已经绑定
                    $loadingToast.fadeOut(100);
                    swal({
                        title: "车辆"+car_no+"不在停车场内!",
                        text: "请确保该车辆已进入场内。",
                        type: "info",
                        showCancelButton: false,
                        closeOnConfirm: false,
                        confirmButtonText: "好的",
                        confirmButtonColor: "#ec6c62"
                    }, function() {
                        //跳转到首页
                        window.location.href = "__APP__?m=Home&c=Car&a=use_service";
                    });
                }
            },
            complete:function(XMLHttpRequest,status){
                $loadingToast.fadeOut(100);
            }
        });
    }

    //ajax绑定车辆
    function binding_car(car_no){
        var $loadingToast = $('#loadingToast');
        var garage_id = "{$Think.session.garage_id}";
        $.ajax({
            url:"{:U('ajax_binding_car')}",
            data:{'car_no3':car_no,'garage_id':garage_id},
            dataType:'json',
            type:'post',
            beforeSend:function(){
                $loadingToast.fadeIn(100);
            },
            success:function(msg){
                if(msg=='1'){
                    $('#loadingToast').fadeOut(100);
                    swal({
                        title: "恭喜您，车辆"+car_no+"绑定成功!",
                        text: "提示:请在车辆出场前提前进行缴费。",
                        type: "success",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        confirmButtonText: "完成",
                        confirmButtonColor: "#ec6c62",
                        cancelButtonText:"取消"
                    }, function() {
                        //跳转到首页
                        window.location.href = "__APP__?m=Home&c=Car&a=use_service";
                    });
                }else if(msg=='2'){
                    //alert('车库无此车辆');

                    swal({
                        title: "很抱歉！："+car_no,
                        text: "车辆绑定失败！请点继续重试！",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        confirmButtonText: "重试",
                        confirmButtonColor: "#ec6c62",
                        cancelButtonText:"取消"
                    }, function() {
                        //不作任何操作
                        window.location.reload();
                    });
                }
            },
            complete:function(XMLHttpRequest,status){
                $loadingToast.fadeOut(100);
            }
        });
    }


    function submit_this_car(obj){

        layer.msg('确定车牌：'+$(obj).html()+'？', {
            time: 0 //不自动关闭
            ,btn: ['确定', '取消']
            ,yes: function(index){
                layer.close(index);
                $("input[name='c_no']").val($(obj).html());
                //$('#car_no_pre_div').remove();
                $('form').submit(function(){
                    $('#car_no_pre_div').remove();
                });
            }
        });
    }


    function get_this_val_new(obj){

        //$("input[name='c_no']").val($(obj).html());
        var card=$(obj).html();
        //$('#car_no_pre_div').remove();
        swal({
            title: "绑定车牌："+card,
            text: "请确认车牌是否正确，确认请点击继续。",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "继续",
            confirmButtonColor: "#ec6c62",
            cancelButtonText:"取消"
        }, function() {
            $('#loadingToast').fadeIn(100);
            //$('form').prop('action',":U('user_affirm')");
            //$('form').submit();
            //通过ajax请求数据
            get_this_val(obj);
            /*
            $.ajax({
                url:"{:U('ajax_binding_car')}",
                data:{'car_no3':card},
                dataType:'json',
                type:'post',
                success:function(msg){
                    if(msg=='1'){
                        swal({
                            title: "恭喜您啦！："+card,
                            text: "绑定成功！",
                            type: "info",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            confirmButtonText: "继续",
                            confirmButtonColor: "#ec6c62",
                            cancelButtonText:"取消"
                        }, function() {
                            //跳转到首页
                            window.location.reload();
                        });
                    }else if(msg=='2'){
                        //alert('车库无此车辆');
                        swal({
                            title: "很抱歉！："+card,
                            text: "车辆绑定失败！请点继续重试！",
                            type: "info",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            confirmButtonText: "继续",
                            confirmButtonColor: "#ec6c62",
                            cancelButtonText:"取消"
                        }, function() {
                            //不作任何操作
                            window.location.reload();
                        });
                    }
                }
            });
            */
        });

        //$('form').submit();
    }
    /*解绑车子
     * @author 祝君伟
     * */
    function remove_car_no(obj){
        var $loadingToast = $('#loadingToast');
        $loadingToast.fadeOut(100);
        var car_no=$(obj).prev().children().text();
        swal({
            title: "车辆解绑："+car_no,
            text: "确定要与该车辆解除绑定吗，确认请点击继续。",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "继续",
            confirmButtonColor: "#ec6c62",
            cancelButtonText:"取消",
            showLoaderOnConfirm: true,
        },function(){
            remove_user_car(car_no);
        });

    }

    /*后台逻辑解绑车子
     *
     * */
    function remove_user_car(obj){
        //通过ajax进行解绑操作
        $.ajax({
            url:"{:U('spell_binding_c')}",
            data:{'car_no2':obj},
            dataType:'json',
            type:'post',
            success:function(msg){
                if(msg == '1'){
                    setTimeout(function(){
                        swal({
                            title: obj+"解绑成功!",
                            text: "提示：如不小心解除绑定，再次绑定即可。",
                            type: "success",
                            closeOnConfirm: false,
                            confirmButtonText: "完成",
                            confirmButtonColor: "#ec6c62",
                        }, function() {
                            //跳转到首页
                            window.location.reload();
                        });
                    },2000);
                }else{
                    setTimeout(function(){
                        swal({
                            title: "很抱歉！："+obj+"解绑失败",
                            text: "请点击确认，刷新页面重试！",
                            type: "info",
                            closeOnConfirm: false,
                            confirmButtonText: "继续",
                            confirmButtonColor: "#ec6c62",
                        }, function() {
                            //不作任何操作
                            window.location.reload();
                        });
                    },2000);
                }
            }
        });
    }

    function is_in_garage(card){
        //通过ajax判断车辆是否在场内
        $.ajax({
            url:"{:U('ajax_is_go_order_detail')}",
            data:{'car_no2':card},
            dataType:'json',
            type:'post',
            success:function(msg){
                if(msg!='2'&&msg!='4'){
                    //window.location.href("{:U('Payrecord/order_detail?')}"+"pay_id="+card);
                    $("input[name='car_no_pre']").val(card.substring(0,3));
                    $("input[name='c_no']").val(card.substring(3));
                    $('form').submit();
                }else if(msg=='2'){
                    swal({
                        title: "很抱歉！："+card,
                        text: "此车辆不在停车场内，请点击继续重新搜索！",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        confirmButtonText: "继续",
                        confirmButtonColor: "#ec6c62",
                        cancelButtonText:"取消"
                    }, function() {
                        //不作任何操作
                        window.location.reload();
                    });
                }else if(msg == '4'){
                    //出错以后，直接报警
                    send_warning_message();
                }
            }
        });
    }



    function send_warning_message(){
        $.ajax({
            url:"{:U('warning_msg_send')}",
            data:{'warning_name':'是否在场接口'},
            type:'post',
            success:function(res){
                swal({
                    title: "很抱歉!",
                    text: "系统故障，请稍后再试。",
                    type: "info",
                    closeOnConfirm: false,
                    confirmButtonText: "继续",
                    confirmButtonColor: "#ec6c62",
                }, function() {
                    //不作任何操作
                    window.location.reload();
                });
            }
        });
    }
    /*
    //ajax判断当车牌输入到5位，且当前用户未绑定此车牌，并且该车辆在停车场内
    $(function(){
        $("input[name='c_no']").keyup(function(){
            var c_no_val=$("input[name='c_no']").val();
            //防止bug
            var val_length=c_no_val.length;

            //if(val_length==7){
            //    $("input[name='c_no']").val(c_no_val.substring(3));
            //}


            if(val_length==5){

                var car_no=$("input[name='car_no_pre']").val()+c_no_val;

                //车牌前缀和车牌后5位进行拼接
                //$("input[name='c_no']").val($("input[name='car_no_pre']").val()+c_no_val);

                //将所有英文小写字符进行大写化
                var car_strs=c_no_val;
                $("input[name='c_no']").val(car_strs.toUpperCase());
                car_no=car_no.toUpperCase();

                //alert(car_no);
                $.ajax({
                    url:"{:U('api_check_car_is_in')}",
                    data:{'car_no6':car_no},
                    dataType:'json',
                    type:'post',
                    success:function(msg){
                        if(msg=='1'){
                            swal({
                                title: "绑定车牌："+car_no,
                                text: "请确认车牌是否正确，确认请点击继续。",
                                type: "info",
                                showCancelButton: true,
                                closeOnConfirm: false,
                                confirmButtonText: "继续",
                                confirmButtonColor: "#ec6c62",
                                cancelButtonText:"取消"
                            }, function() {
                                $('form').submit();
                            });
                        }
                    }
                });
            }
        });
    });

    */

    //选中所有的已绑车牌的div
    //当用户向左滑动车牌时，显示解绑
    /*
    $(function(){
        $(".binded_carno").each(function(k,v){
            $(v).on('swipeleft',function(){
                alert('您进行了向左滑动');
            });
        });
    });
    */



    //单独解决用户中文状态下输入英文字符无keyup状况处理
    $("input[name='c_no']").blur(function(){
        var c_no_val=$("input[name='c_no']").val();
        var car_strs=c_no_val;
        $("input[name='c_no']").val(car_strs.toUpperCase());
        car_no=car_no.toUpperCase();
    });


    $('#fake_src').on('click',function(){
        var $loadingToast = $('#loadingToast');
        $loadingToast.fadeIn();
        setTimeout(function () {
            $loadingToast.fadeOut();
        }, 5000);
        window.location.href = "{:U('User/user_index')}";
    });

</script>
</body>

</html>