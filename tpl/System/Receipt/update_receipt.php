<extend name="./tpl/System/Public_news/base.php" />
<block name="body">
    <div class="row">
        <form  class="form-horizontal" method="post" id="type_form" enctype="multipart/form-data" action="__SELF__">
            <div class="tab-content">
                <div id="basicinfo" class="tab-pane active">
                    <div class="form-group">
                        <div class="col-sm-2 control-label">业主信息</div>
                        <div class="col-sm-9">
                            {pigcms{$info['owner']}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">收费项目</div>
                        <div class="col-sm-9">
                            {pigcms{$info['type_name']}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">应付金额</div>
                        <div class="col-sm-9">
                            {pigcms{$info['pay_receive']}元
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">实付金额</div>
                        <div class="col-sm-9">
                            {pigcms{$info['pay_true']}元
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">支付方式</div>
                        <div class="col-sm-9">
                            <select name="type" class="form-control"  >
                                <foreach name="fee_type_list" item="vo" key="key">
                                    <option value="{pigcms{$key}" <if condition="$key eq $info['type']">selected</if> >{pigcms{$vo}</option>
                                </foreach>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">备注</div>
                        <div class="col-sm-9" >
                        <textarea name="remark" class="form-control" rows="10" >{pigcms{$info.remark}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space"></div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <button type="submit" class="btn green">确认提交</button>
                        <button type="reset" class="btn default" onclick="window.history.back(-1); ">返 回</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>
</block>
<!--<script type="text/javascript" src="{pigcms{$static_path}js/area.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/map.js"></script>-->
<block name="head">
    <style>
        .BMap_cpyCtrl{display:none;}
        input.ke-input-text {
            background-color: #FFFFFF;
            background-color: #FFFFFF!important;
            font-family: "sans serif",tahoma,verdana,helvetica;
            font-size: 12px;
            line-height: 24px;
            height: 24px;
            padding: 2px 4px;
            border-color: #848484 #E0E0E0 #E0E0E0 #848484;
            border-style: solid;
            border-width: 1px;
            display: -moz-inline-stack;
            display: inline-block;
            vertical-align: middle;
            zoom: 1;
        }
        .col-sm-1{width: 12%}
        .col-sm-2{width: 20%}
        .form-group>label{font-size:12px;line-height:24px;}
        #upload_pic_box{margin-top:20px;height:150px;}
        #upload_pic_box .upload_pic_li{width:130px;float:left;list-style:none;}
        #upload_pic_box img{width:100px;height:70px;border:1px solid #ccc;}
    </style>
    <link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">
</block>
<block name="script">
    <script type="text/javascript">


    </script>

</block>