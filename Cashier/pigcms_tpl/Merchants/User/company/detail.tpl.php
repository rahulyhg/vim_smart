<!DOCTYPE html>
<html>
<head>
    <title>充值中心</title>
    <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/header.tpl.php';?>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>cashier/commonfunc.js"></script>
    <link href="<?php echo $this->RlStaticResource;?>plugins/css/iCheck/custom.css" rel="stylesheet">

    <link href="<?php echo $this->RlStaticResource;?>plugins/css/datapicker/datepicker3.css" rel="stylesheet">
    <script src="<?php echo $this->RlStaticResource;?>plugins/js/chartJs/Chart.min.js"></script>
    <!-- Data picker -->
    <script src="<?php echo $this->RlStaticResource;?>plugins/js/datapicker/bootstrap-datepicker.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--

#dataselect .input-group-btn,#ym-select .input-group-btn{width: 12%;}
#dataselect .input-sm ,#ym-select .input-sm{ border-radius: 7px; height:40px;}
#dataselect .btn-primary ,#ym-select .btn-primary{ margin-left: 20px; border-radius:4px;margin-bottom: 0px;}
#dataselect .input-group-addon,#ym-select .input-group-addon{border-radius: 7px;}
.ibox-content{ min-height:550px;}
.input-group .form-control{width: 45%;float:none;}





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
                        <a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=company&a=index">商户列表</a>
                    </li>
                    <li>
                        <a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=company&a=user_list&company_id=<?php echo $_GET['company_id'];?>&mid=<?php echo $_GET['mid'];?>">员工列表</a>
                    </li>
                    <li class="active">
                        <strong><?php echo $user_name?></strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight" style="background-color:#FFFFFF; margin-top:15px; border-top:4px #e7eaec solid;">
		<div class="wrapper page-heading iconList">
            <form action="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=company&a=detail" method="get">
                <input type="hidden" name="m" value="User"/>
                <input type="hidden" name="c" value="company"/>
                <input type="hidden" name="a" value="detail"/>
                <input type="hidden" name="company_id" value='<?php echo $_GET['company_id'];?>'/>
                <input type="hidden" name="mid" value="<?php echo $_GET['mid'];?>"/>
                <input type="hidden" name="uid" value="<?php echo $_GET['uid'];?>"/>
                <select name="searchtype">
                    <option selected="selected" value="0">请选择</option>
                    <option value="out" <?php if ($_GET['searchtype']=='out'){echo 'selected';}?>>支出</option>
                    <option value="in" <?php if ($_GET['searchtype']=='in'){echo 'selected';}?>>收入</option>
                </select><br>
                <div id="datepicker" class="input-daterange input-group">
                    <input type="text" value="<?php echo $_GET['startDate'];?>" name="startDate" placeholder="请输入起始时间" class="input-sm form-control" id="datestart">
                    &nbsp;<span> T O </span>&nbsp;
                    <input type="text" value="<?php echo $_GET['endDate'];?>" name="endDate" placeholder="请输入结束时间" class="input-sm form-control" id="dateend">
                </div>
                <input type="submit" value="查询" class="button"/>
            </form>
            <table  class="table table-striped table-bordered table-hover" style="margin-top:20px;">
                <thead>
                <tr>
                    <th>创建时间</th>
                    <th>交易单号</th>
                    <th>交易对方</th>
                    <th>收入</th>
                    <th>支出</th>
                    <th>账户余额</th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                <?php if(!empty($list)){
                    foreach($list as $value){
                        ?>
                        <tr>
                            <td><?php echo date('Y-m-d H:i:s',$value['time'])?></td>
                            <td><?php echo $value['order_id']?></td>
                            <td><?php echo $value['name']?></td>
                            <td><?php if($value['type']==1){echo '+'.$value['money'];}?></td>
                            <td><?php if($value['type']==2){echo '-'.$value['money'];}?></td>
                            <td><?php echo $value['now_money']?></td>
                            <td>详情</td>
                        </tr>
                    <?php }}else{?>
                    <tr><td colspan="10">暂无记录</td></tr>
                <?php }?>
                </tbody>
            </table>
        </div>
		</div>
        <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/footer.tpl.php';?>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function() {
        $('#datepicker input').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });
</script>
</body>
</html>