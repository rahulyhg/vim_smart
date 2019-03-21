/**
 * Created by Administrator on 2017/6/7.
 * System/UserExpress控制器相关js
 * @update-time: 2017-06-07 11:50:02
 * @author: 王亚雄
 */

if(ap!==undefined){alert('命名空间\'ap\'被占用')};
if($===undefined){alert('请加载jQuery！')}
var ap = {};
//弹出层错误提示
ap.err = function (msgtitle,msgtext){
    swal({
        title: msgtitle,
        text:msgtext||"",
        timer: 1000,
        showConfirmButton: false,
        type:'error'
    });
}
//弹出层成功提示
ap.suc = function (msgtitle,msgtext){
    swal({
        title: msgtitle,
        text: msgtext||"",
        timer: 1000,
        showConfirmButton: false,
        type:'success'
    });
}

ap.warm = function(msgtitle,msgtext,yesfunc){
    swal({
        title: msgtitle,
        text:  msgtext||"",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "确认",
        cancelButtonText: "取消",
        closeOnConfirm: false
    },yesfunc);
}

/**
 * ajax封装
 * @param options
 */
ap.ajax = function (options){
    var default_options = {
        url:'',
        type:'get',
        dataType:'json',
        async:true,
        cache:true,
        beforeSend:function (jqXHR,settings) {
            //TODO::loading start
            console.log('loading start');
            if(options._beforeSend !== undefined && typeof options._beforeSend === 'function')  options._beforeSend(jqXHR,settings);

        },
        complete:function (jqXHR,settings){
            //TODO::loading end
            console.log('loading end');
            if(options._complete !== undefined && typeof options._complete === 'function')  options._complete(jqXHR,settings);
        },
        error:function(xhr,stu,err){
            ap.err("发生错误！",err)
        }
    }

    var opts = $.extend({},default_options,options);

    $.ajax(opts);
}

/**
 * 浮层编辑寄件收件信息
 * @param selecter
 */
ap.user_popover = function(selecter){
    $(selecter).each(function(i){
        var $el = $(this);
        var data = {};
        var content = "";
        $el.popover({
               html:true,
               title:'详细',
               placement:'top',
               content:function(){
                   data = {
                       name : $el.attr("info_name"),
                       phone : $el.attr("info_phone"),
                       detail : $el.attr("info_detail"),
                   };
                   content = $.tpl(ap.address_user_info_tpl,data);
                   return content;
               },
        });

        $el.on('shown.bs.popover', function (e) {
            var $pop = $(this).next('.popover');
            $pop.find('button[type="submit"]').click(function(){
                //执行更新
                var name = $pop.find('input[name="name"]').val();
                var phone = $pop.find('input[name="phone"]').val();
                var detail = $pop.find('input[name="detail"]').val();
                //数据库更新
                var adid = $el.attr("info_adid");
                ap.ajax({
                    url:'?g=System&c=UserExpress&a=update',
                    data:{
                        name:name,
                        phone:phone,
                        detail:detail,
                        adid:adid
                    },
                    success:function(re){
                        if(re.err===0){
                            ap.suc(re.msg);
                            //console.log(re);
                            // //标签属性更新
                            // $el.attr("info_name",name);
                            // $el.attr("info_phone",phone);
                            // $el.attr("info_detail",detail);
                            // $el.text(name);
                            //将当前页其他相同的adid的全改了
                            var $same_el = $('[info_adid="'+adid+'"]').attr("info_name",name)
                            $same_el.attr("info_name",name);
                            $same_el.attr("info_phone",phone);
                            $same_el.attr("info_detail",detail);
                            $same_el.text(name);
                            //关闭
                            $el.click();
                        }else{
                            ap.err(re.msg);
                        }
                    }
                });


            });
            $pop.find('button[type="button"]').click(function(){
                //关闭
                $el.click();
            });
        })

    });
}




