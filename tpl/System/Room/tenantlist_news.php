<extend name="./tpl/System/Public_news/base.php" />
<block name="head">
    <style>
        .fstatus:hover .edit{display: inline-block}
        .edit{display:none}
    </style>
</block>
<block name="table-toolbar-left">
    <if condition="$Think.session.system.tid eq 0">
        <div class="btn-group">
            <a href="{pigcms{:U('Room/add_tenant')}">
                <button class="btn sbold green">添加入驻单位
                    <i class="fa fa-plus"></i>
                </button>
            </a>
            <!--        根据模块区分-->
            <switch name="_mod">
                <case value="property" break="1">
                    <a href="{pigcms{:U('Room/bill_preview')}">
                        <button class="btn sbold green">账单预览</button>
                    </a>
                    <a href="{pigcms{:U('Room/account_list')}">
                        <button class="btn sbold green">当月台账</button>
                    </a>
                </case>
                <case value="user" break="1">
                    <if condition="$_out eq 0">
                        <a href="{pigcms{:U('Room/tenantlist_news',array('_mod'=>'user','_out'=>1))}">
                            <button class="btn sbold green">已迁出单位</button>
                        </a>
                        <else />
                        <a href="{pigcms{:U('Room/tenantlist_news',array('_mod'=>'user','_out'=>0))}">
                            <button class="btn sbold green">已入住单位</button>
                        </a>
                    </if>
                </case>
                <default />
            </switch>
            <!--        /根据模块区分11-->
        </div>

    <br/>
    <br/>
    <div class="btn-group">
        <input type="month" name="choose_time" value="<php>echo $_GET['ym']?:date('Y-m')</php>"/>
    </div>
    </if>
</block>
<block name="body">
    <table class="table table-striped table-bordered table-hover" id="sample_1">
        <thead>
