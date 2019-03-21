<html xmlns="http://www.w3.org/1999/xhtml" class="pixel-ratio-2 retina ios ios-9 ios-9-1 ios-gt-8 ios-gt-7 ios-gt-6"><head>
    <meta charset="utf-8">
    <title>意见反馈</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description">
    <meta content="" name="author">
    <link href="http://www.hdhsmart.com/tpl/Wap/default/static/test/style.css" rel="stylesheet" type="text/css">
    <link href="http://www.hdhsmart.com/tpl/Wap/default/static/test/weui.css" rel="stylesheet" type="text/css">
    <link href="http://www.hdhsmart.com/tpl/Wap/default/static/test/weui2.css" rel="stylesheet" type="text/css">
    <link href="http://www.hdhsmart.com/tpl/Wap/default/static/webuploader-0.1.5/xb-webuploader.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="http://www.hdhsmart.com/Car/Admin/Public/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="http://www.hdhsmart.com/Car/Admin/Public/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- head 中 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">

    <link href="/Car/Home/Public/statics/plublic/css/sweetalert.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.bootcss.com/jquery/1.10.1/jquery.min.js"></script>
    <script src="http://www.hdhsmart.com/tpl/Wap/default/static/test/swipe.js"></script>

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
    </style></head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<div class="ty4">
    <div class="ty2">
        <div style="float:left;"><img src="http://www.hdhsmart.com/tpl/Wap/default/static/images/fw2.jpg" style="width:5px; height:auto;"></div>
        <div style="float:left; padding-left:8px; color:#000000; font-size:18px; font-weight:bold; line-height:20px;">意见反馈</div>
        <div style="clear:both"></div>
    </div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" name="name" required=""  placeholder="请填写您的姓名">
            </div>
            <div class="weui_cell_ft">
                <i class="weui_icon_warn"></i>
            </div>
        </div>
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
                        <div class="weui_uploader_input_wrp webuploader-container" id="add_button"><div class="webuploader-pick">

                                &nbsp;&nbsp; &nbsp;&nbsp;
                                &nbsp;&nbsp; &nbsp;&nbsp;
                                &nbsp;&nbsp; &nbsp;&nbsp;
                                &nbsp;&nbsp; &nbsp;&nbsp;
                            </div><div id="rt_rt_1bj1mvi5m14sdgr1lfs18co145s1" style="position: absolute; top: 0px; left: 0px; width: 77px; height: 220px; overflow: hidden; bottom: auto; right: auto;">
                                <input type="file" name="file" class="webuploader-element-invisible" multiple="multiple">
                                <label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255);"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="queueList">

            <ul class="filelist"></ul></div>
        <div class="statusBar" style="display:none;">
            <div class="progress" style="display: none;">
                <span class="text">0%</span>
                <span class="percentage" style="width: 0%;"></span>
            </div>
            <div class="info">共0个（0B），已上传0个</div>
        </div>
        <div class="btb uploadBtn state-pedding">提交信息</div>
    </div>

</div>

<div style="width:100%; height:60px; text-align:center; line-height:60px; color:#8a8a8a; font-size:14px;">汇得行（中国）集团有限公司</div>
<!--style="opacity: 0; display: none;"-->
<div id="loadingToast" style="opacity: 0; display: none;">
    <div class="weui-mask_transparent"></div>
    <div class="weui-toast">
        <i class="weui-loading weui-icon_toast"></i>
        <p class="weui-toast__content">图片上传中..</p>
    </div>
</div>
<script src="//cdn.bootcss.com/jquery-weui/1.0.0/js/jquery-weui.min.js"></script>
<script src="//cdn.staticfile.org/webuploader/0.1.5/webuploader.min.js"></script>
<script src="http://www.hdhsmart.com/tpl/Wap/default/static/js/helper.js"></script>
<!-- body 最后 -->
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>
<!-- sweetalert -->
<!--<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
<script src = "/Car/Home/Public/statics/plublic/js/sweetalert.min.js"></script>
<script src="/Car/Home/Public/statics/plublic/js/ui-sweetalert.min.js" type="text/javascript"></script>


<script>
    //图片上传后自动提交
    helper.webuploader('#uploader','/wap.php?g=Wap&c=PropertyService&a=ajax_upload',function(file ,response){
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
        var meal_id = "{pigcms{:I('get.meal_id')}"
        var name = $('input[name="name"]').val();
        $.ajax({
            url : "/wap.php?g=Wap&c=PropertyService&a=service_act",
            data : {
                img_name:img_name,
                contact:contact,
                content:content,
                meal_id:meal_id,
                name:name,
            },
            type:'post',
            dataType:'json',
            success:function(re){
                if(re.err===0){
                    // swal("提交成功！", "已提交意见！","success");
                    swal({
                        title: "提交成功！",
                        text: "已提交意见！",
                        timer: 1500,
                        showConfirmButton: false
                    });
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                }else{
                    swal("提交失败！", "提交意见失败！","error");
                    console.log($re);
                }
            },
            error:function(a,b,c){
                console.log(b);
                console.log(c);
            }
        });

    })

    /**
     * 不上传图片时的操作
     */
    $(document).on('click','.state-pedding',function(){

        var contact = $('input[name="contact"]').val();
        var content = $('textarea[name="content"]').val();
        var meal_id = "{pigcms{:I('get.meal_id')}"
        if(!content){
            $.alert("请写点建议给我们吧！");
            return ;
        }
        $.ajax({
            url : "/wap.php?g=Wap&c=PropertyService&a=service_act",
            data : {
                contact:contact,
                content:content,
                meal_id:meal_id

            },
            type:'post',
            dataType:'json',
            success:function(re){
                if(re.err===0){
                    swal({
                        title: "提交成功！",
                        text: "已提交意见！",
                        timer: 1500,
                        showConfirmButton: false
                    });
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                } else {
                    swal({
                        title: "提交失败！",
                        text: "提交意见失败！",
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            }
        });
    });


    $(document).on('click','.weui-dialog__btn',function(){
        $(this).parents('.weui-dialog').remove();
        $('.weui-mask').remove();
    });
</script>

</body></html>