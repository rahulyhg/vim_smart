<extend name="./tpl/System/Public_news/base_form.php" />
<block name="head">

</block>
<block name="body">
	<style type="text/css">
<!--
.form .form-actions, .portlet-form .form-actions {
    padding: 20px;
    margin: 0;
    background-color: #f5f5f5;
    border-top: none;
}
-->
</style>
    <div class="btn-group" style="height: 35px">
    <input type="checkbox" name="my-checkbox" checked >
    </div>
    <div class="alert alert-danger" style="display: inline;width: 80%;height: 35px">
        微信群发控制开关，<strong>使用完成后请务必关闭！</strong>
    </div>
    <form action="{pigcms{:U('save_group_msg_act')}" method="post" id="frm1">
        <!--选择社区-->
        <div class="form-group form-md-line-input">
            <label for="form_control_1" class="col-md-2 control-label">选择社区
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <select name="village_id" class="form-control" v-model="msg_info.village_id" >
                    <option v-bind:value="0">选择全部</option>
                    <option v-for="(item, index) in filter_village_list" v-bind:value="item.village_id">
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
                <select name="company_id" class="form-control" v-model="msg_info.company_id" >
                    <option v-bind:value="0">选择全部</option>
                    <option v-for="(item, index) in filter_company_list" v-bind:value="item.company_id">{{ item.company_name }}</option>
                </select>
            </div>
        </div>
        <!--发送类型-->
        <div class="form-group form-md-line-input">
            <label for="form_control_1" class="col-md-2 control-label">发送类型
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <div class="clearfix">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default" @click="msg_info.send_type='moment'" v-bind:class="{ active: msg_info.send_type=='moment'}">
                            <input type="radio" checked="checked" name="send_type" value="moment" v-model="msg_info.send_type" class="toggle"> 立即发送
                        </label>
                        <label class="btn btn-default"  @click="msg_info.send_type='fixed'"  v-bind:class="{ active: msg_info.send_type=='fixed'}">
                            <input type="radio"  name="send_type" value="fixed" v-model="msg_info.send_type" class="toggle"> 定时发送
                        </label>
                        <input v-show="msg_info.send_type=='fixed'"  type="timedate" id="send_date_str" name="send_time" placeholder="选择发送时间" style="height:34px;width:150px">
                    </div>
                </div>
            </div>
        </div>

        <!--图文消息-->
        <div>

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">标题
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <input v-model="msg_info.title" type="text" class="form-control" placeholder="" name="title" id="title"/>
                    <div class="form-control-focus"> </div>
                </div>
            </div>
        </div>
        <div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">摘要
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="" v-model="msg_info.digest" name="digest" id="digest"/>
                    <div class="form-control-focus"> </div>
                </div>
            </div>
        </div>



        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">发布内容
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <textarea id="description" v-model="msg_info.content" name="content" class="form-control" rows="6"  placeholder="写上一些想要发布的内容"></textarea>
            </div>
        </div>

		
		
        <div class="form-actions">
            <div class="row">
				<div class="col-md-offset-2 col-md-9" style="line-height:2; padding-top:10px; padding-bottom:10px;">
					<span style="color:#fb4746; font-size:18px;">发文规则：</span><br/>
					1、每段段落开头使用6个空格进行排版；<br/>
					2、落款需选中文字，并居右对齐；<br/>
				</div>
			
                <div class="col-md-offset-2 col-md-9">
                    <input type="hidden" name="id" v-bind:value="msg_info.msg_id">
                    <button type="submit" class="btn green">确认提交</button>
                    <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=GroupMsg&a=lists_news'">返 回</button>
                    <!--                    <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=House&a=group_msg_list_news'">返 回</button>
                    -->                </div>
            </div>
        </div>
    </form>


</block>

<block name="script">
    <script>

        //发送时间


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
                $.datetimepicker.setLocale('ch');//设置中文
                $('#send_date_str').datetimepicker({
                    lang:"ch",           //语言选择中文
                    format:"Y-m-d H:i:s",      //格式化日期
                    //timepicker:false,    //关闭时间选项
                    yearStart:2000,     //设置最小年份
                    yearEnd:2050,        //设置最大年份
                    todayButton:false    //关闭选择今天按钮
                });

            });







        new Vue({
            el:'#frm1',
            data:{
                village_list:app_json.village_list,
                company_list:app_json.company_list,
                admin_village_id:0,
                is_edit:0,
                msg_info:{
                    msg_id:0,
                    village_id:0,
                    company_id:0,
                    send_type:'moment',
                    msg_type:'image_text',
                    content:'',//消息内容
                    title:'',//标题
                    digest:'',//摘要
                },

            },
            mounted:function(){
                this.edit_init();
            },
            methods:{
                edit_init:function(){
                    if(app_json.msg_info&&app_json.msg_info.msg_id>0){
                        this.msg_info = app_json.msg_info;
                        this.is_edit = 1;
                    }
                }
            },


            computed:{
                //过滤社区列表
                filter_village_list:function(){
                    var list = this.village_list,
                        tmp = [];
                    if(this.admin_village_id){
                        for(var i in list){
                            var row = list[i];
                            if(row.village_id === this.admin_village_id){
                                tmp.push(row);
                                break;
                            }
                        }
                        list = tmp;
                    }

                    //排序
                    function compare(a,b){
                        return a.village_id - b.village_id;
                    }

                    list.sort(compare);

                    return list;


                },

                //过滤公司列表
                filter_company_list:function(){
                    var list = this.company_list,
                        tmp = [];
                    if(this.msg_info.village_id){
                        for(var i in list){
                            var row = list[i];
                            if(row.village_id === this.msg_info.village_id){
                                tmp.push(row);
                            }
                        }
                    }
                    list = tmp;
                    //排序
                    function compare(a,b){
                        return a.company_id-b.company_id;
                    }

                    list.sort(compare);

                    return list;
                }
            },
        });





    </script>
</block>