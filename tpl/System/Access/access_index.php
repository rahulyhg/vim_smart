<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('Access/access_index')}" class="on">设备列表</a>
            <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Access/access_edit')}','添加设备',520,350,true,false,false,addbtn,'add',true);">添加设备</a>
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
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col  align="center"/>
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>名称</th>
                    <th>设备所属类型</th>
                    <th>当前平台</th>
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
                            <td>{pigcms{$vo.actype_name}</td>
                            <td>{pigcms{$vo.terrace_id}</td>
                            <td>{pigcms{$vo.ag_name}</td>
                            <td>{pigcms{$vo.village_name}</td>
                            <td><span data_acVal="{pigcms{$vo.ac_id}" data_status="{pigcms{$vo.ac_status}" class="statusChange"><a href=""><if condition="$vo['ac_status'] eq '1' ">开启<else />关闭</if></a></span></td>
                            <td>{pigcms{$vo.ac_desc}</td>
                            <td>{pigcms{$vo.ac_time|date='Y-m-d H:i:s',###}</td>
                            <td class="textcenter"><a href="javascript:void(0);"  onclick="window.top.artiframe('{pigcms{:U('Access/access_edit',array('ac_id'=>$vo['ac_id']))}','编辑设备信息',480,<if condition="$vo['ac_id']">240<else/>340</if>,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="ac_id={pigcms{$vo.ac_id}" url="{pigcms{:U('Access/access_del')}">删除</a></td>
                </tr>
                </volist>
                <tr><td class="textcenter pagebar" colspan="10">{pigcms{$access_list['pagebar']}</td></tr>
                <else/>
                <tr><td class="textcenter red" colspan="10">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function(){
        $('.statusChange').click(function(){	//改变状态
            var ac_id=$(this).attr('data_acVal');	//ID值
            var ac_status=$(this).attr('data_status');	//状态值
            $.ajax({
                'url':"{pigcms{:U('Access/access_index')}",
                'data':{'ac_id':ac_id,'ac_status':ac_status},
                'type':'POST',
                'dataType':'JSON',
                'success':function(msg){
                    if(msg.msg_code==0){
                        alert(msg.msg_data);
                        window.location.reload();
                    }else{
                        alert(msg.msg_data);
                    }
                },
                'error':function(){
                    //alert('loading error');
                }
            })
        })
    })
</script>
<include file="Public:footer"/>