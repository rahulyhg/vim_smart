<div class="modal-header">
    <button type="button" class="close close_sub_modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">计费配置</h4>
</div>
<div class="modal-body" style="height: 40rem;overflow-y: scroll" id="form_">
    <form class="form-horizontal">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">设备编号</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{pigcms{$meter_info['meter_code']}" disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">倍率</label>
            <div class="col-sm-10">
                <input type="num" name="rate" class="form-control" value="{pigcms{:intval($meter_info['rate'])}" >
            </div>
        </div>
        <div class="form-group">
            <div  class="text-primary col-sm-offset-2 col-sm-10">比例 1 为独享表 ，若设置小于 1 则为公摊表，如设置为0.5 则公摊50%的费用</div>
            <label for="inputPassword3" class="col-sm-2 control-label">比例</label>
            <div class="col-sm-10">
                <input type="text" name="scale" value="{pigcms{$scale}" class="form-control" id="inputPassword3" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">设备类型</label>
            <div class="col-sm-10">
                <div class="checkbox">
                    &nbsp;
                    <foreach name="price_types" item="type" key="key">
                    <label class="checkbox-inline" style="width:100px">
                        <php>$checked = $meter_info['price_type_id']==$type['id'];</php>
                        <input type="radio" name="price_type_id" {pigcms{$checked ? "checked='checked'" : ""} id="inlineCheckbox1" value="{pigcms{$type['id']}"> {pigcms{$type['desc']}
                    </label>
                    </foreach>
                </div>
            </div>

        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" id="save_meter_{pigcms{$meter_info['meter_hash']}" class="btn btn-default">保存</button>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default close_sub_modal">关闭</button>
    <!--    <button type="button" class="btn btn-primary">Save changes</button>-->
</div>

<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script>
    $(document).on('click',"#save_meter_{pigcms{$meter_info['meter_hash']}",function(){
        var rate = $(this).parents('.modal-body').find('input[name="rate"]').val();
        var scale = $(this).parents('.modal-body').find('input[name="scale"]').val();
        var price_type_id = $(this).parents('.modal-body').find('input[name="price_type_id"]:checked').val();
        $.ajax({
            url:"{pigcms{:U('save_meter_set')}",
            data: {
                    rate:rate,
                    scale:scale,
                    price_type_id:price_type_id,
                    meter_hash:"{pigcms{$meter_info['meter_hash']}",
                    tid:"{pigcms{:I('get.tid')}",
                },
            dateType:'json',
            success:function(re){
                if(re.err==0){
                    //alert("修改完成");

                    $("#meter_set").modal('hide');
                }else{
                    alert("发送错误");
                }

            }



        });

    });
</script>
