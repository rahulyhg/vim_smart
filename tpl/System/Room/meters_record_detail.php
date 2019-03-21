
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{pigcms{$meter[0]['cates']['cate_type']} -- {pigcms{$meter[0]['meter_code']}</h4>
</div>
<div class="modal-body" style="height:60rem;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">抄表详情</span>
            <div style="clear: both"></div>
        </div>
        <div class="panel-body">
            <volist name="meter[0]['cates']['cateArray']" id="voi">

                <!-- <div>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td  colspan="2" style="background-color:#f1f1f1; border:1px #d3d4d6 solid; height:34px; text-align:center; color:#5f5f5f; font-weight:600;">{pigcms{$voi.desc}</td>
                            </tr>
                            <volist name="voi['cateArr']" id="voc">
                            <tr>
                                <td style="background-color:#ffffff; width:70%;  border:1px #d3d4d6 solid; height:34px; text-align:center; border-top:none; color:#2d2d2d;">{pigcms{$voc.desc}</td>
                                <td style="background-color:#ffffff; width:30%;  border:1px #d3d4d6 solid; height:34px; text-align:center; border-top:none; color:#666666; border-left:none;">{pigcms{$voc.val}</td>
                            </tr>
                            </volist>
                    </table>                          
                </div> -->

                <if condition="$voi.id == 94">
                  <div>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                  <td style="background-color:#f1f1f1; width:30%; border:1px #d3d4d6 solid; height:34px; text-align:center; color:#5f5f5f; font-weight:600;">声音状态</td>
                                  <if condition="$voi['cateArr'][0]['val'] == 0">
                                    <td style="background-color:#ffffff; border:1px #d3d4d6 solid; height:42px; text-align:center; border-left:none; color:#508fff;"><i class="weui-icon-success weui-icon_msg"></i></td>
                                  <else/>
                                    <td style="background-color:#ffffff; border:1px #d3d4d6 solid; height:42px; text-align:center; border-left:none; color:#508fff;"><i class="weui-icon-warn weui-icon_msg-primary"></i></td>
                                  </if>
                              </tr>
                      </table>
                  </div>
                <elseif condition="$voi.id == 95"/>
                  <div>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                  <td style="background-color:#f1f1f1; width:30%; border:1px #d3d4d6 solid; height:34px; text-align:center; color:#5f5f5f; font-weight:600;">低压测母线状态</td>
                                  <if condition="$voi['cateArr'][0]['val'] == 0">
                                    <td style="background-color:#ffffff; border:1px #d3d4d6 solid; height:42px; text-align:center; border-left:none; color:#508fff;"><i class="weui-icon-success weui-icon_msg"></i></td>
                                  <else/>
                                    <td style="background-color:#ffffff; border:1px #d3d4d6 solid; height:42px; text-align:center; border-left:none; color:#508fff;"><i class="weui-icon-warn weui-icon_msg-primary"></i></td>
                                  </if>                              
                              </tr>
                      </table>
                  </div>
                <else/>                                                
                  <div>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                              <td  colspan="2" style="background-color:#f1f1f1; border:1px #d3d4d6 solid; height:34px; text-align:center; color:#5f5f5f; font-weight:600;">{pigcms{$voi.desc}</td>
                          </tr>
                          <volist name="voi['cateArr']" id="voc">
                          <tr>
                              <td style="background-color:#ffffff; width:30%;  border:1px #d3d4d6 solid; height:34px; text-align:center; border-top:none; color:#2d2d2d;">{pigcms{$voc.desc}</td>
                              <td style="background-color:#ffffff; width:70%;  border:1px #d3d4d6 solid; height:34px; text-align:center; border-top:none; color:#666666; border-left:none;">{pigcms{$voc.val}</td>
                          </tr>
                          </volist>
                      </table>                          
                  </div>
                </if>
            </volist>
        </div>
    </div>

    <div class="xkk">
  <div class="cw2">
    <div class="link">
      <div class="jb">
        <div class="uz">基本信息</div>
        <div style="clear:both"></div>
      </div>
    </div>
      <div class="zw m10">        
        <!-- <div class="zw" style="margin-top: -10px;">
          <div class="zb">设备楼层：</div>
          <div class="yb">{pigcms{$meter[0]['cates']['cate_type']}</div>
          <div style="clear:both;"></div>
        </div>        
        <div class="zw" style="margin-top: -20px;">
          <div class="zb">设备类型：</div>
          <div class="yb">{pigcms{$meter[0]['cates']['cate_type']}</div>
          <div style="clear:both;"></div>
        </div>
        <div class="zw" style="margin-top: -20px;">
          <div class="zb">设备分类：</div>
          <div class="yb">{pigcms{$meter[0]['cates']['cate_type']}</div>
          <div style="clear:both;"></div>
        </div> -->

        
        <volist name="meter[0]['configArr']" id="vo">
          <div>
            <div class="zb">{pigcms{$vo.desc}：</div>
            <div class="yb" style="float: left; margin-left: 45px; margin-top: -21px;">{pigcms{$vo.val}</div>
            <div style="clear:both;"></div>
          </div>
        </volist>

      </div>
  </div><div style="clear:both;"></div>
</div>
</div>


<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>
<script>
    $(document).ready(function(){
        $(document).on('click','.close_sub_modal',function(){
            $("#meter_set").modal('hide');
            $("#meter_qr").modal('hide');
            $("#bind_meter_{pigcms{$tenant_info['pigcms_id']}").modal('hide');

        });
    });

</script>