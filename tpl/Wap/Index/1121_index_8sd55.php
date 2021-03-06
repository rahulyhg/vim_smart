<!doctype html>
<html xmlns="http://www.w3.org/1999/html">
      <head>
       <if condition="$zd['status'] eq 1">
            {pigcms{$zd['code']}
        </if>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta name="format-detection" content="telephone=no">
    <meta content="telephone=no" name="format-detection">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>{pigcms{$tpl.wxname}</title>

    <link type="text/css" rel="stylesheet" href="{pigcms{$static_path}tpl/com/css/comstyle.css"/>
    <link type="text/css" rel="stylesheet" href="{pigcms{$static_path}tpl/com/css/font-awesome.css"/>
    <link href="{pigcms{$static_path}tpl/1119/css/list3.css" media="screen" rel="stylesheet" type="text/css" />

    <script src="{pigcms{$static_path}tpl/com/js/comjs.js" type="text/javascript"></script>

  </head>

  <body>	
    <div class="html">
      <div class="stage" id="stage">
        <section id="sec-index">
          
          <div class="body">

  <div class="list">
    <ul>
		<volist name="info" id="vo">
			<li>
			  <a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
				<div class="list-img">
				  <b>
					  <img src="{pigcms{$vo.img}" />
				  </b>
				</div>

				<div class="list-text">
				  <h1>{pigcms{$vo.name}</h1>
				  <h2>{pigcms{$vo.info}</h2>
				</div>
				</a>
			</li>
		</volist>
    </ul>
  </div>

          </div>
        </section>


      </div><!--.stage end-->
    </div><!--.html end-->

<if condition="$homeInfo['copyright']">
<div class="copyright">{pigcms{$homeInfo.copyright}</div> 
</if>
<include file="Index:styleInclude"/>
<include file="$cateMenuFileName"/> 
<!-- share -->
<include file="Index:share" />
  </body>
</html>