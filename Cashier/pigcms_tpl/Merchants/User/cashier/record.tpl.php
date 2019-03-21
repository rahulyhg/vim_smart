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
	float:left;
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
    <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/leftmenu.tpl.php';?>
    <div id="page-wrapper" class="gray-bg">
        <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/top.tpl.php';?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2><?php echo $company_info['company_name']?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=cashier&a=up">公司列表</a>
                    </li>
                    <li>
                        <a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=cashier&a=user_list&company_id=<?php echo $company_id;?>">员工列表</a>
                    </li>
                    <li class="active">
                        <strong>充值记录</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight" style="background-color:#FFFFFF; margin-top:15px; border-top:4px #e7eaec solid;">
		<div class="wrapper page-heading iconList">
            <table  class="table table-striped table-bordered table-hover" style="margin-top:20px;">
<!--                <button onClick="user_list()" class="fe">员工列表</button>-->
<!--                <button onClick="group()" class="fe2">分组管理</button>-->
                <thead>
                <tr>
                    <th style="text-align: center;">编号</th>
                    <th>姓名</th>
                    <th>充值金额</th>
                    <th>充值人</th>
                    <th>充值时间</th>
                </tr>
                </thead>

                <tbody>
                <?php if(!empty($arr)){
                    foreach($arr as $value){
                        ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $value['number']?></td>
                            <td><?php echo $value['name']?></a></td>
                            <td><?php echo $value['money']?></td>
                            <td><?php echo $value['recharge_name']?></td>
                            <td><?php echo date('Y-m-d H:i:s',$value['add_time'])?></td>
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
//    function merchant(){
//        window.location.href ="<?php //echo $this->SiteUrl;?>///merchants.php?m=User&c=company&a=index";
//    }
//    function user_list(){
//        window.location.href ="<?php //echo $this->SiteUrl;?>///merchants.php?m=User&c=cashier&a=user_list&company_id=<?php //echo $company_id;?>//";
//    }
//    function group(){
//        window.location.href ="<?php //echo $this->SiteUrl;?>///merchants.php?m=User&c=cashier&a=group&company_id=<?php //echo $company_id;?>//";
//    }
</script>
</body>
</html>