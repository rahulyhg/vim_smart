<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('Access/index')}" class="on"> 设备列表</a>
            <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Access/add')}','添加设备',520,350,true,false,false,addbtn,'add',true);">添加设备</a>
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
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col width="180" align="center"/>
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>名称</th>
                    <th>类型</th>
                    <th>平台</th>
                    <th>所属区域</th>
                    <th>所属社区</th>
                    <th>状态</th>
                    <th>说明</th>
                    <th>时间</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="$access_list['access_list']">
                    <volist name="access_list['access_list']" id="vo">
                        <tr>
                            <td>{pigcms{$vo.ac_id}</td>
                            <td>{pigcms{$vo.ac_name}</td>
                            <td><if condition="$vo.type eq '1' ">门禁<else />停车</if></td>
                            <td>yeelink</td>
                            <td>{pigcms{$vo.ag_name}</td>
                            <td>{pigcms{$vo.village_name}</td>
                            <td><if condition="$vo.ac_status eq '1' ">开启<else />关闭</if></td>
                            <td>{pigcms{$vo.ac_desc}</td>
                            <td>{pigcms{$vo.ac_time|date='Y-m-d H:i:s',###}</td>
                            <td class="textcenter"><a href="javascript:void(0);"  onclick="window.top.artiframe('{pigcms{:U('Access/access_edit',array('ac_id'=>$vo['ac_id']))}','编辑设备信息',480,<if condition="$vo['ac_id']">240<else/>340</if>,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="ac_id={pigcms{$vo.ac_id}" url="{pigcms{:U('Access/access_del')}">删除</a></td>
                        </tr>
                    </volist>
                    <tr><td class="textcenter pagebar" colspan="10">{pigcms{$pagebar}</td></tr>
                    <else/>
                    <tr><td class="textcenter red" colspan="10">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>