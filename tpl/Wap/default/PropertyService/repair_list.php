<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- head 中 -->
    <title>在线报修列表</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
</head>
<body>
<div id="app" v-cloak>
    <header style="padding:10px 0px;text-align: center">
<!--        <div class="weui-cell weui-cell_select weui-cell_select-before">-->
<!--            <div class="weui-cell__hd">-->
<!--            </div>-->
<!--            <div class="weui-cell__bd">-->
<!--                <input class="weui-input" type="text" placeholder="请输入设备码">-->
<!--            </div>-->
<!--        </div>-->
    </header>

    <div v-for="(item,index) in list"  class="weui-form-preview" @click="audit(item.pid)">
        <div class="weui-form-preview__hd">
            <label class="weui-form-preview__label">上报人</label>
            <em class="weui-form-preview__value">
                <span style="font-size: 0.6em">{{item.name}}</span>
            </em>
        </div>
        <div class="weui-form-preview__bd">
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">概要：</label>
                <span class="weui-form-preview__value">{{item.content}}</span>
            </div>

            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">上报时间：</label>
                <span class="weui-form-preview__value">{{item.create_date}}</span>
            </div>
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">是否处理：</label>
                <span class="weui-form-preview__value">
                    <span style="color: #00a0fe" v-if="item.is_read==1">已处理</span>
                    <span style="color: red" v-else>未处理</span>
                </span>
            </div>

        </div>
    </div>
</div>


<!-- body 最后 -->
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="./static/Wap/water/js/vue.min.js"></script>
<script>
    var list = {pigcms{:json_encode($list)};
</script>
<script>

    //

    new Vue({
        el:'#app',
        data:{
            list:list.repair_list,
        },
        methods:{

            filter:function(item){

            },
            audit:function(pid){
                window.location.href = "{pigcms{:U('repair_inform')}" + "&repair_id=" + pid;
            }


        },

        mounted:function(){
            console.log(this.list);
        }
    });
</script>
</body>
</html>
