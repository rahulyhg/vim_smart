<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT -->
<style>
    .queueList.filled {
        padding: 17px 0;
    }
    .sa-confirm-button-container{
        display: inline;
    }
</style>
<link rel="stylesheet" href="http://www.hdhsmart.com/Car/Admin/Public/css/jquery.datetimepicker.css">
<script type="text/javascript" src="http://www.hdhsmart.com/Car/Admin/Public/js/jquery.datetimepicker.full.js"></script>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
           <div class="page-title">
               <h1>添加消息
               </h1>
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a>信息发布</a>
                <i class="fa fa-circle"></i>
            </li>
			<li>
                <a href="{pigcms{:U('group_msg_list_news')}">微信群发通知</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">添加消息</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <form id="frm" action="{pigcms{:U('add_group_msg_act',array('msg_id'=>I('get.msg_id')))}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <div class="col-md-12" style="float: left">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">添加消息</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-cloud-upload"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-wrench"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-trash"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->

                            <div class="form-body" id="app">
                                <div class="row">
                                    <div class="col-lg-9" style="position: relative">
<!--                                        右上漂浮框-->

<!--                                        <div style="position: absolute;top:0;right:13px;z-index:9999" >-->
<!---->
<!--                                            <a  @click="get_tpl" class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">-->
<!--                                                选择模板-->
<!--                                            </a>-->
<!--                                            <button class="btn btn-primary" type="button" id="save_tpl">-->
<!--                                                保存为模板-->
<!--                                            </button>-->
<!--                                            <div class="collapse" id="collapseExample">-->
<!--                                                <div class="well">-->
<!--                                                    <div class="list-group">-->
<!--                                                        <a v-for="(item, index) in tpl" href="#" @click="autofillform(item.id)" class="list-group-item">-->
<!--                                                            {{item.tpl_name}}<span @click="del_tpl(item,index)"  style="color:red;float: right">x</span>-->
<!--                                                        </a>-->
<!---->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!---->
<!--                                        </div>-->

<!--                                        右上漂浮框结束-->
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> 您填写的信息可能存在问题，请再检查 </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> 添加成功，请查看记录列表 </div>

                                        <!--选择社区-->
                                        <div class="form-group form-md-line-input">
                                            <label for="form_control_1" class="col-md-2 control-label">选择社区
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <select name="village_id" class="form-control" v-model="selected_village_id" v-on:change="get_company(selected_village_id)" >
                                                    <option v-bind:value="0">选择全部</option>
                                                    <option v-for="(item, index) in village_list" v-bind:value="item.village_id">
                                                        {{ item.village_name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--选择公司-->
                                        <div class="form-group form-md-line-input">
                                            <label for="form_control_1" class="col-md-2 control-label">选择公司
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <select name="company_id" class="form-control" v-model="selected_company_id" v-on:change="get_users(selected_village_id,selected_company_id)" >
                                                    <option v-bind:value="0">选择全部</option>
                                                    <option v-for="(item, index) in company" v-bind:value="item.company_id">{{ item.company_name }}</option>
                                                </select>
                                            </div>
                                        </div>
<!--                                        发送类型-->
                                        <div class="form-group form-md-line-input">
                                            <label for="form_control_1" class="col-md-2 control-label">发送类型
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <div class="clearfix">
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <label class="btn btn-default" @click="send_type='moment'" v-bind:class="{ active: send_type=='moment'}">
                                                            <input type="radio" checked="checked" name="send_type" value="moment" v-model="send_type" class="toggle"> 立即发送
                                                        </label>
                                                        <label class="btn btn-default"  @click="send_type='fixed'"  v-bind:class="{ active: send_type=='fixed'}">
                                                            <input type="radio"  name="send_type" value="fixed" v-model="send_type" class="toggle"> 定时发送
                                                        </label>
                                                        <input v-show="send_type=='fixed'" type="text" id="send_time" name="send_time" placeholder="  选择发送时间" style="height:34px;width:150px">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         <!--选择类别-->
                                        <div class="form-group form-md-line-input" v-show="false">
                                            <label for="form_control_1" class="col-md-2 control-label">选择类别
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <div class="clearfix">
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <label class="btn btn-default"  v-bind:class="{ active: msg_type=='text'}" @click="msg_type='text'">
                                                            <input type="radio" name="msg_type" value="text" v-model="msg_type" class="toggle"> 纯文本
                                                        </label>
                                                        <label class="btn btn-default" @click="msg_type='image'" v-bind:class="{ active: msg_type=='image'}">
                                                            <input type="radio" name="msg_type" value="image" v-model="msg_type" class="toggle"> 图片
                                                        </label>
                                                        <label class="btn btn-default"  @click="msg_type='image_text'" v-bind:class="{ active: msg_type=='image_text'}">
                                                            <input type="radio"  name="msg_type" value="image_text" v-model="msg_type" class="toggle"> 图文消息
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

<!--                                        纯文本-->



                                        <div v-show="msg_type=='text'">

                                        </div>
<!--                                            图文消息-->
                                        <div v-show="msg_type=='image_text'">

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">标题
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9">
                                                    <input v-bind:value="title" type="text" class="form-control" placeholder="" name="title" id="title"/>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-show="msg_type=='image_text'">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">摘要
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="" v-bind:value="digest" name="digest" id="digest"/>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-2 control-label" for="form_control_1">发布内容
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <textarea id="description" v-bind:value="content" name="content" class="form-control" rows="6"  placeholder="写上一些想要发布的内容"></textarea>
                                            </div>
                                        </div>


                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-9">
                                                    <button type="submit" class="btn green">确认提交</button>
                                                    <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=House&a=group_msg_list_news'">返 回</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3" style="height: 60rem; overflow: scroll;overflow-x: hidden">
                                        <div style="padding:10px 0">公司员工</div>
                                        <template  v-if="users.length>0">
                                            <div class="row">
                                                <div  v-for="(item, index) in users">
                                                    <div v-on:click="user_active">
                                                        <div style="margin-left: 0px; padding: 20px 56px 20px 72px; position: relative;">
                                                            <img size="40" v-bind:src="item.avatar" style="color: rgb(255, 255, 255); display: inline-flex; align-items: center; justify-content: center; font-size: 20px; border-radius: 50%; height: 40px; width: 40px; position: absolute; top: 8px; left: 16px; -webkit-user-select: none; background-color: rgb(188, 188, 188);">
                                                            <div>{{ item.nickname }}</div>
                                                        </div>
<!--                                                        <div class="caption">-->
<!--                                                            <img v-bind:src="item.avatar" alt="" style="width:100%">-->
<!--                                                            <p style="white-space:nowrap;text-overflow:ellipsis;overflow:hidden;">{{ item.nickname }}</p>-->
<!--                                                        </div>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </template >
                                        <template  v-else>
                                           <p class="text-info">暂无数据</p>
                                        </template >

                                    </div>
                                </div>

                            </div>
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer" style="text-align: center">
    <div class="page-footer-inner" style="width: 100%"> 2017 &copy; 汇得行智慧助手系统
        <a target="_blank" href="http://www.vhi99.com">微嗨科技</a> &nbsp;|&nbsp;
        <a href="http://www.metronic.com" target="_blank">Metronic</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<div class="quick-nav-overlay"></div>
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/excanvas.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/Car/Admin/Public/js/jquery.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!--表单提交检查js-->
<!--<script src="{$Think.config.ADMIN_ASSETS_URL}pages/scripts/form-validation-md.min.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--引入百度文件上传JS结束-->

<!--引入日历jquery插件开始-->
<!--
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.js" type="text/javascript"></script>
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.min.js" type="text/javascript"></script>-->

<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<!--引入日历jquery插件结束-->

<script type='text/javascript'>
    //开启日历插件
    $(function(){
        $("#mybutton").click(function(){
            var tr="<tr name='add_tr'><th width='80'>其他参数</th><td> <input type='text' class='input fl' name='arguments[]' size='10' placeholder='参数'/> <input type='text' class='input fl' name='arguments_value[]' size='10' placeholder='参数值'/></td></tr>";
            $("*[name='add_tr']:last").after(tr);
        });
        $("#mybutton2").click(function(){
            var td_length = $("#form_sample_1 input").length;
            var pot = td_length-2;
            if(td_length>7){
                $("#table tr:eq("+pot+")").remove();
            }
        });
    });
    $('#datetimepicker').datetimepicker({
        lang:"ch",           //语言选择中文
        format:"Y-m-d H:i:s",      //格式化日期
        timepicker:false,    //关闭时间选项
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        todayButton:false    //关闭选择今天按钮
    });
    $('#datetimepicker2').datetimepicker({
        lang:"ch",           //语言选择中文
        format:"Y-m-d H:i:s",      //格式化日期
        timepicker:false,    //关闭时间选项
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        todayButton:false    //关闭选择今天按钮
    });

</script>
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script src="./static/js/vue.min.js"></script>
<link rel="stylesheet" href="http://www.hdhsmart.com/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css">
<script src="http://www.hdhsmart.com/Car/Admin/Public/js/sweetalert.min.js"></script>
<script src="http://www.hdhsmart.com/Car/Admin/Public/js/ui-sweetalert.min.js"></script>
<script>
var kind_editor;
KindEditor.ready(function(K){

    window.kind_editor = K.create("#description",{

        width:'95%',

        height:'400px',

        resizeType : 1,

        allowPreviewEmoticons:false,

        allowImageUpload : true,

        filterMode: true,

        items : [

            'source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',

            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',

            'insertunorderedlist', '|', 'emoticons', 'image', 'link'

        ],

        emoticonsPath : './static/emoticons/',

        uploadJson : "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=merchant/news",

        allowFileManager : true

    });

});



/**
 * 三级联动
 * @update-time: 2017-07-19 14:57:18
 * @author: 王亚雄
 */
var model = new Vue({
    el: '#app',

    data: {
        //社区
        village_list:[],
        //公司
        company:[],
        //用户
        users:[],
        //社区默认选择
        selected_village_id:"0",
        //公司默认选择
        selected_company_id:"0",
        //消息类型
        msg_type:'image_text',
        //发送时间
        send_type:'moment',
        //标题
        title:'',
        //描述
        digest:'',
        //内容，
        content:'',
        //模板
        tpl:[],


    },
    //构造函数
    mounted: function () {


        this.village_list  = this.get('{pigcms{:U("ajax_get_village")}');
        //若自带village_id

        var village_id = parseInt("{pigcms{:session('system.village_id')}")||0;
        var msg_id = parseInt("{pigcms{:I('get.msg_id')}");

        if(msg_id){
            this.edit(msg_id);
        }else{//非编辑的时候 自带village_id 使用自己的village_id
            if(village_id){
                $('select[name="village_id"]').attr("disabled","disabled");
                this.selected_village_id = village_id;
                //disable 会屏蔽 name=village_id的值 所以 替代
                $('#frm').append('<input type="hidden" name="village_id" value="'+village_id+'">');
                this.get_company(village_id);
            }
        }


    },
    methods: {
        /**
         * 编辑时的初始化操作
         */
        edit:function(msg_id){
            var msg_data = this.get_msg_info(msg_id);
            this.selected_village_id = msg_data.village_ids;

            this.get_company(this.selected_village_id);
            this.selected_company_id = msg_data.company_ids;

            this.get_users(this.selected_village_id,this.selected_company_id);

            this.msg_type = msg_data.msg_type;
            this.send_type = msg_data.send_type;
            this.digest = msg_data.digest;
            //this.content = form_data.content;
            this.title = msg_data.title;
            window.setTimeout(function(){
                kind_editor.html(msg_data.content);
            },500)

        },
        //获取消息
        get_msg_info:function(msg_id){
            return  this.get('{pigcms{:U("get_msg_info")}',{'msg_id':msg_id});
        },
        //获取社区
        get_village:function(){
            this.village_list  = this.get('{pigcms{:U("ajax_get_village")}');
            //将公司选择重置
            this.get_company(0);
        },
        //获取公司
        get_company:function(village_id){
            this.company = this.get('{pigcms{:U("ajax_get_company")}',{village_id:village_id});
            //将显示用户重置
            this.get_users(village_id,0);
        },
        //获取用户
        get_users:function(village_id,company_id){
            this.users = this.get('{pigcms{:U("ajax_get_users")}',{village_id:village_id,company_id:company_id});
        },
        //获取模板
        get_tpl:function(){
            this.tpl = this.get('{pigcms{:U("ajax_get_tpl")}');
        },
        //自动填充
        autofillform:function(tpl_id){
            var form_data = this.get('{pigcms{:U("ajax_get_tpl")}',{tpl_id:tpl_id});
            this.msg_type = form_data.msg_type;
            this.send_type = form_data.send_type;
            this.digest = form_data.digest;
            //this.content = form_data.content;
            this.title = form_data.title;
            kind_editor.html(form_data.content);
        },
        del_tpl:function(node,index){
            var re = this.get('{pigcms{:U("ajax_del_tpl")}',{tpl_id:node.id});
            if(re){
                this.tpl.splice(index, 1);
            }else{
                alert("发生错误");
            }
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
        },
        //用户选择
        user_active:function(){

        }

    }
});




    //发送时间
    $.datetimepicker.setLocale('ch');//设置中文
    $('#send_time').datetimepicker({
        lang:"ch",           //语言选择中文
        format:"Y-m-d H:i:s",      //格式化日期
        //timepicker:false,    //关闭时间选项
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        todayButton:false    //关闭选择今天按钮
    });


$('#save_tpl').click(function(){
    swal({
        title: "请输入模板名称",
        text: "请输入模板名称",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "请输入模板名称"
    }, function(inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") {
            swal.showInputError("请输入模板名称");
            return false
        }
        var re = save_tpl(inputValue);
        console.log(re);
        swal("Nice!", "你保存了模板");
    });
});


function save_tpl(tpl_name){
    var data = $('form').serialize();
    var d;
    $.ajax({
        url:"{pigcms{:U('save_tpl')}",
        data:data + '&tpl_name=' + tpl_name + '&content=' + kind_editor.html(),
        type:'post',
        dataType:'json',
        async: false,
        success:function(re){

            d= re;
        }
    });
    return d;
}


</script>

</body>

</html>