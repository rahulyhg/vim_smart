<extend name="./tpl/System/Public_news/base.php" />
<block name="body">
            <style>
                .ace-file-input a {display:none;}
            </style>
                    <form  class="form-horizontal" method="post" id="edit_form" enctype="multipart/form-data" action="{pigcms{:U('Contract/contract_edit')}">
                        <div class="tab-content">
                            <div id="basicinfo" class="tab-pane active">
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="property_address">合同名称</label></label>
                                    <input class="col-sm-2" size="20" name="contract_name" id="contract_name" type="text" value="{pigcms{$shequArr.contract_name}" style="width: 50%"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="property_address">签订日期</label></label>
                                    <input class="col-sm-2" size="20" name="contract_start" id="contract_start" type="date" value="{pigcms{$shequArr.contract_start}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="property_address">截止日期</label></label>
                                    <input class="col-sm-2" size="20" name="contract_end" id="contract_end" type="date" value="{pigcms{$shequArr.contract_end}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">合同图片</label>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectImage">上传图片</a>
                                    <span class="form_tips">第一张将作为主图片！最多上传10个图片！</span>
                                </div>
                                <input type="hidden" name="id" value="{pigcms{$shequArr.id}" />
                                <div class="form-group">
                                    <label class="col-sm-1">图片预览</label>
                                    <div id="upload_pic_box">
                                        <ul id="upload_pic_ul">
                                            <volist name="shequArr['pic']" id="vo">
                                                <li class="upload_pic_li">
                                                    <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('look_img',array('url'=>$vo['url']))}">
                                                        <?php
                                                        $index = strrpos($vo['url'],'.');
                                                        $str = substr($vo['url'],$index+1);
                                                        if ($str == 'jpg' || $str == 'jpng' || $str == 'png') {
                                                            ?>
                                                            <img src="{pigcms{$vo.url}" />
                                                        <?php
                                                        } else {
                                                            ?>
                                                            <a href="{pigcms{$vo.url}" target='_blank'>附件下载</a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </a>
<!--                                                    <img src="{pigcms{$vo.url}" jqimg="{pigcms{$vo.url}" />-->
                                                    <input type="hidden" name="pic[]" value="{pigcms{$vo.title}"/><br/>
                                                    <a href="#" onclick="deleteImage('{pigcms{$vo.title}',this);return false;">[ 删除 ]</a>
                                                </li>
                                            </volist>
                                        </ul>
                                    </div>
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
                                <button type="button" onclick="window.location.href='{pigcms{:U(\'Contract/contract\')}'" class="btn default">返回</button>
                            </div>
                        </div>
                </div>
                </form>
</block>
<!--<script type="text/javascript" src="{pigcms{$static_path}js/area.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/map.js"></script>-->
<block name="head">
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
        .col-sm-1{width: 12%}
        .col-sm-2{width: 20%}
        .form-group>label{font-size:12px;line-height:24px;}
        #upload_pic_box{margin-top:20px;height:150px;}
        #upload_pic_box .upload_pic_li{width:130px;float:left;list-style:none;}
        #upload_pic_box img{width:100px;height:70px;border:1px solid #ccc;}
    </style>
    <link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">
</block>
<block name="script">

<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script src="{pigcms{$static_public}kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
    KindEditor.ready(function(K){
        var editor = K.editor({
            allowFileManager : true
        });
        K('#J_selectImage').click(function(){
            if($('.upload_pic_li').size() >= 10){
                alert('最多上传10个图片！');
                return false;
            }
            editor.uploadJson = "{pigcms{:U('Contract/store_ajax_upload_pic')}";
            editor.loadPlugin('image', function(){
                editor.plugin.imageDialog({
                    showRemote : false,
                    imageUrl : K('#course_pic').val(),
                    clickFn : function(url, title, width, height, border, align) {
                        var index=url.lastIndexOf("\.");
                        var str;
                        str = url.substring(index+1,url.length);
                        if (str == 'jpg' || str == 'jpng' || str == 'png') {
                            $('#upload_pic_ul').append("<li class=\"upload_pic_li\"><img src=\"" + url + "\"/><input type=\"hidden\" name=\"pic[]\" value=\"" + title + "\"/><br/><a href=\"#\" onclick=\"deleteImage(\'" + title + "\',this);return false;\">[ 删除 ]</a></li>");
                        } else {
                            $('#upload_pic_ul').append("<li class=\"upload_pic_li\"><a href=\""+url+"\" target='_blank'>附件下载</a><input type='\hidden\' name=\'pic[]\' value=\""+title+"\" /><br/><a href=\"#\" onclick=\"deleteImage('"+title+"',this);return false;\">[ 删除 ]</a></li>");
                        }
                        //$('#upload_pic_ul').append("<li class=\"upload_pic_li\"><img src=\"" + url + "\"/><input type=\"hidden\" name=\"pic[]\" value=\"" + title + "\"/><br/><a href=\"#\" onclick=\"deleteImage(\'" + title + "\',this);return false;\">[ 删除 ]</a></li>");
                        editor.hideDialog();
                    }
                });
            });
        });

    });
    function deleteImage(path, obj) {
        swal({
            title: "是否删除这条图片?",
            text: "删除图片后将无法恢复，确认要删除吗！",
            type: "warning",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "删除",
            cancelButtonText: "取消",
            closeOnConfirm: false,
            showCancelButton: true,
        }, function (iscom){
            if(iscom){
                $.post("{pigcms{:U('Contract/store_ajax_del_pic')}",{path:path});
                $(obj).closest('.upload_pic_li').remove();
                swal.close();
            }else{
                swal.close();
            }
        });
    };
    /*function deleteImage(path,obj){
        $.post("{pigcms{:U('Contract/store_ajax_del_pic')}",{path:path});
        $(obj).closest('.upload_pic_li').remove();
    }*/

</script>

</block>