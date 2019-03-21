<!DOCTYPE html>
<html>    <head>
       <if condition="$zd['status'] eq 1">
            {pigcms{$zd['code']}
        </if>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>{pigcms{$tpl.wxname}</title>
        <base href="." />
        <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="format-detection" content="telephone=no" />
<link href="{pigcms{$static_path}css/allcss/cate18_{pigcms{$tpl.color_id}.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/118/reset.css" media="all">
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/118/font-awesome.css" media="all">
<!-- <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/118/home-47.css" media="all"> -->
<script type="text/javascript" src="{pigcms{$static_path}css/116/jQuery.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}css/118/zepto.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}css/118/swipe.js"></script>

        
    </head>
    <body onselectstart="return true;" ondragstart="return false;">
    <!--背景音乐-->
<if condition="$homeInfo['musicurl'] neq false">
<include file="Index:music"/>
</if>
    
        <div class="body" style="margin-bottom: 60px !important;">
        <!--
    幻灯片管理
    -->
    <div style="-webkit-transform:translate3d(0,0,0);">
        <div id="banner_box" class="box_swipe" style="visibility: visible;">
            <ul style="list-style: none;transition: 500ms; -webkit-transition: 500ms; -webkit-transform: translate3d(0, 0, 0);">
                <volist name="flash" id="so">
                                    <li style="vertical-align: top;">
                                                    <a href="{pigcms{$so.url}">
                                                                    <img src="{pigcms{$so.img}"  style="width:100%;">
                                </a>
                    </li>
                    </volist>
                                   
                            </ul>
            <ol>
               <volist name="flash" id="so">
                    <li <if condition="$i eq 1">class="on"</if>></li>
                </volist>
                            </ol>
        </div>
    </div>
        <script>
        $(function(){
            new Swipe(document.getElementById('banner_box'), {
                speed:500,
                auto:3000,
                callback: function(){
                    var lis = $(this.element).next("ol").children();
                    lis.removeClass("on").eq(this.index).addClass("on");
                }
            });
        });
    </script>
 <section>
        <div>
            <ul class="list_ul">

                <li class="box"> 
					<volist name="info" id="vo" offset="0" length="3">           
						<dl style="width:100px;height:80px">
							<a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
							<dd>
								<div>
									<span ><img src="{pigcms{$vo.img}" class="icon-smile" style="width:42px;height:42px;"></span>
								</div>
							</dd>
								<dt>{pigcms{$vo.name}</dt>
							</a>
						</dl>
					</volist>
                </li>
	
                <li class="box"> 
					<volist name="info" id="vo" offset="3" length="2">           
						<dl style="width:150px;height:80px">
							<a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
							<dd>
								<div>
									<span ><img src="{pigcms{$vo.img}" class="icon-smile" style="width:42px;height:42px;"></span>
								</div>
							</dd>
								<dt>{pigcms{$vo.name}</dt>
							</a>
						</dl>
					</volist>
                </li>
	
                <li class="box"> 
					<volist name="info" id="vo" offset="5" length="3">           
						<dl style="width:100px;height:80px">
							<a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
							<dd>
								<div>
									<span ><img src="{pigcms{$vo.img}" class="icon-smile" style="width:42px;height:42px;"></span>
								</div>
							</dd>
								<dt>{pigcms{$vo.name}</dt>
							</a>
						</dl>
					</volist>
                </li>
	
                <li class="box"> 
					<volist name="info" id="vo" offset="8" length="2">           
						<dl style="width:150px;height:80px">
							<a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
							<dd>
								<div>
									<span ><img src="{pigcms{$vo.img}" class="icon-smile" style="width:42px;height:42px;"></span>
								</div>
							</dd>
								<dt>{pigcms{$vo.name}</dt>
							</a>
						</dl>
					</volist>
                </li>
                <li class="box" > 
					<volist name="info" id="vo" offset="10" length="3">           
						<dl style="width:100px;height:80px">
							<a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
							<dd>
								<div>
									<span ><img src="{pigcms{$vo.img}" class="icon-smile" style="width:42px;height:42px;"></span>
								</div>
							</dd>
								<dt>{pigcms{$vo.name}</dt>
							</a>
						</dl>
					</volist>
                </li>
	
                <li class="box"> 
					<volist name="info" id="vo" offset="13" length="2">           
						<dl style="width:150px;height:80px">
							<a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
							<dd>
								<div>
									<span ><img src="{pigcms{$vo.img}" class="icon-smile" style="width:42px;height:42px;"></span>
								</div>
							</dd>
								<dt>{pigcms{$vo.name}</dt>
							</a>
						</dl>
					</volist>
                </li>
	
                <li class="box"> 
					<volist name="info" id="vo" offset="15" length="3">           
						<dl style="width:100px;height:80px">
							<a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
							<dd>
								<div>
									<span ><img src="{pigcms{$vo.img}" class="icon-smile" style="width:42px;height:42px;"></span>
								</div>
							</dd>
								<dt>{pigcms{$vo.name}</dt>
							</a>
						</dl>
					</volist>
                </li>
	
                <li class="box"> 
					<volist name="info" id="vo" offset="18" length="2">           
						<dl style="width:150px;height:80px">
							<a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
							<dd>
								<div>
									<span ><img src="{pigcms{$vo.img}" class="icon-smile" style="width:42px;height:42px;"></span>
								</div>
							</dd>
								<dt>{pigcms{$vo.name}</dt>
							</a>
						</dl>
					</volist>
                </li>
                <li class="box"> 
					<volist name="info" id="vo" offset="20" length="3">           
						<dl style="width:100px;height:80px">
							<a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
							<dd>
								<div>
									<span ><img src="{pigcms{$vo.img}" class="icon-smile" style="width:42px;height:42px;"></span>
								</div>
							</dd>
								<dt>{pigcms{$vo.name}</dt>
							</a>
						</dl>
					</volist>
                </li>
	
                <li class="box"> 
					<volist name="info" id="vo" offset="23" length="2">           
						<dl style="with:150px;height:80px">
							<a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
							<dd>
								<div>
									<span ><img src="{pigcms{$vo.img}" class="icon-smile" style="width:42px;height:42px;"></span>
								</div>
							</dd>
								<dt>{pigcms{$vo.name}</dt>
							</a>
						</dl>
					</volist>
                </li>
	
                <li class="box"> 
					<volist name="info" id="vo" offset="25" length="3">           
						<dl style="width:100px;height:80px">
							<a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
							<dd>
								<div>
									<span ><img src="{pigcms{$vo.img}" class="icon-smile" style="width:42px;height:42px;"></span>
								</div>
							</dd>
								<dt>{pigcms{$vo.name}</dt>
							</a>
						</dl>
					</volist>
                </li>
	
                <li class="box"> 
					<volist name="info" id="vo" offset="28" length="2">           
						<dl style="width:150px;height:80px">
							<a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
							<dd>
								<div>
									<span ><img src="{pigcms{$vo.img}" class="icon-smile" style="width:42px;height:42px;"></span>
								</div>
							</dd>
								<dt>{pigcms{$vo.name}</dt>
							</a>
						</dl>
					</volist>
                </li>
	
				

                </ul>
        </div>
    </section>
   
<if condition="$homeInfo['copyright']">
<div class="copyright">{pigcms{$homeInfo.copyright}</div> 
</if>

</div>

                    
    <include file="Index:styleInclude"/>
    <include file="$cateMenuFileName"/>
<!-- share -->
<include file="Index:share" />
</body></html>
    