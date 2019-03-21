
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">快递单详情</h4>
</div>
<div class="modal-body">
    <div class="row ems_info">
        <div  class="col-xs-6">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">寄件人信息</div>
                <!-- Table -->
                <table class="table">
                    <tr>
                        <th>寄件方单位名称</th>
                        <td>val</td>
                    </tr>
                    <tr>
                        <th>联系人</th>
                        <td><?php echo $info['bad_name']?></td>
                    </tr>
                    <tr>
                        <th>联系电话</th>
                        <td><?php echo $info['bad_phone']?></td>
                    </tr>
                    <tr>
                        <th>地址</th>
                        <td><?php echo $info['bad_detail']?></td>
                    </tr>
                </table>
            </div>
            <div class="panel panel-default ">
                <!-- Default panel contents -->
                <div class="panel-heading">收件人信息</div>

                <!-- Table -->
                <table class="table">
                    <tr>
                        <th>收件方单位名称</th>
                        <td>val</td>
                    </tr>
                    <tr>
                        <th>联系人</th>
                        <td><?php echo $info['sad_name']?></td>
                    </tr>
                    <tr>
                        <th>联系电话</th>
                        <td><?php echo $info['sad_phone']?></td>
                    </tr>
                    <tr>
                        <th>省-市-区</th>
                        <td><?php echo $info['sad_position']?></td>
                    </tr>
                    <tr>
                        <th>详细地址</th>
                        <td><?php echo $info['sad_detail']?></td>
                    </tr>

                </table>
            </div>
        </div>
        <div  class="col-xs-6">
            <div class="panel panel-default ">
                <!-- Default panel contents -->
                <div class="panel-heading">快递详细</div>

                <!-- Table -->
                <table class="table">
                    <tr>
                        <th>快递单号</th>
                        <td><?php echo $info['ems_order_id']?></td>
                    </tr>
                    <tr>
                        <th>快递寄件方式</th>
                        <td><?php echo $info['billing_type_id'] ?></td>
                    </tr>
                    <tr>
                        <th>快递物品类型</th>
                        <td><?php echo $info['goods_type_name']?></td>
                    </tr>
                    <tr>
                        <th>寄托物品详细资料
                            <p class="text-muted" style="font-weight: normal;">价值超过1000元的物品，请如实声明，否则按不超过1000元的物品处理，贵重物品建议保价</p>
                        </th>
                        <td><textarea name="goods_detail" id="" cols="30" rows="10" placeholder="声明后会添加到打印单中"></textarea></td>
                    </tr>

                </table>
            </div>
        </div>

    </div>
    <div class="pdf_preview hidden">
        <iframe src="{pigcms{:U('SF')}" id="ifr1" frameborder="0" scrolling="no"  style="height:127mm;width:230mm"></iframe>
    </div>
</div>

<div class="modal-footer">
    <a  href="{pigcms{:U('SF_PDF',array('order_id'=>$info['order_id']))}" type="button" class="btn btn-primary print_pdf">打印</a>
    <button  type="button" class="btn btn-primary pdf_preview_button">打印预览</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>
<script src="/Car/Admin/Public/js/jquery.cookie.js"></script>
<script>
$(document).ready(function(){
    //记录详细信息保存在cookie中
    var order_info_json = '<?php echo json_encode($info)?>'
    var order_info = JSON.parse(order_info_json);
    var order_id = "<?php echo $info['order_id']?>";
    document.domain = '<?php echo $_SERVER['SERVER_NAME']?>';
    $.cookie('order_id_'+order_id,order_info_json);


    //打印预览
    $('.pdf_preview_button').on('click',function(){
        //显示
        $('.pdf_preview').removeClass('hidden');
        $('.ems_info').hide();

        //设置内容
        reset_pdf();

    });

    //打印
    $('.print_pdf').click(function(){
        reset_pdf();
        window.location.href = $(this).attr('href');
    });





    //设置pdf
    var reset_pdf = function (){
        var $ifr1 = $('#ifr1').contents();
//        寄件方信息
        $ifr1.find('#billing_company_name').text(order_info.bad_company_name);
        $ifr1.find('#billing_linkman').text(order_info.bad_name);
        $ifr1.find('#billing_address').text(order_info.bad_detail);
        $ifr1.find('#billing_phone').text(order_info.bad_phone);

//        收件方信息
        $ifr1.find('#shipping_company_name').text(order_info.sad_company_name);
        $ifr1.find('#shipping_linkman').text(order_info.sad_name);
//        收件方地址信息
        $ifr1.find('#shipping_addrss_province').text(order_info.sad_position.split(' ')[0]);
        $ifr1.find('#shipping_addrss_city').text(order_info.sad_position.split(' ')[1]);
        $ifr1.find('#shipping_addrss_area').text(order_info.sad_position.split(' ')[2]);
        $ifr1.find('#shipping_addrss_detail').text(order_info.bad_detail);

        $ifr1.find('#shipping_phone').text(order_info.billing_company_name);

        //获取寄件详情并更新到cookie中
        var goods_detail = $('[name="goods_detail"]').val();
        order_info.goods_detail = goods_detail;
        $.cookie('order_id_'+order_id,JSON.stringify(order_info));
        $ifr1.find('#goods_detail').text(goods_detail);
    }

//      修改部分权重太高的css
        $('.pdf_preview').css('overflow','hidden');
        $('.panel .table th').css('min-width','12rem').css('width','12rem').css('text-align','left').css('padding-left','10px')


});
</script>
