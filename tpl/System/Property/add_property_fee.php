<extend name="./tpl/System/Public_news/base_form.php"/>
<!--引入日历插件样式 -->
<block name="body">
    <!-- BEGIN CONTENT -->
    <form action="__SELF__" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
        <div class="portlet-body">
            <!-- BEGIN FORM-->

            <div class="form-body">
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">选择期数
                    </label>
                    <div class="col-md-9">
                        <select id="project_id" class="form-control" >
                            <volist name="project_list" id="vo">
                                <option value="{pigcms{$vo['pigcms_id']}" <if condition="$project_id eq $vo['pigcms_id']">selected="selected"</if>>
                                {pigcms{$vo['desc']}
                                </option>
                            </volist>
                        </select>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">门牌号
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" id="room_name" value="" name="room_name" class="form-control" autocomplete="off" disableautocomplete>
                    </div>
                </div>
                <div id="room_info" class="form-group form-md-line-input" style="display: none">
                    <label class="col-md-2 control-label" for="form_control_1" >房屋信息
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <span id="room_info_id"></span>
                    </div>
                </div>
                <div id="user_info" class="form-group form-md-line-input" style="display: none">
                    <label class="col-md-2 control-label" for="form_control_1">业主信息
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <span id="user_info_id"></span>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">缴费类型
                    </label>
                    <div class="col-md-9">
                        <select name="otherfee_type_id" id="otherfee_type_id" class="form-control">
                            <option value="0">请选择</option>
                            <option value="property">物业服务费</option>
                            <option value="carspace">包月泊位费</option>
                            <volist name="type_list" id="vo">
                                <option value="{pigcms{$vo.otherfee_type_id}">{pigcms{$vo.otherfee_type_name}</option>
                            </volist>
                        </select>
                    </div>
                </div>
                <div id="property" style="display: none;">
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1">物业费到期时间
                        </label>
                        <div class="col-md-9">
                            <span id="property_time"></span>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1">付款预付月数
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                            <select name="property_mouth" class="form-control" id="property_mouth">
                                <option value="0" selected="selected">请选择</option>
                                <for start="1" end="24"  name="i" >
                                    <option value="{pigcms{$i}" >{pigcms{$i}个月</option>
                                </for>
                            </select>
                            <span class="required">如果没有设置过物业费到期时间，请先调整到期时间</span>
                        </div>
                    </div>
                    <div id="property_pay" style="display: none;">
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">单价
                            </label>
                            <div class="col-md-9" >
                                <label id="property_unit"></label>元每平方米每月
                            </div>
                        </div>
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">应付款
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6" >
                                <input type="text"   id="property_recive" value="" name="property_recive" class="form-control">元
                            </div>
                        </div>
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">实付款
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9" >
                                <input type="text"   id="property_true" value="" name="property_true" class="form-control">
                            </div>
                        </div>
                </div>
                </div>
                <div id="carspace" style="display: none;">
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1">选择车位
                        </label>
                        <div class="col-md-9">
                            <select name="carspace_id" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1">付款预付月数
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                            <select name="carspace_mouth" class="form-control" id="carspace_mouth">
                                <option value="0" selected="selected">请选择</option>
                                <for start="1" end="24"  name="i" >
                                    <option value="{pigcms{$i}" >{pigcms{$i}个月</option>
                                </for>
                            </select>
                        </div>
                    </div>
                    <div id="carspace_pay" style="display: none;">
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">单价
                            </label>
                            <div class="col-md-9" >
                                <label id="carspace_price"></label>元每月
                            </div>
                        </div>
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">应付款
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9" >
                                <label id="carspace_recive"></label>元
                            </div>
                        </div>
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">实付款
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9" >
                                <input type="text"   id="carspace_true" value="" name="carspace_true" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="other_fee" style="display: none;">
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1" id="fee_receive">应收
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <div class="md-checkbox-list">
                            <input type="text" name="fee_receive" value=""  class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1" id="fee_true">实收
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <div class="md-checkbox-list">
                            <input type="text" name="fee_true" value=""  class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">缴费时间
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="fee_time"  id="fee_time" value="" class="form-control" autocomplete="off" disableautocomplete>
                    </div>
                </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">缴费方式
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <select name="type" class="form-control">
                            <option value="1">线上支付</option>
                            <option value="2">现金</option>
                            <option value="3">转账</option>
                            <option value="4">POS单</option>
                            <option value="5">现金缴款单</option>
                        </select>

                        </div>
                    </div>

                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">备注
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9" >
                        <textarea    value="" name="remark" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <button type="button" id="handInput" class="btn green">确认提交</button>
                        <!--<button type="reset" class="btn default" onclick="window.location.href='{pigcms{:U('getotherfee_list')}'">返 回</button>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-danger" style="display: none">
            <strong>错误！</strong><span></span></div>

        <div class="alert alert-success" style="display: none">
            <strong>成功！</strong><span></span></div>
        <!-- END FORM-->
        </div>
    </form>
    <link rel="stylesheet" href="/Car/Admin/Public/css/jquery.datetimepicker.css">
    <script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
    <script src="/static/js/jquery.bigautocomplete.js"></script>
    <link rel="stylesheet" href="/static/css/jquery.bigautocomplete.css">
    <script type='text/javascript'>
        //开启日历插件
        $("#handInput").click(function(){
            var tip='添加缴费成功！';
            $.ajax({
                url:'{pigcms{:U("Property/ajax_in_fee")}',
                type:'post',
                data:$('#form_sample_1').serialize(),
                dataType:'json',
                success:function (res) {
                    $('#property').css('display','none');
                    $('#carspace').css('display','none');
                    $('#other_fee').css('display','none');
                    $("textarea[name='remark']").val('');
                    $("#room_name").val('');
                    $('#otherfee_type_id').val("1");
                    $('#room_info').css('display','none');
                    $('#user_info').css('display','none');
                    if(res.err == 0){
                        $(".input-group input").val('');
                        $(".alert-danger").hide();
                        $(".alert-success span").html(tip);
                        $(".alert-success").slideDown();
                        $("#in_database tr:eq(1)").before(res.data);

                        setTimeout(function(){
                            $(".alert-success").slideUp();
                        },5000);
                    }else{
                        $(".alert-success").hide();
                        $(".alert-danger span").html(res.msg);
                        $(".alert-danger").slideDown();

                        setTimeout(function(){
                            $(".alert-danger").slideUp();
                        },5000);

                    }

                }
            });
        });
        $.datetimepicker.setLocale('ch');
        $('#fee_time').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-n-j",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'{pigcms{:date('Y-n-j')}',//设置开始时间
            theme:'form-control',
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false,    //关闭选择今天按钮
            scrollMonth: false//禁止滑动
        });
        $('#otherfee_type_id').change(function(){
            var p1=$(this).children('option:selected').val();
            var room_name=$("input[name='room_name']").val();
            $.ajax({
                url:"{pigcms{:U('Property/ajax_otherfee_type')}",
                data:{'otherfee_type_id':p1,'room_name':room_name},
                type: "POST",
                dataType: 'json',
                success:function(res){
                    if(res.type == 'property'){
                        $('#property').css('display','block');
                        $('#carspace').css('display','none');
                        $('#other_fee').css('display','none');
                        $('#property_time').html(res.data.property_endtime);
                    }else if(res.type=='carspace'){
                        $('#property').css('display','none');
                        $('#carspace').css('display','block');
                        $('#other_fee').css('display','none');
                        $("select[name='carspace_id']").html('');
                        for ( var i = 0; i <res.data.length; i++){
                            $("select[name='carspace_id']").append('<option value="'+res.data[i].pigcms_id+'">'+res.data[i].carspace_number+'\\t到期日:'+res.data[i].carspace_endtime);
                        }
                    } else{
                        $('#property').css('display','none');
                        $('#carspace').css('display','none');
                        $('#other_fee').css('display','block');
                        if(res.data.type=='1'){
                            $('#fee_receive').html('应收<span class="required">*</span>');
                            $('#fee_true').html('实收<span class="required">*</span>');
                        }else{
                            $('#fee_receive').html('实收<span class="required">*</span>');
                            $('#fee_true').html('已退<span class="required">*</span>');
                        }
                    }
                }
            });
        });
        $('#project_id').change(function(){
            var p1=$(this).children('option:selected').val();
            $.ajax({
                type:"GET",
                url:"{pigcms{:U('Property/ajax_change')}",
                data:{'project_id':p1},
                async:false
            });
        });
        $("#room_name").bigAutocomplete({
            url:'{pigcms{:U('Property/ajax_room_list')}',
            callback:function(data){
                $('#property').css('display','none');
                $('#carspace').css('display','none');
                $('#other_fee').css('display','none');
                $('#otherfee_type_id').val("0");
                $('#room_info').css('display','block');
                $('#user_info').css('display','block');
                $('#room_info_id').html('面积:'+data.result.roomsize+',所属园区:'+data.result.desc);
                $('#user_info_id').html('姓名:'+data.result.user_info.name+',电话:'+data.result.user_info.phone+',身份证号:'+data.result.user_info.usernum);
                $.ajax({
                    type:"GET",
                    url:"{pigcms{:U('Property/ajax_change')}",
                    data:{'rid':data.result.id},
                    async:false
                });
            }
        });
        $('#property_mouth').change(function(){
            var p1=$(this).children('option:selected').val();
            var room_name=$("input[name='room_name']").val();
            $.ajax({
                url:"{pigcms{:U('Property/ajax_fee_get')}",
                data:{'month':p1,'room_name':room_name,'type':'property'},
                type: "POST",
                dataType: 'json',
                success:function(res){
                    $('#property_pay').css('display','block');
                    $('#property_unit').html(res.unit);
                    $('#property_recive').val(res.pay_recive);
                    $('#property_true').val(res.pay_true);
                }
            });
        });
        $('#carspace_mouth').change(function(){
            var p1=$(this).children('option:selected').val();
            var room_name=$("select[name='carspace_id']").children('option:selected').val();
            $.ajax({
                url:"{pigcms{:U('Property/ajax_fee_get')}",
                data:{'month':p1,'room_name':room_name,'type':'carspace'},
                type: "POST",
                dataType: 'json',
                success:function(res){
                    $('#carspace_pay').css('display','block');
                    $('#carspace_price').html(res.unit);
                    $('#carspace_recive').html(res.pay_recive);
                    $('#carspace_true').val(res.pay_true);
                }
            });
        })



    </script>
</block>