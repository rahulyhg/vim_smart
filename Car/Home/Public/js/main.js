(function(){

    if(typeof app === undefined){
        console.error("app初始化失败！");
        return;
    }
    if(!app.module_name){
        console.error("模块名获取失败！")
        return;
    }
    if(!app.controller_name){
        console.error("控制器名获取失败！")
        return;
    }
    if(!app.action_name){
        console.error("方法名获取失败！")
        return;
    }


    /**
     * 模板替换函数 依赖jQuery 来自腾讯团队
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
                    .apply(env || data, value); // 此处的new Function是由下面fn.code产生的渲染函数；执行后即返回渲染结果HTML
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
                    $this=$($.tpl($this[0].innerHTML,context)).appendTo("body");
                    isFromTpl=true;
                }
                // 如果传入模板字符串
                else if($.isArray($this) && $this.length && $this.selector== ""){
                    // 根据模板获得对象并插入到body中
                    $this=$($.tpl($this[0].outerHTML,context)).appendTo("body");
                    isFromTpl=true;
                }
                // 如果通过$.dialog()的方式调用
                else if(!$.isArray($this)){
                    // 根据模板获得对象并插入到body中
                    $this=$($.tpl(template,context)).appendTo("body");
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

    /**
     * 封装模板替换函数 异步获取模板 有利于管理
     * @update-time: 2017-03-21 15:03:52
     * @author: 王亚雄
     * 依赖app.U app.load
     */

    app.tpl = function($tpl_url,data){

    }


    /**
     * @update-time: 2017-03-21 15:15:32
     * @author: 王亚雄
     * js版tp U方法
     * @param str
     * @constructor
     * @example:app.U('Test/test');
     */
    app.U = function(str){
        var self = this;
        var arr = str.split("/");
        var a = arr.pop();
        var c = arr.pop();
        var m = arr.pop();
        return function(m,c,a) {
            var app = self.app;
            var m   = m||self.module_name;
            var c   = c||self.controller_name;
            var a   = a||self.action_name;
            var url = "";
            switch(self.url_model){
                case  0:
                    url =  app+'?m='+m+'&c='+c+'&a='+a;
                    break;
                case  1:
                    url =  app+'/'+m+'/'+c+'/'+a;
                    break;
                case  2:
                    url =  app+'/'+m+'/'+c+'/'+a;
                    break;
                case  3:
                    url =  app+'/'+m+'/'+c+'/'+a;
                    break;
            }
            return url;

        }(m,c,a);
    }

    /**
     * jQueryajax方法封装，项目中ajax方法通常loading样式固定。
     * @update-time: 2017-03-21 15:16:28
     * @author: 王亚雄
     * @param options
     */
    app.ajax = function(options){
        //设置loading样式
        var loadobj = new app.load();
        var el = options.loading_html||'<div id="loadingToast" class="weui_loading_toast" > <div class="weui_mask_transparent"></div> <div class="weui_toast"> <div class="weui_loading"> <!-- :) --> <div class="weui_loading_leaf weui_loading_leaf_0"></div> <div class="weui_loading_leaf weui_loading_leaf_1"></div> <div class="weui_loading_leaf weui_loading_leaf_2"></div> <div class="weui_loading_leaf weui_loading_leaf_3"></div> <div class="weui_loading_leaf weui_loading_leaf_4"></div> <div class="weui_loading_leaf weui_loading_leaf_5"></div> <div class="weui_loading_leaf weui_loading_leaf_6"></div> <div class="weui_loading_leaf weui_loading_leaf_7"></div> <div class="weui_loading_leaf weui_loading_leaf_8"></div> <div class="weui_loading_leaf weui_loading_leaf_9"></div> <div class="weui_loading_leaf weui_loading_leaf_10"></div> <div class="weui_loading_leaf weui_loading_leaf_11"></div> </div> <p class="weui_toast_content">数据加载中</p> </div> </div>';
        var default_options = {
            url:'',
            type:'get',
            dataType:'json',
            async:true,
            cache:true,
            beforeSend:function (jqXHR,settings) {
                //loading start
                loadobj.build(el);
                console.log('loading start');
                if(options._beforeSend !== undefined && typeof options._beforeSend === 'function')  options._beforeSend(jqXHR,settings);

            },
            complete:function (jqXHR,settings){
                //loading end
                loadobj.close();
                console.log('loading end');
                if(options._complete !== undefined && typeof options._complete === 'function')  options._complete(jqXHR,settings);
            },
        }

        var opts = $.extend({},default_options,options);

        $.ajax(opts);

    }


    /**
     * 简单的loading弹出层，可自定义弹出模板
     * 提供build和close方法
     * @update-time: 2017-03-21 15:02:25
     * @author: 王亚雄
     */
    app.load = (function(){
        var block = "";//使用闭包模拟静态变量储存弹出层
        //创建弹出层
        function create(html){
            //如果之前已经有弹出层，先销毁该弹出层
            if(block!==""){
                destroy(block);
            }
            //创建代码
            block = $(html);
            block.appendTo("body");
        }

        //销毁弹出层
        function destroy(){
            //销毁代码
            if(block!==""){
                block.remove();
                block = "";
            }

        }



        return function(){
            /**
             * 弹出
             * @param html 弹出层html 不能是纯文本
             * @param time 自动关闭时间，不设置则不会自动关闭，设置后，如果该事件内不关闭弹出层则在time毫秒后自动关闭弹出层
             */
            this.build = function(html,time){
                create(html);
                if(typeof time === "number"){
                    setTimeout(function(){destroy();},time)
                }
            }

            /**
             * 关闭
             * @param callback 销毁后的回调函数
             */
            this.close = function(callback){
                destroy();
                if(typeof callback === 'function') callback();
            }

        };

    })();

})();



