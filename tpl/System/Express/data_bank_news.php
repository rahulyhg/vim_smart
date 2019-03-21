<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'包裹信息',
    'describe'=>'',
);
$breadcrumb = array(
    array('数据中心','#'),
    array('包裹信息','#'),
);

/*$add_action = array(
    'url'=>U('Searchhot/add'),
    'name'=>'快递1公司'
);*/
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>
        <th>运单号</th>
        <th>快递公司</th>
        <th>取件码</th>
        <th>收件人</th>
        <th>电话</th>
        <th>包裹状态</th>
        <th class="textcenter">操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($list)">
        <volist name="list" id="vo">
            <tr>
                <td width="20%">{pigcms{$vo.waybill_number}</td>
                <td>{pigcms{$vo.company_name}</td>
                <td>{pigcms{$vo.receipt_code}</td>
                <td>{pigcms{$vo.name}</td>
                <td>{pigcms{$vo.phone}</td>
                <td>
                    <if condition="$vo['status'] eq 0">
                        <span style="color: blue">已到站</span><br/>{pigcms{$vo.in_package_time|date='Y-m-d H:i:s',###}
                    <elseif condition="$vo['status'] eq 1"/>
                        <span style="color: green">已提货</span><br/>{pigcms{$vo.out_package_time|date='Y-m-d H:i:s',###}
                    <elseif condition="$vo['status'] eq 2"/>
                        <span style="color: red">顾客拒收</span><br/>{pigcms{$vo.out_package_time|date='Y-m-d H:i:s',###}
                    <elseif condition="$vo['status'] eq 3"/>
                        <span style="color: red">站点拒签</span><br/>{pigcms{$vo.out_package_time|date='Y-m-d H:i:s',###}
                    <elseif condition="$vo['status'] eq 4"/>
                        <span style="color: red">已退件</span><br/>{pigcms{$vo.out_package_time|date='Y-m-d H:i:s',###}
                    </if>
                </td>
                <td class="textcenter">
                    <div class="btn-group">
                        <if condition="$vo['status'] eq 0">
                            <a href="javascript:;" class="btn btn-xs btn-primary" onclick="changePackageStatus('{pigcms{$vo.id}',1)">提货</a>
                        <elseif condition="$vo['status'] eq 1"/>
                            <button type="button" class="btn btn-xs btn-primary">已提货</button>
                        <elseif condition="$vo['status'] eq 2"/>
                            <button type="button" class="btn btn-xs btn-primary">顾客拒收</button>
                        <elseif condition="$vo['status'] eq 3"/>
                            <button type="button" class="btn btn-xs btn-primary">站点拒签</button>
                        <elseif condition="$vo['status'] eq 4"/>
                            <button type="button" class="btn btn-xs btn-primary">已退件</button>
                        </if>
                        <button type="button" class="btn btn-xs btn-primary dropdown-toggle " data-toggle="dropdown">
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <if condition="$vo['status'] eq 0">
                                <li>
                                    <a href="javascript:;" onclick="changePackageStatus('{pigcms{$vo.id}',2)"> 顾客拒收 </a>
                                </li>
                                <li>
                                    <a href="javascript:;" onclick="changePackageStatus('{pigcms{$vo.id}',3)"> 站点拒签 </a>
                                </li>
                                <li>
                                    <a href="javascript:;" onclick="changePackageStatus('{pigcms{$vo.id}',4)"> 退件 </a>
                                </li>
                            </if>
                        </ul>
                    </div>
                </td>
            </tr>
        </volist>

        <else/>
        <tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
    </if>
    </tbody>
</table>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script>

    $("input[name='waybill_number']").keydown(function () {
        $("form").submit();
    });

    function changePackageStatus(id,status){
        $.ajax({
            url:"{pigcms{:U('change_status')}",
            type:'post',
            data:{'id':id,'status':status},
            success:function(res){
                if(res == 1){
                    window.location.reload();
                }else{
                    alert('改变失败');
                }
            }
        });
    }

</script>


<!--自定义js代码区结束-->
<include file="Public_news:footer"/>