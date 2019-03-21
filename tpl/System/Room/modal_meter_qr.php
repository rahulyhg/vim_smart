<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal_body">
    <div style="float:left; width:30%; margin-left:2%;">
		<img src="{pigcms{:U('meter_qr',array('meter_hash'=>$meter_hash))}" alt="">
	</div>
	<div style="float:left; margin-left:10%; width:55%;">
		<div style="width:100%; height:36px; overflow:hidden; text-align:center; line-height:36px; color:#FFFFFF; background-color:#32c5d2; font-size:18px; margin-top:10px; font-weight:bold;">设备详情</div>
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:14px; margin-top:8px;">
        <tr>
          <td width="50%" height="65" align="left" bgcolor="#f9fafb" style="border-left:1px #32c5d2 solid; border-top:1px #32c5d2 solid; border-bottom:1px #f2f5f8 solid; padding-left:20px; color:#8896a0;"><strong>设备编号</strong>：{pigcms{$meter_info.meter_code}</td>
          <td width="50%" height="65" align="left" bgcolor="#f9fafb" style="border-right:1px #32c5d2 solid; border-top:1px #32c5d2 solid; border-bottom:1px #f2f5f8 solid; color:#8896a0;"><strong>设备类型</strong>：{pigcms{$meter_type_list[$meter_info["meter_type_id"]]}</td>
        </tr>
        <if condition="$meter eq 1">
          <tr>
            <td height="65" align="left" style="border-left:1px #32c5d2 solid; padding-left:20px; color:#8896a0; border-bottom:1px #f2f5f8 solid;"><strong>设备分类</strong>：{pigcms{$meter_info.meter_cate}</td>            
            <td height="65" align="left" style="border-right:1px #32c5d2 solid; color:#8896a0; border-bottom:1px #f2f5f8 solid;"><strong>楼层</strong>：{pigcms{$meter_info.meter_desc}</td>            
          </tr>
          <volist name="meter_info['configArr']" id="vo">
          <tr>
            <td height="65" align="left" style="border-left:1px #32c5d2 solid; padding-left:20px; color:#8896a0; border-bottom:1px #f2f5f8 solid;"><strong>{pigcms{$vo.parameter}</strong>：{pigcms{$vo.val}</td>            
            <td height="65" align="left" style="border-right:1px #32c5d2 solid; color:#8896a0; border-bottom:1px #f2f5f8 solid;"><strong></strong></td>
          </tr>
          </volist>
        <else/>
          <tr>
            <td height="65" align="left" style="border-left:1px #32c5d2 solid; padding-left:20px; color:#8896a0; border-bottom:1px #f2f5f8 solid;"><strong>计费类型</strong>：{pigcms{$price_type_list[$meter_info["price_type_id"]]}</td>
            <td height="65" align="left" style="border-right:1px #32c5d2 solid; color:#8896a0; border-bottom:1px #f2f5f8 solid;"><strong>楼层</strong>：{pigcms{$meter_info.meter_floor}</td>
          </tr>
          <tr>
            <td height="65" align="left" bgcolor="#f9fafb" style="border-left:1px #32c5d2 solid; border-bottom:1px #f2f5f8 solid; padding-left:20px; color:#8896a0;"><strong>倍率</strong>：{pigcms{$meter_info.rate}</td>
            <td height="65" align="left" bgcolor="#f9fafb" style="border-right:1px #32c5d2 solid; border-bottom:1px #f2f5f8 solid; color:#8896a0;"><strong>当月用量</strong>：{pigcms{$meter_info.use_count}</td>
          </tr>
          <tr>
            <td height="65" align="left" style="border-left:1px #32c5d2 solid; padding-left:20px; color:#8896a0; border-bottom:1px #f2f5f8 solid;"><strong>上月止码</strong>：{pigcms{$meter_info['be_cousume'][0]}</td>
            <td height="65" align="left" style="border-right:1px #32c5d2 solid; color:#8896a0; border-bottom:1px #f2f5f8 solid;"><strong>本月止码</strong>：{pigcms{$meter_info['be_cousume'][1]}</td>
          </tr>
        </if>       
        <tr>
          <td height="65" align="left" bgcolor="#f9fafb" style="border-left:1px #32c5d2 solid; border-bottom:1px #26a1ab solid ; padding-left:20px; color:#8896a0;">&nbsp;</td>
          <td height="65" align="left" bgcolor="#f9fafb" style="border-right:1px #32c5d2 solid; border-bottom:1px #26a1ab solid; color:#8896a0;">&nbsp;</td>
        </tr>
      </table>
	</div>
	<div style="clear:both"></div>
</block>
