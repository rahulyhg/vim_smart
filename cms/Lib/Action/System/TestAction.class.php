<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/7
 * Time: 16:30
 */
class TestAction extends BaseAction
{
    //消息群发测相关
    public function test1(){
        $model = new GroupMsgModel();
        $list = $model->get_msg_list();
        echo M()->getLastSql();
        dump($list);
    }

    public function test2(){
        $model = new GroupMsgModel();
        $info = $model->get_msg_info(100);
        echo M()->getLastSql();
        dump($info);
        echo mysql_error();

    }

    //发送消息测试
    public function test3(){
        $model = new GroupMsgModel();
        $model->send_now_msg(100);
    }

    public function test4(){
        $model = new GroupMsgModel();
        $data = array(
            'id'=>104,
            'village_id'=>4,
            'send_type'=>'fixed',
            'msg_type'=>'image_text',
            'digest'=>'123',
            'send_time'=>'999999999999'
        );
        $re = $model->save_group_msg($data);
        if(!$re){
            echo $model->getError();
        }
    }


}