<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>消防设备巡检</title>
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
ol, ul {
    margin-top: 0;
    margin-bottom: 0px;
}
.weui-uploader__file {
    float: left;
    margin-right: 9px;
    margin-bottom: 9px;
    width: 77px;
    height: 77px;
    background: no-repeat 50%;
    background-size: cover;
}
label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 0px;
    font-weight: 700;
}
.weui-cells:after, .weui-cells:before {left:15px;}
select {
appearance:none;
-moz-appearance:none;
-webkit-appearance:none;
}
a {
    color: #000000;
    text-decoration: none;
}
.weui-cells:after {border-bottom:none;}

/*清除ie的默认选择框样式清除，隐藏下拉箭头*/
select::-ms-expand { display: none; }
.weui-vcode-btn {color: #2093fc;}
.weui-vcode-btn:active {color: #1883e5;}
-->
</style>
</head>

<body style="background-color:#f7f6f9;">

<div class="zw">
    <div class="tb">{pigcms{$date[0]}年消防栓、灭火器检查记录卡</div>
    <div class="kk">
        <div class="zw">
            <div class="weui-cells">
            <!-- <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">选择项目:</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="select2">
                        <option value="1">广发银行大厦</option>
                        <option value="2">浦发银行大厦</option>
                    </select>
                </div>
            </div>
            <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">选择楼层:</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="select2">
                        <option value="1">32F</option>
                        <option value="2">33F</option>
                        <option value="3">34F</option>
                    </select>
                </div>
            </div>
            <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">选择编号:</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="select2">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
            </div> -->
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell">
                    <div class="weui-cell__hd"><label class="weui-label">项目名称:</label></div>
                    <div class="weui-cell__bd">
                        <span style="font-size:17px;">{pigcms{$village.village_name}</span>
                    </div>
                 </div>
            </div>
            <div class="weui-cell weui-cell_vcode">
                <div class="weui-cell__hd">
                    <label class="weui-label" style="margin-top: 10px; margin-bottom: 10px;">位置/编号:</label>
                </div>
                <div class="weui-cell__bd">
                    <span style="font-size:17px;" style="height: 44px;">{pigcms{$pointArray.room_name}-{pigcms{$pointArray.orientation}</span>
                </div>
                <!-- <div class="weui-cell__ft">
                    <button class="weui-vcode-btn">重新绑定</button>
                </div> -->
            </div>
        </div>  
        </div>
    </div>
    <form action="{pigcms{:U('PropertyService/deal_safety_point')}" method="post" enctype="multipart/form-data" onSubmit="return check();">
    <div class="kk2">
        <div class="width p25">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-radius: 8px; border: 1px #e5e5e5 solid; border-collapse:separate;">
  <tr>
    <td width="14%" height="60" rowspan="2" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-top:none; color:#0e7fe6; font-weight:bold;">检查<br>
      日期</td>
    <td height="30" colspan="5" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-bottom:none; border-top:none; color:#0e7fe6; font-weight:bold;">检&nbsp;&nbsp;&nbsp;查&nbsp;&nbsp;&nbsp;内&nbsp;&nbsp;&nbsp;容</td>
    <td width="14%" height="60" rowspan="2" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none; color:#0e7fe6; font-weight:bold;">检查人</td>
  </tr>
  <tr>
    <td width="12%" height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; color:#0e7fe6; font-weight:bold;">枪头</td>
    <td width="12%" height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; color:#0e7fe6; font-weight:bold;">水带</td>
    <td width="17%" height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; color:#0e7fe6; font-weight:bold;">消防按钮</td>
    <td width="17%" height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; color:#0e7fe6; font-weight:bold;">外框玻璃</td>
    <td width="14%" height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; color:#0e7fe6; font-weight:bold;">灭火器</td>
  </tr>
  <!--<tr>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-top:none; border-left:none;">05-01</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center"  style="font-family:'宋体'; color:#fb4746; border:1px #e5e5e5 solid; border-left:none; border-top:none; font-size:22px;">×</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none;">阳志鹏</td>
  </tr>
  <tr>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-top:none; border-left:none;">05-01</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center"  style="font-family:'宋体'; color:#fb4746; border:1px #e5e5e5 solid; border-left:none; border-top:none; font-size:22px;">×</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none;">阳志鹏</td>
  </tr>
  <tr>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-top:none; border-left:none;">05-01</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center"  style="font-family:'宋体'; color:#fb4746; border:1px #e5e5e5 solid; border-left:none; border-top:none; font-size:22px;">×</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none;">阳志鹏</td>
  </tr>
  <tr>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-top:none; border-left:none;">05-01</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center"  style="font-family:'宋体'; color:#fb4746; border:1px #e5e5e5 solid; border-left:none; border-top:none; font-size:22px;">×</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none;">阳志鹏</td>
  </tr>
  <tr>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-top:none; border-left:none;">05-01</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center"  style="font-family:'宋体'; color:#fb4746; border:1px #e5e5e5 solid; border-left:none; border-top:none; font-size:22px;">×</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none;">阳志鹏</td>
  </tr>
  <tr>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-top:none; border-left:none;">05-01</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center"  style="font-family:'宋体'; color:#fb4746; border:1px #e5e5e5 solid; border-left:none; border-top:none; font-size:22px;">×</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">√</td>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none;">阳志鹏</td>
  </tr>-->
  <tr>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-top:none; border-left:none;">{pigcms{$date[1]}-{pigcms{$date[2]}</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">
        <a href="#myModal" data-toggle="modal">
            <button  class="btn sbold green" id="bt_1" name="status_1" value="0" onClick="getId(this)">√
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </td>
    <td height="30" align="center" style="font-family:'宋体'; color:#fb4746; border:1px #e5e5e5 solid; border-left:none; border-top:none; font-size:18px;">
        <a href="#myModal" data-toggle="modal">
            <button  class="btn sbold green" id="bt_2" name="status_2" value="0" onClick="getId(this)">√
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">
        <a href="#myModal" data-toggle="modal">
            <button  class="btn sbold green" id="bt_3" name="status_3" value="0" onClick="getId(this)">√
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">
        <a href="#myModal" data-toggle="modal">
            <button  class="btn sbold green" id="bt_4" name="status_4" value="0" onClick="getId(this)">√
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">
        <a href="#myModal" data-toggle="modal">
            <button  class="btn sbold green" id="bt_5" name="status_5" value="0" onClick="getId(this)">√
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </td>
    <td width="14%" height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none;">
        <input type="text" style="border: 0; text-align: center; width: 80%; height: 30px" name="name" value="{pigcms{$name}">
    </td>
  </tr>
  <tr id="explain_desc">
      <td height="60" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-top:none;">异常<br/>信息</td>
      <td height="60" colspan="6" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none;">
        <textarea id="point_desc" name="point_desc" cols="30" rows="3" style="resize: none; border:1px #d9d9d9 solid; width:90%; height:40px; margin-top: 5px;"></textarea>
      </td>
    </tr>
    <tr id="explain_image">
      <td height="60" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-top:none;">上传异<br/>常图片</td>
      <td height="60" colspan="6" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none;">
        <!--<ul class="weui-uploader__files" id="uploaderFiles">

        </ul>
        <div>
            <input id="uploaderInput" class="weui-uploader_input" type="file" accept="image/*" multiple="" name="imageUrl[]">
        </div>-->
			
		<div class="weui-cell">
                <div class="weui-cell__bd">
                    <div class="weui-uploader">
                        <div class="weui-uploader__bd">
                            <ul class="weui-uploader__files" id="uploaderFiles">
                            </ul>
                            <div class="weui-uploader__input-box">
                                <input id="uploaderInput" name="imageUrl[]" class="weui-uploader__input" type="file" accept="image/*" multiple="">                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </td>
    </tr>
  <tr>
    <td height="40" colspan="7" style="padding-left:12px; font-size:12px; font-weight:bold;"><span style="color:#fb4746;">说明：</span>每月检查一次，情况正常选√，存在异常选×。</td>
  </tr>  
</table>
    </div>
</div>
    <div class="width xs2">
        <input type="hidden" name="qrcode_id" value="{pigcms{$id}">
        <input type="hidden" name="point_id"  value="{pigcms{$pointArray.id}">
        <input type="hidden" name="point_status" id="point_status">
        <button type="submit" class="bt" style="margin-top: 30px;">提交记录</button>        
        <if condition="$name neq null">
            <a href="{pigcms{:U('check_safety_record')}"><div class="bt" style="margin-top: 5px;">巡检记录查询</div></a>
        </if>
        <!-- <if condition="$name neq null">
            <a href="{pigcms{:U('Pay/wx_recharge')}"><div class="bt" style="margin-top: 5px;">支付测试</div></a>
        </if> -->
        <!-- <if condition="$name neq null">
        <a href="{pigcms{:U('check_record_chart_week')}"><div class="bt" style="margin-top: 5px;">巡检周报表</div></a>
        </if>
        <if condition="$name neq null">
        <a href="{pigcms{:U('check_record_chart_month')}"><div class="bt" style="margin-top: 5px;">巡检月报表</div></a>
        </if> -->
        <!-- <if condition="$name neq null">
        <a href="{pigcms{:U('send_record_msg1')}"><div class="bt" style="margin-top: 5px;">推送消息</div></a>
        </if> -->
    </div>
</form>
 
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">
                    消防设备异常备注
                </h4>
            </div>
            <form id="form_data">
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-4">异常信息:</label>
                    <div class="col-md-8">                           
                        <textarea id="show_desc" name="show_desc" cols="30" rows="5" style="resize: none;  border:1px #e5e5e5 solid; width: 95%; margin-top: 10px;"></textarea>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-4">附件:</label>
                    <div class="col-md-8">
                        <input type="file" id="image" name="image">
                    </div>
                </div>
            </div> -->
            <div class="modal-footer">                               
                <button type="button" onClick="add_info()" class="btn btn-primary">提交</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->    
</div>
    
    </div>
</div>
<div style="width:100%; height:60px; text-align:center; line-height:60px; color:#8a8a8a; font-size:14px;">汇得行（中国）集团有限公司</div>
<script type="text/javascript">
    // $(function () {
    //     var imgUpload = new ImgUpload({
    //         fileInput: "#uploaderInput",
    //         container: "#upload_list",
    //         countNum: "#uploadNum",
    //         url:"{:U('ajaxImgUpload')}"
    //     });
    // });


    document.addEventListener('touchstart',function(){},false);

    $(function(){
        var tmpl = '<li class="weui-uploader__file" style="background-image:url(#url#)"></li>',
            $gallery = $("#gallery"), $galleryImg = $("#galleryImg"),
            $uploaderInput = $("#uploaderInput"),
            $uploaderFiles = $("#uploaderFiles")
            ;

        $uploaderInput.on("change", function(e){
            var src, url = window.URL || window.webkitURL || window.mozURL, files = e.target.files;
            for (var i = 0, len = files.length; i < len; ++i) {
                var file = files[i];
                console.log(file);
                if (url) {
                    src = url.createObjectURL(file);
                } else {
                    src = e.target.result;
                }

                $uploaderFiles.append($(tmpl.replace('#url#', src)));
            }
        });
        $uploaderFiles.on("click", "li", function(){
            $galleryImg.attr("style", this.getAttribute("style"));
            $gallery.fadeIn(100);
        });
        $gallery.on("click", function(){
            $gallery.fadeOut(100);
        });


    });
</script>

<script>

    //获取弹出模态框的button的id值
    function getId(id) {
        //var id = id.id;
        //alert(id);
         window.id=id.id;
         change();
    } 

    //将√变成×
    function change() {
        
        //alert(id);
        // alert(window.id);
        var num =  document.getElementById(window.id).value;
        if (num == 0) {
            document.getElementById(window.id).innerHTML="x";
            document.getElementById(window.id).value="1";
        } else {
            document.getElementById(window.id).innerHTML="√";
            document.getElementById(window.id).value="0";
        }   
        // document.getElementById(window.id).innerHTML="x";
        // document.getElementById(window.id).value="1";            
    } 

    function get_point_status() {
        var point_status = 'status_1' +'-'+ document.getElementById('bt_1').value + ',' + 'status_2' +'-'+ document.getElementById('bt_2').value + ',' +'status_3' +'-'+ document.getElementById('bt_3').value + ',' +'status_4' +'-'+ document.getElementById('bt_4').value + ',' +'status_5' +'-'+ document.getElementById('bt_5').value;
       // alert(point_status);

        document.getElementById('point_status').value = point_status;

    }   
 
    // 将数据展示到表单
    function add_info(){

        //获取模态框数据
        var show_desc  = document.getElementById('show_desc').value;
        // var image = document.getElementById('image').value;
        // alert(point_desc);
        // alert(image);

        if (point_desc!=='') {
            $("#explain_desc").show();
            $("#explain_image").show();
            $('#point_desc').val(show_desc);
            change();
            get_point_status();
        }

        // if (image!=='') {
        //     $("#explain_image").show();
        //     $('#show_image').val(image);
        // }        
        
        //隐藏模态框
        $('#myModal').modal('hide');              
    }

    function check() {
        var name = $("input[name='name']").val();
        if (name == "" || name.length == 0) {
            alert("请输入姓名！");
            return false;
        } else {
            return true;
        }
    }
    
</script>

</body>
</html>
