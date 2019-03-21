<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal-head">
    <style>
        .bg-floor{
            background-color: #00f0ff;
        }
    </style>
    <style type="text/css">
        .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td{
            border: 1px solid #dddddd;
        }
    </style>
</block>
<block name="modal_body">
    <form action="__SELF__" method="post" enctype="multipart/form-data" id="form">
    <div class="form-actions">
        <div class="row" style="margin-top:30px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <if condition="empty($display_button)">
                    <if condition="$action_now and $action_now['status'] eq $predict_info['status']">
                        <tr>
                            <td height="50" style="border:1px #e7ecf1 solid; border-top:none;">&nbsp;</td>
                            <td height="50" colspan="2" align="left" style="border:1px #e7ecf1 solid; border-top:none; border-left:none;">
                                <textarea  name="remark" style="width:95%; height:80px; border:1px #e7ecf1 solid; margin-top:10px;" placeholder="填写备注"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td height="50" style="border:1px #e7ecf1 solid; border-top:none;">&nbsp;</td>
                            <td height="50" colspan="2" align="left" style="border:1px #e7ecf1 solid; border-top:none; border-left:none;">
                                <a href="#add_status" data-toggle="modal"><button type="button" class="btn default" >退回修改</button></a>
                                <a href="{pigcms{:U('edit_predict_one',array('id'=>$predict_info['predict_id']))}"><button type="button" class="btn green" style="margin-left: 2.5%">调整预算金额</button></a>
                                <button type="button" class="btn red"  onclick="add_status_check({pigcms{$action_now['next']['status']},'审核通过')">{pigcms{$action_now['next']['name']}</button>


                            </td>
                        </tr>
                    </if>
                </if>

            </table>

        </div>
    </div>
    <div  id="add_status" class="modal fade" role="dialog" aria-hidden="true" >
        <div class="modal-dialog" style="width: 60%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">退回步骤列表</h4>
                </div>
                <div style="width:100%;">

                    <div class="portlet-body form form-horizontal">
                        <div class="col-md-12" style="text-align:center;">
                            <foreach name="action_now['return']" item="vo">
                                <button type="button" class="btn red" onclick="add_status_check({pigcms{$vo['status']},'{pigcms{$vo['name']}')">{pigcms{$vo['name']}</button><br/><br/>
                            </foreach>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</block>
<block name="modal_script">
    <script>
        function add_status(status) {
            $('#form').append('<input value="'+status+'" name="status" type="hidden" />');
        }
        function add_status_check(status,text) {
            add_status(status);
            swal({
                    title: "确认执行"+text+"吗？",
                    text: "请确认",
                    type: "warning",
                    html:true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确认",
                    cancelButtonText: "取消",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm){
                    if (isConfirm) {
                        $("#form").submit();
                    }
                });
        }
    </script>
</block>