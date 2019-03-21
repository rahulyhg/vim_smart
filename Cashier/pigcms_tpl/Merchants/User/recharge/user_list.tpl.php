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
    color: #FFFFFF;
    border: none;
    font-size: 14px;
    float: left;
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
.fe4 {
    border-radius: 4px;
    padding: 5.5px 12px;
    text-align: center;
    vertical-align: middle;
    background-color: #44b549;
    border-color: #44b549;
    color:#FFFFFF;
    border:none;
    font-size:14px;
    width:52px;
    float: left;
    margin-left: 10px;
    margin-right: 10px;
}
.fe4:hover {background-color: #37ac3c;}
.fe5 {
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
    float: left;
    margin-left: 10px;
    margin-right: 10px;
}
.fe5:hover {background-color: #de4756;}
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
                        <a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=index&a=index">收银台</a>
                    </li>
                    <li>
                        <a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=up">公司列表</a>
                    </li>
                    <li class="active">
                        <strong>员工列表</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
		<div class="wrapper wrapper-content animated fadeInRight" style="background-color:#FFFFFF; margin-top:15px; border-top:4px #e7eaec solid;">
        <div class="wrapper page-heading iconList">

            <table  class="table table-striped table-bordered table-hover" style="margin-top:20px;">
                <button onClick="record()" class="fe">充值记录</button>
                <button onClick="group()" class="fe2">分组管理</button>
                <thead>
                <tr>
                    <th style="text-align: center;">编号</th>
                    <th>员工姓名</th>
                    <th>微信昵称</th>
                    <th>联系电话</th>
                    <th>证件类型</th>
                    <th>证件号</th>
                    <th>余额</th>
                    <th>所属分组</th>
                    <th>注册时间</th>
                    <th style="text-align:center;">操作</th>
                </tr>
                </thead>

                <tbody>
                <?php if(!empty($user_list)){
                    foreach($user_list as $value){
                        ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $value['number']?></td>
                            <td><?php echo $value['name']?></a></td>
                            <td><?php echo $value['nickname']?></a></td>
                            <td><?php echo $value['phone']?></a></td>
                            <td><?php if($value['card_type']==1){echo '现场审核';}elseif($value['card_type']==2){echo '门禁卡';}elseif($value['card_type']==3){echo '身份证';}elseif($value['card_type']==4){echo '工作牌';}?></td>
                            <td><?php echo $value['usernum']?></td>
                            <td><?php if(!empty($value['money']))echo $value['money'];else{echo '0.00';}?></td>
                            <td><?php if(empty($value['group_name'])) echo '无'; else{echo $value['group_name'];}?></a></td>
                            <td><?php echo date('Y-m-d H:i:s',$value['add_time'])?></td>
                            <td><div style="margin: 0px auto; width:144px;"><a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=user_recharge&company_id=<?php echo $value['company_id']?>&uid=<?php echo $value['uid']?>"><div class="fe4">充值</div></a>
                            <a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=user_edit&company_id=<?php echo $value['company_id']?>&uid=<?php echo $value['uid']?>"><div class="fe5">编辑</div></a>
                            </div></td>
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
    function record(){
        window.location.href ="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=record&company_id=<?php echo $company_id;?>";
    }
//    function merchant(){
//        window.location.href ="<?php //echo $this->SiteUrl;?>///merchants.php?m=User&c=company&a=index";
//    }
    function group(){
        window.location.href ="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=group&company_id=<?php echo $company_id;?>";
    }
</script>
</body>
</html>