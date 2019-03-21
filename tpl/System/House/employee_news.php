<layout name="layout"/>

<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/apps/css/ticket.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    <!--
    .dropdown-menu {margin: 0 0 0 -125px;}
	.input-small {
    	width: 195px!important;
	}
    -->
</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>部门管理
                    <!--<small>用户的任何消费都会被记录在此 </small>-->
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="http://www.hdhsmart.com/admin.php?g=System&c=Index&a=index_news">后台首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">组织架构</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">部门管理</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet bordered">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="/Car/Admin/Public/assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt=""> </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> 企业资源管理 </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR BUTTONS -->
                        <div class="profile-userbuttons">
                            <a  data-toggle="modal" data-target="#modal_department" class="btn btn-circle green btn-sm"
                                href="{pigcms{:U('House/department_edit')}" style="text-align: center">
                                部门添加
                            </a>
<!--                            <a  data-toggle="modal" data-target="#modal_add" class="btn btn-circle red btn-sm"-->
<!--                                href="{pigcms{:U('House/employee_add')}" style="text-align: center">-->
<!--                                员工添加-->
<!--                            </a>-->
                            <!--<a  class="btn btn-circle red btn-sm" href="{pigcms{:U('Admin/admin_add_news')}" style="text-align: center">-->
                            <a  class="btn btn-circle red btn-sm" href="{pigcms{:U('House/employee_add')}" style="text-align: center">
                                员工添加
                            </a>
                        </div>
                        <!-- END SIDEBAR BUTTONS -->
                        <!-- SIDEBAR MENU -->
                        <div style="padding:20px 25px; overflow-y: auto">
                            <div class="portlet-body" id="ee">
                                <div id="tree_3" class="tree-demo"> </div>
                            </div>
                        </div>
                        <!-- END MENU -->
                    </div>
                    <!-- END PORTLET MAIN -->
                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN TICKET LIST CONTENT -->
                <div class="app-ticket app-ticket-list">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase" id="uppercase">{pigcms{$department_info.deptname}</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="btn-group">
                                                    <button id="sample_editable_1_new" class="btn sbold blue" depart_arr="{pigcms{$department_info.id}" onclick="dept_click(this)"> 编辑部门 </button>
                                                    <div style="margin-left:10px; float:left;">
                                                    <button id="sample_editable_1_new" depart_arr="{pigcms{$department_info.id}" onclick="del_click(this)" class="btn sbold red"> 删除部门 </button>
                                                </div>
                                                    <div style="margin-left:10px; float:left;">
                                                        <a  class="btn green " href="{pigcms{:U('Admin/admin_add_news')}" style="text-align: center"> 员工添加 </a>
                                                    </div>
                                                    <div style="clear:both"></div>
                                                </div>
                                            </div>											
                                        </div>
                                    </div>

                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="simple_2">
                                        <thead>
                                        <tr>
                                            <th> 用户名 </th>
                                            <th> 真实姓名 </th>
                                            <th> 角色 </th>
                                            <th style="text-align:center;"> 状态 </th>
                                            <th style="text-align:center;"> 操作 </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>

    </div>
</div>
<!--弹出层-->
<div class="modal fade" id="modal_department" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" style="width:1200px" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>

<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" style="width:1200px" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
<!--        弹出层容器-->
<div class="modal fade" tabindex="-1" role="dialog" id="common_modal">
    <div class="modal-dialog modal-lg" role="document" style="width:1200px">
        <div class="modal-content">

        </div>
    </div>
</div>
<!--        弹出层容器-->
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 2017 &copy; 汇得行智慧助手系统
        <a target="_blank" href="http://www.vhi99.com">邻钱科技</a> &nbsp;|&nbsp;
        <a href="http://www.metronic.com" target="_blank">Metronic</a>
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
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>\

