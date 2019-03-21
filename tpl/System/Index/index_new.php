<layout name="layout"/>
<style type="text/css">
    .btn-icon-only {width:18px; height:18px;}
    .pd {padding:0; border:none;}
    .tq {width:100%; height:154px; background:url(/static/weather_img/xx1.jpg) no-repeat;}
    .btn:not(.btn-sm):not(.btn-lg) {line-height: 1.3;}
    a {
        text-shadow: none;
        color: #337ab7;
    }
    .easy-pie-chart .number {
        font-weight: 300;
        width: 75px;
        margin: 0 auto;
    }
    .tq2 {width:85%; padding-top:40px; margin:0px auto;}
    .tq3 {width:70%; float:left;}
    .tq4 {width:20%; float:right; padding-top:9px;}
    .cw1 {width:100%; height:50px; overflow:hidden; line-height:50px;}
    .cw2 {width:100%; height:20px; overflow:hidden; line-height:20px; color:#FFFFFF; font-size:16px;}
    .wz1 {width:80px; float:left; line-height:50px; color:#FFFFFF; font-family:Arial; font-weight:bold; font-size:30px;}
    .wz2 {width:70px; float:left; color:#FFFFFF; padding-top:5px; margin-left:2%;}
    .wz3 {width:100%; line-height:20px; overflow:hidden; color:#FFFFFF; font-size:12px;}
	
	@media screen and (min-width: 1390px) and (max-width:1510px)  { 
	  .widget-thumb .widget-thumb-body .widget-thumb-body-stat {
	 	 font-size:24px;
	  }
	}
	
	@media screen and (min-width: 1270px) and (max-width:1390px)  { 
	  .widget-thumb .widget-thumb-body .widget-thumb-body-stat {
	 	 font-size:24px;
	  }
	}


</style>
<!--<script src="/Car/Admin/Public/assets/global/plugins/echarts/echarts.js" type="text/javascript"></script>-->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <foreach name="top_list" item="vo">
                <div class="page-head">
                    <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1>{pigcms{$vo['name']} <span style="color:#9e9e9e; font-size:18px;">/ Project Profile</span>
                        </h1>
                    </div>
                    <!-- END PAGE TITLE -->
                    <!-- BEGIN PAGE TOOLBAR -->
                    <!--<div class="page-toolbar">
                        <div id="dashboard-report-range" data-display-range="0" class="pull-right tooltips btn btn-fit-height green" data-placement="left" data-original-title="Change dashboard date range">
                            <i class="icon-calendar"></i>&nbsp;
                            <span class="thin uppercase hidden-xs"></span>&nbsp;
                            <i class="fa fa-angle-down"></i>
                        </div>
                    </div>-->
                    <!-- END PAGE TOOLBAR -->
                </div>

                <!-- END PAGE BREADCRUMB -->
                <!-- BEGIN PAGE BASE CONTENT -->
                <!-- BEGIN DASHBOARD STATS 1-->
                <div class="row">
                    <foreach name="vo['list']" item="vo1">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 margin-bottom-10">
                            <div class="{pigcms{$vo1['class']}">
                                <div class="visual">
                                    <i class="{pigcms{$vo1['argument']['icon']}"></i>
                                </div>
                                <div class="details">
                                    <if condition="strpos($vo1['data'],'/')">
                                        <div class="number"><span data-counter="counterup" data-value="{pigcms{:explode('/',$vo1['data'])['0']}">0</span>/<span data-counter="counterup" data-value="{pigcms{:explode('/',$vo1['data'])['1']}">0</span><span style="font-size:16px; font-family:'微软雅黑';"> {pigcms{$vo1['unit']}</span> </div>
                                        <else/>
                                        <div class="number" data-counter="counterup" data-value="{pigcms{$vo1['data']}">0<span style="font-size:16px; font-family:'微软雅黑';"> {pigcms{$vo1['unit']}</span> </div>
                                    </if>
                                    <div class="desc"> {pigcms{$vo1['name']} </div>
                                </div>
                                <a class="more" href="{pigcms{:U($vo1['controller'].'/'.$vo1['action'])}"> 查看更多
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </foreach>
                <div class="clearfix"></div>
            </foreach>

            <volist name="menu_list" id="vo" key="k">
                <!--单独处理第一个循环变量宽度-->
                <if condition="$k eq 1">
                        <div class="col-lg-9 col-xs-12 col-sm-12">
                            <else/>
                            <div class="col-lg-6 col-xs-12 col-sm-12">
                </if>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">{pigcms{$vo['name']}</span>
                        </div>
                        <div class="col-md-2" style="float:right;">
                            <div class="page-toolbar">
                                <div id="{pigcms{$vo['id']}-range"  class="pull-right tooltips btn btn-fit-height green" data-placement="left" >
                                    <i class="icon-calendar"></i>&nbsp;
                                    <span style="display: none"></span>&nbsp;
                                    <i class="fa fa-angle-down"></i>
                                </div>
                                <div class="btn-group btn-theme-panel">
                                </div>
                            </div>
                        </div><div style="clear:both"></div>
                    </div>
                    <div class="portlet-body">
                    <if condition="$vo['argument']['map_type'] eq 1">
                        <!--模板 小方块 map_type1-->
                            <div class="row widget-row">
                                <foreach name="vo['list']" item="vo1">
                                    <div class="col-md-4">
                                    <!-- BEGIN WIDGET THUMB -->
                                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                                <h4 class="widget-thumb-heading">{pigcms{$vo1['name']}</h4>
                                                <div class="widget-thumb-wrap">
                                                    <i class="{pigcms{$vo1['argument']['icon']}"></i>
                                                    <div class="widget-thumb-body">
                                                        <span class="widget-thumb-subtitle">{pigcms{$vo1['unit']}</span>
                                                        <a class="more" style="text-decoration:none;" href="{pigcms{:U($vo1['controller'].'/'.$vo1['action'])}">
                                                        <span  class="widget-thumb-body-stat" id="{pigcms{$vo1['id']}" data-counter="counterup" data-value="0">0</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                    <!-- END WIDGET THUMB -->
                                    </div>
                                </foreach>
                            </div>
                        <elseif condition="$vo['argument']['map_type'] eq 2"/>
                            <!--模板 圆形百分图 map_type2-->
                            <div class="row">
                                <foreach name="vo['list']" item="vo1">
                                    <if condition="$vo1['argument']['type'] eq 1">
                                        <div class="col-md-4" style="margin-top:41px; margin-bottom:38px;">
                                            <div class="easy-pie-chart">
                                                <div class="{pigcms{$vo1['class']}" data-percent="100">
                                                    <span>{pigcms{$vo1['name']}</span></div>
                                                <a id="{pigcms{$vo1['id']}" class="title" href="{pigcms{:U($vo1['controller'].'/'.$vo1['action'])}"> ￥0元
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <else/>
                                        <div class="col-md-4" style="margin-top:41px;  margin-bottom:38px;">
                                            <div class="easy-pie-chart">
                                                <div id="{pigcms{$vo1['id']}" class="{pigcms{$vo1['class']}" data-percent="1">
                                                    <span>+0</span>% </div>
                                                <a class="title" href="{pigcms{:U($vo1['controller'].'/'.$vo1['action'])}"> {pigcms{$vo1['name']}
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </if>

                                    <div class="margin-bottom-10 visible-sm"> </div>
                                </foreach>
                            </div>
                        <elseif condition="$vo['argument']['map_type'] eq 3"/>
                        <!--模板 长条状图 map_type3-->
                        <div class="row">
                            <foreach name="vo['list']" item="vo1">
                                <div class="col-md-4">
                                    <div class="mt-widget-3">
                                <div class="{pigcms{$vo1['class']}">
                                    <div class="mt-head-icon">
                                        <i class="{pigcms{$vo1['argument']['icon']}"></i>
                                    </div>
                                    <div class="mt-head-desc" style="height:25px; overflow:hidden;"> <span style="font-size:18px;">{pigcms{$vo1['name']}</span> </div>
                                    <span class="mt-head-date" style="height:42px; overflow:hidden;"> <span id="{pigcms{$vo1['id']}-all" style="font-size:30px;">完成率:0%</span> </span>
                                    <div class="mt-head-button">
                                        <a href="{pigcms{:U($vo1['controller'].'/'.$vo1['action'])}">
                                            <button type="button" class="btn btn-circle btn-outline white btn-sm">详情</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="mt-body-actions-icons">
                                    <div class="btn-group btn-group btn-group-justified">
                                        <a href="javascript:;" class="btn ">
                                                            <span class="mt-icon">
                                                            </span><span id="{pigcms{$vo1['id']}-done" style="font-size:24px;">0</span><br/>已{pigcms{:mb_substr($vo1['name'],-2)} </a>
                                        <a href="javascript:;" class="btn ">
                                                            <span class="mt-icon">
                                                            </span><span id="{pigcms{$vo1['id']}-nodone" style="font-size:24px;">0</span><br/>未{pigcms{:mb_substr($vo1['name'],-2)} </a>
                                    </div>
                                </div>
                                    </div>
                                </div>
                            </foreach>
                        </div>
                        <elseif condition="$vo['argument']['map_type'] eq 4"/>
                        <!--模板 map_type4-->
                        <div class="row widget-row">
                            <foreach name="vo['list']" item="vo1">
                                <div class="col-md-6" style="margin-bottom:10px;">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20">
                                        <div class="widget-thumb-wrap">
                                            <i class="{pigcms{$vo1['argument']['icon']}" style="border-radius:50%;"></i>
                                            <a class="more" style="text-decoration:none;" href="{pigcms{:U($vo1['controller'].'/'.$vo1['action'])}">
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle">{pigcms{$vo1['name']}</span>
                                                <span class="widget-thumb-body-stat" id="{pigcms{$vo1['id']}" data-counter="counterup" data-value="0">0</span>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- END WIDGET THUMB -->
                                </div>
                            </foreach>
                        </div>
                        <elseif condition="$vo['argument']['map_type'] eq 5"/>
                        <!--模板 雷达图 map_type5-->
                        <div style="width:55%; float:left;">
                            <div id="{pigcms{$vo['id']}-chart" class="chart" style="height: 400px;width: 100%"> </div>
                        </div>
                        <div style="width:45%; float:right;">
                            <foreach name="vo['list']" item="vo1">
                                <div style="width:50%; float:left;">
                                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20">
                                        <div class="widget-thumb-wrap">
                                            <a class="more" style="text-decoration:none;" href="{pigcms{:U($vo1['controller'].'/'.$vo1['action'])}">
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-body-stat" id="{pigcms{$vo1['id']}" data-counter="counterup" data-value="0">0</span>
                                                <span class="widget-thumb-subtitle" style="height:20px; overflow:hidden;">{pigcms{$vo1['name']}</span>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </foreach>
                        </div>
                        <div style="clear:both"></div>
                        <elseif condition="$vo['argument']['map_type'] eq 6"/>
                        <!--模板 折线图 map_type6-->
                        <div id="{pigcms{$vo['id']}_content" class="display">
                            <div id="{pigcms{$vo['id']}_activities" style="height: 228px;"> </div>
                        </div>
                        <div style="margin: 20px 0 10px 30px">
                            <div class="row">
                                <foreach name="vo['list']" item="vo1">
                                    <div class="col-md-4 col-sm-3 col-xs-6 text-stat" style="margin-bottom:18px; margin-top:10px;">
                                        <span class="{pigcms{$vo1['class']}"> {pigcms{$vo1['name']} </span>
                                        <h3 id="{pigcms{$vo1['id']}">¥0</h3>
                                    </div>
                                </foreach>
                            </div>
                        </div>
                        <elseif condition="$vo['argument']['map_type'] eq 7"/>
                        <div id="{pigcms{$vo['id']}" class="chart" style="height: 400px;"> </div>
                    </if>
                    </div>
                </div>
            </div>
                    <if condition="$k eq 1">
                        <div class="col-lg-3 col-xs-12 col-sm-12">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-share font-red-sunglo hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">快捷入口</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <foreach name="quick_list['list']" item="vo1">
                                            <a href="{pigcms{:U($vo1['controller'].'/'.$vo1['action'])}" title="{pigcms{$vo1['name']}"><div class=" col-md-6 col-sm-4" style="margin-bottom:15px; height:20px; overflow:hidden;">
                                                    <div class="btn btn-circle btn-icon-only green pd">
                                                        <i class="{pigcms{$vo1['argument']['icon']}"></i>
                                                    </div> {pigcms{$vo1['name']}
                                                </div></a>
                                        </foreach>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                        <div class="col-lg-3 col-xs-12 col-sm-12">
                            <div class="tq">
                                <div class="tq2">
                                    <div class="tq3" style="width: 80%">
                                        <div class="cw1">
                                            <div id="weather_temp" class="wz1"></div>
                                            <div class="wz2" style="width: 100px;margin-left: 26%">
                                                <div id="weather_week" class="wz3"></div>
                                                <div id="weather_day" class="wz3"></div>
                                            </div>
                                        </div>
                                        <div class="cw2">湖北省武汉市 江汉区</div>
                                    </div>
                                    <div class="tq4"><img id="weather_img" style="width: 53px;height: 53px"></div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                        </div>
                    </if>

            </volist>
            <!-- END DASHBOARD STATS 1-->

            </div>
        </div>
        <!-- END CONTENT BODY -->
<!--[if lt IE 9]>
<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/excanvas.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/moment.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/daterangepicker.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/morris.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/raphael-min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.counterup.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/amcharts.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/serial.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/pie.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/radar.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/light.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/patterns.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/chalk.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/ammap.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/worldLow.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/amstock.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/fullcalendar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/horizontal-timeline.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.flot.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.vmap.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.vmap.world.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="./static/js/jquery-number.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/dashboard.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/charts-amcharts.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/quick-nav.min.js" type="text/javascript"></script>
<script src="https://cdn.bootcss.com/echarts/4.2.0-rc.1/echarts.min.js" type="text/javascript"></script>
<!--<script src="https://cdn.bootcss.com/easy-pie-chart/2.1.6/jquery.easypiechart.min.js" type="text/javascript"></script>
-->
<script>
    //更新天气
    $.ajax({
        url:"{pigcms{:U('Indexajax/ajax_get_weater')}",
        type:'post',
        dataType:'json',
        success:function (res) {
            $('#weather_temp').html(res['today']['temperature']+'°C');
            $('#weather_week').html(res['today']['week']);
            $('#weather_day').html(res['today']['date_y']);
            $('#weather_img').attr('src','./static/weather_img/day/'+res['today']['weather_id']['fa']+'.png');
        }
    })
</script>
<volist name="menu_list" id="vo" key="k">
    <script>
        $('#{pigcms{$vo['id']}-range').daterangepicker({
            "ranges": {
                '总计':['2016-08-12',moment()],
                '今天': [moment(), moment()],
                '昨天': [moment().subtract('days', 1), moment().subtract('days', 1)],
                '近7天': [moment().subtract('days', 6), moment()],
                '近30天': [moment().subtract('days', 29), moment()],
                '这个月': [moment().startOf('month'), moment().endOf('month')],
                '上个月': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
            },
            "locale": {
                "format": "YYYY-MM-DD",
                "separator": "至",
                "applyLabel": "确定",
                "cancelLabel": "取消",
                "fromLabel": "From",
                "toLabel": "至",
                "customRangeLabel": "自定义",
                /*"daysOfWeek": [
                    "星期一",
                    "星期二",
                    "星期三",
                    "星期四",
                    "星期五",
                    "星期六",
                    "星期日"
                ],*/
                "monthNames": [
                    "一月",
                    "二月",
                    "三月",
                    "四月",
                    "五月",
                    "六月",
                    "七月",
                    "八月",
                    "九月",
                    "十月",
                    "十一月",
                    "十二月"
                ],
                "firstDay": 1
            },
            "startDate": "2016-08-12",
            "endDate":moment() ,
            opens: (App.isRTL() ? 'right' : 'left'),
        }, function(start, end, label) {
            if ($('#{pigcms{$vo['id']}-range').attr('data-display-range') != '0') {
                $('#{pigcms{$vo['id']}-range span').html(start.format('YYYY-MM-DD') + '至' + end.format('YYYY-MM-DD'));
                change_{pigcms{$vo['id']}();
            }
        });
        if ($('#{pigcms{$vo['id']}-range').attr('data-display-range') != '0') {
            $('#{pigcms{$vo['id']}-range span').html('1971-01-01至' + moment().format('YYYY-MM-DD'));
        }
        $('#{pigcms{$vo['id']}-range').show();
    </script>
    <if condition="$vo['argument']['map_type'] eq 1">
        <script>
            function change_{pigcms{$vo['id']}() {
                var ids={pigcms{$vo['ids']};
                var time=$('#{pigcms{$vo['id']}-range span').html();
                $.ajax({
                    url:'{pigcms{$vo['argument']['ajax_url']|htmlspecialchars_decode}',
                    type:'post',
                    data:{'ids':ids,'time':time},
                    dataType:'json',
                    success:function (res) {
                        res.forEach(
                            function (item,index,arr) {
                                $('#'+item['id']).attr('data-value',$.number(item['data']));
                                $('#'+item['id']) .counterUp({delay:10,time:1e3});
                            }
                        );
                    }
                })
            };
                change_{pigcms{$vo['id']}();
        </script>
        <elseif condition="$vo['argument']['map_type'] eq 2"/>
        <script>
            function change_{pigcms{$vo['id']}() {
                var ids={pigcms{$vo['ids']};
                var time=$('#{pigcms{$vo['id']}-range span').html();
                $.ajax({
                    url:'{pigcms{$vo['argument']['ajax_url']|htmlspecialchars_decode}',
                    type:'post',
                    data:{'ids':ids,'time':time},
                    dataType:'json',
                    success:function (res) {
                        res.forEach(
                            function (item,index,arr) {
                                if(item['arguments']['type']==1){
                                    $('#'+item['id']).html('￥'+item['data']+'元');
                                }else{
                                    //$('#'+item['id']).attr('data-percent',Math.round(item['data']/100));
                                    $('#'+item['id']).data('easyPieChart').update(Math.round(item['data']*100)>100?100:Math.round(item['data']*100));
                                    /*$('#'+item['id']).attr('data-percent',item['data']);*/
                                    $('#'+item['id']).find('span').html(Math.round(item['data']*100)>100?100:Math.round(item['data']*100));
                                }
                            }
                        )
                    }
                })
            };
                change_{pigcms{$vo['id']}();
        </script>
        <elseif condition="$vo['argument']['map_type'] eq 3"/>
        <script>
            function change_{pigcms{$vo['id']}() {
                var ids={pigcms{$vo['ids']};
                var time=$('#{pigcms{$vo['id']}-range span').html();
                $.ajax({
                    url:'{pigcms{$vo['argument']['ajax_url']|htmlspecialchars_decode}',
                    type:'post',
                    data:{'ids':ids,'time':time},
                    dataType:'json',
                    success:function (res) {
                        res.forEach(
                            function (item,index,arr) {
                                var cache=""+item['data'];
                                var cache1=cache.split('-');
                                //var sum=parseInt(cache1['0'])+parseInt(cache1['1']);
                                var persent=cache1['0']/cache1['1'];
                                if(isNaN(persent)) persent=0;
                                //console.log(sum);
                                $('#'+item['id']+'-all').html('完成率:'+Math.round(persent*100)+'%');
                                $('#'+item['id']+'-done').html(Math.round(cache1['0']));
                                $('#'+item['id']+'-nodone').html(Math.round(cache1['1']-cache1['0']));
                            }
                        )
                    }
                })
            };
                change_{pigcms{$vo['id']}();
        </script>
        <elseif condition="$vo['argument']['map_type'] eq 4"/>
        <script>
            function change_{pigcms{$vo['id']}() {
                var ids={pigcms{$vo['ids']};
                var time=$('#{pigcms{$vo['id']}-range span').html();
                $.ajax({
                    url:'{pigcms{$vo['argument']['ajax_url']|htmlspecialchars_decode}',
                    type:'post',
                    data:{'ids':ids,'time':time},
                    dataType:'json',
                    success:function (res) {
                        res.forEach(
                            function (item,index,arr) {
                                $('#'+item['id']).attr('data-value',item['data']);
                                $('#'+item['id']) .counterUp({delay:10,time:1e3});
                            }
                        )
                    }
                })
            };
                change_{pigcms{$vo['id']}();
        </script>
        <elseif condition="$vo['argument']['map_type'] eq 5"/>
        <script>
            function change_{pigcms{$vo['id']}() {
                var ids={pigcms{$vo['ids']};
                var time=$('#{pigcms{$vo['id']}-range span').html();
                var max_num=0;
                $.ajax({
                    url:'{pigcms{$vo['argument']['ajax_url']|htmlspecialchars_decode}',
                    type:'post',
                    data:{'ids':ids,'time':time},
                    dataType:'json',
                    success:function (res) {
                        res.forEach(
                            function (item,index,arr) {
                                $('#'+item['id']).attr('data-value',item['data']);
                                $('#'+item['id']) .counterUp({delay:10,time:1e3});
                                if(item['data']>max_num) max_num=item['data'];
                            }
                        );
                        // 基于准备好的容器(这里的容器是id为chart1的div)，初始化echarts实例
                        var myChart = echarts.init(document.getElementById('{pigcms{$vo['id']}-chart'));
                        var indicator="[]";
                        indicator=eval('(' + indicator + ')');
                        var data_num=new Array();
                        res.forEach(
                            function (item,index,arr) {
                                var cache={'text':item['name'],'max':max_num}
                                indicator.push(cache);
                                data_num.push(item['data']);
                            }
                        );
                        var option = {
                            title : {
                                text: '{pigcms{$vo['name']}统计',
                                textStyle:{
                                    fontWeight:'normal',
                                    fontSize:'14',
                                    color:'#666'
                                },
                                x:'center',
                                y:'15'
                            },
                            tooltip : {
                                trigger: 'axis',
                                padding:10,
                                formatter:function(params){
                                    /*var data = '';
                                    $.each(params,function (index,item) {
                                        data += item.name+':'+item.value+'&nbsp;万元 '+ '<br/>';
                                    });
                                    return params[0].indicator+'<br/>'+data;*/
                                }
                            },
                            polar : [
                                {
                                    radius:95,   //半径
                                    center:['50%','50%'], // 图的位置
                                    name:{
                                        // show: true, // 是否文字
                                        // formatter: null, // 文字的显示形式
                                        textStyle: {
                                            color:'#999'   // 文字颜色
                                        }
                                    },
                                    indicator : indicator,
                                    splitArea : {
                                        show : true,
                                        areaStyle : {
                                            color: ["#f8f8f8","#e9e9e9"]  // 图表背景网格区域的颜色
                                        }
                                    },
                                    splitLine : {
                                        show : true,
                                        lineStyle : {
                                            width : 1,
                                            color : '#dbdbdb' // 图表背景网格线的颜色
                                        }
                                    }
                                }
                            ],
                            calculable : true,
                            series : [
                                {
                                    name: '',
                                    type: 'radar',
                                    symbol:'emptyCircle',  /*曲线圆点*/
                                    symbolSize:4,
                                    data : [
                                        {
                                            value: data_num,
                                            name: '模拟站',
                                            totalNumber: 1000,
                                            itemStyle: {
                                                normal: {
                                                    color: "#f4bc65"   // 图表中各个图区域的边框线颜色
                                                }
                                            }
                                        }
                                    ]
                                }
                            ]
                        };

                        // 使用刚指定的配置项和数据显示图表
                        myChart.setOption(option);
                    }
                })

            };
                change_{pigcms{$vo['id']}();
        </script>
        <elseif condition="$vo['argument']['map_type'] eq 6"/>
        <script>
            function change_{pigcms{$vo['id']}() {
                var ids={pigcms{$vo['ids']};
                var time=$('#{pigcms{$vo['id']}-range span').html();
                $.ajax({
                    url:'{pigcms{$vo['argument']['ajax_url']|htmlspecialchars_decode}',
                    type:'post',
                    data:{'ids':ids,'time':time},
                    dataType:'json',
                    success:function (res) {
                        var chartData = res['map'];
                        var echo=res['echo'];
                        echo.forEach(
                            function (item,index,arr) {
                                if(item['data']){
                                    $('#'+item['id']).html($.number(item['data'],2));
                                }
                            }
                        );
                        console.log(chartData);
                            //AmSerialChart 类
                        var chart = AmCharts.makeChart("{pigcms{$vo['id']}_activities", {
                            "type": "serial",
                            "theme":"light",
                            "dataProvider": chartData,
                            "categoryField": "date",
                            "categoryAxis": {
                                "autoGridCount": false,
                                "gridCount": chartData.length,
                                "gridPosition": "start",
                                "gridAlpha": 0,
                                "categoryAxisColor":"#123456",
                            },
                            toolbox: {
                                //显示策略，可选为：true（显示） | false（隐藏），默认值为false
                                show: true,
                                //启用功能，目前支持feature，工具箱自定义功能回调处理
                                feature: {
                                    //辅助线标志
                                    mark: {show: true},
                                    //dataZoom，框选区域缩放，自动与存在的dataZoom控件同步，分别是启用，缩放后退
                                    dataZoom: {
                                        show: true,
                                        title: {
                                            dataZoom: '区域缩放',
                                            dataZoomReset: '区域缩放后退'
                                        }
                                    },
                                    //数据视图，打开数据视图，可设置更多属性,readOnly 默认数据视图为只读(即值为true)，可指定readOnly为false打开编辑功能
                                    dataView: {show: true, readOnly: true},
                                    //magicType，动态类型切换，支持直角系下的折线图、柱状图、堆积、平铺转换
                                    magicType: {show: true, type: ['line', 'bar']},
                                    //restore，还原，复位原始图表
                                    restore: {show: true},
                                    //saveAsImage，保存图片（IE8-不支持）,图片类型默认为'png'
                                    saveAsImage: {show: true}
                                }
                            },
                            "gridAboveGraphs": true,
                            "startDuration": 1,
                            "valueAxes": [{
                                "id":"income",
                                "axisAlpha": 0,
                                "position": "left",
                                "title": "元"
                            }],
                            "balloon": {
                                "borderThickness": 1,
                                "shadowAlpha": 0
                            },

                            "graphs": [ {
                                "fillAlphas": 0.2,
                                "bullet": "round",
                                "bulletBorderAlpha": 1,
                                "bulletColor": "#36C6D3",
                                "lineColor":"#36C6D3",
                                "bulletSize": 5,
                                "hideBulletsCount": 50,
                                "lineThickness": 2,
                                "title": "red line",
                                "useLineColorForBulletBorder": true,
                                "valueField": "visits",
                                "balloonText": "<span style='font-size:18px;'>[[category]]支出[[value]]元</span>",
                                "valueAxis": "three"
                            }/*,{
                             "fillAlphas": 0.2,
                             "bullet": "round",
                             "lineThickness": 2,
                             "bulletColor": "#ED6B75",
                             "lineColor":"#ED6B75",
                             "valueField": "true_income",
                             "balloonText": "<span style='font-size:18px;'>[[value]]</span>",
                             "valueAxis": "income"
                             }*/
                            ],
                            "chartCursor": {
                                "valueLineEnabled": true,
                                "valueLineBalloonEnabled": true,
                                "cursorAlpha": 0,
                                "zoomable": false,
                                "valueZoomable": true,
                                "valueLineAlpha": 0.5
                            },

                        } );
                            /*chart.dataProvider = chartData;     //指定数据源
                            chart.categoryField = "country";    //数据的分类*/

                            //创建
                            /*var graph = new AmCharts.AmGraph();
                            graph.valueField = "visits";    //数值字段名称
                            graph.type = "column";          //列名称
                            graph.type = "line";
                            graph.fillAlphas = 0.5;
                            chart.addGraph(graph);*/
                            //chart.write(document.getElementById("{pigcms{$vo['id']}_activities")); //write 到 div 中
                    }
                })
            };
                change_{pigcms{$vo['id']}();
        </script>
        <elseif condition="$vo['argument']['map_type'] eq 7"/>
        <script>
            function change_{pigcms{$vo['id']}() {
                var ids={pigcms{$vo['ids']};
                var time=$('#{pigcms{$vo['id']}-range span').html();
                $.ajax({
                    url:'{pigcms{$vo['argument']['ajax_url']|htmlspecialchars_decode}',
                    type:'post',
                    data:{'ids':ids,'time':time},
                    dataType:'json',
                    success:function (res) {
                        res.forEach(
                            function (item,index,arr) {
                                $('#'+item['id']).html(item['data']);
                            }
                        );
                        //AmSerialChart 类
                        var e = AmCharts.makeChart("{pigcms{$vo['id']}", {
                            type: "serial",
                            theme: "light",
                            fontFamily: "Open Sans",
                            color: "#888888",
                            legend: {
                                equalWidths: !1,
                                useGraphSettings: !0,
                                valueAlign: "left",
                                valueWidth: 120
                            },
                            dataProvider: [{
                                date: "2012-01-01",
                                distance: 227,
                                townName: "New York",
                                townName2: "New York",
                                townSize: 25,
                                latitude: 40.71,
                                duration: 408
                            }, {
                                date: "2012-01-02",
                                distance: 371,
                                townName: "Washington",
                                townSize: 14,
                                latitude: 38.89,
                                duration: 482
                            }, {
                                date: "2012-01-03",
                                distance: 433,
                                townName: "Wilmington",
                                townSize: 6,
                                latitude: 34.22,
                                duration: 562
                            }, {
                                date: "2012-01-04",
                                distance: 345,
                                townName: "Jacksonville",
                                townSize: 7,
                                latitude: 30.35,
                                duration: 379
                            }, {
                                date: "2012-01-05",
                                distance: 480,
                                townName: "Miami",
                                townName2: "Miami",
                                townSize: 10,
                                latitude: 25.83,
                                duration: 501
                            }, {
                                date: "2012-01-06",
                                distance: 386,
                                townName: "Tallahassee",
                                townSize: 7,
                                latitude: 30.46,
                                duration: 443
                            }, {
                                date: "2012-01-07",
                                distance: 348,
                                townName: "New Orleans",
                                townSize: 10,
                                latitude: 29.94,
                                duration: 405
                            }, {
                                date: "2012-01-08",
                                distance: 238,
                                townName: "Houston",
                                townName2: "Houston",
                                townSize: 16,
                                latitude: 29.76,
                                duration: 309
                            }, {
                                date: "2012-01-09",
                                distance: 218,
                                townName: "Dalas",
                                townSize: 17,
                                latitude: 32.8,
                                duration: 287
                            }, {
                                date: "2012-01-10",
                                distance: 349,
                                townName: "Oklahoma City",
                                townSize: 11,
                                latitude: 35.49,
                                duration: 485
                            }, {
                                date: "2012-01-11",
                                distance: 603,
                                townName: "Kansas City",
                                townSize: 10,
                                latitude: 39.1,
                                duration: 890
                            }, {
                                date: "2012-01-12",
                                distance: 534,
                                townName: "Denver",
                                townName2: "Denver",
                                townSize: 18,
                                latitude: 39.74,
                                duration: 810
                            }, {
                                date: "2012-01-13",
                                townName: "Salt Lake City",
                                townSize: 12,
                                distance: 425,
                                duration: 670,
                                latitude: 40.75,
                                dashLength: 8,
                                alpha: .4
                            }, {
                                date: "2012-01-14",
                                latitude: 36.1,
                                duration: 470,
                                townName: "Las Vegas",
                                townName2: "Las Vegas"
                            }, {
                                date: "2012-01-15"
                            }, {
                                date: "2012-01-16"
                            }, {
                                date: "2012-01-17"
                            }, {
                                date: "2012-01-18"
                            }, {
                                date: "2012-01-19"
                            }],
                            valueAxes: [{
                                id: "distanceAxis",
                                axisAlpha: 0,
                                gridAlpha: 0,
                                position: "left",
                                title: "distance"
                            }, {
                                id: "latitudeAxis",
                                axisAlpha: 0,
                                gridAlpha: 0,
                                labelsEnabled: !1,
                                position: "right"
                            }, {
                                id: "durationAxis",
                                duration: "mm",
                                durationUnits: {
                                    hh: "h ",
                                    mm: "min"
                                },
                                axisAlpha: 0,
                                gridAlpha: 0,
                                inside: !0,
                                position: "right",
                                title: "duration"
                            }],
                            graphs: [{
                                alphaField: "alpha",
                                balloonText: "[[value]] miles",
                                dashLengthField: "dashLength",
                                fillAlphas: .7,
                                legendPeriodValueText: "total: [[value.sum]] mi",
                                legendValueText: "[[value]] mi",
                                title: "distance",
                                type: "column",
                                valueField: "distance",
                                valueAxis: "distanceAxis"
                            }, {
                                balloonText: "latitude:[[value]]",
                                bullet: "round",
                                bulletBorderAlpha: 1,
                                useLineColorForBulletBorder: !0,
                                bulletColor: "#FFFFFF",
                                bulletSizeField: "townSize",
                                dashLengthField: "dashLength",
                                descriptionField: "townName",
                                labelPosition: "right",
                                labelText: "[[townName2]]",
                                legendValueText: "[[description]]/[[value]]",
                                title: "latitude/city",
                                fillAlphas: 0,
                                valueField: "latitude",
                                valueAxis: "latitudeAxis"
                            }, {
                                bullet: "square",
                                bulletBorderAlpha: 1,
                                bulletBorderThickness: 1,
                                dashLengthField: "dashLength",
                                legendValueText: "[[value]]",
                                title: "duration",
                                fillAlphas: 0,
                                valueField: "duration",
                                valueAxis: "durationAxis"
                            }],
                            chartCursor: {
                                categoryBalloonDateFormat: "DD",
                                cursorAlpha: .1,
                                cursorColor: "#000000",
                                fullWidth: !0,
                                valueBalloonsEnabled: !1,
                                zoomable: !1
                            },
                            dataDateFormat: "YYYY-MM-DD",
                            categoryField: "date",
                            categoryAxis: {
                                dateFormats: [{
                                    period: "DD",
                                    format: "DD"
                                }, {
                                    period: "WW",
                                    format: "MMM DD"
                                }, {
                                    period: "MM",
                                    format: "MMM"
                                }, {
                                    period: "YYYY",
                                    format: "YYYY"
                                }],
                                parseDates: !0,
                                autoGridCount: !1,
                                axisColor: "#555555",
                                gridAlpha: .1,
                                gridColor: "#FFFFFF",
                                gridCount: 50
                            },
                            exportConfig: {
                                menuBottom: "20px",
                                menuRight: "22px",
                                menuItems: [{
                                    icon: App.getGlobalPluginsPath() + "amcharts/amcharts/images/export.png",
                                    format: "png"
                                }]
                            }
                        });
                        /*$("#{pigcms{$vo['id']}").closest(".portlet").find(".fullscreen").click(function () {
                            e.invalidateSize()
                        })*/
                        /*chart.dataProvider = chartData;     //指定数据源
                         chart.categoryField = "country";    //数据的分类*/

                        //创建
                        /*var graph = new AmCharts.AmGraph();
                         graph.valueField = "visits";    //数值字段名称
                         graph.type = "column";          //列名称
                         graph.type = "line";
                         graph.fillAlphas = 0.5;
                         chart.addGraph(graph);*/
                        //chart.write(document.getElementById("{pigcms{$vo['id']}_activities")); //write 到 div 中
                    }
                })
            };
                change_{pigcms{$vo['id']}();
        </script>
    </if>
</volist>
</body>