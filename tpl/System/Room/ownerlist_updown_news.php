<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">



    <!--<div class="btn-group">
        <a href="{pigcms{:U('add_owner_uptown',array('village_id'=>$_GET['village_id']))}">
            <button id="sample_editable_1_new" class="btn sbold green">添加业主
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>-->
    <div class="btn-group">
        <a href="{pigcms{:U('owner_uptown_import_step1')}">
            <button id="sample_editable_1_new" class="btn sbold green">批量导入业主
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <!--    <if condition="$admin eq 1">-->
    <!--        <div class="btn-group">-->
    <!--            <a class="btn green-haze btn-outline sbold uppercase" href="javascript:;" data-toggle="dropdown">-->
    <!--                <i class="fa fa-building"></i> 当前:{pigcms{$presentVillage}-->
    <!--                <i class="fa fa-angle-down"></i>-->
    <!--            </a>-->
    <!--            <ul class="dropdown-menu">-->
    <!--                <li>-->
    <!--                    <a href="{pigcms{:U('')}">-->
    <!--                        <i class="fa fa-building-o"></i> 全部显示 </a>-->
    <!--                </li>-->
    <!--                <foreach name="villageArray" item="vo">-->
    <!--                    <li>-->
    <!--                        <a href="{pigcms{:U('',array('village_id'=>$vo['village_id']))}">-->
    <!--                            <i class="fa fa-building-o"></i> {pigcms{$vo.village_name} </a>-->
    <!--                    </li>-->
    <!--                </foreach>-->
    <!--            </ul>-->
    <!--        </div>-->
    <!--        <else/>-->
    <!--        <div class="btn-group">-->
    <!--            <a class="btn green-haze btn-outline sbold uppercase" href="javascript:;">-->
    <!--                <i class="fa fa-building"></i> 当前:{pigcms{$presentVillage}-->
    <!--            </a>-->
    <!--        </div>-->
    <!--    </if>-->
</block>

<block name="body">
    <table class="table table-striped table-bordered table-hover table-checkable order-column"  id="sample_2">
        <thead>
        <!--        入驻状态	入驻单位	业主	总面积	缴费状态	操作-->
        <tr>
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th>ID</th>
            <th>业主名称</th>
            <th>电话</th>
            <th>身份证号</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="list" id="vo">
            <tr  class="odd gradeX">
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>
                    {pigcms{$vo.pigcms_id}
                </td>
                <td>
                    {pigcms{$vo.name}
                </td>
                <td>
                    {pigcms{$vo.phone}
                </td>
                <td>
                    {pigcms{$vo.usernum}
                </td>


                <td class="button-column">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position: absolute; margin-left:-90px;">
                            <!--<li>
                                <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('modal_owner_bind_room_sq',array('oid'=>$vo['pigcms_id']))}">
                                    <i class="icon-docs"></i> 绑定房间
                                </a>
                            </li>-->
                            <if condition="$role_id eq 1">
                                <li>
                                    <a href="{pigcms{:U('edit_owner_uptown',array('id'=>$vo['pigcms_id']))}">
                                        <i class="icon-docs"></i> 编辑
                                    </a>
                                </li>
                            </if>                          
                            <li>
                                <a href="{pigcms{:U('del_owner_uptown',array('id'=>$vo['pigcms_id']))}" onclick="return window.confirm('删除后不可恢复！确认删除？')">
                                    <i class="icon-docs"></i> 删除
                                </a>
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
        var table = $('#sample_2');
        table.dataTable({
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                'processing':'正在努力处理中',
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
            'processing':true,// 加载
            ajax: {
                url: '{pigcms{:U("ajax_ownerlist_updown")}',
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
            //"aaSorting": [[ 1, "asc" ]],
            "aoColumns": [
                {
                    "mDataProp" : "check_id",
                    "sTitle" : "<input type='checkbox'  name='allbox' id='allbox' onclick='check();' />",
                    "sDefaultContent" : "",
                    "bSortable" : false,
                    "sClass" : "center"
                },
                {
                    "sTitle" : "ID",
                    "mDataProp": "pigcms_id",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "姓名",
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
                    "sTitle" : "身份证号",
                    "mDataProp": "usernum",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center nickname"
                },
                {
                    "sTitle" : "操作",
                    "mDataProp": "action",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                }
            ]
        });

        $("#sample_1_filter input[type=search]").removeClass("input-small");
        $("#sample_1_filter input[type=search]").css({ width: '400px' });
        $("#sample_1_filter input[type=search]").attr("placeholder","请输入房间号、业主姓名、手机查询");
    </script>
</block>