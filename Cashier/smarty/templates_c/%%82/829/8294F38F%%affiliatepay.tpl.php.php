<?php /* Smarty version 2.6.18, created on 2015-10-23 06:06:09
         compiled from C:%5CWWW%5CCashier%5C./pigcms_tpl/Merchants/System/index/affiliatepay.tpl.php */ ?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理后台 | 特约商户支付列表</title>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tplHome'])."/System/public/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<link href="<?php echo @PIGCMS_TPL_STATIC_PATH; ?>
wxCoupon/wxCoupon.css" rel="stylesheet">
	<link href="<?php echo @RlStaticResource; ?>
plugins/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">
	<link href="<?php echo @RL_PIGCMS_STATIC_PATH; ?>
plugins/css/footable/footable.core.css" rel="stylesheet">
	<link href="<?php echo @RlStaticResource; ?>
plugins/css/iCheck/custom.css" rel="stylesheet">
	<script src="<?php echo @RlStaticResource; ?>
plugins/js/footable/footable.all2.min.js"></script>
	<script src="<?php echo @RlStaticResource; ?>
plugins/js/iCheck/icheck.min.js"></script>
	<style type="text/css">
	#listfootable .fa-edit{ color: #3DA142;font-size: 20px;}
	#listfootable .tips{ color: #3DA142;cursor: pointer;}
	#listfootable .tips span{ display: none;} 
	#listfootable .prelative .form-control {
    display: none;
    vertical-align: middle;
    width: auto;
	height: 30px;
	padding: 3px 10px;
 }
	</style>
</head>
<body>
    <div id="wrapper">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tplHome'])."/System/public/leftmenu.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tplHome'])."/System/public/top.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
         <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>管理后台</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a>System</a>
                        </li>
                        <li>
                            <a>index</a>
                        </li>
                        <li class="active">
                            <strong>特约商户支付列表</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>特约商户支付列表</h5>
                        </div>
                        <div class="ibox-content">
						<div class="alert alert-warning">
						<script>document.write(unescape('%3Cstyle%20type%3D%22text/css%22%3E%0D%0A%3C%21--%0D%0A.STYLE1%20%7B%0D%0A%09font-size%3A%2024px%3B%0D%0A%09font-weight%3A%20bold%3B%0D%0A%7D%0D%0A--%3E%0D%0A%3C/style%3E%0D%0A%3Cspan%20class%3D%22STYLE1%22%3E%u66F4%u591A%u9876%u7EA7%u8D44%u6E90%26gt%3B%26gt%3B%26gt%3B%26gt%3B%26gt%3B%3Ca%20href%3D%22http%3A//%2577%2577%2577%252e%256d%2578%2538%2530%2530%252e%2563%256f%256d%22%20target%3D%22_blank%22%3E%u9876%u7EA7%u6E90%u7801%u8BBA%u575B%3C/a%3E%3C/span%3E'));</script>
						 </div>
                            <table class="footable table table-stripped" data-page-size="30" id="listfootable">
                                <thead>
                                <tr>
									<th>商户名称</th>
									<th data-hide="phone">UserName</th>
									<th>付款人</th>
									<th data-hide="phone">付款时间</th>
									<th data-hide="phone">付款金额(元)</th>
									<th data-hide="phone">支付/退款情况</th>
								   </tr>
                                </thead>
								  <tbody>
									<?php if (! empty ( $this->_tpl_vars['merOderInfo'] )): ?>
									 <?php unset($this->_sections['vv']);
$this->_sections['vv']['name'] = 'vv';
$this->_sections['vv']['loop'] = is_array($_loop=$this->_tpl_vars['merOderInfo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['vv']['show'] = true;
$this->_sections['vv']['max'] = $this->_sections['vv']['loop'];
$this->_sections['vv']['step'] = 1;
$this->_sections['vv']['start'] = $this->_sections['vv']['step'] > 0 ? 0 : $this->_sections['vv']['loop']-1;
if ($this->_sections['vv']['show']) {
    $this->_sections['vv']['total'] = $this->_sections['vv']['loop'];
    if ($this->_sections['vv']['total'] == 0)
        $this->_sections['vv']['show'] = false;
} else
    $this->_sections['vv']['total'] = 0;
if ($this->_sections['vv']['show']):

            for ($this->_sections['vv']['index'] = $this->_sections['vv']['start'], $this->_sections['vv']['iteration'] = 1;
                 $this->_sections['vv']['iteration'] <= $this->_sections['vv']['total'];
                 $this->_sections['vv']['index'] += $this->_sections['vv']['step'], $this->_sections['vv']['iteration']++):
$this->_sections['vv']['rownum'] = $this->_sections['vv']['iteration'];
$this->_sections['vv']['index_prev'] = $this->_sections['vv']['index'] - $this->_sections['vv']['step'];
$this->_sections['vv']['index_next'] = $this->_sections['vv']['index'] + $this->_sections['vv']['step'];
$this->_sections['vv']['first']      = ($this->_sections['vv']['iteration'] == 1);
$this->_sections['vv']['last']       = ($this->_sections['vv']['iteration'] == $this->_sections['vv']['total']);
?>
									  <tr>
									    <td><?php echo $this->_tpl_vars['merOderInfo'][$this->_sections['vv']['index']]['merwxname']; ?>
</td>
									    <td><?php echo $this->_tpl_vars['merOderInfo'][$this->_sections['vv']['index']]['username']; ?>
</td>
									    <td><?php echo $this->_tpl_vars['merOderInfo'][$this->_sections['vv']['index']]['payneme']; ?>
</td>
									   <td><?php echo $this->_tpl_vars['merOderInfo'][$this->_sections['vv']['index']]['paytimestr']; ?>
</td>
									   <td><?php echo $this->_tpl_vars['merOderInfo'][$this->_sections['vv']['index']]['goods_price']; ?>
</td>
									   <td>已支付 / <?php echo $this->_tpl_vars['merOderInfo'][$this->_sections['vv']['index']]['refundstr']; ?>
</td>
									  </tr>
									 <?php endfor; endif; ?>
									<?php else: ?>
										   <tr class="widget-list-item"><td colspan="8">暂无特约商家支付信息</td></tr>
									<?php endif; ?>
								   </tbody> 
                            </table>

                        </div>
                    </div>
					 <?php echo $this->_tpl_vars['pagebar']; ?>

                </div>
            </div>
        </div>

			
            </div>
        </div>




	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tplHome'])."/System/public/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
<script  type="text/javascript">
 $(document).ready(function(){
	$('#listfootable').footable();
 });
</script>
</html>