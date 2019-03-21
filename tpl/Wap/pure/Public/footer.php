<if condition="empty($no_footer)">		
	<footer class="footerMenu <if condition="!$is_wexin_browser">wap</if>">
		<ul>
			<li>
				<a <if condition="MODULE_NAME eq 'Home'">class="active"</if> href="{pigcms{:U('Home/index')}"><em class="home"></em><p>首页</p></a>
			</li>
			<li>
				<a <if condition="MODULE_NAME eq 'Group'">class="hover"</if> href="{pigcms{:U('Group/index')}"><em class="group"></em><p>{pigcms{$config.group_alias_name}</p></a>
			</li>
			<li class="voiceBox">
				<a href="{pigcms{:U('Search/voice')}" class="voiceBtn" data-nobtn="true"></a>
			</li>
			<li>
				<a <if condition="in_array(MODULE_NAME,array('Meal_list','Meal'))">class="hover"</if> href="{pigcms{:U('Meal_list/index')}"><em class="store"></em><p>{pigcms{$config.meal_alias_name}</p></a>
			</li>
			<li>
				<a <if condition="in_array(MODULE_NAME,array('My','Login'))">class="active"</if> href="{pigcms{:U('My/index')}"><em class="my"></em><p>我的</p></a>
			</li>
		</ul>
	</footer>
</if>
<div style="display:none;">{pigcms{$config.wap_site_footer}</div>