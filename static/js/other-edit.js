/***************************************************************************************************
 *
 * 其他缴费JS封装
 * @author 祝君伟 Morty zhu
 * @time 2017年11月27日11:06:42
 * @GitHua https://github.com/zjwForPHP
 * @WEB http://showmeyh.cn/wordpress/
 *
 ***************************************************************************************************/
/*$(function(){*/

    /**
     * 申请公共变量
     * @type {string}
     */

    var newTr = '<tr><td><input name="new_name[]" value=""/></td><td><input name="new_value[]" value=""/></td></tr>',
        changeInput = '<input name="edit_this" value=""/>',
        newOneTr = '<td><input name="new_name[]" value=""/></td><td><input name="new_value[]" value=""/></td>',
        U   = '/admin.php?g=System&c=PropertyService&a=add_other',
        eu  = '/admin.php?g=System&c=PropertyService&a=edit_this_other',
        su  = '/admin.php?g=System&c=PropertyService&a=edit_this_other2',
        cu  = '/admin.php?g=System&c=PropertyService&a=enter_list'

    ;


    /**
     * 点击新增后触发事件
     * @type event function
     *
     */

    $("#addPart").click(function(){
        var trLength = $("#myTable tr").length,
            lastTrLength = Number(trLength),
            $lastTd = $("#myTable").find("tr").last(),
            lastTdText = $lastTd.text()
        ;
        console.log(lastTrLength);
        console.log(lastTdText);
        if(lastTdText == '暂无数据'){

            $lastTd.html(newOneTr);

        }else{

            $lastTd.before(newTr);
        }

        //选中文本框
        $("[name='new_name[]']").focus();
        //保存出现
        $("#save").show();
    });


    /**
     * 新增点击保存，提交后台处理，并变化前台数值
     * @type event function
     */
    $("#save").click(function(){
        var inputName = [],
            inputValue = [],
            id = $("#save").attr('data-usernum')

        ;
        $("[name='new_name[]']").each(function (e) {
            if($(this).val() == ''){
                alert('项目名不能为空');
            }else{
                inputName[e] = $(this).val();
            }

        });

        $("[name='new_value[]']").each(function (i) {
            if($(this).val() == ''){
                alert('价格不能为空');
            }else{
                inputValue[i] = $(this).val();
            }
        });

        var nameString = JSON.stringify(inputName),
        valueString = JSON.stringify(inputValue)
        ;

        $.ajax({
            url:U,
            type:'post',
            dataType:'json',
            data:{'name':nameString,'value':valueString,'id':id},
            success:function(r){
                if(r == '失败了'){
                    alert('编辑失败');
                }else{
                    //步骤1：变更所有的input变td

                    $("[name='new_name[]']").each(function () {
                        $(this).parent().parent().html('<td>'+$(this).val()+'</td><td>'+toDecimal2($(this).parent().next().find('input').val())+'元</td>');


                    });

                    //步骤二变更总价
                    var lastTr = $("#myTable").find("tr").last(),
                        lastTrText = Trim(lastTr.text())

                    ;

                    if(lastTrText.indexOf('总计')!=-1){
                        $("#myTable").find("td").last().text(toDecimal2(r));
                    }else{
                        $("#myTable").append('<tr style="font-weight: bold;"><td><span style="float: left;">总计：</span></td><td>'+toDecimal2(r)+'</td></tr>');
                    }
                }
            }
        });
    });


    /**
     * 编辑事件--主项编辑
     */
    $(".main_price").on({

        //点击编辑
        click:function(){
            //防止冒泡
            if($(this).parent().find('input').length>0)return false;
            //判断
            var unit_text = $(this).text();
            if(unit_text.indexOf('元')==-1){
                //点在费用上
                var price_value = $(this).next().text();
                $(this).next().html('<input name="edit_this" value="'+price_value.replace('元','')+'"/>');


            }else{
                //点在价格上
                $(this).html('<input name="edit_this" value="'+unit_text.replace('元','')+'"/>');
            }

            $('input[name="edit_this"]').focus();
        },

        //失去焦点完成编辑
        blur:function(){
            var field_value = $("input[name='edit_this']").val(),//字段值
                field = $("input[name='edit_this']").parent().attr('data-field'),//字段
                mTd = '<td data-field="'+field+'">'+toDecimal2(field_value)+'元</td>',
                id = $("input[name='id']").val(),
                reg = /^\d+(\.\d+)?$/ //非负浮点数
            ;
            if(field_value == ''){
                alert('不能不填写，至少为0');
                return false;
            }else if(!reg.test(field_value)){
                alert('请填写正确价格');
                return false;
            }

            console.log(id);
            $.ajax({
                url:eu,
                type:'post',
                data:{'field':field,'value':field_value,'id':id},
                success:function (ms) {
                    if(ms != 2&& ms != 3){
                        //修改成功，将当前input变更回来
                        $("input[name='edit_this']").parent().html(mTd);
                        $("#myTable").find("td").last().text(toDecimal2(ms));

                    }else if(ms == 3){
                        $("input[name='edit_this']").parent().html(mTd);
                    }else{
                        return false;
                    }
                }
            });

        }
    },'td');


    /**
     * 辅助事项编辑
     */
    $(".auxiliary_price").on({

        //点击编辑事件
        click:function(){
            //防止冒泡
            if($(this).parent().find('input').length>0)return false;
            //判断
            var unit_text = $(this).text();
            if(unit_text.indexOf('元')==-1){
                //点在费用上
                var price_value = $(this).next().text();
                $(this).next().html('<input name="edit_this" value="'+price_value.replace('元','')+'"/>');


            }else{
                //点在价格上
                $(this).html('<input name="edit_this" value="'+unit_text.replace('元','')+'"/>');
            }
            $('input[name="edit_this"]').focus();
        },

        blur:function(){

            var field_value = $("input[name='edit_this']").val(),//字段值
                field_number = $('.auxiliary_price').index($(this).parent()),//字段
                field_name = $('.auxiliary_price').eq(field_number).find('td').first().text(),
                mTd = '<td>'+toDecimal2(field_value)+'元</td>',
                id = $("input[name='id']").val(),
                reg = /^\d+(\.\d+)?$/ //非负浮点数
            ;

            if(field_value == ''){
                alert('不能不填写，至少为0');
                return false;
            }else if(!reg.test(field_value)){
                alert('请填写正确价格');
                return false;
            }

            //传递到后台处理
            $.ajax({
                url:su,
                type:'post',
                data:{'field_value':field_value,'field_name':field_name,'id':id},
                success:function(sr){
                    if(sr != 2&& sr != 3) {
                        //修改成功
                        $("input[name='edit_this']").parent().html(mTd);
                        $("#myTable").find("td").last().text(toDecimal2(sr));
                    }else if(sr == 3){
                        $("input[name='edit_this']").parent().html(mTd);
                    }else{
                        return false;
                    }
                }
            });
        }

    },'td');






    //添加关闭事件
    $("#closeWid").click(function(){

        var lastTdText = Trim($("#myTable").find("td").last().text()),
            usernum = $("#save").attr('data-usernum')
        ;

            $("#"+usernum).text(toDecimal2(lastTdText)+'元');


    });




    //出账事件
    $("#enter_list").click(function(){
        var id = $("#enter_list").attr('data-usernum');

        $.ajax({
            url:cu,
            type:'post',
            data:{'id':id},
            success:function(cr){
                if(cr == 1){
                    window.location.reload();
                }else{
                    alert('出账失败');
                    return false;
                }
            }
        });
    });

/*});*/

//去空格
function Trim(str)

{

    return str.replace(/(^\s*)|(\s*$)/g, "");

}


//强制两位小数
function toDecimal2(x) {
    var f = parseFloat(x);
    if (isNaN(f)) {
        return false;
    }
    var f = Math.round(x*100)/100;
    var s = f.toString();
    var rs = s.indexOf('.');
    if (rs < 0) {
        rs = s.length;
        s += '.';
    }
    while (s.length <= rs + 2) {
        s += '0';
    }
    return s;
}