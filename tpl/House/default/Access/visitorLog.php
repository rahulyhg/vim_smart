
<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-key"></i>
                <a href="{pigcms{:U('Access/visitorLog')}">访客登记记录</a>
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
                                <th width="12%">ID</th>
                                <th width="12%">微信名</th>
                                <th width="12%">真实姓名</th>
                                <th width="12%">手机号码</th>
                                <th width="12%">身份证</th>
                                <th width="12%">到访公司</th>
                                <th width="12%">时间</th>
                                <th class="button-column" width="12%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <if condition="$visitor_list['visitor_list']">
                                <volist name="visitor_list['visitor_list']" id="vo">
                                    <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                            <td><div class="tagDiv">{pigcms{$vo.pigcms_id}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.nickname}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.name}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.phone}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.id_card}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.company}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.add_time|date='Y-m-d H:i:s',###}</div></td>
                            <td class="button-column">
                                <a style="width: 60px;" class="label label-sm label-info" title="详情" href="{pigcms{:U('Access/visitorLog_edit',array('pigcms_id'=>$vo['pigcms_id']))}">详情</a>
                                <a style="width: 60px;" class="label label-sm label-info delete_row" title="删除" parameter_id="{pigcms{$vo.pigcms_id}">删除</a>
                            </td>
                            </tr>
                            </volist>

                            <else/>
                            <tr class="odd"><td class="button-column" colspan="8">列表为空！</td></tr>
                            </if>
                            </tbody>
                        </table>
                        <tr class="odd"><td class="button-column" colspan="8">{pigcms{$visitor_list['pagebar']}</td></tr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script>
$(function() {
    $('.delete_row').click(function (){
        if(window.confirm('你确定要删除吗？')){
			var del_idVal=$(this).attr('parameter_id');
			//alert(del_idVal);
			$.ajax({
				'url':"{pigcms{:U('Access/visitorLog_del')}",
				'data':{'pigcms_id':del_idVal},
				'type':'POST',
				'dataType':'JSON',
				'success':function (data) {
					if(data.err_code==0){	//删除成功
						//alert(data.code_data);
						window.location.reload();
					}else{
						alert(data.code_data);
					}
				},
				'error':function(){
					alert('loading error');
				}
			})
		}
    });
})
</script>

<include file="Public:footer"/>

<!--陈琦
    2016.6.8-->