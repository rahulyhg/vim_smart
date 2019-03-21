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
<form id="app" v-cloak action="{pigcms{:U('add_data')}" method="post">
    <header style="padding:10px 0px;text-align: center">
        <h3>当前公司：{pigcms{:user_info()['company_name']}</h3>
    </header>
    <div class="weui-cells">
                <div class="weui-cell weui-cell_select weui-cell_select-before">
                    <div class="weui-cell__bd">
                        <p>抄送月份</p>
                    </div>

                    <div class="weui-cell__hd">
                        <select class="weui-select" name="select2" @change="set_data($event)">
                            <option value="1">1月</option>
                            <option value="2">2月</option>
                            <option value="3">3月</option>
                            <option value="4">4月</option>
                            <option value="5">5月</option>
                            <option value="6">6月</option>
                            <option value="7">7月</option>
                            <option value="8" selected="selected">8月</option>
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
                        <p>{pigcms{$rinfo['pdesc']}</p>
                    </div>
                </div>



        <div class="weui-cell">
            <div class="weui-cell__bd">
                设备编号
            </div>
            <div class="weui-cell__ft">
                <span id="edit_code" onclick="edit_device_code(this,'{pigcms{$rinfo.device_code}','{pigcms{$rinfo.tid}','{pigcms{$rinfo.sign}')" >
                    {pigcms{$rinfo.device_code}
                </span>
                <span onclick="$('#edit_code').click()" >[修改]</span>
            </div>

        </div>
        <div class="weui-cell">

            <div class="weui-cell__bd">
                单元号
            </div>
            <div class="weui-cell__ft">
                {pigcms{$rinfo.tdesc}
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__bd">
                计费类型
            </div>
            <div class="weui-cell__ft">
                {pigcms{$rinfo.desc}
            </div>
            <div class="weui-cell__bd">
                &nbsp;&nbsp;单价
            </div>
            <div class="weui-cell__ft">
                <php>echo sprintf("%.2f", $rinfo['unit_price'])</php>
            </div>
        </div>
    </div>
    <div class="weui-cells__title">往期总用量（上一月）：</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" style="color:#666;font-size: 1.5em;" placeholder="请输入文本"
                       v-model="last_month_total" disabled="disabled">
            </div>
            <div class="weui-cell__ft">
                <p style="vertical-align: bottom">{pigcms{:explode('/',$rinfo['unit'])[1]}</p>
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
                <p style="vertical-align: bottom">{pigcms{:explode('/',$rinfo['unit'])[1]}</p>
            </div>
        </div>
    </div>

    <div class="weui-cells__tips" style="text-align: right">
        本月共使用
        <span style="font-size: 1.5em">{{get_consume()}}</span>
        <input type="hidden" v-bind:value="get_consume()" name="consume">
        <input type="hidden" value="{pigcms{:I('get.sign')}" name="sign">
        <input type="hidden" value="{pigcms{:I('get.tid')}" name="tid">
        <input type="hidden" value="{pigcms{$rinfo.tdesc}" name="tdesc">
        <input type="hidden" value="{pigcms{:I('get.usernum')}" name="usernum">
        {pigcms{:explode('/',$rinfo['unit'])[1]}
    </div>

    <div class="weui-footer weui-footer_fixed-bottom" v-show="true_month==this_month">
        <div class="weui-btn-area">
            <button class="weui-btn weui-btn_primary" type="button" @click="submit($event)" href="javascript:"
                    style="background-color: #3A90FF">上报数据
            </button>
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
            this_month:'{pigcms{:intval(date("m"))}',//当前选择月份
            last_month_total: "",
            current_month_total: "",
            usernum: "{pigcms{:I('get.usernum')}",
            type: "{pigcms{:I('get.sign')}",
            tid:"{pigcms{:I('get.tid')}"
        },
        //构造函数
        mounted: function () {
            this.last_month_total = '{pigcms{$last_month_total}' || 0;
            this.current_month_total = '{pigcms{$current_month_total}' || "";
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
                return consume > 0 ? consume : 0;
            },

            set_data: function (e) {
                var self = this;
                var month = $(e.target).val();
                this.this_month = month;
                var usernum = this.usernum;
                var type = this.type;
                var tid = this.tid;
                var static_m = month;
                var get_data = function (m) {
                    //上个月的总量
                    var ltc = 0;
                    //指定月份的总量
                    var tc = 0;
                    var res = self.get('{pigcms{:U("ajax_get_month_info")}', {month: m, usernum: usernum, sign: type,tid:tid});
                    if (res.data && res.data.total_consume !== undefined && res.data.consume !== undefined) {
                        ltc = res.data.total_consume - res.data.consume || 0;
                        tc = res.data.total_consume || 0;
                    } else {
                        //如果指定月份取不到数据，尝试取上一个月份的数据，并将上一个的总用量设为指定月份上月的总量
                        if (static_m == month) {
                            static_m -= 1;
                            var lastres = get_data(static_m);
                            ltc = lastres.tc;
                        }
                    }
                    return {ltc: ltc, tc: tc};
                }
                var res = get_data(month);

                this.last_month_total = res.ltc;
                this.current_month_total = res.tc;
            },
            submit: function (e) {
                var consume = this.get_consume();
                if (consume <= 0) {
                    $.alert("请检查输入用量是否正确");
                    return false;
                }
                $(e.target).parents('form').submit();
            }
        },

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