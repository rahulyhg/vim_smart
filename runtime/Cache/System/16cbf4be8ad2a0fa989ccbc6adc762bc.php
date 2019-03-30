<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <!--头部文件-->
    <meta charset="utf-8" />
<title id="span_title"><?php echo ($title?$title:"物业综合服务平台"); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="X-UA-Compatible" content="IE=9">
<meta content="Preview page of Metronic Admin Theme #4 for " name="description" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="" name="author" />

<link rel="shortcut icon" href="favicon.ico" />

<link href="/Car/Admin/Public/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

<script src="/Car/Admin/Public/assets/global/plugins/mapplic/js/html5shiv.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="http://libs.baidu.com/jquery/1.10.2/jquery.js"></script>
<![endif]-->


<link href="/Car/Admin/Public/assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href="/Car/Admin/Public/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="/Car/Admin/Public/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/css/jquery.autocompleter.css" rel="stylesheet" type="text/css" />

<link href="/Car/Admin/Public/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="/Car/Admin/Public/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />




<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://www.hdhsmart.com/Car/Admin/Public/css/jquery.datetimepicker.css">




<style type="text/css">
    <!--
    .ggt:link{color:#FFFFFF; text-decoration:none;}
    .ggt:visited{color:#FFFFFF; text-decoration:none;}
    .ggt:active{color:#FFFFFF; text-decoration:none;}
    .ggt:hover{color:#FFFFFF; text-decoration:none;}

    @media screen and (min-width: 769px) {

        .index_left_nav2{display:none;}
    }
    @media screen and (max-width: 768px) {

        .index_left_nav{display:none;}
    }
    .btn.red-haze:not(.btn-outline).active, .btn.red-haze:not(.btn-outline):active, .btn.red-haze:not(.btn-outline):hover, .open>.btn.red-haze:not(.btn-outline).dropdown-toggle {
        color: #fff;
        background-color: #f36a5a;
        border-color: #f36a5a;
    }

    .nav.pull-right>li>.dropdown-menu, .nav>li>.dropdown-menu.pull-right {
        right: 50px;
        left: auto;
    }
    .nav.pull-right>li>.dropdown-menu, .nav>li>.dropdown-menu.pull-right{
        right: 50px;
        left: auto;
    }
    [v-cloak] {
        display: none;
    }
</style>
<style type="text/css">
    <!--
    .dropdown-menu {margin: 0 0 0 -125px;}
    -->
    .label-kid {
        background-color: #f36a5a;
    }
    .btn-group>.dropdown-menu, .dropdown-toggle>.dropdown-menu, .dropdown>.dropdown-menu {
        margin-top: 10px;
    }
    .dropdown-menu {
        margin: 0 0 0 -125px;
    }
    /*.dropdown-menu:last-child{
        position: relative!important;
    }*/
    .dropdown-menu:last-of-type {
        position: relative!important;
    }
</style>
<script>
    var app = {};
    app.root             = "__ROOT__";
    app.app              = "__APP__";
    app.app_dir         = "<?php echo APP_PATH;?>"
    app.group_name      = "<?php echo GROUP_NAME;?>";
    app.controller_name      = "<?php echo MODULE_NAME;?>";
    app.action_name      = "<?php echo ACTION_NAME;?>";
    app.url_model        = <?php echo C('URL_MODEL');?>;
</script>
<script src="./static/js/system-main.js"></script>
    <!--/头部文件-->
    
</head>


<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">



<div class="page-container">

    <div class="page-sidebar-wrapper">

    <div class="page-sidebar navbar-collapse collapse">

        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

            <li class="nav-item start active open">
                <a href="http://www.hdhsmart.com/admin.php?g=System&c=Index&a=index_new" class="nav-link nav-toggle" id="span_a">
                    <i class="icon-home"></i>
                    <!-- <span class="title"><img src="" class="logo-default" id="span_pic"></span> -->
                    <span class="title" id="span_text"></span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
            </li>

            <!--***************************************************************停车系统开始************************************************-->

            <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="heading">
                    <h3 class="uppercase"><?php echo ($vo["name"]); ?></h3>
                </li>
                <?php if(is_array($vo['child_list'])): $i = 0; $__LIST__ = $vo['child_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sv): $mod = ($i % 2 );++$i;?><li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="<?php echo ($sv["icon"]); ?>"></i>
                            <span class="title"><?php echo ($sv["name"]); ?></span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <?php if(is_array($sv['child_list'])): $i = 0; $__LIST__ = $sv['child_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li class="nav-item  ">
                                    <?php if($voo['name'] == '系统警告配置' or $voo['name'] == '警告信息列表'): ?><a href="<?php echo ($voo["url"]); ?>" class="nav-link ">
                                            <span class="title"><?php echo ($voo["name"]); ?></span>
                                        </a>
                                        <?php else: ?>
                                        <a href="<?php echo ($voo["url"]); ?>_news" class="nav-link ">
                                            <span class="title"><?php echo ($voo["name"]); ?></span>
                                        </a><?php endif; ?>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </li><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
            <!-- 根据url自动选择相应的选项卡-->
            <script src="/Car/Admin/Public/js/jquery.js" type="text/javascript"></script>
            <script>
                function menu_select(url){
                    $('.sub-menu li a').each(function(){
                        if($($(this))[0].href.indexOf(url)>-1){
                            $(this).parent().addClass('open');
                            $(this).parent().parent().parent().addClass('open');
                            $(this).parent().parent().parent().find(".sub-menu").show();
                        }
                    });
                };
                $(function(){
                    var lastUrl = document.referrer;
                    $('.sub-menu li a').each(function(){
                        if($($(this))[0].href==String(window.location)){
                            $(this).parent().addClass('open');
                            $(this).parent().parent().parent().addClass('open');
                            $(this).parent().parent().parent().find(".sub-menu").show();
                        }else if(lastUrl == $($(this))[0].href){
                            $(this).parent().addClass('open');
                            $(this).parent().parent().parent().addClass('open');
                            $(this).parent().parent().parent().find(".sub-menu").show();
                        }
                    });


                });
            </script>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
    <!--主体-->
    <div class="page-content-wrapper" id="main">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1><?php $breadcrumb = $breadcrumb_diy?:$breadcrumb; echo $breadcrumb[count($breadcrumb)-1][0]; ?>
                    </h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <?php if(is_array($breadcrumb)): $k = 0; $__LIST__ = $breadcrumb;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($k % 2 );++$k; if($k==(count($breadcrumb))){ ?>
                        <li>
                            <span class="active"><?php echo ($row[0]); ?></span>
                        </li>

                    <?php  }else{ ?>

                        <li>
                            <a href="<?php echo ($row[1]); ?>"><?php echo ($row[0]); ?></a>
                            <i class="fa fa-circle"></i>
                        </li>

                    <?php  } endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="row">

                    <div class="col-md-12" style="float: left">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet light portlet-fit portlet-form bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class=" icon-layers font-green"></i>
                                    <span class="caption-subject font-green sbold uppercase"><?php echo ($breadcrumb[count($breadcrumb)-1][0]); ?></span>
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
                                    
    <div class="btn-group">
        <a href="<?php echo U('qrcode_preview',array('type'=>'shuidian'));?>">
            <button id="sample_editable_1_new" class="btn sbold green">水电表全部打印
                <i class="fa fa-plus"></i>
            </button>
        </a>
        <a href="<?php echo U('qrcode_preview');?>">
            <button id="sample_editable_1_new" class="btn sbold green">巡更码全部打印
                <i class="fa fa-plus"></i>
            </button>
        </a>
        <a href="<?php echo U('qrcode_preview',array('type'=>'zhuanyeshebei'));?>">
            <button id="sample_editable_1_new" class="btn sbold green">专业设备全部打印
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <div>
        <form action="<?php echo U('qrcode_preview_select');?>" method="post" enctype="multipart/form-data">
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">文件模板
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <a href="http://www.hdhsmart.com/upload/example/水电表巡更查询格式表.xls" download="水电表巡更查询格式表.xls">
                        下载
                    </a>
                </div>
            </div>

            <!--<div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">选择社区
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <select name="village_id" class="form-control">
                        <?php if(is_array($village_list)): foreach($village_list as $key=>$row): ?><option value="<?php echo ($key); ?>"><?php echo ($row); ?></option><?php endforeach; endif; ?>
                    </select>
                </div>
            </div>-->
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">选择打印标签种类
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <select name="type" class="form-control">
                            <option value="shuidian">水电</option>
                            <option value="">巡更码</option>
                            <option value="zhuanyeshebei">专业设备</option>
                    </select>
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">导入文件
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <input type="file" class="form-control" name="test">
                </div>
            </div>

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <button type="submit" class="btn green">确认提交</button>
                        <button type="button" class="btn default" onclick="app.redirect('meterlist_news')">返 回</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


                                </div>
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>

            </div>

        </div>
    </div>
    <!-- /主体-->
</div>
<!--底部文件-->
<div class="page-footer">
    <div class="page-footer-inner"> 2017 &copy; 智慧助手系统
        <a target="_blank" href="http://www.vhi99.com">邻钱科技</a>
        <!--      &nbsp;|&nbsp;   <a href="http://www.metronic.com" target="_blank">Metronic</a>-->
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

<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--插入layer弹层js开始-->
<script src="/Car/Admin/Public/js/layer.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/sweetalert.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/ui-sweetalert.min.js" type="text/javascript"></script>

<script src="http://www.bootcss.com/p/underscore/underscore-min.js"></script>
<script src="<?php echo ($static_public); ?>kindeditor/kindeditor.js"></script>
<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script src="./static/js/vue-resource.min.js"></script>
<script src="./static/js/vuex.js"></script>
<script src="./static/js/ui-buttons.js"></script>

<script type="text/javascript">
    //表格显示控制js代码区
    var table = $('#sample_1');

    // begin first table
    var jstr = '<?php echo ($table_sort); ?>';
    var table_sort;
    if(jstr){
        table_sort = JSON.parse(jstr);
    }else{
        table_sort = [1, "desc"];
    }
    table.dataTable({

        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
        "language": {
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            "emptyTable": "No data available in table",
            "info": "当前显示 _START_ 到 _END_ ​条记录 共 _TOTAL_ ​条记录",
            "infoEmpty": "No records found",
            "infoFiltered": "(filtered1 from _MAX_ total records)",
            "lengthMenu": "每页显示条数 _MENU_",
            "search": "搜索:",
            "zeroRecords": "No matching records found",
            "paginate": {
                "previous":"Prev",
                "next": "Next",
                "last": "Last",
                "first": "First"
            }
        },
        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

        "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "全部"] // change per page values here
        ],
        // set the initial value
        "pageLength": parseInt("<?php echo ($table_init_length); ?>")||15,
        "pagingType": "bootstrap_full_number",
        "columnDefs": [
            {  // set default column settings
                'orderable': false,
                'targets': [0]
            },
            {
                "className": "dt-right",
                //"targets": [2]
            }
        ],
        "order": [
            table_sort
        ] // set first column as a default sort by asc
    });

    var tableWrapper = jQuery('#sample_1_wrapper');

    table.find('.group-checkable').change(function () {
        var set = jQuery(this).attr("data-set");
        var checked = jQuery(this).is(":checked");
        jQuery(set).each(function () {
            if (checked) {
                $(this).prop("checked", true);
                $(this).parents('tr').addClass("active");
            } else {
                $(this).prop("checked", false);
                $(this).parents('tr').removeClass("active");
            }
        });
    });

    table.on('change', 'tbody tr .checkboxes', function () {
        $(this).parents('tr').toggleClass("active");
    });

</script>
<script>
    /**
     * vue全局注册函数
     */
    //get
    Vue.prototype._get =  function(url,params,callback){
        var opt = {
            'params':params
        }
        this.$http.get(url,opt).then(function(response){
            // 响应成功回调
            if(response.body.err==0){
                callback(response.body);
            }else{
                console.log(response.body);
                alert("发生错误");
            }
        }, function(response){
            alert(response.status+" 发生错误");
        });

    };
    //post
    Vue.prototype._post = function(url,params,callback){
            this.$http.post(url,params).then(function(response){
                // 响应成功回调
                if(response.body.err==0){
                    callback(response.body);
                }else{
                    alert("发生错误:"+response.body.msg);
                }
            }, function(response){
                alert(response.status+" 发生错误");
            });

        };
    //判断是否是数组
    function isArray(o){
        return Object.prototype.toString.call(o)=='[object Array]';
    }
    //补0函数
    function padNumber(num, fill) {
        //改自：http://blog.csdn.net/aimingoo/article/details/4492592
        var len = ('' + num).length;
        return (Array(
            fill > len ? fill - len + 1 || 0 : 0
        ).join(0) + num);
    }
    //改变群发控制状态
    function change_wxmsg(village_id){
        $.ajax({
            url:"<?php echo U('ajax_change_wxmsg');?>",
            type:'post',
            data:{'village_id':village_id},
            dataType:'json',
            async:false,
            success:function(res){

            }
        });
    }
        $("[name='my-checkbox']").bootstrapSwitch({
            onText:"已启动",
            offText:"已关闭",
            onColor:"success",
            offColor:"danger",
            size:"normal",
            handleWidth:'100px',
            labelWidth:'55px',
            state:Boolean(<?php echo ($is_wxmsg); ?>),
            onSwitchChange:function(event,state){
                change_wxmsg('<?php echo ($village_id); ?>');
            }
        });
</script>
<!--自定义js代码区开始-->


<script>
    window.onload=function(){       
        // var url = window.location.href;
        // var str = url.substr(url.lastIndexOf('system='),);
        // var num = str.substr(str.lastIndexOf('=')+1,);
        // var num = <?php echo ($_SESSION['system_id']); ?>;
        var num = document.getElementById("system_id").value;
        var href1 = document.getElementById("logo_a").href;
        var href2 = document.getElementById("span_a").href;
/*        var href3 = document.getElementById("child_a").href;
*/
        var logo_a = href1+'&system='+num;
        var span_a = href2+'&system='+num;
/*        var child_a = href3+'&system='+num;
*/
        console.log(num);
        if(/^\d+$/.test(num)){
            console.log(1);
            // pic.src="/Car/Admin/Public/assets/pages/img/login/vlg"+num+".jpg";  /^\d+$/.test(num)
            // document.getElementById("span_title").innerText="邻钱快递收发管理系统"; 
            if (num == 1) {
                document.getElementById("span_title").innerText="邻钱快递收发管理系统";
                document.getElementById("logo_text").innerText="邻钱快递收发管理系统";
                document.getElementById("span_text").innerText="邻钱快递收发管理系统";                               
            } else if(num == 2) {
                document.getElementById("span_title").innerText="邻钱在线考试管理系统";
                document.getElementById("logo_text").innerText="邻钱在线考试管理系统";
                document.getElementById("span_text").innerText="邻钱在线考试管理系统";
            } else if(num == 3) {
                document.getElementById("span_title").innerText="邻钱设施设备管理系统";
                document.getElementById("logo_text").innerText="邻钱设施设备管理系统";
                document.getElementById("span_text").innerText="邻钱设施设备管理系统";
            } else if(num == 4) {
                document.getElementById("span_title").innerText="邻钱固定资产管理系统";
                document.getElementById("logo_text").innerText="邻钱固定资产管理系统";
                document.getElementById("span_text").innerText="邻钱固定资产管理系统";
            } else if(num == 5) {
                document.getElementById("span_title").innerText="邻钱在线抄表管理系统";
                document.getElementById("logo_text").innerText="邻钱在线抄表管理系统";
                document.getElementById("span_text").innerText="邻钱在线抄表管理系统";
            } else if(num == 6) {
                document.getElementById("span_title").innerText="邻钱在线巡更管理系统";
                document.getElementById("logo_text").innerText="邻钱在线巡更管理系统";
                document.getElementById("span_text").innerText="邻钱在线巡更管理系统";
            }
            $('#logo_a').attr('href',logo_a);
            $('#span_a').attr('href',span_a);
/*            $('#child_a').attr('href',child_a);
*/
        }else{
            console.log(2);
            // pic.src="/Car/Admin/Public/assets/pages/img/login/vlg.jpg";
            document.getElementById("span_title").innerText="物业平台";
            document.getElementById("logo_text").innerText="物业平台";
            document.getElementById("span_text").innerText="物业平台";
        }

    };
</script>

<!--/底部文件-->




<!--自定义js代码区结束-->
</body>

</html>