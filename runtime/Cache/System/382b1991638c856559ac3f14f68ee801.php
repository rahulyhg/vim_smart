<?php if (!defined('THINK_PATH')) exit();?>

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

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"><?php echo ($modal_title); ?></h4>
</div>
<div class="modal-body" style="height: 45rem;overflow-y: scroll">
  
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
            <th width="5%">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th width="10%">预算名称</th>
            <th width="5%">预算金额</th>
            <th width="5%">时间</th>
            <th width="10%">所属项目</th>
            <th width="10%">所属公司</th>
            <th width="10%">备注</th>
            <th width="10%">支付凭证</th>
            <th width="10%">状态</th>
            <th width="10%">审核时间</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($record_list)): $i = 0; $__LIST__ = $record_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" value="<?php echo ($vo["pigcms_id"]); ?>-<?php echo ($vo["type_id"]); ?>" />
                    <span></span>
                </label>
            </td>
            <td><div class="shopNameDiv"><?php echo ($vo["record_name"]); ?></div></td>
            <td><div class="tagDiv"><?php echo ($vo["record_money"]); ?></div></td>
            <td><div class="tagDiv"><?php echo ($vo["record_time"]); ?></div></td>
            <td><div class="tagDiv"><?php echo ($vo["village_name"]); ?></div></td>
            <td><div class="tagDiv"><?php echo ($vo["company_name"]); ?></div></td>
            <td><div class="tagDiv"><?php echo ($vo["record_remark"]); ?></div></td>
            <td><div class="tagDiv"><input value="<?php echo ($vo["record_number"]); ?>" type="text" style="border: none;text-align: center;height: 30px;" onchange="change_number(this,<?php echo ($vo["record_id"]); ?>)"/></div></td>
            <td><div class="tagDiv"><?php echo ($vo["record_status_name"]); ?></div></td>
            <td>
                <div class="tagDiv">
                    <?php if($vo['record_status'] != 1): echo ($vo['record_check_name']); ?><br/>
                        <?php echo date('Y-m-d H:i:s',$vo['record_check_time']); endif; ?>
                </div>
            </td>
            <td class="button-column">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                        <li>
                            <a href="<?php echo U('Budget/check_record',array('id'=>$vo['record_id']));?>" >
                                <i class="icon-tag"></i> 查看详情 </a>
                        </li>
                        <?php if($vo['record_status']==3): ?><li>
                                <a href="<?php echo U('Budget/check_record_delete',array('record_id'=>$vo['record_id']));?>" >
                                    <i class="icon-tag"></i> 删除此条 </a>
                            </li><?php endif; ?>

                    </ul>
                </div>
            </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>

</div>
<div class="modal-footer">
    
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>
<!--<script src="./static/js/vue.min.js"></script>-->
<!--<script src="./static/js/vue-route.js"></script>-->
<!--<script src="./static/js/vue-resource.min.js"></script>-->

    <script>
        function change_number(name,id) {
            var record_number=$(name).val();
            var url="<?php echo U('Budget/ajax_change_number');?>";
            $.ajax({
                url:url,
                type:'post',
                data:'id='+id+'&record_number='+record_number,
                dataType:'json',
                success:function (re) {
                    if(re.err==0){
                        swal({
                            title: "修改成功！",
                            text: '您已成功修改！',
                            type: "success",
                            html:true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "确认",
                            closeOnConfirm: true,
                            timer:800
                        });
                    }else{
                        swal({
                            title: "修改失败",
                            text: re.msg,
                            type: "warning",
                            html:true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "确认",
                            closeOnConfirm: true
                        });
                    }
                }
            });
        }
    </script>