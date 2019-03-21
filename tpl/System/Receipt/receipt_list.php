<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <!--<div class="btn-group">
        <a href="{pigcms{:U('PropertyService/room_add_uptown')}">
            <button id="sample_editable_1_new" class="btn sbold green">添加楼层\房间
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>-->

    <div class="btn-group">
        <a href="javascript:">
            <button  class="btn sbold green" onclick="sub()">打印选中收据
            </button>
        </a>
    </div>
    <div class="btn-group" style="margin-left: 10px">
        <a href="javascript:">
            <button  class="btn sbold green" onclick="sub_project()">打印全部收据（筛选后）
            </button>
        </a>
    </div>
    <br/>
    <br/>
    <!--    筛选-->
    <div class="btn-group">
        <form action="__SELF__" method="post">
        <span>筛选：</span>
        <span id="filter">
                <span>
                    <!--<div class="btn-group">
                        <select name="print_status" id="print_status"  class="form-control search" onchange="change_url('print_status',this.options[this.options.selectedIndex].value)">
                                <option value="3">全部</option>
                                <option value="1">未打印</option>
                                <option value="2">已打印</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <input type="text" id="datetimepicker"  class="form-control" placeholder="" name="startDate" value="{pigcms{$month}" onchange="change_url('month',this.value)">
                    </div>-->
                    <div class="btn-group">
                        <select name="print_status" id="print_status"  class="form-control search">
                                <option value="3">按打印状态</option>
                                <option value="1">未打印</option>
                                <option value="2">已打印</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select name="type" id="type"  class="form-control search">
                                <option value="9999">按支付方式</option>
                                <foreach name="fee_type_list" item="value" key="key">
                                     <option value="{pigcms{$key}">{pigcms{$value}</option>
                                </foreach>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select name="pay_status" id="pay_status"  class="form-control search">
                                <option value="3">按是否删除状态</option>
                                <option value="1">已缴费</option>
                                <option value="2">未支付/已删除</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <input type="text" id="datetimepicker"  class="form-inline" placeholder="" name="starttime" value="{pigcms{$time['start']}" style="line-height:34px; height:34px; border:1px #CCCCCC solid; margin-right:7px; padding-left:5px;">
                         至&nbsp;
                        <input type="text" id="datetimepicker1"  class="form-inline" placeholder="" name="endtime" value="{pigcms{$time['end']}" style="line-height:34px; height:34px; border:1px #CCCCCC solid; margin-right:7px; padding-left:5px;">
                    </div>
                </span>
            <button class="btn green " type="submit"  value="点击筛选">点击筛选</button>
            <button class="btn green " type="button"  id="download">下载合计笔数统计表格</button>

            </span>
        </form>
    </div>
    <div style="width:100%;overflow-x: scroll;">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sum" style="width: 100%; margin-top:20px;table-layout: fixed;">
            <thead>
            <tr>
                <th style="width: 150px;"></th>
                <th style="width: 150px">合计/笔数</th>
                <foreach name="type_list" item="value" key="key">
                    <th style="width: 150px">{pigcms{$value['otherfee_type_name']}/笔数</th>
                </foreach>
            </tr>
            </thead>
            <tbody>
            <foreach name="fee_sum_list" item="value" key="key" >
                <tr>
                    <th>{pigcms{$value['type_name']}</th>
                    <th><span id="sum_cash" style="font-size:16px; color:#f36a5a">{pigcms{:number_format($value['sum_cash'],2)}元/{pigcms{$value['sum_count']}</span></th>
                    <foreach name="type_list" item="value1" key="key1">
                        <th>{pigcms{:number_format($value['sum_list'][$value1['otherfee_type_id']]['sum_cash'],2)}元/{pigcms{$value['sum_list'][$value1['otherfee_type_id']]['sum_count']}</th>
                    </foreach>
                </tr>
            </foreach>
            </tbody>


        </table>
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

            <th width="10%">业主信息</th>
            <th width="5%">收费类目</th>
            <th width="5%">支付方式</th>
            <th width="5%">应付金额</th>
            <th width="5%">实付金额</th>
            <th width="6%">入账时间/缴费状态</th>
            <th width="20%">有效期限</th>
            <th width="10%">备注</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="list" id="vo">
            <td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" value="{pigcms{$vo.pigcms_id}-{pigcms{$vo.type_id}" />
                    <span></span>
                </label>
            </td>
            <td><div class="tagDiv">{pigcms{$vo.owner}</div></td>
            <td><div class="shopNameDiv">{pigcms{$vo.type_name}</div></td>
            <td><div class="shopNameDiv">{pigcms{$vo.fee_type_name}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.pay_receive}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.pay_true}</div></td>
            <if condition="$vo['status'] eq 0">
                <td><div class="tagDiv" style="color: red" <if condition="$vo['receipt_request']">title="处理时间：{pigcms{:date('Y-m-d H:i:s',$vo['receipt_request']['check_time'])}
                        申请备注:{pigcms{$vo['receipt_request']['remark']}
                        处理备注:{pigcms{$vo['receipt_request']['check_remark']}"</if>>{pigcms{$vo.status_name}</div></td>
                <else/>
                <td><div class="tagDiv">{pigcms{$vo.create_time},</div><div <if condition="$vo['receipt_request']">title="处理时间：{pigcms{:date('Y-m-d H:i:s',$vo['receipt_request']['check_time'])}
                        申请备注:{pigcms{$vo['receipt_request']['remark']}
                        处理备注:{pigcms{$vo['receipt_request']['check_remark']}"</if> style="color: red">{pigcms{$vo['status_name_remark']}</div></td>
            </if>
            <td><div class="tagDiv">{pigcms{$vo.changetime}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.remark}</div></td>
            <td class="button-column">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">

                        <li>
                            <a href="javascript:;" target="_blank" onclick="sub_one('{pigcms{$vo.pigcms_id}-{pigcms{$vo.type_id}')">
                                <i class="icon-tag"></i> 打印收据 </a>
                        </li>
                        <li>
                            <a href="javascript:;" target="_blank" onclick="update_one('{pigcms{$vo.pigcms_id}-{pigcms{$vo.type_id}')">
                                <i class="icon-tag"></i> 修改此缴费 </a>
                        </li>
                        <if condition="$is_pm">
                            <li>
                                <a href="javascript:;" target="_blank" onclick="delete_one('{pigcms{$vo.pigcms_id}-{pigcms{$vo.type_id}')">
                                    <i class="icon-tag"></i> 删除此缴费 </a>
                            </li>
                            <else/>
                            <li>
                                <a href="javascript:;" target="_blank" onclick="delete_request_one('{pigcms{$vo.pigcms_id}-{pigcms{$vo.type_id}')">
                                    <i class="icon-tag"></i> 申请删除此缴费 </a>
                            </li>
                        </if>
                        <if condition="$is_fm">
                            <li>
                                <a href="javascript:;" target="_blank" onclick="refund_all_one('{pigcms{$vo.pigcms_id}-{pigcms{$vo.type_id}')">
                                    <i class="icon-tag"></i> 全部退款 </a>
                            </li>
                            <li>
                                <a href="javascript:;" target="_blank" onclick="refund_one('{pigcms{$vo.pigcms_id}-{pigcms{$vo.type_id}','{pigcms{$vo.pay_true}')">
                                    <i class="icon-tag"></i> 部分退款 </a>
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
    <script src="./static/js/jquery-table2excel.min.js"></script>
    <script>
        $.datetimepicker.setLocale('ch');
        $('#datetimepicker').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:"{pigcms{$time['start']}",
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false    //关闭选择今天按钮
        });
        $('#datetimepicker1').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:"{pigcms{$time['end']}",
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false    //关闭选择今天按钮
        });
        $(".search").change(
            function () {
                var search=$('#property_status').children('option:selected').val();
                //console.log(p1);
                $('input[aria-controls="sample_1"]').val(search).keyup();
            }
        );
        function sub_project(){
            var project_id='{pigcms{$project_info['pigcms_id']}';
            var project_name='{pigcms{$project_info['desc']}';
            if(confirm( '你确定批量打印当前筛选结果吗？')) {
                var url = "{pigcms{:U('Receipt/print_receipt')}";
                //用post方式传递
                var ids = '';
                var ym = '';
                openPostWindow(url,ids,ym,project_id);
                // window.location.href = "{pigcms{:U('PropertyService/hydropower_account_do')}" + "&ids=" + ids + "&ym=" + ym;
            }
        }
        function sub() {
            var ids = '';
            var ym = $("input[name='choose_time']").val();
            // alert(ym);
            $(".checkboxes").each(function() {
                if ($(this).is(':checked') && $(this).val() != '') {
                    ids += ',' + $(this).val(); //逐个获取id
                }
            });
            ids = ids.substring(1);
            if (ids.length == 0) {
                alert('请选择要添加的选项');
            } else {
                if(confirm( '你确定批量打印吗？')) {
                    var url = "{pigcms{:U('Receipt/print_receipt')}";
                    //用post方式传递
                    var project_id='';
                    openPostWindow(url,ids,ym,project_id);
                    // window.location.href = "{pigcms{:U('PropertyService/hydropower_account_do')}" + "&ids=" + ids + "&ym=" + ym;
                }
            }
        }
        function sub_one(id) {
            var ym = $("input[name='choose_time']").val();
            // alert(ym);
           var ids=id;
            if (ids.length == 0) {
                alert('请选择要添加的选项');
            } else {
                if(confirm( '你确定批量打印吗？')) {
                    var url = "{pigcms{:U('Receipt/print_receipt')}";
                    //用post方式传递
                    var project_id='';
                    openPostWindow(url,ids,ym,project_id);
                    // window.location.href = "{pigcms{:U('PropertyService/hydropower_account_do')}" + "&ids=" + ids + "&ym=" + ym;
                }
            }
        }
        /*修改一条记录*/
        function update_one(id) {
            window.location.href="{pigcms{:U('Receipt/update_receipt')}&id="+id;
        }
        /**
         * @author zhukeqin
         * @param id
         * 删除一条记录
         */
        function delete_one(id) {
            var ids=id;
            swal({
                    title: "是否删除该条数据？",
                    text: "请确认",
                    type: "info",
                    showCancelButton: true,
                    cancelButtonText: "取消",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                    closeOnConfirm: true
                },
                function(){
                    $.ajax({
                        url:'{pigcms{:U("Receipt/ajax_delete_fee")}',
                        data:{"ids":ids},
                        type:'POST',
                        dataType:'json',
                        success:function (res) {
                            if(res.status==1){
                                swal("已成功删除", "成功", "success");
                                window.location.reload();
                            }else{
                                swal("删除失败", res.info, "error");
                            }
                        }
                    })
                });
        }
        /**
         * @author zhukeqin
         * @param id
         * 申请删除一条记录
         */
        function delete_request_one(id) {
            var ids=id;
            swal({
                    title: "是否申请删除该条数据？",
                    text: "请输入删除原因",
                    type: "input",
                    showCancelButton: true,
                    cancelButtonText: "取消",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                    closeOnConfirm: true,
                    inputPlaceholder: "请输入删除原因"
                },
                function(inputValue){

                    if (inputValue === false) {
                        return false;
                    }
                    if (inputValue === "") {
                        swal.showInputError("内容不能为空！");
                        return false;
                    }

                        $.ajax({
                            url:'{pigcms{:U("Receipt/ajax_delete_request_fee")}',
                            data:{"ids":ids,'remark':inputValue},
                            type:'POST',
                            dataType:'json',
                            success:function (res) {
                                if(res.status==1){
                                    swal("提交删除请求成功，请等待项目经理审核", "成功", "success");
                                    window.location.reload();
                                }else{
                                    swal("删除失败", res.info, "error");
                                }
                            }
                        })
                });
        }
        function refund_one(id,money) {
            var ids=id;
            swal({
                title: "请输入退款金额，不能大于实付金额",
                text: "当前实付金额为"+money+'元',
                type: "input",
                showCancelButton:true,
                closeOnConfirm:false,
                confirmButtonText:"确认",
                cancelButtonText:"取消",
                animation: "slide-from-top",
                inputPlaceholder: "请输入退款金额"
                },
                function(inputValue){
                    $.ajax({
                        url:'{pigcms{:U("Receipt/ajax_refund_fee")}',
                        data:{"ids":ids,'money':inputValue},
                        type:'POST',
                        dataType:'json',
                        success:function (res) {
                            if(res.status==1){
                                swal("已成功退款"+inputValue+"元", "成功", "success");
                                window.location.reload();
                            }else{
                                swal("退款失败", res.info, "error");
                            }
                        }
                    })
                });
        }
        function refund_all_one(id) {
            var ids=id;
            swal({
                    title: "是否全部退款该条数据？",
                    text: "请确认",
                    type: "info",
                    showCancelButton: true,
                    cancelButtonText: "取消",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                    closeOnConfirm: true
                },
                function(){
                    $.ajax({
                        url:'{pigcms{:U("Receipt/ajax_refund_fee")}',
                        data:{"ids":ids,'money':''},
                        type:'POST',
                        dataType:'json',
                        success:function (res) {
                            if(res.status==1){
                                swal("已成功全部退款", "成功", "success");
                                window.location.reload();
                            }else{
                                swal("退款失败", res.info, "error");
                            }
                        }
                    })
                });
        }
        /**
         * @author zhukeqin
         * @param url
         * @param idStr
         * @param yms
         * @param project_id
         * 伪造一个表单  post提交数据
         */
        function openPostWindow(url,idStr,yms,project_id){

            var tempForm = document.createElement("form");
            tempForm.id = "tempForm1";
            tempForm.method = "post";
            tempForm.action = url;
            tempForm.target="_blank"; //打开新页面
            var hideInput1 = document.createElement("input");
            hideInput1.type = "hidden";
            hideInput1.name="ids"; //后台要接受这个参数来取值
            hideInput1.value = idStr; //后台实际取到的值
            var hideInput2 = document.createElement("input");
            hideInput2.type = "hidden";
            hideInput2.name="ym";
            hideInput2.value = yms;
            var hideInput3 = document.createElement("project_id");
            hideInput2.type = "hidden";
            hideInput2.name="project_id";
            hideInput2.value = project_id;
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
            $('#print_status').val('{pigcms{$print_status}');
            $('#type').val('{pigcms{$type}');
            $('#pay_status').val('{pigcms{$pay_status}');

        function change_url(type,val) {
            console.log(val);
            window.location.href='{pigcms{:U('Receipt/receipt_list')}&'+type+'='+val;
        }
        $("#download").click(function () {
            $("#sum").table2excel({
                exclude  : ".noExl", //过滤位置的 css 类名
                filename : "{pigcms{$village_name}{pigcms{$project_name}合计笔数统计表{pigcms{$time['start']}-{pigcms{$time['end']}.xls", //文件名称
                name: "Excel Document Name.xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true

            });
        });
    </script>
</block>




