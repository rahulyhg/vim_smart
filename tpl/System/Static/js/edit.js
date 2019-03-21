/**
 * Created by admin on 2017/9/6.
 */

//监控所有该名字下的td的点击事件,注意时间冒泡。

$("[name='edit_this']").on('click','td',function () {
    if($(this).find("input").length>0)return false;
    if($(this).find("select").length>0)return false;
    //构建HTML
    var field = $(this).attr('name');
    if(field == 'fstatus'){
        var inputHtml = "<select><option value='0'>待租待售</option><option value='1'>出租已住入</option><option value='2'>出售已住入</option><option value='3'>出售未住入</option><option value='4'>集团自用</option></select>"
    }else if(field == 'contract_end'||field == 'property_start'||field == 'property_units'||field == 'phones'){

        var before_value = $(this).text();
        var inputHtml = "<input name='test' value='"+Trim(before_value)+"' style='width: 40%;'/>";
    }else{
        var before_value = $(this).text();
        var inputHtml = "<input name='test' value='"+Trim(before_value)+"'/>";
    }

    $(this).html(inputHtml);
    $(this).children().focus().select();
});

//监控所有该名字下的td的点击事件,注意时间冒泡。

$("[name='update_this']").on('click','td',function () {
    if($(this).find("input").length>0)return false;
    if($(this).find("select").length>0)return false;
    //构建HTML
    var before_value = Trim($(this).text());
    var field = $(this).attr('name');
    if(field == 'village_id'){
        switch (before_value){
            case '浦发银行大厦':
                var inputHtml = "<select><option value='3' selected>浦发银行大厦</option><option value='4'>广发银行大厦</option><option value='6'>卓尔钰龙国际中心</option><option value='5'>钰龙时代中心</option></select>";
                break;

            case '广发银行大厦':
                var inputHtml = "<select><option value='3'>浦发银行大厦</option><option value='4' selected>广发银行大厦</option><option value='6'>卓尔钰龙国际中心</option><option value='5'>钰龙时代中心</option></select>";
                break;

            case '钰龙时代中心':
                var inputHtml = "<select><option value='3'>浦发银行大厦</option><option value='4'>广发银行大厦</option><option value='6'>卓尔钰龙国际中心</option><option value='5' selected>钰龙时代中心</option></select>";
                break;

            case '卓尔钰龙国际中心':
                var inputHtml = "<select><option value='3'>浦发银行大厦</option><option value='4'>广发银行大厦</option><option value='6' selected>卓尔钰龙国际中心</option><option value='5'>钰龙时代中心</option></select>";
                break;
        }

    }else if(field == 'fstatus'){
        //return console.log(before_value);

        switch (before_value){
            case '待租待售':
                var inputHtml = "<select><option value='0' selected>待租待售</option><option value='1'>出租已住入</option><option value='2'>出售已住入</option><option value='3'>出售未住入</option><option value='4'>集团自用</option></select>";
                break;

            case '出租已住入':
                var inputHtml = "<select><option value='0'>待租待售</option><option value='1' selected>出租已住入</option><option value='2'>出售已住入</option><option value='3'>出售未住入</option><option value='4'>集团自用</option></select>";
                break;

            case '出售已住入':
                var inputHtml = "<select><option value='0'>待租待售</option><option value='1'>出租已住入</option><option value='2' selected>出售已住入</option><option value='3'>出售未住入</option><option value='4'>集团自用</option></select>";
                break;

            case '出售未住入':
                var inputHtml = "<select><option value='0'>待租待售</option><option value='1'>出租已住入</option><option value='2'>出售已住入</option><option value='3' selected>出售未住入</option><option value='4'>集团自用</option></select>";
                break;

            case '集团自用':
                var inputHtml = "<select><option value='0'>待租待售</option><option value='1'>出租已住入</option><option value='2'>出售已住入</option><option value='3'>出售未住入</option><option value='4' selected>集团自用</option></select>";
                break;
        }

    }else{

        var inputHtml = "<input name='test' value='"+Trim(before_value)+"'/>";
    }

    $(this).html(inputHtml);
    $(this).children().focus().select();
});



//监控该名字下的input的改变事件

$("[name='edit_this']").on({

    blur:function(){
        //字段值
        var after_input = $(this).val();
        var tdHtml = "<td>"+after_input+"</td>";
        $(this).parent().html(tdHtml);
    },

    change:function(){
        //构建HTML
        //数据准备
        //唯一标识id
        var id = $(this).parent().parent().attr('data-fid');
        //字段
        var field = $(this).parent().attr("name");
        //字段值
        var after_input = $(this).val();
        //区别各个字段进行更改
        if(field == 'fstatus'){
            if(after_input == 0){
                var tdHtml = "<td name='fstatus'>待租待售</td>";
            }else if(after_input == 1){
                var tdHtml = "<td name='fstatus'>出租已住入</td>";
            }else if(after_input == 2){
                var tdHtml = "<td name='fstatus'>出售已住入</td>";
            }else if(after_input == 3){
                var tdHtml = "<td name='fstatus'>出售未住入</td>";
            }else if(after_input == 4){
                var tdHtml = "<td name='fstatus'>集团自用</td>";
            }

        }else{
            var tdHtml = "<td>"+after_input+"</td>";
        }

        $(this).parent().html(tdHtml);

        /*console.log(id);
         console.log(field);
         console.log(after_input);*/

        ajaxEdit(id,after_input,field);

    }


},'input,select');


