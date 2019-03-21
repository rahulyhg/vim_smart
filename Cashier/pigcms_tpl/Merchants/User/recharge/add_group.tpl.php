<!DOCTYPE html>
<html>
<head>
    <title>商家充值|分组管理</title>
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
    color: #FFFFFF;
    border: none;
	float:left;
    font-size: 14px;
	margin-left:15px;
}
.fe2:hover {background-color: #eda04c;}
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
    padding: 20px 10px 30px 10px;
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
                        <a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=user_list&company_id=<?php echo $company_id;?>">员工列表</a>
                    </li>
                    <li>
                        <a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=group&company_id=<?php echo $company_id;?>">分组管理</a>
                    </li>
                    <li class="active">
                        <strong>添加分组</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
		<div class="wrapper wrapper-content animated fadeInRight" style="background-color:#FFFFFF; margin-top:15px; border-top:4px #e7eaec solid;">
        <div class="wrapper page-heading iconList">
<!--            <button onclick='user_list()' class="fe">员工列表</button>-->
<!--            <button onclick='record()' class="fe2">充值记录</button>-->
<!--            <button onclick='group()' class="fe3">分组管理</button>-->
            <form action="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=ag_submit" method="post">
                <input type="hidden" name="company_id" value="<?php echo $company_id;?>"/>
                <table>
                    <tr>
                        <td><div style="width:100%; margin-top:20px;"><label>分组名称</label></div>
							<div style="width:100%; margin-top:10px;"><input type="text" name="group_name" style="width:100%; border:1px #44b549 solid; color:#676a6c; font-size:13px; padding:10px; outline:none;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><div style="width:100%; margin-top:20px;"><label>描述</label></div>
                           <div style="width:100%;"><input type="text" name="desc" style="width:100%; outline:none; border:1px #44b549 solid; background-color:#FFFFFF; color:#676a6c; font-size:13px; padding:10px;"></div></td>
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
//    function group() {
//        window.location.href = "<?php //echo $this->SiteUrl;?>///merchants.php?m=User&c=recharge&a=group&company_id=<?php //echo $company_id;?>//";
//    }
</script>
</body>
</html>