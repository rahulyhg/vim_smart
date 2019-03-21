<div class="page-footer">
    <div class="page-footer-inner"> 2017 &copy; 智慧助手系统
        <a target="_blank" href="http://www.vhi99.com">邻钱科技</a>
        <!--      &nbsp;|&nbsp;   <a href="http://www.metronic.com" target="_blank">Metronic</a>-->
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<div class="quick-nav-overlay"></div>
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/excanvas.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->

<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--插入layer弹层js开始-->
<script src="/Car/Admin/Public/js/layer.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/sweetalert.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/ui-sweetalert.min.js" type="text/javascript"></script>

<script src="http://www.bootcss.com/p/underscore/underscore-min.js"></script>
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script src="./static/js/vue-resource.min.js"></script>
<script src="./static/js/vuex.js"></script>
<script src="./static/js/ui-buttons.js"></script>

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
            "emptyTable": "No data available in table",
            "info": "当前显示 _START_ 到 _END_ ​条记录 共 _TOTAL_ ​条记录",
            "infoEmpty": "No records found",
            "infoFiltered": "(filtered1 from _MAX_ total records)",
            "lengthMenu": "每页显示条数 _MENU_",
            "search": "搜索:",
            "zeroRecords": "No matching records found",
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
                "className": "dt-right",
                //"targets": [2]
            }
        ],
        "order": [
            table_sort
        ] // set first column as a default sort by asc
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
<script>
    /**
     * vue全局注册函数
     */
    //get
    Vue.prototype._get =  function(url,params,callback){
        var opt = {
            'params':params
        }
        this.$http.get(url,opt).then(function(response){
            // 响应成功回调
            if(response.body.err==0){
                callback(response.body);
            }else{
                console.log(response.body);
                alert("发生错误");
            }
        }, function(response){
            alert(response.status+" 发生错误");
        });

    };
    //post
    Vue.prototype._post = function(url,params,callback){
            this.$http.post(url,params).then(function(response){
                // 响应成功回调
                if(response.body.err==0){
                    callback(response.body);
                }else{
                    alert("发生错误:"+response.body.msg);
                }
            }, function(response){
                alert(response.status+" 发生错误");
            });

        };
    //判断是否是数组
    function isArray(o){
        return Object.prototype.toString.call(o)=='[object Array]';
    }
    //补0函数
    function padNumber(num, fill) {
        //改自：http://blog.csdn.net/aimingoo/article/details/4492592
        var len = ('' + num).length;
        return (Array(
            fill > len ? fill - len + 1 || 0 : 0
        ).join(0) + num);
    }
    //改变群发控制状态
    function change_wxmsg(village_id){
        $.ajax({
            url:"{pigcms{:U('ajax_change_wxmsg')}",
            type:'post',
            data:{'village_id':village_id},
            dataType:'json',
            async:false,
            success:function(res){

            }
        });
    }
        $("[name='my-checkbox']").bootstrapSwitch({
            onText:"已启动",
            offText:"已关闭",
            onColor:"success",
            offColor:"danger",
            size:"normal",
            handleWidth:'100px',
            labelWidth:'55px',
            state:Boolean({pigcms{$is_wxmsg}),
            onSwitchChange:function(event,state){
                change_wxmsg('{pigcms{$village_id}');
            }
        });
</script>
<!--自定义js代码区开始-->
