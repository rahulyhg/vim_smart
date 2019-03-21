<body>
<div class="modal-header">
    <button type="button" class="close close_bind_list" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">水电表管理-{pigcms{$tenant_info['tenantname']}</h4>
</div>
<div class="modal-body" style="height:50rem;" id="bind_meter_list_{pigcms{$tenant_info['pigcms_id']}">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">设备列表</span>

            <a style="float: right" href="{pigcms{:U('bind_meter',array('tid'=>$tenant_info['pigcms_id']))}" type="button" class="btn btn-primary" data-toggle="modal" data-target="#bind_meter_{pigcms{$tenant_info['pigcms_id']}">
                绑定设备
            </a>
            <div style="clear: both"></div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th onclick="alert()">楼层号</th>
                    <th>设备类型</th>
                    <th>设备编号</th>
                    <th>当前止码</th>
                    <th>计费类型</th>
                    <th>倍率</th>
<!--                    <th>上月上报状态</th>-->
                    <th>操作</th>
                </tr>
                <tr v-for="(item,key) in bind_list">
                    <td>{{item.meter_floor}} {{item.tid}}</td>
                    <td>{{item.meter_type_desc}}</td>
                    <td>{{item.meter_code}}</td>
                    <td>{{item.last_cousume}}</td>
                    <td>{{item.price_type_desc}}</td>
                    <td>{{item.rate}}</td>
                    <td>
                        <a v-bind:href="'{pigcms{:U("modal_meter_set")}&meter_hash='+item.meter_hash +'&tid={pigcms{$tenant_info.pigcms_id}'" type="button" class="btn btn-default  btn-sm" data-toggle="modal" data-target="#meter_set">
                            计费配置
                        </a>

                        <a v-bind:href="'{pigcms{:U("modal_meter_qr")}&meter_hash='+item.meter_hash +'&tid={pigcms{$tenant_info.pigcms_id}'" type="button" class="btn btn-default  btn-sm" data-toggle="modal" data-target="#meter_qr">
                            二维码预览
                        </a>
                        <button class="btn btn-default  btn-sm" @click="unbind_meter(item,key)">取消绑定</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="modal" id="meter_set" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
<div class="modal" id="bind_meter_{pigcms{$tenant_info['pigcms_id']}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:800px">
        <div class="modal-content">

        </div>
    </div>
</div>
<div class="modal" id="meter_qr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>



<div class="modal-footer">
    <button type="button" class="btn btn-default close_bind_list" data-dismiss="modal">关闭</button>
</div>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script>
    $(document).ready(function(){
        $(document).on('click','.close_sub_modal',function(){
            $("#meter_set").modal('hide');
            $("#meter_qr").modal('hide');
            $("#bind_meter_{pigcms{$tenant_info['pigcms_id']}").modal('hide');
        });
        $(document).on('click','.close_bind_list',function(){
            window.location.reload();
        });
    });
//
//    function unbind_meter(el,meter_hash){
//        var tid = parseInt("{pigcms{$tenant_info['pigcms_id']}")||0;
//        var res = ajax_get("{pigcms{:U('ajax_unbind_meter_act')}",{tid:tid,meter_hash:meter_hash});
//
//        if(res.err==0){
//            $(el).parents('tr').remove();
//        }else{
//            alert("发生错误");
//        }
//    }
//
//    function ajax_get(url, data){
//            var d;
//            $.ajax({
//                url: url,
//                data: data || {},
//                type: 'get',
//                dataType: 'json',
//                async: false,
//                success: function (re) {
//                    d = re;
//                }
//            })
//            return d;
//    };
//    //

        var bind_meter_list_{pigcms{$tenant_info['pigcms_id']} = new Vue({
            el:"#bind_meter_list_{pigcms{$tenant_info['pigcms_id']}",
            data:{
                tid:parseInt("{pigcms{$tenant_info['pigcms_id']}")||0,
                bind_list:[]
            },
            mounted:function(){
                this.bind_list = this.get_bind_meter_list(this.tid);
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
                //获取绑定的列表
                get_bind_meter_list:function(){
                    var tid = this.tid;
                    var res = this.get('{pigcms{:U("ajax_get_bind_meter_list")}',{tid:tid});
                    return res.data;
                },
                //解绑设备
                unbind_meter:function (node,index){
                        var tid = this.tid;
                        var meter_hash = node.meter_hash;
                        var res = this.get("{pigcms{:U('ajax_unbind_meter_act')}",{tid:tid,meter_hash:meter_hash});
                        if(res.err==0){
                            this.bind_list.splice(index, 1);
                        }else{
                            alert("发生错误");
                        }
                    }

            }


        });

 </script>
</body>