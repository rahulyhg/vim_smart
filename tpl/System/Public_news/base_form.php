<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <!--头部文件-->
    <include file="./tpl/System/Public_news/header_news.php" />
    <!--/头部文件-->
    <block name="head"></block>
</head>


<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">

<include file="./tpl/System/Public_news/layout.php" />

<div class="page-container">

    <include file="./tpl/System/Public_news/sidebar_news.php" />
    <!--主体-->
    <div class="page-content-wrapper" id="main">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1><php>
                            $breadcrumb = $breadcrumb_diy?:$breadcrumb;
                            echo $breadcrumb[count($breadcrumb)-1][0];
                        </php>
                    </h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <volist name="breadcrumb" id="row" key="k">

                    <?php   if($k==(count($breadcrumb))){ ?>
                        <li>
                            <span class="active">{pigcms{$row[0]}</span>
                        </li>

                    <?php   }else{ ?>

                        <li>
                            <a href="{pigcms{$row[1]}">{pigcms{$row[0]}</a>
                            <i class="fa fa-circle"></i>
                        </li>

                    <?php   } ?>

                </volist>
            </ul>
            <div class="row">

                    <div class="col-md-12" style="float: left">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet light portlet-fit portlet-form bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class=" icon-layers font-green"></i>
                                    <span class="caption-subject font-green sbold uppercase">{pigcms{$breadcrumb[count($breadcrumb)-1][0]}</span>
                                </div>
                                <div class="actions">
                                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                        <i class="icon-cloud-upload"></i>
                                    </a>
                                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                        <i class="icon-wrench"></i>
                                    </a>
                                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                        <i class="icon-trash"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->

                                <div class="form-body">
                                    <block name="body"></block>
                                </div>
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>

            </div>

        </div>
    </div>
    <!-- /主体-->
</div>
<!--底部文件-->
<include file="./tpl/System/Public_news/footer_news.php" />

<script>
    window.onload=function(){       
        // var url = window.location.href;
        // var str = url.substr(url.lastIndexOf('system='),);
        // var num = str.substr(str.lastIndexOf('=')+1,);
        // var num = {pigcms{$_SESSION['system_id']};
        var num = document.getElementById("system_id").value;
        var href1 = document.getElementById("logo_a").href;
        var href2 = document.getElementById("span_a").href;
/*        var href3 = document.getElementById("child_a").href;
*/
        var logo_a = href1+'&system='+num;
        var span_a = href2+'&system='+num;
/*        var child_a = href3+'&system='+num;
*/
        console.log(num);
        if(/^\d+$/.test(num)){
            console.log(1);
            // pic.src="/Car/Admin/Public/assets/pages/img/login/vlg"+num+".jpg";  /^\d+$/.test(num)
            // document.getElementById("span_title").innerText="邻钱快递收发管理系统"; 
            if (num == 1) {
                document.getElementById("span_title").innerText="邻钱快递收发管理系统";
                document.getElementById("logo_text").innerText="邻钱快递收发管理系统";
                document.getElementById("span_text").innerText="邻钱快递收发管理系统";                               
            } else if(num == 2) {
                document.getElementById("span_title").innerText="邻钱在线考试管理系统";
                document.getElementById("logo_text").innerText="邻钱在线考试管理系统";
                document.getElementById("span_text").innerText="邻钱在线考试管理系统";
            } else if(num == 3) {
                document.getElementById("span_title").innerText="邻钱设施设备管理系统";
                document.getElementById("logo_text").innerText="邻钱设施设备管理系统";
                document.getElementById("span_text").innerText="邻钱设施设备管理系统";
            } else if(num == 4) {
                document.getElementById("span_title").innerText="邻钱固定资产管理系统";
                document.getElementById("logo_text").innerText="邻钱固定资产管理系统";
                document.getElementById("span_text").innerText="邻钱固定资产管理系统";
            } else if(num == 5) {
                document.getElementById("span_title").innerText="邻钱在线抄表管理系统";
                document.getElementById("logo_text").innerText="邻钱在线抄表管理系统";
                document.getElementById("span_text").innerText="邻钱在线抄表管理系统";
            } else if(num == 6) {
                document.getElementById("span_title").innerText="邻钱在线巡更管理系统";
                document.getElementById("logo_text").innerText="邻钱在线巡更管理系统";
                document.getElementById("span_text").innerText="邻钱在线巡更管理系统";
            }
            $('#logo_a').attr('href',logo_a);
            $('#span_a').attr('href',span_a);
/*            $('#child_a').attr('href',child_a);
*/
        }else{
            console.log(2);
            // pic.src="/Car/Admin/Public/assets/pages/img/login/vlg.jpg";
            document.getElementById("span_title").innerText="物业平台";
            document.getElementById("logo_text").innerText="物业平台";
            document.getElementById("span_text").innerText="物业平台";
        }

    };
</script>

<!--/底部文件-->
<block name="script">

</block>

<!--自定义js代码区结束-->
</body>

</html>


