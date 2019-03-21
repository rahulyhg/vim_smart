<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <style>
        td {
            text-align:center!important;
            vertical-align:middle!important;
        }
        th {
            text-align:center!important;
            vertical-align:middle!important;
        }
        .record_check_time{
            width: 100px;
            border: none;
            text-align: center;
            height: 30px;
        }
    </style>
    <link href="/Car/Admin/Public/assets/global/plugins/bootstrap-fileinput/fileinput.min.css" rel="stylesheet" type="text/css"/>
    <div class="btn-group" style="margin-top:10px;">
            <span id="filter">
                <span>
					<span style="line-height:30px;">考勤条目添加</span>
                    <div class="btn-group">
                        <select id="add_type"  class="form-inline search" style="line-height:34px; height:34px; border:1px #CCCCCC solid; margin-right:7px; margin-top:-1px;">
                                <option value="">选择需要添加的考勤类型</option>
                                <option value="type_0">全勤</option>
                                <option value="type_1">入/离职</option>
                                <option value="type_2">请假/旷工</option>
                                <option value="type_3">迟到/早退</option>
                                <option value="type_4">加班</option>
                                <option value="type_5">晋升/降免/调岗</option>
                        </select>
                    </div>
                </span>
                    <input class="btn green " type="button" value="添加" onclick="addrow()"/>
            </span>
    </div>
