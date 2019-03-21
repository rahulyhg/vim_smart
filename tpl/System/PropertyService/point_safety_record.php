<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<!--头部设置-->
<?php
$title = array(
    'title'=>'巡检管理',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('巡检管理','#'),
);

?>
<!--头部设置结束-->
<include file="Public_news:header"/>

<!--<if condition="$admin eq 1">-->
<!--    <div class="btn-group">-->
<!--        <a class="btn green-haze btn-outline sbold uppercase" href="javascript:;" data-toggle="dropdown">-->
<!--            <i class="fa fa-building"></i> 当前:{pigcms{$presentVillage}-->
<!--            <i class="fa fa-angle-down"></i>-->
<!--        </a>-->
<!--        <ul class="dropdown-menu">-->
<!--            <li>-->
<!--                <a href="{pigcms{:U('')}">-->
<!--                    <i class="fa fa-building-o"></i> 全部显示 </a>-->
<!--            </li>-->
<!--            <foreach name="villageArray" item="vo">-->
<!--                <li>-->
<!--                    <a href="__SELF__&village_id={pigcms{$vo.village_id}">-->
<!--                        <i class="fa fa-building-o"></i> {pigcms{$vo.village_name} </a>-->
<!--                </li>-->
<!--            </foreach>-->
<!--        </ul>-->
<!--    </div>-->
<!--    <else/>-->
<!--    <div class="btn-group">-->
<!--        <a class="btn green-haze btn-outline sbold uppercase" href="javascript:;">-->
<!--            <i class="fa fa-building"></i> 当前:{pigcms{$presentVillage}-->
<!--        </a>-->
<!--    </div>-->
<!--</if>-->
<br/>
<br/>
<!--业务区-->
<div class="table-toolbar">
    <div class="row">
        <div class="col-md-6">
            <!--<div class="btn-group">
                <a href="{pigcms{:U('PropertyService/room_list')}">
                    <button id="sample_editable_1_new" class="btn sbold green">楼层管理
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>-->

            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/point_safety_list',array('is_del'=>0))}">
                    <button id="sample_editable_1_new" class="btn sbold green">巡检点管理
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>
            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/products_custom_list')}">
                    <button id="sample_editable_1_new" class="btn sbold green">二维码管理
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>

    <br/>
    <br/>

    <div class="input-group input-large date-picker input-daterange">
        <input type="text" class="form-control" name="check_time_from" id="check_time_from" style="width: 120px;" value="<php>echo $_GET['check_time']?:'年-月'</php>">
        <!-- <span class="input-group-addon"> to </span>
        <input type="text" class="form-control" name="check_time_from" id="check_time_from" style="width: 120px;" value="<php>echo $_GET['check_time_to']?:date('Y-m')</php>"> -->
    </div>
    <br/>
    <if condition="$_GET['point_status'] eq '' and $_GET['check_time'] neq ''">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    总巡检点数量：<span style="color: blue"> {pigcms{$pointCount}</span> 个，已巡检点数量：<span style="color: green"> {pigcms{$nowPointCount}</span> 个, 未巡检点数量：<a href="{pigcms{:U('no_check_point',array('work_time'=>$_GET['work_time']?:'','d_time'=>$_GET['d_time']?:''))}"> {pigcms{$lowPointCount}</a> 个。
                </div>
            </div>
        </div>
    </if>
</div>



<div id="shopList" class="grid-view">
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
            <th width="10%">编号</th>
            <th width="10%">楼层</th>
            <th width="10%">消防点</th>
            <th width="15%">所属社区</th>
            <th width="15%">巡检人</th>
            <th width="10%">巡检时间</th>
            <th width="10%">状态</th>
            <th class="button-column" width="20%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="pointRecord" id="vo">
                <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                <td><div class="tagDiv">{pigcms{$vo.pigcms_id}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.room_name}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.orientation}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.village_name}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.name}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.check_time|date='Y-m-d H:i:s',###}</div></td>
                <if condition="$vo['point_status'][0] eq 'status_1-0' and $vo['point_status'][1] eq 'status_2-0' and $vo['point_status'][2] eq 'status_3-0' and $vo['point_status'][3] eq 'status_4-0' and $vo['point_status'][4] eq 'status_5-0'">
                    <td><div class="tagDiv" style="color: green">正常</div></td>
                <else/>
                    <td><div class="tagDiv" style="color: red">异常</div></td>
                </if>
                <td class="button-column">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">
                            <li>
                                <a href="{pigcms{:U('point_safety_detail',array('id'=>$vo['pigcms_id']))}"
                                   data-toggle="modal"
                                   data-target="#modal_{pigcms{$vo.pigcms_id}">
                                    <i class="icon-tag"></i> 查看详情 </a>
                            </li>
                        </ul>
                    </div>
                </td>
                </tr>
            <!--弹出层容器-->
            <div class="modal fade" tabindex="-1" role="dialog" id="modal_{pigcms{$vo.pigcms_id}">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                    </div>
                </div>
            </div>
            <!--        弹出层容器-->
        </volist>
        </tbody>
    </table>

</div>

<br />
<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
            过去1年的巡检情况
        </div>
    </div>
</div>
<div id="didida" style="border: 1px solid #333333;">
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>巡检日期</th>
            <th>总巡检点</th>
            <th>已巡检</th>
            <th>未巡检</th>
        </tr>
        <foreach name="year_pointRecord" item="vo">
            <tr>
                <td>{pigcms{$vo.date}</td>
                <td>{pigcms{$vo.pointNum}</td>
                <td>{pigcms{$vo.yes_Count}</td>
                <td>{pigcms{$vo.no_Count}</td>
            </tr>
        </foreach>
    </table>

</div>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<link rel="stylesheet" href="http://www.hdhsmart.com/Car/Admin/Public/css/jquery.datetimepicker.css">
<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<script>
    //隐藏
    $('.summary').hide();
    function read(obj){
        if(confirm('您确定要标记为已处理？')){
            var bindid = $(obj).attr('bindid');
            var cid = $(obj).attr('pid');
            $.post("{pigcms{:U('do_repair')}",{bind_id:bindid,cid:cid},function(result){
                if(result.error == 0){
                    window.location.reload();
                }
            })
        }
    }
    $(function(){
        $('.handle_btn').on('click',function(){
            art.dialog.open($(this).attr('href'),{
                init: function(){
                    var iframe = this.iframe.contentWindow;
                    window.top.art.dialog.data('iframe_handle',iframe);
                },
                id: 'handle',
                title:'查看详情',
                padding: 0,
                width: 820,
                height: 520,
                lock: true,
                resize: false,
                background:'black',
                button: null,
                fixed: false,
                close: null,
                left: '50%',
                top: '38.2%',
                opacity:'0.4'
            });
            return false;
        });

    });
    
    // $("#choose_time").datetimepicker({
    //      language: 'zh-CN',//显示中文
    //      format: 'yyyy-mm',//显示格式
    //      minView: 3,//设置只显示到月份
    //      // startView: 3,
    //      initialDate: new Date(),//初始化当前日期
    //      autoclose: true,//选中自动关闭
    //      todayBtn: true//显示今日按钮
    // })

    $.datetimepicker.setLocale('ch');
     $('#check_time_from').datetimepicker({
            format: 'Y-m',
            minView: 3,
            startView: 3,
            lang:"zh",
            timepicker:false
        });

     $('#check_time_from').change(function(){
        var check_time_from = $('#check_time_from').val();
        // var check_time_to = $('#check_time_to').val();
        window.location.href='/admin.php?g=System&c=PropertyService&a=point_safety_record&check_time='+check_time_from;
    });
</script>


<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
