<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>智慧停车场系统</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="./Car/Home/Public/statics/plublic/css/weui.css" rel="stylesheet" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/example.css" rel="stylesheet" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/weui.min.css" rel="stylesheet" type="text/css" />
    <script src="./Car/Home/Public/statics/plublic/js/zepto.min.js"></script>
    <script src="./Car/Home/Public/statics/plublic/js/router.min.js"></script>
    <script src="./Car/Home/Public/statics/plublic/js/example.js"></script>
    <style type="text/css">
        <!--
        .we {width:30%; border-radius:8px; border:1px #389ffe solid; float:left; margin-bottom:10px; color:#389ffe; text-align:center; padding-top:10px; padding-bottom:10px;}
        .we:hover {background-color:#389ffe; color:#FFFFFF;}

        .we2 {width:30%; border-radius:8px; border:1px #389ffe solid; float:left; margin-left:2%; margin-bottom:10px; color:#389ffe; text-align:center; padding-top:10px; padding-bottom:10px;}
        .we2:hover {background-color:#389ffe; color:#FFFFFF;}

        .weui_btn_primary {
            background-color: #389ffe;
        }
        .weui_btn_primary:not(.weui_btn_disabled):active {
            color: #ffffff;
            background-color: #2e8ce2;
        }
        -->
    </style></head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<form action="{pigcms{:U('Ceshi/save')}" method="post" id="my_form">
    <input type="hidden" name="user_id" value="{$Think.session.user_id}">
    <div style="width:100%; height:50px; text-align:center; line-height:50px; background-color:#389ffe; color:#FFFFFF; font-size:18px;">绑定房间</div>
    <div class="bd">
<!--        <div class="weui_cells_title" style="margin-top:20px;">基本信息</div>-->
        <div class="weui_cells weui_cells_form">
            <div class="weui_cell weui_cell_select weui_select_after">
                <div class="weui_cell_hd">
                    <label for="" class="weui_label">社区</label>
                </div>
                <div class="weui_cell_bd weui_cell_primary">
                    <select class="weui_select" name="village" id="village">
                        <option value="0">请选择</option>
                        <foreach name="data" item="vo">
                            <option value="{pigcms{$vo.village_id}">{pigcms{$vo.village_name}</option>
                        </foreach>
                    </select>
                </div>
            </div>
            <div class="weui_cell weui_cell_select weui_select_after">
                <div class="weui_cell_hd">
                    <label for="" class="weui_label">楼层</label>
                </div>
                <div class="weui_cell_bd weui_cell_primary">
                    <select class="weui_select" name="room" id="room">
                        <option value="0">请选择</option>
                        <foreach name="company_array" item="vo">
                            <option value="{pigcms{$vo.company_name}">{pigcms{$vo.company_name}</option>
                        </foreach>
                    </select>
                </div>
            </div>
            <div class="weui_cell weui_cell_select weui_select_after">
                <div class="weui_cell_hd">
                    <label for="" class="weui_label">房间</label>
                </div>
                <div class="weui_cell_bd weui_cell_primary">
                    <select class="weui_select" name="room_son" id="room_son">
                        <option value="0">请选择</option>
<!--                            <option value="{pigcms{$vo.company_name}">{pigcms{$vo.company_name}</option>-->
                    </select>
                </div>
            </div>

            <div class="weui_btn_area" id="showLoadingToast">
                <div class="weui_btn weui_btn_primary" id="button_pay_now">提交</div>
            </div>
        </div>

        <div style="padding-left:15px; padding-right:15px; padding-top:5px; padding-bottom:20px; color:#7f7f7f; line-height:1.5; font-size:12px;">我们会保证您的隐私资料不会被泄露，请放心填写。</div>
        <!--加载提示框开始-->
        <div id="loadingToast" style="display:none;">
            <div class="weui-mask_transparent"></div>
            <div class="weui-toast">
                <i class="weui-loading weui-icon_toast"></i>
                <p class="weui-toast__content">数据加载中</p>
            </div>
        </div>
    </div>
</form>
<script src="./Car/Home/Public/statics/plublic/js/jquery/jquery.min.js" type="text/javascript"></script>
<script src="./Car/Home/Public/statics/plublic/js/sweetalert.min.js" type="text/javascript"></script>
<script src="./Car/Home/Public/statics/plublic/js/ui-sweetalert.min.js" type="text/javascript"></script>
<script>
    var json_data = app_json.json_data;
    $(function(){
        $("select#village").change(function(){
            $("#room").empty();
            $("#room").append("<option value='0'>请选择</option>");
            $("#room_son").empty();
            $("#room_son").append("<option value='0'>请选择</option>");
            var village_id = $(this).val();
                for (var vo in json_data){
                    var row = json_data[vo];
                    if (row['village_id'] === village_id){
                        // console.log(json_data[vo]);
                        for (var son in row) {
                            var row_s = row[son];
                            for (var son_g in row_s) {
                                var row_g = row_s[son_g];
                                if (row_g['room_name']) {
                                    var str = "<option value='"+row_g.id+"'>"+row_g.room_name+"</option>";
                                    $("#room").append(str);
                                }

                            }
                        }

                    }

                }
            });

        $("select#room").change(function(){
            $("#room_son").empty();
            $("#room_son").append("<option value='0'>请选择</option>");
            var tid = $(this).val();
            var village_id = $("#village").val();
            for (var vo in json_data){
                var row = json_data[vo];
                    // console.log(json_data[vo]);
                if (row['village_id'] === village_id) {
                    for (var son in row) {
                        var row_s = row[son];
                        for (var g_son in row_s) {
                            var row_g = row_s[g_son];
                            for (var k in row_g) {
                                var row_z = row_g[k];
                                for (var sk in row_z) {
                                    var row_zz = row_z[sk]
                                    if (row_zz['fid'] === tid){
                                        var str = "<option value='"+row_zz.id+"'>"+row_zz.room_name+"</option>";
                                        $("#room_son").append(str);
                                    }
                                }
                            }

                        }
                    }

                }
            }
        });
    })
</script>
</body>
</html>
