<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<!--头部设置-->
<?php
$title = array(
    'title'=>'巡更管理',
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
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/room_list')}">
                    <button id="sample_editable_1_new" class="btn sbold green">楼层管理
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>

            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/point_list')}">
                    <button id="sample_editable_1_new" class="btn sbold green">巡更点管理
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>

    <br/>
    <br/>



</div>



<div id="shopList" class="grid-view">
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>

            <th width="10%">楼层</th>
            <th width="10%">方位</th>
            <th width="10%">状态</th>
        </tr>
        </thead>
        <tbody>
        <volist name="lowPointList" id="vo">
                <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                <td><div class="tagDiv">{pigcms{$vo.room_name}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.oname}</div></td>
                <td><div class="tagDiv" style="color: red">未巡更</div></td>
                </tr>
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

    $("input[name='choose_time']").change(function(){
        var d_time = $("input[name='choose_time']").val();
        window.location.href='/admin.php?g=System&c=PropertyService&a=point_record&d_time='+d_time;
    });
</script>


<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
