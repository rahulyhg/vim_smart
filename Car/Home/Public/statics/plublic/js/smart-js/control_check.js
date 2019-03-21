var myScroll;
function loaded() {
    myScroll = new iScroll('order-list-wrapper', {
        checkDOMChanges: true,
        onScrollEnd: function() {
            y = this.y;
            Y = this.maxScrollY;
            if(y < Y + 200){
                load_more();
            }
        }
    });
}
document.addEventListener('touchmove', function(e) {
    e.preventDefault();
}, false);
document.addEventListener('DOMContentLoaded', loaded, false);
var t;
$(function(){
    $('#fliter-close').css('height',$("#fliter-layer").height()-150).click(function(event){
        $("#fliter-layer").hide();
    });
    $("#input-wrap").click(function(){
        var e = jQuery.Event("select");
        $('.pigcms-search').trigger(e);
    })
    $("[name='keyword']").on('input',function(){
        $this = $(this);
        if(t){
            clearTimeout(t);
        }
        t = setTimeout(function(){
            load_search($this.val());
        },500);
    })

})

// 加载数据
var loading = false,item_list = Array();
item_list.pindex=1;
load_item_list();
function load_item_list(){
    if(loading==true) return;
    var params = {
        'village_id': village_id,
        'pindex': item_list.pindex
    }

    loading = true;
    item_ajax(params);
}

//加载更多数据
var  Currentpindex=0,endpindex=0;
function load_more(){
    if(loading==true) return;
    Currentpindex=item_list.pindex;
    item_list.pindex++;

    var params={
        'village_id': village_id,
        'keyword': item_list.keyword,
        'pindex': item_list.pindex
    };

    loading=true;
    item_ajax(params);
}

// 加载搜索结果
function load_search(str){
    if(loading==true) return;

    var params = {
        'village_id': village_id,
        'keyword': str,
        'pindex':1
    }
    $('#order-list-ul').html("");
    item_ajax(params);
}
// AJAX请求
function item_ajax(par){
    loading = true;
    $.post(url, par, function(data){
        try{
            data = $.parseJSON(data);
            item_list = data;
            if(!data.has_more){
                if(endpindex>0){
                    item_list.pindex=endpindex;
                }else{
                    endpindex=item_list.pindex=Currentpindex+1;
                }
            }
            //alert(data.list);
            appendItemHtml(data.has_more, data.list);
			agreeCheck();
			agreeDel();
        }catch(e) {
            alert("请求数据错误");
        }
        loading=false;
        return;
    });
}
//将结果加入页面
function appendItemHtml(has_more, list){
    if(list.length==0){
        //alert(list.length);
        if($('#order-list-ul').is(":empty")){
            var content = "<li class='item-list-container' style='text-align:center'>暂无记录</li>";
            $(content).appendTo('#order-list-ul');
        }else{
            return false;
        }
    }
    for(var i=0;i<list.length;i++){
        var item = list[i];
        var detailurl="javascript:;";
        var status_info="";
        if(item.ac_status==2||item.ac_status==4){
            status_info="<span style='font-size:14px;color:#00CC00;'>通过</span>";
        }else if(item.ac_status==3){
            status_info="<span style='font-size:14px;color:#CC0000;'>不通过</span>";   
        }else{
            status_info="<span style='font-size:14px;color:#FFCC00;'>待审核</span>";
        }
        detailurl="/index.php?g=Wap&c=House&a=village_control_checkInfo";
        var content="<li class='item-list-container'>"+"<a class='' href='"+detailurl+"&village_id="+item.village_id+"&id_val="+item.pigcms_id+"'><div class='item-detail'>"+
            "<p class='item-price-sell'>"+
            "<span class='item-name'><span class='gtt'>真实姓名：</span>"+item.name+"</span>"+
            "<span class='item-price'><span class='gtt'>审核状态："+status_info+
            "</p>"+
            "<p class='item-sell'><span class='gtt'>提交时间：</span>"+item.created+"</p>"+
            "<p class='item-sell'><span class='gtt'>公司名称：</span>"+item.company_name+"</p>"+
            "<p class='item-sell'><span class='gtt'>审核人：</span>"+item.check_name+"</p>"+
            "<p class='item-img'><span><a class='' href='"+detailurl+"&village_id="+item.village_id+"&id_val="+item.pigcms_id+"'><img src='"+staticpath+"images/xxqq1.png' width='50' height='23' style='margin-right:10px;'/></a></span>"+
            "<span><a class='agree-check' href='javascript:' data_status='2' data_idVal='"+item.pigcms_id+"' data_uid='"+item.uid+"'><img src='"+staticpath+"images/xxqq3.png' width='50' height='23' style='margin-right:10px;'/></a></span>"+
            "<span><a class='agree-del' data_village='"+item.village_id+"' data_idVal='"+item.pigcms_id+"'><img src='"+staticpath+"images/xxqq2.png' width='50' height='23'/></a></span>"+
            "</p>"+
        "</div>"+
        "<div class='clearfix'></div></a>"+
        "</li>";

        $(content).appendTo('#order-list-ul');
    }

    $(".item-detail").css('width', $(window).width());
    if(has_more){
        $('#load_more').show();
    }else{
        $('#load_more').hide();
    }
}

function agreeDel(){
	$('.agree-del').click(function(){
		if(confirm("确定删除吗？")){
			var objval=$(this);
			var params={
				'village_id': $(this).attr('data_village'),
				'id_val': $(this).attr('data_idVal')
			};
			$.post('/wap.php?g=Wap&c=House&a=village_control_checkdel',params,function(data){
				if(!data.error){
					objval.parents('.item-list-container').remove();
				}else{
					alert('删除失败！');
				}
			},'JSON');
		}
	})
}

function agreeCheck(){
    $('.agree-check').click(function(){
        //alert($(this).attr('data_idVal'));
        var ac_status=$(this).attr('data_status');
        var id_val=$(this).attr('data_idVal');
        var uid_val=$(this).attr('data_uid');
        $.ajax({
            'url':"/index.php?g=Wap&c=House&a=village_control_checkInfo&village_id="+village_id,
            'data':{'ac_status':ac_status,'id_val':id_val,'uid_val':uid_val},
            'type':'POST',
            'dataType':'JSON',
            'success':function(msg){
                if(msg.err_code==0){
                    motify.log(msg.code_msg);
                    window.location.href=url+"&village_id="+village_id;
                }else{
                    motify.log(msg.code_msg);
                }
            },
            'error':function(){
                alert('loading error');
            }
        })
    })
}


