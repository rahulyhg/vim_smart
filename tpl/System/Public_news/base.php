

    <!--头部文件-->
    <include file="./tpl/System/layout.php" />
    <!--/头部文件-->




<!--<div class="page-container">-->
    <!-- BEGIN SIDEBAR -->

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
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-12" id="table-toolbar-left">
                                        <block name="table-toolbar-left">

                                        </block>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="btn-group pull-right">
                                            <block name="table-toolbar-right">

                                            </block>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <block name="body">

                            </block>
                            <block name="modal_container">
                                <!--        弹出层容器-->
                                <div class="modal fade" tabindex="-1" role="dialog" id="common_modal">
                                    <div class="modal-dialog modal-lg" role="document" style="width:1200px">
                                        <div class="modal-content">

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" tabindex="-1" role="dialog" id="sub_modal">
                                    <div class="modal-dialog modal-lg" role="document" style="width:1000px">
                                        <div class="modal-content">

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" tabindex="-1" role="dialog" id="third_modal">
                                    <div class="modal-dialog modal-lg" role="document" style="width:1000px">
                                        <div class="modal-content">

                                        </div>
                                    </div>
                                </div>
                                <!--        弹出层容器-->
                            </block>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>

        </div>
    </div>
    <!--主体-->
</div>
<!--底部文件-->
<include file="./tpl/System/Public_news/footer_news.php" />
<!--/底部文件-->




<block name="script">

</block>

<!--自定义js代码区结束-->
</body>

</html>