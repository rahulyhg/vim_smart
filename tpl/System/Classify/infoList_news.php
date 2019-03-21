<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
	'title'=>'信息发布列表',
	'describe'=>'',
);
$breadcrumb = array(
	array('分类信息','#'),
	array('信息发布列表','#'),
);

$add_action = array(

);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
	<thead>
	<tr>
		<th>ID</th>
		<th>一级分类</th>
		<th>二级分类</th>
		<th>标题</th>
		<th>联系人姓名</th>
		<th>联系人电话</th>
		<th>最后更改时间</th>
		<th width="70">是否置顶</th>
		<th width="190" style="text-align:center;">状态</th>
		<th class="textcenter">操作</th>
	</tr>
	</thead>
	<tbody>
	<if condition="!empty($listdatas)">
		<volist name="listdatas" id="vo">
			<tr>
				<td>{pigcms{$vo.id}</td>
				<td>{pigcms{$ClassifyArr[$vo['fcid']]}</td>
				<td>{pigcms{$ClassifyArr[$vo['cid']]}</td>
				<td><if condition="!empty($title)"> {pigcms{$vo['title']|str_replace=$title,'<b style="color: red;">'.$title.'</b>',###}<else/>{pigcms{$vo.title}</if></td>
				<td>{pigcms{$vo.lxname}</td>
				<td><if condition="strpos($vo['lxtel'], 'load/telimages')"><img src="{pigcms{$config['site_url']}/{pigcms{$vo['lxtel']}"><else/>{pigcms{$vo.lxtel}</if></td>

				<td>{pigcms{$vo.updatetime|date='Y-m-d H:i:s',###}</td>
				<td style="color: red;"><if condition="$vo['toptime'] gt 0"><a style="color: green;" href="{pigcms{:U('Classify/topList',array('cid'=>$vo['fcid'],'subdir2'=>$vo['cid']))}">已置顶</a><else/>未置顶</if></td>
				<td class="red">已审核&nbsp;&nbsp;&nbsp;<input type="button" value="更新成未审核" style="" class="button" onclick="upStatus({pigcms{$vo.id})"></td>
				<td class="textcenter">
                    <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Classify/infodetail',array('vid'=>$vo['id']))}','查看信息详情',680,560,true,false,false,closebtn,'edit',true);">查看详细</a>&nbsp;
                    | <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Classify/infoedit',array('vid'=>$vo['id']))}','编辑',680,560,true,false,false,confirmbtn,'edit',true);">编辑</a>&nbsp;
                    | <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Classify/attrSet',array('vid'=>$vo['id']))}','设置操作',550,350,true,false,false,confirmbtn,'add',true);">设置操作</a>&nbsp;
                    | &nbsp;<a href="javascript:void(0);" onclick="toDelItem({pigcms{$vo.id});">删除</a>
                </td>
			</tr>
		</volist>

		<else/>
		<tr><td class="textcenter red" colspan="10">列表为空！</td></tr>
	</if>
	</tbody>
</table>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script type="text/javascript">
	/***删除***/
	function toDelItem(id){
		if(confirm('您确定删除此项吗？')){
			$.post("{pigcms{:U('Classify/delItem')}",{vid:id},function(data){
				data=parseInt(data);
				if(!data){
					window.location.reload();
				}
			},'JSON');
		}else{
			return false;
		}
	}

	function getSubdir(cid){
		cid=parseInt(cid);
		if(cid>0){
			$.post("{pigcms{:U('Classify/get2Subdir')}",{cid:cid},function(data){
				if(data){
					var shtml='<option value="">请选择！</option>';
					$.each(data,function(kk,vv){
						shtml+='<option value="'+vv.cid+'">'+vv.cat_name+'</option>';
					});
					$('#subdir2').html(shtml).show();
				}
			},'JSON');
		}else{
			$('#subdir2').html('').hide();
		}
	}
	function upStatus(id){
		if(confirm('您确定将此项信息打入未审核状态吗？')){
			$.post("{pigcms{:U('Classify/toNoVerify')}",{vid:id,sv:0},function(data){
				data=parseInt(data);
				if(!data){
					window.location.reload();
				}
			},'JSON');
		}else{
			return false;
		}
	}
</script>


<!--自定义js代码区结束-->
<include file="Public_news:footer"/>

