<div class="page-sidebar-wrapper">

    <div class="page-sidebar navbar-collapse collapse">

        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

            <li class="nav-item start active open">
                <a href="http://www.hdhsmart.com/admin.php?g=System&c=Index&a=index_new" class="nav-link nav-toggle" id="span_a">
                    <i class="icon-home"></i>
                    <!-- <span class="title"><img src="" class="logo-default" id="span_pic"></span> -->
                    <span class="title" id="span_text"></span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
            </li>

            <!--***************************************************************停车系统开始************************************************-->

            <volist name="arr" id="vo">
                <li class="heading">
                    <h3 class="uppercase">{pigcms{$vo.name}</h3>
                </li>
                <volist name="vo['child_list']" id="sv">
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="{pigcms{$sv.icon}"></i>
                            <span class="title">{pigcms{$sv.name}</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <volist name="sv['child_list']" id="voo">
                                <li class="nav-item  ">
                                    <if condition="$voo['name'] eq '系统警告配置' or $voo['name'] eq '警告信息列表'">
                                        <a href="{pigcms{$voo.url}" class="nav-link ">
                                            <span class="title">{pigcms{$voo.name}</span>
                                        </a>
                                        <else/>
                                        <a href="{pigcms{$voo.url}_news" class="nav-link ">
                                            <span class="title">{pigcms{$voo.name}</span>
                                        </a>
                                    </if>
                                </li>
                            </volist>
                        </ul>
                    </li>
                </volist>
            </volist>
            <!-- 根据url自动选择相应的选项卡-->
            <script src="/Car/Admin/Public/js/jquery.js" type="text/javascript"></script>
            <script>
                function menu_select(url){
                    $('.sub-menu li a').each(function(){
                        if($($(this))[0].href.indexOf(url)>-1){
                            $(this).parent().addClass('open');
                            $(this).parent().parent().parent().addClass('open');
                            $(this).parent().parent().parent().find(".sub-menu").show();
                        }
                    });
                };
                $(function(){
                    var lastUrl = document.referrer;
                    $('.sub-menu li a').each(function(){
                        if($($(this))[0].href==String(window.location)){
                            $(this).parent().addClass('open');
                            $(this).parent().parent().parent().addClass('open');
                            $(this).parent().parent().parent().find(".sub-menu").show();
                        }else if(lastUrl == $($(this))[0].href){
                            $(this).parent().addClass('open');
                            $(this).parent().parent().parent().addClass('open');
                            $(this).parent().parent().parent().find(".sub-menu").show();
                        }
                    });


                });
            </script>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>