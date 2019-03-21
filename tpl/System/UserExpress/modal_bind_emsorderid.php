<style>
    .modal-content{
        width: 800px;
        height: 710px;
    }
	.form-group {
    margin-bottom: 0px;
	}
	.modal-body {
		position: relative;
		padding: 10px 15px 0px 15px;
	}
</style>
<div class="modal-header" style="clear:both;">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">完善资料</h4>
</div>
<div style="width:100%;">
<div id="left" style="width: 45%;float: left; border:1px #32c5d2 solid; padding-bottom:30px; margin-left:3%; margin-top:20px;">
	<div style="width:100%; height:35px; line-height:35px; background-color:#32c5d2; color:#FFFFFF;"><span style="padding-left:8px;">寄件人信息</span></div>
    <div class="modal-body">
        <div class="form-group">
            <span style="height: 34px;line-height: 34px;">寄件人姓名 : </span>
            <input type="text" class="form-control one" id="billing_name_{pigcms{$orderArr.order_id}" value="{pigcms{$orderArr.bad_name}" style="width: 100%;" placeholder="寄件人姓名">
        </div>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <span style="height: 34px;line-height: 34px;">寄件人手机号 : </span>
            <input type="text" class="form-control one"  id="billing_phone_{pigcms{$orderArr.order_id}" value="{pigcms{$orderArr.bad_phone}" style="width: 100%;" placeholder="寄件人手机号">
        </div>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <span style="height: 34px;line-height: 34px;">寄件人地区 : </span>
            <input type="text" class="form-control one" id="billing_position_{pigcms{$orderArr.order_id}" value="湖北省 武汉市 江汉区" disabled="disabled" style="width: 100%;" >
        </div>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <span style="height: 34px;line-height: 34px;">寄件人详细地址 : </span>
            <input type="text" class="form-control one"  id="billing_detail_{pigcms{$orderArr.order_id}" value="{pigcms{$orderArr.bad_detail}" style="width: 100%;" placeholder="寄件人详细地址">
        </div>
    </div>
</div>

