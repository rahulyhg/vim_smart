<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>快递员上门</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="{pigcms{$static_path}css/express/weui.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/express/weui2.css" rel="stylesheet" type="text/css" />
    <script src="{pigcms{$static_path}js/express/jquery.min.js"></script>
    <style type="text/css">
        .sm {width:100%; height:50px; text-align:center; overflow:hidden; line-height:50px; background-color:#0697dc; color:#FFFFFF; font-size:18px;}
        .jj {width:100%; height:100px; border-bottom:0.8px #bcbab6 solid; overflow:hidden; background-color:#FFFFFF;}
        .jjd {width:90%; margin:0px auto; padding-top:8px;}
        .x3 {width:70%; margin-left:10%; height:75px; float:left; margin-top:5px;}
        body,td,th {font-family: 微软雅黑;}
        .xt {width:100%; height:25px; line-height:25px; font-size:18px; color:#000000;}
        .xt2 {width:100%; height:25px; line-height:25px; font-size:16px; color:#888888;}
        .weui_select {
            -webkit-appearance: none;
            border: 0;
            outline: 0;
            background-color: transparent;
            width: 100%;
            font-size: inherit;
            height: 49px;
            line-height: 49px;
            position: relative;
            z-index: 1;
            padding-left: 0px;
        }
        .yu {width:50px; height:50px; position:absolute; left:0; top:50px; background:url({pigcms{$static_path}images/mm.png); background-size:100% 100%; color:#FFFFFF;}
        .al {float:right; width:25px; height:25px; margin-top:25px;}
        .gr {width:95%; position:fixed; bottom:0; padding:2.5%; overflow:hidden; background-color:#FFFFFF;}
        .bg-blue {
            background-color: #0697dc;
        }
    </style>
</head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body style="background-color:#efeff4;">
<div class="sm">选择地址</div>
<if condition="$type eq 1 ">
        <div style="width:100%;">
            <if condition="$default_adr">
                <div class="jj">
                    <div class="jjd">
                        <div class="yu"><span style="margin-left:7px;">默</span></div>
                        <a href="{pigcms{:U('index',array('adress_id'=>$default_adr['adress_id'],'type'=>1))}">
                            <div class="x3">
                                <div class="xt">{pigcms{$default_adr['name']}  {pigcms{$default_adr['phone']}</div>
                                <div class="xt2">{pigcms{$default_adr['village_name']}</div>
                                <div class="xt2">{pigcms{$default_adr['detail']}</div>
                            </div>
                        </a>
                            <div class="al" attr="{pigcms{$default_adr['adress_id']}"><img src="{pigcms{$static_path}images/gr.jpg" style="width:25px; height:25px;"/></div>
                            <div style="clear:both"></div>
                    </div>
                </div>
            </if>
            <volist name="other_adr" id="vo">
                <div class="jj">
                    <div class="jjd">
                        <a href="{pigcms{:U('index',array('adress_id'=>$vo['adress_id'],'type'=>1))}">
                            <div class="x3">
                                <div class="xt">{pigcms{$vo['name']}  {pigcms{$vo['phone']}</div>
                                <div class="xt2">
                                    {pigcms{$vo['village_name']}
                                </div>
                                <div class="xt2">{pigcms{$vo['detail']}</div>
                            </div>
                        </a>
                            <div class="al" attr="{pigcms{$vo['adress_id']}"><img src="{pigcms{$static_path}images/gr.jpg" style="width:25px; height:25px;"/></div>
                            <div style="clear:both"></div>
                    </div>
                </div>
            </volist>
        </div>
    <else/>
        <div style="width:100%;">
            <volist name="get_adr" id="vo">
                <div class="jj">
                    <div class="jjd">
                        <a href="{pigcms{:U('index',array('adress_id'=>$vo['adress_id'],'type'=>2))}">
                            <div class="x3">
                                <div class="xt">{pigcms{$vo['name']}  {pigcms{$vo['phone']}</div>
                                <div class="xt2">
                                    {pigcms{$vo['position']}
                                </div>
                                <div class="xt2">{pigcms{$vo['detail']}</div>
                            </div>
                        </a>
                            <div class="al" attr="{pigcms{$vo['adress_id']}"><img src="{pigcms{$static_path}images/gr.jpg" style="width:25px; height:25px;"/></div>
                            <div style="clear:both"></div>
                    </div>
                </div>
            </volist>
        </div>

</if>
<div class="gr">
    <a href="javascript:;" class="weui_btn bg-blue" id="new_adr">+ 新建地址</a>
</div>
</body>
</html>
<script>
    $(function () {
        var type = '{pigcms{$type}';
        var village_id = '{pigcms{$village_id}';
        $("#new_adr").click(function () {
            window.location.href="{pigcms{:U('address')}"+'&type='+type+'&village_id='+village_id;
        })

        $(".al").click(function () {
            var adress_id = $(this).attr('attr');
            window.location.href="{pigcms{:U('address')}"+'&type='+type+'&adress_id='+adress_id+'&village_id='+village_id;
        })
    })
</script>


