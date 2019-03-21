<extend name="./tpl/System/Public_news/base.php" />
<block name="body">
    <div class="row">
        <form  class="form-horizontal" method="post" id="type_form" enctype="multipart/form-data" action="__SELF__" autocomplete="off">
            <div class="tab-content" id="filter">
                <div id="basicinfo" class="tab-pane active">
                    <div class="form-group">
                        <div class="col-sm-2 control-label">所属项目</div>
                        <div class="col-sm-9" style="padding-top: 7px;" >
                            <span style="padding-top: 7px">{pigcms{$village_name}</span>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                         <div class="col-sm-2 control-label">当前所选类目</div>
                         <div class="col-sm-9" style="padding-top: 7px;">
                             <span>{pigcms{$type_info['type_name']}</span>
                         </div>
                     </div>-->
                    <div class="form-group">
                        <div class="col-sm-2 control-label">年份</div>
                        <div class="col-sm-9" style="padding-top: 7px;">
                            <div class="btn-group">
                                <select id="datetimepicker"  class="form-control" placeholder="" name="year" <if condition="$file_info">disabled="disabled"</if>>
                                    <for start="2017" end="date('Y')+2">
                                        <option value="{pigcms{$i}">{pigcms{$i}</option>
                                    </for>
                                </select>
                            </div>
                        </div>
                    </div>
                    <if condition="empty($file_info) or $file_info['file_status'] eq 3">
                        <div class="form-group form-md-line-input">
                            <div class="col-sm-2 control-label">文件上传</div>
                            <div class="col-md-9">
                                <label for="file" class=" btn btn-default" id="file_button">点击上传文件</label>
                                <input type="file" id="file" name="file" style="display:none;"  onchange="change_text(this,'file_button')">
                                <span style="color: red">*多个文件时请先打包成压缩包或分多次上传</span>
                            </div>
                        </div>
                    </if>
                    <if condition="$file_info['file_path']">
                        <div class="form-group form-md-line-input">
                            <div class="col-sm-2 control-label">当前已有的文件</div>
                            <div class="col-md-9" style="padding-top: 7px">
                                <a href="{pigcms{$file_info['file_path']}" download="{pigcms{$file_info['file_name']}">点击下载</a>
                            </div>
                        </div>
                    </if>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">文件备注</div>
                        <div class="col-sm-9">
                            <textarea class="form_control" name="file_remark">{pigcms{$file_info['file_remark']}</textarea>
                        </div>
                    </div>
                    <div class="space"></div>
                    <div class="form-actions"></div>
                    <if condition="empty($file_info) or $file_info['file_status'] eq 3">
                        <div class="row">
                            <div class="col-sm-2 control-label"></div>
                            <div class="col-md-offset-2 col-md-9">
                                <button type="submit" class="btn green">确认提交</button>
                                <button type="reset" class="btn default" data-dismiss="modal">关闭</button>
                            </div>
                        </div>
                    </if>
                </div>
            </div>

        </form>
    </div>
</block>
<block name="script">
    <script>
        function change_text(input,change) {
            $('#'+change).html('已选择：'+$(input).val());
        }
        $('#datetimepicker').val('{pigcms{$year}');
    </script>
</block>