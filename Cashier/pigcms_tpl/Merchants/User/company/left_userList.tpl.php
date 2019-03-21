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
        .wrapper-content {
            padding: 20px 10px 30px 10px;
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
    <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/company_leftmenu.tpl.php';?>
    <div id="page-wrapper" class="gray-bg">
        <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/top.tpl.php';?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>员工列表</h2>
                <ol class="breadcrumb">
                    <li>
                        <a>User</a>
                    </li>
                    <li>
                        <a>company</a>
                    </li>
                    <li class="active">
                        <strong>user_list</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
		<div class="wrapper wrapper-content animated fadeInRight" style="background-color:#FFFFFF; margin-top:15px; border-top:4px #e7eaec solid;">
        <div class="wrapper page-heading iconList">
            <table  class="table table-striped table-bordered table-hover">
<!--                <button onclick="record()">充值记录</button>-->
<!--                <button onclick="group()">分组管理</button>-->
                <thead>
                <tr>
                    <th style="text-align: center;">编号</th>
                    <th>员工姓名</th>
                    <th>微信昵称</th>
                    <th>联系电话</th>
                    <th>证件类型</th>
                    <th>证件号</th>
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
                            <td style="text-align: center;"><?php echo $value['number']?></td>
                            <td><?php echo $value['name']?></td>
                            <td><?php echo $value['nickname']?></td>
                            <td><?php echo $value['phone']?></td>
                            <td><?php if($value['card_type']==1){echo '现场审核';}elseif($value['card_type']==2){echo '门禁卡';}elseif($value['card_type']==3){echo '身份证';}elseif($value['card_type']==4){echo '工作牌';}?></td>
                            <td><?php echo $value['usernum']?></td>
                            <td><?php if(empty($value['group_name'])) echo '无'; else{echo $value['group_name'];}?></td>
                            <td><?php echo date('Y-m-d H:i:s',$value['add_time'])?></td>
                            <td><div style="margin: 0px auto; width:144px;"><a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=company&a=user_edit&company_id=<?php echo $value['company_id']?>&uid=<?php echo $value['uid']?>"><div class="fe4">编辑</div></a>
                                <a class="del_user" data_user=<?php echo $value['uid']?> href=""><div class="fe5">删除</div></a>
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
    $('.del_user').click(function(){
       var result=confirm('您确定删除此员工吗？');
       var uid=$(this).attr('data_user');
       //var company_id=<?php echo $company_id;?>;
        //alert(uid);
        if(result==true){
            $.post('?m=User&c=company&a=uid_del',uid,function(ret){
                alert(ret);
                if(!ret.error){
                    alert(ret);
                }else{
                    alert(666);
                }
            },'json');
        }else{
            window.reload();
        }
    })
</script>
</body>
</html>