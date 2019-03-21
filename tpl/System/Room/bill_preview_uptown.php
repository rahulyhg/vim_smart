<style type="text/css">
    <!--
    .btn.red:not(.btn-outline) {
        color: #fff;
        background-color: #659be0;
        border-color: #659be0;
    }
    -->
</style><extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <!--<a href="{pigcms{:U('tenantlist_news')}">
            <button id="sample_editable_1_new" class="btn sbold green">返回
            </button>
        </a>-->
        <a href="javascript:">
            <button  class="btn sbold green" onclick="sub()">批量出账
            </button>
        </a>
        <a href="{pigcms{:U('import_other_price_uptown')}">
            <button  class="btn sbold green">批量导入其它杂费
            </button>
        </a>
    </div>
    <br/>
    <br/>
    <!--<div class="btn-group btn-group-solid">
        <a href="{pigcms{:U('bill_preview',array('ym'=>date('Y').'-01'))}" class="btn <?php /*if($_GET['ym']==date('Y').'-01'){echo "blue btn-outline";}elseif ($_GET['ym'] ==''&&date('m')=='01'){echo "blue btn-outline";}else{echo "blue";}*/?>">1月</a>
        <a href="{pigcms{:U('bill_preview',array('ym'=>date('Y').'-02'))}" class="btn <?php /*if($_GET['ym']==date('Y').'-02'){echo "blue btn-outline";}elseif ($_GET['ym'] ==''&&date('m')=='02'){echo "blue btn-outline";}else{echo "blue";}*/?>">2月</a>
        <a href="{pigcms{:U('bill_preview',array('ym'=>date('Y').'-03'))}" class="btn <?php /*if($_GET['ym']==date('Y').'-03'){echo "blue btn-outline";}elseif ($_GET['ym'] ==''&&date('m')=='03'){echo "blue btn-outline";}else{echo "blue";}*/?>">3月</a>
        <a href="{pigcms{:U('bill_preview',array('ym'=>date('Y').'-04'))}" class="btn <?php /*if($_GET['ym']==date('Y').'-04'){echo "blue btn-outline";}elseif ($_GET['ym'] ==''&&date('m')=='04'){echo "blue btn-outline";}else{echo "blue";}*/?>">4月</a>
        <a href="{pigcms{:U('bill_preview',array('ym'=>date('Y').'-05'))}" class="btn <?php /*if($_GET['ym']==date('Y').'-05'){echo "blue btn-outline";}elseif ($_GET['ym'] ==''&&date('m')=='05'){echo "blue btn-outline";}else{echo "blue";}*/?>">5月</a>
        <a href="{pigcms{:U('bill_preview',array('ym'=>date('Y').'-06'))}" class="btn <?php /*if($_GET['ym']==date('Y').'-06'){echo "blue btn-outline";}elseif ($_GET['ym'] ==''&&date('m')=='06'){echo "blue btn-outline";}else{echo "blue";}*/?>">6月</a>
        <a href="{pigcms{:U('bill_preview',array('ym'=>date('Y').'-07'))}" class="btn <?php /*if($_GET['ym']==date('Y').'-07'){echo "blue btn-outline";}elseif ($_GET['ym'] ==''&&date('m')=='07'){echo "blue btn-outline";}else{echo "blue";}*/?>">7月</a>
        <a href="{pigcms{:U('bill_preview',array('ym'=>date('Y').'-08'))}" class="btn <?php /*if($_GET['ym']==date('Y').'-08'){echo "blue btn-outline";}elseif ($_GET['ym'] ==''&&date('m')=='08'){echo "blue btn-outline";}else{echo "blue";}*/?>">8月</a>
        <a href="{pigcms{:U('bill_preview',array('ym'=>date('Y').'-09'))}" class="btn <?php /*if($_GET['ym']==date('Y').'-09'){echo "blue btn-outline";}elseif ($_GET['ym'] ==''&&date('m')=='09'){echo "blue btn-outline";}else{echo "blue";}*/?>">9月</a>
        <a href="{pigcms{:U('bill_preview',array('ym'=>date('Y').'-10'))}" class="btn <?php /*if($_GET['ym']==date('Y').'-10'){echo "blue btn-outline";}elseif ($_GET['ym'] ==''&&date('m')=='10'){echo "blue btn-outline";}else{echo "blue";}*/?>">10月</a>
        <a href="{pigcms{:U('bill_preview',array('ym'=>date('Y').'-11'))}" class="btn <?php /*if($_GET['ym']==date('Y').'-11'){echo "blue btn-outline";}elseif ($_GET['ym'] ==''&&date('m')=='11'){echo "blue btn-outline";}else{echo "blue";}*/?>">11月</a>
        <a href="{pigcms{:U('bill_preview',array('ym'=>date('Y').'-12'))}" class="btn <?php /*if($_GET['ym']==date('Y').'-12'){echo "blue btn-outline";}elseif ($_GET['ym'] ==''&&date('m')=='12'){echo "blue btn-outline";}else{echo "blue";}*/?>">12月</a>
    </div>-->
    <div class="btn-group">
        <input type="month" name="choose_time" value="<php>echo $_GET['ym']?:date('Y-m')</php>"/>
    </div>
