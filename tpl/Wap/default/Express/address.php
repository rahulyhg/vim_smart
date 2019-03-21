<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <link href="{pigcms{$static_path}css/express/weui.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/express/weui2.css" rel="stylesheet" type="text/css" />
    <script src="{pigcms{$static_path}js/express/jquery.min.js"></script>
    <script src="{pigcms{$static_path}js/express/zepto.min.js" type="text/javascript"></script>
    <script src="{pigcms{$static_path}js/express/picker.js"></script>
    <script src="{pigcms{$static_path}js/express/picker-city.js"></script>


    <style type="text/css">
        .sm {width:100%; height:50px; text-align:center; overflow:hidden; line-height:50px; background-color:#0697dc; color:#FFFFFF; font-size:18px;}
        body,td,th {
            color: #999999;
        }
        .weui_input {font-size:16px;}
        input::-webkit-input-placeholder, textarea::-webkit-input-placeholder {
            color: #bbbbbb;
        }
        input:-moz-placeholder, textarea:-moz-placeholder {
            color: #bbbbbb
        }
        input::-moz-placeholder, textarea::-moz-placeholder {
            color: #bbbbbb
        }
        input:-ms-input-placeholder, textarea:-ms-input-placeholder {
            color:#bbbbbb
        }

        .weui_btn_primary {
            background-color: #0697dc;
        }
        .weui_btn_primary:not(.weui_btn_disabled):active {
            color: #ffffff;
            background-color: #2e8ce2;
        }
    </style>
</head>
<body style="background-color:#efeff4;">
<div class="sm">选择地址</div>
<form action="" method="post">
    <input type="hidden" name="type" value="{pigcms{$type}">
    <input type="hidden" name="adress_id" value="{pigcms{$adr_list['adress_id']}">
<div class="bd">
    <div class="weui_cells_title" style="margin-top:20px;">新建地址信息</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label for="" class="weui_label" style="font-size:16px;">真实姓名</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" placeholder="请选择或输入" name="name" value="{pigcms{$adr_list['name']}">
            </div>
        </div>

        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label" style="font-size:16px;">联系电话</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="tel" pattern="[0-9]*" placeholder="手机号、固话、分机号等" name="phone" value="{pigcms{$adr_list['phone']}">
            </div>
        </div>

        <div class="weui_cell">
            <div class="weui_cell_hd"><label for="" class="weui_label">所在区域:</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <if condition="$type eq 1">
                    <select class="weui_select" name="village_id" id="village" disabled="true">
                        <option select="selected" value="0">请选择</option>
                        <volist name="village_arr" id="vo">
                            <option value="{pigcms{$vo.village_id}" <if condition="$village_id eq $vo['village_id']">selected</if>>
                                {pigcms{$vo.village_name}
                            </option>
                        </volist>
                    </select>
                    <else/>
                        <input class="weui_input" type="text"  id="ssx" style="width:90%; color:#bbbbbb" name="position" value="{pigcms{$adr_list['position']}">
                </if>
            </div>
            <div class="weui_cell_hd"><img src="{pigcms{$static_path}images/ddw.jpg" style="width:18px; height:22px;"/></div>
        </div>

        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label" style="font-size:16px;">详细地址</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" placeholder="请详细到门牌号" name="detail" value="{pigcms{$adr_list['detail']}">
            </div>
        </div>
    </div>

    <if condition="$type eq 1">
        <div class="weui_cells weui_cells_form">
            <div class="weui_cell weui_cell_switch">
                <div class="weui_cell_hd weui_cell_primary" style="color:#000000;">设为默认寄件人地址</div>
                <div class="weui_cell_ft">
                    <input class="weui_switch" type="checkbox" id="ck" name="default">
                </div>
            </div>
        </div>
    </if>

    <div class="weui_btn_area">
        <div class="weui_btn weui_btn_primary" id="pay_now_money">保存地址</div>
    </div>
    <input type="hidden" name="village_id" value="{pigcms{$village_id}">
</div>
</form>
</body>
</html>
<script>
    $(function(){
            $("#ssx").cityPicker({
                title: "选择省市县"
            });

//                $("#ss").cityPicker({
//                    title: "选择省市",
//                    showDistrict: false
//                });

    });

</script>
<script>
    $(function () {
       $('#pay_now_money').click(function () {
           var name=$("input[name='name']").val();
           var phone=$("input[name='phone']").val();
           var village_name=$('#village').val();
           var position=$("input[name='position']").val();
           var detail=$("input[name='detail']").val();
           var reg=/^1[3458]\d{9}$/;
           if(name==''){
               alert('姓名不能为空');
               return false;
           }else if(phone==''){
               alert('联系方式不能为空');
               return false;
           }else if(!reg.test(phone)){
               alert('联系方式格式不正确');
               return false;
           }else if(village_name==0){
               alert('请选择所在区域');
               return false;
           }else if(position==''){
               alert('所在区域不能为空');
               return false;
           }else if(detail==''){
               alert('详细地址不能为空');
               return false;
           }else{
               $('form').submit();
               //window.location.href="{pigcms{:U('index')}";
           }
       })
    })
</script>
