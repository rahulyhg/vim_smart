<extend name="./tpl/System/Public_news/base.php"/>
<block name="table-toolbar-left">
    <div class="btn-group">
        <h4>选择的社区：{pigcms{$selected_village_name}</h4>
    </div>
    <div class="btn-group">
        <button id="submit" class="btn sbold green">&nbsp;确认导入</button>
        <button class="btn sbold green hide"  disabled="disabled" id="loading">&nbsp;导入中..</button>
        <button class="btn sbold green hide" disabled="disabled" id="complete">&nbsp;导入完成</button>

    </div>
    <a href="{pigcms{:U('staff_import_step')}">
        <button class="btn sbold green">返回
        </button>
    </a>
</block>
<block name="body">
    <div id="list" v-cloak>
        <div style="padding:10px" >

            提示：
            <span class="text-info">
                请核对宿舍信息与选择社区后再进行导入，字体颜色为黄色的数据在数据表中已存在，请手动删除。
            </span>
        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th v-for="(item,index) in title" >{{item}}</th>
                <th>操作</th>
            </tr>

            </thead>
            <tbody>
            <tr v-for="(item,index) in body" v-bind:class="{'text-warning':item.is_exist}">
                <td>{{item.number}}</td>
                <td>{{item.project}}</td>
                <td>{{item.room}}</td>
                <td>{{item.bed_number}}</td>
                <td>{{item.name}}</td>
                <td>{{item.department}}</td>
                <td>{{item.comment}}</td>
                <!-- <td>{{item.status}}</td> -->
                <td @click="del(index)">
                    <button class="btn btn-danger btn-sm">删除</button>
                </td>
                <!--                <td>{{item.original}}</td>-->
            </tr>
            </tbody>
        </table>
    </div>
</block>

<block name="script">
    <script src="/Car/Admin/Public/assets/pages/scripts/ui-blockui.min.js" type="text/javascript"></script>
    <script>
        let list = new Vue({
            el:"#list",
            data:{
                title:app_json.list.title,
                body:app_json.list.body,
                village_id:app_json.selected_village_id,
                village_name:app_json.selected_village_name,
            },

            methods:{
                del:function(index){
                    this.$delete(this.body,index);
                }
            },
            mounted:function(){
                console.log(app_json);
            }


        });
        $('#submit').click(function(){
            function show(el){
                $('#submit,#loading,#complete').addClass('hide');
                $(el).removeClass('hide')
            }

            let data = list.$data.body,
                village_id = list.$data.village_id;
            // console.log(data);return false;
            if(window.confirm("确认导入？")){
                $.ajax({
                    url:app.U('staff_import_step2'),
                    data:{
                        data:JSON.stringify(data),
                        village_id:village_id
                    },
                    type:'post',
                    beforeSend:function(){
                        show('#loading');
                    },
                    success:function(re){
                        // console.log(re);
                        if(re.err===0){
                            show('#complete');
                        }else{
                            show('#submit');
                        }
                        alert(re.info)
                    }
                });
            }
        });

    </script>

</block>