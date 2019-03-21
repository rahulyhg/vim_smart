<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>物业缴费</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #4 for basic bootstrap tables with various options and styles" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <!--WEUI-->
    <!-- head 中 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="http://demo.hdhsmart.cn/html/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="http://demo.hdhsmart.cn/html/metronic/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="http://demo.hdhsmart.cn/html/metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="http://demo.hdhsmart.cn/html/metronic/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="http://demo.hdhsmart.cn/html/metronic/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="http://demo.hdhsmart.cn/html/metronic/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="http://demo.hdhsmart.cn/html/metronic/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="http://demo.hdhsmart.cn/html/metronic/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="http://demo.hdhsmart.cn/html/metronic/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />

    <style>
        .col-md-6{
            padding-left: 0;
            padding-right: 0;
            border: 0;
        }
    </style>
</head>
<body >
<div class="col-md-6">
    <!-- BEGIN CONDENSED TABLE PORTLET-->
    <div class="portlet box red">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-picture"></i>绑定租户表 </div>
            <div class="tools">
                <!--                <a href="javascript:;" class="collapse"> </a>-->
                <!--                <a href="#portlet-config" data-toggle="modal" class="config"> </a>-->
                <!--                <a href="javascript:;" class="reload"> </a>-->
                <!--                <a href="javascript:;" class="remove"> </a>-->
            </div>
        </div>
        <!--搜索栏-->
        <div class="weui-search-bar" id="searchBar">
            <div class="weui-search-bar__form">
                <div class="weui-search-bar__box">
                    <i class="weui-icon-search" onclick="sea()" ></i>
                    <input type="search" class="weui-search-bar__input" id="searchInput"   <if condition="isset($searchV)">value="{pigcms{$searchV}"<else />placeholder="搜索"</if> >
                    <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
                </div>
                <label class="weui-search-bar__label" id="searchText">
                    <i class="weui-icon-search"></i>
                    <if condition="isset($searchV)"><span>{pigcms{$searchV}</span><else />
                    <span>搜索</span>
                    </if>
                </label>
            </div>
            <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel" onclick="sea()">搜索</a>
        </div>

        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <if condition="$village_type eq 0">
                        <th style="width: 75% !important;"> 租户名称 </th>
                        <th style="width: 25% !important;"> 状态 </th>
                            <else />
                            <th style="width: 40% !important;"> 租户名称 </th>
                            <th style="width: 30% !important;"> 所在社区 </th>
                            <th style="width: 30% !important;"> 状态 </th>
                        </if>
                    </tr>
                    </thead>
                    <tbody>
                    <if condition="$village_type eq 0">
                        <foreach name="data" item="vo">
                            <if condition="$vo.tenantname neq ''">
                                <tr>
                                    <td> {pigcms{$vo.tenantname} </td>
                                    <td>

                                        <if condition="$vo['status'] eq 0"> <span class="label label-sm label-success" onclick="audit(this,{pigcms{$vo.pigcms_id})" > 绑定 </span>
                                            <elseif condition="$vo['status'] eq 1" /><span class="label label-sm label-danger" onclick="del_audit(this,{pigcms{$vo.pigcms_id})" > 解绑 </span>
                                            <else /><span class="label label-sm label-default" > 审核中 </span>
                                        </if>
                                    </td>
                                </tr>
                            </if>
                        </foreach>
                        <else />
                        <foreach name="data" item="vo">
                            <if condition="$vo.tenantname neq ''">
                                <tr>
                                    <td> {pigcms{$vo.tenantname} </td>
                                    <td> {pigcms{$vo.village_name} </td>
                                    <td>

                                        <if condition="$vo['status'] eq 0"> <span class="label label-sm label-success" onclick="bind(this,{pigcms{$vo.pigcms_id})" > 绑定 </span>
                                            <elseif condition="$vo['status'] eq 1" /><span class="label label-sm label-danger" onclick="del(this,{pigcms{$vo.pigcms_id})" > 解绑 </span>
                                            <else /><span class="label label-sm label-default" > 审核中 </span>
                                        </if>
                                    </td>
                                </tr>
                            </if>
                        </foreach>
                    </if>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END CONDENSED TABLE PORTLET-->
</div>

<script src="http://demo.hdhsmart.cn/html/metronic/assets/global/plugins/respond.min.js"></script>
<script src="http://demo.hdhsmart.cn/html/metronic/assets/global/plugins/excanvas.min.js"></script>
<script src="http://demo.hdhsmart.cn/html/metronic/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="http://demo.hdhsmart.cn/html/metronic/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="http://demo.hdhsmart.cn/html/metronic/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="http://demo.hdhsmart.cn/html/metronic/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="http://demo.hdhsmart.cn/html/metronic/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="http://demo.hdhsmart.cn/html/metronic/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="http://demo.hdhsmart.cn/html/metronic/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!--<script src="http://demo.hdhsmart.cn/html/metronic/assets/global/scripts/app.min.js" type="text/javascript"></script>-->
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!--<script src="http://demo.hdhsmart.cn/html/metronic/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>-->
<!--<script src="http://demo.hdhsmart.cn/html/metronic/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>-->
<!--<script src="http://demo.hdhsmart.cn/html/metronic/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>-->
<script src="http://demo.hdhsmart.cn/html/metronic/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>

<!-- body 最后 -->
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>
<script>
    var uid = "{pigcms{$uid}";
    var village_id = "{pigcms{$village_id}";
    function audit(el,id) {
        if(confirm("确定要绑定吗？")) {
            $.ajax({
                url:"{pigcms{:U('pay_add_tenant_auditing')}",
                type:'post',
                data:'pigcms_id='+id+'&uid='+uid+'&village_id='+village_id,
                success:function(re) {
                    if (re == 1) {
                        alert('消息已发送，客服会随后为您进行审核');
                        $(el).parent().html("<span class=\"label label-sm label-default\" > 审核中 </span>");
                    } else {
                        alert(re);
                    }
                }
            })
        }

    }

    function bind(el,id) {
        if(confirm("确定要绑定吗？")) {
            $.ajax({
                url:"{pigcms{:U('pay_add_tenant_auditing')}",
                type:'post',
                data:'pigcms_id='+id+'&uid='+uid+'&village_id='+village_id,
                success:function(re) {
                    if (re == 1) {
                        $(el).parent().html("<span class=\"label label-sm label-danger\" onclick=\"del(this,{pigcms{$vo.pigcms_id})\" > 解绑 </span>");
                    } else {
                        alert(re);
                    }
                }
            })
        }

    }


    function del_audit(el,id) {
        if(confirm("确定要解绑吗？")) {
            $.ajax({
                url: "{pigcms{:U('pay_add_tenant_del')}",
                type: 'post',
                data: 'pigcms_id=' + id + '&uid=' + uid,
                success: function (re) {
                    if (re == 1) {
                        $(el).parent().html("<span class=\"label label-sm label-success\" onclick=\"audit(this,{pigcms{$vo.pigcms_id})\" > 绑定 </span>");
                    } else {
                        alert('解绑失败');
                    }
                }
            })
        }
    }


    function del(el,id) {
        if(confirm("确定要解绑吗？")) {
            $.ajax({
                url: "{pigcms{:U('pay_add_tenant_del')}",
                type: 'post',
                data: 'pigcms_id=' + id + '&uid=' + uid,
                success: function (re) {
                    if (re == 1) {
                        $(el).parent().html("<span class=\"label label-sm label-success\" onclick=\"bind(this,{pigcms{$vo.pigcms_id})\" > 绑定 </span>");
                    } else {
                        alert('解绑失败');
                    }
                }
            })
        }
    }

    function sea() {
        var search = $("#searchInput").val();
        // if (search !== '') {
            window.location.href = "{pigcms{:U('pay_add_tenant')}"+"&uid="+uid+"&search="+search;
        // }
    }

    $(window).keyup(function(event) {
        if(event.keyCode ==13){
            var search = $("#searchInput").val();
            window.location.href = "{pigcms{:U('pay_add_tenant')}"+"&uid="+uid+"&search="+search;
        }
    });

</script>
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>