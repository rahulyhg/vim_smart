<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部1 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-group"></i>
                <a href="{pigcms{:U('User/index')}">业主管理</a>
            </li>
            <li class="active">业主列表</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <button class="btn btn-success" onclick="outUp()">批量导入账单</button>
            <style>
                .ace-file-input a {display:none;}
            </style>
            <div class="row">
                <div class="col-xs-12">
                    <div id="shopList" class="grid-view">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="10%">业主编号</th>
                                    <th width="10%">所属公司名称</th>
                                    <th width="10%">姓名</th>
                                    <th width="10%">手机号</th>
                                    <th width="20%">住址</th>
                                    <th width="15%">本月因缴</th>
                                    <th width="5%">是否缴物业费</th>
                                    <th width="5%">是否缴停车费</th>
                                    <th class="button-column" width="20%">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <if condition="$village_user_array">
                                    <volist name="village_user_array['user_list']" id="vo">
                                        <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                                            <td><div class="tagDiv">{pigcms{$vo.usernum}</div></td>
                                            <td><div class="tagDiv">{pigcms{$vo.company_name}</div></td>
                                            <td><div class="tagDiv">{pigcms{$vo.name}</div></td>
                                            <td><div class="tagDiv">{pigcms{$vo.phone}</div></td>
                                            <td><div class="tagDiv">{pigcms{$vo.address}</div></td>
                                            <td>
                                                <div class="tagDiv" name="price">
                                                    <span onclick="change_this_value(this);">水费：￥<span>{pigcms{:floatval($vo['now_water_price'])}</span></span><br/>
                                                    <span onclick="change_this_value(this);">电费：￥<span>{pigcms{:floatval($vo['now_electric_price'])}</span></span><br/>
                                                    <span onclick="change_this_value(this);">燃气费：￥<span>{pigcms{:floatval($vo['now_gas_price'])}</span></span><br/>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="shopNameDiv">
                                                    <input type="radio" value="0" name="{pigcms{$vo.usernum}_is_property" />否
                                                    <input type="radio" value="1" name="{pigcms{$vo.usernum}_is_property" checked="checked"/>是
                                                </div>
                                            </td>
                                            <td>
                                                <div class="shopNameDiv">
                                                    <input type="radio" value="0" name="{pigcms{$vo.usernum}_is_park" checked="checked"/>否
                                                    <input type="radio" value="1" name="{pigcms{$vo.usernum}_is_park"/>是
                                                </div>
                                            </td>
                                            <td class="button-column">
                                                <if condition="$is_create eq 0">
                                                    不能生成，只能预览
                                                <else/>

                                                    <if condition="$vo['has_save'] eq 0">
                                                        <a style="width: 60px;" class="label label-sm label-info" title="保存账单" href="javascript:;" id="{pigcms{$vo.usernum}" onclick="save_this_order(this)">保存账单</a>
                                                        <a style="width: 60px;display: none;background-color: green;" class="label label-sm label-info" title="保存成功" href="javascript:;" name="success">保存成功</a>
                                                        <a style="width: 60px;display: none;background-color: red;" class="label label-sm label-info" title="保存失败" href="javascript:;" name="error">保存失败</a>
                                                    <else/>
                                                        该月账单已上传
                                                    </if>

                                                </if>
                                           </td>
                                        </tr>
                                    </volist>
                                <else/>
                                    <tr class="odd"><td class="button-column" colspan="12" >没有任何业主。</td></tr>
                                </if>
                            </tbody>
                        </table>
                        {pigcms{$village_user_array.pagebar}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>
    /*自定义js代码区域*/
function outUp(){
    window.location.href = "{pigcms{:U('User/complete_all_order')}";
}



function change_this_value(msg){
    if($(msg).find("input").length>0)return false;

    var txt = $(msg).children().text();
    var input = $("<input type='text'value='" + txt + "'/>");
    $(msg).children().html(input);
    //获取焦点
    input.focus();
    //文本框失去焦点后提交内容，重新变为文本
    input.blur(function() {
        var newtxt = $(this).val();
        //判断文本有没有修改
        if(newtxt >=0){
            if (newtxt != txt) {
                $(msg).children().html("<span>"+newtxt+"</span>");
            }else
                $(msg).children().html("<span>"+txt+"</span>");
        }else{
            $(msg).children().html(0);
        }

    });


}

function save_this_order(msg){
    //获取当前保存账单的数据
    //业主唯一编号
    var usernum = $(msg).attr('id');
    //账单金额信息
    var string = $(msg).parent().parent().find("*[name='price']").text();
    string = removeHTMLTag(string);
    //单选的值选择
    var is_property = $("*[name="+usernum+"_is_property]:checked").val();
    var is_park = $("*[name="+usernum+"_is_park]:checked").val();
    //传递到后台
    $.ajax({
        url:"{pigcms{:U('ajax_complete_order')}",
        data:{'usernum':usernum,'string':string,'is_property':is_property,'is_park':is_park},
        type:'post',
        success:function (res) {
            if(res == 1){
                //导入数据成功
                $(msg).hide();
                $(msg).parent().find("*[name='success']").show();
            }else{
                //导入数据失败
                $(msg).hide();
                $(msg).parent().find("*[name='error']").show();
            }
        }

    });



}

/**
 * 过滤html标签
 * @param str
 * @returns {*}
 */
function removeHTMLTag(str) {
    str = str.replace(/<\/?[^>]*>/g,''); //去除HTML tag
    str = str.replace(/[ | ]*\n/g,'\n'); //去除行尾空白
    //str = str.replace(/\n[\s| | ]*\r/g,'\n'); //去除多余空行
    str=str.replace(/ /ig,'');//去掉
    str=str.replace('\n','');//去掉制表换行
    return str;
}

</script>
<include file="Public:footer"/>
