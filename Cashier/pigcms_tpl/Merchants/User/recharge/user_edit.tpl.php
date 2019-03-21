<!DOCTYPE html>
<html>
<head>
    <title>商家充值|员工编辑</title>
    <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/header.tpl.php';?>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>cashier/commonfunc.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
.iconList {
    background: #ffffff;
    font-family: 'Microsoft Yahei',"微软雅黑",arial,"宋体",sans-serif;
}
table {
    background-color: transparent;
    width: 100%;
}
.fe3{
    border-radius: 4px;
    padding: 5.5px 12px;
    text-align: center;
    vertical-align: middle;
    background-color: #44b549;
    border-color: #44b549;
    color: #FFFFFF;
    border: none;
	float:left;
    font-size: 14px;
	margin-left:15px;
}
.fe3:hover {background-color: #2fa434;}
.wrapper-content {
    padding: 20px 10px 40px 10px;
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
<!--                    <li>-->
<!--                        <a href="--><?php //echo $this->SiteUrl;?><!--/merchants.php?m=User&c=recharge&a=up">商家充值</a>-->
<!--                    </li>-->
                    <li>
                        <a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=user_list&company_id=<?php echo $company_id;?>">员工列表</a>
                    </li>
                    <li class="active">
                        <strong>员工编辑</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight" style="background-color:#FFFFFF; margin-top:15px; border-top:4px #e7eaec solid;">
	    <div class="wrapper page-heading iconList">
<!--            <button onclick="group()">分组管理</button>-->
            <form action="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=ue_submit" method="post">
                <input type="hidden" name="company_id" value="<?php echo $company_id;?>"/>
                <input type="hidden" name="group_id" value="<?php echo $group_id;?>"/>
                <input type="hidden" name="uid" value="<?php echo $_GET['uid']?>"/>
                <table>
                    <tr>
                        <td>
							<div style="width:100%; margin-top:20px;"><label>姓名</label></div>
                            <div style="width:100%;"><input type="text" name="name" value="<?php echo $user_name["name"]?>" style="width:100%; outline:none; border:1px #44b549 solid; background-color:#FFFFFF; color:#676a6c; font-size:13px; padding:10px;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
							<div style="width:100%; margin-top:20px;"><label>联系电话</label></div>
                            <div style="width:100%;"><input type="text" name="phone" value="<?php echo $user["phone"]?>" style="width:100%; outline:none; border:1px #44b549 solid; background-color:#FFFFFF; color:#676a6c; font-size:13px; padding:10px;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><div style="width:100%; margin-top:20px;"><label>选择分类</label></div>
                            <div style="width:100%;"><select name="group_id" style="width:100%; height:40px; border:1px #f8ac59 solid; padding:10px; font-size:13px;">
                                <option value="0" selected="selected">请选择</option>
                                <?php if(!empty($group)){
                                    foreach($group as $value){
                                        ?>
                                        <option value="<?php echo $value['group_id']?>" <?php if($value['group_id']==$user['group_id']){echo 'selected';}?>><?php echo $value['group_name'];?></option>
                                    <?php }?>
                                <?php }?>
                            </select></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="margin-top:25px; float:right;">
                            <input type="submit" value="保存" class="fe3"/></td>
                    </tr>
                </table>
            </form>
        </div>
		</div>
        <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/footer.tpl.php';?>
    </div>
</div>
<script>
//    function user_list(){
//        window.location.href ="<?php //echo $this->SiteUrl;?>///merchants.php?m=User&c=recharge&a=user_list&company_id=<?php //echo $company_id;?>//";
//    }
//    function record(){
//        window.location.href ="<?php //echo $this->SiteUrl;?>///merchants.php?m=User&c=recharge&a=record&company_id=<?php //echo $company_id;?>//";
//    }
//    function group(){
//        window.location.href ="<?php //echo $this->SiteUrl;?>///merchants.php?m=User&c=recharge&a=group&company_id=<?php //echo $company_id;?>//";
//    }
</script>
</body>
</html>