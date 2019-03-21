<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>添加关键词回复
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="index.html">微信设置</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="index.html">关键词回复</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="index.html">添加关键词回复</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
        <div class="row">
            <form action="{pigcms{:U('Home/other_add_new')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <div class="col-md-12" style="float: left">
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">添加关键词回复</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-cloud-upload"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-wrench"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-trash"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->

                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> 您填写的信息可能存在问题，请再检查 </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> 添加成功，请查看记录列表 </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">关键词
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="key" id="cat_url" value="{pigcms{$info.key}"/>
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">使用相同的关键词可以实现多图文</span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">回复标题
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="title" id="cat_url" value="{pigcms{$info.title}"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">文章简介
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea rows="6" cols="163" name="info">{pigcms{$info.info}</textarea>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">回复内容
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea rows="6" cols="163" name="content" id="content">{pigcms{$info.content}</textarea>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">外链接url
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="input-text" name="url" id="url" style="width:200px;" placeholder="外链接url" validate="maxlength:200,url:true" value="{pigcms{$info.url}"/>
                                        <a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('url',0)" data-toggle="modal">从功能库选择</a>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">回复图片
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="file" class="input-text" name="pic" id="pic" value="{pigcms{$info.p}"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <if condition="$info['pic']">

                                    <tr>

                                        <th width="160"></th>

                                        <td><img src="{pigcms{$info.pic}" width="280" height="180"></td>

                                    </tr>

                                </if>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">第三方接口url
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="input-text" name="api_url" id="api_url" style="width:200px;" placeholder="第三方接口url" value="{pigcms{$info.api_url}"/>
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">填写了该URL，我们会把微信发过来的数据原样的post给该接口，交给该接口处理</span>

                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-9">
                                        <button type="submit" class="btn green">确认提交</button>
                                        <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Home&a=other_news'">返 回</button>
                                    </div>
                                </div>
                            </div>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </form>
        </div>

    </div>
</div>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer" style="text-align: center">
    <div class="page-footer-inner" style="width: 100%"> 2017 &copy; 汇得行智慧助手系统
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
<script src="/Car/Admin/Public/js/jquery.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!--表单提交检查js-->
<!--<script src="{$Think.config.ADMIN_ASSETS_URL}pages/scripts/form-validation-md.min.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--引入百度文件上传JS开始-->
<script src="/Car/Admin/Public/js/baiduwebuploader/webuploader.js" type="text/javascript"></script>
<!--引入百度文件上传JS结束-->

<!--引入日历jquery插件开始-->
<!--
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.js" type="text/javascript"></script>
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.min.js" type="text/javascript"></script>-->

<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<link rel="stylesheet" href="{pigcms{$static_public}js/artdialog/skins/mydialog.css?4.1.7">
<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./tpl/System/Static/js/index1.js"></script>
<script>
    (function(E,C,D,A){var B,$,_,J="@ARTDIALOG.DATA",K="@ARTDIALOG.OPEN",H="@ARTDIALOG.OPENER",I=C.name=C.name||"@ARTDIALOG.WINNAME"+(new Date).getTime(),F=C.VBArray&&!C.XMLHttpRequest;E(function(){!C.jQuery&&document.compatMode==="BackCompat"&&alert("artDialog Error: document.compatMode === \"BackCompat\"")});var G=D.top=function(){var _=C,$=function(A){try{var _=C[A].document;_.getElementsByTagName}catch($){return!1}return C[A].artDialog&&_.getElementsByTagName("frameset").length===0};return $("top")?_=C.top:$("parent")&&(_=C.parent),_}();D.parent=G,B=G.artDialog,_=function(){return B.defaults.zIndex},D.data=function(B,A){var $=D.top,_=$[J]||{};$[J]=_;if(A)_[B]=A;else return _[B];return _},D.removeData=function(_){var $=D.top[J];$&&$[_]&&delete $[_]},D.through=$=function(){var $=B.apply(this,arguments);return G!==C&&(D.list[$.config.id]=$),$},G!==C&&E(C).bind("unload",function(){var A=D.list,_;for(var $ in A)A[$]&&(_=A[$].config,_&&(_.duration=0),A[$].close(),delete A[$])}),D.open=function(B,P,O){P=P||{};var N,L,M,X,W,V,U,T,S,R=D.top,Q="position:absolute;left:-9999em;top:-9999em;border:none 0;background:transparent",a="width:100%;height:100%;border:none 0";if(O===!1){var Z=(new Date).getTime(),Y=B.replace(/([?&])_=[^&]*/,"$1_="+Z);B=Y+(Y===B?(/\?/.test(B)?"&":"?")+"_="+Z:"")}var G=function(){var B,C,_=L.content.find(".aui_loading"),A=N.config;M.addClass("aui_state_full"),_&&_.hide();try{T=W.contentWindow,U=E(T.document),S=T.document.body}catch($){W.style.cssText=a,A.follow?N.follow(A.follow):N.position(A.left,A.top),P.init&&P.init.call(N,T,R),P.init=null;return}B=A.width==="auto"?U.width()+(F?0:parseInt(E(S).css("marginLeft"))):A.width,C=A.height==="auto"?U.height():A.height,setTimeout(function(){W.style.cssText=a},0),N.size(B,C),A.follow?N.follow(A.follow):N.position(A.left,A.top),P.init&&P.init.call(N,T,R),P.init=null},I={zIndex:_(),init:function(){N=this,L=N.DOM,X=L.main,M=L.content,W=N.iframe=R.document.createElement("iframe"),W.src=B,W.name="Open"+N.config.id,W.style.cssText=Q,W.setAttribute("frameborder",0,0),W.setAttribute("allowTransparency",!0),V=E(W),N.content().appendChild(W),T=W.contentWindow;try{T.name=W.name,D.data(W.name+K,N),D.data(W.name+H,C)}catch($){}V.bind("load",G)},close:function(){V.css("display","none").unbind("load",G);if(P.close&&P.close.call(this,W.contentWindow,R)===!1)return!1;M.removeClass("aui_state_full"),V[0].src="about:blank",V.remove();try{D.removeData(W.name+K),D.removeData(W.name+H)}catch($){}}};typeof P.ok=="function"&&(I.ok=function(){return P.ok.call(N,W.contentWindow,R)}),typeof P.cancel=="function"&&(I.cancel=function(){return P.cancel.call(N,W.contentWindow,R)}),delete P.content;for(var J in P)I[J]===A&&(I[J]=P[J]);return $(I)},D.open.api=D.data(I+K),D.opener=D.data(I+H)||C,D.open.origin=D.opener,D.close=function(){var $=D.data(I+K);return $&&$.close(),!1},G!=C&&E(document).bind("mousedown",function(){var $=D.open.api;$&&$.focus(!0)}),D.load=function(C,D,B){B=B||!1;var G=D||{},H={zIndex:_(),init:function(A){var _=this,$=_.config;E.ajax({url:C,success:function($){_.content($),G.init&&G.init.call(_,A)},cache:B})}};delete D.content;for(var F in G)H[F]===A&&(H[F]=G[F]);return $(H)},D.alert=function(A){return $({id:"Alert",zIndex:_(),icon:"warning",fixed:!0,lock:!0,content:A,ok:!0})},D.confirm=function(C,A,B){return $({id:"Confirm",zIndex:_(),icon:"question",fixed:!0,lock:!0,opacity:0.1,content:C,ok:function($){return A.call(this,$)},cancel:function($){return B&&B.call(this,$)}})},D.prompt=function(D,B,C){C=C||"";var A;return $({id:"Prompt",zIndex:_(),icon:"question",fixed:!0,lock:!0,opacity:0.1,content:["<div style=\"margin-bottom:5px;font-size:12px\">",D,"</div>","<div>","<input value=\"",C,"\" style=\"width:18em;padding:6px 4px\" />","</div>"].join(""),init:function(){A=this.DOM.content.find("input")[0],A.select(),A.focus()},ok:function($){return B&&B.call(this,A.value,$)},cancel:!0})},D.tips=function(B,A){return $({id:"Tips",zIndex:_(),title:!1,cancel:!1,fixed:!0,lock:!1}).content("<div style=\"padding: 0 1em;\">"+B+"</div>").time(A||1.5)},E(function(){var A=D.dragEvent;if(!A)return;var B=E(C),$=E(document),_=F?"absolute":"fixed",H=A.prototype,I=document.createElement("div"),G=I.style;G.cssText="display:none;position:"+_+";left:0;top:0;width:100%;height:100%;"+"cursor:move;filter:alpha(opacity=0);opacity:0;background:#FFF",document.body.appendChild(I),H._start=H.start,H._end=H.end,H.start=function(){var E=D.focus.DOM,C=E.main[0],A=E.content[0].getElementsByTagName("iframe")[0];H._start.apply(this,arguments),G.display="block",G.zIndex=D.defaults.zIndex+3,_==="absolute"&&(G.width=B.width()+"px",G.height=B.height()+"px",G.left=$.scrollLeft()+"px",G.top=$.scrollTop()+"px"),A&&C.offsetWidth*C.offsetHeight>307200&&(C.style.visibility="hidden")},H.end=function(){var $=D.focus;H._end.apply(this,arguments),G.display="none",$&&($.DOM.main[0].style.visibility="visible")}})})(window.jQuery||window.art,this,this.artDialog)
</script>
<script src="./tpl/System/Static/js/common.js"></script>
<!--引入日历jquery插件结束-->

<script type='text/javascript'>
    function addLink(domid,iskeyword){

        art.dialog.data('domid', domid);

        art.dialog.open('?g=Admin&c=Link&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});

    }

</script>
</body>

</html>