<div id="right" style="width: 45%;float: right; border:1px #32c5d2 solid; padding-bottom:30px; margin-right:3%; margin-top:20px;">
	<div style="width:100%; height:35px; line-height:35px; background-color:#32c5d2; color:#FFFFFF;"><span style="padding-left:8px;">收件人信息</span></div>
    <div class="modal-body">
        <div class="form-group">
            <span style="height: 34px;line-height: 34px;">收件人姓名 : </span>
            <input type="text" class="form-control one" id="shipping_name_{pigcms{$orderArr.order_id}"  value="{pigcms{$orderArr.sad_name}" style="width: 100%;" placeholder="收件人姓名">
        </div>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <span style="height: 34px;line-height: 34px;">收件人手机号 : </span>
            <input type="text" class="form-control one"  id="shipping_phone_{pigcms{$orderArr.order_id}" value="{pigcms{$orderArr.sad_phone}" style="width: 100%;" placeholder="收件人手机号">
        </div>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <span style="height: 34px;line-height: 34px;">收件人地区 : </span><br/>
            <select  name="province_id" id="province_id_{pigcms{$orderArr.order_id}">
                <if condition="isset($orderArr['province_id'])"><option value="{pigcms{$orderArr.province_id}">{pigcms{$orderArr.province_id}</option>
                <else /><option >请选择</option>
                </if>
                <foreach name="data" item="vo">
                    <option >{pigcms{$vo.name}</option>
                </foreach>
            </select>
            <select  name="city_id" id="city_id_{pigcms{$orderArr.order_id}">
                <if condition="isset($orderArr['city_id'])"><option value="{pigcms{$orderArr.city_id}">{pigcms{$orderArr.city_id}</option>
                    <else /><option >请选择</option>
                </if>
            </select>
            <select  name="area_id" id="area_id_{pigcms{$orderArr.order_id}">
                <if condition="isset($orderArr['area_id'])"><option value="{pigcms{$orderArr.area_id}">{pigcms{$orderArr.area_id}</option>
                    <else /><option >请选择</option>
                </if>
            </select>
        </div>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <span style="height: 34px;line-height: 34px;">收件人详细地址 : </span>
            <input type="text" class="form-control one" id="shipping_detail_{pigcms{$orderArr.order_id}" value="{pigcms{$orderArr.sad_detail}" style="width: 100%;" placeholder="收件人详细地址">
        </div>
    </div>
</div>
<div style="clear:both"></div>
</div>

<div style="width:100%;">
<div id="left" style="width: 94#; border:1px #32c5d2 solid; padding-bottom:30px; margin-left:3%; margin-right:3%; margin-top:20px;">
	<div style="width:100%; height:35px; line-height:35px; background-color:#32c5d2; color:#FFFFFF;"><span style="padding-left:8px;">快件信息</span></div>
    <div style="float:left; width:50%;">
	<div class="modal-body">
        <div class="form-group">
            <label for="bar_code" style="height: 34px;line-height: 34px;">运单号</label>
            <input type="text" class="form-control bar_code" value="{pigcms{$orderArr.ems_order_id}" placeholder="运单号" style="width:100%;">
        </div>
    </div>
	</div>
	
	<div style="float:right; width:50%;">
	<div class="modal-body" >
        <div class="form-group">
            <span style="height: 34px;line-height: 34px;">快件类型 : </span>
            <select class="weui_select" name="goods_type_name" id="goods_type_name_{pigcms{$orderArr.order_id}" style="width: 100%; height:32px; line-height:32px; border:1px #c2cad8 solid; margin-top:6px; padding-left:13px;">
                <option value="" >请选择</option>
                <option value="数码" <if condition="$orderArr['goods_type_name'] eq '数码' ">selected='selected'</if>>数码</option>
                <option value="文件" <if condition="$orderArr['goods_type_name'] eq '文件' ">selected='selected'</if>>文件</option>
                <option value="服饰" <if condition="$orderArr['goods_type_name'] eq '服饰' ">selected='selected'</if>>服饰</option>
                <option value="日用品" <if condition="$orderArr['goods_type_name'] eq '日用品' ">selected='selected'</if>>日用品</option>
                <option value="其他" <if condition="$orderArr['goods_type_name'] eq '其他' ">selected='selected'</if>>其他</option>
            </select>
        </div>
    </div>
	</div>
	<div style="clear:both"></div>
	
</div>

</div>

<div style="float:right; margin-right:8px;">
<div style="width:30%;clear:both; padding-top:25px; float:left; margin-right:20px;">
    <a  type="button" class="btn green-steel print_pdf" id="ssss_{pigcms{$orderArr.order_id}">提交</a>
</div>
<div style="float:left; margin-left:5%; padding-top:25px; width:30%;">
<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>
</div>
<div style="clear:both"></div>
<script type="text/javascript">
    var biaoji = "{pigcms{$orderArr.order_id}";
    var json_data = app_json.json_data;
    $(function(){
        $("select#province_id_"+biaoji).change(function(){
            $("#city_id_"+biaoji).empty();
            $("#city_id_"+biaoji).append("<option value='0'>请选择</option>");
            $("#area_id_"+biaoji).empty();
            $("#area_id_"+biaoji).append("<option value='0'>请选择</option>");
            var province_id = $(this).val();
            for (var vo in json_data){
                var row = json_data[vo];
                if (row['name'] == province_id){
                    for (var son in row) {
                        var row_s = row[son];
                        for (var son_g in row_s) {
                            var row_g = row_s[son_g];
                            if (row_g['name']) {
                                var str = "<option value='"+row_g.name+"'>"+row_g.name+"</option>";
                                $("#city_id_"+biaoji).append(str);
                            }

                        }
                    }
                }

            }
        });

        $("select#city_id_"+biaoji).change(function(){
            $("#area_id_"+biaoji).empty();
            $("#area_id_"+biaoji).append("<option value='0'>请选择</option>");
            var tid = $(this).val();
            var province_id = $("#province_id_"+biaoji).val();
            for (var vo in json_data){
                var row = json_data[vo];
                if (row['name'] == province_id) {
                    for (var son in row) {
                        var row_s = row[son];
                        for (var g_son in row_s) {
                            var row_g = row_s[g_son];
                            if (row_g['name'] == tid) {
                                for (var row_z in row_g['area']) {
                                    var row_zz = row_g['area'][row_z];
                                    var str = "<option value='"+row_zz+"'>"+row_zz+"</option>";
                                    $("#area_id_"+biaoji).append(str);
                                }
                            }
                        }
                    }

                }
            }
        });
    })

</script>
