<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('Access/visitorLog')}" class="on">访客信息管理</a>
        </ul>
    </div>
    <div class="table-list">

        <table class="search_table" width="100%">
            <tr>
                <td>
                    <form action="{pigcms{:U('Access/visitorLog')}" method="get">
                        <input type="hidden" name="c" value="Access"/>
                        <input type="hidden" name="a" value="visitorLog"/>
                        <select name="searchtype">
                            <option selected="selected" value="0">请选择</option>
                            <option value="name" <if condition="$_GET['searchtype'] eq 'name'">selected="selected"</if>>用户名称</option>
                            <option value="phone" <if condition="$_GET['searchtype'] eq 'phone'">selected="selected"</if>>手机号</option>
                        </select>
                        <input type="text" name="keyword" class="input-text" value="{pigcms{$_GET['keyword']}"  placeholder="请输入查询内容">
                        开始时间：<input type="text" class="input" name="startDate"  placeholder="请输入起始时间" style="width:120px;" id="d4311" validate="required:true"  value="{pigcms{$_GET['startDate']}" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm',maxDate:'#F{$dp.$D(\'d4312\')}'})"/>
                        结束时间：<input type="text" class="input" name="endDate"  placeholder="请输入终止时间" style="width:120px;" id="d4312" validate="required:true"   value="{pigcms{$_GET['endDate']}" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm',minDate:'#F{$dp.$D(\'d4311\')}'})"/>
                        <input type="submit" value="查询" class="button"/>
                    </form>
                </td>
            </tr>
        </table>
        <table width="100%" cellspacing="0">
            <colgroup>
                <col/>
                <col/>
                <col/>
                <col/>
                <col/>
                <col/>
                <col/>
                <col/>
                <col width="180" align="center"/>
            </colgroup>
            <thead>
            <tr>
                <th>ID</th>
                <th>微信名</th>
                <th>真实姓名</th>
                <th>手机号码</th>
                <th>身份证号</th>
                <th>到访公司</th>
                <th>到访社区</th>
                <th>时间</th>
                <th class="textcenter">操作</th>
            </tr>
            </thead>
            <tbody>
            <if condition="$visitor_list['visitor_list']">
                <volist name="visitor_list['visitor_list']" id="vo">
                    <tr>
                        <td>{pigcms{$vo.pigcms_id}</td>
                        <td>{pigcms{$vo.nickname}</td>
                        <td>{pigcms{$vo.name}</td>
                        <td>{pigcms{$vo.phone}</td>
                        <td>{pigcms{$vo.id_card}</td>
                        <td>{pigcms{$vo.company}</td>
                        <td>{pigcms{$vo.village_name}</td>
                        <td>{pigcms{$vo.add_time|date='Y-m-d H:i:s',###}</td>
                        <td class="textcenter"><a href="javascript:void(0);"  onclick="window.top.artiframe('{pigcms{:U('Access/visitorLog_edit',array('pigcms_id'=>$vo['pigcms_id']))}','查看详情',480,<if condition="$vo['pigcms_id']">240<else/>340</if>,true,false,false,editbtn,'edit',true);">详情</a> | <a href="javascript:void(0);" class="delete_row" parameter="pigcms_id={pigcms{$vo.pigcms_id}" url="{pigcms{:U('Access/visitorLog_del')}">删除</a></td>
            </tr>
            </volist>
            <tr><td class="textcenter pagebar" colspan="9">{pigcms{$visitor_list['pagebar']}</td></tr>
            <else/>
            <tr><td class="textcenter red" colspan="9">列表为空！</td></tr>
            </if>
            </tbody>
        </table>
    </div>
</div>
<include file="Public:footer"/>