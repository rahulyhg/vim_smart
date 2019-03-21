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
    <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/company_leftmenu.tpl.php';?>
    <div id="page-wrapper" class="gray-bg">
        <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/top.tpl.php';?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2><?php echo $merchant_name?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=company&a=user_list&company_id=<?php echo $company_id;?>&mid=<?php echo $mid;?>">员工列表</a>
                    </li>
                    <li>
                        <a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=company&a=group&company_id=<?php echo $company_id;?>&mid=<?php echo $mid;?>">分组管理</a>
                    </li>
                    <li class="active">
                        <strong>分组充值</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight" style="background-color:#FFFFFF; margin-top:15px; border-top:4px #e7eaec solid;">
		<div class="wrapper page-heading iconList">
<!--            <button onclick="user_list()">员工列表</button>-->
<!--            <button onclick="record()">充值记录</button>-->
<!--            <button onclick="group()">分组管理</button>-->
            <form action="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=company&a=gr_submit" method="post">
                <input type="hidden" name="group_id" value="<?php echo $group_id;?>"/>
                <input type="hidden" name="mid" value="<?php echo $mid;?>"/>
                <input type="hidden" name="company_id" value="<?php echo $company_id;?>"/>
                <table>
                    <tr>
                        <td><div style="width:100%;"><label>分组名称</label></div>
                            <div style="width:100%; margin-top:10px;"><input type="text" name="name" value="<?php echo $result["group_name"]?>" style="width:100%; border:1px #e5e6e7 solid; background-color:#eeeeee; color:#676a6c; font-size:13px; padding:10px; outline:none;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><div style="width:100%; margin-top:20px;"><label>充值金额</label></div>
                            <div style="width:100%;"><input type="text" name="money" style="width:100%; outline:none; border:1px #44b549 solid; background-color:#FFFFFF; color:#676a6c; font-size:13px; padding:10px;"></div></td>
                    </tr>
                    <tr>
                        <td style="margin-top:25px; float:right;">
                            <input class="fe3" type="button" value="保存"/></td>
                    </tr>
                </table>
            </form>
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
//        window.location.href ="<?php //echo $this->SiteUrl;?>///merchants.php?m=User&c=company&a=user_list&company_id=<?php //echo $company_id;?>//&mid=<?php //echo $mid;?>//";
//    }
//    function record(){
//        window.location.href ="<?php //echo $this->SiteUrl;?>///merchants.php?m=User&c=company&a=record&company_id=<?php //echo $company_id;?>//&mid=<?php //echo $mid;?>//";
//    }
//    function group(){
//        window.location.href ="<?php //echo $this->SiteUrl;?>///merchants.php?m=User&c=company&a=group&company_id=<?php //echo $company_id;?>//&mid=<?php //echo $mid;?>//";
//    }
    $('.fe3').click(function () {
        var group_id=<?php echo $group_id;?>;
        var mid=<?php echo $mid;?>;
        var company_id=<?php echo $company_id;?>;
        var money=$("input[name='money']").val();
        if(money<0 || money==0){
            alert('请输入正确金额！');
            return false;
        }
        var result=confirm('您确定为当前组每人充值'+money+'元？');
        if(result==true){
            //alert(2);
            $.ajax({
                'url':"?m=User&c=company&a=gr_submit",
                'data':{'group_id':group_id,'mid':mid,'company_id':company_id,'money':money},
                'type':'POST',
                'dataType':'JSON',
                'success':function(ret){
                    if(ret.error==0){
                        alert(ret.msg);
                        window.location.href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=company&a=group&company_id=<?php echo $company_id;?>&mid=<?php echo $mid;?>";
                    }else{
                        alert(ret.msg);
                    }
                },
                'error':function(){
                    alert('loading error');
                }
            })
        }
    })
</script>
</body>
</html>