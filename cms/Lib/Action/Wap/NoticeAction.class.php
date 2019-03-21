<?php

/**
 * 公告控制器
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/23
 * Time: 9:52
 * @update-time: 2017-06-23 09:57:49
 * @author: 王亚雄
 */
class NoticeAction extends Action
{
    /**
     * 公告详情
     */
    public function info(){
        $mer_id = I('get.mer_id',0,'intval');
        if(!$mer_id){
            $this->error("发生错误！无效的mer_id");
        }
        $model = new NoticeModel();
        $info = $model->get_newest_notice_info($mer_id);
        $this->assign('info',$info);
        $this->display();
    }
}