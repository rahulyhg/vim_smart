<style type="text/css">
<!--
.page-header.navbar .top-menu .navbar-nav>li.dropdown>.dropdown-toggle>.badge {
    display: inline-block;
    font-family: "Open Sans",sans-serif;
    margin: -6px 0 0;
    font-weight: 600;
    padding: 6px 5px;
    height: 25px;
    font-size: 12px;
}
-->
</style><div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">

        <div class="page-logo">
            <input type="hidden" id="system_id" value="{pigcms{$_SESSION['system_id']}">
            <a href="/admin.php?g=System&c=Index&a=index_new" class="ggt" id="logo_a">
                <div style="margin:25px 10px 0; font-size:17px; font-weight:600;" id="logo_text"></div> </a>
            <div class="menu-toggler sidebar-toggler">

            </div>
        </div>

        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>


        <div class="page-actions">
            <div class="btn-group">
                <!--
                <div class="btn-group index_left_nav" data-toggle="buttons" style="float:left; margin-top:22px; margin-right:10px;">
                    <label class="btn red-haze active" onClick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Index&a=index_new';"> 智慧助手后台 </label>
                    <label class="btn" onClick="window.location.href='http://www.hdhsmart.com/Car/index.php?s=/Admin/Index/index/state/1';" style="color:#FFFFFF;"> 智慧停车场后台 </label>
                </div>-->
            </div>
        </div>
        <div class="col-md-13" style="margin-top:22px; width:11%; float:left;">
            <select class="bs-select form-control" id="select_session">
                <!--                <option value="" <if condition="$auth_village_id neq null" >style="display:none;"</if> >全部显示</option>-->
                <foreach name="villageArr" item="vo">
                    <option value="{pigcms{$vo.village_id}" <if condition="$auth_village_id eq $vo['village_id']">selected="selected"</if> >{pigcms{$vo.village_name}</option>
                </foreach>
            </select>
        </div>
        <if condition="!empty($project)">
            <div class="col-md-4" style="margin-top:22px; width:11%; float:left;">
                <select class="bs-select form-control" id="project_session">
                    <!--                <option value="" <if condition="$auth_village_id neq null" >style="display:none;"</if> >全部显示</option>-->
                    <foreach name="project" item="vo">
                        <option value="{pigcms{$vo.pigcms_id}" <if condition="$_SESSION['project_id'] eq $vo['pigcms_id']">selected="selected"</if> >{pigcms{$vo.desc}</option>
                    </foreach>
                </select>
            </div>
        </if>
        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
            <form class="search-form" action="#" method="post">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" placeholder="请输入关键词" name="query">
                    <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                </div>
            </form>
            <div class="btn-group index_left_nav2" data-toggle="buttons" style="float:left; margin-left:10px; margin-top:20px;">
                <label class="btn red-haze active" onClick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Index&a=index_new';"> 智慧助手后台 </label>
                <label class="btn" onClick="window.location.href='http://www.hdhsmart.com/Car/index.php?s=/Admin/Index/index.html';" style="color:#FFFFFF;"> 智慧停车场后台 </label>
            </div>
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">

                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <!-- DOC: Apply "dropdown-hoverable" class after "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                    <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                    <!-- BEGIN TODO DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <!-- END TODO DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <present name="warning_count">
                        <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar" style="width:75px;">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                                <i class="icon-bell"></i>
                                <span class="badge badge-danger"> {pigcms{$warning_count} </span>
                            </a>
                            <ul class="dropdown-menu" style="width: 180px; right:0; margin-top:10px; position:absolute;">
                                <li class="external">
                                    <h3>
                                        <span class="bold">{pigcms{$warning_count} 条</span> 警告信息</h3>
                                    <a href="{pigcms{:U('Warning/showlist')}">更多</a>
                                </li>
                                <li>
                                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;">
                                        <ul class="dropdown-menu-list scroller" style="height: 250px; overflow: hidden; width: auto;" data-handle-color="#637283" data-initialized="1">
                                            <foreach name="warning_array" item="vo">
                                                <li>
                                                    <a href="{pigcms{:U('Warning/warning_detail',array('pigcms_id'=>$vo['pigcms_id']))}">
                                                        <span class="time">{pigcms{$vo.create_time|date="Y-m-d",###}</span>
                                                        <span class="time">{pigcms{$vo.create_time|date="H:i:s",###}</span>
                                                        <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> {pigcms{$vo.warning_name} </span>
                                                    </a>
                                                </li>
                                            </foreach>
                                        </ul>
                                        <div class="slimScrollBar" style="background: rgb(99, 114, 131); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 121.359px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                                </li>
                            </ul>
                        </li>
                    </present>
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"> {pigcms{$Think.session.system.realname} </span>
                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                            <img alt="" class="img-circle" src="/Car/Admin/Public/assets/layouts/layout4/img/avatar9.jpg" /> </a>
                        <ul class="dropdown-menu dropdown-menu-default" style="right:0; margin-top:10px; position:absolute;">
                            <li>
                                <a href="http://www.hdhsmart.com/admin.php?g=System&c=Index&a=profile_news">
                                    <i class="icon-user"></i> 个人信息 </a>
                            </li>
                            <li>
                                <a href="http://www.hdhsmart.com/admin.php?g=System&c=Index&a=pass_news">
                                    <i class="icon-calendar"></i> 修改密码 </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="http://www.hdhsmart.com/admin.php?g=System&c=Login&a=logout_new">
                                    <i class="icon-key"></i> 退出 </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>


<div class="clearfix"></div>
<script>
    $("select#select_session").change(function(){
        var u = $(this).val();
        var str = window.location.href;
        var url = '';
        if(str.indexOf("default_village_id")>0){
            url = str.substring(0,str.length-21);
        }else{
            url = str;
        }
        location.href=url+'&default_village_id='+u;
    });
    $("#project_session").change(function(){
        var u = $(this).val();
        var str = window.location.href;
        var url = '';
        if(str.indexOf("default_project_id")>0){
            url = str.substring(0,str.length-21);
        }else{
            url = str;
        }
        location.href=url+'&default_project_id='+u;
    });
</script>