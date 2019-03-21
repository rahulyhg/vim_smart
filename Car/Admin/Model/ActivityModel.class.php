<?php

namespace Admin\Model;

use Think\Model;

class ActivityModel extends Model{
    
    //自动完成方法，系tp系统函数
    protected $_auto=array(
        //array('add_time','time',1,'function'), //添加新记录时会触发此自动完成
        //array('upd_time','time',2,'function'), //更新数据时才会触发此自动完成
    );


    //单图上传
    public function upload_one_img($file){
        $cfg=array(
            'rootPath'      =>  './Common/Uploads/Activity/', //保存根路径
        );

        //实例化图片上传类(系统类)
        $up=new \Think\Upload($cfg);

        //执行图片上传功能
        $z=$up->uploadOne($file);

        if($z){     //文件上传成功！
            $img_save_path=$up->rootPath.$z['savepath'].$z['savename'];

            //将图片保存路径返回
            return ltrim($img_save_path,'./');  //返回前对多余字串进行处理
        }else{
            return false;
        }

    }


    //只有创始人和超级管理员和优惠活动发起人才能操作的控制
    public function founder_superadmin_self($client_id){   //参数，当事人id(活动发起人id)
        //判断当前操作者是否为创始人或者超级管理员，或者本活动的发起者，满足返回真，否则返回假
        $supper_admin_list=C('SUPPER_ADMIN_LIST');
        if(!in_array(session(admin_name),$supper_admin_list) && session('admin_id')!=$client_id || session(admin_name)!=C('FOUNDER') && session('admin_id')!=$client_id){
            return false;
        }else{
            return true;
        }
    }
    
    
    
}

