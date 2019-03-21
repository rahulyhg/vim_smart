<include file="Public:header"/>

<div class="main-content">

    <!-- 内容头部 -->

    <div class="breadcrumbs" id="breadcrumbs">

        <ul class="breadcrumb">

            <li>

                <i class="ace-icon fa fa-tablet"></i>

                <a href="{pigcms{:U('Access/group')}">设备类型管理</a>

            </li>

            <li class="active">分组设置</li>

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

                    <form  class="form-horizontal" method="post" id="edit_form" action="{pigcms{:U('Access/deviceType_edit_do')}">

                        <input type="hidden" value="{pigcms{$actype_id}" name='actype_id'/>

                        <div class="tab-content">

                            <div id="basicinfo" class="tab-pane active">

                                <div class="form-group">

                                    <label class="col-sm-1"><label for="ag_name">设备名称</label></label>

                                    <input class="col-sm-2" size="20" name="actype_name" id="actype_name" type="text" value="{pigcms{$device_info.actype_name}"/>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-1"><label for="description">描述</label></label>

                                    <textarea id="actype_value" name="actype_value"  placeholder="描述内容">{pigcms{$device_info.actype_value|htmlspecialchars_decode=ENT_QUOTES}</textarea>

                                </div>

                            </div>

                        </div>

                        <div class="space"></div>

                        <div class="clearfix form-actions">

                            <div class="col-md-offset-3 col-md-9">

                                <button class="btn btn-info" type="submit">

                                    <i class="ace-icon fa fa-check bigger-110"></i>

                                    保存

                                </button>

                            </div>

                        </div>

                </div>

                </form>

            </div>

        </div>

    </div>

</div>

</div>




<style>

    .BMap_cpyCtrl{display:none;}

    input.ke-input-text {

        background-color: #FFFFFF;

        background-color: #FFFFFF!important;

        font-family: "sans serif",tahoma,verdana,helvetica;

        font-size: 12px;

        line-height: 24px;

        height: 24px;

        padding: 2px 4px;

        border-color: #848484 #E0E0E0 #E0E0E0 #848484;

        border-style: solid;

        border-width: 1px;

        display: -moz-inline-stack;

        display: inline-block;

        vertical-align: middle;

        zoom: 1;

    }

    .form-group>label{font-size:12px;line-height:24px;}

    #upload_pic_box{margin-top:20px;height:150px;}

    #upload_pic_box .upload_pic_li{width:130px;float:left;list-style:none;}

    #upload_pic_box img{width:100px;height:70px;border:1px solid #ccc;}

</style>


<include file="Public:footer"/>

<!--陈琦
    2016.6.8-->