//监控该名字下的input的改变事件

$("[name='update_this']").on({

    blur:function(){

        //字段
        var field = $(this).parent().attr("name");

        //字段值
        var after_input = $(this).val();
        if(field == 'fstatus') {
            if (after_input == 0) {
                var tdHtml = "<td name='fstatus'>待租待售</td>";
            } else if (after_input == 1) {
                var tdHtml = "<td name='fstatus'>出租已住入</td>";
            } else if (after_input == 2) {
                var tdHtml = "<td name='fstatus'>出售已住入</td>";
            } else if (after_input == 3) {
                var tdHtml = "<td name='fstatus'>出售未住入</td>";
            } else if (after_input == 4) {
                var tdHtml = "<td name='fstatus'>集团自用</td>";

            }
            return false;

        }else if(field == 'village_id'){
            if (after_input == 3) {
                var tdHtml = "<td name='fstatus'>浦发银行大厦</td>";
            } else if (after_input == 4) {
                var tdHtml = "<td name='fstatus'>广发银行大厦</td>";
            } else if (after_input == 5) {
                var tdHtml = "<td name='fstatus'>钰龙时代中心</td>";
            } else if (after_input == 6) {
                var tdHtml = "<td name='fstatus'>卓尔钰龙国际中心</td>";
            }
            return false;

        }else{
            var tdHtml = "<td>"+after_input+"</td>";
        }

        $(this).parent().html(tdHtml);
    },

    change:function(){

        //构建HTML
        //数据准备
        //唯一标识id
        var id = $(this).parent().attr('data-num');
        //字段
        var field = $(this).parent().attr("name");
        //字段值
        var after_input = $(this).val();
        //区别各个字段进行更改
        if(field == 'fstatus') {
            if (after_input == 0) {
                var tdHtml = "<td name='fstatus'>待租待售</td>";
            } else if (after_input == 1) {
                var tdHtml = "<td name='fstatus'>出租已住入</td>";
            } else if (after_input == 2) {
                var tdHtml = "<td name='fstatus'>出售已住入</td>";
            } else if (after_input == 3) {
                var tdHtml = "<td name='fstatus'>出售未住入</td>";
            } else if (after_input == 4) {
                var tdHtml = "<td name='fstatus'>集团自用</td>";
            }

        }else if(field == 'village_id'){
            if (after_input == 3) {
                var tdHtml = "<td name='fstatus'>浦发银行大厦</td>";
            } else if (after_input == 4) {
                var tdHtml = "<td name='fstatus'>广发银行大厦</td>";
            } else if (after_input == 5) {
                var tdHtml = "<td name='fstatus'>钰龙时代中心</td>";
            } else if (after_input == 6) {
                var tdHtml = "<td name='fstatus'>卓尔钰龙国际中心</td>";
            }

        }else{
            var tdHtml = "<td>"+after_input+"</td>";
        }

        $(this).parent().html(tdHtml);

        console.log(id);
        console.log(field);
        console.log(after_input);

        //ajaxUpdate(id,after_input,field);
    }

},'input,select');



//ajax改变数据库

function ajaxEdit(id,value,field) {
    $.ajax({
        url:'/admin.php?g=System&c=PropertyService&a=edit_this',
        type:'post',
        data:{'id':id,'value':value,'field':field},
        success:function (res) {
            if(res!=1){
                alert('改变失败')
            }else{
                window.location.reload();
            }
        }
    });

}


//ajax改变数据库

function ajaxUpdate(id,value,field) {
    $.ajax({
        url:'/admin.php?g=System&c=PropertyService&a=update_this',
        type:'post',
        data:{'id':id,'value':value,'field':field},
        success:function (res) {
            if(res!=1){
                alert('改变失败')
            }else{
                window.location.reload();
            }
        }
    });

}

//去空格
function Trim(str)

{

    return str.replace(/(^\s*)|(\s*$)/g, "");

}

//去空格包括字符中间的空格
function TrimG(str,is_global)

{

    var result;

    result = str.replace(/(^\s+)|(\s+$)/g,"");

    if(is_global.toLowerCase()=="g")

    {

        result = result.replace(/\s/g,"");

    }

    return result;

}