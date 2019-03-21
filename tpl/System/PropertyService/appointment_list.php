<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.label-kid {
    background-color: #f36a5a;
}
.btn-group>.dropdown-menu, .dropdown-toggle>.dropdown-menu, .dropdown>.dropdown-menu {
    margin-top: 10px;
}
.dropdown-menu {
	margin: 0 0 0 -90px;
}
</style>
<!--头部设置-->
<?php
$title = array(
    'title'=>'在线预约',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('在线预约','#'),
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
<!--                    <a href="{pigcms{:U('',array('village_id'=>$vo['village_id']))}">-->
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
<div id="shopList" class="grid-view">
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
<!--            //编号	排序	商品名称	价格	单位	销售量	最后操作时间	状态	操作-->
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th >编号</th>
            <th >预约用户名</th>
            <th>用户手机</th>
            <th>所属社区</th>
            <th>预约类型</th>
            <th>单位价格</th>
            <th>单位</th>
            <th>预约起始时间</th>
            <th>预约结束时间</th>
            <th>提交时间</th>
            <th>处理状态</th>
            <th class="button-column">操作</th>
        </tr>
        </thead>
        <tbody>

        <volist name="list" id="row">
            <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
            <td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" value="1" />
                    <span></span>
                </label>
            </td>
            <td><div class="tagDiv">{pigcms{$row.pigcms_id}</div></td>
            <td><div class="tagDiv">{pigcms{$row.name}</div></td>
            <td><div class="tagDiv">{pigcms{$row.contact}</div></td>
            <td><div class="tagDiv">{pigcms{$row.village_name}</div></td>
            <td><div class="tagDiv">{pigcms{$row.meal_name}</div></td>
            <td><div class="tagDiv">{pigcms{$row.price}</div></td>
            <td><div class="tagDiv">{pigcms{$row.unit}</div></td>
            <td>
                <div class="tagDiv">
                    <if condition="$row['appointment_start_time'] gt 0">
                        {pigcms{$row.appointment_start_time|date="Y-m-d H:i",###}
                    </if>
                </div>
            </td>
            <td>
                <div class="tagDiv">
                    <if condition="$row['appointment_end_time'] gt 0">
                        {pigcms{$row.appointment_end_time|date="Y-m-d H:i",###}
                    </if>
                </div>
            </td>
            <td>
                <div class="tagDiv">{pigcms{$row.time|date="Y-m-d H:i",###}</div>
            </td>
            <td>
                <div class="tagDiv">
                    <if condition="$row['is_read'] eq 0">
                        <span style="color: red">未处理</span>
                    <else/>
                        <span style="color: green">已处理</span>
                    </if>
                </div>
            </td>
<!--            <td class="button-column">-->
<!--                <a href="{pigcms{:U('appointment_info',array('pigcms_id'=>$row['pigcms_id']))}"  style="width: 60px;" class="label label-sm label-info handle_btn show_info" title="查看详情">查看详情</a>-->
<!--                <if condition="$row['is_read'] eq 0">-->
<!--                    <a style="width:100px;"  pigcms_id="{pigcms{$row.pigcms_id}" class="label label-sm label-info" title="已处理" href="javascript:;" onclick="read(this)" bindid='{pigcms{$vo.bind_id}' pid="{pigcms{$vo.pid}">标记为已处理</a>-->
<!--                </if>-->
<!--                <a class="del label label-sm label-info handle_btn" href="{pigcms{:U('appointment_del',array('pigcms_id'=>$row['pigcms_id']))}"  style="width: 60px;" class="label label-sm label-info handle_btn" title="删除">删除</a>-->
<!--            </td>-->
            <td class="button-column">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position: absolute;">
                        <li>
                            <a href="{pigcms{:U('appointment_info',array('pigcms_id'=>$row['pigcms_id']))}"  class="label-sm handle_btn show_info" title="查看详情">
                                <i class="icon-docs"></i>查看详情
                            </a>
                        </li>
                        <if condition="$row['is_read'] eq 0">
                        <li>
                            <a pigcms_id="{pigcms{$row.pigcms_id}" title="已处理" href="javascript:;" onclick="read(this)" bindid='{pigcms{$vo.bind_id}' pid="{pigcms{$vo.pid}"> <i class="icon-docs"></i>标记为已处理</a>
                        </li>
                        </if>
                        <li>
                            <a class="del" href="{pigcms{:U('appointment_del',array('pigcms_id'=>$row['pigcms_id']))}" class="label label-sm label-info handle_btn" title="删除"> <i class="icon-docs"></i>删除</a>
                        </li>
                    </ul>
                </div>

                <!--<a style="width: 60px;" class="label label-sm label-info" title="编辑" href="{pigcms{:U('edit',array('pigcms_id'=>$vo['pigcms_id'],'usernum'=>$vo['usernum']))}">编辑</a>
                <a style="width: 60px;" class="label label-sm label-info" title="缴费明细" href="{pigcms{:U('order_history',array('bind_id'=>$vo['pigcms_id']))}">缴费明细</a>
                <a style="width: 60px;" class="label label-sm label-info handle_btn" title="抄表二维码"
                   href="http://www.hdhsmart.com/shequ.php?g=House&c=Index&a=re_setmeter_qr&usernum={pigcms{$vo['usernum']}"
                   id="{pigcms{$vo.pigcms_id}"

                >抄表二维码</a><!-->

            </td>
            </tr>
        </volist>
        </tbody>
    </table>
    <if condition="$repair_list['totalPage'] gt 1">{pigcms{$repair_list.pagebar}</if>
</div>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script>
    //隐藏
    $('.summary').hide();
    function read(obj){
        var pigcms_id = $(obj).attr("pigcms_id");
        if(confirm('您确定要标记为已处理？')){
            $.post("{pigcms{:U('is_read')}",{pigcms_id:pigcms_id},function(result){
                var res = JSON.parse(result)
                if(res.error === 0){
                    window.location.reload();
                }
            })
        }
    }
    $(function(){
        $('.show_info').on('click',function(){
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
    /**
     * 列表删除
     */
    $('.del').click(function(){
        if(window.confirm("您确认删除该条数据")){
            var href = $(this).attr("href");
            $.get(href,{},function(re){
                re = JSON.parse(re);
                if(re.error===0){
                    window.location.reload();
                }else{
                    alert("删除失败");
                }
            });
        }
        return false;
    });
</script>


<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
