(function() {

    /**
     * 对象转url参数
     * @param parames
     * @returns {string}
     * @update-time: 2017-09-29 15:58:15
     * @author: 王亚雄
     */
    app.http_build_query = function(parames){
        var str='';
        for(var i in parames){
            str+="&"+i+'='+parames[i];
        }
        return str;
    }



    /**
     * js版tp U方法
     * @update-time: 2017-03-21 15:15:32
     * @author: 王亚雄
     * @param str
     * @constructor
     * @example:app.U('Test/test',{test:1});
     */
    app.U = function(str,opt){
        var self = this;
            arr = str?str.split("/"):[],
            a = arr.pop(),
            c = arr.pop(),
            g = arr.pop();
        return function(m,c,a) {
            var app = self.app;
                g   = g||self.group_name,
                c   = c||self.controller_name,
                a   = a||self.action_name,
                url = "";
            switch(self.url_model){
                case  0:
                    url =  app+'?g='+g+'&c='+c+'&a='+a + self.http_build_query(opt);
                    break;
            }
            return url;

        }(g,c,a);
    }

    /**
     * 跳转
     * @param str
     * @update-time: 2017-09-29 15:59:36
     * @author: 王亚雄
     * @example:app.redirect('Test/test',{test:1});
     */
    app.redirect = function (str,opt){
        window.location.href = app.U(str,opt);
    }


})();