<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!--<script src="/Car/Admin/Public/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--插入layer弹层js开始-->
<script src="/Car/Admin/Public/js/layer.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/sweetalert.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/js/ui-sweetalert.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jstree/dist/jstree.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/pages/scripts/ui-tree.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="{pigcms{$static_public}js/artdialog/skins/mydialog.css?4.1.7">
<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<!--<script src="./static/js/jquery.min.js"></script>-->
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./tpl/System/Static/js/index1.js"></script>
<script>
    (function(E,C,D,A){var B,$,_,J="@ARTDIALOG.DATA",K="@ARTDIALOG.OPEN",H="@ARTDIALOG.OPENER",I=C.name=C.name||"@ARTDIALOG.WINNAME"+(new Date).getTime(),F=C.VBArray&&!C.XMLHttpRequest;E(function(){!C.jQuery&&document.compatMode==="BackCompat"&&alert("artDialog Error: document.compatMode === \"BackCompat\"")});var G=D.top=function(){var _=C,$=function(A){try{var _=C[A].document;_.getElementsByTagName}catch($){return!1}return C[A].artDialog&&_.getElementsByTagName("frameset").length===0};return $("top")?_=C.top:$("parent")&&(_=C.parent),_}();D.parent=G,B=G.artDialog,_=function(){return B.defaults.zIndex},D.data=function(B,A){var $=D.top,_=$[J]||{};$[J]=_;if(A)_[B]=A;else return _[B];return _},D.removeData=function(_){var $=D.top[J];$&&$[_]&&delete $[_]},D.through=$=function(){var $=B.apply(this,arguments);return G!==C&&(D.list[$.config.id]=$),$},G!==C&&E(C).bind("unload",function(){var A=D.list,_;for(var $ in A)A[$]&&(_=A[$].config,_&&(_.duration=0),A[$].close(),delete A[$])}),D.open=function(B,P,O){P=P||{};var N,L,M,X,W,V,U,T,S,R=D.top,Q="position:absolute;left:-9999em;top:-9999em;border:none 0;background:transparent",a="width:100%;height:100%;border:none 0";if(O===!1){var Z=(new Date).getTime(),Y=B.replace(/([?&])_=[^&]*/,"$1_="+Z);B=Y+(Y===B?(/\?/.test(B)?"&":"?")+"_="+Z:"")}var G=function(){var B,C,_=L.content.find(".aui_loading"),A=N.config;M.addClass("aui_state_full"),_&&_.hide();try{T=W.contentWindow,U=E(T.document),S=T.document.body}catch($){W.style.cssText=a,A.follow?N.follow(A.follow):N.position(A.left,A.top),P.init&&P.init.call(N,T,R),P.init=null;return}B=A.width==="auto"?U.width()+(F?0:parseInt(E(S).css("marginLeft"))):A.width,C=A.height==="auto"?U.height():A.height,setTimeout(function(){W.style.cssText=a},0),N.size(B,C),A.follow?N.follow(A.follow):N.position(A.left,A.top),P.init&&P.init.call(N,T,R),P.init=null},I={zIndex:_(),init:function(){N=this,L=N.DOM,X=L.main,M=L.content,W=N.iframe=R.document.createElement("iframe"),W.src=B,W.name="Open"+N.config.id,W.style.cssText=Q,W.setAttribute("frameborder",0,0),W.setAttribute("allowTransparency",!0),V=E(W),N.content().appendChild(W),T=W.contentWindow;try{T.name=W.name,D.data(W.name+K,N),D.data(W.name+H,C)}catch($){}V.bind("load",G)},close:function(){V.css("display","none").unbind("load",G);if(P.close&&P.close.call(this,W.contentWindow,R)===!1)return!1;M.removeClass("aui_state_full"),V[0].src="about:blank",V.remove();try{D.removeData(W.name+K),D.removeData(W.name+H)}catch($){}}};typeof P.ok=="function"&&(I.ok=function(){return P.ok.call(N,W.contentWindow,R)}),typeof P.cancel=="function"&&(I.cancel=function(){return P.cancel.call(N,W.contentWindow,R)}),delete P.content;for(var J in P)I[J]===A&&(I[J]=P[J]);return $(I)},D.open.api=D.data(I+K),D.opener=D.data(I+H)||C,D.open.origin=D.opener,D.close=function(){var $=D.data(I+K);return $&&$.close(),!1},G!=C&&E(document).bind("mousedown",function(){var $=D.open.api;$&&$.focus(!0)}),D.load=function(C,D,B){B=B||!1;var G=D||{},H={zIndex:_(),init:function(A){var _=this,$=_.config;E.ajax({url:C,success:function($){_.content($),G.init&&G.init.call(_,A)},cache:B})}};delete D.content;for(var F in G)H[F]===A&&(H[F]=G[F]);return $(H)},D.alert=function(A){return $({id:"Alert",zIndex:_(),icon:"warning",fixed:!0,lock:!0,content:A,ok:!0})},D.confirm=function(C,A,B){return $({id:"Confirm",zIndex:_(),icon:"question",fixed:!0,lock:!0,opacity:0.1,content:C,ok:function($){return A.call(this,$)},cancel:function($){return B&&B.call(this,$)}})},D.prompt=function(D,B,C){C=C||"";var A;return $({id:"Prompt",zIndex:_(),icon:"question",fixed:!0,lock:!0,opacity:0.1,content:["<div style=\"margin-bottom:5px;font-size:12px\">",D,"</div>","<div>","<input value=\"",C,"\" style=\"width:18em;padding:6px 4px\" />","</div>"].join(""),init:function(){A=this.DOM.content.find("input")[0],A.select(),A.focus()},ok:function($){return B&&B.call(this,A.value,$)},cancel:!0})},D.tips=function(B,A){return $({id:"Tips",zIndex:_(),title:!1,cancel:!1,fixed:!0,lock:!1}).content("<div style=\"padding: 0 1em;\">"+B+"</div>").time(A||1.5)},E(function(){var A=D.dragEvent;if(!A)return;var B=E(C),$=E(document),_=F?"absolute":"fixed",H=A.prototype,I=document.createElement("div"),G=I.style;G.cssText="display:none;position:"+_+";left:0;top:0;width:100%;height:100%;"+"cursor:move;filter:alpha(opacity=0);opacity:0;background:#FFF",document.body.appendChild(I),H._start=H.start,H._end=H.end,H.start=function(){var E=D.focus.DOM,C=E.main[0],A=E.content[0].getElementsByTagName("iframe")[0];H._start.apply(this,arguments),G.display="block",G.zIndex=D.defaults.zIndex+3,_==="absolute"&&(G.width=B.width()+"px",G.height=B.height()+"px",G.left=$.scrollLeft()+"px",G.top=$.scrollTop()+"px"),A&&C.offsetWidth*C.offsetHeight>307200&&(C.style.visibility="hidden")},H.end=function(){var $=D.focus;H._end.apply(this,arguments),G.display="none",$&&($.DOM.main[0].style.visibility="visible")}})})(window.jQuery||window.art,this,this.artDialog)
</script>
<script src="./tpl/System/Static/js/common.js"></script>
<!--自定义js代码区开始-->
<script type="text/javascript">
    var table = $('#simple_2');
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
            url: '{pigcms{:U("House/ajax_employee_list")}&department_id='+localStorage.getItem('department_id'),
            type: 'POST'
        },
        ordering:  false,
        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

        "lengthMenu": [
            [30,50,100, -1],
            [30,50,100, "​全部"] // change per page values here
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
            /*{
                "mDataProp" : "check_id",
                "sTitle" : "<input type='checkbox'  name='allbox' id='allbox' onclick='check();' />",
                "sDefaultContent" : "",
                "bSortable" : false,
                "sClass" : "center"
            },*/
            {
                "sTitle" : "用户名",
                "mDataProp": "account",
                "sDefaultContent" : "不存在",
                "sClass" : "center"
            },
            {
                "sTitle" : "真实姓名",
                "mDataProp": "realname",
                "sDefaultContent" : "",
                "sClass" : "center"
            },
            {
                "sTitle" : "角色",
                "mDataProp": "role_name",
                "sDefaultContent" : "",
                "sClass" : "center"
            },
            {
                "sTitle" : "状态",
                "mDataProp": "status",
                "sDefaultContent" : "",
                "sClass" : "center"
            },
            {
                "sTitle" : "操作",
                "mDataProp": "action",
                "sDefaultContent" : "",
                "sClass" : "center"
            }

        ]
    });
    $("#simple_2_filter input[type=search]").removeClass("input-small");
    $("#simple_2_filter input[type=search]").css({ width: '200px' });
    var search_type=sessionStorage.getItem('search_type');
    if(search_type) $('#search_type').val(search_type);
    function search_change(key,value){
        if(key=='department_id'){
            localStorage.setItem(key,value);
        }else{
            sessionStorage.setItem(key,value);
        }
        var url='{pigcms{:U("House/ajax_employee_list")}&department_id='+localStorage.getItem('department_id')+'&search_type='+sessionStorage.getItem('search_type');
        // console.log(url);
        table.api().ajax.url(url).load();
    }

    $(document).on('click','.pagebar a',function(){
        var str=$(this).attr('href');
        var department_id = str.match(/department_id=(\d+)/gi) || "department_id=0";
        department_id=department_id.toString();
        department_id=department_id.split('=')[1];
        search_change('department_id',department_id);
        return false;

    })

