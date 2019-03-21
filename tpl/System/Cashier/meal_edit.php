<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>修改商品信息</h1>
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">商户管理</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">商品管理</a>
                <i class="fa fa-circle"></i>
            </li>
			<li>
                <span class="active">修改商品信息</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <form action="" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <input type="hidden" name="company_id" value="{pigcms{$company_id}"/>
                <div class="col-md-12" style="float: left">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">修改商品信息</span>
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

                                <if condition="$error_tips">
                                    <div class="alert alert-danger">
                                        <p>请更正下列输入错误:</p>
                                        <p>{pigcms{$error_tips}</p>
                                    </div>
                                </if>
                                <if condition="$ok_tips">
                                    <div class="alert alert-info">
                                        <p>{pigcms{$ok_tips}</p>
                                    </div>
                                </if>

                                <if condition="$now_store['store_type'] eq 3 or $now_store['store_type'] eq 4">
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">是否为客服中心
                                            <span class="required">*</span>
                                        </label>
                                        <div class="radio">
                                            <label>
                                                <input name="is_service" value="1" type="radio" <if condition="$now_meal['is_service'] eq 1" >checked="checked"</if>/>
                                                <span class="lbl" style="z-index: 1">是</span>
                                            </label>　
                                            <label>
                                                <input name="is_service" value="0" type="radio" checked="checked" />
                                                <span class="lbl" style="z-index: 1">否</span>
                                            </label>
                                        </div>
                                    </div>
                                </if>


                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">商品名称
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input class="form-control" size="20" name="name" id="name" type="text" value="{pigcms{$now_meal.name}"/>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">商品单位
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input class="form-control" size="20" name="unit" id="unit" type="text" value="{pigcms{$now_meal.unit}"/>
                                        <span class="help-block">必填。如个、斤、份</span>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">商品价格
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input class="form-control" size="20" name="price" id="price" type="text" value="{pigcms{$now_meal.price}"/>
                                        <span class="help-block">必填。</span>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">商品库存
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input class="form-control" size="20" name="stock_num" id="stock_num" type="text" value="{pigcms{$now_meal.stock_num}"/>
                                        <span class="help-block">0表示无限量。</span>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">商品排序
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input class="form-control" size="10" name="sort" id="sort" type="text" value="{pigcms{$now_meal.sort|default='0'}"/>
                                        <span class="help-block">默认添加顺序排序！手动调值，数值越大，排序越前</span>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">商品状态
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select name="status" id="Food_status">
                                            <option value="1" selected="selected">正常</option>
                                            <option value="0" >停售</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">{pigcms{$now_store['store_type']===3 ? "logo":"商品图片"}
                                        <span class="required">(可不填)</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input id="ytimage-file" type="hidden" value="" name="image"/>
                                        <input class="form-control" id="image-file" size="200" onchange="previewimage(this)" name="image" type="file"/>
                                        <span class="help-block">可不填。（图片文件大小不能超过{pigcms{$config.meal_pic_size}M,建议上传大尺寸的图片。） 图片宽度建议为195px，高度建议为146px</span>

                                        <div id="image_preview_box">
                                            <if condition="$now_meal['see_image']">
                                                <img src="{pigcms{$now_meal.see_image}" style="width:120px;height:120px"/>
                                            </if>
                                        </div>
                                    </div>
                                </div>



                                <if condition="$now_store['store_type'] neq 3">
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">是否外卖
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <label>
                                                <input name="waimai_status" value="1" type="radio"/>
                                                <span class="lbl" style="z-index: 1">是</span>
                                            </label>　
                                            <label>
                                                <input name="waimai_status" value="0" type="radio" checked="checked"/>
                                                <span class="lbl" style="z-index: 1">否</span>
                                            </label>
                                            <span class="help-block">必填。</span>
                                        </div>
                                    </div>
                                </if>

                                <!--                                是否为服务类-->
                                <if condition="$now_store['store_type'] eq 3 or $now_store['store_type'] eq 4">
                                    <!--                                批量上传轮播图-->
                                    <div class="form-group form-md-line-input" id="uploader">
                                        <label class="col-md-2 control-label banner_imgs_label" for="uploader">轮播图
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <div id="uploader" class="xb-uploader">
                                            <span id="add_button">
                                                请选择文件
                                            </span>

                                                <span class="help-block service_input" style="color:red;vertical-align: top">前四张为团队介绍图，后续图片会被当作轮播图</span>
                                                <div class="queueList">

                                                </div>
                                                <div class="statusBar" style="display:none;">
                                                    <div class="progress">
                                                        <span class="text">0%</span>
                                                        <span class="percentage"></span>
                                                    </div>
                                                    <div class="info"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label">轮播图片
                                        </label>
                                        <volist name="now_meal['banner_imgs']" id="vo">
                                            <img src="{pigcms{$vo}" width="60px" height="60px">
                                        </volist>
                                    </div>


                                    <!--                                    logo.-->

                                    <div></div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label">logo
                                            <span class="required">(可不填)</span>
                                        </label>
                                        <span class="col-sm-2" style="padding-left:0px;">
										<input id="ytimage-file" type="hidden" value="" name="logo"/>
										<input class="form-control" id="image-file2" size="200" onchange="previewimage2(this)" name="logo" type="file"/>
                                             <div id="image_preview_box2">
                                                <if condition="$now_meal['see_logo']">
											        <img src="{pigcms{$now_meal.see_logo}" style="width:120px;height:120px"/>
										        </if>
                                             </div><!-- 图片容器-->
									    </span>
                                        <span class="help-block" style="color:red;">可不填。（图片文件大小不能超过{pigcms{$config.meal_pic_size}M,建议上传大尺寸的图片。） 图片宽度建议为195px，高度建议为146px</span>
                                    </div>


                                    <!--                                    联系方式-->
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label">咨询热线
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input class="form-control" size="20" name="contact[]"  type="text" value="{pigcms{:explode(',',$now_meal['contact'])[0]}"/>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label">大堂前台电话
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input class="form-control" size="20" name="contact[]"  type="text" value="{pigcms{:explode(',',$now_meal['contact'])[1]}"/>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <!--                                    title-->
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label">预约标题
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input class="form-control" size="20" name="title"  type="text" value="{pigcms{$now_meal.title}"/>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </if>





                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">描述
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="col-sm-3" rows="5" maxlength="300" name="des" id="des">{pigcms{$now_meal.des}</textarea>
                                    </div>
                                </div>


                                <if condition="$print_list">
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">归属打印机
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <select name="print_id" id="print_id">
                                                <option value="0" selected>选择打印机</option>
                                                <volist name="print_list" id="print">
                                                    <option value="{pigcms{$print['pigcms_id']}">{pigcms{$print['name']}</option>
                                                </volist>
                                            </select>
                                            <span class="help-block" style="color:red;">如果选择了一台非主打印机的话，那么客户在下单的时候选择的打印机和主打印机同时打印，如果不选打印机或是选择了主打印机的话，那么就主打印机打印</span>
                                        </div>
                                    </div>
                                </if>


                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-9">
                                            <!--                                            <button type="button" class="btn green">确认提交</button>-->
                                            <!--                                            <button type="reset" class="btn default">清空重填</button>-->

                                            <button class="btn btn-info uploadBtn" type="submit"

                                            <if condition="$now_store['store_type'] eq 3 or $now_store['store_type'] eq 4">
                                                onclick="return false"
                                            </if>

                                            >
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            保存
                                            </button>
											<button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Cashier&a=meal_list&sort_id=52'">返 回</button>

                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
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
<link rel="stylesheet" href="./static/js/webuploader-0.1.5/xb-webuploader.css">
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="./static/js/upyun.js"></script>
<script type="text/javascript" src="./static/js/webuploader-0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="./static/js/helper.js"></script>

<!--<script type="text/javascript" src="./static/js/ace-elements.min.js"></script>-->
<!--<script type="text/javascript" src="./static/js/ace.min.js"></script>-->
<!--<script type="text/javascript" src="./static/js/ace-extra.min.js"></script>-->
<script type="text/javascript" src="./tpl/Merchant/default/static/js/ace-extra.min.js"></script>
<script type="text/javascript" src="./tpl/Merchant/default/static/js/bootbox.min.js"></script>
<script type="text/javascript" src="./tpl/Merchant/default/static/js/jquery-ui.custom.min.js"></script>
<script type="text/javascript" src="./tpl/Merchant/default/static/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="./tpl/Merchant/default/static/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="./tpl/Merchant/default/static/js/jquery.easypiechart.min.js"></script>
<script type="text/javascript" src="./tpl/Merchant/default/static/js/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="./tpl/Merchant/default/static/js/ace-elements.min.js"></script>
<!--<script type="text/javascript" src="./tpl/Merchant/default/static/js/ace.min.js"></script>-->
<!--<script type="text/javascript" src="./tpl/Merchant/default/static/js/jquery.yiigridview.js"></script>-->
<!--<script type="text/javascript" src="./tpl/Merchant/default/static/js/jquery-ui-i18n.min.js"></script>-->
<!--<script type="text/javascript" src="./tpl/Merchant/default/static/js/jquery-ui-timepicker-addon.min.js"></script>-->
</body>
<script>
    $(document).ready(function () {
        var url = "{pigcms{:U('store_news')}";
        menu_select(url);
    });
</script>
<script>
    $(function(){
        $('form.form-horizontal').submit(function(){
            $(this).find('button[type="submit"]').html('保存中...').prop('disabled',true);
        });

        /*调整保存按钮的位置*/
        $(".nav-tabs li a").click(function(){
            if($(this).attr("href")=="#imgcontent"){		//店铺图片
                $(".form-submit-btn").css('position','absolute');
                $(".form-submit-btn").css('top','670px');
            }else{
                $(".form-submit-btn").css('position','static');
            }
        });

        /*分享图片*/
        $('#image-file').ace_file_input({
            no_file:'gif|png|jpg|jpeg格式',
            btn_choose:'选择',
            btn_change:'重新选择',
            no_icon:'fa fa-upload',
            icon_remove:'',
            droppable:false,
            onchange:null,
            remove:false,
            thumbnail:false
        });

        /*分享图片2*/
        $('#image-file2').ace_file_input({
            no_file:'gif|png|jpg|jpeg格式',
            btn_choose:'选择',
            btn_change:'重新选择',
            no_icon:'fa fa-upload',
            icon_remove:'',
            droppable:false,
            onchange:null,
            remove:false,
            thumbnail:false
        });

        /*分享图片3*/
        $('#image-file3').ace_file_input({
            no_file:'gif|png|jpg|jpeg格式',
            btn_choose:'选择',
            btn_change:'重新选择',
            no_icon:'fa fa-upload',
            icon_remove:'',
            droppable:false,
            onchange:null,
            remove:false,
            thumbnail:false
        });

    });


    function previewimage(input){
        if (input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function (e) {$('#image_preview_box').html('<img style="width:120px;height:120px" src="'+e.target.result+'" alt="图片预览" title="图片预览"/>');}
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewimage2(input){
        if (input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function (e) {$('#image_preview_box2').html('<img style="width:120px;height:120px" src="'+e.target.result+'" alt="图片预览" title="图片预览"/>');}
            reader.readAsDataURL(input.files[0]);
        }
    }

    /**
     * 图片更新
     */
    helper.webuploader('#uploader','{pigcms{:U("ajax_upload")}',function(file ,response){
        //保存img_name
        var img_name =  $('#uploader').data("img_name")||[];
        img_name.push(file.name);
        $('#uploader').data("img_name",img_name);
        console.log(response);

    },function(){

        var img_name = $('#uploader').data("img_name");
        $('form').submit();
    });
    /**
     *
     */
    $(document).on('click','.state-pedding',function(){
        $('form').submit();
    });


    //初始化
    var current_service = "{pigcms{$now_store['store_type']}"==4;
    if(current_service==1){
        $('#is_service').hide();
        $('input[name="is_service"][value="1"]').click();
        $('.service_input').slideDown(200);
        $('.banner_imgs_label').text("介绍&轮播图");
        $('.title').slideUp(200);
        //$('.service_input').show(1000);
    }else{
        $('#is_service').hide();
    }
    //根据是否为服务中心 显示内容；
    $('input[name="is_service"]').on('click',function(){
        var is_service = $(this).val();
        if(is_service==1){
            $('.service_input').slideDown(200);
            $('.banner_imgs_label').text("介绍&轮播图");
            $('.title').slideUp(200);
            //$('.service_input').show(1000);
        }else{
            $('.service_input').slideUp(200);
            $('.banner_imgs_label').text("轮播图");
            $('.title').slideDown(200);
            //$('.service_input').hide(1000);
        }

    });

</script>
</html>