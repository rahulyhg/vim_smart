<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('Access/group_index')}" class="on">区域管理列表</a>
            <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Access/group_edit')}','添加区域',520,350,true,false,false,addbtn,'add',true);">添加区域</a>
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
                    <col/>
                    <col width="180" align="center"/>
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>区域</th>
                    <th>所属社区</th>
                    <th>说明</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="$group_info">
                    <volist name="group_info" id="vo">
                        <tr>
                            <td>{pigcms{$vo.ag_id}</td>
                            <td>{pigcms{$vo.ag_name}</td>
                            <td>{pigcms{$vo.village_name}</td>
                            <td>{pigcms{$vo.ag_desc}</td>
                            <td class="textcenter"><a href="javascript:void(0);"  onclick="window.top.artiframe('{pigcms{:U('Access/group_edit',array('ag_id'=>$vo['ag_id']))}','编辑区域信息',480,<if condition="$vo['ag_id']">240<else/>340</if>,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="ag_id={pigcms{$vo.ag_id}" url="{pigcms{:U('Access/group_del')}">删除</a></td>
                </tr>
                </volist>
                <tr><td class="textcenter pagebar" colspan="5">{pigcms{$pagebar}</td></tr>
                <else/>
                <tr><td class="textcenter red" colspan="5">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>