</script>

<script type="text/javascript">
    var del_url="{pigcms{:U('House/employee_del')}";
    $(document).on('click','#tree_3 ul li a',function(){
        var id;
        var a_val=$(this).attr('id');
        var id_arr = new Array();
        id_arr = a_val.split("_");
        id = id_arr[0];
        $(".blue").attr('depart_arr',id);
        $(".red").attr('depart_arr',id);
        $('#uppercase').text($(this).text());
        search_change('department_id',id);

        //$(this).attr('href','?g=System&c=House&a=employee_news&department_id='+id);
    })
	employeeChange();

    //改变用户状态方法
    function employeeChange(){
        $('.clickChange').click(function(){
            var idVal=$(this).attr('data_id');
            var statusVal=$(this).attr('data_status');
            var this_change=$(this);
            $.ajax({
                'url':"{pigcms{:U('House/employee_status')}",
                'data':{'ids':idVal,'status':statusVal},
                'type':'POST',
                'dataType':'JSON',
                'success':function(msg){
                    if(msg.msg_code==0){
                        //alert(msg.msg_data);
                        //window.location.reload();
                        if(msg.msg_data==1){
                            var status_name='已启用';
                        }else{
                            var status_name='已禁用';
                        }
                        this_change.attr('data_status',msg.msg_data); //修改状态
                        this_change.text(status_name);
                    }else{
                        alert(msg.msg_data);
                    }
                },
                'error':function(){
                    //alert('loading error');
                }
            })
        })
    }

    //批量启用或禁用
		$(document).on('click','.status_click',function(){
        //$('.status_click').on('click',function(){
			//alert(1);
            var statusVal=$(this).attr('data_status');
            checkbox2=$("input[name='checkbox2']");
            //alert(checkbox2.length);
            var ids_arr=new Array();
            for(var i=0;i<checkbox2.length;i++){
                //alert(checkbox2[i].checked);
                if(checkbox2[i].checked==true){	//判断是否被选中
                    ids_arr[i]=checkbox2[i].value;
                }
            }
            //alert(ids_arr);
            if(ids_arr=="" || ids_arr=="null"){
                alert('请选择用户！');
            }else{
                $.ajax({
                    'url':"{pigcms{:U('House/employee_status_new')}",
                    'data':{'ids':ids_arr,'status':statusVal},
                    'type':'POST',
                    'dataType':'JSON',
                    'success':function(msg){
                        if(msg.msg_code==0){
                            //alert(msg.msg_data);
                            //window.location.reload();
                            $('.order-column').text("");
                            $('.order-column').append(msg.msg_data);
                            //alert(ids_arr.length);
                        }else{
                            alert(msg.msg_data);
                        }
                        employeeEdit();
                        employeeDel();
                        checkAll();
                    },
                    'error':function(){
                        //alert('loading error');
                    }
                })
            }
        })
 

    //修改用户信息方法
    function employeeEdit(){
        $('.select_bj').click(function(){
            var employee_idVal=$(this).attr('data_idVal');
            //alert(employee_idVal);
            window.top.artiframe('/admin.php?g=System&c=House&a=employee_edit&id='+employee_idVal,'编辑员工',700,380,true,false,false,editbtn,'edit',true);
        });
    }
    //编辑部门
    function dept_click(obj){
		//console.log(this);
        //var dept_idVal=$("*[name='aaa']").attr("depart_arr");
		var dept_idVal=$(obj).attr("depart_arr");
        //alert(dept_idVal);
        window.top.artiframe('/admin.php?g=System&c=House&a=department_edit1&id='+dept_idVal,'编辑部门',520,350,true,false,false,editbtn,'edit',true);
    }

    //删除部门
    function del_click(obj){
        if(window.confirm('你确定要删除吗？')){
            var dept_idVal=$(obj).attr("depart_arr");
			//alert(dept_idVal);
            $.ajax({
                'url':"{pigcms{:U('House/dept_del')}",
                'data':{'id':dept_idVal},
                'type':'POST',
                'dataType':'JSON',
                'success':function (data) {
                    if(data.err_code==0){	//删除成功
                        alert(data.code_data);
                        window.location.reload();
                    }else{
                        alert(data.code_data);
                    }
                },
                'error':function(){
                    //alert('loading error');
                }
            })
        }
    }

