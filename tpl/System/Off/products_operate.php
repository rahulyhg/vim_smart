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
</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>物品分发
                    <!--<small>用户的任何消费都会被记录在此 </small>-->
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{pigcms{:U('Off/off_list_news')}">物品管理</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">物品分发</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"> 列表记录</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
<!--                                    <div class="btn-group">-->
<!--                                        <a href="{pigcms{:U('Off/products_add')}">-->
<!--                                            <button id="sample_editable_1_new" class="btn sbold green">批量打印-->
<!--                                                <i class="fa fa-plus"></i>-->
<!--                                            </button>-->
<!--                                        </a>-->
<!--                                    </div>-->

                                    <div class="btn-group">
                                        <a onclick="pixia()">
                                            <button id="sample_editable_1_new" class="btn sbold green">批量下載
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                    </div>

                                    <div class="btn-group">
                                        <a href="#form_modal2" data-toggle="modal">
                                            <button  class="btn sbold green" >批量分发
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                    <if condition="$villageId neq ''">
                                        <div class="btn-group">
                                            <a href="{pigcms{:U('off_list_news',array('villageId'=>$villageId))}">
                                                <button id="sample_editable_1_new" class="btn sbold green">返回
                                                </button>
                                            </a>
                                        </div>
                                    <else/>
                                        <div class="btn-group">
                                            <a href="{pigcms{:U('off_list_news')}">
                                                <button id="sample_editable_1_new" class="btn sbold green">返回
                                                </button>
                                            </a>
                                        </div>
                                    </if>
                                    
                                    <div class="btn-group" style=" float: right;">
                                        <form action="{pigcms{:U('Off/products_operate')}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <input type="search_borrower" class="form-control input-sm input-small input-inline" placeholder="" aria-controls="sample_1" name="search_borrower">
                                            <button id="sample_editable_1_new" class="btn sbold green" type="submit">筛选责任人</button>
                                        </form>                                       
                                    </div>

                                    <div style="float: right; width:200px; margin-right: 15px;">
                                        <span style="float: left; margin-top: 6px;">筛选：</span>
                                        <select style="width:150px; height:34px; float: right; padding:6px 12px; background-color:#FFFFFF; border: 1px solid #c2cad8;" id="select_village_id" onchange="func()">
                                            <option value="" >全部显示</option>
                                            <foreach name="villageArray" item="vo">
                                                <option value="{pigcms{$vo.village_id}" <if condition="$villageId eq $vo['village_id']">selected="selected"</if> >{pigcms{$vo.village_name}</option>
                                            </foreach>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

<!--                        弹出框-->
                        <div id="form_modal2" class="modal fade" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">设置责任人</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form  method="post"  class="form-horizontal">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">责任人:</label>
                                                <div class="col-md-8">
                                                    <input class="form-control input-medium date-picker" name="borrower" id="modal_tan" type="text"  /> </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn green"  onclick="go()">确定</button>
                                        <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th>
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                        <span></span>
                                    </label>
                                </th>
                                <th  style="width: 100px; text-align: center;line-height: 40px;">二维码编号</th>
                                <th  style="width: 250px; text-align: center;line-height: 40px;">物品名称</th>
                                <th  style="text-align: center;line-height: 40px;">物品单价</th>
                                <th  style="text-align: center;line-height: 40px;">物品品牌</th>
                                <th  style="text-align: center;line-height: 40px;">责任人</th>
                                <th  style="text-align: center;line-height: 40px;">时间</th>
                                <th  style="text-align: center;line-height: 40px;">所属项目</th>
                                <th  style="text-align: center;line-height: 40px;">二维码</th>
                                <th  style="text-align: center;line-height: 40px;">历史</th>
                                <th  style="width: 100px; text-align: center;line-height: 40px;">操作</th>
                            </tr>
                            </thead>
                            <foreach name="codeArr" item="vo" key="k">
                                <tr>
                                    <td style="line-height: 40px;">
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="{pigcms{$vo.id}" />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td style="line-height: 40px;">{pigcms{$vo.pro_qrcode}</td>
                                    <if condition="$borrower neq ''">
                                        <td style="line-height: 40px;">{pigcms{$vo.pro_name}</td>
                                        <td style="line-height: 40px;">{pigcms{$vo.pro_price}</td>
                                        <td style="line-height: 40px;">{pigcms{$vo.band}</td>
                                    <else/>
                                        <td style="line-height: 40px;">{pigcms{$proArr.pro_name}</td>
                                        <td style="line-height: 40px;">{pigcms{$proArr.pro_price}</td>
                                        <td style="line-height: 40px;">{pigcms{$proArr.band}</td>
                                    </if>
                                    
                                    <td style="line-height: 40px;">
                                        <input  type="text" style="border: none;text-align: center;height: 30px;" value="{pigcms{$vo.borrower}"  onchange="txtblur(this,{pigcms{$vo.id})"  />
                                    </td>
                                    <td style="line-height: 40px;">
                                        <if condition="$vo['trans_time'] neq '' " >
                                            {pigcms{$vo.trans_time|date="Y-m-d H:i:s",###}
                                        </if>
                                    </td>
                                    <td style="line-height: 40px;">{pigcms{$vo.village_name}</td>
                                    <td style="line-height: 40px;">
                                        <img _src="{pigcms{$vo.adress}" style="width: 40px;height: 40px;" onmouseover="big({pigcms{$vo.id})" onmouseout="small()" id="henfan_{pigcms{$vo.uni}"
                                        src="{pigcms{$vo.adress}" />
                                    </td>
                                    <td style="line-height: 40px;">
                                        <a href="{pigcms{:U('Off/history_qrcode',array('id'=>$vo['id'],'pro_id'=>$pro_id))}">历史记录</a>
                                    </td>
                                    <td style="line-height: 40px;">
                                        <a onclick="downloadIamge({pigcms{$vo.uni})">二维码下载</a>
                                    </td>
<!--                                    <td style="line-height: 40px;">-->
<!--                                        <div class="btn-group">-->
<!--                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作-->
<!--                                                <i class="fa fa-angle-down"></i>-->
<!--                                            </button>-->
<!--                                            <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">-->
<!--                                                <li>-->
<!--                                                    <a onclick="downloadIamge({pigcms{$vo.uni})">-->
<!--                                                        <i class="icon-tag"></i> 二维码下载 </a>-->
<!--                                                </li>-->
<!--                                                <li onclick="delete_pr_info(this)" id="{pigcms{$vo.pro_id}">-->
<!--                                                    <a href="javascript:;">-->
<!--                                                        <i class="icon-tag"></i> 删除 </a>-->
<!--                                                </li>-->
<!--                                            </ul>-->
<!--                                        </div>-->
<!--                                    </td>-->
                                </tr>
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


                <img src="" id="bigdada" style="position: fixed;
                            left: 50%;
                            top: 50%;
                             height: 400px;
                            width: 400px;
                            margin: -100px 0px 0px -150px;
                            display:none;
"
                />
            </div>
        </div>

    </div>
</div>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAIER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 2018 &copy; 汇得行智慧助手系统
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
                var pro_id=$(obj).attr('id');
                //通过ajax异步删除
                $.ajax({
                    url:"{pigcms{:U('Off/products_delete')}",
                    data:{'pro_id':pro_id},
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
        "pageLength": 10,
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


    function txtblur(el,id) {
        // console.log(id);return false;
        var borrower = $(el).val();
        var url = "{pigcms{:U('Off/products_operate_save')}";
        $.ajax({
            url:url,
            type:'post',
            data:'id='+id+'&borrower='+borrower,
            dataType:'json',
            success:function(re){
                if (re.err == 0) {
                    layer.msg('领取成功！', {icon: 6});
                    $(el).parent().next().html(re.date);
                } else {
                    layer.msg('领取失败！', {icon: 5});
                }
            }
        })
    }


    function go() {
        var ids = '';
        var borrower = $("#modal_tan").val();
        $(".checkboxes").each(function() {
            if ($(this).is(':checked')) {
                ids += ',' + $(this).val(); //逐个获取id
            }
        });
        ids = ids.substring(1);
        if (ids.length == 0) {
            alert('请选择要分发的选项');
        } else if(borrower.length == 0) {
            alert('请填写真实姓名');
        } else {
            $.ajax({
                type: "post",
                url: "{pigcms{:U('Off/products_operate_save_all')}",
                data: "ids="+ids+"&borrower="+borrower,
                success: function(delmsg) {
                    if(delmsg==='1'){
                        //逻辑删除成功！
                        layer.msg('操作成功！', {icon: 6});
                        //同时刷新页面
                        setTimeout(function(){
                            window.location.reload()
                        },500);
                    }else{
                        //逻辑删除失败！
                        layer.msg("第"+delmsg+"条移除失败！", {icon: 5});
                        setTimeout(function(){
                            window.location.reload()
                        },500);
                    }
                },
                error:function (res) {
                    lay.msg(res);
                }
            });
        }


    }


    function big(id) {
        $.ajax({
            url:"{pigcms{:U('Off/get_url')}",
            type:'post',
            data:'id='+id,
            success:function(re){
                $("#bigdada").attr("src", re);
                $("#bigdada").show();
            }
        })


    }

    function small() {
        $("#bigdada").hide();
    }

    $('body').click(function(){
        $("#bigdada").hide();
    });

    function downloadIamge(selector) {
        //将图片的src属性作为URL地址
        var url = $("#henfan_"+selector).attr("src");

        var a = document.createElement('a');
        var event = new MouseEvent('click');

        var name = "{pigcms{$proArr.pro_name}"+"--"+selector;
        a.download = name || '下载图片名称';
        a.href = url;

        a.dispatchEvent(event)
    }


    function pixia() {
        var ids = '';
        var url = "{pigcms{:U('Off/products_zip')}";
        var borrower = $("#modal_tan").val();
        $(".checkboxes").each(function() {
            if ($(this).is(':checked')) {
                ids += ',' + $(this).val(); //逐个获取id
            }
        });
        ids = ids.substring(1);
        if (ids.length == 0) {
            alert('请选择要批量下载的选项');
            return false;
        } else {
            window.location.href = url+"&ids="+ids;

        }


    }

    function onload_img() {
        $(".odd").each(function(){
            url = $(this).find("td img").attr("src");
            if(!url){
                var url_bak=$(this).find("td img").attr("_src");
                $(this).find("td img").attr("src",url_bak);
            }
        });
        $(".even").each(function(){
            url = $(this).find("td img").attr("src");
            if(!url){
                var url_bak=$(this).find("td img").attr("_src");
                $(this).find("td img").attr("src",url_bak);
            }
        });
    }
    setInterval(onload_img(),500);
    // function pixia() {
    //     var ids = '';
    //     var borrower = $("#modal_tan").val();
    //     $(".checkboxes").each(function() {
    //         if ($(this).is(':checked')) {
    //             ids += ',' + $(this).val(); //逐个获取id
    //         }
    //     });
    //     ids = ids.substring(1);
    //     if (ids.length == 0) {
    //         alert('请选择要批量下载的选项');
    //         return false;
    //     } else {
    //         $.ajax({
    //             type: "post",
    //             url: "{pigcms{:U('Off/products_pixia')}",
    //             data: "ids="+ids,
    //             dataType:'json',
    //             success: function(delmsg) {
    //                 // console.log(delmsg);
    //                 for (var index in delmsg) {
    //                     var selector = delmsg[index];
    //                     downloadIamge(selector);
    //                 }
    //             },
    //             error:function (res) {
    //                 lay.msg(res);
    //             }
    //         });
    //
    //
    //     }
    //
    //
    // }
    
    $("select#select_village_id").change(function(){
        var u = $(this).val();
        var str = window.location.href;
        var url = '';
        if(str.indexOf("villageId")>0){
            url = str.substring(0,str.length-12);
            // console.log(url);
        }else{
            url = str;
        }
        location.href=url+'&villageId='+u;
    });

</script>

<!--自定义js代码区结束-->
</body>

</html>