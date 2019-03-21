<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
    <title>桶装水</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >  
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
	<link href="./static/Wap/water/css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	*{   
		-webkit-touch-callout:none;  /*系统默认菜单被禁用*/   
		-webkit-user-select:none; /*webkit浏览器*/   
		-khtml-user-select:none; /*早期浏览器*/   
		-moz-user-select:none;/*火狐*/   
		-ms-user-select:none; /*IE10*/   
		user-select:none;   
	}  
	body {font-size:14px; width:100%; height:100%; font-size:100%; font-family:"微软雅黑"; margin:0px; padding:0px; background-color:#f7f7f7;}
</style>
</head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<div class="zw_new" id="app">
    <if condition="$mer_notice">
        <div style="width:90%; margin:0px auto; height:40px;">
            <div style="width:11%; text-align:center; height:20px; line-height:20px; float:left; margin-top:10px; margin-right:10px;background-color: #fb4746;border-radius:2px; color:#FFFFFF; font-size:13px;">公告</div>

            <a><DIV id="scrollobj" style="white-space:nowrap;overflow:hidden;width:85%; height:40px; line-height:40px; color:#FFFFFF; font-size:13px;"><span class="news">{pigcms{$mer_notice}</span></DIV></a>

            <div style="clear:both"></div>
        </div>
    </if>
    <div class="zj_new">
        <div class="zb_new"><img src="{pigcms{$user_info['avatar']}" style="width:100%; height:auto;"></div>
        <div class="yb_new">
            <div class="mc_new">
                <div class="ki_new">
                    <div class="mc2_new">
                        <div class="yellow_new">写字楼</div>
                        <div class="dbt_new">{pigcms{$user_info['village_name']}</div>
                        <div style="clear:both"></div>
                    </div>
                    <div class="mc2_new">
                        <div class="yellow2_new">公司</div>
                        <div class="dbt2_new">{pigcms{$user_info['company_name']}</div>
                        <div style="clear:both"></div>
                    </div>
                </div>
                <div class="ki2_new">
                    <a href="{pigcms{:U('Merchant/index',array('mer_id'=>$store_info['mer_id']))}"><div class="wb_arrow_new"></div></a>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
        <div style="clear:both"></div>
    </div>
</div>
<div class="dkk">
	<div class="zj_new">
		<div class="kfc"><img src="./static/Wap/water/picture/ht.jpg" style="width:100%; height:auto;"/></div>
		<div class="kfc2">　需桶装水服务，请先提前预购，届时由物业工作上门为您配送！</div>
		<div class="kfc4">
			<div class="kfc3" onclick="window.location.href='{pigcms{:U('water_list')}'">
				<div class="ttk">预约桶装水</div>
				<div class="ttk2">查看更多</div>
			</div>
			<div class="kfc5">
                <div class="ttk"><a href="tel: {pigcms{$store_info['phone']}" style="color:#fff;text-decoration: none"><span style="font-weight:bold;">联系客服</span></a></div>
				<div class="ttk3">查看更多</div>
			</div>
			<div style="clear:both"></div>
		</div>
	</div>
</div>
<div class="zxm">汇得行（中国）集团有限公司</div>
<script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script src="./static/Wap/water/js/vue.min.js"></script>
<script>
    $.fn.news = function(){
        var self = this;
        var text = this.text();
        this.text('');
        var news_container = $('<ul class="news_container"></ul>');
        news_container.appendTo(this);
        var sub_el = '<li>'+text+'</li>';
        var cl_el = '<div style="clear: both"></div>';
        var li0 = $(sub_el);
        var li1 = $(sub_el);
        li0.appendTo(news_container);
        li1.appendTo(news_container);
        news_container.append(cl_el);

        this
            .css('width','300px')
            .css('position','relative')
            .css('overflow','hidden');
        news_container
            .css('width','200%')
            .css('margin-left',0);
        news_container.find('li')
            .css('float','left')
            .css('width','50%');

        start();

        function start(){
            $('.news_container').animate({'margin-left':'-100%'},3000,function(){
                $(this).css('margin-left',0);
                start();
            })
        }

        function stop(){

        }

    }

    $('.news').news();


    const select = {
        inserted(el) {
            el.select()
        },
    }
    var model = new Vue({
        el: '#app',
        data: {
            'order_list':[],
            'address':"",
            'is_editing_address':false
        },
        mounted:function(){
            var order_list = '{pigcms{:json_encode($list)}';
            if(order_list){
                this.order_list = JSON.parse(order_list);
            }

            //地址初始化
            var address = "{pigcms{$user_info['address']}";
            if(address){
                this.address = address;
            }else{
                this.is_editing_address = true;
            }
            console.log(this.order_list);
        },
        methods:{
            edit_address:function(){
                this.is_editing_address = true;
//                var $input = $('input[name="address"]');
//                $input.focus();
            },

            stop_edit:function(){
                this.is_editing_address = false;
            },
            //购买数+1
            add_redeem:function(node,$event){
                if(node.redeem_num<node.left_coupon){
                    node.redeem_num ++;
                }else{
                }

            },
            //购买数-1
            sub_redeem:function(node,$event){

                if(node.redeem_num>0){
                    node.redeem_num --;
                }else{

                }

            },
            //检查购买数量
            check_redeem_num:function(node,$event){

                var v = parseInt($event.target.value)||0;
                if(v<0){
                    node.redeem_num = 0;
                    $event.target.value=0;
                }else{
                    if(v>node.left_coupon){
                        node.redeem_num = node.left_coupon;
                        $event.target.value= node.left_coupon;
                    }else{
                        node.redeem_num = v;
                    }

                }
            },

            //提交
            submit:function(){
                if(this.address){
                    var address = this.address;
                }else{

                    alert("请输入收货地址");
                    return false;
                }
                var submit_order = [];
                for(var index in this.order_list){
                    if(this.order_list[index].redeem_num>0){
                        submit_order[index] = {};
                        submit_order[index]['order_id'] = this.order_list[index].order_id;
                        submit_order[index]['redeem_num'] = this.order_list[index]['redeem_num'];
                        //数据重置
                        this.order_list[index].left_coupon -=  this.order_list[index]['redeem_num'];
                        this.order_list[index].redeem_num=0;
                    }
                }
                var data = this.post('{pigcms{:U("redeem_water")}',{order:JSON.stringify(submit_order),address:address});
                if(data.err===0){
                    console.log(data);
                    alert("已通知配送");

                }else{
                    alert("发送错误，请重试");
                }
                window.location.reload();

            },

            //获取数据
            post:function(url,data){
                var d;
                $.ajax({
                    url:url,
                    data:data||{},
                    type:'post',
                    dataType:'json',
                    async: false,
                    success:function(re){
                        d = re;
                    }
                })
                return d;
            }
        },
        directives: {select}

    });
</script>
</body>