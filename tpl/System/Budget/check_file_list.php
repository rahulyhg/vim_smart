<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a  href="{pigcms{:U('Budget/check_file_upload',array('type_id'=>8))}">
            <button id="sample_editable_1_new" class="btn sbold green">点击上传新文件
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <br/>
    <!--<div class="btn-group">
        <a href="{pigcms{:U('Budget/check_money_list_change')}">
            <button  class="btn sbold green" >上传文件
            </button>
        </a>
    </div>-->
    <!--    筛选-->
    <div class="btn-group" style="margin-top: 10px;">
        <span>筛选：</span>
        <span id="filter">
                <span>
                    <div class="btn-group">
                        <select name="file_status" id="file_status"  class="form-control search" v-model="file_status" onchange="change_url('file_status',this.options[this.options.selectedIndex].value)">
                            <option value="4">全部状态</option>
                            <option value="1">待审核</option>
                            <option value="2">审核通过</option>
                            <option value="3">驳回</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select name="company_id" id="company_id"  class="form-control search" v-model="company_id" onchange="change_url('company_id',this.options[this.options.selectedIndex].value)">
                            <option value="all">全部公司</option>
                             <option v-for="(index,key) in list" v-bind:value="key">{{index['deptname']}}</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select name="project_id" id="project_id"  class="form-control search" v-model="project_id_change" onchange="change_url('project_id_change',this.options[this.options.selectedIndex].value)">
                            <option value="all">全部项目</option>
                            <option v-for="(index1,key1) in project_list" v-bind:value="key1">{{index1}}</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select id="datetimepicker"  class="form-control" placeholder="" name="startDate" v-model="year" onchange="change_url('year',this.options[this.options.selectedIndex].value)">
                            <for start="2017" end="date('Y')+2">
                                <option value="{pigcms{$i}">{pigcms{$i}</option>
                            </for>
                        </select>
                    </div>
                    <div class="btn-group" style="margin-top:10px;">
                        <a href="#form_modal2" data-toggle="modal" >
                        <button  class="btn sbold green" >批量审核通过选中
                        </button>
                        </a>
                    </div>
                </span>
            </span>
    </div>
    <div id="form_modal2" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="width: 60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">批量审核</h4>
                </div>
                <div class="modal-body">
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <div class="form-group">
                            <div class="col-sm-2 control-label">设置审核备注</div>
                            <div class="col-sm-9" >
                                <input placeholder="不填写则默认为批量审核" class="form-control" name="record_check_time" id="record_check_time" type="text"  autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn green"  id="handInput" type="button" onclick="sub()">确认提交</button>
                    <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                    <!--<button class="btn green"  onclick="updateTime()">更新</button>-->

                </div>
                </form>
            </div>

        </div>
    </div>

</block>
<block name="body">
    <div class="tabbable-custom nav-justified">
        <table class="table table-striped table-bordered table-hover" id="sample_1" >
            <thead>
            <!--<tr>
                <td colspan="7" align="center" style="font-size: 25px"></td>
            </tr>-->
            <tr>
                <th width="5%">
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                        <span></span>
                    </label>
                </th>
                <th width="10%">文件名称</th>
                <th width="5%">备注</th>
                <th width="10%">上次更新时间</th>
                <th width="10%">所属公司</th>
                <th width="10%">所属项目</th>
                <th width="10%">审核状态</th>
                <th width="10%">审核时间</th>
                <th width="5%">审核备注</th>
                <th width="15%">操作</th>
            </tr>
            </thead>
            <tbody>
            <volist name="file_list" id="vo" key="ke">
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="{pigcms{$vo.file_id}" />
                        <span></span>
                    </label>
                </td>
                    <td><div  style="width: 100%;"><div class="tagDiv">{pigcms{$vo['file_name']}</div></div></td>
                    <td><div  style="width: 100%;"><div class="tagDiv">{pigcms{$vo['file_remark']}</div></div></td>
                    <td><div  style="width: 100%;"><div class="tagDiv">{pigcms{:date('Y-m-d H:i:s',$vo['file_update_time'])}</div></div></td>
                    <td><div  style="width: 100%;"><div class="tagDiv">{pigcms{$vo['company_name']}</div></div></td>
                    <td><div  style="width: 100%;"><div class="tagDiv">{pigcms{$vo['village_name']}</div></div></td>
                    <td>
                        <if condition="$vo['file_status'] eq 1">
                            <span style="color: blue">待审核</span>
                            <elseif condition="$vo['file_status'] eq 2"/>
                            <span style="color: green">审核通过</span>
                            <elseif condition="$vo['file_status'] eq 3"/>
                            <span style="color: red">驳回</span>
                        </if>
                    </td>
                <td><div  style="width: 100%;"><if condition="$vo['file_check_time']">{pigcms{:date('Y-m-d H:i:s',$vo['file_check_time'])}</if></div></td>
                <td><div  style="width: 100%;">{pigcms{$vo['file_check_remark']}</div></td>

                <td><div class="btn-group">
                            <a target="_blank" href="{pigcms{:U('check_file_online',array('file_id'=>$vo['file_id']))}" title="仅支持部分格式在线预览">
                                <button class="btn btn-xs green dropdown-toggle" type="button">在线预览
                                </button>
                            </a>
                            <a href="{pigcms{$vo['file_path']}" download="{pigcms{$vo['file_name']}">
                                <button class="btn btn-xs green dropdown-toggle" type="button">下载
                                </button>
                            </a>
                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" style="float: none;"> 操作
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu" style="position:absolute;float: none;">
                                    <li>
                                        <a  href="{pigcms{:U('Budget/check_file_upload',array('file_id'=>$vo['file_id']))}" >
                                            <i class="icon-tag"></i> 查看详情更新</a>
                                    </li>
                                    <if condition="$vo['file_status'] eq 1">
                                        <li>
                                            <a  href="{pigcms{:U('Budget/check_file_checkout',array('file_id'=>$vo['file_id']))}" >
                                                <i class="icon-tag"></i> 审核通过</a>
                                        </li>
                                    </if>
                                    <li>
                                        <a href="javasrcipt:;" onclick="delete_file({pigcms{$vo['file_id']})" >
                                            <i class="icon-tag"></i> 删除</a>
                                    </li>
                                </ul>
                        </div></td>
                </tr>


            </tr>



            </volist>
            </volist>
            </tbody>
        </table>
    </div>
</block>
<block name="script">
    <script>
        $.datetimepicker.setLocale('ch');
        /*$('#datetimepicker').datetimepicker({
         lang:"zh",           //语言选择中文
         format:"Y",      //格式化日期
         timepicker:false,    //关闭时间选项
         datepicker: false,//关闭日期选项
         yearStart:2000,     //设置最小年份
         yearEnd:2050,        //设置最大年份
         todayButton:false    //关闭选择今天按钮
         });*/


        new Vue({
            el:"#filter",
            data:{
                list:{pigcms{$project_list},
                    company_id:'{pigcms{$company_id}',
                        project_id_change:'{pigcms{$project_id_change}',
                        year:'{pigcms{$year}',
                        file_status:'{pigcms{$file_status}',
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

        function change_url(type,val) {
            console.log(val);
            window.location.href='{pigcms{:U('Budget/check_file_list')}&'+type+'='+val;
        }
        function delete_file($file_id) {
            swal({
                    title: "确认删除该文件吗？",
                    text: "请确认,删除后不可还原",
                    type: "warning",
                    html:true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确认",
                    cancelButtonText: "取消",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm){
                    var url='{pigcms{:U('Budget/check_file_delete')}';
                    if (isConfirm) {
                        $.ajax({
                            url:url,
                            type:'post',
                            data:'file_id='+file_id,
                            dataType:'json',
                            success:function (re) {
                                if(re.err==0){
                                    swal({
                                        title: "删除成功！",
                                        text: '您已成功删除该文件！',
                                        type: "success",
                                        html:true,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "确认",
                                        closeOnConfirm: true,
                                        timer:800
                                    });
                                    window.location.reload();
                                }else{
                                    swal({
                                        title: "删除失败",
                                        text: re.msg,
                                        type: "warning",
                                        html:true,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "确认",
                                        closeOnConfirm: true
                                    });
                                }
                            }
                        });
                    }
                });
        }
        function openPostWindow(url,idStr,yms,project_id){

            var tempForm = document.createElement("form");
            tempForm.id = "tempForm1";
            tempForm.method = "post";
            tempForm.action = url;
            tempForm.target="_self"; //自身打开
            var hideInput1 = document.createElement("input");
            hideInput1.type = "hidden";
            hideInput1.name="ids"; //后台要接受这个参数来取值
            hideInput1.value = idStr; //后台实际取到的值
            var hideInput2 = document.createElement("input");
            hideInput2.type = "hidden";
            hideInput2.name="file_check_remark";
            hideInput2.value = yms;
            var hideInput3 = document.createElement("project_id");
            hideInput3.type = "hidden";
            hideInput3.name="project_id";
            hideInput3.value = project_id;
            tempForm.appendChild(hideInput1);
            tempForm.appendChild(hideInput2);
            tempForm.appendChild(hideInput3);
            if(document.all){
                tempForm.attachEvent("onsubmit",function(){});        //IE
            }else{
                var subObj = tempForm.addEventListener("submit",function(){},false);    //firefox
            }
            document.body.appendChild(tempForm);
            if(document.all){
                tempForm.fireEvent("onsubmit");
            }else{
                tempForm.dispatchEvent(new Event("submit"));
            }
            tempForm.submit();
            document.body.removeChild(tempForm);
        }
        //批量审核方法
        function sub() {
            var ids = '';
            var ym=$('#record_check_time').val();
            // alert(ym);
            $(".checkboxes").each(function() {
                if ($(this).is(':checked') && $(this).val() != '') {
                    ids += ',' + $(this).val(); //逐个获取id
                }
            });
            ids = ids.substring(1);
            if (ids.length == 0) {
                swal({
                    title: "请选择需要通过审核的条目",
                    text: '当前没有条目被选中',
                    type: "warning",
                    html:true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确认",
                    closeOnConfirm: true
                });
            } else {
                var url = "{pigcms{:U('Budget/check_file_autocheck')}";
                //用post方式传递
                var project_id='';
                openPostWindow(url,ids,ym,project_id);
            }
        }
    </script>
</block>




