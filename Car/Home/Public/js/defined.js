/***************************************************************************************************
 *
 * 页面通用JS封装
 * @author 祝君伟 Morty zhu
 * @time 2017年11月27日11:06:42
 * @GitHua https://github.com/zjwForPHP
 * @WEB http://showmeyh.cn/wordpress/
 *
 ***************************************************************************************************/


/**
 *带加载的ajax
 * @param settings
 * @param success
 * @private
 */

function _ajax(settings,success){
    var url = "url" in settings ? settings.url : '',
        data = "data" in settings ? settings.data : '',
        type = "type" in settings ? settings.type : 'post',
        dataType = "dataType" in settings ? settings.dataType : 'json',
        timeout = "timeout" in settings ? settings.timeout : '45000',
        $loadingToast = $('#loadingToast')
    ;

    $.ajax({
        url:url,
        data:data,
        dataType:dataType,
        type:type,
        timeout:timeout,
        beforeSend:function(){
            $loadingToast.fadeIn(100);
        },
        success:function(msg){
            if(success){
                success(msg);
            }
        },
        complete:function(XMLHttpRequest,status){
            if(status == 'timeout'){

                //如果超时的话直接向我们发送警告消息
                //send_warning_message();
            }
            $loadingToast.fadeOut(100);
        }

    });

}


/**
 * 系统警报发送
 */
function send_warning_message(){
    var url = '/Car/index.php?s=/Home/Car/warning_msg_send';
    $.ajax({
        url:url,
        data:{'warning_name':'是否在场接口'},
        type:'post',
        success:function(res){
            swal({
                title: "很抱歉!",
                text: "系统故障，请稍后再试",
                type: "info",
                closeOnConfirm: false,
                confirmButtonText: "继续",
                confirmButtonColor: "#ec6c62",
            }, function() {
                //不作任何操作
                window.location.reload();
            });
        }
    });
}