// function checkAll2(){	 	//全选方法
	// $(".td_checkbox").click(function(){
		// $('input[name="checkbox2"]').attr("checked",this.checked);
	// });
	// var checkbox2=$("input[name='checkbox2']");
	// checkbox2.click(function(){
		// $(".td_checkbox").attr("checked",checkbox2.length==$("input[name='checkbox2']:checked").length ? true : false);
	// });
// }
function checkAll(obj){
       $("input[type='checkbox']").prop('checked', $(obj).prop('checked'));
    }
</script>
<script type="text/javascript">
  function delete_pr_info(obj){
			layer.msg('你确定要删除么？', {
				time: 0 //不自动关闭
				,btn: ['确定', '取消']
				,yes: function(index){
					layer.close(index);
					var id=$(obj).attr('id');
					//通过ajax异步删除
					$.ajax({
						url:"{pigcms{:U('House/employee_del')}",
						data:{'id':id},
						dataType:'json',
						type:'post',
						success:function(delmsg){
							if(delmsg==='1'){
								//逻辑删除成功！
								layer.msg('删除成功！', {icon: 6});
								//同时刷新页面
								window.location.reload();
							}else{
								//逻辑删除失败！
								layer.msg('删除失败！', {icon: 5});
							}
						}

					});
				}
			});
			
		}


</script>

</body>

</html>