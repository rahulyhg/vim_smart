<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'包裹管理',
    'describe'=>'',
);
$breadcrumb = array(
    array('收发快递','#'),
    array('包裹管理','#'),
);

/*$add_action = array(
    'url'=>U('Searchhot/add'),
    'name'=>'快递1公司'
);*/
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Left Tabs </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <ul class="nav nav-tabs tabs-left">
                            <li class="active">
                                <a href="#tab_6_1" data-toggle="tab"> Home </a>
                            </li>
                            <li>
                                <a href="#tab_6_2" data-toggle="tab"> Profile </a>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> More
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#tab_6_3" tabindex="-1" data-toggle="tab"> Option 1 </a>
                                    </li>
                                    <li>
                                        <a href="#tab_6_4" tabindex="-1" data-toggle="tab"> Option 2 </a>
                                    </li>
                                    <li>
                                        <a href="#tab_6_3" tabindex="-1" data-toggle="tab"> Option 3 </a>
                                    </li>
                                    <li>
                                        <a href="#tab_6_4" tabindex="-1" data-toggle="tab"> Option 4 </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#tab_6_1" data-toggle="tab"> Settings </a>
                            </li>
                            <li>
                                <a href="#tab_6_1" data-toggle="tab"> More </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_6_1">
                                <p> Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
                                    butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher
                                    voluptate nisi qui. </p>
                            </div>
                            <div class="tab-pane fade" id="tab_6_2">
                                <p> Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table
                                    craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.
                                    Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel.
                                    Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park. </p>
                            </div>
                            <div class="tab-pane fade" id="tab_6_3">
                                <p> Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone
                                    skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork
                                    biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr. </p>
                            </div>
                            <div class="tab-pane fade" id="tab_6_4">
                                <p> Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party
                                    locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade
                                    thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script>

    $("input[name='waybill_number']").keydown(function () {
        $("form").submit();

    });

    $("#show_hand").click(function(){
        $("#hand_number").show();
        $("#hand_submit").slideDown();
        $("#saoma").hide();
    });

    $("#handInput").click(function () {
        var number = $("input[name='waybill_number1']").val();
        $("input[name='waybill_number']").val(number);
        $("form").submit();
    });

    $("input[name='phone']").change(function () {
        var phone = $("input[name='phone']").val();
        $.ajax({
            url:"{pigcms{:U('ajax_user_info')}",
            type:'post',
            data:{'phone':phone},
            success:function (res) {
                res && $("input[name='name']").val(res);
            }
        });
    });


</script>


<!--自定义js代码区结束-->
<include file="Public_news:footer"/>