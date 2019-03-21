/***************************************************************************************************
 *
 * 新版本管理js
 * @author 祝君伟 Morty zhu
 * @time 2017年11月27日11:06:42
 * @GitHua https://github.com/zjwForPHP
 * @WEB http://showmeyh.cn/wordpress/
 *
 ***************************************************************************************************/

$(function(){


    //申请公共变量

    var Curl = '/admin.php?g=System&c=House&a=make_company_list',
        Murl = '/admin.php?g=System&c=House&a=make_merchant_list',
        Purl = '/admin.php?g=System&c=House&a=user_bind_phone',
        Uurl = '/admin.php?g=System&c=House&a=phone_bind_user',
        Wurl = '/admin.php?g=System&c=House&a=weixin_bind_user'
    ;


    /**
     * 根据社区变化，变化option内容
     */
    $("#village").change(function(){
        //先选所属社区，根据选择的社区来区分公司
        var village_id = $("#village_id").val();
        $.ajax({
            url:Curl,
            data:{'village_id':village_id},
            type:'post',
            success:function (res) {
                $("#company_id").html(res);
            }
        });

        $.ajax({
            url:Murl,
            data:{'village_id':village_id},
            type:'post',
            success:function (res) {
                $("#mer_id").html(res);
            }
        });
    });


    //查询name,将其他两个信息显示到页面上1
    $("input[name='realname']").on('change',function(){
        var realname = $("input[name='realname']").val();
        $.ajax({
            url:Purl,
            data:{'realname':realname},
            type:'post',
            dataType:'json',
            success:function (res) {
                res.phone && $("input[name='phone']").val(res.phone);
                res.weixin_nick && $("input[name='nickname']").val(res.weixin_nick);
            }
        });
    });

    //查询phone,将其他两个信息显示到页面上
    $("input[name='phone']").on('change',function(){
        var phone = $("input[name='phone']").val();
        $.ajax({
            url:Uurl,
            data:{'phone':phone},
            type:'post',
            dataType:'json',
            success:function (res) {
                res.name && $("input[name='realname']").val(res.name);
                res.weixin_nick && $("input[name='nickname']").val(res.weixin_nick);
            }
        });
    });

    //查询微信昵称,将其他两个信息显示到页面上
    $("input[name='nickname']").on('change',function(){
        var nickname = $("input[name='nickname']").val();
        $.ajax({
            url:Wurl,
            data:{'nickname':nickname},
            type:'post',
            dataType:'json',
            success:function (res) {
                res.name && $("input[name='realname']").val(res.name);
                res.phone && $("input[name='phone']").val(res.phone);
            }
        });
    });



});

//去空格
function Trim(str)

{

    return str.replace(/(^\s*)|(\s*$)/g, "");

}


