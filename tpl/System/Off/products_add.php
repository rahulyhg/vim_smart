<layout name="layout"/>
<!--引入日历插件样式 -->
<!-- BEGIN CONTENT --><style type="text/css">
<!--
.form .form-actions, .portlet-form .form-actions {
    padding: 20px;
    margin: 0;
    background-color: #ffffff;
    border-top: 1px solid #e7ecf1;
}
-->
</style>

<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>添加物品
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{pigcms{:U('Off/off_list_news')}">物品管理</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">添加物品</span>
            </li>
        </ul>
        <div class="row">
            <form action="{pigcms{:U('Off/products_save')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{pigcms{$_GET['id']}"/>
                <div class="col-md-12" style="float: left">
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">添加物品</span>
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
                                    <label class="col-md-2 control-label" for="form_control_1">物品名称
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="pro_name" id="pro_name" placeholder="请输入物品名称"  required />
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input" id="village">
                                    <label class="col-md-2 control-label" for="form_control_1">所属分类
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="off_pro_type"  required>
<!--                                            <option value="0">顶级分类</option>-->
                                            <foreach name="typeArr" item="vo">
                                                <option value="{pigcms{$vo.id}">{pigcms{$vo.type_name}</option>
                                                <if condition="isset($vo['son'])">
                                                    <foreach name="vo['son']" item="v">
                                                        <option value="{pigcms{$v.id}">|--{pigcms{$v.type_name}</option>
                                                        <if condition="isset($v['g_son'])">
                                                            <foreach name="v['g_son']" item="sv">
                                                                <option value="{pigcms{$sv.id}">|--|--{pigcms{$sv.type_name}</option>
                                                            </foreach>
                                                        </if>
                                                    </foreach>
                                                </if>
                                            </foreach>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="form-group form-md-line-input" id="village">
                                    <label class="col-md-2 control-label" for="form_control_1">所属区域
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="zone_id"  required>
                                                                                        <option value="0">顶级分类</option>
                                            <foreach name="zone_list" item="vo">
                                                <option value="{pigcms{$vo.id}">{pigcms{$vo.zone_name}</option>
                                                <if condition="isset($vo['son'])">
                                                    <foreach name="vo['son']" item="v">
                                                        <option value="{pigcms{$v.id}">|--{pigcms{$v.zone_name}</option>
                                                        <if condition="isset($v['g_son'])">
                                                            <foreach name="v['g_son']" item="sv">
                                                                <option value="{pigcms{$sv.id}">|--|--{pigcms{$sv.zone_name}</option>
                                                            </foreach>
                                                        </if>
                                                    </foreach>
                                                </if>
                                            </foreach>
                                        </select>
                                    </div>
                                </div> -->
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">计量单位
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="pro_unit" size="20" placeholder="请输入计量单位，比如件或者个。"  value="" required />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <!-- <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">最大库存
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="pro_stock" size="20" placeholder="请输入物品库存"  value="" required />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div> -->

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">采购日期
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="date" class="form-control" name="purch_time" id="purch_time" size="20"   value="" required />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">品牌
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="band" id="band" size="20" placeholder="请输入物品品牌"  value="" required />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">单价
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="pro_price"  placeholder="请输入物品单价"  value=""  required />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">供应商
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="pro_supplier" placeholder="请输入物品供应商"  value="" required />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">物品描述
                                <span class="required">（可选）</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="pro_desc" size="20" placeholder=""  value=""/>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div><div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">物品规格
                                <span class="required">（可选）</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="pro_specification" size="20" placeholder=""  value=""/>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">附件
                                <span class="required">（可选）</span>
                            </label>
                            <div class="col-md-9">
                                <input type="file" name="attachment_id" />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">物品状态
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <span class="cb-enable"><label class="cb-enable "><span>领用</span><input type="radio" name="product_status" value="1"  /></label></span>

                                <span class="cb-disable"><label class="cb-disable  selected"><span>借用</span><input type="radio" name="product_status" value="2" checked /></label></span>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                   	<div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-9">
                                <button type="submit" class="btn green">确认提交</button>
                                <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Off&a=off_list_news'">返 回</button>
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
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer" style="text-align: center">
    <div class="page-footer-inner" style="width: 100%"> 2018 &copy; 汇得行智慧助手系统
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!--引入日历jquery插件开始-->
<!--
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.js" type="text/javascript"></script>
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.min.js" type="text/javascript"></script>-->

<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<!--引入日历jquery插件结束-->


</body>

</html>