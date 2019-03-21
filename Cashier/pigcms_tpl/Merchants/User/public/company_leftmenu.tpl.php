<nav role="navigation" class="navbar-default navbar-static-side">
        <div class="sidebar-collapse">
            <ul id="side-menu" class="nav metismenu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
					   <?php if(!empty($this->merchant['logo'])){?>
                            <img src="<?php echo $this->merchant['logo'];?>" class="img-circle" alt="image" height="70px" width="70px">
							<?php }elseif(defined('RESOURCEURL')){?>
							  <img src="<?php echo RESOURCEURL;?>/pigcms_tpl/Merchants/Static/images/profile_small.jpg" class="img-circle" alt="image">
							<?php }elseif(defined('ABS_UPLOAD_PATH')){ ?>
							  <img src=".<?php echo ABS_UPLOAD_PATH;?>/pigcms_tpl/Merchants/Static/images/profile_small.jpg" class="img-circle" alt="image">
							<?php }else{?>
								<img src="./pigcms_tpl/Merchants/Static/images/profile_small.jpg" class="img-circle" style="width: 45px;height: 45px;">
							<?php }?>
                             </span>
                       <a href="javascript:;" class="dropdown-toggle">
                            <span class="clear">
                                <span class="block m-t-xs">
                                  <strong class="font-bold"><?php  echo $_SESSION['company_name'];?></strong>
                                </span>
                            </span>
                       </a>
                        <!--<ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>-->
                    </div>
					<div class="logo-element" style="text-align: center;">
					<?php if(!empty($this->merchant['logo'])){?>
                            <img src="<?php echo $this->merchant['logo'];?>" class="img-circle" style="width: 45px;height: 45px;">
							<?php }elseif(defined('RESOURCEURL')){?>
							  <img src="<?php echo RESOURCEURL;?>/pigcms_tpl/Merchants/Static/images/profile_small.jpg" class="img-circle" alt="image">
							<?php }elseif(defined('ABS_UPLOAD_PATH')){ ?>
							  <img src=".<?php echo ABS_UPLOAD_PATH;?>/pigcms_tpl/Merchants/Static/images/profile_small.jpg" class="img-circle" alt="image">
							<?php }else{?>
								<img src="./pigcms_tpl/Merchants/Static/images/profile_small.jpg" class="img-circle" style="width: 45px;height: 45px;">
							<?php }?>
					</div>
                </li>
				<li <?php if(ROUTE_CONTROL=='index' && ROUTE_ACTION=='index') echo 'class="active"';?>>
                    <a href="./merchants.php?m=User&c=company&a=index"><i class="fa fa-home"></i> <span class="nav-label">首页</span><span class="label label-info pull-right"></span></a>
                </li>

				<li <?php if(ROUTE_CONTROL=='company') echo 'class="active"';?>>
                    <a href="#"><i class="fa fa-laptop"></i> <span class="nav-label">员工充值</span><span class="label label-info pull-right">NEW</span></a>
                    <ul class="nav nav-second-level collapse <?php if(ROUTE_CONTROL=='company') echo 'in';?>">
					    <li <?php if(ROUTE_CONTROL=='cashier' && ROUTE_ACTION=='index' && $type==3) echo 'class="active"';?>><a href="./merchants.php?m=User&c=company&a=index">商户列表</a></li>
                        <li <?php if(ROUTE_CONTROL=='cashier' && ROUTE_ACTION=='left_userList' && $type==3) echo 'class="active"';?>><a href="./merchants.php?m=User&c=company&a=left_userList&company_id=<?php echo $company_id;?>">员工列表</a></li>
                        <li <?php if(ROUTE_CONTROL=='cashier' && ROUTE_ACTION=='left_group') echo 'class="active"';?>><a href="./merchants.php?m=User&c=company&a=left_group&company_id=<?php echo $company_id;?>">分组管理</a></li>
					    <li <?php if(ROUTE_CONTROL=='cashier' && ROUTE_ACTION=='all_record' && $type==3) echo 'class="active"';?>><a href="./merchants.php?m=User&c=company&a=all_record&company_id=<?php echo $company_id;?>">充值记录</a></li>
                        <li <?php if(ROUTE_CONTROL=='cashier' && ROUTE_ACTION=='all_record' && $type==3) echo 'class="active"';?>><a href="./merchants.php?m=User&c=company&a=consume_record&company_id=<?php echo $company_id;?>">消费记录</a></li>
						<!--<li <li <?php if(ROUTE_CONTROL=='cashier' && ROUTE_ACTION=='ewmRecord') echo 'class="active"';?>><a href="./company.php?m=Company&c=index&a=up_Record">充值记录</a></li>-->
					</ul>
                </li>


				<!--<li <?php if(ROUTE_CONTROL=='index' && ROUTE_ACTION=='ModifyPwd') echo 'class="active"';?>>
                    <a href="./merchants.php?m=User&c=index&a=ModifyPwd"><i class="fa fa-unlock-alt"></i> <span class="nav-label">修改密码</span><span class="label label-info pull-right"></span></a>
                </li>-->
            </ul>

        </div>
    </nav>

武汉邻钱网络科技有限公司