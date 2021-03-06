<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>进度查询</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="{pigcms{$static_path}css/progress/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/progress/weui.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/progress/weui.min.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/progress/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/progress/components.min.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/progress/layout.min.css" rel="stylesheet" type="text/css" />


    <style type="text/css">
        <!--
        body{

            -moz-user-select:none;/*火狐*/

            -webkit-user-select:none;/*webkit浏览器*/

            -ms-user-select:none;/*IE10*/

            -khtml-user-select:none;/*早期浏览器a*/

            user-select:none;

            -webkit-tap-highlight-color:rgba(0,0,0,0);

        }

        .bs:link{color:#000000; text-decoration:none;}
        .bs:visited{color:#000000; text-decoration:none;}
        .bs:active{color:#000000; text-decoration:none;}
        .bs:hover{color:#000000; text-decoration:none;}

        .tabbable-line>.nav-tabs>li {
            margin: 0;
            text-align: center;
            border-bottom: 4px solid transparent;
            width: 33.3%;
        }

        .tabbable-line>.nav-tabs>li.active {
            background: 0 0;
            border-bottom: 4px solid #3598dc;
            position: relative;
            width: 33.3%;
            text-align: center;
        }

        .nav-tabs>li>a {
            margin-right: 2px;
            line-height: 2;
            border: 1px solid transparent;
            border-radius: 4px 4px 0 0;
        }
        .tabbable-line>.tab-content {
            margin-top: 15px;
            border: 0;
            border-top: 1px solid #eef1f5;
            padding:0;
        }
        p {
            margin:0;
        }
        .tabbable-line>.nav-tabs {
            border: none;
            margin: 0;
            background-color: #ffffff;
        }
        .weui-media-box {
            padding: 5px 15px;
            position: relative;
            float:left;
        }
        .btn {border-radius:0px;}
        a:hover {
            cursor: pointer;
            color: #ffffff;
        }
        a:focus, a:hover {
            color: #ffffff;
            text-decoration: none;
        }
        .weui-media-box__info {
            margin-top: 10px;
            padding-bottom: 5px;
            font-size: 13px;
            color: #cecece;
            line-height: 1em;
            list-style: none;
            overflow: hidden;
        }
        .weui_btn {font-size:16px;}
        .weui-media-box__desc {
            color: #7f7f7f;}
        .weui-media-box__info {color:#999999;}
        .fa-item {
            font-size: 14px;
            padding: 0px 5px 5px 0px;
        }
        .weui-media-box_text .weui-media-box__title {
            margin-bottom: 8px;
            color: #333333;
        }
        .fa-item i {
            font-size: 16px;
            display: inline-block;
            width: 20px;
            color: #389ffe;
        }
        .btn:not(.btn-sm):not(.btn-lg) {
            line-height: 1;
            font-size: 13px;
        }
        -->
    </style></head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body style="background-color:#f2f2f2;">
<div style="width:100%; height:50px; text-align:center; line-height:50px; background-color:#389ffe; color:#FFFFFF; font-size:18px;">审核进度</div>
<div class="portlet-body">
    <div class="tabbable-line">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#tab_15_1" data-toggle="tab"> 全部 </a>
            </li>
            <li>
                <a href="#tab_15_2" data-toggle="tab"> 处理中 </a>
            </li>
            <li>
                <a href="#tab_15_3" data-toggle="tab"> 已处理 </a>
            </li>
        </ul>
        <div class="tab-content">
            <empty name="all">
                <span style="margin: 0 auto">暂无数据</span>
            </empty>
            <div class="tab-pane active" id="tab_15_1">
                <foreach name="all" item="v">
                    <if condition="$v['type_id'] eq 1">
                        <a href="{pigcms{:U('detail',array('progress_id'=>$v['progress_id']))}" class="bs"><div class="weui-panel">
                                <div class="weui-panel__hd">
                                    <div style="width:50%; float:left;">快递订单产生时间：{pigcms{$v.create_time|date='Y-m-d H:i:s',###}</div>
                                    <div style="width:50%; float:left; text-align:right; color:#474747;">{pigcms{$v.theme}</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="weui-panel__bd">
                                    <div class="weui-media-box weui-media-box_text">
                                        <h4 class="weui-media-box__title"><div class="fa-item col-md-3 col-sm-4">
                                                <i class="fa fa-car"></i></div>快递单号:{pigcms{$v['ems_order_id']}</h4>
                                        <ul class="weui-media-box__info">
                                            <li class="weui-media-box__info__meta">收件方:{pigcms{$v['get_n']}</li>
                                            <li class="weui-media-box__info__meta">收件地址：{pigcms{$v['address']}</li>
                                        </ul>
                                    </div>
                                    <div style="float:right; margin-top:25px; margin-right:15px;">
                                        <if condition="$v.status eq 1">
                                            <button type="button" class="btn red btn-outline">待处理</button></if>
                                        <if condition="$v.status eq 2">
                                            <button type="button" class="btn green btn-outline" disabled="disabled">已处理</button></if>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </if>
                </foreach>
            </div>
            <div class="tab-pane" id="tab_15_2">
                <foreach name="doing" item="v">
                    <if condition="$v['type_id'] eq 1">
                        <a href="{pigcms{:U('detail',array('progress_id'=>$v['progress_id']))}" class="bs"><div class="weui-panel">
                                <div class="weui-panel__hd">
                                    <div style="width:50%; float:left;">快递订单产生时间：{pigcms{$v.create_time|date='Y-m-d H:i:s',###}</div>
                                    <div style="width:50%; float:left; text-align:right; color:#474747;">{pigcms{$v.theme}</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="weui-panel__bd">
                                    <div class="weui-media-box weui-media-box_text">
                                        <h4 class="weui-media-box__title"><div class="fa-item col-md-3 col-sm-4">
                                                <i class="fa fa-car"></i></div>快递单号:{pigcms{$v['ems_order_id']}</h4>
                                        <ul class="weui-media-box__info">
                                            <li class="weui-media-box__info__meta">收件方:{pigcms{$v['get_n']}</li>
                                            <li class="weui-media-box__info__meta">收件地址：{pigcms{$v['address']}</li>
                                        </ul>
                                    </div>
                                    <div style="float:right; margin-top:25px; margin-right:15px;">
                                        <if condition="$v.status eq 1">
                                            <button type="button" class="btn red btn-outline">待处理</button></if>
                                        <if condition="$v.status eq 2">
                                            <button type="button" class="btn green btn-outline" disabled="disabled">已处理</button></if>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </if>
                </foreach>
            </div>
            <div class="tab-pane" id="tab_15_3">
                <foreach name="done" item="v">
                    <if condition="$v['type_id'] eq 1">
                        <a href="{pigcms{:U('detail',array('progress_id'=>$v['progress_id']))}" class="bs">
                            <div class="weui-panel">
                                <div class="weui-panel__hd">
                                    <div style="width:50%; float:left;">{pigcms{$v.create_time|date='Y-m-d H:i:s',###}</div>
                                    <div style="width:50%; float:left; text-align:right; color:#474747;">{pigcms{$v.theme}</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="weui-panel__bd">
                                    <div class="weui-media-box weui-media-box_text">
                                        <h4 class="weui-media-box__title"><div class="fa-item col-md-3 col-sm-4">
                                                <i class="fa fa-car"></i></div>寄件方</h4>
                                        <ul class="weui-media-box__info">
                                            <li class="weui-media-box__info__meta">收件方</li>
                                            <li class="weui-media-box__info__meta">**</li>
                                        </ul>
                                    </div>
                                    <div style="float:right; margin-top:25px; margin-right:15px;">
                                        <if condition="$v.status eq 1">
                                            <button type="button" class="btn red btn-outline">待处理</button></if>
                                        <if condition="$v.status eq 2">
                                            <button type="button" class="btn green btn-outline" disabled="disabled">已处理</button></if>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </if>
                </foreach>
            </div>
        </div>
    </div>
</div>
<script src="{pigcms{$static_path}js/progress/jquery.min.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/progress/bootstrap.min.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/progress/layout.min.js" type="text/javascript"></script>
</body>
</html>
<script>
    sessionStorage.setItem("need-refresh", true);
</script>
