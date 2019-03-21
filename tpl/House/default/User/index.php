<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-group"></i>
                <a href="{pigcms{:U('User/index')}">业主管理</a>
            </li>
            <li class="active">业主列表</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
        	<button class="btn btn-success" onclick="importUser()">导入业主</button>
            <button class="btn btn-success" onclick="add_bind();">手动添加业主</button>
            <button class="btn btn-success" onclick="importUserDetail()">导入业主每月帐单明细</button>
            <button class="btn btn-success" onclick="outUp()">本月账单预览</button>
            <br/>
            <br/>
            <br/>
            <form action="{pigcms{:U('User/index')}" method="get" id="myForm">
                <input type="hidden" name="g"  value="House"/>
                <input type="hidden" name="c"  value="User"/>
                <input type="hidden" name="a"  value="index"/>
                <div style="height: 15%">
                    <input type="text" name="keyWord" style="width: 35%" placeholder="请输入   公司名\姓名\手机号"/>
                </div>
            </form>
            <style>
                .ace-file-input a {display:none;}
            </style>
            <div class="row">
                <div class="col-xs-12">
                    <div id="shopList" class="grid-view">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="10%">业主编号</th>
                                    <th width="10%">业主公司名称</th>
                                    <th width="10%">负责人</th>
                                    <th width="10%">手机号</th>
                                    <th width="20%">住址</th>
                                    <th width="15%">待缴费用</th>
                                    <th width="5%">停车位</th>
                                    <th width="10%">房子大小</th>
                                    <th class="button-column" width="20%">操作</th>
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
                                            <td><div class="tagDiv">{pigcms{$vo.address}</div></td>
                                            <if condition="$vo['total_waterPrice'] neq ''">
                                                <td>
                                                    <div class="tagDiv">
                                                        物业费：￥{pigcms{:floatval($vo['total_propertyPrice'])}<if condition="$vo['total_propertyPrice'] neq 0">&nbsp;<a href="{pigcms{$vo['payProperty_url']}" class="label label-sm label-info">支付</a></if><br/>
                                                        水费：￥{pigcms{:floatval($vo['total_waterPrice'])}<if condition="$vo['total_waterPrice'] neq 0">&nbsp;<a href="{pigcms{$vo['payWater_url']}" class="label label-sm label-info">支付</a></if><br/>
                                                        电费：￥{pigcms{:floatval($vo['total_electricPrice'])}<if condition="$vo['total_electricPrice'] neq 0">&nbsp;<a href="{pigcms{$vo['payElectric_url']}" class="label label-sm label-info">支付</a></if><br/>
                                                        燃气费：￥{pigcms{:floatval($vo['total_gasPrice'])}<if condition="$vo['total_gasPrice'] neq 0">&nbsp;<a href="{pigcms{$vo['payGas_url']}" class="label label-sm label-info">支付</a></if><br/>
                                                        停车费：￥{pigcms{:floatval($vo['total_parkPrice'])}<if condition="$vo['total_parkPrice'] neq 0">&nbsp;<a href="{pigcms{$vo['payPark_url']}" class="label label-sm label-info">支付</a></if><br/>
                                                        <a style="width: 60px;" class="label label-sm label-info" title="全部缴费" href="{pigcms{$vo['payTotal_url']}">全部缴费</a>
                                                    </div>
                                                </td>
                                           <else/>

                                                <td>
                                                    <div class="tagDiv">
                                                        物业费：￥{pigcms{:floatval($vo['property_price'])}<if condition="$vo['property_price'] neq 0">&nbsp;<a href="{pigcms{$vo['payProperty_url']}" class="label label-sm label-info">支付</a></if><br/>
                                                        水费：￥{pigcms{:floatval($vo['water_price'])}<if condition="$vo['water_price'] neq 0">&nbsp;<a href="{pigcms{$vo['payWater_url']}" class="label label-sm label-info">支付</a></if><br/>
                                                        电费：￥{pigcms{:floatval($vo['electric_price'])}<if condition="$vo['electric_price'] neq 0">&nbsp;<a href="{pigcms{$vo['payElectric_url']}" class="label label-sm label-info">支付</a></if><br/>
                                                        燃气费：￥{pigcms{:floatval($vo['gas_price'])}<if condition="$vo['gas_price'] neq 0">&nbsp;<a href="{pigcms{$vo['payGas_url']}" class="label label-sm label-info">支付</a></if><br/>
                                                        停车费：￥{pigcms{:floatval($vo['park_price'])}<if condition="$vo['park_price'] neq 0">&nbsp;<a href="{pigcms{$vo['payPark_url']}" class="label label-sm label-info">支付</a></if><br/>
                                                        <a style="width: 60px;" class="label label-sm label-info" title="全部缴费" href="{pigcms{$vo['payTotal_url']}">全部缴费</a>
                                                    </div>
                                                </td>
                                            </if>
                                            <td><div class="shopNameDiv"><if condition="$vo.park_flag eq '1' ">有<else />无</if></div></td>
                                            <td><div class="shopNameDiv">{pigcms{$vo.housesize} ㎡</div></td>
                                            <td class="button-column">
                                                <a style="width: 60px;" class="label label-sm label-info" title="编辑" href="{pigcms{:U('User/edit',array('pigcms_id'=>$vo['pigcms_id'],'usernum'=>$vo['usernum']))}">编辑</a>
                                                <a style="width: 60px;" class="label label-sm label-info" title="缴费明细" href="{pigcms{:U('User/order_history',array('bind_id'=>$vo['pigcms_id']))}">缴费明细</a>
                                                <a style="width: 60px;" class="label label-sm label-info handle_btn" title="抄表二维码" href="{pigcms{:U('Index/re_setmeter_qr',array('usernum'=>$vo['usernum']))}" id="{pigcms{$vo.pigcms_id}">抄表二维码</a>

                                           </td>
                                        </tr>
                                    </volist>
                                <else/>
                                    <tr class="odd"><td class="button-column" colspan="12" >没有任何业主。</td></tr>
                                </if>
                            </tbody>
                        </table>
                        {pigcms{$user_list.pagebar}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>
function importUser(){
	window.location.href = "{pigcms{:U('User/user_import')}";
}
function importUserDetail(){
	window.location.href = "{pigcms{:U('User/detail_import')}";
}
function add_bind() {
    window.location.href = "{pigcms{:U('User/add_bindUser')}";
}

function outUp(){
    window.location.href = "{pigcms{:U('User/exit_xls')}";
}
    /*修改当前的绑定微信人，自动绑定*/
    function bind_weixin(msg){
        var id = $(msg).attr("id");
        $.ajax({
            url:"{pigcms{:U('bind_weixin')}",
            type:'post',
            data:{'id':id},
            success:function(res){
                if(res == 1){
                    window.location.reload();
                }else{
                    alert('查无此人');
                }
            }
        });
    }

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
<include file="Public:footer"/>
