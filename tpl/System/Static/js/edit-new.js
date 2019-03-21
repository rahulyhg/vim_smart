/**
 * 入驻业主编辑
 * @author 祝君伟
 * @time 2017年11月1日10:21:19
 */

$(function(){

    //声明变量
    var  cUrl = ''

    ;

    //修改租户信息
    
    $("[name='edit_this']").on({

        //点击事件
        click:function(){
            if($(this).find("input").length>0)return false;
            if($(this).find("select").length>0)return false;
            var field = $(this).attr('name'),
                before_value = Trim($(this).text())
            ;
            if(field == 'village_id'){

                switch (before_value){
                    case '浦发银行大厦':
                        var inputHtml = "<select name='test'><option value='3' selected>浦发银行大厦</option><option value='4'>广发银行大厦</option><option value='6'>卓尔钰龙国际中心</option><option value='5'>钰龙时代中心</option></select>";
                        break;

                    case '广发银行大厦':
                        var inputHtml = "<select name='test'><option value='3'>浦发银行大厦</option><option value='4' selected>广发银行大厦</option><option value='6'>卓尔钰龙国际中心</option><option value='5'>钰龙时代中心</option></select>";
                        break;

                    case '钰龙时代中心':
                        var inputHtml = "<select name='test'><option value='3'>浦发银行大厦</option><option value='4'>广发银行大厦</option><option value='6'>卓尔钰龙国际中心</option><option value='5' selected>钰龙时代中心</option></select>";
                        break;

                    case '卓尔钰龙国际中心':
                        var inputHtml = "<select name='test'><option value='3'>浦发银行大厦</option><option value='4'>广发银行大厦</option><option value='6' selected>卓尔钰龙国际中心</option><option value='5'>钰龙时代中心</option></select>";
                        break;
                }

            }else{
                var inputHtml = "<input name='test' value='"+Trim(before_value)+"'/>";
            }

            $(this).html(inputHtml);
            $(this).children().focus().select();

        },

        blur:function(){

            //失去焦点

            //唯一标识id
            var id = $(this).parent().attr('data-num');
            //字段
            var field = $(this).attr('name');

            if(field == 'village_id'){
                var after_input = $("select[name='test']").val();
                if (after_input == 3) {
                    var tdHtml = "<td name='village_id'>浦发银行大厦</td>";
                } else if (after_input == 4) {
                    var tdHtml = "<td name='village_id'>广发银行大厦</td>";
                } else if (after_input == 5) {
                    var tdHtml = "<td name='village_id'>钰龙时代中心</td>";
                } else if (after_input == 6) {
                    var tdHtml = "<td name='village_id'>卓尔钰龙国际中心</td>";
                }

            }else{
                var after_input = $("input[name='test']").val();
                var tdHtml = "<td>"+after_input+"</td>";
            }

            if(isNaN(id)){
                //编辑入驻租户
                /*console.log(id);
                console.log(field);
                console.log(after_input);*/
                ajaxEdit(id,after_input,field,0);
            }else{
                //编辑房间
                ajaxEdit(id,after_input,field,1);
                /*console.log(id);
                console.log(field);
                console.log(after_input);*/
            }


            $(this).html(tdHtml);
        }


    },'td');



    $('#common_modal').on('hide.bs.modal',
        function() {
            window.location.reload();
        })

});




//ajax改变数据库

function ajaxEdit(id,value,field,type) {
    $.ajax({
        url:'/admin.php?g=System&c=Room&a=edit_this',
        type:'post',
        data:{'id':id,'value':value,'field':field,'type':type},
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