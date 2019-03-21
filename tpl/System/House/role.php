<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('House/role')}" class="on">角色列表</a>
            <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('House/role_edit')}','添加角色',520,350,true,false,false,addbtn,'add',true);" style="margin-left:20px;">添加角色</a>
        </ul>
    </div>
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col  align="center"/>
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>角色名称</th>
                    <th>描述</th>
                    <th>创建时间</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="$role_list['role_list']">
                    <volist name="role_list['role_list']" id="vo">
                        <tr>
                            <td>{pigcms{$vo.role_id}</td>
                            <td>{pigcms{$vo.role_name}</td>
                            <td>{pigcms{$vo.role_desc}</td>
                            <td>{pigcms{$vo.add_time|date='Y-m-d H:i:s',###}</td>
                            <td class="textcenter">
                                <a href="javascript:void(0);"  onclick="window.top.artiframe('{pigcms{:U('House/menu',array('role_id'=>$vo['role_id']))}','设置角色使用权限',700,500,true,false,false,editbtn,'edit',true);">设置角色使用权限</a> |
                                <a href="javascript:void(0);"  onclick="window.top.artiframe('{pigcms{:U('House/role_edit',array('role_id'=>$vo['role_id']))}','编辑角色信息',480,<if condition="$vo['role_id']">240<else/>340</if>,true,false,false,editbtn,'edit',true);">编辑</a> |
                                <a href="javascript:void(0);" class="delete_row" parameter="role_id={pigcms{$vo.role_id}" url="{pigcms{:U('House/role_del')}">删除</a>
                            </td>
                        </tr>
                    </volist>
                    <tr><td class="textcenter pagebar" colspan="5">{pigcms{$role_list['pagebar']}</td></tr>
                    <else/>
                    <tr><td class="textcenter red" colspan="5">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>