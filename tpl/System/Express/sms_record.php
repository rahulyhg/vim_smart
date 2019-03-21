<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    <!--
    .dropdown-menu {margin: 0 0 0 -90px;}
    -->
</style>
<!--头部设置-->
<?php
$title = array(
    'title'=>'数据中心',
    'describe'=>'',
);
$breadcrumb = array(
    array('数据中心','#'),
    array('短信查询','#'),
);

/*$add_action = array(
    'url'=>U('Searchhot/add'),
    'name'=>'快递1公司'
);*/
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<block name="table-toolbar-right">
    <!--    筛选-->
    <span>筛选：</span>
    <div class="btn-group">
    <input type="date" name="date" value="<php>echo date('Y-m-d')</php>" class="form-control"/>
    </div>
    <div class="btn-group">
        <select  class="form-control" name="status">
            <option value="">请选择短信发送状态</option>
            <option value="状态2">发送中</option>
            <option value="状态0">发送成功</option>
            <option value="状态1">发送失败</option>
        </select>
    </div>
    <!--    </div>-->
    <br>
    <br>
</block>
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>
        <th>姓名</th>
        <th>电话</th>
        <th>短信内容</th>
        <th>业务id</th>
        <th>状态码</th>
        <th>发送时间</th>
        <th>接收时间</th>
        <th>状态</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($list)">
        <volist name="list" id="vo">
            <tr>
                <td width="20%">{pigcms{$vo.waybill_number}</td>
                <td>{pigcms{$vo.company_name}</td>
                <td>{pigcms{$vo.receipt_code}</td>
                <td>{pigcms{$vo.name}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </volist>

        <else/>
        <tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
    </if>
    </tbody>
</table>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script>
    //已发送短信按钮放上去改变文字功能
    $(".dropdown-menu").bind('mouseover',function () {
        console.log('重新发送');
        $("a.been_send").text('重新发送');
    });
    $(".dropdown-menu").bind('mouseout',function () {
        console.log('已经发送');
        $("a.been_send").text('已经发送');
    });

    $("select[name='company_id']").change(function(){
        var d_cid = $("select[name='company_id']").val();
        $("#sample_1_filter").find("input").val(d_cid).keyup();
    });

    $(".icon-btn").on('click',function () {
        var company_name = $(this).attr('data-company');
        $("#sample_1_filter").find("input").val(company_name).keyup();
    });

    $("input[name='date']").change(function(){
        var ym = $("input[name='date']").val();
        var status = $("input[name='status']").val();
        $("#sample_1_filter").find("input").val(ym).keyup();
        $.ajax({
            url:"{pigcms{:U('change_date')}",
            type:'post',
            data:{'ym':ym,'status':status},
            dataType:'json',
            success:function(res){
                for (var ko in res){
                    var vo = res[ko];
                    $(".badge_"+ko).html(vo);
                }
            }
        })
    });

    $("#keyword1").blur(function () {
        var keyword1 = $("#keyword1").val();
        $("#sample_1_filter").find("input").val(keyword1).keyup();
    });

    $("select[name='status']").change(function(){
        var ym = $("input[name='date']").val();
        var status = $("select[name='status']").val();
        $("#sample_1_filter").find("input").val(status).keyup();
    });





</script>

<!--自定义js代码区结束-->


</div>

<script>
    $(function () {
        //表格显示控制js代码区
        var table = $('#sample_1');
        table.dataTable({
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "暂时没有数据",
                "info": "当前显示 _START_ 到 _END_ ​条记录 共 _TOTAL_ ​条记录",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "​每页显示条数 _MENU_",
                "search": "搜索:",
                "zeroRecords": "抱歉，没有查找到指定结果",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
            serverSide: true,
            ajax: {
                url: '{pigcms{:U("sms_record")}',
                type: 'POST'
            },
            ordering:  false,
            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "​全部"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [
                {  // set default column settings
                    'orderable': false,
                    'targets': [0]
                },
                //去除限制第一列查询
                /*{
                 "searchable": false,
                 "targets": [0]
                 },*/
                {
                    "className": "dt-right",
                    //"targets": [2]
                }
            ],
            "order": [
                [1, "desc"]
            ],
            "aoColumns": [
                /*{
                 "mDataProp" : "id",
                 "sTitle" : "<input type='checkbox'  name='allbox' id='allbox' onclick='check();' />",
                 "sDefaultContent" : "",
                 "bSortable" : false,
                 "sClass" : "center",
                 "mRender" : function(data, display, row) {
                 return "<input type='checkbox' id='"+data+"' name='idList' value='"+data+"'/>";
                 }
                 },*/
                {
                    "sTitle" : "姓名",　　　//显示的列名
                    "mDataProp": "name",　　//对应的数据中的字段名
                    "sDefaultContent" : "不存在",
                    "sClass" : "center name"
                },
                {
                    "sTitle" : "电话",
                    "mDataProp": "phone",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "短信内容",
                    "mDataProp": "text",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center time"
                },
                {
                    "sTitle" : "业务id",
                    "mDataProp": "bizid",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center time"
                },
                {
                    "sTitle" : "状态码",
                    "mDataProp": "errcode",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "发送时间",
                    "mDataProp": "time",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center time"
                },
                {
                    "sTitle" : "接收时间",
                    "mDataProp": "time_receive",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center time"
                },
                {
                    "sTitle" : "状态",
                    "mDataProp": "status",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center name"
                }
            ]
        });
        $("#sample_1_filter input[type=search]").removeClass("input-small");
        $("#sample_1_filter input[type=search]").css({ width: '400px' });
        $("#sample_1_filter input[type=search]").attr("placeholder","请输入姓名、手机或取件码查询");
    });
    var tableWrapper = jQuery('#sample_1_wrapper');

    table.find('.group-checkable').change(function () {
        var set = jQuery(this).attr("data-set");
        var checked = jQuery(this).is(":checked");
        jQuery(set).each(function () {
            if (checked) {
                $(this).prop("checked", true);
                $(this).parents('tr').addClass("active");
            } else {
                $(this).prop("checked", false);
                $(this).parents('tr').removeClass("active");
            }
        });
    });

    table.on('change', 'tbody tr .checkboxes', function () {
        $(this).parents('tr').toggleClass("active");
    });

</script>
<style>
    .time{width: 20%;}
    .name{width:15%}
</style>
</body>
</html>
