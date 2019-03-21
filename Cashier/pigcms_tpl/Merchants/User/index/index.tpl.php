<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>收银台 | 收银台</title>
    <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/header.tpl.php';?>
	
</head>

<body>
    <div id="wrapper">
	<?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/leftmenu.tpl.php';?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
        <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/top.tpl.php';?>
         <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>邻钱收银台管理系统</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a>User</a>
                        </li>
                        <li>
                            <a>Index</a>
                        </li>
                        <li class="active">
                            <strong>首页</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="row wrapper page-heading iconList">
                <ul>
					<li class="col-xs-4">
                        <a href="./merchants.php?m=User&c=cashier&a=money"><i class="fa fa-barcode animated bounceIn"></i>扫码枪收款</a>
                    </li>
                    <li class="col-xs-4">
                        <a href="./merchants.php?m=User&c=cashier&a=index"><i class="fa fa-inbox animated bounceIn"></i>收银台</a>
                    </li>
                    <li class="col-xs-4">
                        <a href="./merchants.php?m=User&c=cashier&a=payRecord"><i class="fa fa-qrcode animated bounceIn"></i>收款记录</a>
                    </li>
                    <li class="col-xs-4">
                        <a href="./merchants.php?m=User&c=cashier&a=ewmRecord"><i class="fa fa-inbox animated bounceIn"></i>二维码记录</a>
                    </li>
                    <li class="col-xs-4">
                        <a href="./merchants.php?m=User&c=statistics&a=index"><i class="fa fa-undo animated bounceIn"></i>收支统计</a>
                    </li>
                    <!--<li class="col-xs-4">
                        <a href="./merchants.php?m=User&c=wxCoupon&a=consumeCard"><i class="fa fa-money animated bounceIn"></i>卡券核销</a>
                    </li>-->
                    <li class="col-xs-4">
                        <a href="./merchants.php?m=User&c=merchant&a=employers"><i class="fa fa-pencil animated bounceIn"></i>员工管理</a>
                    </li>
                    <li class="col-xs-4">
                        <a href="./merchants.php?m=User&c=wxCoupon&a=wxReceiveList"><i class="fa fa-file-text-o animated bounceIn"></i>核销记录</a>
                    </li>
					<li class="col-xs-4">
                        <a href="./merchants.php?m=User&c=cashier&a=onLinepay"><i class="fa fa-calculator animated bounceIn"></i>快捷收银</a>
                    </li>
					<li class="col-xs-4">
                        <a href="./merchants.php?m=User&c=cashier&a=ewmChange"><i class="fa fa-qrcode animated bounceIn"></i>收款二维码</a>
                    </li>
					<!--<li class="col-xs-4">
                        <a href="./merchants.php?m=User&c=index&a=ModifyPwd"><i class="fa  fa-unlock-alt animated bounceIn"></i>修改密码</a>
                    </li>-->
                </ul>
            </div>
            </div>
        </div>
   <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/footer.tpl.php';?>
</body>
</html>