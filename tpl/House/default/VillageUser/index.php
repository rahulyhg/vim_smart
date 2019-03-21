
<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-user"></i>
                <a href="{pigcms{:U('VillageUser/index')}">用户列表</a>
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
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="10%">微信名</th>
                                <th width="10%">真实姓名</th>
                                <th width="10%">手机号码</th>
                                <th width="10%">公司</th>
                                <th width="10%">部门</th>
                                <th width="10%">工牌号</th>
                                <th width="10%">地址</th>
                                <th width="10%">时间</th>
                                <!--<th width="10%">状态</th>-->
                                <th width="10%">是否设为管理员</th>
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
									<td><div class="tagDiv">{pigcms{$vo.company}</div></td>
									<td><div class="tagDiv">{pigcms{$vo.department}</div></td>
									<td><div class="tagDiv">{pigcms{$vo.usernum}</div></td>
									<td><div class="tagDiv">{pigcms{$vo.address}</div></td>
									<td><div class="tagDiv">{pigcms{$vo.add_time|date='Y-m-d H:i:s',###}</div></td>
									<!--<td><div class="shopNameDiv"><if condition="$vo.ac_status eq '1' ">审核中</if><if condition="$vo.ac_status eq '2' || $vo.ac_status eq '4'">通过</if><if condition="$vo.ac_status eq '3' ">未通过</if></div></td>-->
									<td><div class="shopNameDiv"><span data_id="{pigcms{$vo.pigcms_id}" data_status="{pigcms{$vo.is_sadmin}" class="clickChange"><a href=""><if condition="$vo.is_sadmin eq '1' ">否<else />是</if></a></span></div></td>
									<td class="button-column">
										<a style="width:80px;" class="label label-sm label-info" title="详情" href="{pigcms{:U('VillageUser/VillageUserCheck_edit',array('pigcms_id'=>$vo['pigcms_id']))}">详情</a>                             
									</td>
								</tr>
								</volist>
                            <else/>
								<tr class="odd"><td class="button-column" colspan="12">列表为空！</td></tr>
                            </if>
                            </tbody>
                        </table>
                        <tr class="odd"><td class="button-column" colspan="12">{pigcms{$userCheck_list['pagebar']}</td></tr>
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
        $('.clickChange').click(function(){
            var pigcms_id = $(this).attr('data_id');
            var is_sadmin = $(this).attr('data_status');
           // alert(pigcms_id+'---'+is_sadmin);
            $.ajax({
                'url':"{pigcms{:U('VillageUser/index')}",
                'data':{'pigcms_id':pigcms_id,'is_sadmin':is_sadmin},
                'type':'POST',
                'dataType':'JSON',
                'success':function(msg){
                    if(msg.msg_code==0){
                        alert(msg.msg_data);
                        window.location.reload();
                    }else{
                        alert(msg.msg_data);
						/*var strs='';
						for(var i=0;i<msg.msg_data.length;i++){
							strs+=msg.msg_data[i]+'---';
						}
						alert(strs);*/
                    }
                },
                'error':function(){
                   alert('loading error');
                }
            })
        })
    });
</script>
<include file="Public:footer"/>
<!--陈琦
    2016.6.21-->