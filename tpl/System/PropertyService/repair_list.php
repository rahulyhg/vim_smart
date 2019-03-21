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
    'title'=>'在线报修',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('在线报修','#'),
);

?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<div class="table-toolbar">
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/repair_control_list')}">
                    <button id="sample_editable_1_new" class="btn sbold green">报修项目列表
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>
<!--            <if condition="$admin eq 1">-->
<!--                <div class="btn-group">-->
<!--                    <a class="btn green-haze btn-outline sbold uppercase" href="javascript:;" data-toggle="dropdown">-->
<!--                        <i class="fa fa-building"></i> 当前:{pigcms{$presentVillage}-->
<!--                        <i class="fa fa-angle-down"></i>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li>-->
<!--                            <a href="{pigcms{:U('')}">-->
<!--                                <i class="fa fa-building-o"></i> 全部显示 </a>-->
<!--                        </li>-->
<!--                        <foreach name="villageArray" item="vo">-->
<!--                            <li>-->
<!--                                <a href="{pigcms{:U('',array('village_id'=>$vo['village_id']))}">-->
<!--                                    <i class="fa fa-building-o"></i> {pigcms{$vo.village_name} </a>-->
<!--                            </li>-->
<!--                        </foreach>-->
<!--                    </ul>-->
<!--                </div>-->
<!--                <else/>-->
<!--                <div class="btn-group">-->
<!--                    <a class="btn green-haze btn-outline sbold uppercase" href="javascript:;">-->
<!--                        <i class="fa fa-building"></i> 当前:{pigcms{$presentVillage}-->
<!--                    </a>-->
<!--                </div>-->
<!--            </if>-->
        </div>
    </div>
</div>
<div id="shopList" class="grid-view">
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
            <th width="10%">业主编号</th>
            <th width="10%">报修人</th>
            <th width="45%">报修内容</th>
            <th width="10%">报修时间</th>
            <th width="10%">联系电话</th>
            <th width="10%">处理状态</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>

            <volist name="repair_list['repair_list']" id="vo">
                <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
        <td><div class="tagDiv">{pigcms{$vo.usernum}</div></td>
        <td><div class="tagDiv">{pigcms{$vo.name}</div></td>
        <td><div class="tagDiv">{pigcms{$vo.content}</div></td>
        <td><div class="shopNameDiv">{pigcms{$vo.time|date='Y-m-d H:i:s',###}</div></td>
        <td><div class="tagDiv">{pigcms{$vo.contact}</div></td>
        <td>
            <div class="tagDiv">
                <if condition="$vo['is_read'] eq 0">
                    <span style="color: red">未处理</span>
                    <else/>
                    <span style="color: green">已处理</span>
                </if>
            </div>
        </td>
        <td class="button-column">
            <div class="btn-group">
			<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
				<i class="fa fa-angle-down"></i>
			</button>
			<ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
				<li>
					<if condition="$vo['is_read'] eq 0">
						<a href="javascript:;" onclick="read(this)" bindid='{pigcms{$vo.bind_id}' pid="{pigcms{$vo.pid}">
						<i class="icon-docs"></i> 标记为已处理 </a>
					</if>
				</li>
				<li>
					<a href="{pigcms{:U('info',array('bindid'=>$vo['bind_id'],'pid'=>$vo['pid']))}">
						<i class="icon-tag"></i> 查看详情 </a>
				</li>
			</ul>
			</div>
			
			
            
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
</script>


<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
