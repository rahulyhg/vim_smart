<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<style type="text/css">
</style>

<!-- BEGIN CONTENT BODY -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1><php>echo $breadcrumb[count($breadcrumb)-1][0]</php>
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
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->


<!--表格开始-->

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <if condition="$add_action['url']">
                                    <div class="btn-group">
                                        <a href="javascript:;" >
                                            <button class="btn sbold green" onclick="window.top.artiframe('{pigcms{$add_action['url']}','{pigcms{$add_action['name']}',600,400,true,false,false,addbtn,'add',true);" > {pigcms{$add_action['name']}
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                    </if>
                                </div>

                            </div>
                        </div>