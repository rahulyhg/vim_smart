<!DOCTYPE html>
<html>
<head>
    <title>商家充值|成员管理</title>
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
	margin-left:15px;
	float:left;
	}
.fe4:hover {background-color: #de4756;}
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
.ff2 {
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
.ff2:hover {background-color: #de4756;}
    </style>
</head>
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
                    <li>
                        <a><?php echo $this_group['group_name'];?></a>
                    </li>
                    <li class="active">
                        <strong>成员管理</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
		<div class="wrapper wrapper-content animated fadeInRight" style="background-color:#FFFFFF; margin-top:15px; border-top:4px #e7eaec solid;">
        <div class="wrapper page-heading iconList">
<!--           <button onClick="user_list()" class="fe">员工列表</button>-->
<!--           <button onClick="record()" class="fe2">充值记录</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
           <button onClick="add_user()" class="fe">添加组员</button>
           <button onClick="all_del()" class="fe4">批量删除</button>
		   <div style="clear:both"></div>


            <form action="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=move_user" method="post" style="margin-top:20px;">
                <label style="font-size:14px;">移至</label>
                <select name="group_id" style="border:1px #d1d1d1 solid; width: 100px; height: 26px; font-size: 14px; line-height: 26px;">
                    <option value="0" selected="selected">请选择</option>
                    <?php if(!empty($group)){
                        foreach($group as $value){
                            ?>
                            <option value="<?php echo $value['group_id']?>" <?php if($value['group_id']==$user['group_id']){echo 'selected';}?>><?php echo $value['group_name'];?></option>
                        <?php }?>
                    <?php }?>
                </select>
                <input type="hidden" name="company_id" value="<?php echo $company_id;?>"/>
                <input type="hidden" name="uid" value="<?php echo $uid;?>"/>
                <input type="hidden" name="this_group_id" value="<?php echo $group_id;?>"/>
                <div class="out">
                <table width="50%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px; margin-bottom:20px;" class="table_list">
                    <thead>
                    <tr>
                        <td class="td_checkbox"><input type="checkbox" class="td_checkbox"  name="checkbox" value="checkbox" onClick="checkAll(this)" /></td>
                        <td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">用户名</td>
                        <td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">联系电话</td>
                        <td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">证件类型</td>
                        <td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">证件号</td>
                        <td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">注册时间</td>
                        <td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000; text-align:center;">操作</td>
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
                                <td class="td_left" width="5%"><?php echo date('Y-m-d H:i:s',$value['add_time']);?></td>
                                <td class="td_left" width="5%"><a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=user_del&company_id=<?php echo $company_id;?>&group_id=<?php echo $group_id;?>&uid=<?php echo $value['uid']?>"><div class="ff2">删除</div></a></td>
                            </tr>
                        <?php }}else{?>
                        <tr><td colspan="10">暂无记录</td></tr>
                    <?php }?>
                    </tbody>
                </table>
                <?php echo $pagebar;?>
                </div>
                <input type="submit" value="保存" class="ff"/>
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
    function add_user(){
        window.location.href ="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=add_user&company_id=<?php echo $company_id;?>&group_id=<?php echo $group_id;?>";
    }

//    function user_list(){
//        window.location.href ="<?php //echo $this->SiteUrl;?>///merchants.php?m=User&c=recharge&a=user_list&company_id=<?php //echo $company_id;?>//";
//    }
//    function record(){
//        window.location.href ="<?php //echo $this->SiteUrl;?>///merchants.php?m=User&c=recharge&a=record&company_id=<?php //echo $company_id;?>//";
//    }
    function all_del(){
        checkbox2=$("input[name='checkbox2[]']");
        var uid_arr=new Array();
        var group_id=<?php echo $group_id;?>;
        var company_id=<?php echo $company_id;?>;
        for(var i=0;i<checkbox2.length;i++){
            //alert(checkbox2[i].checked);
            if(checkbox2[i].checked==true){	//判断是否被选中
                uid_arr[i]=checkbox2[i].value;
            }
        }
        //alert(uid_arr);
        if(uid_arr=="" || uid_arr=="null"){
            alert('请选择用户！');
        }else{
            $.ajax({
                'url':"?m=User&c=recharge&a=all_del",
                'data':{'uid_arr':uid_arr,'group_id':group_id,'company_id':company_id},
                'type':'POST',
                'dataType':'JSON',
                'success':function(msg){
                    //alert(msg.msg);
                    if(msg.msg_code==0){
                        $('.out').html("");
                        $('.out').append(msg.msg_data);
                        //alert(uid_arr.length);
                    }else{
                        alert(msg.msg_data);
                    }
                },
                'error':function(){
                    alert('loading error');
                }
            })
        }
    }
</script>
</body>
</html>