<include file="Public:header"/>

<!-- BEGIN CONTENT --><style type="text/css">
    <!--
    .md-checkbox label>.box {
        top: 15px;
        left: 15px;
        border: 2px solid #666;
        height: 20px;
        width: 20px;
        z-index: 5;
        -webkit-transition-delay: .2s;
        -moz-transition-delay: .2s;
        transition-delay: .2s;
    }
    .md-checkbox label>.check {
        top: 10px;
        left: 15px;
        width: 10px;
        height: 20px;
        border: 2px solid #36c6d3;
        border-top: none;
        border-left: none;
        opacity: 0;
        z-index: 5;
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        transform: rotate(180deg);
        -webkit-transition-delay: .3s;
        -moz-transition-delay: .3s;
        transition-delay: .3s;
    }
    -->
</style>
<div class="page-content-wrapper">

    <div class="page-content">
        <div class="row">
            <form action="{pigcms{:U('Express/add_admin')}" method="post"  frame="true" refresh="true" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <div class="col-md-12" style="float: left">
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-body">

                            <div class="form-body">
                                <div class="form-group form-md-checkboxes">
                                    <div class="col-md-9"><table border='1' style="border:1px  #c2cad8 solid;">
                                            <tr>
                                                <th colspan="2" style="text-align: center;font-size: 24px">管理取件员</th>
                                            </tr>
                                            <volist name="bigArr" id="rowset">
                                                <tr>
                                                    <th width="30%">
                                                        <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                                                <span class="check"></span>
                                                                <span class="box"></span>{pigcms{$rowset['village_name']}
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <volist name="rowset['son']" id="row">
                                                            <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                                                <input type="checkbox" class="md-check" id="checkbox1_{pigcms{$row.id}" name="admin_{pigcms{$rowset.village_id}" value="{pigcms{$row['id']}" <if condition="in_array($row['id'], $staffArr)">checked="checked"</if> />
                                                                <label for="checkbox1_{pigcms{$row.id}">
                                                                    <span class="check"></span>
                                                                    {pigcms{$row['realname']}</label>　
                                                            </div>
                                                        </volist>
                                                    </td>
                                                </tr>
                                            </volist>
                                        </table></div>
                                </div>
                            </div>
                            <input type="hidden" name="express_id" value="{pigcms{$express_id}" />
                            <div class="btn hidden">

                                <input type="submit"  id="dosubmit" value="提交" class="button" />

                                <input type="reset" value="取消" class="button" />

                            </div>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </form>
        </div>

    </div>
</div>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="quick-nav-overlay"></div>

</body>

<include file="Public:footer"/>