<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
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
        <link href="{pigcms{$static_path}css/allcss/cate6_{pigcms{$tpl.color_id}.css" rel="stylesheet" type="text/css" />
        <link href="{pigcms{$static_path}css/106/iscroll.css" rel="stylesheet" type="text/css" />
        <style>
            .todayList li.only4 a {
                padding: 5px 40px 4px 5px;
            }
            .todayList li .img {
                border-radius: 3px;
                height: 60px;/*图片高度*/
                width: 60px;/*图片宽度*/
                margin: 0 10px 0 0;
            } 
            .todayList li img {
                width: 60px;/*图片宽度*/
            }
            .todayList li p.onlyheight {
                height: 32px;/*分类描述*/
            }
            .todayList li.only4 p {
                white-space: normal;
            }

        </style>
        <script src="{pigcms{$static_path}css/106/iscroll.js" type="text/javascript"></script>
        <script type="text/javascript">
            var myScroll;

            function loaded() {
                myScroll = new iScroll('wrapper', {
                    snap: true,
                    momentum: false,
                    hScrollbar: false,
                    onScrollEnd: function () {
                        document.querySelector('#indicator > li.active').className = '';
                        document.querySelector('#indicator > li:nth-child(' + (this.currPageX+1) + ')').className = 'active';
                    }
                });
 
            }

            document.addEventListener('DOMContentLoaded', loaded, false);
        </script>

    </head>
    <body id="cate4">
    <!--背景音乐-->
    <if condition="$homeInfo['musicurl'] neq false">
<include file="Index:music"/>
</if>
		   <div class="banner">
		<div id="wrapper">
			<div id="scroller">
				<ul id="thelist"> 
				<volist name="flash" id="so">
						<li><p>{pigcms{$so.info}</p><a href="{pigcms{$so.url}"><img src="{pigcms{$so.img}" /></a></li>
					</volist>
				</ul>
			</div>
		</div>
		<div id="nav">
			<div id="prev" onclick="myScroll.scrollToPage('prev', 0,400,3);return false">&larr; prev</div>
			<ul id="indicator">
			<volist name="flash" id="so">
			<li   <if condition="$i eq 1">class="active"</if>  >{pigcms{$i}</li>
			</volist>
			 
			</ul>
			<div id="next" onclick="myScroll.scrollToPage('next', 0);return false">next &rarr;</div>
		</div>
		<div class="clr"></div>
		</div>
        <div id="insert1"></div>
        <div id="todayList">
            <ul class="todayList">
            <volist name="info" id="vo">
                <li class="only4" style="padding:10px 0 0 0">
                    <a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
                        <div class="img"><img src="{pigcms{$vo.img}" /></div>
                        <h2>{pigcms{$vo.name}</h2>
                        <p class="onlyheight">{pigcms{$vo.info}</p>
                        <span class="icon">&nbsp;</span>
                        <div class="clr"></div>
                    </a>
                </li>
            </volist>

            </ul>
        </div>
        <script>


            var count = document.getElementById("thelist").getElementsByTagName("img").length;	


            for(i=0;i<count;i++){
                document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

            }

            document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";


            setInterval(function(){
                myScroll.scrollToPage('next', 0,400,count);
            },3500 );

            window.onresize = function(){ 
                for(i=0;i<count;i++){
                    document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

                }

                document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";
            } 

        </script>
        <div id="insert2"></div>
        <div style="display:none"> </div>

<if condition="$homeInfo['copyright']">
<div class="copyright">{pigcms{$homeInfo.copyright}</div> 
</if>
<include file="Index:styleInclude"/>
<include file="$cateMenuFileName"/> 
<!-- share -->
<include file="Index:share" />
</body></html>