<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a href="{pigcms{:U('output_excel')}">
            <button id="sample_editable_1_new" class="btn sbold green">下载物业收费登记账
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <div class="btn-group" style="margin-top:10px;">
            <span id="filter">
                <span>
					<span style="line-height:30px;">筛选：</span>
                    <div class="btn-group">
                        <select id="datetimepicker"  class="form-control" placeholder="" name="startDate" onchange="change_url('year',this.options[this.options.selectedIndex].value)">
                            <for start="2017" end="date('Y')+2">
                                <option value="{pigcms{$i}">{pigcms{$i}年</option>
                            </for>
                        </select>
                    </div>
                </span>
            </span>
        </form>
    </div>
    <br>
    <div class="btn-group">
        <a data-toggle="modal" data-target="#common_modal" href="{pigcms{:U('Property/ajax_update_collect_time')}">
            <button id="sample_editable_1_new" class="btn sbold green">设置月报表结算时间
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>

</block>
<block name="body">
<style type="text/css">
    <!--
    .table-checkable tr>td:first-child, .table-checkable tr>th:first-child {
        text-align: center;
        max-width: 100px;
        min-width: 40px;
        padding-left: 0;
        padding-right: 0;
    }
    -->
    html,body{
        height: 100%;
        width: 100%;
    }
    .test{
        position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index:1001;
        -moz-opacity: 0.3;
        opacity:.30;
        filter: alpha(opacity=30);

    }
    .spinner {
        margin: 100px auto;
        margin-bottom: 0px;
        width: 50px;
        height: 150px;
        text-align: center;
        font-size: 10px;
    }

    .spinner > div {
        background-color: #7CFC00;
        height: 100%;
        width: 6px;
        display: inline-block;

        -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
        animation: sk-stretchdelay 1.2s infinite ease-in-out;
    }

    .spinner .rect2 {
        -webkit-animation-delay: -1.1s;
        animation-delay: -1.1s;
    }

    .spinner .rect3 {
        -webkit-animation-delay: -1.0s;
        animation-delay: -1.0s;
    }

    .spinner .rect4 {
        -webkit-animation-delay: -0.9s;
        animation-delay: -0.9s;
    }

    .spinner .rect5 {
        -webkit-animation-delay: -0.8s;
        animation-delay: -0.8s;
    }

    @-webkit-keyframes sk-stretchdelay {
        0%, 40%, 100% { -webkit-transform: scaleY(0.4) }
        20% { -webkit-transform: scaleY(1.0) }
    }

    @keyframes sk-stretchdelay {
        0%, 40%, 100% {
            transform: scaleY(0.4);
            -webkit-transform: scaleY(0.4);
        }  20% {
               transform: scaleY(1.0);
               -webkit-transform: scaleY(1.0);
           }
    }
    .nav-justified > li>a{
        font-size: 11px;
        white-space:nowrap;
    }
	 .bounce1{
         background-color: #32c5d2!important;
     }
	 .bounce2{
         background-color: #32c5d2!important;
     }
	 .bounce3{
         background-color: #32c5d2!important;
     }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="portlet-title">

        </div>

        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>费用详情 </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="tabbable-custom nav-justified" >
                        <ul class="nav nav-tabs nav-justified" style="overflow-x:scroll">
                            <li <if condition="ACTION_NAME eq property">class="active"</if>>
                            <a href="{pigcms{:U('property')}" onclick="loading();"> 物业服务费 </a>
                            </li>
                            <li <if condition="ACTION_NAME eq carspace">class="active"</if>>
                            <a href="{pigcms{:U('carspace')}" onclick="loading();"> 包月泊位费 </a>
                            </li>
                            <volist name="type_list" id="vo">
                                <li <if condition="$_GET['type_id'] eq $vo['otherfee_type_id']">class="active"</if>>
                                <a href="{pigcms{:U('other',array('type_id'=>$vo['otherfee_type_id']))}" onclick="loading();"> {pigcms{$vo['otherfee_type_name']} </a>
                                </li>
                            </volist>
                            <li <if condition="ACTION_NAME eq month">class="active"</if>>
                            <a href="{pigcms{:U('month')}" onclick="loading();"> 月报表 </a>
                            </li>
                        </ul>

                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                            <thead>
                            <tr>
                                <th>收款项目</th>
                                <th>本年实收累计</th>
                                <for start="1" end="$month_number1" >
                                    <th>{pigcms{$i}月</th>
                                </for>
                                <th style="width:50px;">备注</th>
                            </tr>
                            </thead>
                            <tbody>
                            <volist name="fee_list" id="row">
                                <tr>
                                    <td>{pigcms{$row['otherfee_type_name']}</td>
                                    <td>{pigcms{:number_format($row['list']['sum'],2)}</td>
                                    <for start="1" end="$month_number1" >
                                        <td>{pigcms{:number_format($row['list'][$i],2)}</td>
                                    </for>
                                    <td>{pigcms{$row.remark}</td>
                                </tr>
                            </volist>
                            <tr>
                                <td><span style="color: red">合计</span></td>
                                <td>{pigcms{:number_format($sum['sum'],2)}</td>
                                <for start="1" end="$month_number1" >
                                    <td>{pigcms{:number_format($sum['list'][$i]['sum'],2)}</td>
                                </for>
                                <td></td>
                            </tr>
                            <for start="1" end="6" >
                                <tr>
                                    <td>
                                        <span style="color: red">
                                        <switch name="i">
                                            <case value="1">其它:线上支付</case>
                                            <case value="2">现金</case>
                                            <case value="3">转账</case>
                                            <case value="4">POS单</case>
                                            <case value="5">现金缴款单</case>
                                        </switch>
                                        </span>
                                    </td>
                                    <td>{pigcms{:number_format($sum[$i],2)}</td>
                                    <for start="1" end="$month_number1" name="j">
                                        <td>{pigcms{:number_format($sum['list'][$j][$i],2)}</td>
                                    </for>
                                    <td></td>
                                </tr>
                            </for>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--        弹出层容器-->
<div class="modal fade" tabindex="-1" role="dialog" id="common_modal">
    <div class="modal-dialog modal-lg" role="document" style="width:1200px">
        <div class="modal-content">

        </div>
    </div>
</div>
<!--业务区结束-->




<div class="test" style="display: none" id="spinner">
    <div class="spinner" >
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
    </div>
    <div style="
    background-color: #666;
    text-align:  center;">
        <span class="form-control" style="
    font-size: 30px;
    border: 0;
    color:rgba(255,255,255,1);
    background-color: #111;
">
            页面正在努力跳转，请稍作等待
        </span>
    </div>
</div>
</block>
<block name="script">
    <script>
        $('#project_list').change(
            function () {
                var p1=$(this).children('option:selected').val();
                window.location.href="__SELF__"+"&project_id="+p1;
            }
        )
        $('#sample_2').dataTable( {
            "paging": false,
            "ordering": false
        } );
        function loading() {
            App.blockUI({
                target: "body",
                animate: !0
            });
            //$('#spinner').css('display','block');
            //$.blockUI();
            /*$('.page-spinner-bar').remove();
            $('body').append('<div class="page-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');*/
        }


        function openPostWindow(){
            var url='{pigcms{:U('Receipt/receipt_list')}'
            var tempForm = document.createElement("form");
            tempForm.id = "tempForm1";
            tempForm.method = "post";
            tempForm.action = url;
            tempForm.target="_blank"; //打开新页面
            var hideInput1 = document.createElement("input");
            hideInput1.type = "hidden";
            hideInput1.name="print_status"; //后台要接受这个参数来取值
            hideInput1.value = 3; //后台实际取到的值
            var hideInput2 = document.createElement("input");
            hideInput2.type = "hidden";
            hideInput2.name='starttime';
            hideInput2.value = $('#datetimepicker').val();
            var hideInput3 = document.createElement("input");
            hideInput3.type = "hidden";
            hideInput3.name="endtime";
            hideInput3.value =  $('#datetimepicker1').val();
            var hideInput4 = document.createElement("input");
            hideInput4.type = "hidden";
            hideInput4.name="type";
            hideInput4.value =  '2';
            tempForm.appendChild(hideInput1);
            tempForm.appendChild(hideInput2);
            tempForm.appendChild(hideInput3);
            tempForm.appendChild(hideInput4);
            if(document.all){
                tempForm.attachEvent("onsubmit",function(){});        //IE
            }else{
                var subObj = tempForm.addEventListener("submit",function(){},false);    //firefox
            }
            document.body.appendChild(tempForm);
            if(document.all){
                tempForm.fireEvent("onsubmit");
            }else{
                tempForm.dispatchEvent(new Event("submit"));
            }
            tempForm.submit();
            document.body.removeChild(tempForm);
        }
        function change_url(type,val) {
            //console.log(val);
                window.location.href='{pigcms{:U('Property/month')}&'+type+'='+val;
            }
            $('#datetimepicker').val('{pigcms{$year}')
    </script>
</block>
<!--自定义js代码区结束-->
<!--<include file="Public_news:footer_news"/>-->