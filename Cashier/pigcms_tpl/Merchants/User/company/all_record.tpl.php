<!DOCTYPE html>
<html>
<head>
    <title>充值中心</title>
    <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/header.tpl.php';?>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>cashier/commonfunc.js"></script>
    <style type="text/css">
        .iconList {
            background: #ffffff;
            font-family: 'Microsoft Yahei',"微软雅黑",arial,"宋体",sans-serif;
        }
        table {
            background-color: transparent;
            width: 100%;
        }
        .wrapper-content {
            padding: 20px 10px 30px 10px;
        }
		.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    	border-top: 1px solid #e7eaec;
  	    line-height: 1.42857;
   	    padding: 14px;
 	    vertical-align:middle;
		}
    </style>
</head>
<body>
<div id="wrapper">
    <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/company_leftmenu.tpl.php';?>
    <div id="page-wrapper" class="gray-bg">
        <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/top.tpl.php';?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>总充值记录</h2>
                <ol class="breadcrumb">
                    <li>
                        <a>User</a>
                    </li>
                    <li>
                        <a>company</a>
                    </li>
                    <li class="active">
                        <strong>all_record</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight" style="background-color:#FFFFFF; margin-top:15px; border-top:4px #e7eaec solid;">
        <div class="wrapper page-heading iconList">
            <table  class="table table-striped table-bordered table-hover">
<!--                <button onclick="merchant()">商户列表</button>-->
                <thead>
                <tr>
                    <th style="text-align: center;width: 5%">编号</th>
                    <th>姓名</th>
                    <th>充值商户</th>
                    <th>充值金额</th>
                    <th>充值人</th>
                    <th>充值时间</th>
                </tr>
                </thead>

                <tbody>
                <?php if(!empty($record)){
                    foreach($record as $value){
                        ?>
                        <tr>
                            <td style="text-align: center;width: 5%"><?php echo $value['number']?></td>
                            <td><?php echo $value['name']?></a></td>
                            <td><?php echo $value['merchant_name']?></td>
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
</script>
</body>
</html>