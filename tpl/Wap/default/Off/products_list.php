<html>
<head>
<meta charset="utf-8">
<title>物品数据分析</title>
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<link href="{pigcms{$static_path}css/safety/bd.css" rel="stylesheet" type="text/css">
<link href="{pigcms{$static_path}css/shui/weui.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{pigcms{$static_path}css/safety/bootstrap.min.css">
<script src="{pigcms{$static_path}js/safety/jquery.min.js"></script>
<script src="{pigcms{$static_path}js/safety/bootstrap.min.js"></script>

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
        <button style="width:48%; height: 46px; float:left; margin-left: 4%; margin-bottom: 3%; background-color: #2093fc;" id="sample_editable_1_new" class="weui_btn blue" type="submit">个人物品使用查询</button>
    </form>
</div>

    

<div class="zw">
    <div class="tb">
        <span style="float: left; width: 48%; text-align: right;">项目名称  &nbsp;&nbsp; -- </span> 
        <div style="float: right; width:48%; margin-top: 6px;">
            <select style="width:65%; height:34px; float: left; background-color:#FFFFFF; color: black; border: 1px solid #c2cad8;" id="select_village_id">
                <option value=" ">全部显示</option>
                <foreach name="villageArray" item="vo">
                    <option value="{pigcms{$vo.village_id}" <if condition="$villageId eq $vo['village_id']">selected="selected"</if> >{pigcms{$vo.village_name}</option>
                </foreach>
            </select>
        </div>
    </div>
    <if condition="$villageId neq ''">   
    <div class="kk">
        <div class="zw">
            <div class="width p20">

                <div class="dkk">
                    <div class="width">
                        <if condition="$villageArray[$villageId]['count'] neq ''">
                            <div class="nu"><a href="#" class="dsz">{pigcms{$villageArray[$villageId]['count']}</a></div>
                        <else/>
                            <div class="nu"><a href="#" class="dsz">0</a></div>
                        </if>
                        <div class="nu2">物品数量</div>
                        <div class="nu3">
                            <div class="re">
                                <div class="width">
                                    <div class="jk">{pigcms{$villageArray[$villageId]['count']}</div>
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
                        <div class="nu"><a href="#" class="dsz">{pigcms{$Count}</a></div>
                        <div class="nu2">物品总数量</div>
                        <div class="nu3">
                            <div class="re3">
                                <div class="width">
                                    <div class="jk3">使用率</div>
                                    <div class="jk4">{pigcms{$villageArray[$villageId]['rate']}%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="both"></div>
            </div>
        </div>
    </div>
    </if>
    <div class="kk2">
        <div class="width p25" style="margin-top: -3%; width: 98%;">
    <if condition="$villageId eq ''">
        <div id="didida" style="width: 100%;">
            <table width="100%" border="1px" cellspacing="0" cellpadding="0" style="border-radius: 8px; border: 1px #e5e5e5 solid; border-bottom:none; margin: auto;">
                <tr>
                    <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; text-align:center; border-top:none; border-left:none;">项目名称</th>
                    <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; text-align:center; border-top:none; border-left:none;">物品数量</th>
                    <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; text-align:center; border-top:none; border-right:none; border-left:none;">占比率</th>
                </tr>
                <foreach name="villageArray" item="vo">
                    <tr>
                        <td style="border: 1px #e5e5e5 solid; border-top:none;  height:30px; line-height:30px; text-align:center; border-left:none;">{pigcms{$vo.village_name}</td>
                        <if condition="$vo.count neq ''">
                            <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none;">{pigcms{$vo.count}/{pigcms{$Count}</td>
                        <else/>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none;">0/{pigcms{$Count}</td>
                        </if>
                        <td style="border: 1px #e5e5e5 solid; border-top:none; border-right:none; height:30px; line-height:30px; text-align:center; border-left:none;">{pigcms{$vo.rate}%</td>
                    </tr>
                </foreach>
            </table>
        </div>
    <else/>                        
        <div id="didida" style="width: 100%;">
            <table width="100%" border="1px" cellspacing="0" cellpadding="0" style="border-radius: 8px; border: 1px #e5e5e5 solid; border-bottom:none; margin: auto;">
                <tr>
                    <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; text-align:center; border-top:none; border-left:none;">物品名称</th>
                    <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; text-align:center; border-top:none; border-left:none;">物品类别</th>
                    <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; text-align:center; border-top:none; border-left:none;">物品品牌</th>
                    <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; text-align:center; border-top:none; border-left:none;">物品单价</th>
                    <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; text-align:center; border-top:none; border-right:none; border-left:none;">数量</th>
                </tr>
                <foreach name="offArr" item="vo">
                    <tr>
                        <td style="border: 1px #e5e5e5 solid; border-top:none;  height:30px; line-height:30px; text-align:center; border-left:none;">{pigcms{$vo.pro_name}</td>
                        <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none;">{pigcms{$vo.type_name}</td>
                        <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none;">{pigcms{$vo.band}</td>
                        <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none;">{pigcms{$vo.pro_price}</td>
                        <td style="border: 1px #e5e5e5 solid; border-top:none; border-right:none; height:30px; line-height:30px; text-align:center; border-left:none;">{pigcms{$vo.r_num_v}/{pigcms{$vo.r_num}</td>
                    </tr>
                </foreach>
            </table>
        </div>
    </if>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("select#select_village_id").change(function(){
        var u = $(this).val();
        var str = window.location.href;
        var length = str.substr(str.lastIndexOf('villageId=')-1,).length; //获取url中&villageId=u的长度
        var url = '';
        if(str.indexOf("villageId")>0){
            url = str.substring(0,str.length-length);            
        }else{
            url = str;
        }
        location.href=url+'&villageId='+u;
    });
</script>
    
</body>
</html>