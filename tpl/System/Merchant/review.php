<include file="Public:header"/>
<div class="mainbox">
    <table class="search_table" width="100%">
<!--        <tr>-->
<!--            <td>-->
<!--                <form action="{pigcms{:U('Merchant/index')}" method="get">-->
<!--                    <input type="hidden" name="c" value="Merchant"/>-->
<!--                    <input type="hidden" name="a" value="index"/>-->
<!--                    筛选: <input type="text" name="keyword" class="input-text" value="{pigcms{$_GET['keyword']}"/>-->
<!--                    <select name="searchtype">-->
<!--                        <option value="name" <if condition="$_GET['searchtype'] eq 'name'">selected="selected"</if>>商户名称</option>-->
<!--                        <option value="account" <if condition="$_GET['searchtype'] eq 'account'">selected="selected"</if>>商户帐号</option>-->
<!--                        <option value="phone" <if condition="$_GET['searchtype'] eq 'phone'">selected="selected"</if>>联系电话</option>-->
<!--                        <option value="mer_id" <if condition="$_GET['searchtype'] eq 'mer_id'">selected="selected"</if>>商家编号</option>-->
<!--                    </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
<!--                    商户状态: <select name="searchstatus">-->
<!--                        <option value="0" <if condition="$_GET['searchstatus'] eq 0">selected="selected"</if>>正常</option>-->
<!--                        <option value="1" <if condition="$_GET['searchstatus'] eq '1'">selected="selected"</if>>待审核</option>-->
<!--                        <option value="2" <if condition="$_GET['searchstatus'] eq '2'">selected="selected"</if>>关闭</option>-->
<!--                        <option value="3" <if condition="$_GET['searchstatus'] eq '3'">selected="selected"</if>>全部</option>-->
<!--                    </select>-->
<!--                    <input type="submit" value="查询" class="button"/>-->
<!--                </form>-->
<!--            </td>-->
<!--        </tr>-->
    </table>
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup><col> <col> <col> <col><col><col><col><col><col width="240" align="center"> </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>商户名</th>
                    <th>提现金额</th>
                    <th>申请时间</th>
                    <th>提现状态</th>
                    <th>处理人</th>
                    <th>联系方式</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="is_array($list)">
                    <volist name="list" id="vo">
                        <tr>
                            <td>{pigcms{$vo.id}</td>
                            <td>{pigcms{$vo.mc_name}</td>
                            <td>{pigcms{$vo.tc_money}</td>
                            <td>{pigcms{$vo.sub_time|date='Y-m-d H:i:s',###}</td>
                            <td><if condition="$vo['status'] eq 0"><font color="red">待处理</font><elseif condition="$vo['status'] eq 1"/><font color="red">审核中</font><elseif condition="$vo['status'] eq 2"/><font color="green">通过审核</font><else/><font color="red">审核不通过</font></if></td>
                            <td>{pigcms{$vo.dispose_name}</td>
                            <td>{pigcms{$vo.contact_num}</td>
                            <td><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Merchant/check',array('d_id'=>$vo['id']))}','提现审核',600,450,true,false,false,editbtn,'edit',true);">审核</a> |
                                |<a href="javascript:void(0);" class="delete_row" parameter="d_id={pigcms{$vo['id']}" url="{pigcms{:U('Merchant/dradel')}">删除</a></td>
                        </tr>
                    </volist>
                    <tr><td class="textcenter pagebar" colspan="8">{pigcms{$pagebar}</td></tr>
                    <else/>
                    <tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>