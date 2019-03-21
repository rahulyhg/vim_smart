<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

	<div class="page-content">
		<!-- BEGIN PAGE HEAD-->
		<div class="page-head">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Material Design Form Validation
					<small>material design form validation</small>
				</h1>
			</div>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PAGE TOOLBAR -->
			<!--<div class="page-toolbar">-->
			<!--&lt;!&ndash; BEGIN THEME PANEL &ndash;&gt;-->
			<!--<div class="btn-group btn-theme-panel">-->
			<!--<a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">-->
			<!--<i class="icon-settings"></i>-->
			<!--</a>-->
			<!--<div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">-->
			<!--<div class="row">-->
			<!--<div class="col-md-4 col-sm-4 col-xs-12">-->
			<!--<h3>HEADER</h3>-->
			<!--<ul class="theme-colors">-->
			<!--<li class="theme-color theme-color-default active" data-theme="default">-->
			<!--<span class="theme-color-view"></span>-->
			<!--<span class="theme-color-name">Dark Header</span>-->
			<!--</li>-->
			<!--<li class="theme-color theme-color-light " data-theme="light">-->
			<!--<span class="theme-color-view"></span>-->
			<!--<span class="theme-color-name">Light Header</span>-->
			<!--</li>-->
			<!--</ul>-->
			<!--</div>-->
			<!--<div class="col-md-8 col-sm-8 col-xs-12 seperator">-->
			<!--<h3>LAYOUT</h3>-->
			<!--<ul class="theme-settings">-->
			<!--<li> Theme Style-->
			<!--<select class="layout-style-option form-control input-small input-sm">-->
			<!--<option value="square">Square corners</option>-->
			<!--<option value="rounded" selected="selected">Rounded corners</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Layout-->
			<!--<select class="layout-option form-control input-small input-sm">-->
			<!--<option value="fluid" selected="selected">Fluid</option>-->
			<!--<option value="boxed">Boxed</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Header-->
			<!--<select class="page-header-option form-control input-small input-sm">-->
			<!--<option value="fixed" selected="selected">Fixed</option>-->
			<!--<option value="default">Default</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Top Dropdowns-->
			<!--<select class="page-header-top-dropdown-style-option form-control input-small input-sm">-->
			<!--<option value="light">Light</option>-->
			<!--<option value="dark" selected="selected">Dark</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Sidebar Mode-->
			<!--<select class="sidebar-option form-control input-small input-sm">-->
			<!--<option value="fixed">Fixed</option>-->
			<!--<option value="default" selected="selected">Default</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Sidebar Menu-->
			<!--<select class="sidebar-menu-option form-control input-small input-sm">-->
			<!--<option value="accordion" selected="selected">Accordion</option>-->
			<!--<option value="hover">Hover</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Sidebar Position-->
			<!--<select class="sidebar-pos-option form-control input-small input-sm">-->
			<!--<option value="left" selected="selected">Left</option>-->
			<!--<option value="right">Right</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Footer-->
			<!--<select class="page-footer-option form-control input-small input-sm">-->
			<!--<option value="fixed">Fixed</option>-->
			<!--<option value="default" selected="selected">Default</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--</ul>-->
			<!--</div>-->
			<!--</div>-->
			<!--</div>-->
			<!--</div>-->
			<!--&lt;!&ndash; END THEME PANEL &ndash;&gt;-->
			<!--</div>-->
			<!-- END PAGE TOOLBAR -->
		</div>
		<!-- END PAGE HEAD-->
		<!-- BEGIN PAGE BREADCRUMB -->
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="index.html">Home</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span class="active">Form Stuff</span>
			</li>
		</ul>
		<!-- END PAGE BREADCRUMB -->
		<!-- BEGIN PAGE BASE CONTENT -->
		<div class="row">
			<form action="{pigcms{:U('User/addlevel')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
				<input type="hidden" name="lid" value="{pigcms{$leveldata['id']}"/>
				<div class="col-md-12" style="float: left">
					<!-- BEGIN VALIDATION STATES-->
					<div class="portlet light portlet-fit portlet-form bordered">
						<div class="portlet-title">
							<div class="caption">
								<i class=" icon-layers font-green"></i>
								<span class="caption-subject font-green sbold uppercase">Basic Validation</span>
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
									<label class="col-md-2 control-label" for="form_control_1">等级名称
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="lname" value="{pigcms{$leveldata['lname']}"/>
										<div class="form-control-focus"> </div>
										<span class="help-block">例如：1=>VIP1,2=>VIP2 等</span>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">等级积分
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="integral" value="{pigcms{$leveldata['integral']}"/>
										<div class="form-control-focus"> </div>
										<span class="help-block">例如：1=>VIP1,2=>VIP2 等</span>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">等级级别
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										{pigcms{$leveldata['level']}&nbsp;&nbsp;&nbsp;
										<div class="form-control-focus"> </div>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">等级图标
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="hidden" name="icon" value="{pigcms{$leveldata['icon']}"/>
										<a href="javascript:void(0)" class="btn btn-sm btn-success J_selectImage">上传图片</a>

										<img src="{pigcms{$leveldata['icon']}" width="50px" <if condition="!empty($leveldata['icon'])"> style="margin-left: 30px;"<else/>style="margin-left: 30px;display:none;"</if> />
										<div class="form-control-focus"> </div>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">等级福利
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<select name="fltype">

											<option value="0">无</option>

											<option value="1" <if condition="$leveldata['type'] eq 1">selected="selected"</if>>百分比（%）</option>

											<option value="2" <if condition="$leveldata['type'] eq 2">selected="selected"</if>>立减</option>

										</select>
										&nbsp;&nbsp;&nbsp;
										<input type="text" class="form-control" placeholder="" id="hickey_control" name="boon" value="{pigcms{$leveldata['boon']}"/>
										<div class="form-control-focus"> </div>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">等级介绍
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<textarea id="description" name="description"  placeholder="写上一些等级介绍说明文字">{pigcms{$leveldata['description']|htmlspecialchars_decode=ENT_QUOTES}</textarea>
										<div class="form-control-focus"> </div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green">确认提交</button>
											<button type="reset" class="btn default">清空重填</button>
										</div>
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
<!-- END FOOTER -->
<!-- BEGIN QUICK NAV -->
<!--<nav class="quick-nav">-->
<!--<a class="quick-nav-trigger" href="#0">-->
<!--<span aria-hidden="true"></span>-->
<!--</a>-->
<!--<ul>-->
<!--<li>-->
<!--<a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank" class="active">-->
<!--<span>Purchase Metronic</span>-->
<!--<i class="icon-basket"></i>-->
<!--</a>-->
<!--</li>-->
<!--<li>-->
<!--<a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/reviews/4021469?ref=keenthemes" target="_blank">-->
<!--<span>Customer Reviews</span>-->
<!--<i class="icon-users"></i>-->
<!--</a>-->
<!--</li>-->
<!--<li>-->
<!--<a href="http://keenthemes.com/showcast/" target="_blank">-->
<!--<span>Showcase</span>-->
<!--<i class="icon-user"></i>-->
<!--</a>-->
<!--</li>-->
<!--<li>-->
<!--<a href="http://keenthemes.com/metronic-theme/changelog/" target="_blank">-->
<!--<span>Changelog</span>-->
<!--<i class="icon-graph"></i>-->
<!--</a>-->
<!--</li>-->
<!--</ul>-->
<!--<span aria-hidden="true" class="quick-nav-bg"></span>-->
<!--</nav>-->
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

<link rel="stylesheet" href="{pigcms{$static_public}js/artdialog/skins/mydialog.css?4.1.7">
<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./tpl/System/Static/js/index1.js"></script>
<script>
	(function(E,C,D,A){var B,$,_,J="@ARTDIALOG.DATA",K="@ARTDIALOG.OPEN",H="@ARTDIALOG.OPENER",I=C.name=C.name||"@ARTDIALOG.WINNAME"+(new Date).getTime(),F=C.VBArray&&!C.XMLHttpRequest;E(function(){!C.jQuery&&document.compatMode==="BackCompat"&&alert("artDialog Error: document.compatMode === \"BackCompat\"")});var G=D.top=function(){var _=C,$=function(A){try{var _=C[A].document;_.getElementsByTagName}catch($){return!1}return C[A].artDialog&&_.getElementsByTagName("frameset").length===0};return $("top")?_=C.top:$("parent")&&(_=C.parent),_}();D.parent=G,B=G.artDialog,_=function(){return B.defaults.zIndex},D.data=function(B,A){var $=D.top,_=$[J]||{};$[J]=_;if(A)_[B]=A;else return _[B];return _},D.removeData=function(_){var $=D.top[J];$&&$[_]&&delete $[_]},D.through=$=function(){var $=B.apply(this,arguments);return G!==C&&(D.list[$.config.id]=$),$},G!==C&&E(C).bind("unload",function(){var A=D.list,_;for(var $ in A)A[$]&&(_=A[$].config,_&&(_.duration=0),A[$].close(),delete A[$])}),D.open=function(B,P,O){P=P||{};var N,L,M,X,W,V,U,T,S,R=D.top,Q="position:absolute;left:-9999em;top:-9999em;border:none 0;background:transparent",a="width:100%;height:100%;border:none 0";if(O===!1){var Z=(new Date).getTime(),Y=B.replace(/([?&])_=[^&]*/,"$1_="+Z);B=Y+(Y===B?(/\?/.test(B)?"&":"?")+"_="+Z:"")}var G=function(){var B,C,_=L.content.find(".aui_loading"),A=N.config;M.addClass("aui_state_full"),_&&_.hide();try{T=W.contentWindow,U=E(T.document),S=T.document.body}catch($){W.style.cssText=a,A.follow?N.follow(A.follow):N.position(A.left,A.top),P.init&&P.init.call(N,T,R),P.init=null;return}B=A.width==="auto"?U.width()+(F?0:parseInt(E(S).css("marginLeft"))):A.width,C=A.height==="auto"?U.height():A.height,setTimeout(function(){W.style.cssText=a},0),N.size(B,C),A.follow?N.follow(A.follow):N.position(A.left,A.top),P.init&&P.init.call(N,T,R),P.init=null},I={zIndex:_(),init:function(){N=this,L=N.DOM,X=L.main,M=L.content,W=N.iframe=R.document.createElement("iframe"),W.src=B,W.name="Open"+N.config.id,W.style.cssText=Q,W.setAttribute("frameborder",0,0),W.setAttribute("allowTransparency",!0),V=E(W),N.content().appendChild(W),T=W.contentWindow;try{T.name=W.name,D.data(W.name+K,N),D.data(W.name+H,C)}catch($){}V.bind("load",G)},close:function(){V.css("display","none").unbind("load",G);if(P.close&&P.close.call(this,W.contentWindow,R)===!1)return!1;M.removeClass("aui_state_full"),V[0].src="about:blank",V.remove();try{D.removeData(W.name+K),D.removeData(W.name+H)}catch($){}}};typeof P.ok=="function"&&(I.ok=function(){return P.ok.call(N,W.contentWindow,R)}),typeof P.cancel=="function"&&(I.cancel=function(){return P.cancel.call(N,W.contentWindow,R)}),delete P.content;for(var J in P)I[J]===A&&(I[J]=P[J]);return $(I)},D.open.api=D.data(I+K),D.opener=D.data(I+H)||C,D.open.origin=D.opener,D.close=function(){var $=D.data(I+K);return $&&$.close(),!1},G!=C&&E(document).bind("mousedown",function(){var $=D.open.api;$&&$.focus(!0)}),D.load=function(C,D,B){B=B||!1;var G=D||{},H={zIndex:_(),init:function(A){var _=this,$=_.config;E.ajax({url:C,success:function($){_.content($),G.init&&G.init.call(_,A)},cache:B})}};delete D.content;for(var F in G)H[F]===A&&(H[F]=G[F]);return $(H)},D.alert=function(A){return $({id:"Alert",zIndex:_(),icon:"warning",fixed:!0,lock:!0,content:A,ok:!0})},D.confirm=function(C,A,B){return $({id:"Confirm",zIndex:_(),icon:"question",fixed:!0,lock:!0,opacity:0.1,content:C,ok:function($){return A.call(this,$)},cancel:function($){return B&&B.call(this,$)}})},D.prompt=function(D,B,C){C=C||"";var A;return $({id:"Prompt",zIndex:_(),icon:"question",fixed:!0,lock:!0,opacity:0.1,content:["<div style=\"margin-bottom:5px;font-size:12px\">",D,"</div>","<div>","<input value=\"",C,"\" style=\"width:18em;padding:6px 4px\" />","</div>"].join(""),init:function(){A=this.DOM.content.find("input")[0],A.select(),A.focus()},ok:function($){return B&&B.call(this,A.value,$)},cancel:!0})},D.tips=function(B,A){return $({id:"Tips",zIndex:_(),title:!1,cancel:!1,fixed:!0,lock:!1}).content("<div style=\"padding: 0 1em;\">"+B+"</div>").time(A||1.5)},E(function(){var A=D.dragEvent;if(!A)return;var B=E(C),$=E(document),_=F?"absolute":"fixed",H=A.prototype,I=document.createElement("div"),G=I.style;G.cssText="display:none;position:"+_+";left:0;top:0;width:100%;height:100%;"+"cursor:move;filter:alpha(opacity=0);opacity:0;background:#FFF",document.body.appendChild(I),H._start=H.start,H._end=H.end,H.start=function(){var E=D.focus.DOM,C=E.main[0],A=E.content[0].getElementsByTagName("iframe")[0];H._start.apply(this,arguments),G.display="block",G.zIndex=D.defaults.zIndex+3,_==="absolute"&&(G.width=B.width()+"px",G.height=B.height()+"px",G.left=$.scrollLeft()+"px",G.top=$.scrollTop()+"px"),A&&C.offsetWidth*C.offsetHeight>307200&&(C.style.visibility="hidden")},H.end=function(){var $=D.focus;H._end.apply(this,arguments),G.display="none",$&&($.DOM.main[0].style.visibility="visible")}})})(window.jQuery||window.art,this,this.artDialog)
</script>
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
<link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">

<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>

<script src="{pigcms{$static_public}kindeditor/lang/zh_CN.js"></script>

<script type="text/javascript">



	KindEditor.ready(function(K){

		var editor = K.editor({

			allowFileManager : true

		});

		//var islock=false;

		K('.J_selectImage').click(function(){

			var obj=$(this);

			editor.uploadJson = "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=system/image";

			editor.loadPlugin('image', function(){

				editor.plugin.imageDialog({

					showRemote : false,

					imageUrl : K('#course_pic').val(),

					clickFn : function(url, title, width, height, border, align) {

						obj.siblings('input').val(url);

						editor.hideDialog();

						obj.siblings('img').attr('src',url).show();

						//window.location.reload();

					}

				});

			});



		});



		kind_editor = K.create("#description",{

			width:'480px',

			height:'380px',

			minWidth:'480px',

			resizeType : 1,

			allowPreviewEmoticons:false,

			allowImageUpload : true,

			filterMode: true,

			items : [

				'source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',

				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',

				'insertunorderedlist', '|', 'emoticons', 'image', 'link'

			],

			emoticonsPath : './static/emoticons/',

			uploadJson : "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=system/image"

		});

	});

</script>
<!--引入日历jquery插件开始-->
<!--
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.js" type="text/javascript"></script>
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.min.js" type="text/javascript"></script>-->

<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<!--引入日历jquery插件结束-->

<script type='text/javascript'>
	//开启日历插件
	$(function(){
		var index_terrace = $("#terrace_name").find("option:selected").text();

		if(index_terrace == 'Yeelink'){

			$("*[name='yeelink']").show();
		}else if(index_terrace == '友联unios'){

			$("*[name='unios']").show();
		}
		$("#terrace_name").change(function(){
			var terrace_name = $(this).find("option:selected").text();
			alert(terrace_name);
			if(terrace_name == 'Yeelink'){
				$("*[name='unios']").hide();
				$("*[name='yeelink']").hide();
				$("*[name='yeelink']").show();
			}else if(terrace_name == '友联unios'){
				$("*[name='unios']").hide();
				$("*[name='yeelink']").hide();
				$("*[name='unios']").show();
			}
		});
	});
	function villageCate(obj){
		//alert(obj.value);
		$.ajax({
			'url':"{pigcms{:U('Access/access_edit',array('isajax'=>1))}",
			'data':{'village_id':obj.value},
			'type':'POST',
			'dataType':'JSON',
			'success':function(msg){
				if(msg.err_code==0){
					//alert(msg.code_data);
					$('#access_cate').text('');
					var options='';
					for(var i=0;i<msg.code_data.length;i++){
						options+="<option value="+msg.code_data[i].ag_id+">"+msg.code_data[i].ag_name+"</option>";
					}
					//alert(options);
					var access_data='';
					access_data+='<label class="col-md-3 control-label" for="form_control_1">所属区域<span class="required">*</span></label>';
					access_data+='<div class="col-md-9"><select name="ag_id" id="pid" class="form-control"><option selected="selected" value="0">请选择区域</option>'+options+'</select></div><div class="form-control-focus"></div></div>';
					$('#access_cate').append(access_data);
				}else{
					window.location.reload();
				}
			},
			'error':function(){
				alert('loading error');
			}
		})
	}
	$('#datetimepicker').datetimepicker({
		lang:"ch",           //语言选择中文
		format:"Y-m-d H:i:s",      //格式化日期
		timepicker:false,    //关闭时间选项
		yearStart:2000,     //设置最小年份
		yearEnd:2050,        //设置最大年份
		todayButton:false    //关闭选择今天按钮
	});
	$('#datetimepicker2').datetimepicker({
		lang:"ch",           //语言选择中文
		format:"Y-m-d H:i:s",      //格式化日期
		timepicker:false,    //关闭时间选项
		yearStart:2000,     //设置最小年份
		yearEnd:2050,        //设置最大年份
		todayButton:false    //关闭选择今天按钮
	});

</script>
</body>

</html>