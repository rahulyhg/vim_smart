/**
 * console.js
 * @author 祝君伟
 * @time 2017年9月22日16:27:33
 */

$(function(){


   console.log("%c欢迎来到汇得行智慧助手后台console","padding:4px;color:#3fa9f5;line-height:20px;font-size:10px;");

   console.log("%c------由©邻钱网络科技公司  独立开发","padding-left:100px;color:#3fa9f5;line-height:20px;font-size:10px;");

   console.log("%c可以执行以下命令来了解我们。\n%c输入about()   团队简介\n%c输入info()    联系方式\n%c输入like()    点赞惊喜",
        "padding:4px;color:#3fa9f5;line-height:20px;font-size:10px;",
        "padding:4px;color:#cc3300;line-height:20px;font-size:10px;",
        "padding:4px;color:#cc3300;line-height:20px;font-size:10px;",
        "padding:4px;color:#cc3300;line-height:20px;font-size:10px;"
   );


});


/**
 * console 互动函数
 */

function about() {

    console.log("%c邻钱科技技术团队致力于开发，简单·高效·轻量级的后台系统，虽然开发团队人员不多，但宁缺毋滥，各个精英。","padding:4px;color:#3fa9f5;line-height:20px;font-size:10px;");

    return true;
}

function info(){

    console.log("%cPHP工程师：Lqkj-wyx\n PHP工程师：Lqkj-zjw\n UI设计师：  Lqkj-wz\n",
        "padding:4px;color:#3fa9f5;line-height:20px;font-size:10px;"
    );

    return true;
}

function like() {

    var console_point = 100;

    console.info("点赞成功！获得积分100点,现有积分"+console_point+"点,关闭网页即请零");

    return true;
}