ap.address_user_info_tpl  ='<div class="form-group">'
                           +'    <div>'
                           +'        <div>'
                           +'            <div class="form-group">'
                           +'                <label>姓名:</label>'
                           +'                <input type="text" name="name" value="<%=name%>" class="form-control input-small">'
                           +'            </div>'
                           +'            <div class="form-group">'
                           +'                <label>手机:</label>'
                           +'                <input type="text" name="phone" value="<%=phone%>"  class="form-control input-small">'
                           +'            </div>'
                           +'            <div class="form-group">'
                           +'                <label>地址:</label>'
                           +'                <input type="text" name="detail" value="<%=detail%>" class="form-control input-small">'
                           +'            </div>'
                           +'        </div>'
                           +'        <div>'
                           +'            <button type="submit" class="btn blue"><i class="fa fa-check"></i>'
                           +'            </button>'
                           +'            <button type="button" class="btn default"><i class="fa fa-times"></i>'
                           +'            </button>'
                           +'        </div>'
                           +'    </div>'
                           +'</div>'
                           +'</form>'
                           ;


/*************************/



/**
 * 模板替换函数
 * @param str
 * @param data
 * @param env
 *
 */
!function ($) {
    var _private = {};
    _private.cache = {};

    $.tpl = function (str, data, env) {
        // 判断str参数，如str为script标签的id，则取该标签的innerHTML，再递归调用自身
        // 如str为HTML文本，则分析文本并构造渲染函数
        var fn = !/[^\w\-\.:]/.test(str)
            ? _private.cache[str] = _private.cache[str] || this.get(document.getElementById(str).innerHTML)
            : function (data, env) {
                var i, variable = [], value = []; // variable数组存放变量名，对应data结构的成员变量；value数组存放各变量的值
                for (i in data) {
                    variable.push(i);
                    value.push(data[i]);
                }
                return (new Function(variable, fn.code))
                    .aply(env || data, value); // 此处的new Function是由下面fn.code产生的渲染函数；执行后即返回渲染结果HTML
            };

        fn.code = fn.code || "var $parts=[]; $parts.push('"
            + str
                .replace(/\\/g, '\\\\') // 处理模板中的\转义
                .replace(/[\r\t\n]/g, " ") // 去掉换行符和tab符，将模板合并为一行
                .split("<%").join("\t") // 将模板左标签<%替换为tab，起到分割作用
                .replace(/(^|%>)[^\t]*/g, function(str) { return str.replace(/'/g, "\\'"); }) // 将模板中文本部分的单引号替换为\'
                .replace(/\t=(.*?)%>/g, "',$1,'") // 将模板中<%= %>的直接数据引用（无逻辑代码）与两侧的文本用'和,隔开，同时去掉了左标签产生的tab符
                .split("\t").join("');") // 将tab符（上面替换左标签产生）替换为'); 由于上一步已经把<%=产生的tab符去掉，因此这里实际替换的只有逻辑代码的左标签
                .split("%>").join("$parts.push('") // 把剩下的右标签%>（逻辑代码的）替换为"$parts.push('"
            + "'); return $parts.join('');"; // 最后得到的就是一段JS代码，保留模板中的逻辑，并依次把模板中的常量和变量压入$parts数组

        return data ? fn(data, env) : fn; // 如果传入了数据，则直接返回渲染结果HTML文本，否则返回一个渲染函数
    };
    $.adaptObject =  function (element, defaults, option,template,plugin,pluginName) {
        var $this= element;

        if (typeof option != 'string'){

            // 获得配置信息
            var context=$.extend({}, defaults,  typeof option == 'object' && option);

            var isFromTpl=false;
            // 如果传入script标签的选择器
            if($.isArray($this) && $this.length && $($this)[0].nodeName.toLowerCase()=="script"){
                // 根据模板获得对象并插入到body中
                $this=$($.tpl($this[0].innerHTML,context)).apendTo("body");
                isFromTpl=true;
            }
            // 如果传入模板字符串
            else if($.isArray($this) && $this.length && $this.selector== ""){
                // 根据模板获得对象并插入到body中
                $this=$($.tpl($this[0].outerHTML,context)).apendTo("body");
                isFromTpl=true;
            }
            // 如果通过$.dialog()的方式调用
            else if(!$.isArray($this)){
                // 根据模板获得对象并插入到body中
                $this=$($.tpl(template,context)).apendTo("body");
                isFromTpl=true;
            }

        }

        return $this.each(function () {

            var el = $(this);
            // 读取对象缓存

            var data  = el.data('fz.'+pluginName);



            if (!data) el.data('fz.'+pluginName,
                (data = new plugin(this,$.extend({}, defaults,  typeof option == 'object' && option),isFromTpl)

                ));

            if (typeof option == 'string') data[option]();
        })
    }
}(window.jQuery);
