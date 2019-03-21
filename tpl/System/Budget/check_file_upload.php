<extend name="./tpl/System/Public_news/base.php" />
<block name="body">
    <div class="row">
        <form  class="form-horizontal" method="post" id="type_form" enctype="multipart/form-data" action="__SELF__" autocomplete="off">
            <div class="tab-content" id="filter">
                <div id="basicinfo" class="tab-pane active">
                    <div class="form-group">
                        <div class="col-sm-2 control-label">所属项目</div>
                        <div class="col-sm-9" style="padding-top: 7px;" >
                            <div class="btn-group">
                                <select name="company_id" id="company_id"  class="form-control search" v-model="company_id" <if condition="$file_info">disabled="disabled"</if>>
                                    <option value="">请选择</option>
                                    <option v-for="(index,key) in list" v-bind:value="key">{{index['deptname']}}</option>
                                </select>
                            </div>
                            <div class="btn-group">
                                <select name="project_id" id="project_id"  class="form-control search" v-model="project_id_change" <if condition="$file_info">disabled="disabled"</if>>
                                    <option value="">请选择</option>
                                    <option v-for="(index1,key1) in project_list" v-bind:value="key1">{{index1}}</option>
                                </select>
                            </div>
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
                                <select id="datetimepicker"  class="form-control" placeholder="" name="year" v-model="year">
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
                    <div class="form-group">
                        <div class="col-sm-2 control-label">审核状态</div>
                        <div class="col-sm-9" >
                            <div class="md-radio">
                                <input name="file_status" type="radio" class="mt-radio" value="1" id="checkbox1_1" v-model="file_status">
                                <label for="checkbox1_1">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 待审核 </label>
                            </div>
                            <div class="md-radio">
                                <input name="file_status" type="radio" class="mt-radio" value="2" id="checkbox1_2" v-model="file_status">
                                <label for="checkbox1_2" class="text-success">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 审核通过 </label>
                            </div>
                            <div class="md-radio">
                                <input name="file_status" type="radio" class="mt-radio" value="3" id="checkbox1_3" v-model="file_status">
                                <label for="checkbox1_3" class="text-danger">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 驳回 </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">审核备注</div>
                        <div class="col-sm-9">
                            <textarea class="form_control" name="file_check_remark">{pigcms{$file_info['file_check_remark']}</textarea>
                        </div>
                    </div>
                    <div class="space"></div>
                    <div class="form-actions"></div>
                    <div class="row">
                        <div class="col-sm-2 control-label"></div>
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn green">确认提交</button>
                            <button type="reset" class="btn default" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
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
        new Vue({
            el:"#filter",
            data:{
                list:{pigcms{$project_list},
                    company_id:'{pigcms{$company_id}',
                    project_id_change:'{pigcms{$project_id_change}',
                    year:'{pigcms{$year}',
                    file_status:'<if condition="$file_info">{pigcms{$file_info["file_status"]}<else/>1</if>'
                },
                computed: {
                    project_list: function () {
                        /*var list_second = {};*/
                        var list = this.list[this.company_id]['list'];
                        /*console.log(this.list_third);*/
                        return list;
                    }
                },
                methods: {

                }

            });
    </script>
</block>