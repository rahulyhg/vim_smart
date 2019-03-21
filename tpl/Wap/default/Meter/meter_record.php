<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- head 中 -->
    <title>抄表记录</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
    <style>
        [v-cloak] {
            display: none;
        }
        .hash_highlight{
            background-color: #fff0e2;
        }
    </style>
</head>
<body>
<div id="meter_record" v-cloak>
<header style="padding:10px 0px;text-align: center">
    <div class="weui-cell weui-cell_select weui-cell_select-before">
        <div class="weui-cell__hd">
            <select class="weui-select" name="select2">
                <option>{pigcms{$ym}</option>
            </select>
        </div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" v-model="meter_code" placeholder="请输入设备码">
        </div>
    </div>
</header>

    <div v-for="(item,index) in list_order" v-show="filter(item)" v-bind:class="highlight(item)" class="weui-form-preview">
        <div class="weui-form-preview__hd">
            <label class="weui-form-preview__label">{{item.meter_code}} （{{item.meter_floor}})</label>
            <em class="weui-form-preview__value">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <span v-if="!item.is_record" style="color:darkorange">未抄录</span>
            </em>
        </div>
        <div class="weui-form-preview__bd">
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">上月止码</label>
                <span class="weui-form-preview__value">{{item.last_total_consume}}</span>
            </div>
            <template v-if="item.is_record">
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">本月止码</label>
                    <span class="weui-form-preview__value">{{item.total_consume}}</span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">用量</label>
                    <span class="weui-form-preview__value">
                        {{get_consume(item)}}
                    </span>
                </div>

                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">抄录人</label>
                    <span class="weui-form-preview__value">{{item.realname}}（{{item.create_time_desc}}）</span>
                </div>

            </template>
        </div>
    </div>
</div>


<!-- body 最后 -->
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="./static/Wap/water/js/vue.min.js"></script>
<script>
    new Vue({
        el:'#meter_record',
        data:{
            list:app_json.list,
            meter_code:"",
            meter_hash:"",//使该meter_hash值的行高亮
        },
        methods:{
            get_consume:function(item){
                var consume =  item.total_consume-item.last_total_consume
                var unit = item.unit.split('/')[1];
                return consume + unit;
            },
            filter:function(item){
                var re1 = !this.meter_code ? true : item.meter_code.indexOf(this.meter_code)>-1;
                return re1;
            },
            highlight:function(item){
                return {
                    hash_highlight:this.meter_hash===item.meter_hash
                }
            }
        },
        computed:{
            list_order:function(){

                var self = this;
                //排序规则：compare(a, b) 小于 0 ，那么 a 会被排列到 b 之前；
                function compare(a,b){
                    //将指定meter_hash的行置顶
                    var sort_a = self.meter_hash==a.meter_hash ? -Infinity : parseInt(a.meter_floor)
                    var sort_b = self.meter_hash==b.meter_hash ? -Infinity : parseInt(b.meter_floor)
                    return sort_a - sort_b;
                }
               var list_order = this.list.sort(compare);

                return this.list;
            },

        },

        mounted:function(){
            var meter_code = "{pigcms{:I('meter_code',"")}",
                meter_hash = "{pigcms{:I('meter_hash',"")}";
            if(meter_code){
                this.meter_code = meter_code;
                this.meter_hash = meter_hash;
            }
        }
    });
</script>
</body>
</html>
