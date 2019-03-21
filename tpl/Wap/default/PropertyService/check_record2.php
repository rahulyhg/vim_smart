<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>巡更点一览</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="{pigcms{$static_path}css/xun/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
    <script src="{pigcms{$static_path}js/xun/zepto.min.js"></script>
    <script src="{pigcms{$static_path}js/jquery.min.js"></script>

    <style type="text/css">
        input::-webkit-input-placeholder, textarea::-webkit-input-placeholder {
            color: #979797; font-size:16px;
        }
        input:-moz-placeholder, textarea:-moz-placeholder {
            color: #979797; font-size:16px;
        }
        input::-moz-placeholder, textarea::-moz-placeholder {
            color: #979797; font-size:16px;
        }
        input:-ms-input-placeholder, textarea:-ms-input-placeholder {
            color: #979797; font-size:16px;
        }

        input,
        textarea {
            border: 0; /* 方法1 */
            -webkit-appearance: none; /* 方法2 */
        }

        .weui_cell_select .weui_cell_bd:after {
            content: " ";
            display: inline-block;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            height: 6px;
            width: 6px;
            border-width: 2px 2px 0 0;
            border-color: #8e8e8e;
            border-style: solid;
            position: relative;
            top: -2px;
            position: absolute;
            top: 50%;
            right: 15px;
            margin-top: -3px;
            z-index: 1111;
        }
    </style>
</head>
<body>
<div class="page">
    <div class="page__bd" style="height: 100%">
        <div class="weui-tab">
            <div class="weui-navbar">
                <a class="weui-navbar__item weui-bar__item--on" href="#tab1">
                    已巡更（{pigcms{$nowPointCount}）
                </a>
                <a class="weui-navbar__item" href="#tab2">
                    未巡更（{pigcms{$lowPoint}）
                </a>
                <a class="weui-navbar__item" href="#tab3" onclick="saoma()">
                    <img src="{pigcms{$static_path}/images/saoma.jpg" alt="" width="18%"/>
                </a>

            </div>
            <div class="weui-tab__bd">
                <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
                    <div class="weui-panel__hd">正常点位：{pigcms{$safetyPoint} , 异常点位：{pigcms{$warningPoint}</div>

                    <foreach name="nowPointList" item="vo">
                        <div class="weui-panel weui-panel_access">
                            <div class="weui-panel__bd">
                                <a href="{pigcms{:U('record_detail',array('id'=>$vo['pigcms_id']))}" class="weui-media-box weui-media-box_appmsg">
                                    <div class="weui-media-box__bd" style="float:left;">
                                        <h4 class="weui-media-box__title">
                                            巡更楼层：{pigcms{$vo.room_name}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            巡更方位：{pigcms{$vo.orientation}
                                        </h4>
                                        <p class="weui-media-box__desc">由{pigcms{$vo.name}于{pigcms{$vo.check_time|date='Y-m-d H:i:s',###}上报
                                        </p>
                                    </div>
                                    <if condition="$vo['point_status'] eq 0">
                                        <div style="background-color:#04be02; border-radius:7px; width:14px; height:14px; float:left; margin-top:2px;"></div>
                                        <else/>
                                        <div style="background-color:#f43530; border-radius:7px; width:14px; height:14px; float:left; margin-top:2px;"></div>
                                    </if>
                                    <div style="clear:both"></div>
                                </a>
                            </div>
                            <div class="weui-panel__ft">
                                <a href="{pigcms{:U('record_detail',array('id'=>$vo['pigcms_id']))}" class="weui-cell weui-cell_access weui-cell_link">
                                    <div class="weui-cell__bd">具体详情</div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                            </div>
                        </div>
                    </foreach>
                </div>
                <div id="tab2" class="weui-tab__bd-item">
                    <foreach name="lowPointList" item="sv">
                        <div class="weui-cells">
                            <div class="weui-cell">
                                <div class="weui-cell__bd">
                                    <p>巡更楼层：{pigcms{$sv.room_name}&nbsp;&nbsp;&nbsp;&nbsp;
                                        巡更方位：{pigcms{$sv.oname}</p>
                                </div>
                                <div class="weui-cell__ft">未巡更</div>
                            </div>
                        </div>
                    </foreach>
                </div>
                <div id="tab3" class="weui-tab__bd-item">
                </div>
            </div>
        </div>
    </div>

</div>
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
{pigcms{$shareScript}
<script type="application/javascript">
    /*吊起二维码扫描功能*/
    function saoma() {
        wx.scanQRCode({
            needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
            scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
            success: function (res) {
                var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                console.log(2);
            }
        });
    }

</script>
</body>
</html>