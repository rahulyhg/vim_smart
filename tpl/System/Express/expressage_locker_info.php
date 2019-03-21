<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>$express['name'].'快递柜列表',
    'describe'=>'',
);
$breadcrumb = array(
    array('系统配置','#'),
    array('快递公司列表','#'),
    array($express['name'].'快递柜列表','#'),
);

$add_action = array(
    'url'=>U('Express/expressage_locker_edit',array('company_id'=>$company_id)),
    'name'=>'添加新快递柜'
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
            <tr>
                <td>
                    社区名称
                </td>
                <td>
                    快递柜ID
                </td>
                <td>
                    快递柜层数
                </td>
                <td>
                    状态
                </td>
                <td>
                    操作
                </td>
            </tr>
    </thead>
    <tbody>
            <foreach name="info" item="rowset">
                <tr>
                    <th width="30%">
                        <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                            <span class="check"></span>
                            <span class="box"></span>{pigcms{$rowset['village_name']}
                        </div>
                    </th>
                    <td>
                        <div class="md-checkbox" style="padding:15px 15px 15px 20px;">
                            <span class="check"></span>
                            <span class="box"></span>{pigcms{$rowset['expressage_locker_id']}
                        </div>
                    </td>
                    <td>
                        <div class="md-checkbox" style="padding:15px 15px 15px 20px;">
                            <span class="check"></span>
                            <span class="box"></span>{pigcms{$rowset['expressage_locker_count']}
                        </div>
                    </td>
                    <td>
                        <div class="md-checkbox" style="padding:15px 15px 15px 20px;">
                            <span class="check"></span>
                            <span class="box"></span>
                            <if condition="$rowset['status'] eq 1">
                                <span style="color: green">开启</span>
                            </if>
                            <if condition="$rowset['status'] eq 0">
                                <span style="color: red">关闭</span>
                            </if>
                        </div>
                    </td>
                    <td>
                        <div class="md-checkbox" style="padding:15px 15px 15px 20px;">
                            <span class="check"></span>
                            <span class="box"></span><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Express/expressage_locker_edit',array('id'=>$rowset['id']))}','编辑快递柜信息',520,250,true,false,false,editbtn,'add',true);">编辑</a>
                        </div>
                    </td>
                </tr>
            </foreach>
    </tbody>
        </table>
</table>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->

<!--自定义js代码区结束-->
<include file="Public_news:footer"/>