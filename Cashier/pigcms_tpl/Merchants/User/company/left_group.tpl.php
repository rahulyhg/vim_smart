<!DOCTYPE html>
<html>
<head>
    <title>充值中心</title>
    <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/header.tpl.php';?>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>cashier/commonfunc.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
.iconList {
    background: #ffffff;
    font-family: 'Microsoft Yahei',"微软雅黑",arial,"宋体",sans-serif;
}
.fe {
	border-radius: 4px;
	padding: 5.5px 12px;
	text-align: center;
	vertical-align: middle;
	background-color: #1c84c6;
	border-color: #1c84c6;
	color:#FFFFFF;
	border:none;
	font-size:14px;
	}
.fe:hover {background-color: #147bbc;}
.fe2 {
	border-radius: 4px;
	padding: 5.5px 12px;
	text-align: center;
	vertical-align: middle;
	background-color: #f8ac59;
	border-color: #f8ac59;
	color:#FFFFFF;
	border:none;
	font-size:14px;
	margin-left:15px;
	}
.fe2:hover {background-color: #efa24f;}
.kd {width:52px; margin:0px auto;}
.kd2 {width:82px; margin:0px auto;}
.fe4 {
	border-radius: 4px;
	padding: 5.5px 12px;
	text-align: center;
	vertical-align: middle;
	background-color: #ed5565;
	border-color: #ed5565;
	color:#FFFFFF;
	border:none;
	font-size:14px;
	width:52px;
	margin:0px auto;
	}
.fe4:hover {background-color: #de4756;}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    border-top: 1px solid #e7eaec;
    line-height: 1.42857;
    padding: 14px;
    vertical-align:middle;
}
-->
</style></head>
<body>
<div id="wrapper">
    <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/company_leftmenu.tpl.php';?>
    <div id="page-wrapper" class="gray-bg">
        <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/top.tpl.php';?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>分组管理</h2>
                <ol class="breadcrumb">
                    <li>
                        <a>User</a>
                    </li>
                    <li>
                        <a>company</a>
                    </li>
                    <li class="active">
                        <strong>group</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight" style="background-color:#FFFFFF; margin-top:15px; border-top:4px #e7eaec solid;">
		<div class="wrapper page-heading iconList">
            <table  class="table table-striped table-bordered table-hover" style="margin-top:20px;">
<!--                <button onclick="merchant()">商户列表</button>-->
<!--                <button onclick="record()">充值记录</button>-->
               <button onclick='add_group()' class="fe">添加分组</button>
                <thead>
                <tr>
                    <th style="text-align: center;width: 5%;">编号</th>
                    <th>分组名称</th>
                    <th>成员人数</th>
                    <th>描述</th>
                    <th style="text-align:center;">成员管理</th>
                    <th style="text-align:center;">操作</th>
                </tr>
                </thead>

                <tbody>
                <?php if(!empty($arr)){
                    foreach($arr as $value){
                        ?>
                        <tr>
                            <td style="text-align: center;width: 5%;"><?php echo $value['number']?></a></td>
                            <td><?php echo $value['group_name']?></a></td>
                            <td><?php echo $value['count']?></td>
                            <td><?php echo $value['desc']?></td>
                            <td><a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=company&a=user_manage&company_id=<?php echo $value['company_id']?>&group_id=<?php echo $value['group_id']?>"><div class="fe kd2">成员管理</div></a></td>
                            <td>
							<div style="margin: 0px auto; width:144px;">
							<div style="float:left; margin-left:10px; margin-right:10px;"><a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=company&a=group_edit&company_id=<?php echo $value['company_id']?>&group_id=<?php echo $value['group_id']?>"><div class="fe2 kd">编辑</div></a></div>
                            <div style="float:left; margin-left:10px; margin-right:10px;"><a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=company&a=group_del&company_id=<?php echo $value['company_id']?>&group_id=<?php echo $value['group_id']?>"><div class="fe4">删除</div></a></div>
							<div style="clear:both"></div>
                            </div>
                            </td>
                        </tr>
                    <?php }}else{?>
                    <tr><td colspan="10">暂无记录</td></tr>
                <?php }?>

                </tbody>

            </table>
            <?php if($record_count && $pagebar){?><div style='float: left;line-height: 26px;'><?php echo $record_count.'条记录'?></div><?php }?> <?php echo $pagebar;?>
        </div>
		</div>
        <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/footer.tpl.php';?>
    </div>
</div>
<script>
    function merchant(){
        window.location.href ="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=company&a=index";
    }
    function record(){
        window.location.href ="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=company&a=all_record&company_id=<?php echo $company_id;?>";
    }
    function add_group(){
        window.location.href ="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=company&a=add_group&company_id=<?php echo $company_id;?>";
    }
</script>
</body>
</html>