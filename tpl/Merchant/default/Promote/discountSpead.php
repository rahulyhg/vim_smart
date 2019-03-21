<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-credit-card"></i>
                <a href="{pigcms{:U('Promote/discountSpead')}">优惠劵推广</a>
            </li>
            <li class="active">优惠劵推广列表</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <div class="row">
                <div class="col-xs-12">
                    <div class="tabbable">
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <button class="btn btn-success" onclick="CreateShop()">新增现金券</button>
                                <button class="btn btn-success" onclick="Administration()" style="margin-left:10px;">优惠明细</button>
                                <button class="btn btn-success" onclick="couponStatistics()" style="margin-left:10px;">优惠统计</button>
								<a class="btn btn-success" href="{pigcms{:U('Promote/recharge')}" style="margin-left:10px;">商户充值</a>
                                <div id="shopList" class="grid-view">
                                    <table  class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th id="shopList_c1" style="text-align: center;" width="80">推广ID</th>
                                            <th id="shopList_c1" style="text-align: center;" width="170">推广名称</th>
                                            <th id="shopList_c0" style="text-align: center;" width="100">优惠类别</th>
                                            <th id="shopList_c0" style="text-align: center;" width="100">优惠金额</th>
                                            <th id="shopList_c0" style="text-align: center;" width="100">推广金额</th>
                                            <th id="shopList_c0" style="text-align: center;" width="100">剩余金额</th>
                                            <th id="shopList_c0" style="text-align: center;" width="80">优惠范围</th>
                                            <th id="shopList_c3" style="text-align: center;" width="90">开始时间</th>
                                            <th id="shopList_c3" style="text-align: center;" width="90">结束时间</th>
                                            <th id="shopList_c11" style="text-align: center;" width="120">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <if condition="$data_vip">
                                            <volist name="data_vip" id="list">
                                                <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                                        <td style="text-align: center;">{pigcms{$list.ds_id}</td>
                                        <td style="text-align: center;">{pigcms{$list.ds_name}</td>
                                        <td style="text-align: center;"><if condition="$list.ds_type eq 0">现金抵用券<else/>折扣</if></td>
                                        <td style="text-align: center;"><if condition="$list.ds_type eq 0"><if condition="stripos($list.$list.ds_scale ,'.') nheq false">{pigcms{$list.ds_scale}元<else/>{pigcms{$list.ds_scale}.00元</if><else/>{pigcms{$list.ds_scale}折</if></td>
                                        <td style="text-align: center;">{pigcms{$list.ds_money}元</td>
                                        <td style="text-align: center;">{pigcms{$list.ds_reMoney}元</td>
                                        <td style="text-align: center;"><if condition="$list.ds_scope eq 0">全站<else/>会员</if></td>
                                        <td style="text-align: center;">{pigcms{$list.ds_beginTime|date='Y-m-d',###}</td>
                                        <td style="text-align: center;">{pigcms{$list.ds_endTime|date='Y-m-d',###}</td>
                                        <td style="text-align: center;" class="button-column" nowrap="nowrap">
                                            <a class="green" style="padding-right:8px;" href="{pigcms{:U('Promote/ds_look', array('disid'=>$list['ds_id']))}" >查看</a>
                                            <if condition="$list.ds_merId eq $mer_id">|
                                                <a class="green" style="padding-right:8px;" href="{pigcms{:U('Promote/ds_edit', array('disid'=>$list['ds_id']))}" ><i class="ace-icon fa fa-pencil bigger-130"></i></a>
                                                |
                                                <a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Promote/ds_del',array('itemid'=>$list['ds_id']))}">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            </if>
                                        </td>
                                        </tr>
                                        </volist>
                                        <else/>
                                        <tr class="odd"><td class="button-column" colspan="10" >无内容</td></tr>
                                        </if>
                                        </tbody>
                                    </table>
                                    {pigcms{$page}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        jQuery(document).on('click','#shopList a.red',function(){
            if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;
        });
    });
    function CreateShop(){
        window.location.href = "{pigcms{:U('Promote/ds_edit', array('id' => $thisCard['id']))}";
    }
     function couponStatistics(){
        window.location.href = "{pigcms{:U('Promote/couponStatistics')}";
    }
    function Administration (){
        window.location.href = "{pigcms{:U('Promote/ds_administration')}";
    }
    function drop_confirm(msg, url)
    {
        if (confirm(msg)) {
            window.location.href = url;
        }
    }
</script>
<include file="Public:footer"/>
