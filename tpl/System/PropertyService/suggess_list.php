<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .dropdown-menu {
        margin: 0 0 0 -90px;
    }
</style>
<!--头部设置-->
<?php
$title = array(
    'title'=>'投诉建议',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('投诉建议','#'),
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
    <table class="table table-striped table-bordered table-hover" id="sample_1">
        <thead>
        <tr>
            <th width="10%">编号</th>
            <th width="10%">建议人</th>
            <th width="45%">建议内容</th>
            <th width="10%">建议时间</th>
            <th>审核状态</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>

            <volist name="list" id="vo">
                <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
        <td><div class="tagDiv">{pigcms{$vo.pigcms_id}</div></td>
        <td><div class="tagDiv">{pigcms{$vo.name}</div></td>
        <td><div class="tagDiv">{pigcms{$vo.content}</div></td>
        <td><div class="shopNameDiv">{pigcms{$vo.time|date='Y-m-d H:i:s',###}</div></td>
<!--        <td class="button-column">-->
<!--            <if condition="$vo['is_read'] eq 0">-->
<!--                <a style="width:100px;" class="label label-sm label-info" title="已处理" href="javascript:;" onclick="read(this)" bindid='{pigcms{$vo.bind_id}' pid="{pigcms{$vo['pigcms_id']}">标记为已处理</a>-->
<!--            </if>-->
<!--            <a style="width: 60px;" class="label label-sm label-info handle_btn" title="查看详情" href="{pigcms{:U('appointment_info',array('pigcms_id'=>$vo['pigcms_id']))}">查看详情</a>-->
<!--        </td>-->
                <td>
                    <if condition="$vo['is_read']">
                        <span class="text-info">已处理</span>
                        <else />
                        <span style="color:orangered">未处理</span>
                    </if>
                </td>
        <td class="button-column">
            <div class="btn-group">
                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                    <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-left" role="menu" style="position: absolute;">
                    <li>
                        <a class="handle_btn" title="查看详情" href="{pigcms{:U('appointment_info',array('pigcms_id'=>$vo['pigcms_id']))}">
                            <i class="icon-docs"></i>查看详情
                        </a>
                    </li>
                    <if condition="$vo['is_read'] eq 0">
                        <li>
                            <a  title="已处理" href="javascript:;" onclick="read(this)" bindid='{pigcms{$vo.bind_id}' pid="{pigcms{$vo['pigcms_id']}">
                                <i class="icon-docs"></i>标记为已处理
                            </a>
                        </li>
                    </if>
                    <li>
                        <a class="del" href="{pigcms{:U('appointment_del',array('pigcms_id'=>$vo['pigcms_id']))}" title="删除">
                            <i class="icon-docs"></i>删除
                        </a>
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
        if(confirm('您确定要标记为已处理？')){
            var bindid = $(obj).attr('bindid');
            var cid = $(obj).attr('pid');
            $.post("{pigcms{:U('do_repair')}",{bind_id:bindid,cid:cid},function(result){
                if(result.error == 0){
                    console.log(result);
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
