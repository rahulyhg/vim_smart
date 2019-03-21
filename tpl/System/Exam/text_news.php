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
                <h1>试卷管理
                    <!--<small>用户的任何消费都会被记录在此 </small>-->
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <span class="active">考试列表</span>
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
                            <span class="caption-subject bold uppercase"> 列表记录</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
<!--                                    <div class="btn-group">-->
<!--                                        <a href="{pigcms{:U('Exam/paper_add_news')}">-->
<!--                                            <button id="sample_editable_1_new" class="btn sbold green">新建试卷-->
<!--                                                <i class="fa fa-plus"></i>-->
<!--                                            </button>-->
<!--                                        </a>-->
<!--                                    </div>-->
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th  style="width: 150px; text-align: center;">序号</th>
                                <th  style="text-align: center;">考试名称</th>
                                <th  style="width: 300px; text-align: center;">考试时间</th>
                                <th  style="width: 200px; text-align: center;">考试时长(分)</th>
                                <th  style="width: 150px; text-align: center;">总分(分)</th>
                                <th  style="width: 150px; text-align: center;">操作</th>
                            </tr>
                            </thead>
                            <foreach name="paper_open_arr" item="vo" key="k">
                                <tr>
                                    <td>{pigcms{$k+1}</td>
                                    <td>{pigcms{$vo.title}</td>
                                    <td>{pigcms{$vo.text_time|date="Y-m-d H:i:s",###}</td>
                                    <td>{pigcms{$vo.testtime}</td>
                                    <td>{pigcms{$vo.totalper}</td>
                                    <td>
<!--                                        <if condition="$Think.session.admin_name eq 'admin'"><else /></if>-->
                                        <div class="btn-group">
                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                                                <li>
                                                    <a href="{pigcms{:U('Exam/text_start_news',array('id'=>$vo['id']))}">
                                                        <i class="icon-docs"></i> 测试 </a>
                                                </li>
                                                <li onclick="delete_pr_info(this)" id="{pigcms{$vo.id}">
                                                    <a href="javascript:;">
                                                        <i class="icon-tag"></i> 移除 </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="btn-group">
                                            <if condition="time() lt $vo['text_time']"><span style="color:#c0cedb;">开始</span>
                                                <elseif condition="(time() egt $vo['text_time']) and (time() elt $vo['end_time'])" />
                                                <if condition="isset($vo['m'])">
                                                    <span style="color:#c0dcf3;">考试已完成</span>
                                                    <else />
                                                <a href="{pigcms{:U('Exam/text_start_news',array('id'=>$vo['id']))}">
                                                    开始 </a>
                                                </if>
                                                <else />
                                                <span style="color:#c0cedb;">考试结束</span>
                                            </if>

                                        </div>

                                    </td>
                                </tr>
                            </foreach>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
                <div class="modal fade" tabindex="-1" role="dialog" id="common_modal">
                    <div class="modal-dialog modal-lg" role="document" style="width:500px">
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
        layer.msg('你确定要从考试列表中移除么？', {
            time: 0 //不自动关闭
            ,btn: ['确定', '取消']
            ,yes: function(index){
                layer.close(index);
                var id=$(obj).attr('id');
                //通过ajax异步删除
                $.ajax({
                    url:"{pigcms{:U('Exam/text_del_news')}",
                    data:{'id':id},
                    type:'post',
                    success:function(delmsg){
                        if(delmsg==='1'){
                            //逻辑删除成功！
                            layer.msg('移除成功！', {icon: 6});
                            //同时刷新页面
                            window.location.reload();
                        }else{
                            //逻辑删除失败！
                            layer.msg('移除失败！', {icon: 5});
                        }
                    },
                    error:function (res) {
                        lay.msg(res);
                    }

                });
            }
        });

    }

</script>

<!--自定义js代码区结束-->
</body>

</html>