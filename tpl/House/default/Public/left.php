<div id="sidebar" class="sidebar responsive">
	<if condition="$village_arr neq ''">
		<ul class="nav nav-list" style="top: 0px;">
			<volist name="village_arr" id="vo">
				<li class="{pigcms{$vo.style_class}">
					<a <if condition="$vo['menu_list']">href="#" class="dropdown-toggle"<else/>href="{pigcms{$vo.url}"</if>>
					<i class="menu-icon fa {pigcms{$vo.icon}"></i>
					<span class="menu-text">{pigcms{$vo.name}</span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<if condition="$vo['menu_list']">
				<ul class="submenu">
					<volist name="vo['menu_list']" id="voo">
						<li <if condition="$voo['is_active']">class="active"</if>>
						<a href="{pigcms{$voo.url}"> 
							<i class="menu-icon fa fa-caret-right"></i> {pigcms{$voo.name}
						</a>
						<b class="arrow"></b>
					</li>
					</volist>					
				</ul>
				</if>
			</li>
			</volist>
		</ul>
	<else/>
	<ul class="nav nav-list" style="top: 0px;">
		<li class="hsub <if condition="MODULE_NAME eq 'Index' && ACTION_NAME eq 'index'">open active</if>">
			<a href="#" class="dropdown-toggle"> 
				<i class="menu-icon fa fa-gear"></i>
				<span class="menu-text">基本信息管理</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li <if condition="strpos(ACTION_NAME,'index') nheq false">class="active"</if>>
					<a href="{pigcms{:U('Index/index')}"> 
						<i class="menu-icon fa fa-caret-right"></i> 基本信息设置
					</a>
					<b class="arrow"></b>
				</li>					
			</ul>
		</li>
		<li class="hsub <if condition="MODULE_NAME eq 'User' && in_array(ACTION_NAME,array('index','user_import','detail_import','edit','orders','pay_detail'))">open active</if>">
			<a href="#" class="dropdown-toggle"> 
				<i class="menu-icon fa fa-group"></i>
				<span class="menu-text">业主列表</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li <if condition="MODULE_NAME eq 'User' && in_array(ACTION_NAME,array('index','user_import','detail_import','edit','orders','pay_detail'))">class="active"</if>>
					<a href="{pigcms{:U('User/index')}">
						<i class="menu-icon fa fa-caret-right"></i> 业主列表
					</a>
					<b class="arrow"></b>
				</li>
			</ul>
		</li>
		<li class="hsub <if condition="(MODULE_NAME eq 'News' && in_array(ACTION_NAME,array('reply','suggess'))) || (MODULE_NAME eq 'Repair' && in_array(ACTION_NAME,array('suggess'))) || (MODULE_NAME eq 'Index' && in_array(ACTION_NAME,array('contract')))">open active</if>">
			<a href="#" class="dropdown-toggle"> 
				<i class="menu-icon fa fa-comments-o"></i>
				<span class="menu-text">业主交流</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li <if condition="MODULE_NAME eq 'News' && in_array(ACTION_NAME,array('reply'))">class="active"</if>>
					<a href="{pigcms{:U('News/reply')}"> 
						<i class="menu-icon fa fa-caret-right"></i> 新闻评论列表
					</a>
					<b class="arrow"></b>
				</li>
				<li <if condition="MODULE_NAME eq 'Repair' && in_array(ACTION_NAME,array('suggess'))">class="active"</if>>
					<a href="{pigcms{:U('Repair/suggess')}"> 
						<i class="menu-icon fa fa-caret-right"></i> 投诉建议列表
					</a>
					<b class="arrow"></b>
				</li>
                <li <if condition="MODULE_NAME eq 'Index' && in_array(ACTION_NAME,array('contract'))">class="active"</if>>
                <a href="{pigcms{:U('Index/contract')}">
                    <i class="menu-icon fa fa-caret-right"></i> 物业合同管理
                </a>
                <b class="arrow"></b>
                </li>
			</ul>
		</li>
    <li class="hsub <if condition="MODULE_NAME eq 'Meter' ">open active</if>">
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-th-list"></i>
        <span class="menu-text">设备管理</span>
        <b class="arrow fa fa-angle-down"></b>
    </a>
    <b class="arrow"></b>
    <ul class="submenu">
        <li <if condition="MODULE_NAME eq 'Meter' && in_array(ACTION_NAME,array('index'))">class="active"</if>>
        <a href="{pigcms{:U('Meter/index')}">
            <i class="menu-icon fa fa-caret-right"></i>公区水电表管理
        </a>
        <b class="arrow"></b>
    </ul>
    </li>
		<li class="hsub <if condition="MODULE_NAME eq 'Index' && strpos(ACTION_NAME,'active') nheq false">open active</if>">
			<a href="#" class="dropdown-toggle"> 
				<i class="menu-icon fa fa-empire"></i>
				<span class="menu-text">推荐活动管理</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li <if condition="MODULE_NAME eq 'Index' && in_array(ACTION_NAME,array('active_group_list','active_group'))">class="active"</if>>
					<a href="{pigcms{:U('Index/active_group_list')}"> 
						<i class="menu-icon fa fa-caret-right"></i> {pigcms{$config.group_alias_name}列表
					</a>
					<b class="arrow"></b>
				</li>
				<li <if condition="MODULE_NAME eq 'Index' && in_array(ACTION_NAME,array('active_meal_list','active_meal'))">class="active"</if>>
					<a href="{pigcms{:U('Index/active_meal_list')}"> 
						<i class="menu-icon fa fa-caret-right"></i> {pigcms{$config.meal_alias_name}列表
					</a>
					<b class="arrow"></b>
				</li>	
				<li <if condition="MODULE_NAME eq 'Index' && in_array(ACTION_NAME,array('active_appoint_list','active_appoint','active_appoint_edit'))">class="active"</if>>
					<a href="{pigcms{:U('Index/active_appoint_list')}"> 
						<i class="menu-icon fa fa-caret-right"></i> 预约列表
					</a>
					<b class="arrow"></b>
				</li>				
			</ul>
		</li>
		<li class="hsub <if condition="MODULE_NAME eq 'News' && in_array(ACTION_NAME,array('index','news_edit','cate','cate_edit'))">open active</if>">
			<a href="#" class="dropdown-toggle"> 
				<i class="menu-icon fa fa-newspaper-o"></i>
				<span class="menu-text">新闻管理</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li <if condition="MODULE_NAME eq 'News' && in_array(ACTION_NAME,array('index','news_edit'))">class="active"</if>>
					<a href="{pigcms{:U('News/index')}">
						<i class="menu-icon fa fa-caret-right"></i> 新闻列表
					</a>
					<b class="arrow"></b>
				</li>	
				<li <if condition="MODULE_NAME eq 'News' &&  in_array(ACTION_NAME,array('cate','cate_edit'))">class="active"</if>>
					<a href="{pigcms{:U('News/cate')}">
						<i class="menu-icon fa fa-caret-right"></i> 新闻分类设置
					</a>
					<b class="arrow"></b>
				</li>				
			</ul>
		</li>
		<li class="hsub <if condition="MODULE_NAME eq 'CommonPhone' && in_array(ACTION_NAME,array('cp_index','cp_edit','cp_del','ct_index','ct_edit','ct_del'))">open active</if>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-tablet"></i>
			<span class="menu-text">常用号码</span>
			<b class="arrow fa fa-angle-down"></b>
		</a>
		<b class="arrow"></b>
		<ul class="submenu">
			<li <if condition="MODULE_NAME eq 'CommonPhone' && in_array(ACTION_NAME,array('cp_index','cp_edit'))">class="active"</if>>
			<a href="{pigcms{:U('CommonPhone/cp_index')}">
				<i class="menu-icon fa fa-caret-right"></i> 常用号码管理列表
			</a>
			<b class="arrow"></b>
			</li>
			<li <if condition="MODULE_NAME eq 'CommonPhone' &&  in_array(ACTION_NAME,array('ct_index','ct_edit','ct_del'))">class="active"</if>>
			<a href="{pigcms{:U('CommonPhone/ct_index')}">
				<i class="menu-icon fa fa-caret-right"></i> 常用号码分类设置
			</a>
			<b class="arrow"></b>
			</li>
		</ul>
		</li>
		<li class="hsub <if condition="MODULE_NAME eq 'Repair' && ACTION_NAME eq 'index'">open active</if>">
			<a href="#" class="dropdown-toggle"> 
				<i class="menu-icon fa fa-file-excel-o"></i>
				<span class="menu-text">在线报修设置</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li <if condition="MODULE_NAME eq 'Repair' && ACTION_NAME eq 'index'">class="active"</if>>
					<a href="{pigcms{:U('Repair/index')}">
						<i class="menu-icon fa fa-caret-right"></i> 在线报修列表
					</a>
					<b class="arrow"></b>
				</li>					
			</ul>
		</li>
		<li class="hsub <if condition="MODULE_NAME eq 'Repair' && ACTION_NAME eq 'water'">open active</if>">
			<a href="#" class="dropdown-toggle"> 
				<i class="menu-icon fa fa-tasks"></i>
				<span class="menu-text">水电煤上报列表</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li <if condition="MODULE_NAME eq 'Repair' && ACTION_NAME eq 'water'">class="active"</if>>
					<a href="{pigcms{:U('Repair/water')}">
						<i class="menu-icon fa fa-caret-right"></i> 水电煤上报列表
					</a>
					<b class="arrow"></b>
				</li>					
			</ul>
		</li>
		<li class="hsub <if condition="MODULE_NAME eq 'User' && ACTION_NAME eq 'village_order'">open active</if>">
			<a href="#" class="dropdown-toggle"> 
				<i class="menu-icon fa fa-shopping-cart"></i>
				<span class="menu-text">在线缴费订单列表</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li <if condition="MODULE_NAME eq 'User' && ACTION_NAME eq 'village_order'">class="active"</if>>
					<a href="{pigcms{:U('User/village_order')}">
						<i class="menu-icon fa fa-caret-right"></i> 在线缴费订单列表
					</a>
					<b class="arrow"></b>
				</li>					
			</ul>
		</li>
		<li class="hsub <if condition="MODULE_NAME eq 'Access' && in_array(ACTION_NAME,array('index','access_edit','deviceType','deviceType_edit','group','group_edit','userCheck','userCheck_edit','operatLog','operatLog_edit','visitorLog','visitorLog_edit'))">open active</if>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-key"></i>
			<span class="menu-text">智能门禁管理</span>
			<b class="arrow fa fa-angle-down"></b>
		</a>
		<b class="arrow"></b>
		<ul class="submenu">
			<li <if condition="MODULE_NAME eq 'Access' && in_array(ACTION_NAME,array('index','access_edit'))">class="active"</if>>
			<a href="{pigcms{:U('Access/index')}">
				<i class="menu-icon fa fa-caret-right"></i> 门禁设备列表
			</a>
			<b class="arrow"></b>
			</li>
			<li <if condition="MODULE_NAME eq 'Access' && in_array(ACTION_NAME,array('deviceType','deviceType_edit'))">class="active"</if>>
			<a href="{pigcms{:U('Access/deviceType')}">
				<i class="menu-icon fa fa-caret-right"></i> 设备类型列表
			</a>
			<b class="arrow"></b>
			</li>
			<li <if condition="MODULE_NAME eq 'Access' &&  in_array(ACTION_NAME,array('group','group_edit'))">class="active"</if>>
			<a href="{pigcms{:U('Access/group')}">
				<i class="menu-icon fa fa-caret-right"></i> 门禁区域管理
			</a>
			<b class="arrow"></b>
			</li>
			<li <if condition="MODULE_NAME eq 'Access' &&  in_array(ACTION_NAME,array('userCheck','userCheck_edit'))">class="active"</if>>
			<a href="{pigcms{:U('Access/userCheck')}">
				<i class="menu-icon fa fa-caret-right"></i>  用户资料审核
			</a>
			<b class="arrow"></b>
			</li>
			<li <if condition="MODULE_NAME eq 'Access' &&  in_array(ACTION_NAME,array('visitorLog','visitorLog_edit'))">class="active"</if>>
			<a href="{pigcms{:U('Access/visitorLog')}">
				<i class="menu-icon fa fa-caret-right"></i>  访客信息管理
			</a>
			<b class="arrow"></b>
			</li>
			<li <if condition="MODULE_NAME eq 'Access' &&  in_array(ACTION_NAME,array('operatLog','operatLog_edit'))">class="active"</if>>
			<a href="{pigcms{:U('Access/operatLog')}">
				<i class="menu-icon fa fa-caret-right"></i>  用户开门记录
			</a>
			<b class="arrow"></b>
			</li>
		</ul>
		</li>
		<!--2016.6.8
		门禁管理
		陈琦
		-->
		<li class="hsub <if condition="MODULE_NAME eq 'VillageUser' && in_array(ACTION_NAME,array('index','VillageUserCheck_edit'))">open active</if>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-user"></i>
			<span class="menu-text">管理员设置</span>
			<b class="arrow fa fa-angle-down"></b>
		</a>
		<b class="arrow"></b>
		<ul class="submenu">
			<li <if condition="MODULE_NAME eq 'VillageUser' && in_array(ACTION_NAME,array('index','VillageUserCheck_edit'))">class="active"</if>>
			<a href="{pigcms{:U('VillageUser/index')}">
				<i class="menu-icon fa fa-caret-right"></i> 管理员列表
			</a>
			<b class="arrow"></b>
			</li>
		</ul>
		</li>
		<!--2016.6.21
		用户管理
		陈琦
		-->
	</ul>
	</if>
	<!-- /.nav-list -->
	<!-- #section:basics/sidebar.layout.minimize -->
	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-left"
			data-icon1="ace-icon fa fa-angle-double-left"
			data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>
	<!-- /section:basics/sidebar.layout.minimize -->
	<script type="text/javascript">
		try {
			ace.settings.check('sidebar', 'collapsed')
		} catch (e) {
		}
	</script>
</div>