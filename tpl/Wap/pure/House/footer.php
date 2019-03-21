<if condition="empty($no_footer)">
	<footer class="footerMenu wap">
		<ul>
			<li>
				<a href="{pigcms{:U('Home/index')}"><em class="home"></em><p>平台首页</p></a>
			</li>
			<li>
				<a href="{pigcms{:U('House/village_list')}"><em class="group"></em><p>社区列表</p></a>
			</li>
			<li>
				<a <if condition="in_array(ACTION_NAME,array('village'))">class="hover"<else/>href="{pigcms{:U('House/village',array('village_id'=>$now_village['village_id']))}"</if>><em class="store"></em><p>社区首页</p></a>
			</li>
			<li>
				<a id="phone" href="{pigcms{:U('House/village_list',array('village_id'=>$now_village['village_id'],'comm'=>'1'))}"><em class="group" id="group1"></em><p>号码管理</p></a>
			</li>
			<li>
				<a <if condition="strpos(ACTION_NAME,'village_my') nheq false">class="active"<else/></if> href="{pigcms{:U('House/village_my',array('village_id'=>$now_village['village_id']))}"><em class="my"></em><p>个人中心</p></a>
			</li>
		</ul>
	</footer>
</if>
<div style="display:none;">{pigcms{$config.wap_site_footer}</div>