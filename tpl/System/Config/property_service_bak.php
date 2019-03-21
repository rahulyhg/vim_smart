<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'站点配置',
    'describe'=>'',
);
$breadcrumb = array(
    array('系统设置','#'),
    array('站点配置','#'),
);

?>
<style>
    [v-cloak]{
        display:none;
    }
    .edit{
    }
    .bg_warning {
        background-color: #fcf8e3 !important;
    }
</style>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区开始-->

<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/components.min.css" id="style_components" rel="stylesheet" type="text/css" />


<div class="tabbable tabbable-tabdrop" >

    <ul class="nav nav-tabs">
        <li class="dropdown pull-right tabdrop">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-ellipsis-v"></i>&nbsp;
                <i class="fa fa-angle-down"></i>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <volist name="group_list" id="vo" offset="15">
                    <li>
                        <a href="{pigcms{:U('Config/index_news',array('gid'=>$vo['gid']))}" data-toggle="tab" onclick="window.location.href=this.href">{pigcms{$vo.gname}</a>
                    </li>
                </volist>
                <li>
                    <a href="{pigcms{:U('Config/property_service')}" aria-expanded="true" data-toggle="tab" onclick="window.location.href=this.href">物业配置</a>
                </li>


            </ul>
        </li>

        <if condition="empty($_GET['galias'])">

            <volist name="group_list" id="vo" offset="0" length="15">

                <li>
                    <a href="{pigcms{:U('Config/index_news',array('gid'=>$vo['gid']))}" aria-expanded="{pigcms{$gid==$vo['gid']?'true':'false'}" >{pigcms{$vo.gname}</a>
                </li>

            </volist>

            <else/>

            <if condition="$header_file">

                <include file="$header_file"/>

            </if>
        </if>
    </ul>

    <div class="tab-content" style="margin-top:15px;">

    </div>
</div>
<style>
    .table th {border:none !important;font-weight: 300 !important;color:#666 !important;vertical-align: middle !important;text-align: right }
    .table tr {border:none !important; height:50px;}
    .table td {border:none !important;}
    tbody {display:table; width:100%;}
</style>


<div class="table-responsive" id="app" v-cloak>
    <form id="myform" method="post" action="{pigcms{:U('Config/amend')}" refresh="true">
        <div class="btn"  style="padding-bottom:15px;">
            <button type="button" @click="add()" class="btn btn-circle green-haze btn-outline sbold" data-confirm-button-class="btn-success">添加</button>
            &nbsp;
            <!--            <input TYPE="button"  @click="submit()" name="dosubmit" class="btn" style="background-color:#00a0fe;color:#fff" value="保存" class="button" />-->
        </div>
        <!--        <p>{{re_setmeter}}</p>-->
        <table style="width:60%" class="table table-striped table-bordered table-hover table-checkable order-column no-footer">
            <tr>
                <td>标记</td>
                <td>描述</td>
                <td>单位</td>
                <td>价格（元）</td>
                <td>删除</td>
            </tr>
            <tr v-for="(item, index) in re_setmeter">
                <td v-for="(subitem,subindex) in item" v-if="set_show_fields(subindex)">
                    <div v-if="subindex=='type'">
                        <div v-for="(v,k) in subitem">
                            <span v-if="k=='jm'">居民:</span>
                            <span v-if="k=='zx'">装修:</span>
                            <span v-if="k=='gy'">工业:</span>
                            <span v-show="!v.is_edit" @click="edit(v,$event)">{{v.val}}</span>
                            <input class="edit" type="text"
                                   @blur="check(v,$event)"
                                   v-show="v.is_edit"
                                   v-model = "v.val"
                                   style="width:100px;display:inline-block"
                                   v-bind:class="{ bg_warning: !v.val }"
                            >
                        </div>
                    </div>
                    <div v-else>
                        <span v-show="!subitem.is_edit" @click="edit(subitem,$event)">{{ subitem.val }}</span>
                        <input class="edit" type="text"
                               @blur="check(subitem,$event)"
                               v-show="subitem.is_edit"
                               v-model = "subitem.val"
                               style="width:100px"
                               v-bind:class="{ bg_warning: !subitem.val }"
                        >
                    </div>

                </td>
                <td  @click="del(index)" style="color:red;cursor:pointer;">
                    <strong>—</strong>
                </td>
            </tr>
        </table>
    </form>
</div>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script>
    //获取配置标签的gid
    var config_gid = parseInt("{pigcms{:I('get.gid',0,'int')}")||0;




    //样式重置
    $('#myform').addClass('form-group form-md-line-input');
    $('#myform table').show().addClass('table');


    //    $('#myform th').removeAttr("width")
    //        .width('15%').css('min-width','100px')
    $('input[type="text"]').addClass("form-control");



    //含有标签页的gid
    var have_tap_gids = [2,5,6,7];
    if(have_tap_gids.indexOf(config_gid)>-1){
        $('.tab_ul').addClass('nav nav-pills');
        $('table').wrapAll('<div class="tab-content"></div>');
        $('table').addClass('tab-pane');
        $('table').eq(0).addClass('active');
    }
</script>
<script src="./static/Wap/water/js/vue.min.js"></script>
<script>
    var model = new Vue({
        el: '#app',

        data: {
            re_setmeter:[],
            show_fields:{
                'village_id':false,
                'type':true,
                'device_name':true,
                'device_des':true,
                'is_use':false,
                'unit':true,
                'jm':true,
                'gy':true,
                'zx':true
            }
        },

        //构造函数
        mounted: function () {
            this.re_setmeter = JSON.parse('{pigcms{:json_encode($re_setmeter)}');
        },

        methods: {
            //显示字段
            set_show_fields:function(name){
                if(this.show_fields[name]!==undefined){
                    return  this.show_fields[name];
                }else{
                    return false;
                }

            },



            //编辑
            edit:function(node,e){
                node.is_edit = true;
            },

            //验证
            check:function(node,e){
                if(!node.val){
                    alert('值不准为空');
                    return;
                }
                node.is_edit = false;
                this.submit(node,e);
            },
            //新增
            add:function(){
                var new_obj = {
                    'name':{
                        'is_edit':true,
                        'val':''
                    },
                    'des':{
                        'is_edit':true,
                        'val':''
                    },
                    'unit':{
                        'is_edit':true,
                        'val':''
                    },
                    'unit_price':{
                        'is_edit':true,
                        'val':''
                    },
                    'use':{
                        'is_edit':true,
                        'val':''
                    },
                    'type':{
                        'jm':0,
                        'zx':0,
                        'gy':0
                    }
                };

                this.re_setmeter.push(new_obj);
                this.submit();
            },
            //删除
            del:function(index){
                if(window.confirm("确认删除？")) this.re_setmeter.splice(index, 1);
                this.submit();
            },
            //提交
            submit:function(node,e){

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
                return d;
            },
            //保存数据
            post:function(url,data){
                var d;
                $.ajax({
                    url:url,
                    data:data||{},
                    type:'post',
                    dataType:'json',
                    async: false,
                    success:function(re){
                        d = re;
                    }
                })
                return d;
            }

        }
    });
</script>

<!--自定义js代码区结束-->
<include file="Public_news:footer"/>