</block>
<block name="body">

    <form action="__SELF__" method="post" enctype="multipart/form-data" id="form">
    <div class="tabbable-custom nav-justified" style="width:100%;overflow-x: scroll;">
        <table class="table table-striped table-bordered table-hover" id="sample_2" >
            <thead>
            <tr>
                <td colspan="13" align="center" style="font-size: 25px">{pigcms{:date('Y年m月',strtotime('-1 month',$check_in_info['uploadtime']))}年{pigcms{$check_in_info['department_info']['deptname']}员工月考勤汇总表</td>
            </tr>
            <tr>
                <th width="5%" rowspan="3">序号</th>
                <th width="10%" rowspan="3">类别</th>
                <th width="10%" rowspan="3">姓名</th>
                <th width="5%" rowspan="2">出勤</th>
                <th width="5%" rowspan="2">休假</th>
                <th width="15%" colspan="3">请假</th>
                <th width="5%" rowspan="2">迟到</th>
                <th width="5%" rowspan="2">早退</th>
                <th width="5%" rowspan="2">旷工</th>
                <th width="20%" rowspan="3">备注</th>
                <th width="5%" rowspan="3">操作</th>
            </tr>
            <tr>
                <th>病假</th>
                <th>事假</th>
                <th>其它</th>
            </tr>
            <tr>
                <th>天数</th>
                <th>天数</th>
                <th>天数</th>
                <th>天数</th>
                <th>天数</th>
                <th>次数</th>
                <th>次数</th>
                <th>次数</th>
            </tr>
            </thead>
            <tbody>
            <foreach name="check_in_info['type_0']" item="vo" key="key">
                <tr>
                    <td>{pigcms{:++$count}.</td>
                    <if condition="$key eq 0">
                        <td rowspan="{pigcms{:count($check_in_info['type_0'])}">全勤</td>
                    </if>
                    <td><input value="{pigcms{$vo['name']}" name="type_0[{pigcms{$key}][name]" type="text" class="record_check_time"/></td>
                    <foreach name="vo['info']" item="vo1" key="key1">
                        <td><input value="{pigcms{$vo1}" name="type_0[{pigcms{$key}][info][{pigcms{$key1}]" type="text" class="record_check_time"/></td>
                    </foreach>
                    <td><input value="{pigcms{$vo['remark']}" style="width: auto" name="type_0[{pigcms{$key}][remark]" type="text" class="record_check_time"/></td>
                    <td>
                        <button type="button" class="btn btn-xs red" onclick="deleteRow(this)">
                            删除此行
                        </button>
                    </td>
                </tr>
            </foreach>
            <foreach name="check_in_info['type_1']" item="vo" key="key">
                <tr>
                    <td>{pigcms{:++$count}.</td>
                    <if condition="$key eq 0">
                        <td rowspan="{pigcms{:count($check_in_info['type_1'])}">入/离职</td>
                    </if>
                    <td><input value="{pigcms{$vo['name']}" name="type_1[{pigcms{$key}][name]" type="text" class="record_check_time"/></td>
                    <foreach name="vo['info']" item="vo1" key="key1">
                        <td><input value="{pigcms{$vo1}" name="type_1[{pigcms{$key}][info][{pigcms{$key1}]" type="text" class="record_check_time"/></td>
                    </foreach>
                    <td><input value="{pigcms{$vo['remark']}" style="width: auto" name="type_1[{pigcms{$key}][remark]" type="text" class="record_check_time"/></td>
                    <td>
                        <button type="button" class="btn btn-xs red" onclick="deleteRow(this)">
                            删除此行
                        </button>
                    </td>
                </tr>
            </foreach>
            <foreach name="check_in_info['type_2']" item="vo" key="key">
                <tr>
                    <td>{pigcms{:++$count}.</td>
                    <if condition="$key eq 0">
                        <td rowspan="{pigcms{:count($check_in_info['type_2'])}">请假/旷工</td>
                    </if>
                    <td><input value="{pigcms{$vo['name']}" name="type_2[{pigcms{$key}][name]" type="text" class="record_check_time"/></td>
                    <foreach name="vo['info']" item="vo1" key="key1">
                        <td><input value="{pigcms{$vo1}" name="type_2[{pigcms{$key}][info][{pigcms{$key1}]" type="text" class="record_check_time"/></td>
                    </foreach>
                    <td><input value="{pigcms{$vo['remark']}" style="width: auto" name="type_2[{pigcms{$key}][remark]" type="text" class="record_check_time"/></td>
                    <td>
                        <button type="button" class="btn btn-xs red" onclick="deleteRow(this)">
                            删除此行
                        </button>
                    </td>
                </tr>
            </foreach>
            <foreach name="check_in_info['type_3']" item="vo" key="key">
                <tr>
                    <td>{pigcms{:++$count}.</td>
                    <if condition="$key eq 0">
                        <td rowspan="{pigcms{:count($check_in_info['type_3'])}">迟到/早退</td>
                    </if>
                    <td><input value="{pigcms{$vo['name']}" name="type_3[{pigcms{$key}][name]" type="text" class="record_check_time"/></td>
                    <foreach name="vo['info']" item="vo1" key="key1">
                        <td><input value="{pigcms{$vo1}" name="type_3[{pigcms{$key}][info][{pigcms{$key1}]" type="text" class="record_check_time"/></td>
                    </foreach>
                    <td><input value="{pigcms{$vo['remark']}" style="width: auto" name="type_3[{pigcms{$key}][remark]" type="text" class="record_check_time"/></td>
                    <td>
                        <button type="button" class="btn btn-xs red" onclick="deleteRow(this)">
                            删除此行
                        </button>
                    </td>
                </tr>
            </foreach>
            <foreach name="check_in_info['type_4']" item="vo" key="key">
                <tr>
                    <td>{pigcms{:++$count}.</td>
                    <if condition="$key eq 0">
                        <td rowspan="{pigcms{:count($check_in_info['type_4'])}">加班</td>
                    </if>
                    <td><input value="{pigcms{$vo['name']}" name="type_4[{pigcms{$key}][name]" type="text" class="record_check_time"/></td>
                    <foreach name="vo['info']" item="vo1" key="key1">
                        <td><input value="{pigcms{$vo1}" name="type_4[{pigcms{$key}][info][{pigcms{$key1}]" type="text" class="record_check_time"/></td>
                    </foreach>
                    <td><input value="{pigcms{$vo['remark']}" style="width: auto" name="type_4[{pigcms{$key}][remark]" type="text" class="record_check_time"/></td>
                    <td>
                        <button type="button" class="btn btn-xs red" onclick="deleteRow(this)">
                            删除此行
                        </button>
                    </td>
                </tr>
            </foreach>
            <foreach name="check_in_info['type_5']" item="vo" key="key">
                <tr>
                    <td>{pigcms{:++$count}.</td>
                    <if condition="$key eq 0">
                        <td rowspan="{pigcms{:count($check_in_info['type_5'])}">晋升/降免/调岗</td>
                    </if>
                    <td><input value="{pigcms{$vo['name']}" name="type_5[{pigcms{$key}][name]" type="text" class="record_check_time"/></td>
                    <foreach name="vo['info']" item="vo1" key="key1">
                        <td><input value="{pigcms{$vo1}" name="type_5[{pigcms{$key}][info][{pigcms{$key1}]" type="text" class="record_check_time"/></td>
                    </foreach>
                    <td><input value="{pigcms{$vo['remark']}" style="width: auto" name="type_5[{pigcms{$key}][remark]" type="text" class="record_check_time"/></td>
                    <td>
                        <button type="button" class="btn btn-xs red" onclick="deleteRow(this)">
                            删除此行
                        </button>
                    </td>
                </tr>
            </foreach>
            <tr>
                <td colspan="2">考勤员：</td>
                <td colspan="2"><input value="{pigcms{$check_in_info['ci_name']}" name="ci_name" type="text" class="record_check_time"/></td>
                <td colspan="8"></td>
            </tr>
            <tr>
                <td colspan="2">部门/服务中心负责人：</td>
                <td colspan="2"><input value="{pigcms{$check_in_info['pm_name']}" name="pm_name" type="text" class="record_check_time"/></td>
                <td colspan="8"></td>
            </tr>
            <foreach name="check_in_info['type_file']" item="vo" key="key">
                <tr>
                    <if condition="$key eq 0">
                        <td rowspan="{pigcms{:count($check_in_info['type_file'])}">附件下载</td>
                    </if>
                    <td colspan="3">{pigcms{$vo['name']}</td>
                    <td><a href="{pigcms{$vo['pic']}" download="{pigcms{$vo['name']}">下载</a></td>
                    <td  colspan="7"></td>
                </tr>
            </foreach>
            <if condition="$check_in_info['type_file']">
                <tr>
                    <td colspan="12"><a href="{pigcms{:U('check_download_file',array('id'=>$check_in_info['check_in_id']))}" >打包下载全部附件</a></td>
                </tr>
            </if>
            <tr>
                <td>附件更改</td>
                <td colspan="8">
                    <input id="itemImagers" name="" type="file" data-show-preview="true" data-show-caption="true" multiple>
                    <input id="content" name="content" type="hidden" value='<foreach name="check_in_info['type_file']" item="vo" key="key">,{pigcms{$vo['pigcms_id']}</foreach>'>
                </td>
            </tr>
            <tr>
                <td>审核备注</td>
                <td colspan="8">
                    <textarea name="remark" style="width: 100%"></textarea>
                </td>
                <td colspan="3">
                </td>
            </tr>
            </tbody>
        </table>
    </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-5 col-md-9">
                        <button type="submit" class="btn green" onclick="add_status(2)">保存并审核通过</button>
                        <button type="submit" class="btn red" onclick="add_status(1)">仅保存</button>
                    </div>
                </div>
            </div>
    </form>

</block>
<block name="script">
    <script src="/Car/Admin/Public/assets/global/plugins/bootstrap-fileinput/fileinput.min.js"></script>
    <script src="/Car/Admin/Public/assets/global/plugins/bootstrap-fileinput/piexif.js"></script>
    <script src="/Car/Admin/Public/assets/global/plugins/bootstrap-fileinput/zh.min.js"></script>
    <script>
        var count=new Array();
        count['type_0']="{pigcms{$count_list['type_0']}";
        count['type_1']="{pigcms{$count_list['type_1']}";
        count['type_2']="{pigcms{$count_list['type_2']}";
        count['type_3']="{pigcms{$count_list['type_3']}";
        count['type_4']="{pigcms{$count_list['type_4']}";
        count['type_5']="{pigcms{$count_list['type_5']}";
        var rows='{pigcms{$count}';
        //添加一行
        function insertRow(type,type_name){
            var tab=document.getElementById("sample_2");
            count[type]++;
            var tr=tab.insertRow((++rows+3));
            var td=tr.insertCell(0);
            var td=tr.insertCell(1);
            td.innerHTML=type_name;
            var td=tr.insertCell(2);
            td.innerHTML='<input value="" name="'+type+'['+count[type]+'][name]" type="text" class="record_check_time"/>';
            <for start="0" end="8">
                    var i={pigcms{$i}+3;
            var td=tr.insertCell(i);
            td.innerHTML='<input value="" name="'+type+'['+count[type]+'][info][{pigcms{$i}]" type="text" class="record_check_time"/>';
            </for>
            var td=tr.insertCell(11);
            td.innerHTML='<input value="" style="width: auto" name="'+type+'['+count[type]+'][remark]" type="text" class="record_check_time"/>';
            var td=tr.insertCell(12);
            td.innerHTML=' <button class="btn btn-xs red" type="button" onclick="deleteRow(this)">删除此行 </button>';
        }
        //删除一行
        function deleteRow(r)
        {
            $(r).parents("tr").remove();
            rows--;
        }
        function addrow() {
            if($("#add_type option:selected").val()){
                insertRow($("#add_type option:selected").val(),$("#add_type option:selected").text());
            }else{
                return false;
            }
        }
        $.datetimepicker.setLocale('ch');

        //指定上传controller访问地址
        var path = "{pigcms{:U('img_upload')}";
        //页面初始化加载initFileInput()方法传入ID名和上传地址
        var control = $('#itemImagers');
        control.fileinput({
            language: 'zh', //设置语言
            uploadUrl: path,  //上传地址
            showUpload: false, //是否显示上传按钮
            showRemove:false,
            dropZoneEnabled: false,
            showCaption: true,//是否显示标题
            maxFileSize : 2000,
            maxFileCount: 5,
            overwriteInitial: false, //不覆盖已存在的图片
                //设置缩略图样式
                fileActionSettings:{
                    showRemove: false
                },
            //下面几个就是初始化预览图片的配置
            <if condition="$check_in_info['type_file']">
            initialPreviewAsData: true,
            initialPreview:{pigcms{$pic_list} , //要显示的图片的路径
            initialPreviewConfig:{pigcms{$con}
            </if>

        }).on("filebatchselected", function(event, files) {
            $(this).fileinput("upload");
        })
            .on("fileuploaded", function(event, data) {
                $('#content').val($('#content').val()+','+data.response.data);
                console.log(data);
            }).on("filesuccessremove", function(event, id) {
            console.log(event);
            console.log(id);
        }).on('filepredelete', function(event, key, jqXHR, data) {
            console.log('Key = ' + key);
            console.log(jqXHR);
            console.log(data);
        });
        function add_status(status) {
            $('#form').append('<input value="'+status+'" name="status" type="hidden" />');
        }

    </script>
</block>




