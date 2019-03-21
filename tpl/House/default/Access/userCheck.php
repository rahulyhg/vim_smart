
<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-key"></i>
                <a href="{pigcms{:U('Access/userCheck')}">智能系统审核</a>
            </li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">


            <style>
                .ace-file-input a {display:none;}
            </style>
            <div class="row">
                <div class="col-xs-12">
                    <div id="shopList" class="grid-view">
                        <table class="search_table" width="100%">
                            <tr>
                                <td>
                                    <form action="{pigcms{:U('Access/userCheck')}" method="get">
                                        <input type="hidden" name="c" value="Access"/>
                                        <input type="hidden" name="a" value="userCheck"/>
                                        <select name="searchtype">
                                            <option selected="selected" value="0">请选择</option>
                                            <option value="name" <if condition="$_GET['searchtype'] eq 'name'">selected="selected"</if>>真实姓名</option>
                                            <option value="phone" <if condition="$_GET['searchtype'] eq 'phone'">selected="selected"</if>>手机号</option>
                                        </select>
                                        <input type="text" name="keyword" class="input-text" value="{pigcms{$_GET['keyword']}"/  placeholder="请输入查询内容">
                                        开始时间：<input type="text" class="input fl" name="startDate"  placeholder="请输入起始时间" style="width:120px;" id="d4311" validate="required:true"  value="{pigcms{$_GET['startDate']}" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm',maxDate:'#F{$dp.$D(\'d4312\')}'})"/>
                                        结束时间：<input type="text" class="input fl" name="endDate"  placeholder="请输入终止时间" style="width:120px;" id="d4312" validate="required:true"   value="{pigcms{$_GET['endDate']}" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm',minDate:'#F{$dp.$D(\'d4311\')}'})"/>
                                        <input type="submit" value="查询" class="button"/>
                                    </form>
                                </td>
                            </tr>
                        </table>
                        <div style="margin-top:10px"></div>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="10%">微信名</th>
                                <th width="10%">真实姓名</th>
                                <th width="10%">手机号码</th>
                                <th width="10%">公司名称</th>
                                <!--<th width="10%">部门</th>-->
                                <th width="10%">证件类型</th>
                                <th width="10%">证件号</th>
                                <!--<th width="10%">地址</th>-->
                                <th width="10%">时间</th>
                                <th width="10%">状态</th>
                                <th class="button-column" width="15%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <if condition="$userCheck_list['userCheck_list']">
                                <volist name="userCheck_list['userCheck_list']" id="vo">
                                    <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                            <td><div class="tagDiv">{pigcms{$vo.pigcms_id}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.nickname}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.name}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.phone}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.company_name}</div></td>
                            <!--<td><div class="tagDiv">{pigcms{$vo.department}</div></td>-->
                            <td><div class="tagDiv"><if condition="$vo.card_type eq 1">现场审核</if><if condition="$vo.card_type eq 2">门禁卡</if><if condition="$vo.card_type eq 3">身份证</if><if condition="$vo.card_type eq 4">工作牌</if></td>
                            <td><div class="tagDiv">{pigcms{$vo.usernum}</div></td>
                            <!-- <td><div class="tagDiv">{pigcms{$vo.address}</div></td>-->
                            <td><div class="tagDiv">{pigcms{$vo.add_time|date='Y-m-d H:i:s',###}</div></td>
                            <td><div class="shopNameDiv"><if condition="$vo.ac_status eq '1' ">审核中</if><if condition="$vo.ac_status eq '2' || $vo.ac_status eq '4'">通过</if><if condition="$vo.ac_status eq '3' ">未通过</if></div></td>
                            <td class="button-column">
                                <a style="width: 60px;" class="label label-sm label-info" title="审核" href="{pigcms{:U('Access/userCheck_edit',array('pigcms_id'=>$vo['pigcms_id']))}">审核</a>
                                <a style="width: 60px;" class="label label-sm label-info" title="删除" href="{pigcms{:U('Access/userCheck_del',array('pigcms_id'=>$vo['pigcms_id']))}">删除</a>
                            </td>
                            </tr>
                            </volist>

                            <else/>
                            <tr class="odd"><td class="button-column" colspan="11">列表为空！</td></tr>
                            </if>
                            </tbody>
                        </table>
                        <tr class="odd"><td class="button-column" colspan="11">{pigcms{$userCheck_list['pagebar']}</td></tr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>


<include file="Public:footer"/>

<!--陈琦
    2016.6.8-->