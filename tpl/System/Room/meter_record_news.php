<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <if condition="$is_record neq -1">
        <div class="btn-group">
            <a href="{pigcms{:U('',array_merge($_GET,array('is_record'=>-1)))}">
                <button id="sample_editable_1_new" class="btn sbold green">返回
                </button>
            </a>
        </div>
    </if>
    <div class="btn-group">
        <a href="{pigcms{:U('Room/meterlist_news')}">
            <button id="sample_editable_1_new" class="btn sbold green">设备管理（{pigcms{:count($list)}）
            </button>
        </a>
    </div>
    <if condition="$is_record neq 0">
        <div class="btn-group">
            <a href="{pigcms{:U('',array_merge($_GET,array('is_record'=>0)))}">
                <button id="sample_editable_1_new" class="btn sbold green">查看未抄录设备（{pigcms{$no_record_count}）
                </button>
            </a>
        </div>
    </if>
    <if condition="$is_record neq 1">
        <div class="btn-group">
            <a href="{pigcms{:U('',array_merge($_GET,array('is_record'=>1)))}">
                <button id="sample_editable_1_new" class="btn sbold green">查看已抄录设备（{pigcms{$is_record_count}）
                </button>
            </a>
        </div>
    </if>
    <div class="btn-group">
        <a href="{pigcms{:U('Meter/meter_import_record')}">
            <button id="sample_editable_1_new" class="btn sbold green">抄表记录初始化导入
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('Meter/output_meter_record_list')}">
            <button id="sample_editable_1_new" class="btn sbold green">抄表记录导出
            </button>
        </a>
    </div>

    <div class="btn-group">
        <select name="ym" id="ym" class="form-control">
            <option value="0">选择月份</option>
            <for start="1" end="13">
                <option value="{pigcms{$i}" {pigcms{$month==$i?"selected='selected'":""}>{pigcms{$i}月</option>
            </for>
        </select>
    </div>

    <h4 class="text-muted" style="display:inline-block">
        &nbsp
        <switch name="is_record">
            <case value="-1" break="1">
                总设备数：
            </case>
            <case value="0" break="1">
                未抄录设备:
            </case>
            <case value="1" break="1">
                已抄录设备:
            </case>
        </switch>
        {pigcms{:count($list)}

    </h4>

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


    <br/>
    <br/>

</block>
<block name="table-toolbar-right">
    <!--    筛选-->
    <span>筛选：</span>
    <sapn id="filter">
        <meter-type :tree="type_tree "></meter-type>
    </sapn>
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
                <th>设备码</th>
                <th>楼层</th>
                <th>设备类型</th>
                <th>计费类型</th>
                <th>上次止码</th>
                <th>本月止码</th>
                <if condition="$is_record neq 0">
                <th>抄录人</th>
                <th>当月用量</th>
                <th>抄录时间</th>
                </if>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <volist name="list" id="row">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$row.id}</td>
                <td>{pigcms{$row.meter_code}</td>
                <td>{pigcms{$row.meter_floor}</td>
                <td>{pigcms{$row.meter_type_name}</td>
                <td>{pigcms{$row.price_type_name}</td>
                <if condition="$row['is_record'] eq 1">
                    <td>{pigcms{$row.last_total_consume}</td>
                    <td>{pigcms{$row.total_consume}</td>
                    <else />
                    <td>{pigcms{$row.end_num}</td>
                    <td>未抄录</td>
                </if>
                <if condition="$is_record neq 0">
                <td>{pigcms{$row.realname}</td>
                <td>{pigcms{$row.consume}</td>
                <td>
                    <if condition="$row['create_time'] neq '' ">
                        {pigcms{$row.create_time|date="Y-m-d",###}
                        <else />
                        当月未抄录
                    </if>

                </td>
                </if>

                <td class="button-column">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position: absolute; margin-left:-90px;">

                            <li>
                                <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('modal_meter_qr',array('meter_hash'=>$row['meter_hash']))}">
                                    <i class="icon-docs"></i> 二维码
                                </a>
                            </li>
                            <if condition="$row['record_id']">
                                <li>
                                    <a target="_blank" href="{pigcms{:U('edit_record',array('record_id'=>$row['record_id']))}">
                                        <i class="icon-docs"></i>编辑
                                    </a>
                                </li>
                            </if>

                        </ul>
                    </div>
                </td>
            </tr>
        </volist>
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
            $('#ym').change(function(){
                var y = "{pigcms{:date('Y')}";
                var m = $(this).val();
                var ym = y+'-'+pad(m,2);
                var is_record = "{pigcms{$is_record}";
                console.log(ym);
                window.location.href = app.U("",{is_record:is_record,ym:ym});

            });
            //补0函数
            function pad(num, n) {
                if ((num + "").length >= n) return num;
                return pad("0" + num, n);
            }






        //        设备
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

    </script>

</block>
