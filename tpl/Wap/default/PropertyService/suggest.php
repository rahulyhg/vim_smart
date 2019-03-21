<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>智慧停车场系统</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="{pigcms{$static_path}test/style.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}test/weui.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}test/weui2.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}webuploader-0.1.5/xb-webuploader.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <script src="//cdn.bootcss.com/jquery/1.10.1/jquery.min.js"></script>
    <script src="{pigcms{$static_path}test/swipe.js"></script>
    <script>
        $(function(){


        });

        $(function(){
            $('#slide1').swipeSlide({
                autoSwipe:true,//自动切换默认是
                speed:3000,//速度默认4000
                continuousScroll:true,//默认否
                transitionType:'cubic-bezier(0.22, 0.69, 0.72, 0.88)',//过渡动画linear/ease/ease-in/ease-out/ease-in-out/cubic-bezier
                lazyLoad:true,//懒加载默认否
                firstCallback : function(i,sum,me){
                    me.find('.dot').children().first().addClass('cur');
                },
                callback : function(i,sum,me){
                    me.find('.dot').children().eq(i).addClass('cur').siblings().removeClass('cur');
                }
            });

            $('#slide2').swipeSlide({
                autoSwipe:true,//自动切换默认是
                speed:3000,//速度默认4000
                continuousScroll:true,//默认否
                transitionType:'cubic-bezier(0.22, 0.69, 0.72, 0.88)',//过渡动画linear/ease/ease-in/ease-out/ease-in-out/cubic-bezier
                lazyLoad:true,//懒加载默认否
                firstCallback : function(i,sum,me){
                    me.find('.dot').children().first().addClass('cur');
                },
                callback : function(i,sum,me){
                    me.find('.dot').children().eq(i).addClass('cur').siblings().removeClass('cur');
                }
            });
            $('#slide3').swipeSlide({
                autoSwipe:true,//自动切换默认是
                speed:3000,//速度默认4000
                continuousScroll:true,//默认否
                transitionType:'ease-in'
            });


        });


    </script>
    <style type="text/css">


        .ty {width:100%; margin-top:15px; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
        .ty2 {width:95%; margin-left:5%; padding-top:20px;}
        .ty4 {width:100%; margin-top:25px; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
        .ty3 {width:100%; padding-top:20px; margin:0px auto; overflow:hidden;}
        .tk {width:40%; margin-left:5%; margin-right:5%; float:left; margin-bottom:15px;}
        .tkw {width:86%; margin-left:7%; margin-right:7%; margin-bottom:15px;}
        .tk2 {width:100%; margin:0px auto;}
        .tk3 {width:100%; height:30px; line-height:30px; overflow:hidden; text-align:center; color:#a1a1a8;}
        .weui_cells:before {
            content: " ";
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 1px;
            border-top:none;
            color: #D9D9D9;
            -webkit-transform-origin: 0 0;
            transform-origin: 0 0;
            -webkit-transform: scaleY(0.5);
            transform: scaleY(0.5);
        }
        .weui_cells {
            margin-top: 10px;
            background-color: #FFFFFF;
            line-height: 1.41176471;
            font-size: 16px;
            overflow: hidden;
            position: relative;
            color:#999999;
        }
        .weui_cell:before {
            border-top:none;
        }
        .weui_cell {
            padding: 10px 5%;
            width:90%;
            position: relative;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
        }
        .weui_cell:before {
            left: 0px;
        }
        .btb {width:100%; font-size:18px; text-align:center; line-height:50px; height:50px; overflow:hidden; background-color:#18b4ed; color:#FFFFFF;}
        .btb:active {width:100%; font-size:18px; text-align:center; line-height:50px; height:50px; overflow:hidden; background-color:#0ba4dc; color:#FFFFFF;}
    </style>
    <style>
        .filePicker {

        }
        .filePicker{

            /*opacity:0 !important;*/
        }
        .webuploader-pick{
            opacity:0 !important;
        }
    </style>

</head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<div class="tb"><img src="{pigcms{$static_path}images/fwx.jpg" style="width:100%;" /></div>
<div class="tb">
    <div style="float:left; height:46px; width:22.3%;"><img src="{pigcms{$static_path}images/fwx2.jpg" style="width:100%; height:46px;" /></div>
    <div style="float:left; height:46px; width:38%;"><a href="tel:027-85880377"><img src="{pigcms{$static_path}images/fwx3.jpg" border="0" style="width:100%; height:46px;" /></a></div>
    <div style="float:left; height:46px; width:39.7%;"><a href="tel:027-65651119"><img src="{pigcms{$static_path}images/fwx4.jpg" border="0" style="width:100%; height:46px;" /></a></div>
    <div style="clear:both"></div>
</div>
<div class="ty">
    <div class="ty2">
        <div style="float:left;"><img src="{pigcms{$static_path}images/fw2.jpg" style="width:5px; height:auto;" /></div>
        <div style="float:left; padding-left:8px; color:#000000; font-size:18px; font-weight:bold; line-height:20px;">服务团队介绍</div>
        <div style="clear:both"></div>
    </div>
    <div class="ty3">
        <div class="tk">
            <div class="tk2"><img src="{pigcms{$static_path}images/fw3.jpg" style="width:100%; height:auto;" /></div>
            <div class="tk3">服务团队</div>
        </div>
        <div class="tk">
            <div class="tk2"><img src="{pigcms{$static_path}images/fw4.jpg" style="width:100%; height:auto;" /></div>
            <div class="tk3">服务团队</div>
        </div>
        <div class="tk">
            <div class="tk2"><img src="{pigcms{$static_path}images/fw5.jpg" style="width:100%; height:auto;" /></div>
            <div class="tk3">服务团队</div>
        </div>
        <div class="tk">
            <div class="tk2"><img src="{pigcms{$static_path}images/fw6.jpg" style="width:100%; height:auto;" /></div>
            <div class="tk3">服务团队</div>
        </div>
        <div style="clear:both"></div>
    </div>
</div>
<div class="ty4">
    <div class="ty2">
        <div style="float:left;"><img src="{pigcms{$static_path}images/fw2.jpg" style="width:5px; height:auto;" /></div>
        <div style="float:left; padding-left:8px; color:#000000; font-size:18px; font-weight:bold; line-height:20px;">项目所获荣誉</div>
        <div style="clear:both"></div>
    </div>
    <div class="ty3">

        <div class="slide" id="slide2">
            <ul>
                <li>
                    <a href="#">
                        <img src="{pigcms{$static_path}images/fw7.jpg" style="width:90%; height:auto; margin-left:5%;" />
                    </a>
                    <div class="slide-desc">2016年度湖北省物业服务示范大厦</div>

                </li>
                <li>
                    <a href="#">
                        <img src="{pigcms{$static_path}images/fw8.jpg" style="width:90%; height:auto; margin-left:5%;" />
                    </a>
                    <div class="slide-desc">2016年度武汉市物业管理示范大厦</div>

                </li>
            </ul>

        </div>


    </div>
    <div style="height:15px; width:100%; overflow:hidden;"></div>
</div>
<div class="ty4">
    <div class="ty2">
        <div style="float:left;"><img src="{pigcms{$static_path}images/fw2.jpg" style="width:5px; height:auto;" /></div>
        <div style="float:left; padding-left:8px; color:#000000; font-size:18px; font-weight:bold; line-height:20px;">意见反馈</div>
        <div style="clear:both"></div>
    </div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="tel" name="contact" required="" pattern="[0-9]{11}" maxlength="11" placeholder="请填写您的电话号码（可选）">
            </div>
            <div class="weui_cell_ft">
                <i class="weui_icon_warn"></i>
            </div>
        </div>
    </div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <textarea id="textarea" class="weui_textarea" name="content" placeholder="填写您所遇到的问题或给我们的建议！" rows="4"></textarea>
            </div>
        </div>
    </div>

    <div id="uploader" class="xb-uploader">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <div class="weui_uploader">
                    <div class="weui_uploader_bd">
                        <div class="weui_uploader_input_wrp" id="add_button">
                            &nbsp;&nbsp; &nbsp;&nbsp;
                            &nbsp;&nbsp; &nbsp;&nbsp;
                            &nbsp;&nbsp; &nbsp;&nbsp;
                            &nbsp;&nbsp; &nbsp;&nbsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="queueList">

        </div>
        <div class="statusBar" style="display:none;">
            <div class="progress">
                <span class="text">0%</span>
                <span class="percentage"></span>
            </div>
            <div class="info"></div>
        </div>
        <div class="btb uploadBtn">提交信息</div>
    </div>

</div>

<div style="width:100%; height:60px; text-align:center; line-height:60px; color:#8a8a8a; font-size:14px;">汇得行控股（中国）有限公司武汉广发银行大厦</div>
<!--style="opacity: 0; display: none;"-->
<div id="loadingToast"  style="opacity: 0; display: none;" >
    <div class="weui-mask_transparent"></div>
    <div class="weui-toast">
        <i class="weui-loading weui-icon_toast"></i>
        <p class="weui-toast__content">图片上传中..</p>
    </div>
</div>
<script src="//cdn.bootcss.com/jquery-weui/1.0.0/js/jquery-weui.min.js"></script>
<script src="//cdn.staticfile.org/webuploader/0.1.5/webuploader.min.js"></script>
<script src="{pigcms{$static_path}js/helper.js"></script>



<script>
    //图片上传后自动提交
    helper.webuploader('#uploader','{pigcms{:U("ajax_upload")}',function(file ,response){
        //保存img_name
        var img_name =  $('#uploader').data("img_name")||[];
        img_name.push(response.data.savepath + response.data.savename);
        console.log(response.data.savepath + response.data.savename);
        $('#uploader').data("img_name",img_name);

    },function(){
        //上传完成后的回调
        //提交表单
        var img_name =  $('#uploader').data('img_name');
        var contact = $('input[name="contact"]').val();
        var content = $('textarea[name="content"]').val();
        $.ajax({
                url : "{pigcms{:U('suggest_act')}",
                data : {
                    img_name:img_name,
                    contact:contact,
                    content:content
                },
                type:'post',
                dataType:'json',
                success:function(re){
                    if(re.err===0){
                        alert("建议已提交");
                        window.location.reload();
                    }
                }
            });

    })

    /**
     * 不上传图片时的操作
     */
    $(document).on('click','.state-pedding',function(){

        var contact = $('input[name="contact"]').val();
        var content = $('textarea[name="content"]').val();
        if(!content){
           $.alert("请写点建议给我们吧！");
           return ;
        }
        $.ajax({
            url : "{pigcms{:U('suggest_act')}",
            data : {
                contact:contact,
                content:content
            },
            type:'post',
            dataType:'json',
            success:function(re){
                if(re.err===0){
                    alert("建议已提交");
                    window.location.reload();
                }
            }
        });
    });


    $(document).on('click','.weui-dialog__btn',function(){
        $(this).parents('.weui-dialog').remove();
        $('.weui-mask').remove();
    });
</script>
</body>
</html>