<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-group"></i>
                <a href="{pigcms{:U('Meter/index')}">设备管理</a>
            </li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
    <div class="btn-group">
        <a href="{pigcms{:U('add_meter')}">
            <button id="sample_editable_1_new" class="btn sbold green">添加设备
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <div class="btn-group">
        <if condition="$_GET['is_del'] eq 0">
            <a href="{pigcms{:U('',array('is_del'=>1))}">
                <button id="sample_editable_1_new" class="btn sbold green">查看已删除设备
                </button>
            </a>
            <else />
            <a href="{pigcms{:U('',array('is_del'=>0))}">
                <button id="sample_editable_1_new" class="btn sbold green">返回
                </button>
            </a>
        </if>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('meter_error')}">
            <button id="sample_editable_1_new" class="btn sbold green">异常检测
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="{pigcms{:U('update_consume')}">
            <button id="sample_editable_1_new" class="btn sbold green">更新止码
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="{pigcms{:U('meter_config_list')}">
            <button id="sample_editable_1_new" class="btn sbold green">设备类型配置
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="http://www.hdhsmart.com/admin.php?g=System&c=PropertyService&a=test_print_news">
            <button id="sample_editable_1_new" class="btn sbold green">标签打印
            </button>
        </a>
    </div>


    <br/>
    <br/>
    <!--    筛选-->
    <span>筛选：</span>
    <sapn id="filter">
        <meter-type :tree="type_tree "></meter-type>
    </sapn>

    <table class="table table-striped table-bordered table-hover" id="sample_1" style="float:left">
        <thead>
        <tr>
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th>设备编号</th>
            <th>设备码</th>
            <th>楼层</th>
            <th>设备类型</th>
            <th>计费类型</th>
            <th>上月止码</th>
            <th>本月止码</th>
            <th>当月用量</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="list" id="row">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$row.id}</td>
                <td>{pigcms{$row.meter_code}</td>
                <td>{pigcms{$row.meter_floor}</td>
                <td>{pigcms{$row.meter_type_name}</td>
                <td>{pigcms{$row.price_type_name}</td>
                <if condition="$row['is_record'] eq 1">
                    <td>{pigcms{$row.last_total_consume}</td>
                    <td>{pigcms{$row.total_consume}</td>
                    <else />
                    <td>{pigcms{$row.end_num}</td>
                    <td>未抄录</td>
                </if>

                <td>{pigcms{$row.consume}</td>

                <td class="button-column">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position: absolute;">
                            <li>
                                <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('modal_meter_bind_room',array('meter_hash'=>$row['meter_hash']))}">
                                    <i class="icon-docs"></i> 绑定房间
                                </a>
                            </li>
                            <li>
                                <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('modal_meter_qr',array('meter_hash'=>$row['meter_hash']))}">
                                    <i class="icon-docs"></i> 二维码
                                </a>
                            </li>
                            <li>
                                <if condition="$_GET['is_del'] eq 1">
                                    <a  href="{pigcms{:U('meter_return',array('meter_hash'=>$row['meter_hash']))}">
                                        <i class="icon-docs"></i> 还原
                                    </a>
                                    <else />

                                    <a href="{pigcms{:U('meter_logic_del',array('meter_hash'=>$row['meter_hash']))}">
                                        <i class="icon-docs"></i> 逻辑删除
                                    </a>
                                </if>

                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        </volist>
        </tbody>
    </table>
        </div>
    </div>
</div>


    <!--    设备类型模板-->
    <script type="text/x-template" id="meter_type">
        <span>
            <div class="btn-group">
               <select name="meter_type_id" id="" class="form-control" v-model="selected_meter_type">
                    <option value="">请选择设备类型</option>
                    <option v-for="(type,index) in tree" v-bind:value="type.id">{{type.desc}}</option>
                </select>
            </div>

            <div class="btn-group">
                <select name="price_type_id" id="" class="form-control" v-model="selected_price_type">
                    <option value="">请选择计费类型</option>
                    <option v-for="(type,index) in price_type_list" v-bind:value="type.id">{{type.desc}}</option>
                </select>
            </div>
        </span>
    </script>
    <script>
        Vue.component('meter-type', {
            template: '#meter_type',
            props:{
                tree:Object
            },
            data:function(){
                return {
                    'selected_meter_type':"",
                    'selected_price_type':"",
                }
            },
            computed:{

                price_type_list:function(){
                    var price_type_list = {};
                    for(var i in this.tree){
                        if(this.tree[i].id == this.selected_meter_type ){
                            price_type_list = this.tree[i].price_type_list;
                            break;
                        }
                    }
                    return price_type_list;
                },

            },
            watch:{
                selected_meter_type:function(val){
                    for(var i in this.tree){
                        if(this.tree[i].id == val ){
                            var keywords = this.tree[i]['desc'];
                            break;
                        }
                    }
                    $('input[aria-controls="sample_1"]').val(keywords).keyup();
                    this.selected_price_type = "";
                },

                selected_price_type:function(val){
                    if(!val) return ;
                    for(var i in this.price_type_list){
                        if(this.price_type_list[i].id ==val ){
                            var keywords = this.price_type_list[i]['desc'];
                            break;
                        }
                    }
                    $('input[aria-controls="sample_1"]').val(keywords).keyup();
                },
            },
        });

        new Vue({
            el:'#filter',
            data:{
                type_tree:app_json.meter_type_tree
            },
            mounted:function(){
                console.log(this.type_tree);
            }
        });
    </script>
<script type="text/javascript">
    //表格显示控制js代码区
    var table = $('#sample_1');

    // begin first table
    var jstr = '{pigcms{$table_sort}';
    var table_sort;
    if(jstr){
        table_sort = JSON.parse(jstr);
    }else{
        table_sort = [1, "desc"];
    }
    table.dataTable({

        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
        "language": {
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            "emptyTable": "对不起，没有查找到指定的设备",
            "info": "当前显示 _START_ 到 _END_ ​条记录 共 _TOTAL_ ​条记录",
            "infoEmpty": "No records found",
            "infoFiltered": "(filtered1 from _MAX_ total records)",
            "lengthMenu": "每页显示条数 _MENU_",
            "search": "搜索:",
            "zeroRecords": "对不起，没有查找到指定的设备",
            "paginate": {
                "previous":"Prev",
                "next": "Next",
                "last": "Last",
                "first": "First"
            }
        },
        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

        "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "全部"] // change per page values here
        ],
        // set the initial value
        "pageLength": parseInt("{pigcms{$table_init_length}")||15,
        "pagingType": "bootstrap_full_number",
        "columnDefs": [
            {  // set default column settings
                'orderable': false,
                'targets': [0]
            },
            {
                "searchable": false,
                "targets": [0]
            },
            {
                "className": "dt-right",
                //"targets": [2]
            }
        ],
        "order": [
            table_sort
        ] // set first column as a default sort by asc
    });
    $("#sample_1_filter input[type=search]").removeClass("input-small");
    $("#sample_1_filter input[type=search]").css({ width: '400px' });
    $("#sample_1_filter input[type=search]").attr("placeholder","请输入设备编号，设备码等信息进行查询");
    //var tableWrapper = jQuery('#sample_1_wrapper');

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
    .dataTables_wrapper {
        position: relative;
        float: left;
        clear: none;
        zoom: 1;
    }
</style>
<include file="Public:footer"/>
