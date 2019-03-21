<extend name="./tpl/System/Public_news/base.php" />

<block name="table-toolbar-left">
    <style type="text/css">
        .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td{
            border: 1px solid #dddddd;
        }
    </style>

            <div class="btn-group">
                <a href="{pigcms{:U('Personnel_checking_in/excel_check_input')}">
                    <button id="sample_editable_1_new" class="btn sbold green">考勤表导入
                    </button>
                </a>
            </div>





        <!--    筛选-->
        <br/>
        <div class="btn-group" style="margin-top:10px;">
            <form action="__SELF__" method="get">
                <input type="hidden" name="g" value="System"/>
                <input type="hidden" name="c" value="Personnel_checking_in"/>
                <input type="hidden" name="a" value="checking_in_list_news"/>
                <span id="filter">
                <span>
					<span style="line-height:30px;">筛选：</span>
                    <div class="btn-group">
                        <select name="check_in_status" id="check_in_status"  class="form-inline search" style="line-height:34px; height:34px; border:1px #CCCCCC solid; margin-right:7px; margin-top:-1px;"><!--onchange="change_url('record_status',this.options[this.options.selectedIndex].value)"-->
                                <option value="4">全部</option>
                                <option value="1">待审核</option>
                                <option value="2">审核成功</option>
                                <!--<option value="3">驳回</option>-->
                        </select>
                    </div>
                    <div class="btn-group">
                        <input type="text" id="datetimepicker"  class="form-inline" placeholder="" name="starttime" value="{pigcms{:date('Y-m-d',$starttime)}" style="line-height:34px; height:34px; border:1px #CCCCCC solid; margin-right:7px; padding-left:5px;" autocomplete="off">
                         至&nbsp;
                        <input type="text" id="datetimepicker1"  class="form-inline" placeholder="" name="endtime" value="{pigcms{:date('Y-m-d',$endtime-24*3600)}" style="line-height:34px; height:34px; border:1px #CCCCCC solid; margin-right:7px; padding-left:5px;" autocomplete="off">
                    </div>
                </span>
                    <input class="btn green " type="submit" value="提交筛选"/>
            </span>
            </form>
        </div>
        <!--<div class="btn-group" style="margin-top:10px;">
            <button  class="btn sbold red" id="download">下载当前展示的全部条目
            </button>
        </div>-->



