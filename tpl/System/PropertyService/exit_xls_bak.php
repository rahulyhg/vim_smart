<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'物业缴费',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('物业缴费','#'),
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<div id="shopList" class="grid-view">

    <div class="row">
        <div class="col-md-12">
            <div class="btn-group">
                <a href="javascript:;">
                    <button id="sample_editable_1_new" class="btn sbold green" onclick="outUp()">批量导入业主
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>

        </div>


    </div>
    <br/>

    <select name="village_id"  id="village_id">
        <option value="0">请选择社区</option>
        <foreach name="village_array" item="vo">
            <option value="{pigcms{$vo.village_id}">{pigcms{$vo.village_name}</option>
        </foreach>
    </select>
    <br/>
    <br/>
    <script>
        $("select[name='village_id']").change(function () {
            var village_id = $('#village_id option:selected').val();
                window.location.href = 'http://www.hdhsmart.com/admin.php?g=System&c=PropertyService&a=exit_xls&village_id='+village_id;
        });
    </script>
    <!--<for start="1" end="13">
        <a href="{pigcms{:U('village_order_list',array('month'=>$i))}">
        <button class="btn  btn-sm <php>if(empty($_GET['month'])&&$i==date('m')){echo 'blue';}else if($_GET['month']==$i){echo 'blue';}else{echo 'default';}</php>" type="button">
            2017-{pigcms{$i}月
        </button>
        </a>
    </for>-->


    <!--id="sample_1"-->
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

<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script>
    /*自定义js代码区域*/
    function outUp(){
        var village_id = "{pigcms{$Think.get.village_id}";
        if(village_id!=null){
            window.location.href = "/admin.php?g=System&c=PropertyService&a=complete_all_order&village_id="+village_id;
        }else{
            window.location.href = "{pigcms{:U('complete_all_order')}";
        }

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
<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
