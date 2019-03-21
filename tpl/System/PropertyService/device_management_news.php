<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a href="{pigcms{:U('add_meter')}">
            <button id="sample_editable_1_new" class="btn sbold green">添加设备
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <div class="btn-group">
        <if condition="$_GET['is_del'] eq 0">
            <a href="{pigcms{:U('',array('is_del'=>1))}">
                <button id="sample_editable_1_new" class="btn sbold green">查看已停用设备
                </button>
            </a>
            <else />
            <a href="{pigcms{:U('',array('is_del'=>0))}">
                <button id="sample_editable_1_new" class="btn sbold green">返回
                </button>
            </a>
        </if>
    </div>
    <!-- <div class="btn-group">
        <a href="{pigcms{:U('meter_error')}">
            <button id="sample_editable_1_new" class="btn sbold green">异常检测
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="{pigcms{:U('update_consume')}">
            <button id="sample_editable_1_new" class="btn sbold green">更新止码
            </button>
        </a>
    </div> -->

    <div class="btn-group">
        <a href="{pigcms{:U('device_config_list')}">
            <button id="sample_editable_1_new" class="btn sbold green">设备类型配置
            </button>
        </a>
    </div>

	 <!-- <div class="btn-group">
        <a href="http://www.hdhsmart.com/admin.php?g=System&c=PropertyService&a=test_print_news">
            <button id="sample_editable_1_new" class="btn sbold green">标签打印
            </button>
        </a>
    </div> -->

<!--    <if condition="$admin eq 1">-->
<!--        <div class="btn-group">-->
<!--            <a class="btn green-haze btn-outline sbold uppercase" href="javascript:;" data-toggle="dropdown">-->
<!--                <i class="fa fa-building"></i> 当前:{pigcms{$presentVillage}-->
<!--                <i class="fa fa-angle-down"></i>-->
<!--            </a>-->
<!--            <ul class="dropdown-menu">-->
<!--                <li>-->
<!--                    <a href="{pigcms{:U('')}">-->
<!--                        <i class="fa fa-building-o"></i> 全部显示 </a>-->
<!--                </li>-->
<!--                <foreach name="villageArray" item="vo">-->
<!--                    <li>-->
<!--                        <a href="{pigcms{:U('',array('village_id'=>$vo['village_id']))}">-->
<!--                            <i class="fa fa-building-o"></i> {pigcms{$vo.village_name} </a>-->
<!--                    </li>-->
<!--                </foreach>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <else/>-->
<!--        <div class="btn-group">-->
<!--            <a class="btn green-haze btn-outline sbold uppercase" href="javascript:;">-->
<!--                <i class="fa fa-building"></i> 当前:{pigcms{$presentVillage}-->
<!--            </a>-->
<!--        </div>-->
<!--    </if>-->
	<block name="table-toolbar-right" style="float:right;">
    <!--    筛选-->
    <span>筛选：</span>
    <sapn id="filter">
        <meter-type :tree="type_tree "></meter-type>
    </sapn>
</block>

    <br/>
    <br/>



</block>



<block name="body">
    <table class="table table-striped table-bordered table-hover" id="sample_1">
        <thead>
            <tr>
                <th>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                        <span></span>
                    </label>
                </th>
                <th>设备编号</th>
                <th>设备名称</th>
                <th>设备类型</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <!-- <volist name="list" id="row"> -->
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>1</td>
                <td>1号变压器</td>
                <td>低压</td>
                <td>
                    <!-- <if condition="$_GET['is_del'] eq 0"> -->
                        <button class="btn btn-sm green btn-outline filter-submit margin-bottom" id="meter_type_{pigcms{$row.id}" value="{pigcms{$row.is_del}" onclick="changeType(this)">启用</button>
                        <input type="hidden" id="meter_type_{pigcms{$row.id}_id" value="{pigcms{$row['id']}">
                        <!-- <a  href="{pigcms{:U('meter_logic_del',array('meter_hash'=>$row['meter_hash']))}">
                        <button class="btn btn-sm green btn-outline filter-submit margin-bottom">启用</button>
                        </a> -->
                    <!-- <else /> -->
                        <!-- <button class="btn btn-sm red btn-outline filter-submit margin-bottom" id="meter_type_{pigcms{$row.id}" value="{pigcms{$row.is_del}" onclick="changeType(this)">停用</button>
                        <input type="hidden" id="meter_type_{pigcms{$row.id}_id" value="{pigcms{$row['id']}"> -->
                        <!-- <a href="{pigcms{:U('meter_return',array('meter_hash'=>$row['meter_hash']))}">
                        <button class="btn btn-sm red btn-outline filter-submit margin-bottom">停用</button>
                        </a> -->
                    <!-- </if> -->
                </td>

                <td class="button-column">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position: absolute; margin-left:-90px;">
                            <!-- <li>
                                <if condition="$village_type eq 0">
                                    <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('modal_meter_bind_room',array('meter_hash'=>$row['meter_hash']))}">
                                        <i class="icon-docs"></i> 绑定房间
                                    </a>
                                    <else />
                                    <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('modal_meter_bind_room_sq',array('meter_hash'=>$row['meter_hash']))}">
                                        <i class="icon-docs"></i> 绑定房间
                                    </a>
                                </if>
                            </li> -->
                            <li>
                                <a  href="{pigcms{:U('modal_meter_update',array('meter_hash'=>$row['meter_hash']))}">
                                    <i class="icon-docs"></i> 设备管理
                                </a>
                            </li>
                            <li>
                                <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('modal_meter_qr',array('meter_hash'=>$row['meter_hash']))}">
                                    <i class="icon-docs"></i> 二维码
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        <!-- </volist> -->
        </tbody>
    </table>
