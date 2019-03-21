<include file="Public:header"/>

	<form id="myform" method="post" action="{pigcms{:U('Merchant/amend')}" frame="true" refresh="true" style="background-color:#FFFFFF;">

		<input type="hidden" name="mer_id" value="{pigcms{$merchant.mer_id}"/>

		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">

			<tr>

				<th width="80">商户帐号</th>

				<td><div class="show">{pigcms{$merchant.account}</div></td>

			</tr>

			<tr>

				<th width="80">商户密码</th>

				<td><input type="password" id="check_pwd" check_width="180" check_event="keyup" class="input fl" name="pwd" value="" size="25" placeholder="不修改则不填写！" validate="minlength:6" tips="不修改则不填写！"/></td>

			</tr>

			<tr>

				<th width="80">商户名称</th>

				<td><input type="text" class="input fl" name="name" value="{pigcms{$merchant.name}" size="25" placeholder="商户的公司名或..." validate="maxlength:20,required:true"/></td>

			</tr>

			<tr>

				<th width="80">联系电话</th>

				<td><input type="text" class="input fl" name="phone" value="{pigcms{$merchant.phone}" size="25" placeholder="联系人的电话" validate="required:true" tips="多个电话号码以空格分开"/></td>

			</tr>

			<tr>

				<th width="80">联系邮箱</th>

				<td><input type="text" class="input fl" name="email" value="{pigcms{$merchant.email}" size="25" placeholder="可不填写" validate="email:true" tips="只供管理员后台记录，前台不显示"/></td>

			</tr>

			<tr>

				<th width="80">所在区域</th>

				<td id="choose_cityarea" province_id="{pigcms{$merchant.province_id}" city_id="{pigcms{$merchant.city_id}" area_id="{pigcms{$merchant.area_id}" circle_id="-1"></td>

			</tr>

			<tr>

				<th width="80">所属社区</th>

				<td>
					<select name="village_id" id="village_id">
						<option value="0" selected="selected">请选择</option>
						<volist name="village_result" id="vo">
							<option value="{pigcms{$vo.village_id}" <if condition="$vo['village_id'] eq $village_me['village_id']">selected="selected"</if>>{pigcms{$vo.village_name}</option>
						</volist>
					</select>
				</td>
			</tr>
            <if condition="$project_list neq ''">
                <tr id="project_id_list">
                    <th width="80">所属期数</th>
                    <td>
                        <select name="project_id" id="project_id">
                            <volist name="project_list" id="vo">
                                <option value="{pigcms{$vo['pigcms_id']}" <if condition="$vo['pigcms_id'] eq $village_me['project_id']">selected="selected"</if>>{pigcms{$vo['desc']}</option>
                            </volist>
                        </select>
                    </td>
                </tr>
                <else/>
                <tr id="project_id_list" style="display: none;">
                    <th width="80">所属期数</th>
                    <td>
                        <select name="project_id" id="project_id">
                        </select>
                    </td>
                </tr>
            </if>
			<tr>

				<th width="80">商户状态</th>

				<td>

					<span class="cb-enable"><label class="cb-enable <if condition="$merchant['status'] eq 1">selected</if>"><span>启用</span><input type="radio" name="status" value="1" <if condition="$merchant['status'] eq 1">checked="checked"</if> /></label></span>

					<span class="cb-disable"><label class="cb-disable <if condition="$merchant['status'] neq 1">selected</if>"><span>关闭</span><input type="radio" name="status" value="0" <if condition="$merchant['status'] neq 1">checked="checked"</if>/></label></span>

				</td>

			</tr>

			<tr>

				<th width="80">线下支付</th>

				<td>

					<span class="cb-enable"><label class="cb-enable <if condition="$merchant['is_close_offline'] eq 0">selected</if>"><span>启用</span><input type="radio" name="is_close_offline" value="0" <if condition="$merchant['is_close_offline'] eq 0">checked="checked"</if> /></label></span>

					<span class="cb-disable"><label class="cb-disable <if condition="$merchant['is_close_offline'] eq 1">selected</if>"><span>关闭</span><input type="radio" name="is_close_offline" value="1" <if condition="$merchant['is_close_offline'] eq 1">checked="checked"</if>/></label></span>

				</td>

			</tr>

			<tr>

				<th width="80">签约商家</th>

				<td>

					<span class="cb-enable"><label class="cb-enable <if condition="$merchant['issign'] eq 1">selected</if>"><span>是</span><input type="radio" name="issign" value="1" <if condition="$merchant['issign'] eq 1">checked="checked"</if> /></label></span>

					<span class="cb-disable"><label class="cb-disable  <if condition="$merchant['issign'] neq 1">selected</if>"><span>否</span><input type="radio" name="issign" value="0"  <if condition="$merchant['issign'] neq 1">checked="checked"</if> /></label></span>

					<em class="notice_tips" tips="开启后商家中心会显示此商家已签约标签即商家是优质客户，所有新增的产品都无需审核"></em>

				</td>

			</tr>

			<tr>

				<th width="80">认证商家</th>

				<td>

					<span class="cb-enable"><label class="cb-enable <if condition="$merchant['isverify'] eq 1">selected</if>"><span>是</span><input type="radio" name="isverify" value="1" <if condition="$merchant['isverify'] eq 1">checked="checked"</if> /></label></span>

					<span class="cb-disable"><label class="cb-disable <if condition="$merchant['isverify'] neq 1">selected</if>"><span>否</span><input type="radio" name="isverify" value="0"  <if condition="$merchant['isverify'] neq 1">checked="checked"</if> /></label></span>

					<em class="notice_tips" tips="开启后商家中心会显示此商家已认证标签"></em>

				</td>

			</tr>

			<tr>

				<th width="80">开启充值</th>

				<td>

					<span class="cb-enable"><label class="cb-enable <if condition="$merchant['is_recharge'] eq 1">selected</if>"><span>开启</span><input type="radio" name="is_recharge" value="1" <if condition="$merchant['is_recharge'] eq 1">checked="checked"</if> /></label></span>

					<span class="cb-disable"><label class="cb-disable <if condition="$merchant['is_recharge'] eq 0">selected</if>"><span>关闭</span><input type="radio" name="is_recharge" value="0" <if condition="$merchant['is_recharge'] eq 0">checked="checked"</if>/></label></span>

				</td>

			</tr>

			<tr>

				<th width="80">使用公众号</th>

				<td>

					<span class="cb-enable"><label class="cb-enable <if condition="$merchant['is_open_oauth'] eq 1">selected</if>"><span>允许</span><input type="radio" name="is_open_oauth" value="1" <if condition="$merchant['is_open_oauth'] eq 1">checked="checked"</if> /></label></span>

					<span class="cb-disable"><label class="cb-disable <if condition="$merchant['is_open_oauth'] eq 0">selected</if>"><span>禁止</span><input type="radio" name="is_open_oauth" value="0" <if condition="$merchant['is_open_oauth'] eq 0">checked="checked"</if>/></label></span>

				</td>

			</tr>

			<tr>

				<th width="80">开微店</th>

				<td>

					<span class="cb-enable"><label class="cb-enable <if condition="$merchant['is_open_weidian'] eq 1">selected</if>"><span>允许</span><input type="radio" name="is_open_weidian" value="1" <if condition="$merchant['is_open_weidian'] eq 1">checked="checked"</if> /></label></span>

					<span class="cb-disable"><label class="cb-disable <if condition="$merchant['is_open_weidian'] eq 0">selected</if>"><span>禁止</span><input type="radio" name="is_open_weidian" value="0" <if condition="$merchant['is_open_weidian'] eq 0">checked="checked"</if>/></label></span>

				</td>

			</tr>


            <tr>

                <th width="80">显示商家实景</th>

                <td>

                    <span class="cb-enable"><label class="cb-enable <if condition="$merchant['is_view'] eq 1">selected</if>"><span>允许</span><input type="radio" name="is_view" value="1" <if condition="$merchant['is_view'] eq 1">checked="checked"</if> /></label></span>

                    <span class="cb-disable"><label class="cb-disable <if condition="$merchant['is_view'] eq 0">selected</if>"><span>禁止</span><input type="radio" name="is_view" value="0" <if condition="$merchant['is_view'] eq 0">checked="checked"</if>/></label></span>

                </td>

            </tr>

			<tr>

				<th width="80">平台抽成比例</th>

				<td><input type="text" class="input fl" name="percent" value="{pigcms{$merchant.percent}" size="5" placeholder="0" tips="平台根据商家的总销售额获取的一定比例的抽成，设置为0则取系统设置的比例"/></td>

			</tr>

			<tr>

				<th width="80">平台积分</th>

				<td><input type="text" class="input fl" name="plat_score" value="{pigcms{$merchant.plat_score}" size="10" placeholder="0" tips="平台积分"/></td>

			</tr>

			<tr><th colspan="2" style="color: red;text-align:center"> 超级广告设置 </th></tr>

			<tr>

				<th width="80">首页宣传状态</th>

				<td>

					<select name="share_open" class="valid">

					<option value="0" <if condition="$merchant['share_open'] eq 0">selected="selected"</if>>关闭</option>

					<option value="1" <if condition="$merchant['share_open'] eq 1">selected="selected"</if>>开启显示商家信息</option>

					<option value="2" <if condition="$merchant['share_open'] eq 2">selected="selected"</if>>开启跳转到商家微网站</option>

					</select>

				</td>

			</tr>

			<tr>

				<th width="80">广告语</th>

				<td><input type="text" class="input fl" name="a_title" value="{pigcms{$home_share.title}" size="25" placeholder="可不填写" tips="粉丝看到自己的第一次进入本站来自哪个商家的店铺"/></td>

			</tr>

			<tr>

				<th width="80">进入提示语</th>

				<td><input type="text" class="input fl" name="a_name" value="{pigcms{$home_share.a_name}" size="5" placeholder="可不填写" tips="提示粉丝进入的提示语言"/></td>

			</tr>

			<tr>

				<th width="80">进入网址</th>

				<td><input type="text" class="input fl" name="a_href" value="{pigcms{$home_share.a_href}" size="60" placeholder="可不填写" tips="跳转到指定地方的网址"  validate="url:true"/></td>

			</tr>

		</table>

		<div class="btn hidden">

			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />

			<input type="reset" value="取消" class="button" />

		</div>

	</form>
<script>
    $('#village_id').change(function () {
            var p1=$(this).children('option:selected').val();
            $.ajax({
                type:"POST",
                url:'{pigcms{:U('ajax_village_info')}',
                data:{village_id:p1},
                success:function(re) {
                    re=JSON.parse(re);
                    console.log(typeof re);
                    if(re.res=='1'){
                        $('#project_id_list').css('display','');
                        $('#project_id').empty();
                        $.each(re.data,function(idx, obj){
                            $('#project_id').append("<option value='"+obj.pigcms_id+"'>"+obj.desc+"</option>");
                        });
                    }else{
                        $('#project_id_list').css('display','none');
                    }

                }
            });
        }
    )
</script>
<include file="Public:footer"/>