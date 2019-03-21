<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-group"></i>
				<a href="{pigcms{:U('Index/index')}">业主管理</a>
			</li>
			<li class="active">总欠费信息设置</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<form  class="form-horizontal" method="post" id="edit_form" action="{pigcms{:U('User/edit')}">
						<input  name="pigcms_id" type="hidden"  value="{pigcms{$info.pigcms_id}"/>
						<input  name="usernum" type="hidden"  value="{pigcms{$info.usernum}"/>
						<div class="tab-content">
							<div id="basicinfo" class="tab-pane active">
								<div class="form-group">
									<label class="col-sm-1"><label for="usernum">用户编号</label></label>
									<input class="col-sm-2" size="20" value="{pigcms{$info.usernum}" type="text" style="border:none;background:white!important;" readonly="readonly">
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="name">业主名称</label></label>
									<input class="col-sm-2" size="20" name="name" id="name" type="text" value="{pigcms{$info.name}"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="phone">业主联系方式</label></label>
									<input class="col-sm-2" size="20" name="phone" id="phone" type="text" value="{pigcms{$info.phone}" />
									<span class="form_tips">多个电话号码以空格分开</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="address">住址</label></label>
									<input class="col-sm-2" size="20" name="address" id="address" type="text" value="{pigcms{$info.address}" />
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="water_price">水费总欠费</label></label>
									<input class="col-sm-2" size="10" name="water_price" id="water_price" type="text"  value="{pigcms{$info.water_price|floatval=###}"/>
									<span class="form_tips">元 （支持两位小数）</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="electric_price">电费总欠费</label></label>
									<input class="col-sm-2" size="10" name="electric_price" id="electric_price" type="text"  value="{pigcms{$info.electric_price|floatval=###}"/>
									<span class="form_tips">元 （支持两位小数）</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="gas_price">燃气费总欠费</label></label>
									<input class="col-sm-2" size="10" name="gas_price" id="gas_price" type="text"  value="{pigcms{$info.gas_price|floatval=###}"/>
									<span class="form_tips">元 （支持两位小数）</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="park_price">停车费总欠费</label></label>
									<input class="col-sm-2" size="10" name="park_price" id="park_price" type="text"  value="{pigcms{$info.park_price|floatval=###}"/>
									<span class="form_tips">元 （支持两位小数）</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="property_price">物业费总欠费</label></label>
									<input class="col-sm-2" size="10" name="property_price" id="property_price" type="text"  value="{pigcms{$info.property_price|floatval=###}"/>
									<span class="form_tips">元 （支持两位小数）</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="park_flag">停车位</label></label>
									<label><input name="park_flag"  type="radio" value="1" <if condition="$info.park_flag eq 1">checked</if> />&nbsp;&nbsp;有</label>
									&nbsp;&nbsp;&nbsp;
									<label><input name="park_flag"  type="radio" value="0" <if condition="$info.park_flag eq 0">checked</if> />&nbsp;&nbsp;无</label>
								</div>
							</div>
						</div>
						<div class="space"></div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">
										<i class="ace-icon fa fa-check bigger-110"></i>
										保存
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<include file="Public:footer"/>