<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-key"></i>
                <a href="{pigcms{:U('Access/index')}">设备管理</a>
            </li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <button class="btn btn-success" onclick="CreatePhone()">添加设备</button>

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
                                <th width="10%">名称</th>
                                <th width="10%">设备所属类型</th>
                                <th width="10%">平台</th>
                                <th width="10%">所属区域</th>
                                <th width="10%">状态</th>
                                <th width="10%">说明</th>
                                <th width="10%">时间</th>
                                <th class="button-column" width="15%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <if condition="$access_list['access_list']">
                                <volist name="access_list['access_list']" id="vo">
                                    <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                            <td><div class="tagDiv">{pigcms{$vo.ac_id}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.ac_name}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.actype_name}</div></td>
                            <td><div class="tagDiv">yeelink</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.ag_name}</div></td>
                            <td><div class="shopNameDiv"><span data_id="{pigcms{$vo.ac_id}" data_status="{pigcms{$vo.ac_status}" class="clickChange"><a href=""><if condition="$vo.ac_status eq '1' ">开启<else />关闭</if></a></span></div></td>
                            <td><div class="tagDiv">{pigcms{$vo.ac_desc}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.ac_time|date='Y-m-d H:i:s',###}</div></td>
                            <td class="button-column">
                                <a style="width: 60px;" class="label label-sm label-info" title="编辑" href="{pigcms{:U('Access/access_edit',array('ac_id'=>$vo['ac_id']))}">编辑</a>
                                <a style="width: 60px;" class="label label-sm label-info" title="删除" href="{pigcms{:U('Access/access_del',array('ac_id'=>$vo['ac_id']))}">删除</a>
								<!--<a style="width:80px;" class="label label-info handle_btn" href="{pigcms{$config.site_url}/index.php?g=Index&c=Recognition&a=access_qrcode&village_id={pigcms{$vo.village_id}">访客二维码</a>-->
								<a style="width:80px;" class="label label-info handle_btn" href="{pigcms{$config.site_url}/index.php?g=Index&c=Recognition&a=control_qrcode&village_id={pigcms{$vo.village_id}&ac_id={pigcms{$vo.ac_id}">设备二维码</a>
                            </td>
                            </tr>
                            </volist>

                            <else/>
                            <tr class="odd"><td class="button-column" colspan="9">列表为空！</td></tr>
                            </if>
                            </tbody>
                        </table>
                        <tr class="odd"><td class="button-column" colspan="9">{pigcms{$access_list['pagebar']}</td></tr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script>
    function CreatePhone(){
        window.location.href = "{pigcms{:U('Access/access_edit')}";
    }

    $(function(){
        $('.handle_btn').live('click',function(){
            art.dialog.open($(this).attr('href'),{
                init: function(){
                var iframe = this.iframe.contentWindow;
                window.top.art.dialog.data('iframe_handle',iframe);
            },
                id: 'handle',
                title:'二维码',
                padding: 0,
                width: 900,
                height: 900,
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

        $('.clickChange').click(function(){
            var ac_id = $(this).attr('data_id');
            var ac_status = $(this).attr('data_status');
            $.ajax({
                'url':"{pigcms{:U('Access/index')}",
                'data':{'ac_id':ac_id,'ac_status':ac_status},
                'type':'POST',
                'dataType':'JSON',
                'success':function (msg) {
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

    });
</script>
<include file="Public:footer"/>
<!--陈琦
    2016.6.8-->