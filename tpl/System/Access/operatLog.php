<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('Access/operatLog')}" class="on">开门记录列表</a>          
        </ul>
    </div>
	<div class="table-list">

		<table class="search_table" width="100%">
			<tr>
				<td>
					<form action="{pigcms{:U('Access/operatLog')}" method="get">
						<input type="hidden" name="c" value="Access"/>
						<input type="hidden" name="a" value="operatLog"/>
						<select name="searchtype">
							<option selected="selected" value="0">请选择</option>
							<option value="name" <if condition="$_GET['searchtype'] eq 'name'">selected="selected"</if>>用户名称</option>
							<option value="phone" <if condition="$_GET['searchtype'] eq 'phone'">selected="selected"</if>>手机号</option>
						</select>
						<input type="text" name="keyword" class="input-text" value="{pigcms{$_GET['keyword']}"  placeholder="请输入查询内容">
						开始时间：<input type="text" class="input" name="startDate"  placeholder="请输入起始时间" style="width:120px;" id="d4311" validate="required:true"  value="{pigcms{$_GET['startDate']}" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm',maxDate:'#F{$dp.$D(\'d4312\')}'})"/>
						结束时间：<input type="text" class="input" name="endDate"  placeholder="请输入终止时间" style="width:120px;" id="d4312" validate="required:true"   value="{pigcms{$_GET['endDate']}" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm',minDate:'#F{$dp.$D(\'d4311\')}'})"/>
						<input type="submit" value="查询" class="button"/>
					</form>
				</td>
			</tr>
		</table>
		<table width="100%" cellspacing="0">            
			<thead>
			<tr>
				<th>ID</th>
				<th>用户</th>
				<th>联系方式</th>
				<th>证件类型</th>
				<th>证件号</th>
				<th>设备名称</th>
				<th>所属区域</th>
				<th>所属社区</th>
				<th>所属公司</th>
				<th>时间</th>
				<th class="textcenter">操作</th>
			</tr>
			</thead>
			<tbody>
			<if condition="$log_list['access_list']">
			<volist name="log_list['access_list']" id="vo">
				<tr>
					<td>{pigcms{$vo.log_id}</td>
					<td>{pigcms{$vo.name}</td>
					<td>{pigcms{$vo.phone}</td>
					<td><if condition="$vo.card_type eq 1">现场审核</if><if condition="$vo.card_type eq 2">门禁卡</if><if condition="$vo.card_type eq 3">身份证</if><if condition="$vo.card_type eq 4">工作牌</if></td>
					<td>{pigcms{$vo.usernum}</td>
					<td>{pigcms{$vo.ac_name}</td>
					<td>{pigcms{$vo.ag_name}</td>
					<td>{pigcms{$vo.village_name}</td>
					<td>{pigcms{$vo.company_name}</td>
					<td>{pigcms{$vo.opdate|date='Y-m-d H:i:s',###}</td>
					<td class="textcenter"><a href="javascript:void(0);"  onclick="window.top.artiframe('{pigcms{:U('Access/operatLog_edit',array('log_id'=>$vo['log_id']))}','查看详情',480,<if condition="$vo['log_id']">240<else/>340</if>,true,false,false,editbtn,'edit',true);">详情</a> | <a href="javascript:void(0);" class="delete_row" parameter="log_id={pigcms{$vo.log_id}" url="{pigcms{:U('Access/operatLog_del')}">删除</a></td>
				</tr>
			</volist>
			<tr><td class="textcenter pagebar" colspan="10">{pigcms{$log_list['pagebar']}</td></tr>
			<else/>
			<tr><td class="textcenter red" colspan="10">列表为空！</td></tr>
			</if>
			</tbody>
		</table>
	</div>
</div>
<include file="Public:footer"/>