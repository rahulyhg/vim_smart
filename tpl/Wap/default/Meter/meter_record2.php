<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- head 中 -->
    <title>抄表记录({pigcms{$record_meter_count}/{pigcms{$meter_count})</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
    <style>
        [v-cloak] {
            display: none;
        }
        .hash_highlight{
            background-color: #fff0e2;
        }
		.weui-form-preview {
			position: relative;
			background-color: #fff;
		    margin-bottom: 15px;
		}
		.weui-cells {
			margin-top: 12px;
			background-color: #fff;
			line-height: 1.41176471;
			font-size: 17px;
			overflow: hidden;
			position: relative;
		}
    </style>
</head>
<body style="background-color: #f8f8f8;">
<div id="meter_record" v-cloak>
<header style="padding:10px 0px;text-align: center">
    <div class="weui-cell weui-cell_select weui-cell_select-before" style="background-color:#FFFFFF; border-top: 1px #d9d9d9 solid; border-bottom: 1px #d9d9d9 solid; opacity:0.7;">
        <div class="weui-cell__hd">*
            <select class="weui-select" name="select2">
                <option>{pigcms{$ym}</option>
            </select>
        </div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" v-model="keywords" placeholder="搜索:设备码/楼层">
        </div>
    </div>

    <div class="weui-cells">
        <div class="weui-cell weui-cell_select">
            <div class="weui-cell__bd">
                <select class="weui-select"  v-model="is_record">
                    <option value="0">抄表状态：未抄录</option>
                    <option value="1">抄表状态：已抄录</option>
                </select>
            </div>
        </div>
        <div class="weui-cell weui-cell_select">
            <div class="weui-cell__bd">
                <select class="weui-select"  v-model="meter_type_id">
                    <option v-for="(item,index) in meter_type_list" v-bind:value="index">{{item}}</option>
                </select>
            </div>
        </div>
        <div class="weui-cell weui-cell_select">
            <div class="weui-cell__bd">
                <select class="weui-select" v-model="floor_id">
                    <foreach name="floor_list" item="floor" key="floor_id">
                        <option value="{pigcms{$floor_id}">{pigcms{$floor}</option>
                    </foreach>
                </select>
            </div>
        </div>
    </div>
</header>

    <div v-for="(item,index) in list_order" v-show="filter(item)" v-bind:class="highlight(item)" @click="enter(item)" class="weui-form-preview">
        <!--<div class="weui-form-preview__hd">
            <label class="weui-form-preview__label">{{item.meter_code}} （{{item.meter_floor}})</label>
            <em class="weui-form-preview__value">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <span v-if="!item.is_record" style="color:darkorange">未抄录</span>
            </em>
        </div>-->
		
		<div class="weui-form-preview">
            <div class="weui-form-preview__hd">
                <div class="weui-form-preview__item">
                    <div style="line-height: 2.5em; float:left; font-size:18px;">{{item.meter_code}} （{{item.meter_floor}})</div>
					<div style="color:#333333; float:right;">{{item.meter_type_name}}</div>
					<div style="clear:both"></div>
                </div>
            </div>
            <div class="weui-form-preview__bd">
                <div class="weui-form-preview__item">
                    <div style="float:left; width:40%; text-align:left; line-height:36px;">起码：<span style="color:#666666; font-size:18px;">{{item.last_total_consume}}</span></div>
                    <div style="float:left; width:40%; text-align:left; line-height:36px;">止码：<span style="color:#fb4746; font-size:18px;">{{item.total_consume||"未抄录"}}</span></div>
					<div style="text-align:right; height: 6px; width: 6px;border-width: 2px 2px 0 0;border-color: #C8C8CD;border-style: solid;-webkit-transform: matrix(0.71, 0.71, -0.71, 0.71, 0, 0);transform: matrix(0.71, 0.71, -0.71, 0.71, 0, 0);position: relative;position: absolute;margin-top: 13px;right: 17px;"></div>
                </div>
            </div>
        </div>
		
		
        <!--<div class="weui-form-preview__bd">
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
        </div>-->
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
            keywords:"",
            meter_hash:"",//使该meter_hash值的行高亮,

            //meter_list:app_json.meter_list,
            meter_type_list:app_json.meter_type_list,
            floor_list:app_json.floor_list,
            village_list:app_json.village_list,
            floor_id:0,
            meter_type_id:0,
            village_id:0,

            is_record:0,


        },
        methods:{
            get_consume:function(item){
                var consume =  item.total_consume-item.last_total_consume
                var unit = item.unit.split('/')[1];
                return consume + unit;
            },
            filter:function(item){
                let re1 = true,re2=true,re3=true,re4=true;
                if(this.keywords){
                    re1 = item.meter_code.indexOf(this.keywords)>-1
                    || item.meter_floor.indexOf(this.keywords)>-1;
                }
//
                if(this.floor_id == 999){
                     re2 = item.floor_id == 0;
                }else{
                     re2 = !this.floor_id ? true : item.floor_id == this.floor_id;
                }

                re3 = !this.meter_type_id ? true : item.meter_type_id == this.meter_type_id;

                re4 = item.is_record == this.is_record;

                return (re1) && re2 && re3 && re4;
            },
            highlight:function(item){
                return {
                    hash_highlight:this.meter_hash===item.meter_hash
                }
            },
            enter:function(item){
                window.location.href = "http://www.hdhsmart.com/wap.php?&g=Wap&c=Meter&a=enter&meter_hash=" + item.meter_hash;
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
            console.log(app_json);


            var meter_code = "{pigcms{:I('meter_code',"")}",
                meter_hash = "{pigcms{:I('meter_hash',"")}";
            if(meter_code){
                this.keywords = meter_code;
                this.meter_hash = meter_hash;
            }
        }
    });
</script>
</body>
</html>
