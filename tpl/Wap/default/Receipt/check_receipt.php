<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{pigcms{$now_village.village_name}</title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name='apple-touch-fullscreen' content='yes'/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/village.css?211"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/weui.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/animate.css"/><!--7.18晚-->
    <!--<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/example.css"/>-->
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style.css"/>
    <script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_public}js/jquery.cookie.js" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/common.js" charset="utf-8"></script>
    <link rel="stylesheet" href="{pigcms{$static_public}boxer/css/jquery.fs.boxer.css">
    <!--<script src="{pigcms{$static_public}boxer/js/jquery-1.8.3.min.js"></script>-->
    <script src="{pigcms{$static_public}js/zepto.min.js"></script><!--7.18晚-->
    <script src="{pigcms{$static_public}boxer/js/jquery.fs.boxer.js"></script>
    <style type="text/css">
        <!--
        .kkw {float:left; height:33px; line-height:33px; margin-left:10px; font-size:12px;}
        .shtx_kek {
            float: left;
            line-height: 33px;
            border: 0;
            font-size: 14px;
            margin-left: 8px;
            width: 60%;
            color: #b6b6b6;
            white-space:nowrap;
            text-overflow:ellipsis;
            -o-text-overflow:ellipsis;
            overflow: hidden;
        }

        a, a:visited, a:hover {
            color: #FFFFFF;
            text-decoration: none;
            outline: 0;
        }
        -->
    </style>
</head>
<script type="text/javascript">
    $(function(){
        $('#backBtn').click(function(){
            window.history.go(-1);
        });

        $('.btn_check').click(function(){	//通过或不通过
            //alert($(this).attr('data_idVal'));
            var ac_status=$(this).attr('data_status');
            var ac_desc=$('textarea[name="ac_desc"]').val();

            $.ajax({
                'url':"{pigcms{:U('check_receipt',array('id'=>$request_info['pigcms_id']))}",
                'data':{'check_type':ac_status,'check_remark':ac_desc},
                'type':'POST',
                'dataType':'JSON',
                'success':function(msg){
                    // console.log(msg);
                    if(msg.err==0){
                        motify.log(msg.data);
                        window.location.href="{pigcms{:U('check_receipt',array('id'=>$request_info['pigcms_id']))}";
                    }else{
                        motify.log(msg.data);
                    }
                },
                'error':function(){
                    console.log(2);
                    alert('loading error');
                }
            })
        })

    })
</script>
<script>
    $(function(){
        $('.boxer').boxer({
            mobile: true
        });
    });
</script>

<body>
<header class="pageSliderHide"><div id="backBtn"></div>业主缴费订单操作请求</header>
<form id="access_form" onSubmit="return false;">
    <div class="shtx_dkx">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
            <div class="kkw">业主信息&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--刘德华-->{pigcms{$info.owner}</div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q2.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
            <div class="kkw">收费项目&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--18086681360-->{pigcms{$info.type_name}</div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
            <div class="kkw">应付金额&nbsp;&nbsp;</div>
            <div class="shtx_kek">{pigcms{$info.pay_receive}
            </div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
            <div class="kkw">实付金额&nbsp;&nbsp;</div>
            <div class="shtx_kek">{pigcms{$info.pay_true}
            </div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
            <div class="kkw">支付方式&nbsp;&nbsp;</div>
            <div class="shtx_kek">{pigcms{$info['fee_type_name']}
            </div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
            <div class="kkw">提交审核人&nbsp;&nbsp;</div>
            <div class="shtx_kek">{pigcms{$request_info['admin_info']['realname']}
            </div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
            <div class="kkw">提交审核时间&nbsp;&nbsp;</div>
            <div class="shtx_kek">{pigcms{:date('Y-m-d H:i:s',$request_info['update_time'])}
            </div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
            <div class="kkw">请求原因&nbsp;&nbsp;</div>
            <div class="shtx_kek">{pigcms{$request_info['remark']}
            </div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
            <div class="kkw">当前状态&nbsp;&nbsp;</div>
            <div class="shtx_kek">
                <if condition="$request_info['check_type'] eq 1" >
                    同意
                <elseif condition="$request_info['check_type'] eq 2"/>
                    驳回
                <else/>
                    尚未处理
                </if>
            </div>
            <div class="both"></div>
        </div>

        <if condition="$request_info['check_type']">
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="{pigcms{$static_path}images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
                <div class="kkw">处理人&nbsp;&nbsp;</div>
                <div class="shtx_kek">{pigcms{$request_info['check_info']['realname']}
                </div>
                <div class="both"></div>
            </div>
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="{pigcms{$static_path}images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
                <div class="kkw">审核时间&nbsp;&nbsp;</div>
                <div class="shtx_kek">{pigcms{:date('Y-m-d H:i:s',$request_info['check_time'])}
                </div>
                <div class="both"></div>
            </div>
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="{pigcms{$static_path}images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
                <div class="kkw">审核备注&nbsp;&nbsp;</div>
                <div class="shtx_kek">{pigcms{$request_info['check_remark']}
                </div>
                <div class="both"></div>
            </div>
        </if>
    </div>
    <if condition="empty($request_info['check_type']) and $admin">
        <div style="width:92%; margin:10px auto; margin-bottom:0px; background-color:#FFFFFF;border-radius: 10px;" id="desc_show"><textarea id="description" name="ac_desc"  placeholder="请输入审核备注,选填" style="width:97%;height:50px; border:none; font-size:14px; line-height:25px; padding-left:5px;"></textarea></div>
        <div class="zkd">
            <div style="float:left;width:48%;"><a href="javascript:;" class="weui_btn weui_btn_warn_blue btn_check" data_status="1">通过</a></div>
            <div style="float:right;width:48%;"><a href="javascript:;" class="weui_btn weui_btn_warn_blue btn_check" data_status="2">不通过</a></div>
            <div style="clear:both"></div>
        </div>
    </if>


</form>
</body>
</html>