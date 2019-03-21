<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-key"></i>
                <a href="{pigcms{:U('Access/operatLog')}">开门记录</a>
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
                                   <form action="{pigcms{:U('Access/operatLog')}" method="get">
                                        <input type="hidden" name="c" value="Access"/>
                                        <input type="hidden" name="a" value="operatLog"/>
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
                                <th width="10%">用户</th>
                                <th width="10%">手机号</th>
                                <th width="10%">证件类型</th>
                                <th width="10%">证件号</th>
                                <th width="10%">设备名称</th>
                                <th width="10%">所属区域</th>
                                <th width="10%">所属公司</th>
                                <th width="10%">时间</th>
                                <th class="button-column" width="10%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <if condition="$log_list['access_list']">
                                <volist name="log_list['access_list']" id="vo">
                                <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                                    <td><div class="tagDiv">{pigcms{$vo.log_id}</div></td>
                                    <td><div class="tagDiv">{pigcms{$vo.name}</div></td>
                                    <td><div class="tagDiv">{pigcms{$vo.phone}</div></td>
                            <td><div class="tagDiv"><if condition="$vo.card_type eq 1">现场审核</if><if condition="$vo.card_type eq 2">门禁卡号</if><if condition="$vo.card_type eq 3">身份证号</if><if condition="$vo.card_type eq 4">工牌号</if></td>
                                    <td><div class="tagDiv">{pigcms{$vo.usernum}</div></td>
                                    <td><div class="tagDiv">{pigcms{$vo.ac_name}</div></td>
                                    <td><div class="tagDiv">{pigcms{$vo.ag_name}</div></td>
                                    <td><div class="tagDiv">{pigcms{$vo.company_name}</div></td>
                                    <td><div class="tagDiv">{pigcms{$vo.opdate|date='Y-m-d H:i:s',###}</div></td>
                                    <td class="button-column">
                                        <a style="width:60px;" class="label label-sm label-info" title="详情" href="{pigcms{:U('Access/operatLog_edit',array('log_id'=>$vo['log_id']))}">详情</a>
                                        <a style="width:60px;" class="label label-sm label-info" title="删除" href="{pigcms{:U('Access/operatLog_del',array('log_id'=>$vo['log_id']))}">删除</a>
                                    </td>
                                </tr>
                                </volist>
                            <else/>
                                <tr class="odd"><td class="button-column" colspan="8">列表为空！</td></tr>
                            </if>
                            </tbody>
                        </table>
                        <tr class="odd"><td class="button-column" colspan="8">{pigcms{$log_list['pagebar']}</td></tr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script>
    $(function(){
        $('.handle_btn').live('click',function(){
            art.dialog.open($(this).attr('href'),{
                init: function(){
                var iframe = this.iframe.contentWindow;
                window.top.art.dialog.data('iframe_handle',iframe);
            },
                id: 'handle',
                title:'提示',
                padding: 0,
                width: 720,
                height: 420,
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

    });
</script>

<include file="Public:footer"/>