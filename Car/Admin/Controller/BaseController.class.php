<?php
/**
 * Created by PhpStorm.
 * User: 王亚雄
 * Date: 2017/2/27
 * Time: 14:01
 */

namespace Admin\Controller;
use Admin\Common\RbacController;
use Common\Api\Wechat\TPWechat;
use Common\Api\Wechat\ErrCode;
use Think\Controller;

//use Admin\Common\RbacController;

class BaseController extends RbacController
{
    public function _initialize(){

        //parent::_initialize();
        C('LAYOUT_ON',false);
        //记录浏览历史
        $this->set_history_url(get_url());
//        dump(get_history_url(0));
//        dump(get_history_url(-1));
    }

    /**
     * 设置浏览历史，目前只设置了上一次和当前的url
     * @param string $url
     * @author 王亚雄
     */
    protected function set_history_url($url=""){
        $url = $url?:get_url();
        $url_arr = cookie('history_url');

        //访问以下控制器不进行记录
        $out_ctrls = array(
            U('Admin/Base/QR'),//二维码显示
                        //验证码显示
        );

        //判断当前控制器是否则排除控制器列表中
        $bool = in_array(U(''),$out_ctrls);

        //当前url和上次访问的url相同时不记录，当前控制器是在排除列表中不记录
        if(!in_array($url,$url_arr)&&!$bool){
            $tmp = array();
            $tmp[-1] = $url_arr[0] ?: "";
            $tmp[0] = $url;
            cookie('history_url',$tmp);
        }


    }

    /**
     * 生成二维码
     * @param $str  生成二维码所需要的字符串
     * @update-time: 2017-03-29 15:34:25
     * @author: 王亚雄
     */
    public function QR($url,$local_save=false,$level='L',$size=4){
        QR($url,$local_save,$level,$size);
    }



    /**
     * 微信JSSDK分享
     * @param array $options
     * @update-time: 2017-03-29 15:34:21
     * @author: 王亚雄
     */
    protected function wechat_jssdk($options=array()){
//@example:
//        $options = array(
//            'onMenuShareAppMessage'=>array(
//                'title'=>'测试', // 分享标题
//                'desc'=>'',  // 分享描述
//                'link'=>'',  // 分享链接
//                'imgUrl'=>'',// 分享图标
//                'type'=>'',     // 分享类型,music、video或link，不填默认为link
//                'dataUrl'=>'',  //如果type是music或video，则要提供数据链接，默认为空
//            ),
//        );

        //签名
        $we = new TPWechat();
        $auth = $we->checkAuth();
        $js_ticket = $we->getJsTicket();
        if (!$js_ticket) {
            echo "获取js_ticket失败！<br>";
            echo '错误码：'.$we->errCode;
            echo ' 错误原因：'.ErrCode::getErrText($we->errCode);
            exit;
        }
        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $js_sign = $we->getJsSign($url);

        $this->assign('wxjssdk_url',$url);
        $this->assign('wxjssdk_js_sign',$js_sign);


        //模板变量需要在fetch方法前传递
        $this->assign('options',$options);
        $types = array_keys($options);
        $this->assign('types',json_encode($types)); //所有事件类型记录，传递到模板，给js代码做判断用\





    }

    /**
     * 重写succes，error方法 同步异步都可用
     * @param string $message
     * @param string $jumpUrl
     * @param $data
     * @author 王亚雄
     */
    protected function success($message='',$jumpUrl='',$data){
        if(IS_AJAX){

            $this->ajaxReturn(array('error'=>0,'msg'=>$message,'data'=>$data));

        }else{

            parent::success($message,$jumpUrl,false);

        }
    }

    public function error($message='',$jumpUrl='',$data){
        if(IS_AJAX){

            $this->ajaxReturn(array('error'=>__LINE__,'msg'=>$message,'data'=>$data),"",JSON_UNESCAPED_UNICODE);

        }else{

            parent::error($message,$jumpUrl,false,"",JSON_UNESCAPED_UNICODE);

        }
    }




}