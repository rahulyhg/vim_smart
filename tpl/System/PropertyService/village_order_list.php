<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.label-kid {
    background-color: #f36a5a;
}
.btn-group>.dropdown-menu, .dropdown-toggle>.dropdown-menu, .dropdown>.dropdown-menu {
    margin-top: 10px;
}
.dropdown-menu {
    margin: 0 0 0 -172px;
}
</style>
<!--头部设置-->
<?php
$title = array(
    'title'=>'物业缴费',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('物业缴费','#'),
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<div id="shopList" class="grid-view">

    <div class="row">
        <div class="col-md-12">
            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/import_tenant')}">
                    <button id="sample_editable_1_new" class="btn sbold green">导入业主
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>
            <!--<div class="btn-group">
                <a href="{pigcms{:U('PropertyService/add_property_order')}">
                    <button id="sample_editable_1_new" class="btn sbold green">手动添加业主
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>-->
            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/detail_import')}">
                    <button id="sample_editable_1_new" class="btn sbold green">导入业主每月帐单明细
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>
            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/exit_xls')}">
                    <button id="sample_editable_1_new" class="btn sbold green">本月账单预览
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>

            <form action="{pigcms{:U('village_order_list')}" method="get" id="myForm" style="float:right;">
                <input type="hidden" name="g"  value="System"/>
                <input type="hidden" name="c"  value="PropertyService"/>
                <input type="hidden" name="a"  value="village_order_list"/>
                <div style="height: 15%">
                    <input type="text" name="keyWord" style="width: 135%;float: right;" placeholder="请输入   公司名\姓名\手机号" class="form-control"/>
                </div>
            </form>
        </div>


    </div>
    <br/>
    <!--<for start="1" end="13">
        <a href="{pigcms{:U('village_order_list',array('month'=>$i))}">
        <button class="btn  btn-sm <php>if(empty($_GET['month'])&&$i==date('m')){echo 'blue';}else if($_GET['month']==$i){echo 'blue';}else{echo 'default';}</php>" type="button">
            2017-{pigcms{$i}月
        </button>
        </a>
    </for>-->


    <!--id="sample_1"-->
    <table class="table table-striped table-bordered table-hover">

        <thead>

        <tr>
            <th width="10%">业主编号</th>
            <th width="15%">业主公司名称</th>
            <th width="10%">负责人</th>
            <th width="10%">手机号</th>
            <th width="10%">所属社区</th>
            <th width="20%">楼层编号</th>
            <th width="15%">待缴费用</th>
            <th width="5%">停车位</th>
            <th width="10%">房子大小</th>
            <th class="button-column" width="15%">操作</th>
        </tr>

        </thead>

        <tbody>


        <if condition="$user_list">
            <volist name="user_list['user_list']" id="vo">
                <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
        <td><div class="tagDiv">{pigcms{$vo.usernum}</div></td>
        <td><div class="tagDiv">{pigcms{$vo.company_name}</div></td>
        <td><div class="tagDiv">{pigcms{$vo.name}</div></td>
        <td><div class="tagDiv">{pigcms{$vo.phone}</div></td>
        <td><div class="tagDiv">{pigcms{$vo.village_name}</div></td>
        <td><div class="tagDiv">{pigcms{$vo.st}<if condition="$vo['more'] eq 1"><a class="handle_btn" href="{pigcms{:U('list_for_more',array('usernum'=>$vo['usernum']))}"><br/>>>>>>更多</a></if></div></td>
        <if condition="$vo['total_waterPrice'] neq ''">
            <td>
                <div class="tagDiv">
                    <div style="margin:5px;">
					<div style="float:left;">物业费：￥{pigcms{:floatval($vo['total_propertyPrice'])}<if condition="$vo['total_propertyPrice'] neq 0"></div>
					<div style="float:left; margin-left:10px;"><a href="{pigcms{$vo['payProperty_url']}" class="label label-sm label-info">支付</a></div><else/><a href="javascript:;" class="label label-sm label-info" style="margin-left:10px;">支付</a></if></div>
					<div style="clear: both;"></div>
					</div>
					
					<div style="margin:5px;">
                    <div style="float:left;">水费：￥{pigcms{:floatval($vo['total_waterPrice'])}<if condition="$vo['total_waterPrice'] neq 0"></div>
					<div style="float:left; margin-left:10px;"><a href="{pigcms{$vo['payWater_url']}" class="label label-sm label-info">支付</a><else/><a href="javascript:;" class="label label-sm label-info" style="margin-left:10px;">支付</a></if></div>
					<div style="clear: both;"></div>
					</div>
					
					<div style="margin:5px;">
                    <div style="float:left;">电费：￥{pigcms{:floatval($vo['total_electricPrice'])}<if condition="$vo['total_electricPrice'] neq 0"></div>
					<div style="float:left; margin-left:10px;"><a href="{pigcms{$vo['payElectric_url']}" class="label label-sm label-info">支付</a><else/><a href="javascript:;" class="label label-sm label-info" style="margin-left:10px;">支付</a></if></div>
					<div style="clear: both;"></div>
					</div>
					
					<div style="margin:5px;">
                    <div style="float:left;">燃气费：￥{pigcms{:floatval($vo['total_gasPrice'])}<if condition="$vo['total_gasPrice'] neq 0"></div>
					<div style="float:left; margin-left:10px;"><a href="{pigcms{$vo['payGas_url']}" class="label label-sm label-info">支付</a><else/><a href="javascript:;" class="label label-sm label-info" style="margin-left:10px;">支付</a></if></div>
					<div style="clear: both;"></div>
					</div>
					
					<div style="margin:5px;">
                    <div style="float:left;">停车费：￥{pigcms{:floatval($vo['total_parkPrice'])}<if condition="$vo['total_parkPrice'] neq 0"></div>
					<div style="float:left; margin-left:10px;"><a href="{pigcms{$vo['payPark_url']}" class="label label-sm label-info">支付</a><else/><a href="javascript:;" class="label label-sm label-info" style="margin-left:10px;">支付</a></if></div>
					<div style="clear: both;"></div>
					</div>
					
					<div style="margin:5px;">
                    <a style="width: 60px;" class="label label-sm label-info" title="全部缴费" href="{pigcms{$vo['payTotal_url']}">全部缴费</a>
					</div>
            </td>
            <else/>

            <td>
                <div class="tagDiv">
					<div style="margin:5px;">
                    <div style="float:left;">物业费：￥{pigcms{:floatval($vo['property_price'])}<if condition="$vo['property_price'] neq 0"></div>
					<div style="float:left; margin-left:10px;"><a href="{pigcms{$vo['payProperty_url']}" class="label label-sm label-info">支付</a><else/><a href="javascript:;" class="label label-sm label-info" style="margin-left:10px;">支付</a></if></div>
					<div style="clear: both;"></div>
					</div>
					
					<div style="margin:5px;">
                    <div style="float:left;">水费：￥{pigcms{:floatval($vo['water_price'])}<if condition="$vo['water_price'] neq 0"></div>
					<div style="float:left; margin-left:10px;"><a href="{pigcms{$vo['payWater_url']}" class="label label-sm label-info">支付</a><else/><a href="javascript:;" class="label label-sm label-info" style="margin-left:10px;">支付</a></if></div>
					<div style="clear: both;"></div>
					</div>
					
					<div style="margin:5px;">
                    <div style="float:left;">电费：￥{pigcms{:floatval($vo['electric_price'])}<if condition="$vo['electric_price'] neq 0"></div>
					<div style="float:left; margin-left:10px;"><a href="{pigcms{$vo['payElectric_url']}" class="label label-sm label-info">支付</a><else/><a href="javascript:;" class="label label-sm label-info" style="margin-left:10px;">支付</a></if></div>
					<div style="clear: both;"></div>
					</div>
					
					<div style="margin:5px;">
                    <div style="float:left;">燃气费：￥{pigcms{:floatval($vo['gas_price'])}<if condition="$vo['gas_price'] neq 0"></div>
					<div style="float:left; margin-left:10px;"><a href="{pigcms{$vo['payGas_url']}" class="label label-sm label-info">支付</a><else/><a href="javascript:;" class="label label-sm label-info" style="margin-left:10px;">支付</a></if></div>
					<div style="clear: both;"></div>
					</div>
					
					<div style="margin:5px;">
                    <div style="float:left;">停车费：￥{pigcms{:floatval($vo['park_price'])}<if condition="$vo['park_price'] neq 0"></div>
					<div style="float:left; margin-left:10px;"><a href="{pigcms{$vo['payPark_url']}" class="label label-sm label-info">支付</a><else/><a href="javascript:;" class="label label-sm label-info" style="margin-left:10px;">支付</a></if></div>
					<div style="clear: both;"></div>
					</div>
					
					<div style="margin:5px;">
                    <a style="width: 60px;" class="label label-sm label-info" title="全部缴费" href="{pigcms{$vo['payTotal_url']}">全部缴费</a>
					</div>
                </div>
            </td>
        </if>
        <td><div class="shopNameDiv"><if condition="$vo.park_flag eq '1' ">有<else />无</if></div></td>
        <td><div class="shopNameDiv">{pigcms{$vo.size} ㎡</div></td>
        <td class="button-column">
			<div class="btn-group">
				<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu pull-left" role="menu" style="position: absolute;">
					<li>
						<a href="{pigcms{:U('edit',array('pigcms_id'=>$vo['pigcms_id'],'usernum'=>$vo['usernum']))}">
							<i class="icon-docs"></i> 编辑 </a>
					</li>
					<li>
						<a href="{pigcms{:U('order_history',array('bind_id'=>$vo['pigcms_id']))}">
							<i class="icon-docs"></i> 缴费明细 </a>
					</li>
					<li>
						<a class="handle_btn" title="抄表二维码" href="http://www.hdhsmart.com/shequ.php?g=House&c=Index&a=re_setmeter_qr&usernum={pigcms{$vo['usernum']}&is_system=1">
							<i class="icon-docs"></i> 抄表二维码 </a>
					</li>

                    <if condition="$vo['more'] eq 1">
                        <li>
                            <a class="handle_btn" title="抄表二维码" href="{pigcms{:U('list_for_more',array('usernum'=>$vo['usernum']))}">
                                <i class="icon-docs"></i> 更多 </a>
                        </li>
                    </if>
				</ul>
			</div>
			
            <!--<a style="width: 60px;" class="label label-sm label-info" title="编辑" href="{pigcms{:U('edit',array('pigcms_id'=>$vo['pigcms_id'],'usernum'=>$vo['usernum']))}">编辑</a>
            <a style="width: 60px;" class="label label-sm label-info" title="缴费明细" href="{pigcms{:U('order_history',array('bind_id'=>$vo['pigcms_id']))}">缴费明细</a>
            <a style="width: 60px;" class="label label-sm label-info handle_btn" title="抄表二维码"
               href="http://www.hdhsmart.com/shequ.php?g=House&c=Index&a=re_setmeter_qr&usernum={pigcms{$vo['usernum']}"
               id="{pigcms{$vo.pigcms_id}"

            >抄表二维码</a><!-->

        </td>
        </tr>
        </volist>
        <else/>
        <tr class="odd"><td class="button-column" colspan="12" >没有任何业主。</td></tr>
        </if>

        </tbody>

        <tfoot>

            <tr>

                <td colspan="10" align="center">{pigcms{$user_list.pagebar}</td>

            </tr>

        </tfoot>

    </table>



</div>

<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script>
    //隐藏
    $('.summary').hide();

    $(function(){
        $('.handle_btn').on('click',function(){
            art.dialog.open($(this).attr('href'),{
                init: function(){
                    var iframe = this.iframe.contentWindow;
                    window.top.art.dialog.data('iframe_handle',iframe);
                },
                id: 'handle',
                title:'二维码',
                padding: 0,
                width: 820,
                height: 520,
                lock: true,
                resize: false,
                background:'black',
                button: null,
                fixed: false,
                close: null,
                left: '50%',
                top: '38.2%',
                opacity:'0.4'
            });
            return false;
        });

        $("input[name='keyWord']").change(function(){
            $("#myForm").submit();
        });
    });
</script>
<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
