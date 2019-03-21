<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'站点配置',
    'describe'=>'',
);
$breadcrumb = array(
    array('系统设置','#'),
    array('站点配置','#'),
);

?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区开始-->

<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/components.min.css" id="style_components" rel="stylesheet" type="text/css" />


<div class="tabbable tabbable-tabdrop">
    <ul class="nav nav-tabs">
        <li class="dropdown pull-right tabdrop">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-ellipsis-v"></i>&nbsp;
                <i class="fa fa-angle-down"></i>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <volist name="group_list" id="vo" offset="15">
                    <li>
                        <a href="{pigcms{:U('Config/index_news',array('gid'=>$vo['gid']))}" data-toggle="tab" onclick="window.location.href=this.href">{pigcms{$vo.gname}</a>
                    </li>
                </volist>
                <li>
                    <a href="{pigcms{:U('Config/property_service')}" data-toggle="tab" onclick="window.location.href=this.href">物业配置</a>
                </li>


            </ul>
        </li>

        <if condition="empty($_GET['galias'])">

                    <volist name="group_list" id="vo" offset="0" length="15">

                        <li class="{pigcms{$gid==$vo['gid']?'active':''}">
                            <a href="{pigcms{:U('Config/index_news',array('gid'=>$vo['gid']))}" aria-expanded="{pigcms{$gid==$vo['gid']?'true':'false'}" >{pigcms{$vo.gname}</a>
                        </li>

                    </volist>

            <else/>

            <if condition="$header_file">

                <include file="$header_file"/>

            </if>
        </if>
    </ul>

    <div class="tab-content" style="margin-top:15px;">

    </div>
</div>
<style>
    .table th {border:none !important;font-weight: 300 !important;color:#666 !important;vertical-align: middle !important;text-align: right }
    .table tr {border:none !important; height:50px;}
    .table td {border:none !important;}
	tbody {display:table; width:100%;}
</style>


<div class="table-responsive">
    <form id="myform" method="post" action="{pigcms{:U('Config/amend')}" refresh="true">
<!--        <div class="form-group form-md-line-input">-->
<!--            <input type="text" class="form-control" placeholder="" name="nickname" id="cat_name" value="东纸是one豆马麻">-->
<!--            <div class="form-control-focus"> </div>-->
<!--        </div>-->
        {pigcms{$config_tab_html}

        {pigcms{$config_html}
<!---->
<!--        <div class="btn" style="margin-top:20px;">-->
<!---->
<!--            <input TYPE="submit"  name="dosubmit" value="提交" class="button" />-->
<!---->
<!--            <input type="reset"  value="取消" class="button" />-->
<!---->
<!--            <if condition="empty($_GET['galias'])">-->
<!---->
<!--                <input type="button"  value="获取及时聊天的key" class="button" id="im_key"/>-->
<!---->
<!--                <input type="button"  value="微信API接口填写信息" class="button" onclick="window.top.artiframe('{pigcms{:U('Config/show',array('id'=>$vo['id']))}','API接口信息',560,100,true,false,false,'','add',true);"/>-->
<!---->
<!--                <input type="button"  value="获取生活服务充值的key" class="button" id="live_service_key"/>-->
<!---->
<!--            </if>-->
<!---->
<!--        </div>-->





        <div class="btn" style="padding-top:15px; padding-left:15.7%;">

            <input TYPE="submit"  name="dosubmit" class="btn" style="background-color:#00a0fe;color:#fff" value="提交" class="button" />

            <input type="reset" class="btn btn-success" style="margin-left:10px;" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Index&a=index_new'"  value="返回" class="button" />

            <if condition="empty($_GET['galias'])">

                <input type="button" class="btn btn-danger" style="margin-left:10px;" value="获取及时聊天的key" class="button" id="im_key"/>

                <input type="button" class="btn yellow"  style="margin-left:10px;" value="微信API接口填写信息" class="button" onclick="window.top.artiframe('{pigcms{:U('Config/show',array('id'=>$vo['id']))}','API接口信息',560,100,true,false,false,'','add',true);"/>

                <input type="button" class="btn blue-hoki" style="margin-left:10px;"  value="获取生活服务充值的key" class="button" id="live_service_key"/>

            </if>

        </div>
    </form>
</div>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script>
    //获取配置标签的gid
    var config_gid = parseInt("{pigcms{:I('get.gid',0,'int')}")||0;




    //样式重置
    $('#myform').addClass('form-group form-md-line-input');
    $('#myform table').show().addClass('table');


    $('#myform th').removeAttr("width")
        .width('15%').css('min-width','100px')
    ;
    $('input[type="text"]').addClass("form-control");



    //含有标签页的gid
    var have_tap_gids = [2,5,6,7];
    if(have_tap_gids.indexOf(config_gid)>-1){
        $('.tab_ul').addClass('nav nav-pills');
        $('table').wrapAll('<div class="tab-content"></div>');
        $('table').addClass('tab-pane');
        $('table').eq(0).addClass('active');
    }
</script>


<script>

    $(function(){

        $('.table_form:eq(0)').show();



        $('.tab_ul li a').click(function(){

            $(this).closest('li').addClass('active').siblings('li').removeClass('active');

            $($(this).attr('href')).show().siblings('.table_form').hide();

        });

        $('#im_key').click(function(){

            window.top.msg(2,'正在请求中,请稍等...',true,100);

            $.get("{pigcms{:U('Config/im')}",function(data){

                if(data.error_code){

                    window.top.msg(0,data.msg,true,3);

                }else{

                    window.top.msg(1,data.msg,true,3);

                }

            },'json');

        });

        $('#live_service_key').click(function(){

            window.top.msg(2,'正在请求中,请稍等...',true,100);

            $.get("{pigcms{:U('Config/live_service')}",function(data){

                if(data.error_code){

                    window.top.msg(0,data.msg,true,3);

                }else{

                    window.top.msg(1,data.msg,true,3);

                }

            },'json');

        });

    });

</script>

<link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">

<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>

<script src="{pigcms{$static_public}kindeditor/lang/zh_CN.js"></script>

<script type="text/javascript">

    KindEditor.ready(function(K){

        var site_url = "{pigcms{$config.site_url}";

        var editor = K.editor({

            allowFileManager : true

        });

        $('.config_upload_image_btn').click(function(){

            var upload_file_btn = $(this);

            editor.uploadJson = "{pigcms{:U('Config/ajax_upload_pic')}";

            editor.loadPlugin('image', function(){

                editor.plugin.imageDialog({

                    showRemote : false,

                    clickFn : function(url, title, width, height, border, align) {

                        upload_file_btn.siblings('.input-image').val(site_url+url);

                        editor.hideDialog();

                    }

                });

            });

        });

        $('.config_upload_file_btn').click(function(){

            var upload_file_btn = $(this);

            editor.uploadJson = "{pigcms{:U('Config/ajax_upload_file')}&name="+upload_file_btn.siblings('.input-file').attr('name');

            editor.loadPlugin('insertfile', function(){

                editor.plugin.fileDialog({

                    showRemote : false,

                    clickFn : function(url, title, width, height, border, align) {

                        upload_file_btn.siblings('.input-file').val(url);

                        editor.hideDialog();

                    }

                });

            });

        });

    });

</script>


<!--自定义js代码区结束-->
<include file="Public_news:footer"/>


