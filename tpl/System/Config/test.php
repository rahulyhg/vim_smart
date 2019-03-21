<div class="table-responsive" id="app" v-cloak>
    <form id="myform" method="post" action="{pigcms{:U('Config/amend')}" refresh="true">
        <div class="btn"  style="padding-bottom:15px;">
            <button type="button" class="btn btn-circle green-haze btn-outline sbold" data-confirm-button-class="btn-success">添加</button>
            &nbsp;
            <input TYPE="submit"  name="dosubmit" class="btn" style="background-color:#00a0fe;color:#fff" value="保存" class="button" />
        </div>
        <!--        <p>{{re_setmeter}}</p>-->
        <table style="width:50%" class="table table-striped table-bordered table-hover table-checkable order-column no-footer">
            <tr>
                <td>标记</td>
                <td>描述</td>
                <td>单位</td>
                <td>价格（元）</td>
                <td>是否使用</td>
                <td>删除</td>
            </tr>
            <tr v-for="(item, index) in re_setmeter">
                <td v-for="(subitem,subindex) in item" @click="edit(subitem,$event)" >
                    <span>{{subitem.val}}</span>
                    <input class="edit" type="text" @keyup=""
                           v-bind:value="subitem.val"
                           v-model = "subitem.val"
                           @blur="subitem.is_show=!subitem.is_show"
                    >
                </td>
                <td><strong style="color:red">—</strong></td>
            </tr>
        </table>
    </form>
    <div>
        <input type="text" v-bind:value="test" >
        <span>{{test}}</span>
    </div>
</div>

<script src="./static/Wap/water/js/vue.min.js"></script>
<script>
    var model = new Vue({
        el: '#app',

        data: {
            re_setmeter:[],
            test:123
        },
        //构造函数
        mounted: function () {
            this.re_setmeter = JSON.parse('{pigcms{:json_encode($re_setmeter)}');
        },

        methods: {
            edit:function(node,e){
                node.is_show = false;
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