</block>

<block name="script">
    <!--    设备类型模板-->
    <script type="text/x-template" id="meter_type">
        <span>
            <div class="btn-group">
               <select name="meter_type_id" id="" class="form-control" v-model="selected_meter_type">
                    <option value="">请选择设备类型</option>
                    <option v-for="(type,index) in tree" v-bind:value="type.id">{{type.desc}}</option>
                </select>
            </div>

            <div class="btn-group">
                <select name="price_type_id" id="" class="form-control" v-model="selected_price_type">
                    <option value="">请选择计费类型</option>
                    <option v-for="(type,index) in price_type_list" v-bind:value="type.id">{{type.desc}}</option>
                </select>
            </div>
        </span>
    </script>
    <script>
        Vue.component('meter-type', {
            template: '#meter_type',
            props:{
                tree:Object
            },
            data:function(){
                return {
                    'selected_meter_type':"",
                    'selected_price_type':"",
                }
            },
            computed:{

                price_type_list:function(){
                    var price_type_list = {};
                    for(var i in this.tree){
                        if(this.tree[i].id == this.selected_meter_type ){
                            price_type_list = this.tree[i].price_type_list;
                            break;
                        }
                    }
                    return price_type_list;
                },

            },
            watch:{
                selected_meter_type:function(val){
                    for(var i in this.tree){
                        if(this.tree[i].id == val ){
                            var keywords = this.tree[i]['desc'];
                            break;
                        }
                    }
                    $('input[aria-controls="sample_1"]').val(keywords).keyup();
                    this.selected_price_type = "";
                },

                selected_price_type:function(val){
                    if(!val) return ;
                    for(var i in this.price_type_list){
                        if(this.price_type_list[i].id ==val ){
                            var keywords = this.price_type_list[i]['desc'];
                            break;
                        }
                    }
                    $('input[aria-controls="sample_1"]').val(keywords).keyup();
                },
            },
        });

        new Vue({
            el:'#filter',
            data:{
                type_tree:app_json.meter_type_tree
            },
            mounted:function(){
                console.log(this.type_tree);
            }
        });

        function changeType(id) {
            var is_del_id = $(id).attr('id');
            // var point_id_id = is_del+'_id';

            var is_del = $("#"+is_del_id).val();
            var meter_id = $("#"+is_del_id+"_id").val();

            // console.log(is_del);
            // console.log(point_id);

            $.ajax({
                url:'{pigcms{:U("meter_type")}',
                type:'post',
                data:{'is_del':is_del, 'meter_id':meter_id},
                success:function (re) {
                    if (is_del == 0) {
                        if (re) {
                            $('#'+is_del_id).html('停用');
                            $('#'+is_del_id).css("background-color","red");
                            // alert('该点位已停用');
                        }
                    } else {
                        if (re) {
                            $('#'+is_del_id).html('启用');
                            $('#'+is_del_id).css("background-color","green");
                            // alert('该点位已启用');
                        }
                    }
                }
            });
        }
    </script>
</block>
