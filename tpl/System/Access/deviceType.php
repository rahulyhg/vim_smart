<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('Access/deviceType')}" class="on">设备类型列表</a>
            <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Access/deviceType_edit')}','添加设备类型',520,350,true,false,false,addbtn,'add',true);">添加设备类型</a>
        </ul>
    </div>

    <!--table class="search_table" width="100%">
        <tr>
            <td>
                <form action="{pigcms{:U('House/village')}" method="get">
                    <input type="hidden" name="c" value="User"/>
                    <input type="hidden" name="a" value="village"/>
                    筛选: <input type="text" name="keyword" class="input-text" value="{pigcms{$_GET['keyword']}"/>
                    <select name="searchtype">
                        <option value="uid" <if condition="$_GET['searchtype'] eq 'uid'">selected="selected"</if>>用户ID</option>
                        <option value="nickname" <if condition="$_GET['searchtype'] eq 'nickname'">selected="selected"</if>>昵称</option>
                        <option value="phone" <if condition="$_GET['searchtype'] eq 'phone'">selected="selected"</if>>手机号</option>
                    </select>
                    <input type="submit" value="查询" class="button"/>
                </form>
            </td>
        </tr>
    </table-->
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col width="180" align="center"/>
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>设备类型名称</th>
                    <th>说明</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="$deviceType_info">
                    <volist name="deviceType_info" id="vo">
                        <tr>
                            <td>{pigcms{$vo.actype_id}</td>
                            <td>{pigcms{$vo.actype_name}</td>
                            <td>{pigcms{$vo.actype_value}</td>
                            <td class="textcenter"><a href="javascript:void(0);"  onclick="window.top.artiframe('{pigcms{:U('Access/deviceType_edit',array('actype_id'=>$vo['actype_id']))}','编辑区域设备类型信息',480,<if condition="$vo['actype_id']">240<else/>340</if>,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="actype_id={pigcms{$vo.actype_id}" url="{pigcms{:U('Access/deviceType_del')}">删除</a></td>
                </tr>
                </volist>
                <tr><td class="textcenter pagebar" colspan="4">{pigcms{$pagebar}</td></tr>
                <else/>
                <tr><td class="textcenter red" colspan="4">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>