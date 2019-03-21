<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    <!--

    .fe:link{color:#666666; text-decoration:none;}
    .fe:visited{color:#666666; text-decoration:none;}
    .fe:active{color:#666666; text-decoration:none;}
    .fe:hover{color:#FFFFFF; text-decoration:none;}
    -->
    .label-kid {
        background-color: #f36a5a;
    }
    .btn-group>.dropdown-menu, .dropdown-toggle>.dropdown-menu, .dropdown>.dropdown-menu {
        margin-top: 10px;
    }
    .dropdown-menu {
        margin: 0 0 0 -90px;
        position: absolute;
    }
    .table td{
        text-align: center;
    }
	.table-scrollable .dataTable td>.btn-group, .table-scrollable .dataTable th>.btn-group {
    position: relative;
    margin-top: -2px;
}
</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>供应商管理
                    <!--<small>用户的任何消费都会被记录在此 </small>-->
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <span class="active">固定资产</span>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"> 供应商信息列表 </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-group">
                                        <a href="{pigcms{:U('Off/supplier_add')}">
                                            <button id="sample_editable_1_new" class="btn sbold green">新建供应商
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                    <!-- <div class="btn-group">
                                        <a href="{pigcms{:U('Off/products_custom_list')}">
                                            <button id="sample_editable_1_new" class="btn sbold green">二维码管理
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                    </div> -->
                                    <div class="btn-group">
                                        <a href="{pigcms{:U('supplier_import_step')}">
                                            <button id="sample_editable_1_new" class="btn sbold green">批量导入供应商信息
                                                <!-- <i class="fa fa-plus"></i> -->
                                            </button>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{pigcms{:U('Off/supplier_goods_list')}" data-toggle="modal">
                                            <button id="sample_editable_1_new" class="btn sbold green">商品信息总表
                                                <!-- <i class="fa fa-plus"></i> -->
                                            </button>
                                        </a>
                                    </div>
                                    
                                    <!-- <div class="btn-group" style=" float: right;">
                                        <form action="{pigcms{:U('Off/products_operate')}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <input type="search_borrower" class="form-control input-sm input-small input-inline" placeholder="" aria-controls="sample_1" name="search_borrower">
                                            <button id="sample_editable_1_new" class="btn sbold green" type="submit">筛选责任人</button>
                                        </form>                                       
                                    </div>

                                    <div style="float: right; width:200px; margin-right: 15px;">
                                        <span style="float: left; margin-top: 6px;">筛选：</span>
                                        <select style="width:150px; height:34px; float: right; padding:6px 12px; background-color:#FFFFFF; border: 1px solid #c2cad8;" id="select_village_id">
                                            <option value=" ">全部显示</option>
                                            <foreach name="villageArray" item="vo">
                                                <option value="{pigcms{$vo.village_id}" <if condition="$villageId eq $vo['village_id']">selected="selected"</if> >{pigcms{$vo.village_name}</option>
                                            </foreach>
                                        </select>
                                    </div> -->                                    
                                             
                                </div>
                            </div>
                        </div>

                        <!-- 模态框开始 -->
                        <div id="form_modal" class="modal fade" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">各项目数据统计简表</h4>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="company_list_count" style="margin-top:25px;">
                                            <tr>
                                                <td align="center">项目名称</td>
                                                <td align="center">物品总数量</td>
                                                <td align="center">占比率</td>
                                                <!-- <td align="center">合计</td> -->
                                            </tr>                                            
                                            <foreach name="villageArray" item="vo">
                                                <tr>
                                                    <td align="center">{pigcms{$vo.village_name}</td>
                                                    <if condition="$vo.count neq ''">
                                                        <td align="center">{pigcms{$vo.count}/{pigcms{$Count}</td>
                                                    <else/>
                                                        <td align="center">0/{pigcms{$Count}</td>
                                                    </if>                                                   
                                                    <td align="center">{pigcms{$vo.rate}%</td>
                                                </tr>
                                            </foreach>                                            
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                                        <!--<button class="btn green"  onclick="updateTime()">更新</button>-->

                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- 模态框结束     -->

                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th>
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                        <span></span>
                                    </label>
                                </th>
                                <!-- <th  style="width: 150px; text-align: center;">物品编号</th> -->
                                <th style="width: 350px; text-align: center;">单位名称</th>
                                <th style="text-align: center;">联系人</th>
                                <th style="text-align: center;">联系电话</th>
                                <th style="text-align: center;">联系地址</th>
                                <th style="text-align: center;">经营范围</th>
                                <th style="text-align: center;">税率</th>                               
                                <th style="text-align: center;">商品清单</th>
                                <th style="text-align: center;">合作状态</th>
                                <th style="width: 150px; text-align: center;">操作</th>
                            </tr>
                            </thead>
                            <foreach name="supplier_list" item="vo" id="change_data">
                                <tr>
                                    <td>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1" />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>{pigcms{$vo.sup_unit}</td>
                                    <td>{pigcms{$vo.sup_name}</td>
                                    <td>{pigcms{$vo.phone}</td>
                                    <td>{pigcms{$vo.location}</td>
                                    <td>{pigcms{$vo.business_name}</td>
                                    <td>{pigcms{$vo.tax_rate}</td>                                   
                                    <!-- <td>{pigcms{$vo.add_name}</td> -->
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs green" type="button">
                                                <a href="{pigcms{:U('Off/supplier_goods_list',array('id'=>$vo['id']))}" style="color: #FFF;">商品清单</a>
                                            </button>                                           
                                        </div>
                                    </td>
                                    <!-- <if condition="$vo['status'] eq 1">
                                        <td>正常</td>
                                    <else/>
                                        <td>已停止</td>
                                    </if> -->
                                    <td>
                                        <if condition="$vo['status'] eq 1">
                                            <button class="btn btn-sm green btn-outline filter-submit margin-bottom" id="supplier_{pigcms{$vo.id}" value="{pigcms{$vo.status}" onclick="changeType(this)">正常</button>
                                            <input type="hidden" id="supplier_{pigcms{$vo.id}_id" value="{pigcms{$vo['id']}">
                                        <else/>
                                            <button class="btn btn-sm red btn-outline filter-submit margin-bottom" id="supplier_{pigcms{$vo.id}" value="{pigcms{$vo.status}" onclick="changeType(this)">已终止</button>
                                            <input type="hidden" id="supplier_{pigcms{$vo.id}_id" value="{pigcms{$vo['id']}">
                                        </if>
                                    </td>                                    
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                                                <li>
                                                    <a href="{pigcms{:U('Off/supplier_detail',array('id'=>$vo['id']))}" data-toggle="modal" data-target="#modal_{pigcms{$vo.id}">
                                                        <i class="icon-docs"></i> 详情 </a>
                                                </li>
                                                <li>
                                                    <a href="{pigcms{:U('Off/supplier_edit',array('id'=>$vo['id']))}">
                                                        <i class="icon-docs"></i> 更新 </a>
                                                </li>
                                                <li onclick="delete_pr_info(this)" id="{pigcms{$vo.id}">
                                                    <a href="javascript:;">
                                                        <i class="icon-tag"></i> 删除 </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <!--弹出层容器-->
                                <div class="modal fade" tabindex="-1" role="dialog" id="modal_{pigcms{$vo.id}">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">

                                        </div>
                                    </div>
                                </div>
                                <!--        弹出层容器-->
                            </foreach>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
                <div class="modal fade" tabindex="-1" role="dialog" id="common_modal">
                    <div class="modal-dialog modal-lg" role="document" >
                        <div class="modal-content">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAIER -->
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
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>
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
<link rel="stylesheet" href="{pigcms{$static_public}js/artdialog/skins/mydialog.css?4.1.7">
<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./tpl/System/Static/js/index1.js"></script>
<script>
    (function(E,C,D,A){var B,$,_,J="@ARTDIALOG.DATA",K="@ARTDIALOG.OPEN",H="@ARTDIALOG.OPENER",I=C.name=C.name||"@ARTDIALOG.WINNAME"+(new Date).getTime(),F=C.VBArray&&!C.XMLHttpRequest;E(function(){!C.jQuery&&document.compatMode==="BackCompat"&&alert("artDialog Error: document.compatMode === \"BackCompat\"")});var G=D.top=function(){var _=C,$=function(A){try{var _=C[A].document;_.getElementsByTagName}catch($){return!1}return C[A].artDialog&&_.getElementsByTagName("frameset").length===0};return $("top")?_=C.top:$("parent")&&(_=C.parent),_}();D.parent=G,B=G.artDialog,_=function(){return B.defaults.zIndex},D.data=function(B,A){var $=D.top,_=$[J]||{};$[J]=_;if(A)_[B]=A;else return _[B];return _},D.removeData=function(_){var $=D.top[J];$&&$[_]&&delete $[_]},D.through=$=function(){var $=B.apply(this,arguments);return G!==C&&(D.list[$.config.id]=$),$},G!==C&&E(C).bind("unload",function(){var A=D.list,_;for(var $ in A)A[$]&&(_=A[$].config,_&&(_.duration=0),A[$].close(),delete A[$])}),D.open=function(B,P,O){P=P||{};var N,L,M,X,W,V,U,T,S,R=D.top,Q="position:absolute;left:-9999em;top:-9999em;border:none 0;background:transparent",a="width:100%;height:100%;border:none 0";if(O===!1){var Z=(new Date).getTime(),Y=B.replace(/([?&])_=[^&]*/,"$1_="+Z);B=Y+(Y===B?(/\?/.test(B)?"&":"?")+"_="+Z:"")}var G=function(){var B,C,_=L.content.find(".aui_loading"),A=N.config;M.addClass("aui_state_full"),_&&_.hide();try{T=W.contentWindow,U=E(T.document),S=T.document.body}catch($){W.style.cssText=a,A.follow?N.follow(A.follow):N.position(A.left,A.top),P.init&&P.init.call(N,T,R),P.init=null;return}B=A.width==="auto"?U.width()+(F?0:parseInt(E(S).css("marginLeft"))):A.width,C=A.height==="auto"?U.height():A.height,setTimeout(function(){W.style.cssText=a},0),N.size(B,C),A.follow?N.follow(A.follow):N.position(A.left,A.top),P.init&&P.init.call(N,T,R),P.init=null},I={zIndex:_(),init:function(){N=this,L=N.DOM,X=L.main,M=L.content,W=N.iframe=R.document.createElement("iframe"),W.src=B,W.name="Open"+N.config.id,W.style.cssText=Q,W.setAttribute("frameborder",0,0),W.setAttribute("allowTransparency",!0),V=E(W),N.content().appendChild(W),T=W.contentWindow;try{T.name=W.name,D.data(W.name+K,N),D.data(W.name+H,C)}catch($){}V.bind("load",G)},close:function(){V.css("display","none").unbind("load",G);if(P.close&&P.close.call(this,W.contentWindow,R)===!1)return!1;M.removeClass("aui_state_full"),V[0].src="about:blank",V.remove();try{D.removeData(W.name+K),D.removeData(W.name+H)}catch($){}}};typeof P.ok=="function"&&(I.ok=function(){return P.ok.call(N,W.contentWindow,R)}),typeof P.cancel=="function"&&(I.cancel=function(){return P.cancel.call(N,W.contentWindow,R)}),delete P.content;for(var J in P)I[J]===A&&(I[J]=P[J]);return $(I)},D.open.api=D.data(I+K),D.opener=D.data(I+H)||C,D.open.origin=D.opener,D.close=function(){var $=D.data(I+K);return $&&$.close(),!1},G!=C&&E(document).bind("mousedown",function(){var $=D.open.api;$&&$.focus(!0)}),D.load=function(C,D,B){B=B||!1;var G=D||{},H={zIndex:_(),init:function(A){var _=this,$=_.config;E.ajax({url:C,success:function($){_.content($),G.init&&G.init.call(_,A)},cache:B})}};delete D.content;for(var F in G)H[F]===A&&(H[F]=G[F]);return $(H)},D.alert=function(A){return $({id:"Alert",zIndex:_(),icon:"warning",fixed:!0,lock:!0,content:A,ok:!0})},D.confirm=function(C,A,B){return $({id:"Confirm",zIndex:_(),icon:"question",fixed:!0,lock:!0,opacity:0.1,content:C,ok:function($){return A.call(this,$)},cancel:function($){return B&&B.call(this,$)}})},D.prompt=function(D,B,C){C=C||"";var A;return $({id:"Prompt",zIndex:_(),icon:"question",fixed:!0,lock:!0,opacity:0.1,content:["<div style=\"margin-bottom:5px;font-size:12px\">",D,"</div>","<div>","<input value=\"",C,"\" style=\"width:18em;padding:6px 4px\" />","</div>"].join(""),init:function(){A=this.DOM.content.find("input")[0],A.select(),A.focus()},ok:function($){return B&&B.call(this,A.value,$)},cancel:!0})},D.tips=function(B,A){return $({id:"Tips",zIndex:_(),title:!1,cancel:!1,fixed:!0,lock:!1}).content("<div style=\"padding: 0 1em;\">"+B+"</div>").time(A||1.5)},E(function(){var A=D.dragEvent;if(!A)return;var B=E(C),$=E(document),_=F?"absolute":"fixed",H=A.prototype,I=document.createElement("div"),G=I.style;G.cssText="display:none;position:"+_+";left:0;top:0;width:100%;height:100%;"+"cursor:move;filter:alpha(opacity=0);opacity:0;background:#FFF",document.body.appendChild(I),H._start=H.start,H._end=H.end,H.start=function(){var E=D.focus.DOM,C=E.main[0],A=E.content[0].getElementsByTagName("iframe")[0];H._start.apply(this,arguments),G.display="block",G.zIndex=D.defaults.zIndex+3,_==="absolute"&&(G.width=B.width()+"px",G.height=B.height()+"px",G.left=$.scrollLeft()+"px",G.top=$.scrollTop()+"px"),A&&C.offsetWidth*C.offsetHeight>307200&&(C.style.visibility="hidden")},H.end=function(){var $=D.focus;H._end.apply(this,arguments),G.display="none",$&&($.DOM.main[0].style.visibility="visible")}})})(window.jQuery||window.art,this,this.artDialog)
</script>
<script src="./tpl/System/Static/js/common.js"></script>

<!--自定义js代码区开始-->
<script type="text/javascript">
    //获取将要删除的记录对应的id

    function delete_pr_info(obj) {
        layer.msg('你确定要删除么？本操作不可恢复！', {
            time: 0 //不自动关闭
            ,btn: ['确定', '取消']
            ,yes: function(index){
                layer.close(index);
                var id=$(obj).attr('id');
                //通过ajax异步删除
                $.ajax({
                    url:"{pigcms{:U('Off/supplier_delete')}",
                    data:{'id':id},
                    type:'post',
                    success:function(delmsg){
                        if(delmsg==='1'){
                            //逻辑删除成功！
                            layer.msg('删除成功！', {icon: 6});
                            //同时刷新页面
                            $(obj).parent().parent().parent().parent().remove();
                        }else{
                            //逻辑删除失败！
                            layer.msg('删除失败！', {icon: 5});
                        }
                    },
                    error:function (res) {
                        lay.msg(res);
                    }

                });
            }
        });
    }

    //表格显示控制js代码区
    var table = $('#sample_1');

    // begin first table
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

        // Or you can use remote translation file
        //"language": {
        //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
        //},

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
        // So when dropdowns used the scrollable div should be removed.
        //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

        "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "全部"] // change per page values here
        ],
        // set the initial value
        "pageLength": 100,
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
            [1, "desc"]
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
    // function func(){  
    //    //获取被选中的option标签  
    //    var village_id = $('#select_village_id option:selected').val();
    //    // console.log(village_id);
    //    $.ajax({
    //         url:"{pigcms{:U('Off/off_list_news')}",
    //         data:{'village_id':village_id},
    //         dataType:'json',
    //         type:'post',
    //         success:function(offArr){
    //             console.log(offArr);
    //         }
    //     });
    // }


    $("select#select_village_id").change(function(){
        var u = $(this).val();
        var str = window.location.href;
        var length = str.substr(str.lastIndexOf('villageId=')-1,).length; //获取url中&villageId=u的长度
        var url = '';
        if(str.indexOf("villageId")>0){
            url = str.substring(0,str.length-length);            
        }else{
            url = str;
        }
        location.href=url+'&villageId='+u;
    });

    function changeType(id) {
        var status_id = $(id).attr('id');
        // var point_id_id = is_del+'_id';
        // console.log(status_id);

        var status = $("#"+status_id).val();
        var sup_id = $("#"+status_id+"_id").val();

        console.log(status);
        console.log(sup_id);

        $.ajax({
            url:'{pigcms{:U("supplier_status")}',
            type:'post',
            data:{'status':status, 'sup_id':sup_id},
            success:function (re) {
                if (status == 1) {
                    if (re) {
                        $('#'+status_id).html('已终止');
                        $('#'+status_id).css("background-color","red");
                        // alert('该点位已停用');
                    }
                } else {
                    if (re) {
                        $('#'+status_id).html('正常');
                        $('#'+status_id).css("background-color","green");
                        // alert('该点位已启用');
                    }
                }
                location.href = window.location.href;
            }
        });
    }
</script>

<!--自定义js代码区结束-->
</body>

</html>