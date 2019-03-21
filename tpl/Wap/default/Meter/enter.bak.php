<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- head 中 -->
    <title>在线抄表</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
    <style>
        [v-cloak] {
            display: none;
        }

        header {
            background-color: #3A90FF;
            width: 100%;
            color: #ffffff;
            font-weight: 100;
        }
    </style>
</head>
<body>

<form id="app" action="{pigcms{:U('add_data')}" method="post">
    <header style="padding:10px 0px;text-align: center">
        <h3>当前公司：{pigcms{$meter_info.tenantname}</h3>
    </header>
    <div class="weui-cells">
                <div class="weui-cell weui-cell_select weui-cell_select-before">
                    <div class="weui-cell__bd">
                        <p>抄送月份</p>
                    </div>

                    <div class="weui-cell__hd">
                        <select class="weui-select" name="month" v-model="selected_month">
                            <option value="1">1月</option>
                            <option value="2">2月</option>
                            <option value="3">3月</option>
                            <option value="4">4月</option>
                            <option value="5">5月</option>
                            <option value="6">6月</option>
                            <option value="7">7月</option>
                            <option value="8">8月</option>
                            <option value="9">9月</option>
                            <option value="10">10月</option>
                            <option value="11">11月</option>
                            <option value="12">12月</option>
                        </select>
                    </div>
                    <div class="weui-cell__bd">
                        <p>设备类型</p>
                    </div>
                    <div class="weui-cell__ft">
                        <p>{pigcms{$meter_info['meter_type_desc']}</p>
                    </div>
                </div>

        <div class="weui-cell">
            <div class="weui-cell__bd">
                单元号
            </div>
            <div class="weui-cell__ft">
                {pigcms{$meter_info.meter_floor}
            </div>
            <div class="weui-cell__bd">
                &nbsp;&nbsp;设备编号
            </div>
            <div class="weui-cell__ft">
                <a href="{pigcms{:U('meter_record',array('meter_code'=>$meter_info['meter_code'],'meter_hash'=>$meter_info['meter_hash']))}">
                    {pigcms{$meter_info.meter_code}
                </a>
            </div>

        </div>

<!--        <div class="weui-cell">-->
<!--            <div class="weui-cell__bd">-->
<!--                计费类型-->
<!--            </div>-->
<!--            <div class="weui-cell__ft">-->
<!--                {pigcms{$meter_info['price_type_desc']}-->
<!--            </div>-->
<!--            <div class="weui-cell__bd">-->
<!--                &nbsp;&nbsp;倍率-->
<!--            </div>-->
<!--            <div class="weui-cell__ft">-->
<!--                <php>echo sprintf("%.2f", $meter_info['rate'])</php>-->
<!--            </div>-->
<!--        </div>-->
    </div>
    <div class="weui-cells__title">往期总用量（上一月）：</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" style="color:#666;font-size: 1.5em;" placeholder="请输入文本"
                       v-model="last_month_total" disabled="disabled">
            </div>
            <div class="weui-cell__ft">
                <p style="vertical-align: bottom">{pigcms{:explode('/',$meter_info['unit'])[1]}</p>
            </div>
            <div class="weui-cell__ft" @click="modal_update_cousume()">
                <button class="weui-vcode-btn" type="button">修改</button>
            </div>
        </div>
    </div>
    <div class="weui-cells__title">本月总用量：</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input style="font-size: 1.5em;" type="number" class="weui-input" type="text" name="total_consume"
                       v-model="current_month_total" placeholder="请输入用量" >
            </div>
            <div class="weui-cell__ft">
                <p style="vertical-align: bottom">{pigcms{:explode('/',$meter_info['unit'])[1]}</p>
            </div>
        </div>
    </div>

    <div class="weui-cells__tips" style="text-align: right">
        本月共使用
        <span style="font-size: 1.5em">{{get_consume()>0?get_consume():0}}</span>

        {pigcms{:explode('/',$meter_info['unit'])[1]}
        <input type="hidden" v-bind:value="get_consume()">
        <input type="hidden" name="meter_hash" value="{pigcms{:I('get.meter_hash')}">
        <input type="hidden" name="price_type_id" value="{pigcms{$meter_info.price_type_id}">
        <input type="hidden" name="meter_type_id" value="{pigcms{$meter_info.meter_type_id}">
        <input type="hidden" name="tid" value="{pigcms{$meter_info.tid}">
        <input type="hidden" name="rate" value="{pigcms{$meter_info.rate}">
        <input type="hidden" name="last_total_consume" value="{pigcms{$meter_info.last_cousume}">
        <input type="hidden" name="tenantname" value="{pigcms{$meter_info.tenantname}">
    </div>

    <div class="weui-footer weui-footer_fixed-bottom" >
        <div class="weui-btn-area">
            <button class="weui-btn weui-btn_primary" type="button" @click="submit($event)" href="javascript:"
                    style="background-color: #3A90FF;width: 45%;float: left">上报数据
            </button>
            <a style="width: 45%;" class="weui-btn weui-btn_default" type="button"  href="{pigcms{:U('meter_record2')}"
            >
                抄表记录
            </a>
        </div>

    </div>
</form>

<!-- body 最后 -->
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="./static/Wap/water/js/vue.min.js"></script>
<script>
    var model = new Vue({
        el: '#app',

        data: {
            true_month: '{pigcms{:intval(date("m"))}',//现实真实月份
            selected_month:'{pigcms{:intval(date("m"))}',//当前选择月份
            last_month_total: '{pigcms{$meter_info.last_cousume}' || 0,
            current_month_total: "",
            meter_hash:"{pigcms{:I('get.meter_hash')}",
            record:0
        },
        //构造函数
        mounted: function () {
            this.set_data();//设置当前月份的用量 如果已经抄表了的话
        },
        methods: {

            //获取数据
            get: function (url, data) {
                var d;
                $.ajax({
                    url: url,
                    data: data || {},
                    type: 'get',
                    dataType: 'json',
                    async: false,
                    success: function (re) {
                        d = re;
                    }
                })
                return d;
            },
            get_consume: function () {
                var consume = this.current_month_total - this.last_month_total;
                return consume ;
            },

            set_data: function (e) {
                var re = this.get('{pigcms{:U("get_month_record")}',{meter_hash:this.meter_hash,month:this.selected_month});
                if(re.err===0 && re.data){
                    this.last_month_total = re.data.last_total_consume;
                    this.current_month_total = re.data.total_consume;
                    this.record_id  = re.data.id;
                }

            },
            submit: function (e) {
                var consume = this.get_consume();
                if (consume < 0) {
                    $.alert("请检查输入用量是否正确");
                    return false;
                }
                $(e.target).parents('form').submit();
            },
            modal_update_cousume:function(){
                let self = this;
                let default_val = this.last_month_total;
                $.prompt({
                    title: '修改往期总用量',
                    input: default_val,
                    empty: false, // 是否允许为空
                    onOK: function (input) {
                       self.update_cousume(input);
                    },
                    onCancel: function () {
                        //点击取消
                    }
                });
            },

            update_cousume:function(set_val){
                var self = this;
                var params = {
                    meter_hash:self.meter_hash,
                    set_val:set_val,
                    record_id:self.record_id
                }
                var re = this.get('{pigcms{:U("update_last_cousume")}',params);
                if(re.err===0){
                    self.last_month_total = set_val;
                }else{
                    alert("发生错误");
                }
            }

        },
        watch:{
            selected_month:function(){
                this.set_data();
            }
        }

    });


    /**
     * 编辑硬件码
     * @param el 修改标签
     * @param code 硬件码
     * @param tid 楼层ID
     * @param sign 设备类型
     */
    function edit_device_code(el,code,tid,sign){
        var old_text = $(this).text();
        $.prompt({
            title: '硬件编号',
            text: '请输入硬件编号',
            input: code||"请输入硬件编号",
            empty: false, // 是否允许为空
            onOK: function (new_code) {
                $.ajax({
                    url:'{pigcms{:U("edit_device_code")}',
                    type:'post',
                    data:{device_code:new_code,tid:tid,sign:sign},
                    dataType:'json',
                    success:function(re){
                        if(re.err===0){
                            $(el).text(new_code);

                        }else{

                            alert('发生错误');
                        }
                        console.log(re);
                    }
                })
            },
            onCancel: function () {
                //点击取消
            }
        });

    }
</script>
</body>
</html>