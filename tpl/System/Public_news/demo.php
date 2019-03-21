<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'企业列表',
    'describe'=>'',
);
$breadcrumb = array(
    array('企业管理','#'),
    array('企业列表','#'),
);

$add_action = array(
    'url'=>U('',array()),
    'name'=>''
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

</table>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->

<!--自定义js代码区结束-->
<include file="Public_news:footer"/>