</block>

<block name="body">
    <table class="table table-striped table-bordered table-hover" id="sample_1">
        <thead>
        <!--        入驻状态	入驻单位	业主	总面积	缴费状态	操作-->
        <tr>
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th>门牌号</th>
            <th>所属园区</th>
            <th>业主</th>
            <th>水费</th>
            <th>电费</th>
            <th>燃气费</th>
            <th>泊位费</th>
            <th>物业费</th>
            <th>其它</th>
            <th>总金额</th>
            <th>账单状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="list" id="vo">
                <tr style="background-color: #ffffff">
                    <if condition="$vo['pay']['is_enter_list'] eq '1'">
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes" value="" onclick="nono(this)" />
                                <span></span>
                            </label>
                        </td>
                        <else />
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes" value="{pigcms{$vo.id}" />
                                <span></span>
                            </label>
                        </td>
                    </if>
                    <td>
                        <!--/排序需要-->
                        <span style="color:#FBFCFD;text-overflow:ellipsis;display:block;width:0px;height:0">
                            {pigcms{:sprintf("%04d",$vo['room_names_format']?:9999)}
                        </span>
                        <!--排序需要-->
                        {pigcms{$vo.room_name}
                    </td>
                    <td>{pigcms{$vo.project_desc}</td>
                    <td>
                        <volist name="vo['oid_list']" id="vo1">
                            {pigcms{$vo1.name}  {pigcms{$vo1.phone}<br>
                        </volist>
                    </td>
                    <td>
                        {pigcms{$vo.pay.use_water}
                    </td>
                    <td>
                        {pigcms{$vo.pay.use_electric}
                    </td>
                    <td>
                        {pigcms{$vo.pay.use_gas}
                    </td>
                    <td>
                        {pigcms{$vo.pay.use_park}
                    </td>
                    <td>
                        {pigcms{$vo.pay.use_property}
                    </td>
                    <td>
                        <volist name="vo['pay']['use_other']" id="vo1">
                            {pigcms{$key} :{pigcms{$vo1}元<br>
                        </volist>
                    </td>
                    <td>
                        {pigcms{$vo.pay.use_total}
                    </td>
                    <td>
                        <if condition=" $vo['pay']['is_enter_list'] eq '0' or $vo['pay']['is_enter_list'] eq '' ">
                            <a data-toggle="modal" data-target="#common_modal"
                               href="{pigcms{:U('modal_pay_list_uptown',array('rid'=>$vo['id'],'ym'=>$_GET['ym']))}">
                                <button type="button" class="btn green btn-sm">
                                    未确认出账
                                </button>
                            </a>
                            <elseif condition="$vo['pay']['is_create'] eq '0' and $vo['pay']['is_enter_list'] eq '1'"/>
                            <a data-toggle="modal" data-target="#common_modal"
                               href="{pigcms{:U('look_list_uptown',array('rid'=>$vo['id'],'ym'=>$ym))}">
                                <button type="button" class="btn blue btn-sm">
                                    已出账
                                </button>
                            </a>
                            <elseif condition="$vo['pay']['is_create'] eq '1' and $vo['pay']['is_enter_list'] eq '1'"/>
                            <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('look_list_uptown',array('rid'=>$vo['id'],'ym'=>$ym))}">
                                <button type="button" class="btn blue btn-sm">
                                    已经完全缴费
                                </button>
                            </a>
                        </if>

                    </td>
                    <td class="button-column">
                        <div class="btn-group">
                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false"> 操作
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-left" role="menu" style="position: absolute;">
                                <if condition="$vo['pay']['is_enter_list'] eq '0' or $vo['pay']['is_enter_list'] eq '' ">
                                    <li>
                                        <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('modal_pay_list_uptown',array('rid'=>$vo['id'],'ym'=>$_GET['ym']))}">
                                            <i class="icon-docs"></i> 出账
                                        </a>
                                    </li>
                                    <elseif condition=" $vo['pay']['is_enter_list'] eq '1'"/>
                                    <li>
                                        <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('look_list_uptown',array('rid'=>$vo['id'],'ym'=>$ym))}">
                                            <i class="icon-docs"></i> 查看详情
                                        </a>
                                    </li>

                                </if>
                            </ul>
                        </div>

                    </td>
                </tr>

        </volist>
        </tbody>
    </table>
</block>
<block name="script">
    <!--弹出层必要css,js-->
    <!--    <link rel="stylesheet" href="{pigcms{$static_public}js/artdialog/skins/mydialog.css?4.1.7">-->
    <!--    <script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>-->
    <!--    <script type="text/javascript" src="./tpl/System/Static/js/index1.js"></script>-->
    <!--    <script>-->
    <!--        (function(E,C,D,A){var B,$,_,J="@ARTDIALOG.DATA",K="@ARTDIALOG.OPEN",H="@ARTDIALOG.OPENER",I=C.name=C.name||"@ARTDIALOG.WINNAME"+(new Date).getTime(),F=C.VBArray&&!C.XMLHttpRequest;E(function(){!C.jQuery&&document.compatMode==="BackCompat"&&alert("artDialog Error: document.compatMode === \"BackCompat\"")});var G=D.top=function(){var _=C,$=function(A){try{var _=C[A].document;_.getElementsByTagName}catch($){return!1}return C[A].artDialog&&_.getElementsByTagName("frameset").length===0};return $("top")?_=C.top:$("parent")&&(_=C.parent),_}();D.parent=G,B=G.artDialog,_=function(){return B.defaults.zIndex},D.data=function(B,A){var $=D.top,_=$[J]||{};$[J]=_;if(A)_[B]=A;else return _[B];return _},D.removeData=function(_){var $=D.top[J];$&&$[_]&&delete $[_]},D.through=$=function(){var $=B.apply(this,arguments);return G!==C&&(D.list[$.config.id]=$),$},G!==C&&E(C).bind("unload",function(){var A=D.list,_;for(var $ in A)A[$]&&(_=A[$].config,_&&(_.duration=0),A[$].close(),delete A[$])}),D.open=function(B,P,O){P=P||{};var N,L,M,X,W,V,U,T,S,R=D.top,Q="position:absolute;left:-9999em;top:-9999em;border:none 0;background:transparent",a="width:100%;height:100%;border:none 0";if(O===!1){var Z=(new Date).getTime(),Y=B.replace(/([?&])_=[^&]*/,"$1_="+Z);B=Y+(Y===B?(/\?/.test(B)?"&":"?")+"_="+Z:"")}var G=function(){var B,C,_=L.content.find(".aui_loading"),A=N.config;M.addClass("aui_state_full"),_&&_.hide();try{T=W.contentWindow,U=E(T.document),S=T.document.body}catch($){W.style.cssText=a,A.follow?N.follow(A.follow):N.position(A.left,A.top),P.init&&P.init.call(N,T,R),P.init=null;return}B=A.width==="auto"?U.width()+(F?0:parseInt(E(S).css("marginLeft"))):A.width,C=A.height==="auto"?U.height():A.height,setTimeout(function(){W.style.cssText=a},0),N.size(B,C),A.follow?N.follow(A.follow):N.position(A.left,A.top),P.init&&P.init.call(N,T,R),P.init=null},I={zIndex:_(),init:function(){N=this,L=N.DOM,X=L.main,M=L.content,W=N.iframe=R.document.createElement("iframe"),W.src=B,W.name="Open"+N.config.id,W.style.cssText=Q,W.setAttribute("frameborder",0,0),W.setAttribute("allowTransparency",!0),V=E(W),N.content().appendChild(W),T=W.contentWindow;try{T.name=W.name,D.data(W.name+K,N),D.data(W.name+H,C)}catch($){}V.bind("load",G)},close:function(){V.css("display","none").unbind("load",G);if(P.close&&P.close.call(this,W.contentWindow,R)===!1)return!1;M.removeClass("aui_state_full"),V[0].src="about:blank",V.remove();try{D.removeData(W.name+K),D.removeData(W.name+H)}catch($){}}};typeof P.ok=="function"&&(I.ok=function(){return P.ok.call(N,W.contentWindow,R)}),typeof P.cancel=="function"&&(I.cancel=function(){return P.cancel.call(N,W.contentWindow,R)}),delete P.content;for(var J in P)I[J]===A&&(I[J]=P[J]);return $(I)},D.open.api=D.data(I+K),D.opener=D.data(I+H)||C,D.open.origin=D.opener,D.close=function(){var $=D.data(I+K);return $&&$.close(),!1},G!=C&&E(document).bind("mousedown",function(){var $=D.open.api;$&&$.focus(!0)}),D.load=function(C,D,B){B=B||!1;var G=D||{},H={zIndex:_(),init:function(A){var _=this,$=_.config;E.ajax({url:C,success:function($){_.content($),G.init&&G.init.call(_,A)},cache:B})}};delete D.content;for(var F in G)H[F]===A&&(H[F]=G[F]);return $(H)},D.alert=function(A){return $({id:"Alert",zIndex:_(),icon:"warning",fixed:!0,lock:!0,content:A,ok:!0})},D.confirm=function(C,A,B){return $({id:"Confirm",zIndex:_(),icon:"question",fixed:!0,lock:!0,opacity:0.1,content:C,ok:function($){return A.call(this,$)},cancel:function($){return B&&B.call(this,$)}})},D.prompt=function(D,B,C){C=C||"";var A;return $({id:"Prompt",zIndex:_(),icon:"question",fixed:!0,lock:!0,opacity:0.1,content:["<div style=\"margin-bottom:5px;font-size:12px\">",D,"</div>","<div>","<input value=\"",C,"\" style=\"width:18em;padding:6px 4px\" />","</div>"].join(""),init:function(){A=this.DOM.content.find("input")[0],A.select(),A.focus()},ok:function($){return B&&B.call(this,A.value,$)},cancel:!0})},D.tips=function(B,A){return $({id:"Tips",zIndex:_(),title:!1,cancel:!1,fixed:!0,lock:!1}).content("<div style=\"padding: 0 1em;\">"+B+"</div>").time(A||1.5)},E(function(){var A=D.dragEvent;if(!A)return;var B=E(C),$=E(document),_=F?"absolute":"fixed",H=A.prototype,I=document.createElement("div"),G=I.style;G.cssText="display:none;position:"+_+";left:0;top:0;width:100%;height:100%;"+"cursor:move;filter:alpha(opacity=0);opacity:0;background:#FFF",document.body.appendChild(I),H._start=H.start,H._end=H.end,H.start=function(){var E=D.focus.DOM,C=E.main[0],A=E.content[0].getElementsByTagName("iframe")[0];H._start.apply(this,arguments),G.display="block",G.zIndex=D.defaults.zIndex+3,_==="absolute"&&(G.width=B.width()+"px",G.height=B.height()+"px",G.left=$.scrollLeft()+"px",G.top=$.scrollTop()+"px"),A&&C.offsetWidth*C.offsetHeight>307200&&(C.style.visibility="hidden")},H.end=function(){var $=D.focus;H._end.apply(this,arguments),G.display="none",$&&($.DOM.main[0].style.visibility="visible")}})})(window.jQuery||window.art,this,this.artDialog)-->
    <!--    </script>-->

    <script src="./tpl/System/Static/js/common1.js"></script>
    <script>
        $("input[name='choose_time']").change(function(){
            var ym = $("input[name='choose_time']").val();
            window.location.href='/admin.php?g=System&c=Room&a=bill_preview_uptown&ym='+ym;
        });

        function sub() {
            var ids = '';
            var ym = $("input[name='choose_time']").val();
            // alert(ym);
            $(".checkboxes").each(function() {
                if ($(this).is(':checked') && $(this).val() != '') {
                    ids += ',' + $(this).val(); //逐个获取id
                }
            });
            ids = ids.substring(1);
            if (ids.length == 0) {
                alert('请选择要添加的选项');
            } else {
                if(confirm( '你确定批量出账吗？')) {
                    var url = "{pigcms{:U('hydropower_account_do_uptown')}";
                    //用post方式传递
                    openPostWindow(url,ids,ym);
                    // window.location.href = "{pigcms{:U('PropertyService/hydropower_account_do')}" + "&ids=" + ids + "&ym=" + ym;
                }
            }
        }

        function openPostWindow(url,idStr,yms){

            var tempForm = document.createElement("form");
            tempForm.id = "tempForm1";
            tempForm.method = "post";
            tempForm.action = url;
            tempForm.target="_blank"; //打开新页面
            var hideInput1 = document.createElement("input");
            hideInput1.type = "hidden";
            hideInput1.name="ids"; //后台要接受这个参数来取值
            hideInput1.value = idStr; //后台实际取到的值
            var hideInput2 = document.createElement("input");
            hideInput2.type = "hidden";
            hideInput2.name="ym";
            hideInput2.value = yms;
            tempForm.appendChild(hideInput1);
            tempForm.appendChild(hideInput2);
            if(document.all){
                tempForm.attachEvent("onsubmit",function(){});        //IE
            }else{
                var subObj = tempForm.addEventListener("submit",function(){},false);    //firefox
            }
            document.body.appendChild(tempForm);
            if(document.all){
                tempForm.fireEvent("onsubmit");
            }else{
                tempForm.dispatchEvent(new Event("submit"));
            }
            tempForm.submit();
            document.body.removeChild(tempForm);
        }

        function nono(el) {
            alert('请选择未确认出账的进行打印');
            $(el).attr('checked',false);
        }

        function updateTime() {
            $("#up_time").submit();
        }

    </script>
</block>