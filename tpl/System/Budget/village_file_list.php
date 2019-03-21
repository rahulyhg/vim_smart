<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a  href="{pigcms{:U('Budget/village_file_upload',array('type_id'=>8))}">
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
    <div class="btn-group" style="margin-top: 10px">
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
                        <select id="datetimepicker"  class="form-control" placeholder="" name="startDate" v-model="year" onchange="change_url('year',this.options[this.options.selectedIndex].value)">
                            <for start="2017" end="date('Y')+2">
                                <option value="{pigcms{$i}">{pigcms{$i}</option>
                            </for>
                        </select>
                    </div>
                </span>
            </span>
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
                                <a  href="{pigcms{:U('Budget/village_file_upload',array('file_id'=>$vo['file_id']))}" >
                                    <i class="icon-tag"></i> 查看详情更新</a>
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

        function change_url(type,val) {
            console.log(val);
            window.location.href='{pigcms{:U('Budget/village_file_list')}&'+type+'='+val;
        }
        $('#datetimepicker').val('{pigcms{$year}');
        $('#file_status').val('{pigcms{$file_status}');
    </script>
</block>




