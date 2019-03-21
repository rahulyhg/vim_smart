<!DOCTYPE html>
<html>
<head>
    <title>商家充值|添加成员</title>
    <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/header.tpl.php';?>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>cashier/commonfunc.js"></script>
    <style type="text/css">
        .aui_outer .aui_border{width:700px;}
        .table_list td.td_checkbox{border:1px #dfdfdf solid;width:1%;height:42px;text-align:center;background-color:#ffffff;}
        .table_list td.td_left{border:1px #dfdfdf solid;border-left:none;font-family:'微软雅黑';font-size:14px;color:#3a6ea5;padding-left:10px;height:42px;text-align:left;background-color:#ffffff;}
        .table_list td.td_center{border:1px #dfdfdf solid;border-left:none;font-family:'微软雅黑';font-size:14px;color:#3a6ea5;height:42px;text-align:center;background-color:#f4f4f4;}
        .table_list td.td_checkbox2{border:1px #dfdfdf solid;border-top:none;height:42px;text-align:center}
        .table_list td.td_left2{border:1px #dfdfdf solid;border-top:none;border-left:none;font-family:'微软雅黑';font-size:14px;color:#727272;padding-left:10px;height:42px;text-align:left;}
        .table_list td.td_center2{border:1px #dfdfdf solid;border-top:none;border-left:none;font-family:'微软雅黑';font-size:14px;color:#3a6ea5;height:42px;text-align:center}
        .table_list .textcenter{text-align:center}
        .table_list td.td_center2 .clickChange{cursor:pointer}
.iconList {
    background: #ffffff;
    font-family: 'Microsoft Yahei',"微软雅黑",arial,"宋体",sans-serif;
}
.wrapper-content {
    padding: 20px 10px 30px 10px;
}
.ff {
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
	float:right;
	margin:0px auto;
	}
.ff:hover {background-color: #37ac3c;}
table {
    background-color: transparent;
    width: 100%;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
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
                        <a><?php echo $group_name;?></a>
                    </li>
                    <li>
                        <a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=user_manage&company_id=<?php echo $company_id;?>&group_id=<?php echo $group_id;?>">成员管理</a>
                    </li>
                    <li class="active">
                        <strong>添加成员</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight" style="background-color:#FFFFFF; margin-top:15px; border-top:4px #e7eaec solid;">
		<div class="wrapper page-heading iconList">
            <form action="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=au_submit" method="post">
                <input type="hidden" name="company_id" value="<?php echo $company_id;?>"/>
                <input type="hidden" name="group_id" value="<?php echo $group_id;?>"/>
                <table width="50%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px; margin-bottom:20px;" class="table_list">
                    <thead>
                        <tr>
                            <td class="td_checkbox"><input type="checkbox" class="td_checkbox"  name="checkbox" value="checkbox" onClick="checkAll(this)" /></td>
                            <td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">用户名</td>
                            <td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">联系电话</td>
                            <td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">证件类型</td>
                            <td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">证件号</td>
                            <td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">注册时间</td>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if(!empty($user)){
                        foreach($user as $value){
                        ?>
                            <tr>
                                <td class="td_checkbox2"><input type="checkbox"  name="checkbox2[]" value="<?php echo $value['uid']?>" /></td>
                                <td class="td_left" width="5%"><?php echo $value['name']?></td>
                                <td class="td_left" width="5%"><?php echo $value['phone']?></td>
                                <td class="td_left" width="5%"><?php if($value['card_type']==1){echo '现场审核';}elseif($value['card_type']==2){echo '门禁卡';}elseif($value['card_type']==3){echo '身份证';}elseif($value['card_type']==4){echo '工作牌';}?></td>
                                <td class="td_left" width="5%"><?php echo $value['usernum']?></td>
                                <td class="td_left" width="5%"><?php echo date('Y-m-d H:i:s',$value['add_time'])?></td>
                            </tr>

                        <?php }}else{?>
                             <tr><td colspan="10">暂无记录</td></tr>
                    <?php }?>
                    </tbody>
                </table>
                <?php echo $pagebar;?>
                <input type="submit" value="添加" class="ff"/>
            </form>
        </div>
		</div>
        <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/footer.tpl.php';?>
    </div>
</div>
<script>
    function checkAll(obj){
        $("input[type='checkbox']").prop('checked', $(obj).prop('checked'));
    }
    function user_manage(){
        window.location.href ="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=user_manage&company_id=<?php echo $company_id;?>&group_id=<?php echo $group_id;?>";
    }
</script>
</body>
</html>