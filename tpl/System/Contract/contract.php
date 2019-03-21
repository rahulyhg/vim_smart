<extend name="./tpl/System/Public_news/base.php" />
<block name="body">
            <style>
                .ace-file-input a {display:none;}
            </style>
                    <button style="float: left;" class="btn btn-success" onclick="CreateContract()">新建合同</button>
                    <div class="btn-group" style="float: left; margin-left: 5px;">
                        <a href="{pigcms{:U('contract_import_step')}">
                            <button id="sample_editable_1_new" class="btn sbold green">批量导入合同
                                <i class="fa fa-plus"></i>
                            </button>
                        </a>
                    </div>
                    <div style="float: right; margin-bottom: 10px;">
                        <span>筛选：</span>
                        <span>
                            <div class="btn-group">
                               <select name="contract_time_id" id="contract_time_id" class="form-control">
                                    <option value="0">请选择合同状态</option>
                                    <option value="1" <if condition="$contract_time_id eq 1">selected="selected"</if>>全部合同</option>
                                    <option value="2" <if condition="$contract_time_id eq 2">selected="selected"</if>>正常合同</option>
                                    <option value="3" <if condition="$contract_time_id eq 3">selected="selected"</if>>即将到期合同</option>
                                    <option value="4" <if condition="$contract_time_id eq 4">selected="selected"</if>>已过期合同</option>
                                    <option value="5" <if condition="$contract_time_id eq 5">selected="selected"</if>>特殊合同</option>
                                </select>
                            </div>
                        </span>
                        <span>
                            <div class="btn-group">
                               <select name="contract_type" id="contract_type" class="form-control">
                                    <option value="0">请选择合同分类</option>
                                    <option value="1" <if condition="$type eq 1">selected="selected"</if>>收入合同</option>
                                    <option value="2" <if condition="$type eq 2">selected="selected"</if>>支出合同</option>
                                    <option value="3" <if condition="$type eq 3">selected="selected"</if>>其他合同</option>
                                </select>
                            </div>
                        </span>
                    </div>
                    <div id="shopList" class="grid-view">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <!-- <th>编号</th>
                                <th>社区名称</th> -->
                                <th>所属分公司</th>
                                <th>合同名称</th>
                                <th>合同编号</th>
                                <th>甲方</th>
                                <th>乙方</th>
                                <th>丙方</th>
                                <th>起始日期</th>
                                <th>截止日期</th>
                                <!-- <th>备注</th> -->
                                <th>合同状态</th>
                                <th>经办人</th>
                                <th>合同分类</th>
                                <!-- <th>合同时长</th> -->
                                <!-- <th>合同状态</th> -->
                                <!-- <th>创建人员</th>
                                <th>创建时间</th> -->
                                <th class="button-column" style="width:100px;">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <if condition="$shequArr">
                                <volist name="shequArr" id="vo">
                                    <tr />
                                    <!-- <td>{pigcms{$vo.id}</td>
                                    <td>{pigcms{$vo.village_name}</td> -->
                                    <td>{pigcms{$vo.company}</td>
                                    <td>{pigcms{$vo.contract_name}</td>
                                    <td>{pigcms{$vo.contract_number}</td>
                                    <td>{pigcms{$vo.first_party}</td>
                                    <td>{pigcms{$vo.second_party}</td>
                                    <td>{pigcms{$vo.third_party}</td>
                                    <td>{pigcms{$vo.contract_start}</td>
                                    <td>{pigcms{$vo.contract_end}</td>
                                    <!-- <td>{pigcms{$vo.contract_time}</td> -->
                                    <!-- <td>
                                        <div class="progress">
                                            <if condition="$vo['rate'] lt 60">
                                                <div class="progress-bar progress-bar-success" style="width: {pigcms{$vo.rate}%">{pigcms{$vo.rate}%</div>
                                            <elseif condition="$vo['rate'] egt 60 and $vo['rate'] lt 90"/>
                                                <div class="progress-bar progress-bar-warning" style="width: {pigcms{$vo.rate}%">{pigcms{$vo.rate}%</div>
                                            <elseif condition="$vo['rate'] egt 90 and $vo['rate'] lt 100"/>
                                                <div class="progress-bar progress-bar-danger" style="width: {pigcms{$vo.rate}%">{pigcms{$vo.rate}%</div>
                                            <else/>
                                                <div class="progress-bar progress-bar-info" style="width: {pigcms{$vo.rate}%">{pigcms{$vo.rate}%</div>
                                            </if>
                                        </div>
                                    </td> -->
                                    <td>
                                        <div>
                                            <if condition="$vo['rate'] eq 1">
                                                <if condition="$vo['status'] eq 1">
                                                    <button class="btn btn-sm green btn-outline filter-submit margin-bottom" id="contract_{pigcms{$vo.id}" value="{pigcms{$vo.status}" onclick="changeType(this)">正常合同</button>
                                                    <input type="hidden" id="contract_{pigcms{$vo.id}_id" value="{pigcms{$vo['id']}">
                                                <else/>
                                                    <button class="btn btn-sm red btn-outline filter-submit margin-bottom" id="contract_{pigcms{$vo.id}" value="{pigcms{$vo.status}" onclick="changeType(this)">终止合同</button>
                                                    <input type="hidden" id="contract_{pigcms{$vo.id}_id" value="{pigcms{$vo['id']}">
                                                </if>                                               
                                            <elseif condition="$vo['rate'] eq 2"/>
                                                <button class="btn btn-sm yellow btn-outline filter-submit margin-bottom">即将到期合同</button>
                                            <elseif condition="$vo['rate'] eq 3"/>
                                                <button class="btn btn-sm red btn-outline filter-submit margin-bottom">终止合同</button>
                                            <else/>
                                                <if condition="$vo['status'] eq 1">
                                                    <button class="btn btn-sm blue btn-outline filter-submit margin-bottom" id="contract_{pigcms{$vo.id}" value="{pigcms{$vo.status}" onclick="changeType1(this)">特殊合同</button>
                                                    <input type="hidden" id="contract_{pigcms{$vo.id}_id" value="{pigcms{$vo['id']}">
                                                <else/>
                                                    <button class="btn btn-sm red btn-outline filter-submit margin-bottom" id="contract_{pigcms{$vo.id}" value="{pigcms{$vo.status}" onclick="changeType1(this)">终止合同</button>
                                                    <input type="hidden" id="contract_{pigcms{$vo.id}_id" value="{pigcms{$vo['id']}">
                                                </if>                                               
                                            </if>
                                            <!-- <div class="progress-bar bg-success" style="width: 70%">70%</div> -->
                                        </div>
                                    </td>                                    
                                    <td>{pigcms{$vo.operator}</td>
                                    <!-- <if condition="$vo['classify'] eq 1">
                                        <td>收入</td>
                                    <elseif condition="$vo['classify'] eq 2"/>
                                        <td>支出</td>
                                    <elseif condition="$vo['classify'] eq 3"/>
                                        <td>其他</td>
                                    <else/>
                                        <td> </td>
                                    </if> -->
                                    <td>{pigcms{$vo.type}</td>
                                    <!-- <if condition="$vo['duration'] eq 1">
                                        <td>
                                        <button class="btn btn-sm green btn-outline filter-submit margin-bottom" id="time_{pigcms{$vo.id}" value="{pigcms{$vo.duration}" onclick="changeTime(this)">长期合同</button>
                                        <input type="hidden" id="time_{pigcms{$vo.id}_id" value="{pigcms{$vo['id']}">                  
                                        </td>
                                    <else/>
                                        <td>
                                        <button class="btn btn-sm red btn-outline filter-submit margin-bottom" id="time_{pigcms{$vo.id}" value="{pigcms{$vo.duration}" onclick="changeTime(this)">短期合同</button>
                                        <input type="hidden" id="time_{pigcms{$vo.id}_id" value="{pigcms{$vo['id']}">
                                        </td>
                                    </if> -->
                                    <!-- <if condition="$vo['status'] eq 1">
                                        <td>
                                        <button class="btn btn-sm green btn-outline filter-submit margin-bottom" id="contract_{pigcms{$vo.id}" value="{pigcms{$vo.status}" onclick="changeType(this)">正常合同</button>
                                        <input type="hidden" id="contract_{pigcms{$vo.id}_id" value="{pigcms{$vo['id']}">                  
                                        </td>
                                    <else/>
                                        <td>
                                        <button class="btn btn-sm red btn-outline filter-submit margin-bottom" id="contract_{pigcms{$vo.id}" value="{pigcms{$vo.status}" onclick="changeType(this)">终止合同</button>
                                        <input type="hidden" id="contract_{pigcms{$vo.id}_id" value="{pigcms{$vo['id']}">
                                        </td>
                                    </if> -->
                                    <!-- <td>{pigcms{$vo.admin_name}</td>
                                    <td>{pigcms{$vo.create_time|date="Y-m-d",###}</td> -->

                                    <td class="button-column" nowrap="nowrap">
                                        <a title="详情" class="green" style="padding-right:8px;" href="{pigcms{:U('contract_detail',array('id'=>$vo['id']))}" data-toggle="modal" data-target="#modal_{pigcms{$vo.id}">
                                            <i class="ace-icon fa fa-file bigger-130"></i>
                                        </a>
                                        <a title="修改" class="green" style="padding-right:8px;" href="{pigcms{:U('Contract/contract_edit',array('id'=>$vo['id']))}">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                        <a title="删除" class="red" style="padding-right:8px;" onclick="deleteContract('{pigcms{$vo['id']}')" href="javascript:;">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!--弹出层容器-->
                                <div class="modal fade" tabindex="-1" role="dialog" id="modal_{pigcms{$vo.id}">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">

                                        </div>
                                    </div>
                                </div>
                                <!--        弹出层容器-->
                                </volist>
                            <else/>
                            <tr class="odd"><td class="button-column" colspan="11" >无内容</td></tr>
                            </if>
                            </tbody>
                        </table>
                    </div>


</block>
<block name="script">
<script type="text/javascript">
    $(function(){
        jQuery(document).on('click','#shopList a.red',function(){
            if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;
        });

    });
    function deleteContract(id) {
        swal({
            title: "是否删除这份合同?",
            text: "删除合同后将无法恢复，确认要删除吗！",
            type: "warning",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "删除",
            cancelButtonText: "取消",
            closeOnConfirm: false,
            showCancelButton: true,
        }, function (iscom){
            if(iscom){
                window.location.href='{pigcms{:U('Contract/contract_del')}&id='+id;
            }else{
                swal.close();
            }
            /*$.post("{pigcms{:U('Contract/store_ajax_del_pic')}",{path:path});
             $(obj).closest('.upload_pic_li').remove();
             swal.close();*/
        });
    };
    function CreateContract(){
        window.location.href = "{pigcms{:U('Contract/contract_add')}";
    }

    $("select#contract_time_id").change(function(){
        var u = $(this).val();
        // var str = window.location.href;
        // var url = '';
        // if(str.indexOf("villageId")>0){
        //     url = str.substring(0,str.length-12);
        //     // console.log(url);
        // }else{
        //     url = str;
        // }
        location.href='http://www.hdhsmart.com/admin.php?g=System&c=Contract&a=contract'+'&contract_time_id='+u;
    });

    $("select#contract_type").change(function(){
        var type = $(this).val();
        var u = $("select#contract_time_id").val();
        $.ajax({
             url:'{pigcms{:U("contract")}',
             type:'get',
             data:{'type':type},
             success:function (res) {
                 if (res) {                 
                    location.href='http://www.hdhsmart.com/admin.php?g=System&c=Contract&a=contract'+'&contract_time_id='+u+'&contract_type='+type;
                 }
             }
         });
    });

    function changeType(id) {
        var status_id = $(id).attr('id');
        // var point_id_id = is_del+'_id';
        // console.log(status_id);

        var status = $("#"+status_id).val();
        var contract_id = $("#"+status_id+"_id").val();

        console.log(status);
        console.log(contract_id);

        $.ajax({
            url:'{pigcms{:U("contract_status")}',
            type:'post',
            data:{'status':status, 'contract_id':contract_id},
            success:function (re) {
                if (status == 1) {
                    if (re) {
                        $('#'+status_id).html('终止合同');
                        $('#'+status_id).css("background-color","red");
                        // alert('该点位已停用');
                    }
                } else {
                    if (re) {
                        $('#'+status_id).html('正常合同');
                        $('#'+status_id).css("background-color","green");
                        // alert('该点位已启用');
                    }
                }
            }
        });
    }

    function changeType1(id) {
        var status_id = $(id).attr('id');
        // var point_id_id = is_del+'_id';
        // console.log(status_id);

        var status = $("#"+status_id).val();
        var contract_id = $("#"+status_id+"_id").val();

        console.log(status);
        console.log(contract_id);

        $.ajax({
            url:'{pigcms{:U("contract_status")}',
            type:'post',
            data:{'status':status, 'contract_id':contract_id},
            success:function (re) {
                if (status == 1) {
                    if (re) {
                        $('#'+status_id).html('终止合同');
                        $('#'+status_id).css("background-color","red");
                        // alert('该点位已停用');
                    }
                } else {
                    if (re) {
                        $('#'+status_id).html('特殊合同');
                        $('#'+status_id).css("background-color","blue");
                        // alert('该点位已启用');
                    }
                }
            }
        });
    }

    // function changeTime(id) {
    //     var time_id = $(id).attr('id');
    //     // var point_id_id = is_del+'_id';
    //     // console.log(status_id);

    //     var duration = $("#"+time_id).val();
    //     var contract_id = $("#"+time_id+"_id").val();

    //     console.log(duration);
    //     console.log(contract_id);

    //     $.ajax({
    //         url:'{pigcms{:U("contract_duration")}',
    //         type:'post',
    //         data:{'duration':duration, 'contract_id':contract_id},
    //         success:function (re) {
    //             if (duration == 1) {
    //                 if (re) {
    //                     $('#'+time_id).html('短期合同');
    //                     $('#'+time_id).css("background-color","red");
    //                     // alert('该点位已停用');
    //                 }
    //             } else {
    //                 if (re) {
    //                     $('#'+time_id).html('长期合同');
    //                     $('#'+time_id).css("background-color","green");
    //                     // alert('该点位已启用');
    //                 }
    //             }
    //         }
    //     });
    // }
</script>
</block>
<!--<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>-->
