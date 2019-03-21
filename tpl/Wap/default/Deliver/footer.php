	<link href="{pigcms{$static_path}css/footer.css" rel="stylesheet"/>
    <footer class="footermenu">
	    <ul>
	        <li>
	            <a <if condition="ACTION_NAME eq 'group_list' OR ACTION_NAME eq 'group_edit'">class="active"</if> href="{pigcms{:U('Deliver/grab')}">
	            <img src="{pigcms{$static_path}images/Lngjm86JQq.png">
	            <p>抢单</p>
	            </a>
	        </li>
	        <li>
	            <a <if condition="ACTION_NAME eq 'group_list' OR ACTION_NAME eq 'group_edit'">class="active"</if> href="{pigcms{:U('Deliver/pick')}">
	            <img src="{pigcms{$static_path}images/Lngjm86JQq.png">
	            <p>取货</p>
	            </a>
	        </li>
	        <li>
	            <a <if condition="ACTION_NAME eq 'meal_list' OR ACTION_NAME eq 'meal_edit'">class="active"</if> href="{pigcms{:U('Deliver/send')}">
	            <img src="{pigcms{$static_path}images/s22KaR0Wtc.png">
	            <p>配送</p>
	            </a>
	        </li>
			<li>
	            <a <if condition="ACTION_NAME eq 'group_list' OR ACTION_NAME eq 'group_edit'">class="active"</if> href="{pigcms{:U('Deliver/my')}">
	            <img src="{pigcms{$static_path}images/Lngjm86JQq.png">
	            <p>我的</p>
	            </a>
	        </li>
	    </ul>
	</footer>
	<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
	<script>
		//上传配送员位置
		var HAVE_SEND = <?php if($have_send){ echo $have_send;}else{ echo 0;}?>;
		var UPLOCATION_URL = "{pigcms{:U('Deliver/location')}";
		if (HAVE_SEND) {
			layer.open({title:['配送提示：','background-color:#FF658E;color:#fff;'],content:'订单正在配送，请保持页面长亮！',btn: ['确定'],end:function(){}});
			$(window).bind('beforeunload',function(){return '您有正在配送的订单，关闭后用户将看不到您的位置？';});
			if (navigator.geolocation){
				setInterval(upLocation, 60000);
			}else{
				clearInterval(timer);
				alert("定位失败,用户浏览器不支持或已禁用位置获取权限"); 
			}
		}

		function upLocation() {
			navigator.geolocation.getCurrentPosition(function(position){
				var lng = position.coords.longitude;
				var lat = position.coords.latitude;
				var point = {};
				point.lng = lng;
				point.lat = lat;
				BMap.Convertor.translate(point, 0, function(Bpoint){
					var Blng = Bpoint.lng;
					var Blat = Bpoint.lat;
					$.post(UPLOCATION_URL, "lng="+Blng+"&lat="+Blat, function(json){});
				});
			});
		}
	</script>