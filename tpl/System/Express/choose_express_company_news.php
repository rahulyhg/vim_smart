<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'选择快递公司',
    'describe'=>'',
);
$breadcrumb = array(
    array('包裹入库','#'),
    array('选择快递公司','#'),
);

/*$add_action = array(
    'url'=>U('Searchhot/add'),
    'name'=>'快递公司'
);*/
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light tasks-widget bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-green-haze bold uppercase">选择快递公司</span>
                    <span class="caption-helper">先选择后入库</span>
                </div>
            </div>

            <foreach name="list" item="vo">
                <a class="btn green-sharp btn-outline  btn-block sbold uppercase" href="{pigcms{$vo.url}">{pigcms{$vo.company_name}</a>
            </foreach>

        </div>
    </div>
</div>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->

<!--自定义js代码区结束-->
<include file="Public_news:footer"/>