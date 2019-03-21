<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<!--头部设置-->
<?php
$title = array(
    'title'=>'设备管理',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('设备管理','http://www.hdhsmart.com/admin.php?g=System&c=PropertyService&a=meter_lists_news'),
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<div id="shopList" class="grid-view">
<!--    导入-->
    <div class="btn-group">
        <a href="{pigcms{:U('import_meter')}">
            <button id="sample_editable_1_new" class="btn sbold green">导入设备
                <i class="fa fa-plus"></i>
            </button>
        </a>
        <a href="{pigcms{:U('add_meter')}">
            <button id="sample_editable_1_new" class="btn sbold green">手动添加设备
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <div style="height:10px"></div>

    <table class="table table-striped table-bordered table-hover" id="sample_1">
        <thead>

        <tr>
            <th>ID</th>
            <th>设备编号</th>
            <th>设备类型</th>
            <th>楼层</th>
             <th>所属租户</th>
             <th>上月止码</th>
             <th>当月用量</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="list" id="row">
            <!--        设备编号、设备类型、楼层、所属租户、上月止码、当月止码、-->
            <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
            <td>{pigcms{$row.id}</td>
            <td><div class="tagDiv">{pigcms{$row.meter_code}</div></td>
            <td><div class="tagDiv">{pigcms{$row.meter_type_desc}</div></td>
            <td><div class="tagDiv">{pigcms{$row.meter_floor}</php></div></td>
            <td>
                <div class="tagDiv">
                    <if condition="count($row['tenantnames'])">
                        <php>echo join(',',$row['tenantnames'])</php>
                        <else />
                        未绑定公司
                    </if>
                </div>
            </td>
            <td><div class="shopNameDiv">{pigcms{:explode(',',$row['be_cousume'])[1]}</div></td>
            <td>
                <div class="shopNameDiv">
                    <if condition="$row['consume']">
                        {pigcms{:intval($row[consume])}
                        <else />
                        未录入
                    </if>

                </div>
            </td>
<!--            <td class="button-column">-->
<!--                <button style="width: 60px;" class="label label-sm label-info handle_btn" title="二维码" href="{pigcms{:U('meter_qr',array('meter_hash'=>$row['meter_hash']))}" >二维码</button>-->
<!--            </td>-->
            <td class="button-column">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position: absolute; margin-left:-90px;">
                        <li>
                            <a class="handle_btn" href="{pigcms{:U('meter_qr',array('meter_hash'=>$row['meter_hash']))}"">
                            <i class="icon-docs"></i> 二维码 </a>
                        </li>
                        <li>
                            <a href="{pigcms{:U('edit_meter',array('meter_hash'=>$row['meter_hash']))}"">
                            <i class="icon-docs"></i> 编辑 </a>
                        </li>
                        <li>
                            <a href="{pigcms{:U('logic_del_meter',array('meter_hash'=>$row['meter_hash']))}"">
                            <i class="icon-docs"></i> 逻辑删除 </a>
                        </li>
                    </ul>
<!--                    &nbsp;<a class="handle_btn" href="{pigcms{:U('meter_qr',array('meter_hash'=>$row['meter_hash']))}"">二维码</a>-->
                </div>
            </td>
            </tr>
        </volist>
        </tbody>
    </table>
<!--    <if condition="$repair_list['totalPage'] gt 1">{pigcms{$repair_list.pagebar}</if>-->
</div>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script>
    $(function(){
        $('.handle_btn').on('click',function(){
            art.dialog.open($(this).attr('href'),{
                init: function(){
                    var iframe = this.iframe.contentWindow;
                    window.top.art.dialog.data('iframe_handle',iframe);
                },
                id: 'handle',
                title:'查看详情',
                padding: 0,
                width: 820,
                height: 520,
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

    });
</script>
<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
