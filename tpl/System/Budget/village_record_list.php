<extend name="./tpl/System/Public_news/base.php" />


<block name="table-toolbar-left">
    <!--<div class="btn-group">
        <a href="{pigcms{:U('Budget/village_add_record')}">
            <button id="sample_editable_1_new" class="btn sbold green">添加新的支出条目
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>-->
    <div class="btn-group" style="margin-left: 10px">
        <a href="{pigcms{:U('Budget_predict/predict_in')}">
            <button id="sample_editable_1_new" class="btn sbold red">年度预算申报
            </button>
        </a>
    </div>
    <div class="btn-group" style="margin-left: 10px">
        <a href="{pigcms{:U('Budget/village_excel_print')}">
            <button id="sample_editable_1_new" class="btn sbold green">预算执行报表
            </button>
        </a>
    </div>
    <br/>

    <!--    筛选-->
    <div class="btn-group" style="margin-top: 10px">
        <span id="filter">
                <form action="__SELF__" method="get">
                <input type="hidden" name="g" value="System"/>
                <input type="hidden" name="c" value="Budget"/>
                <input type="hidden" name="a" value="village_record_list"/>
                <span id="filter">
                <span>
					<span style="line-height:30px;">筛选：</span>
                    <div class="btn-group">
                        <select name="record_status" id="record_status"  class="form-inline search" style="line-height:34px; height:34px; border:1px #CCCCCC solid; margin-right:7px; margin-top:-1px;"><!--onchange="change_url('record_status',this.options[this.options.selectedIndex].value)"-->
                                <option value="4">全部</option>
                                <option value="1">待审核</option>
                                <option value="2">审核成功</option>
                                <option value="3">驳回</option>
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
            <th width="10%">预算名称</th>
            <th width="5%">预算金额</th>
            <th width="5%">时间</th>
            <th width="10%">备注</th>
            <th width="10%">状态</th>
            <th width="10%">财务审核时间</th>
            <th width="10%">财务反馈</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="record_list" id="vo">
            <td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" value="{pigcms{$vo.pigcms_id}-{pigcms{$vo.type_id}" />
                    <span></span>
                </label>
            </td>
            <td><div class="shopNameDiv">{pigcms{$vo.record_name}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.record_money}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.record_time}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.record_remark}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.record_status_name}</div></td>
            <td><div class="tagDiv"><if condition="$vo['record_audit_time']">
                        {pigcms{:date('Y年n月j日 H:i:s',$vo['record_audit_time'])}
                           </if></div></td>
            <td><div class="tagDiv">{pigcms{$vo.record_check_remark}</div></td>
            <td class="button-column">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">
                        <li>
                            <a href="{pigcms{:U('Budget/village_add_record',array('id'=>$vo['record_id']))}" >
                                <i class="icon-tag"></i> 查看详情 </a>
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
            todayButton:false    //关闭选择今天按钮
        });
        $('#datetimepicker1').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'{pigcms{:date('Y-m-d',$endtime-24*3600)}',
            /*datepicker: false,//关闭日期选项*/
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

        $('#record_status').val('{pigcms{$record_status}');

        function change_url(type,val) {
            console.log(val);
            window.location.href='{pigcms{:U('Budget/village_record_list')}&'+type+'='+val;
        }
    </script>
</block>




