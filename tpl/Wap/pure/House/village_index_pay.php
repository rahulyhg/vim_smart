<if condition="$pay_list">
	<section class="slider" style="height:auto;">
		<div class="headBox">社区服务</div>
		<div class="swiper-container swiper-container2" style="height:auto;padding-bottom:10px;">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<ul class="icon-list">
						<volist name="pay_list" id="vo">
							<li class="icon">
								<a href="{pigcms{$vo.url}">
									<span class="icon-circle">
										<if condition="$vo['type'] neq 'appoint'">
											<img src="{pigcms{$static_path}images/house/{pigcms{$vo.type}.png"/>
										<else/>
											<img src="{pigcms{$vo.pic}"/>
										</if>
									</span>
									<span class="icon-desc">{pigcms{$vo.name}</span>
								</a>
							</li>
						</volist>
					</ul>
				</div>
			</div>
			<div class="swiper-pagination swiper-pagination2"></div>
		</div>
	</section>
</if>