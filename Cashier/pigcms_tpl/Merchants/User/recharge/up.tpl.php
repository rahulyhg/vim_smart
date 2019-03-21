<!DOCTYPE html>
<html>
<head>
    <title>充值中心</title>
    <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/header.tpl.php';?>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>cashier/commonfunc.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
.fe {background-color: #FFFFFF;
    background-image: none;
    border: 1px solid #e5e6e7;
    border-radius: 1px;
    color: inherit;
    display: block;
    padding: 5px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    font-size: 14px;
	outline: none;
	float:left;}
	
.fe2 {
	float:left;
	border-radius: 4px;
	padding: 5.5px 12px;
	text-align: center;
	vertical-align: middle;
	background-color: #f8ac59;
	border-color: #f8ac59;
	color:#FFFFFF;
	border:none;
	font-size:14px;
	margin-left:10px;
	}
.fe2:hover {background-color: #efa24f;}

.fe3 {
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
	margin-left:13px;
	}
.fe3:hover {background-color: #147bbc;}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    border-top: 1px solid #e7eaec;
    line-height: 1.42857;
    padding: 10px;
    vertical-align: middle;
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
.table-bordered {
    border: 1px solid #EBEBEB;
    background-color: #ffffff;
}
.wrapper-content {
    padding: 20px 20px 80px 20px;
}
.pagination {
    display: inline-block;
    padding-left: 0;
    margin: 15px 0;
    border-radius: 4px;
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
                <h2>公司列表</h2>
                <ol class="breadcrumb">
                    <li>
                        <a>User</a>
                    </li>
                    <li>
                        <a>recharge</a>
                    </li>
                    <li class="active">
                        <strong>up</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>

        <div class="page-content">
            <div class="page-content-area">
                <div class="row">
                    <div class="col-xs-12">
					<div class="wrapper wrapper-content animated fadeInRight" style="background-color:#FFFFFF; margin-top:15px; border-top:4px #e7eaec solid;">
                        <div class="tabbable">
                            <div class="tab-content">
                                <div class="tab-pane active">
                                    <div id="shopList" class="grid-view">
                                        <tr>
                                            <td>
                                                <div style="float:left; padding-bottom:16px;"><form action="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=up" method="post">
                                                    <input type="text" name="keyword" placeholder="请输入查询内容" class="fe">
                                                    <input type="submit" value="查询"  class="fe2"/>
													<div style="clear:both"></div>
                                                </form></div>
                                                <div class="fe3"><a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=all_record" style="color:#FFFFFF;">充值记录</a></div>
												<div style="clear:both"></div>
                                            </td>
                                        </tr>
                                        <table  class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th style="text-align:center ;width:5%">编号</th>
                                                <th style="width:60% ;">公司名称</th>
                                                <th style="width:10% ;">公司人数</th>
                                                <th style="width:10% ;">余额</th>
                                                <th style="text-align:center;width: 10%">操作</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php if(!empty($list)){
                                            foreach($list as $key =>$value){
                                            ?>
                                            <tr>
                                                <td style="text-align:center;"><?php echo $value['number'];?></td>
                                               <td><a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=user_list&company_id=<?php echo $value['company_id']?>"><?php echo $value['name']?></a></td>
                                                <td><a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=user_list&company_id=<?php echo $value['company_id']?>"><?php echo $value['count']?></a></td>
                                               <td><?php if(!empty($value['money']))echo $value['money'];else{echo '0.00';}?></td>
                                               <td><div style="margin: 0px auto; width:144px;"><a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=company_recharge&company_id=<?php echo $value['company_id']?>"><div class="fe4">充值</div></a>
                                                   <a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=company_rechargeHistory&company_id=<?php echo $value['company_id']?>"><div class="fe5">明细</div></a>
                                                   </div>
                                               </td>
                                            </tr>
                                            <?php }}else{?>
                                                <tr><td colspan="10">暂无记录</td></tr>
                                            <?php }?>
                                            </tbody>
                                        </table>
                                        <?php if($arr && $pagebar){?><div style='float: left;line-height: 58px;'><?php echo $arr.'条记录'?></div><?php }?> <?php echo $pagebar;?>
                                    </div>
                                </div>
                            </div>
                        </div>
						</div>
                    </div>
                </div>
            </div>
        </div>
        <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/footer.tpl.php';?>
    </div>
</div>
<script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>cashier/commonfunc.js"></script>
<script type="text/javascript">
    $(function(){
        jQuery(document).on('click','#shopList a.red',function(){
            if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;
        });
    });
    function CreateShop(){
//        window.location.href = "{pigcms{:U('recharge/addCoupon', array('id' => $thisCard['id']))}";
        window.location.href = "<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=addCoupon";
    }
    function couponStatistics(){
        window.location.href = "<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=couponStatistics";
    }
    function Administration (){
        window.location.href = "<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=recharge&a=bill";
    }
    function drop_confirm(msg, url)
    {
        if (confirm(msg)) {
            window.location.href = url;
        }
    }
</script>
</body>
</html>