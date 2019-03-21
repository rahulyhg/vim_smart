<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'收发快递',
    'describe'=>'',
);
$breadcrumb = array(
    array('包裹出库','#'),
    array('包裹出库','#'),
);

/*$add_action = array(
    'url'=>U('Searchhot/add'),
    'name'=>'快递1公司'
);*/
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<style>
    #sub{
        width: 100px;
        height: 30px;
        background: #c0cedb;
        text-align: center;
        line-height: 30px;
        font-size: 16px;
        display: inline-block;
        position: relative;
        left: 420px;
    }
</style>
<!--业务区-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light tasks-widget bordered">
            <div class="portlet box blue-hoki">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>包裹出库</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="reload"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="{pigcms{:U('delivery_sub')}" class="form-horizontal" method="post">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">运单号</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                                                    <span class="input-group-addon input-circle-left">
                                                                        <i class="fa fa-barcode"></i>
                                                                    </span>
                                        <input type="text" name="code" class="form-control input-circle-right" id="num" autofocus="autofocus" placeholder="请扫描或者输入运单号"> </div>
                                </div>
                            </div>
                            <p  href="javascript:" id="sub" onclick="sub()" >确认出库</p>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>

        </div>
    </div>
</div>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script>

    function sub() {
        var code = $("#num").val();
        if (code == '') {
            alert('请输入取货号');
        } else {
            $("form").submit();
        }
    }



</script>


<!--自定义js代码区结束-->
<include file="Public_news:footer"/>