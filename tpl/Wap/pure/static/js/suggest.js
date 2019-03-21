var myScroll;
var pullDown = document.querySelector("#PullDown"),
    isPulled = false; // 拉动标记
function loaded() {
    myScroll = new iScroll('order-list-wrapper', {
        checkDOMChanges: true,
        onScrollMove:function () {
            var height = this.y,
                bottomHeight = this.maxScrollY - height;

            // 控制下拉显示
            if (height >= 60) {
                pullDown.style.display = "block";
                isPulled = true;
                setTimeout(function () {
                    window.location.reload();
                },500);

            }
            else if (height < 60 && height >= 0) {
                pullDown.style.display = "none";
                return;
            }
        },
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
        //alert($('#order-list-ul').is(":empty"));
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
        detailurl="/index.php?g=Wap&c=House&a=village_suggestDetail";
        if(item.is_read==1){
            var read_status='<font style="color:#0697dc">已处理</font>';
            var red_show="";
        }else{
            var read_status='<font style="color:red">未处理</font>';
            var red_show="<span class='item-img1' pid='"+item.pid+"' onclick='read(this)'><img src='"+staticpath+"images/xxqq1-19.png' width='50'height='23'/></span>";
        }
        var content="<li class='item-list-container'>"+"<a class='' href='"+detailurl+"&village_id="+item.village_id+"&pigcms_id="+item.pid+"'><div class='item-detail'>"+
            "<p class='item-price-sell'>"+
            "<span class='item-name'><span class='gtt'>业主编号：</span>"+item.usernum+"</span>"+
            "<span class='item-price'><span class='gtt'>投诉人：</span>"+item.name+"</span>"+
            "</p>"+
            "<p class='item-sell'><span class='gtt'>投诉时间：</span>"+item.created+"</p>"+
            "<p class='item-sell'><span class='gtt'>当前状态：</span>"+read_status+"</p>"+
            "<p class='item-img'>"+red_show+"<span><a class=''href='"+detailurl+"&village_id="+item.village_id+"&pigcms_id="+item.pid+"'><img src='"+staticpath+"images/xqt_blue.png' width='50'height='23'/></a></span>"+"</p>"
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

function read(obj){
    if(confirm('您确定要标记为已处理？')){
        var cid = $(obj).attr('pid');
        $.post(do_url,{'village_id':village_id,'cid':cid},function(result){
            if(result.error==0){
                //alert(2);
                window.location.reload();
            }else{
                alert(result.msg);
            }
        })
        /*$.ajax({
         'url':do_url,
         'data':{'bind_id':bindid,'cid':cid},
         'type':'POST',
         'dataType':'JSON',
         'success':function(result){
         if(result.error==0){
         alert(2);
         //window.location.reload();
         }else{
         alert(result.msg);
         }
         },
         'error':function(){
         alert('loading error!');
         }
         })*/
    }
}

