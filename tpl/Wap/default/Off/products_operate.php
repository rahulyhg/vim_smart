<html>
<head>
<meta charset="utf-8">
<title>个人物品使用查询</title>
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<link href="{pigcms{$static_path}css/safety/bd.css" rel="stylesheet" type="text/css">
<link href="{pigcms{$static_path}css/shui/weui.min.css" rel="stylesheet" type="text/css">
<link href="/Car/Admin/Public/assets/global/css/qr_d_css/weui.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/css/qr_d_css/kui.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.weui-cells {
    margin-top: 0;
    }
.weui-cells:after, .weui-cells:before {left:15px;}
select {
appearance:none;
-moz-appearance:none;
-webkit-appearance:none;
}
.weui-cells:after {border-bottom:none;}

/*清除ie的默认选择框样式清除，隐藏下拉箭头*/
select::-ms-expand { display: none; }
.weui-vcode-btn {color: #2093fc;}
.weui-vcode-btn:active {color: #1883e5;}
-->
</style>
</head>
<script>
  document.addEventListener('touchstart',function(){},false);
</script>

<body style="background-color:#f7f6f9;">
<div style="margin-top: 3%;">
    <form action="{pigcms{:U('Off/products_operate')}" method="post" class="form-horizontal" enctype="multipart/form-data">
        <input style="width:48%; height: 46px; float:left; border: 1px solid #2093fc;" type="search_borrower" class="form-control input-sm input-small input-inline" placeholder="" aria-controls="sample_1" name="search_borrower">
        <button style="width:48%; height: 46px; float:left; margin-left: 4%; margin-bottom: 3%; background-color: #2093fc; font-size: inherit;" id="sample_editable_1_new" class="weui_btn blue" type="submit">个人物品使用查询</button>
    </form>
</div>

<if condition="$codeArr eq ''">
    <td align="center">当前无绑定物品</td>
<else/>
    

<div class="zw">
    <div class="tb">个人物品使用表 -- {pigcms{$borrower}</div>
    <div class="kk">
        <div class="zw">
            <div class="width p20">

                <div class="dkk">
                    <div class="width">
                        <div class="nu"><a href="#" class="dsz">{pigcms{$num}</a></div>
                        <div class="nu2">使用物品数量</div>
                        <div class="nu3">
                            <div class="re">
                                <div class="width">
                                    <div class="jk">{pigcms{$num}</div>
                                    <div class="jk2">领用</div>
                                </div>
                            </div>
                            <div class="re2">
                                <div class="width">
                                    <div class="jk">0</div>
                                    <div class="jk2">借用</div>
                                </div>
                            </div>
                            <div class="both"></div>
                        </div>
                    </div>
                </div>
                <div class="dkk2">
                    <div class="width">
                        <div class="nu"><a href="#" class="dsz">{pigcms{$Num}</a></div>
                        <div class="nu2">物品总数量</div>
                        <div class="nu3">
                            <div class="re3">
                                <div class="width">
                                    <div class="jk3">使用率</div>
                                    <div class="jk4">{pigcms{$rate}%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="both"></div>
            </div>
        </div>
    </div>

    <div class="kk2">
        <div class="width p25" style="margin-top: -3%;">
        <div class="row" style="margin-top: -3%;">
            <div class="col-md-12" >
                <div class="btn-group" style="line-height:32px; color:#999999; padding-bottom: 5px;">
                    个人物品使用详情
                </div>
            </div>
        </div>
                
    <div id="didida">
        <table width="100%" border="1px" cellspacing="0" cellpadding="0" style="border-radius: 8px; border: 1px #e5e5e5 solid; border-bottom:none;">
            <tr>
                <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">物品名称</th>
                <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">物品品牌</th>
                <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">物品单价</th>
                <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-right:none; border-left:none;">数量</th>
            </tr>
            <foreach name="codeArr" item="vo">
                <tr>
                    <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none;">{pigcms{$vo.pro_name}</td>
                    <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none;">{pigcms{$vo.band}</td>
                    <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none;">{pigcms{$vo.pro_price}</td>
                    <td style="border: 1px #e5e5e5 solid; border-top:none; border-right:none; height:30px; line-height:30px; text-align:center; border-left:none;">{pigcms{$vo.num}/{pigcms{$vo.num_v}</td>
                </tr>
            </foreach>
        </table>

    </div>

    <!-- <div class="row">
        <div class="col-md-12">
            <div class="btn-group" style="line-height:32px; color:#999999; padding-bottom: 5px;">
                物品数量总计：{pigcms{$Count}
            </div>
        </div>
    </div> -->

        </div>
    </div>
</div>
</if>
</body>
</html>