<!--        入驻状态	入驻单位	业主	总面积	缴费状态	操作-->
        <tr>
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <if condition="$_out eq 0">
                <th>房间号</th>
                <th>入驻状态</th>
            </if>
            <if condition="$_out eq 0">
                <th>入驻单位</th>
                <else />
                <th>已迁出单位</th>
            </if>
            <th>联系方式（入住单位）</th>
            <if condition="$_out eq 0">
                <th>业主</th>
                <th>总面积</th>
                <switch name="_mod">
                    <case value="property" break="1">
                        <th>缴费状态</th>
                    </case>
                    <case value="user" break="1"></case>
                </switch>
                <th>操作</th>
            </if>
        </tr>
        </thead>
        <tbody>
        <volist name="list" id="vo">
            <tr style="background-color: #ffffff">
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <if condition="$_out eq 0">
                    <td class="tagDiv">
                        <!--排序需要-->
                        <span style="color:#FBFCFD;text-overflow:ellipsis;display:block;width:0px;height:0">
                            {pigcms{$vo.tung_unit}{pigcms{:sprintf("%04d",$vo['room_names']?:9999)}
                        </span>
                        <!--/排序需要-->
                        {pigcms{$vo.tung_unit}
                        {pigcms{$vo.room_names}
                    </td>

                    <td class="fstatus">
                        <select_fstatus oids="{pigcms{$vo.oids}" fstatus="{pigcms{$vo.fstatus}"></select_fstatus>
                    </td>
                </if>

                    <td>
                        <div class="tagDiv">{pigcms{$vo.tenantname}</div>
                    </td>

                    <td>
                        <div class="tagDiv">{pigcms{$vo.tname}|{pigcms{$vo.tphone}</div>
                    </td>

                <if condition="$_out eq 0">
                    <td>
                        <div class="tagDiv">{pigcms{:str_replace(',','<br>',$vo['ownernames'])}</div>
                    </td>
                    <td>
                        <div class="tagDiv">{pigcms{$vo.housesize} ㎡ </div>
                    </td>
                    <!--                根据模块区分-->
                    <switch name="_mod">
                        <case value="property" break="1">
                            <td>
                                <if condition="$vo.is_enter_list eq 1">
                                    <div>
                                        <if condition="$vo['total_price'] neq 0">
                                            <div>
                                                <a  data-toggle="modal" data-target="#common_modal" class="btn btn-xs yellow-crusta" href="{pigcms{:U('Room/before_pay',array('pid'=>$vo['pid'],'ym'=>$_GET['ym']))}" style="    line-height: 30px; padding: 0 10px 0 10px; font-size: 14px;"><span style="font-weight:bold;">¥:{pigcms{:sprintf('%.2f',$vo['total_price'])}</span></a>
                                            </div>
                                        <else/>
                                            <button class="btn  blue-steel"><i class="fa fa-check"></i>已缴费</button>
                                        </if>

                                    </div>
                                <else/>
                                    <if condition="$Think.session.system.tid eq 0">
                                        <a href="{pigcms{:U('Room/bill_preview',array('tid'=>$vo['pigcms_id']))}">
                                            <button class="btn sbold green">未确认的账单</button>
                                        </a>
                                    <else/>
                                            <button class="btn sbold green">未确认的账单</button>
                                    </if>
                                </if>
                            </td>
                        </case>
                        <case value="user" break="1"></case>
                    </switch>
                    <!--                /根据模块区分-->
                    <td class="button-column">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position: absolute; margin-left:-90px;">
                            <if condition="$Think.session.system.tid eq 0">
                            <li>
                                <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('Room/modal_tenant_bind_room',array('tid'=>$vo['pigcms_id']))}">
                                    <i class="icon-docs"></i> 绑定房间
                                </a>
                            </li>
                            <li>
                                <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('Room/modal_tenant_rooms',array('tid'=>$vo['pigcms_id']))}">
                                    <i class="icon-docs"></i> 房间配置
                                </a>
                            </li>
                            <li>
                                <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('Room/modal_tenant_meters',array('tid'=>$vo['pigcms_id']))}">
                                    <i class="icon-docs"></i> 设备配置
                                </a>
                            </li>

                            <li>
                                <a href="{pigcms{:U('Room/tenant_edit',array('tid'=>$vo['pigcms_id']))}">
                                    <i class="icon-docs"></i> 编辑
                                </a>
                            </li>
                            </if>
                            <!--                根据模块区分-->
                            <switch name="_mod">
                                <case value="property" break="1">
                                    <li>
                                        <a href="{pigcms{:U('Room/pay_history_list',array('tid'=>$vo['pigcms_id']))}">
                                            <i class="icon-docs"></i> 缴费明细
                                        </a>
                                    </li>
                                    <!--<if condition="$vo.is_enter_list eq 1">
                                        <li>
                                            <a data-toggle="modal" data-target="#common_modal" href="{pigcms{:U('PropertyService/choose_pay_type',array('money'=>sprintf('%.2f', $vo['total_property']+$vo['total_other']+$vo['total_electric']+$vo['total_water']),'type'=>'all','pid'=>$vo['pid']))}">
                                                <i class="icon-docs"></i> 全部缴费
                                            </a>
                                        </li>
                                    </if>-->
                                </case>
                                <case value="user" break="1"></case>
                            </switch>
                            <!--                /根据模块区分-->
                        </ul>
                    </div>

                </td>
                <else />
                    <td class="button-column">
                        <div class="btn-group">
                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false"> 操作
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-left" role="menu" style="position: absolute; margin-left:-90px;">
                                <li>
                                    <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('Room/modal_tenant_bind_room',array('tid'=>$vo['pigcms_id']))}">
                                        <i class="icon-docs"></i> 绑定房间
                                    </a>
                                </li>
                                <li>
                                    <a href="{pigcms{:U('del_tenant_act',array('tid'=>$vo['pigcms_id']))}" onclick="return window.confirm('警告：数据删除后不恢复，确认删除？')">
                                        <i class="icon-docs"></i> 删除入住单位
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </td>
                </if>
            </tr>
        </volist>
        </tbody>
    </table>
</block>

<block name="script">
    <script>
        $("input[name='choose_time']").change(function(){
            var ym = $("input[name='choose_time']").val();
            window.location.href='/admin.php?g=System&c=Room&a=tenantlist_news&ym='+ym;
        });
    </script>

<!--    vue code start-->
    <script type="text/template" id="select_fstatus_template">
        <div v-if="oids">
            <select
                    v-if="editing"
                    v-foucs
                    :size="editing?7:1"
                    v-model="fstatus"
                    @change="change_status(oids,fstatus)"
                    @click="editing=0"
                    @blur="editing=0"
            >
                <option v-for="(item,index) in fstatus_list" :value="index">{{item}}</option>
            </select>
            <span v-else style="cursor: pointer;" @click="editing=1">
                {{fstatus_list[fstatus]}}
                <span class="glyphicon glyphicon-pencil edit"></span>
            </span>

        </div>
        <div v-else>
            <span class="text-danger">未绑定到业主</span>
        </div>
    </script>
    <script>
        Vue.directive('foucs', {
            // 当被绑定的元素插入到 DOM 中时……
            inserted: function (el) {
                el.foucs
            }
        })

        Vue.component('select_fstatus', {
            template: '#select_fstatus_template',
            props:['oids','fstatus'],
            data: function () {
                return{
                    fstatus_list:app_json.fstatus_list,
                    editing:0,
                }
            },
            methods:{
                change_status:function(){
                    this.save()
                    this.editing = 0;
                },
                save:function(){
                    this._get(app.U('change_fstatus'),{oids:this.oids,status:this.fstatus},function(re){

                    });
                }
            },
            watch:{

            }
        });
        /*new Vue({el:'#sample_1',});*/
    </script>
    <!--    vue code end-->
</block>
