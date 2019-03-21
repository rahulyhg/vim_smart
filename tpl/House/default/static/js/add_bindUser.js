/**
 * Created by admin on 2017/8/9.
 */
$(function(){
    //清除缓存的时候打开！（定期清理）
    //$.autocompleter('clearCache');
    /*$("input[name='company_name']").autocompleter({
        source: "./shequ.php?g=House&c=User&a=autocomplete_company",
        autoFocus: true,
    });*/


    $("input[name='company_name']").change(function(){
        var company_name = $("input[name='company_name']").val();
        $.ajax({
            url:"./shequ.php?g=House&c=User&a=check_this_company",
            data:{'company_name':company_name},
            type:'post',
            dataType:'json',
            success:function (res) {
                if(res.error == 0){
                    $("input[name='floor']").parent().slideDown(100);
                    $("input[name='floor']").val(res.floor);
                    $("input[name='company_id']").val(res.company_id);

                }else{
                    $("input[name='floor']").parent().slideDown(100);
                }
            }
        });
    });
});