<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-tablet"></i>
                <a href="{pigcms{:U('Access/operatLog')}">开门记录</a>
            </li>
            <li class="active">详情</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <div class="row">
                <div class="col-xs-12">
                    <form enctype="multipart/form-data" class="form-horizontal" id="edit_form">                                                                                                                                                                                                                                                                              
                        <div class="tab-content">
                            <div id="basicinfo" class="tab-pane active">
                                
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">用户</label></label>
                                    <input class="col-sm-2" size="80" name="name" id="title" type="text" readonly="readonly" value="{pigcms{$log_info['name']}"/>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">联系方式</label></label>
                                    <input class="col-sm-2" size="80" name="phone" id="title" type="text" readonly="readonly" value="{pigcms{$log_info['phone']}"/>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">时间</label></label>
                                    <input class="col-sm-2" size="80" name="opdate" id="title" type="text"  readonly="readonly" value="{pigcms{$log_info['opdate']|date='Y-m-d H:i:s',###}"/>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">设备名称</label></label>
                                    <input class="col-sm-2" size="80" name="ac_name" id="title" type="text"  readonly="readonly" value="{pigcms{$log_info['ac_name']}"/>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">所属区域</label></label>
                                    <input class="col-sm-2" size="80" name="village_name" id="title" type="text"  readonly="readonly" value="{pigcms{$log_info['ag_name']}"/>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">所属公司</label></label>
                                    <input class="col-sm-2" size="80" name="company" id="title" type="text"  readonly="readonly" value="{pigcms{$log_info['company_name']}"/>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">证件类型</label></label>
                                    <if condition="$log_info.card_type eq 1"><input type="text" class="col-sm-2" value="现场审核" readonly="readonly"/></if>
                                    <if condition="$log_info.card_type eq 2"><input type="text" class="col-sm-2" value="门禁卡" readonly="readonly"/></if>
                                    <if condition="$log_info.card_type eq 3"><input type="text" class="col-sm-2" value="身份证" readonly="readonly"/></if>
                                    <if condition="$log_info.card_type eq 4"><input type="text" class="col-sm-2" value="工作牌" readonly="readonly"/></if>
                                </div>

                                <if condition="$log_info.card_type neq 1 and $log_info.card_type neq 4 ">
                                    <div class="form-group">
                                        <label class="col-sm-1"><label for="title">证件号</label></label>
                                        <input class="col-sm-2" size="80" name="usernum" id="title" type="text" readonly="readonly" value="{pigcms{$log_info['usernum']}"/>
                                    </div>
                                </if>

                                <if condition="$log_info.card_type neq 1">
                                    <div class="form-group">
                                        <label class="col-sm-1"><label for="title">证件照</label></label>
                                        <php> $workcard_img=explode('|',$log_info['workcard_img'])</php>
                                        <volist name="workcard_img" id="img" key="k">
                                            <img alt="" src="/upload/house/{pigcms{$img}" width="70" height="110"  style="margin-left:20px;margin-top:10px;clear:both"  />
                                        </volist>
                                    </div>
                                </if>
                                <!--<div class="form-group">
                                onclick="window.location.href='http://www.hdhsmart.com/shequ.php?g=House&c=Access&a=operatLog'"
                                    <label class="col-sm-1"><label for="description">设备描述</label></label>
                                    <textarea id="description" name="ac_desc"  placeholder="描述内容">{pigcms{$access_info['ac_desc']|htmlspecialchars_decode=ENT_QUOTES}</textarea>
                                </div>-->
                            <div class="space"></div>
                             <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button class="btn btn-info" type="button" onclick="window.location.href='{pigcms{:U('Access/operatLog')}'">
                                           <i class="ace-icon fa"></i>
                                            返回
                                        </button>
                                    </div>
                                </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .ke-dialog-body .ke-input-text{height: 30px;}
</style>
<include file="Public:footer"/>