</block>
<block name="body">
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
            <th width="5%">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th width="10%">所属部门</th>
            <th width="5%">考勤员</th>
            <th width="5%">部门/服务中心负责人</th>
            <th width="10%">上传时间</th>
            <th width="10%">审核状态</th>
            <th width="10%">审核时间</th>
            <th width="10%">备注</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="check_in_list" id="vo">
            <td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" value="{pigcms{$vo.check_in_id}" />
                    <span></span>
                </label>
            </td>
            <td><div class="shopNameDiv">{pigcms{$vo.department_name}</div></td>
            <td><div class="tagDiv" id="{pigcms{$vo.record_id}-money">{pigcms{$vo.ci_name}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.pm_name}</div></td>
            <td><div class="tagDiv">{pigcms{:date('Y-m-d H:i:s',$vo['uploadtime'])}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.status_name}</div></td>
            <td><div class="tagDiv"><if condition="$vo['checktime']">{pigcms{:date('Y-m-d H:i:s',$vo['checktime'])}</if></div></td>
            <td><div class="tagDiv">{pigcms{$vo['remark']}</div></td>
            <td class="button-column noExl">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">
                        <li>
                            <a href="{pigcms{:U('Personnel_checking_in/check_in_watch',array('id'=>$vo['check_in_id']))}" >
                                <i class="icon-tag"></i> 查看详情 </a>
                        </li>
                        <if condition="$vo['status']==2">
                            <li>
                                <a href="{pigcms{:U('Personnel_checking_in/check_excel_output',array('id'=>$vo['check_in_id']))}" >
                                    <i class="icon-tag"></i> 下载考勤表 </a>
                            </li>
                            <li>
                                <a href="{pigcms{:U('Personnel_checking_in/check_online_output',array('id'=>$vo['check_in_id']))}" >
                                    <i class="icon-tag"></i> 在线打印考勤表 </a>
                            </li>
                        </if>
                        <if condition="unserialize($vo['type_file'])">
                            <li>
                                <a href="{pigcms{:U('Personnel_checking_in/check_download_file',array('id'=>$vo['check_in_id']))}" >
                                    <i class="icon-tag"></i> 打包下载附件 </a>
                            </li>
                        </if>


                    </ul>
                </div>
            </td>
            </tr>
        </volist>
        </tbody>
    </table>
</block>

<block name="script">
    <style>
        .xdsoft_datetimepicker{
            z-index: 10000000;
        }
    </style>
    <script src="./static/js/jquery-table2excel.min.js"></script>
    <script>
        $.datetimepicker.setLocale('ch');
        $('#datetimepicker').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'{pigcms{:date('Y-m-d',$starttime)}',
            /*datepicker: false,//关闭日期选项*/
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false,    //关闭选择今天按钮
            scrollMonth:false      //关闭鼠标滚轮事件
        });
        $('#datetimepicker1').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'{pigcms{:date('Y-m-d',$endtime-24*3600)}',
            /*datepicker: false,//关闭日期选项*/
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false,    //关闭选择今天按钮
            scrollMonth:false      //关闭鼠标滚轮事件
        });
        $('#record_check_time').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'{pigcms{:date('Y-m-d')}',
            /*datepicker: false,//关闭日期选项*/
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false,    //关闭选择今天按钮
            scrollMonth:false      //关闭鼠标滚轮事件
        });
        $('.record_check_time').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'{pigcms{:date('Y-m-d')}',
            /*datepicker: false,//关闭日期选项*/
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false,    //关闭选择今天按钮
            scrollMonth:false,      //关闭鼠标滚轮事件
            scrollTime:false,
            scrollInput:false
        });

        $("#download").click(function () {
            $("#sample_1").table2excel({
                exclude  : ".noExl", //过滤位置的 css 类名
                filename : "条目记录导出.xls", //文件名称
                name: "Excel Document Name.xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true

            });
        });
        $(".search").change(
            function () {
                var search=$('#property_status').children('option:selected').val();
                //console.log(p1);
                $('input[aria-controls="sample_1"]').val(search).keyup();
            }
        );

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
            hideInput2.name="ym";
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
        $('#check_in_status').val('{pigcms{$check_in_status}');

        function change_url(type,val) {
            console.log(val);
            window.location.href='{pigcms{:U('Budget/check_record_list')}&'+type+'='+val;
        }

        function change_check_time(name,id) {
            var record_check_time=$(name).val();
            var url="{pigcms{:U('Budget/ajax_change_check_time')}";
            $.ajax({
                url:url,
                type:'post',
                data:'id='+id+'&record_check_time='+record_check_time,
                dataType:'json',
                success:function (re) {
                    if(re.err==0){
                        swal({
                            title: "修改成功！",
                            text: '您已成功修改！',
                            type: "success",
                            html:true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "确认",
                            closeOnConfirm: true,
                            timer:800
                        });
                    }else{
                        swal({
                            title: "修改失败",
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
                swal({title:"正在处理审核中，请耐心等待。",showLoaderOnConfirm:true});
                var url = "{pigcms{:U('Budget/check_record_batch')}";
                //用post方式传递
                var project_id='';
                openPostWindow(url,ids,ym,project_id);
            }
        }
        function check_list() {
            var money=0;
            var count=0;
            $(".checkboxes").each(function() {
                if ($(this).is(':checked') && $(this).val() != '') {
                    money +=Number($('#'+$(this).val()+'-money').html());
                    count++;
                }
            });
            $('#check_num').html(count);
            $('#check_money').html(money);
        }
    </script>
</block>




