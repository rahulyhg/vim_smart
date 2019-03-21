<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-group"></i>
                <a href="{pigcms{:U('User/index')}">业主管理</a>
            </li>
            <li class="active">导入业主</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <style>
                .ace-file-input a {display:none;}
            </style>
            <div class="row">
                <div class="col-xs-12">
                    <div  class="grid-view">
						<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover" width="100%">
							<tr>
								<th width="40%">名称</th>
								<th width="60%">导入进度</th>
							</tr>
                            <foreach name="err_array" item="vo">
                                <tr>
                                    <td width="40%">{pigcms{$vo.name}</td>
                                    <if condition="$vo.err eq 1">

                                        <td width="60%">{pigcms{$vo.msg}</td>

                                    <else/>

                                        <td width="60%">完成导入</td>

                                    </if>
                                </tr>
                            </foreach>
						</table>
						<div class="clearfix form-actions">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn btn-info" onclick="back_list();">
									<i class="ace-icon fa fa-check bigger-110"></i>
									返回
								</button>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script>
    function back_list(){
        window.location.href="{pigcms{:U('User/index')}";
    }

</script>
<include file="Public:footer"/>
