<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('House/company')}" class="on">公司管理</a>
            <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('House/company_edit')}','添加公司',520,300,true,false,false,addbtn,'add',true);">添加公司</a>
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
                    <col/>
                    <col width="180" align="center"/>
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>公司名称</th>
                    <th>所属社区</th>
                    <th>联系方式</th>
                    <th>时间</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="$company_list">
                    <volist name="company_list" id="vo">
                        <tr>
                            <td>{pigcms{$vo.company_id}</td>
                            <td>{pigcms{$vo.company_name}</td>
                            <td>{pigcms{$vo.village_name}</td>
                            <td>{pigcms{$vo.company_phone}</td>
                            <td>{pigcms{$vo.add_time|date='Y-m-d H:i:s',###}</td>
                            <td class="textcenter">
                                <a href="javascript:void(0);"  onclick="window.top.artiframe('{pigcms{:U('House/company_edit',array('company_id'=>$vo['company_id']))}','编辑公司信息',480,<if condition="$vo['company_id']">240<else/>340</if>,true,false,false,editbtn,'edit',true);">编辑</a> |
                                <a href="javascript:void(0);" class="delete_row" parameter="company_id={pigcms{$vo.company_id}" url="{pigcms{:U('House/company_del')}">删除</a>
                            </td>
                        </tr>
                    </volist>
                    <tr><td class="textcenter pagebar" colspan="9">{pigcms{$pagebar}</td></tr>
                    <else/>
                    <tr><td class="textcenter red" colspan="9">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>