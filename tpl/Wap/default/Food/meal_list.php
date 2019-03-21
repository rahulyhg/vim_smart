<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>桶装水</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="./static/Wap/water/css/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        li{list-style:none;}
        *{
            -webkit-touch-callout:none;  /*系统默认菜单被禁用*/
            -webkit-user-select:none; /*webkit浏览器*/
            -khtml-user-select:none; /*早期浏览器*/
            -moz-user-select:none;/*火狐*/
            -ms-user-select:none; /*IE10*/
            user-select:none;
        }
        body {font-size:14px; width:100%; height:100%; font-size:100%; font-family:"微软雅黑"; margin:0px; padding:0px; background:url(./static/Wap/water/images/wat2.jpg) no-repeat top center #58c1f0; background-size:100% auto;}
        input[type="text"] {
            -webkit-appearance: none;
        }
        textarea{
            -webkit-appearance: none;
        }
        #Tab1{
            width:100%;
            margin:0px;
            padding:0px;
            borde:1px #ffffff solid;
            margin:0 auto;}
        /*菜单class*/
        .Menubox {
            width:100%;
        }
        .Menubox ul{
            margin:0px;
            padding:0px;
        }
        .Menubox li{
            width: 20%;
            float: left;
            box-sizing: border-box;
            border:1px #ffffff solid;
            border-left:none;
            padding: 7px 0 7px 0;
            text-align: center;
            color: #ffffff;
            font-size: .8rem;
        }

        .Menubox li.hover{
            width: 20%;
            float: left;
            box-sizing: border-box;
            border:1px #ffffff solid;
            border-left:none;
            padding: 7px 0 7px 0;
            text-align: center;
            color: #ffffff;
            font-size: .8rem;
            background-color:#169cd9;
            font-weight:bold;
        }
        .Menubox li:first-child
        {
            border-left:1px #ffffff solid;
            border-radius:6px 0 0 6px;
        }
        .Menubox li:last-child
        {
            border-radius:0 6px 6px 0;
        }
        .Contentbox{
            clear:both;
            margin-top:0px;
        }
        [v-cloak]{
            display:none;
        }

    </style>
</head>

<body>
<div class="width">
    <div class="js">
        <div id="Tab1" v-cloak>
            <div class="Menubox">
                <ul>
                    <li v-for="(item, index) in meal_list" @click="change_seleced(index)" v-bind:class="{hover:selected_tab==index}">
                        {{item.sort_name}}
                    </li>
<!--                        <li id="{pigcms{$row.sort_id}"  class="hover">{pigcms{$row.sort_name}</li>-->
                </ul>
            </div>
                <div class="Contentbox" v-for="(item, index) in meal_list" v-show="selected_tab==index">
                    <div id="con_one_1" class="hover">
                        <div class="js2">
                            <div class="bgg"><span style="padding-left:12px;">收费标准：{pigcms{$row.price}/桶（价格会有所浮动，视市场价格为主）</div>
                        </div>
                        <div class="js3">
                                <div v-for="(subitem, subindex) in item._meals" v-bind:class="{ qf1:subindex%2==0 , qf2: subindex%2==1 }" >
                                    <div class="qjj">
                                        <div class="mu">
                                            <div v-bind:class="{ xw1:subindex%2==0 , xw4: subindex%2==1 }"class="xw1">{{parseInt(subitem.price)}}</div>
                                            <div class="xw2">元</div>
                                            <div class="xw3">
                                                <div style="width:100%;">
                                                    <div class="tb">
<!--                                                        <img v-bind:src="subitem.pic" style="width:100%; height:auto;"/>-->
                                                        <img src="./static/Wap/water/picture/whh.jpg" style="width:100%; height:auto;"/>
                                                    </div>
                                                    <div v-bind:class="{ tb2:subindex%2==0 , tb3: subindex%2==1 }" >{{subitem.name}}</div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                                <div style="width:100%; margin-top:7px;">
                                                    <div class="st">
                                                        <div class="c3" @click="sub_coupon(subitem,$event)">-</div>
                                                        <input  type="number" @blur="check_coupon_num(subitem,$event)" v-bind:value="subitem.coupon_num" name="textfield" class="c2"/>
                                                        <div class="c1" @click="add_coupon(subitem,$event)">+</div>
                                                        <div style="clear:both;"></div>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                                <div>
                                                    <small style="float: left;margin-left:3px;color:#666;vertical-align: bottom;line-height: 3em">10桶起售</small>
                                                    <div v-bind:class="{ btn:subindex%2==0 , btn2: subindex%2==1 }" @click="buy_now(subitem)">点击购买</div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                            </div>
                                            <div style="clear:both;"></div>
                                        </div>
                                    </div>
                                </div>
                            <div class="xy">《桶装水配送协议》</div>
                        </div>
                    </div>
                </div>
        </div>
    </div>



</div>

</div>
<script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script src="./static/Wap/water/js/vue.min.js"></script>
<script>
    var model = new Vue({
        el: '#Tab1',

        data: {
            meal_list:[],
            selected_tab:0,
        },
        //构造函数
        mounted: function () {
            this.meal_list = this.get_meal_list();
            var first = getObjFirst(this.meal_list);
            this.selected_tab = first.sort_id;
            function getObjFirst(obj){
                for(var i in obj) return obj[i];
            }
        },

        methods: {
            //获取商品列表
            get_meal_list:function(){
                var meal_list = this.get('{pigcms{:U("get_meal_list")}',{});
                return meal_list;
            },
            change_seleced:function(index){
                this.selected_tab = index;
            },
            //购买数+1
            add_coupon:function(node,$event){

                node.coupon_num += 10;
            },
            //购买数-1
            sub_coupon:function(node,$event){

                if(node.coupon_num>10){
                    node.coupon_num -= 10;
                }else{
                    alert("10桶起售")
                }

            },
            //检查购买数量
            check_coupon_num:function(node,$event){

                var v = parseInt($event.target.value);
                if(v<10){
                    node.coupon_num = 10;
                    $event.target.value=10;
                }else{
                    node.coupon_num = Math.ceil(v/10)*10;
                }
            },
            //点击购买
            buy_now:function(node){
                var param = this.get('{pigcms{:U("buy_now")}',{meal_id:node.meal_id,coupon_num:node.coupon_num});
                param = JSON.parse(param);
                this.callpay(param);
            },
            //调用微信支付
            callpay:function(param){
                WeixinJSBridge.invoke("getBrandWCPayRequest",param,function(res){

                    WeixinJSBridge.log(res.err_msg);

                    if(res.err_msg=="get_brand_wcpay_request:ok"){
                        window.location.href = "{pigcms{:U('water_introduce')}";
                    }

                });

            },


            //获取数据
            get:function(url,data){
                var d;
                $.ajax({
                    url:url,
                    data:data||{},
                    type:'get',
                    dataType:'json',
                    async: false,
                    success:function(re){
                        d = re;
                    }
                })
                return d.data||[];
            }
        }
    });
</script>
</body>