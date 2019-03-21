<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .dropdown-menu {
        margin: 0 0 0 -90px;
    }
</style>
<!--头部设置-->
<?php
$title = array(
    'title'=>'楼层管理',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('巡更管理','#'),
);

?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<div class="table-toolbar">
    <div class="btn-group">
        <div class="col-md-6">
            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/point_add')}">
                    <button id="sample_editable_1_new" class="btn sbold green">添加巡更点
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="btn-group">
        <if condition="$_GET['is_del'] eq 0">
            <a href="{pigcms{:U('',array('is_del'=>1))}">
                <button id="sample_editable_1_new" class="btn sbold green">查看已停用巡更点
                </button>
            </a>
        <else />
            <a href="{pigcms{:U('',array('is_del'=>0))}">
                <button id="sample_editable_1_new" class="btn sbold green">返回
                </button>
            </a>
        </if>
    </div>

    <!-- <div class="btn-group" style="float:right;">
        <span>筛选：</span>
        <span>
            <div class="btn-group">
               <select name="meter_type_id" id="" class="form-control" v-model="selected_meter_type">
                    <option value="">请选择点位类型</option>
                    <option v-for="(type,index) in tree" v-bind:value="3">全部</option>
                    <option v-for="(type,index) in tree" v-bind:value="0">启用</option>
                    <option v-for="(type,index) in tree" v-bind:value="1">停用</option>
                </select>
            </div>
        </span>
    </div> -->
</div>
<div id="shopList" class="grid-view">
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
            <th width="10%">ID</th>
            <th width="10%">楼层</th>
            <th width="35%">方位</th>
            <th width="10%">所属社区</th>
            <th width="10%">备注</th>
            <th width="10%">状态</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="pointArray" id="vo">
                <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                <td><div class="tagDiv">{pigcms{$vo.id}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.room_name}</div></td>
            <td><div class="tagDiv"><if condition="$vo['name'] neq ''">{pigcms{$vo.name}<else />{pigcms{$vo.orientation}</if></div></td>
                <td><div class="shopNameDiv">{pigcms{$vo.village_name}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.desc}</div></td>
                <if condition="$vo['is_del'] eq 0">
                    <td>
                    <button class="btn btn-sm green btn-outline filter-submit margin-bottom" id="point_type_{pigcms{$vo.id}" value="{pigcms{$vo.is_del}" onclick="changeType(this)">启用</button>
                    <input type="hidden" id="point_type_{pigcms{$vo.id}_id" value="{pigcms{$vo['id']}">                  
                    </td>
                <else/>
                    <td>
                    <button class="btn btn-sm red btn-outline filter-submit margin-bottom" id="point_type_{pigcms{$vo.id}" value="{pigcms{$vo.is_del}" onclick="changeType(this)">停用</button>
                    <input type="hidden" id="point_type_{pigcms{$vo.id}_id" value="{pigcms{$vo['id']}">
                    </td>
                </if>
                <td class="button-column">
                <div class="btn-group">
                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                    <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                    <li>
                        <a href="{pigcms{:U('point_update',array('id'=>$vo['id']))}">
                            <i class="icon-tag"></i> 编辑 </a>
                    </li>
                    <li>
                        <a href="{pigcms{:U('qrcode_point',array('rid'=>$vo['rid']))}"
                           data-toggle="modal"
                           data-target="#modal_{pigcms{$vo.rid}">
                            <i class="icon-tag"></i> 巡更二维码 </a>
                    </li>
                </ul>
                </div>
                </td>               
                </tr>
            <!--弹出层容器-->
            <div class="modal fade" tabindex="-1" role="dialog" id="modal_{pigcms{$vo.rid}">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                    </div>
                </div>
            </div>
            <!--        弹出层容器-->
        </volist>
        </tbody>
    </table>

</div>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script>
    //隐藏
    $('.summary').hide();
    function read(obj){
        if(confirm('您确定要标记为已处理？')){
            var bindid = $(obj).attr('bindid');
            var cid = $(obj).attr('pid');
            $.post("{pigcms{:U('do_repair')}",{bind_id:bindid,cid:cid},function(result){
                if(result.error == 0){
                    window.location.reload();
                }
            })
        }
    }
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

<script>
    function changeType(id) {
        var is_del_id = $(id).attr('id');
        // var point_id_id = is_del+'_id';

        var is_del = $("#"+is_del_id).val();
        var point_id = $("#"+is_del_id+"_id").val();

        // console.log(is_del);
        // console.log(point_id);

        $.ajax({
            url:'{pigcms{:U("point_type")}',
            type:'post',
            data:{'is_del':is_del, 'point_id':point_id},
            success:function (re) {
                if (is_del == 0) {
                    if (re) {
                        $('#'+is_del_id).html('停用');
                        $('#'+is_del_id).css("background-color","red");
                        // alert('该点位已停用');
                    }
                } else {
                    if (re) {
                        $('#'+is_del_id).html('启用');
                        $('#'+is_del_id).css("background-color","green");
                        // alert('该点位已启用');
                    }
                }
            }
        });
    }

    //点位的状态：开启与关闭
    // $("#point_type_{pigcms{$vo.id}").click(function(){
    //     var is_del = $("#point_type_{pigcms{$vo.id}").val();
    //     var point_id = $("#point_id_{pigcms{$vo.id}").val();
    //     console.log(is_del);
    //     console.log(point_id);
    //     // $.ajax({
    //     //      url:'{pigcms{:U("point_type")}',
    //     //      type:'post',
    //     //      data:{'is_del':is_del, 'point_id':point_id},
    //     //      success:function (re) {
    //     //         if (re) {
    //     //             alert('该点位已停用');
    //     //         }
    //     //     }
    //     // });
    // });
</script>

<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
