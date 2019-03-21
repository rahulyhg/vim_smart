<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>编辑新闻信息
                </h1>
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">信息发布</a>
                <i class="fa fa-circle"></i>
            </li>
			<li>
                <a href="#">通知公告</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">编辑新闻信息</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <form action="{pigcms{:U('news_edit')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <input type="hidden" name="news_id" value="{pigcms{$info.news_id}">
                <div class="col-md-12" style="float: left">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">编辑新闻信息</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-cloud-upload"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-wrench"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-trash"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->

                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> 您填写的信息可能存在问题，请再检查 </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> 添加成功，请查看记录列表 </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">标题
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="title" id="title" value="{pigcms{$info.title}"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">选择社区
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select name="village_id" id="village_id">
                                            <option selected="selected" value="1" <if condition="$info['village_id'] eq '1'">selected="selected"</if>>全社区通用</option>
                                            <volist name="village" id="v">
                                                <if condition="$info['village_id'] eq $v['village_id']">
                                                    <option value="{pigcms{$v.village_id}" selected="selected">{pigcms{$v.village_name}</option>
                                                    <else/>
                                                    <option value="{pigcms{$v.village_id}">{pigcms{$v.village_name}</option>
                                                </if>
                                            </volist>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input" id="cat">
                                        <label class="col-md-2 control-label" for="form_control_1">选择分类
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <select name="cat_id" id="cat_id">
                                                <volist name="cate" id="v">
                                                    <option value="{pigcms{$v.cat_id}" <if condition="$v.cat_id eq $info.cat_id">selected</if>>{pigcms{$v.cat_name}</option>
                                                </volist>
                                            </select>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                </div>


                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">发布内容
                                        <span class="required">*</span>
                                    </label>
<!--                                    <div class="col-md-9">-->
<!--                                        <input type="text" class="form-control" placeholder="" name="content" value="{pigcms{$info.content}" id="content" />-->
<!--                                        <div class="form-control-focus"> </div>-->
<!--                                    </div>-->
                                    <textarea id="description" name="content"  placeholder="写上一些想要发布的内容">{pigcms{$info['content']|htmlspecialchars_decode=ENT_QUOTES}</textarea>
                                </div>

                                <div class="form-group form-md-radios">
                                    <label class="col-md-3 control-label" for="form_control_1">是否热门</label>
                                    <div class="col-md-9">
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" id="checkbox1_9" name="is_hot" value="1" class="md-radiobtn" <if condition="$info['is_hot'] eq 1"> checked="checked" </if> />
                                                <label for="checkbox1_9">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 是 </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="checkbox1_10" name="is_hot" value="0" class="md-radiobtn" <if condition="$info['is_hot'] eq 0"> checked="checked" </if> />
                                                <label for="checkbox1_10">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 否 </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group form-md-radios">
                                    <label class="col-md-3 control-label" for="form_control_1">状态</label>
                                    <div class="col-md-9">
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" id="checkbox1_11" name="status" value="1" class="md-radiobtn" <if condition="$info['status'] eq 1"> checked="checked" </if> />
                                                <label for="checkbox1_11">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 显示 </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="checkbox1_12" name="status" value="0" class="md-radiobtn" <if condition="$info['status'] eq 0"> checked="checked" </if>/>
                                                <label for="checkbox1_12">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 关闭 </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-9">
                                            <button type="submit" class="btn green">确认提交</button>
                                            <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=House&a=news_news'">返 回</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer" style="text-align: center">
    <div class="page-footer-inner" style="width: 100%"> 2017 &copy; 汇得行智慧助手系统
        <a target="_blank" href="http://www.vhi99.com">邻钱科技</a> &nbsp;|&nbsp;
        <a href="http://www.metronic.com" target="_blank">Metronic</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<div class="quick-nav-overlay"></div>
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/excanvas.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/Car/Admin/Public/js/jquery.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!--表单提交检查js-->
<!--<script src="{$Think.config.ADMIN_ASSETS_URL}pages/scripts/form-validation-md.min.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--引入百度文件上传JS开始-->
<script src="/Car/Admin/Public/js/baiduwebuploader/webuploader.js" type="text/javascript"></script>
<!--引入百度文件上传JS结束-->

<!--引入日历jquery插件开始-->
<!--
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.js" type="text/javascript"></script>
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.min.js" type="text/javascript"></script>-->

<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<!--引入日历jquery插件结束-->

<script type='text/javascript'>
    //开启日历插件
    $(function(){
        $("#mybutton").click(function(){
            var tr="<tr name='add_tr'><th width='80'>其他参数</th><td> <input type='text' class='input fl' name='arguments[]' size='10' placeholder='参数'/> <input type='text' class='input fl' name='arguments_value[]' size='10' placeholder='参数值'/></td></tr>";
            $("*[name='add_tr']:last").after(tr);
        });
        $("#mybutton2").click(function(){
            var td_length = $("#form_sample_1 input").length;
            var pot = td_length-2;
            if(td_length>7){
                $("#table tr:eq("+pot+")").remove();
            }
        });
    });
    $('#datetimepicker').datetimepicker({
        lang:"ch",           //语言选择中文
        format:"Y-m-d H:i:s",      //格式化日期
        timepicker:false,    //关闭时间选项
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        todayButton:false    //关闭选择今天按钮
    });
    $('#datetimepicker2').datetimepicker({
        lang:"ch",           //语言选择中文
        format:"Y-m-d H:i:s",      //格式化日期
        timepicker:false,    //关闭时间选项
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        todayButton:false    //关闭选择今天按钮
    });

</script>
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>

<script type="text/javascript">

    KindEditor.ready(function(K){

        kind_editor = K.create("#description",{

            width:'400px',

            height:'400px',

            resizeType : 1,

            allowPreviewEmoticons:false,

            allowImageUpload : true,

            filterMode: true,

            items : [

                'source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',

                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',

                'insertunorderedlist', '|', 'emoticons', 'image', 'link'

            ],

            emoticonsPath : './static/emoticons/',

            uploadJson : "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=merchant/news"

        });

    });



</script>
<script>
    $(function () {
        $("#village_id").change(function () {
            var village_id = $(this).val();
            $.ajax({
                url:"{pigcms{:U('get_cate')}",
                data:'village_id='+village_id,
                type:'post',
                dataType:'json',
                success:function (res) {
                    console.log(res);
                    if(res.error===0){
                        $("#cat").html('');
                        var content = '';
                        var option='';
                        for(var i=0;i<res.msg.length;i++){
                            option+='<option value='+res.msg[i].cat_id+'>'+res.msg[i].cat_name+'</option>';
                        }
                        content+='<label class="col-md-2 control-label" for="form_control_1">选择分类<span class="required">*</span></label>';
                        content+='<div class="col-md-9"><select name="cat_id" id="cat_id">'+option+'</select><div class="form-control-focus"></div></div>';
                        $("#cat").append(content);
                    }else{
                        $("#cat").html('');
                    }

                }
            })


        })
    })
</script>
</body>

</html>