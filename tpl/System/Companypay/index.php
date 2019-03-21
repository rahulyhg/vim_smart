<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Companypay/index')}" class="on">提款列表</a>|
				</ul>
			</div>
			<table class="search_table" width="100%">
				<tr>
					<td>
						<form action="{pigcms{:U('Companypay/index')}" method="get">
							<input type="hidden" name="c" value="Companypay"/>
							<input type="hidden" name="a" value="index"/>
							筛选: <input type="text" name="keyword" class="input-text" value="{pigcms{$_GET['keyword']}"/>
							<select name="searchtype">
								<option value="pay_id" <if condition="$_GET['searchtype'] eq 'name'">selected="selected"</if>>商ID</option>								
								<option value="phone" <if condition="$_GET['searchtype'] eq 'phone'">selected="selected"</if>>联系电话</option>
							</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							支付状态: <select name="searchstatus">
								<option value="1" <if condition="$_GET['searchstatus'] eq '1'">selected="selected"</if>>已支付</option>
								<option value="0" <if condition="$_GET['searchstatus'] eq 0">selected="selected"</if>>已取消</option>
							</select>
							<input type="submit" value="查询" class="button"/>
						</form>
					</td>
				</tr>
			</table>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup><col> <col> <col> <col><col><col><col><col><col width="240" align="center"> </colgroup>
						<thead>
							<tr>
								<th>编号</th>
								<th>付费类型</th>
								<th>商家id</th>
								<th>联系电话</th>
								<th>金额</th>
								<th>描述</th>
								<th>添加时间</th>
								<th>支付时间</th>
								<th>状态</th>
							</tr>
						</thead>
						<tbody>
							
								<volist name="pay_list" id="vo">
									<tr>
										<td>{pigcms{$vo.pigcms_id}</td>
										<td>{pigcms{$vo.pay_type}</td>
										<td>{pigcms{$vo.pay_id}</td>
										<td>{pigcms{$vo.phone}</td>
										<td>{pigcms{$vo.money}</td>
										<td>{pigcms{$vo.desc}</td>
										<td>{pigcms{$vo.add_time|date='Y-m-d H:i:s',###}</td>
										<td><if condition="$vo['pay_time']">{pigcms{$vo.pay_time|date='Y-m-d H:i:s',###}<else/>无</if></td>
										
										<td><if condition="$vo['status'] eq 1"><font color="green">已支付</font><elseif condition="$vo['status'] eq 2"/><font color="red">已取消</font>|<a href="{pigcms{:U('Companypay/restore',array('pigcms_id'=>$vo['pigcms_id'],'status'=>0))}"><font color="green">恢复</font></a><else/><font color="red">未支付</font>|<a href="{pigcms{:U('Companypay/restore',array('pigcms_id'=>$vo['pigcms_id'],'status'=>2))}"><font color="black">取消</font></a></if></td>
										
										<!--<td class="textcenter"><a href="{pigcms{:U('Merchant/order',array('mer_id'=>$vo['mer_id']))}">查看账单</a></td>-->
										<!--td class="textcenter"><a href="{pigcms{:U('Merchant/weidian_order',array('mer_id'=>$vo['mer_id']))}">微店账单</a></td-->
									</tr>
								</volist>
							<tr><td class="textcenter pagebar" colspan="16">{pigcms{$pagebar}</td></tr>	
						</tbody>
					</table>
				</div>
			</form>
		</div>
<include file="Public:footer"/>