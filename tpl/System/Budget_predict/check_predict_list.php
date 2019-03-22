<extend name="./tpl/System/Public_news/base.php" />

<block name="table-toolbar-left">
    <style type="text/css">
        .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td{
            border: 1px solid #dddddd;
        }
    </style>
        <!--    筛选-->
        <br/>
        <div class="btn-group" style="margin-top:10px;">
            <form action="__SELF__" method="post">
                <span id="filter">
                <span>
					<span style="line-height:30px;">筛选：</span>
                    <div class="btn-group">
                        <select name="predict_status" id="predict_status"  class="form-inline search" style="width:100px;line-height:34px; height:34px; border:1px #CCCCCC solid; margin-right:7px; margin-top:-1px;"><!--onchange="change_url('record_status',this.options[this.options.selectedIndex].value)"-->
                                <option value="4">全部</option>
                                <option value="1">待审核</option>
                                <option value="2">审核成功</option>
                                <option value="3">驳回</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select name="year" id="year" class="form-inline search" style="width:100px;line-height:34px; height:34px; border:1px #CCCCCC solid; margin-right:7px; margin-top:-1px;">
                            <option value="{pigcms{:date('Y')-1}" >{pigcms{:date('Y')-1}</option>
                            <option value="{pigcms{:date('Y')}" >{pigcms{:date('Y')}</option>
                            <option value="{pigcms{:date('Y')+1}" >{pigcms{:date('Y')+1}</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select name="company_id" id="company_id" class="form-inline search" style="width:300px;line-height:34px; height:34px; border:1px #CCCCCC solid; margin-right:7px; margin-top:-1px;">
                            <option value="1">全部分公司</option>
                            <foreach name="company_list" item="vo">
                                <option value="{pigcms{$vo['id']}">{pigcms{$vo['deptname']}</option>
                            </foreach>
                        </select>
                    </div>
                </span>
                    <input class="btn green " type="submit" value="提交筛选"/>
            </span>
            </form>
        </div>
        <div class="btn-group" style="margin-top:10px;">
            <a href="{pigcms{:U('watch_company_one')}">
                <button  class="btn sbold red">查看2019年预算汇总
                </button>
            </a>
        </div>



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
            <th width="10%">所属年份</th>
            <th width="5%">所属项目</th>
            <th width="5%">所属公司</th>
            <th width="10%">提交人</th>
            <th width="10%">提交时间</th>
            <th width="10%">当前审核人</th>
            <th width="10%">审核时间</th>
            <th width="10%">状态</th>
            <th width="10%">备注</th>
            <th width="10%">是否应用至汇总表</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="predict_list" id="vo">
            <td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" value="{pigcms{$vo.predict_id}" />
                    <span></span>
                </label>
            </td>
            <td><div class="shopNameDiv">{pigcms{$vo.year}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.village_name}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.company_name}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.admin_name}</div></td>
            <td><div class="tagDiv">{pigcms{:date('Y-m-d H:i:s',$vo['updatetime'])}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.check_admin_name}</div></td>
            <td><div class="tagDiv">{pigcms{:$vo['checktime']?date('Y-m-d H:i:s',$vo['checktime']):''}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.status_name}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.remark}</div></td>
            <td>
                <if condition="$vo['is_apply'] eq 1">
                    <span style="color: red">已应用</span>
                    <else/>
                    <span style="color: green">未应用</span>
                </if>
            </td>
            <td class="button-column noExl">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">
                        <li>
                            <a href="{pigcms{:U('Budget_predict/watch_predict_one',array('id'=>$vo['predict_id']))}" >
                                <i class="icon-tag"></i> 查看详情 </a>
                        </li>
                        <if condition="!$isLiu">
                        <li>
                            <a href="{pigcms{:U('Budget_predict/output_excel_one',array('id'=>$vo['predict_id']))}" >
                                <i class="icon-tag"></i> 表格导出 </a>
                        </li>
                        </if>
                        <if condition="in_array($vo['status'],$action_now['status'])">
                            <li>
                            <a data-toggle="modal" data-target="#common_modal" href="{pigcms{:U('Budget_predict/check_predict_one',array('id'=>$vo['predict_id']))}">
                                <i class="icon-tag"></i> 审核条目/快捷审核
                            </a>
                            </li>
                        </if>
                            <li onclick="apply_predict_one({pigcms{$vo['predict_id']})">
                                    <i class="icon-tag"></i> 应用至预算汇总报表
                            </li>

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
        $('#predict_status').val('{pigcms{$predict_status}');
        $('#year').val('{pigcms{$year}');
        $('#company_id').val('{pigcms{$company_id}');

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
        /*应用至预算汇总方法*/
        function apply_predict_one(id) {
            swal({
                title: "是否应用至预算汇总表?",
                text: "请确认",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确认",
                cancelButtonText: "取消",
                closeOnConfirm: false,
                showCancelButton: true,
            }, function (iscom){
                if(iscom){
                    swal({title:"正在应用至预算汇总表中，请耐心等待。",showLoaderOnConfirm:true});
                    window.location.href='{pigcms{:U("Budget_predict/apply_predict_one")}&id='+id;
                }else{
                    swal.close();
                }
                /*$.post("{pigcms{:U('Contract/store_ajax_del_pic')}",{path:path});
                 $(obj).closest('.upload_pic_li').remove();
                 swal.close();*/
            })
        }
    </script>
</block>




