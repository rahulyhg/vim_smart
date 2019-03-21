

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
                url: '{pigcms{:U("ajax_package_list_all")}',
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
                    "sTitle" : "运单号",　　　//显示的列名
                    "mDataProp": "waybill_number",　　//对应的数据中的字段名
                    "sDefaultContent" : "不存在",
                    "sClass" : "center waybill_number"
                },
                {
                    "sTitle" : "快递公司",
                    "mDataProp": "company_name",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "取件码",
                    "mDataProp": "receipt_code",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center nickname"
                },
                {
                    "sTitle" : "收件人",
                    "mDataProp": "name",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "电话",
                    "mDataProp": "phone",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "包裹状态",
                    "mDataProp": "in_package_time",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "操作",
                    "mDataProp": "changePackageStatus",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                }
                /*{
                 "sTitle" : "Update Time",
                 "mDataProp": "updateTime",
                 "sDefaultContent" : "",
                 "sClass" : "center",
                 "mRender" : function(data, display, row) {  //将从数据库中查到的时间戳格式化
                 return new Date(data).Format("yyyy-MM-dd hh:mm:ss");
                 }

                 },*/
            ]
        });
        $("#sample_1_filter input[type=search]").removeClass("input-small");
        $("#sample_1_filter input[type=search]").css({ width: '400px' });
        $("#sample_1_filter input[type=search]").attr("placeholder","请输入运单号、姓名、手机或取件码查询");
        var table2 = $('#sample_3');
        table2.dataTable({
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
                url: '{pigcms{:U("ajax_package_list_all")}',
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
                {
                    "sTitle" : "运单号",　　　//显示的列名
                    "mDataProp": "waybill_number",　　//对应的数据中的字段名
                    "sDefaultContent" : "不存在",
                    "sClass" : "center waybill_number"
                },
                {
                    "sTitle" : "快递公司",
                    "mDataProp": "company_name",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "取件码",
                    "mDataProp": "receipt_code",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center nickname"
                },
                {
                    "sTitle" : "收件人",
                    "mDataProp": "name",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "电话",
                    "mDataProp": "phone",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "包裹状态",
                    "mDataProp": "in_package_time",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "操作",
                    "mDataProp": "changePackageStatus",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                }
            ]
        });
         $("#sample_3_filter input[type=search]").removeClass("input-small");
         $("#sample_3_filter input[type=search]").css({ width: '400px' });
         $("#sample_3_filter input[type=search]").attr("placeholder","请输入运单号、姓名、手机或取件码查询");
    });
    var table1 = $('#sample_2');
    table1.dataTable({
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
            "zeroRecords": "No matching records found",
            "paginate": {
                "previous":"Prev",
                "next": "Next",
                "last": "Last",
                "first": "First"
            }
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
        ]
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
    .waybill_number{width: 15%;}
    .active_value{color: red;text-align: center;}
    .nickname{color: orange;}
</style>
</body>
</html>