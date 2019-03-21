<?php

namespace Admin\Model;

use Think\Model;

class GarageModel extends Model{
    
    //接收数据并将数据处理
    public function get_and_made($data,$files){
        
        //判断至少有一张照片上传成功，否则不执行相册功能
        $photo_flag=false;
        foreach ($files['park_photo']['error'] as $a => $b){
            if($b===0){
               $photo_flag=true; 
            }
        }
        if($photo_flag===true){//条件成立则说明至少有一张照片上传成功！
            //车场相册
            $cfg=array(
                'rootPath'      =>  './Common/Uploads/Garage_Photo/', //保存根路径
            );
            $up=new \Think\Upload($cfg);
            $z=$up->upload(array('park_photo' => $files['park_photo']));
            
            foreach ($z as $k => $v){
                
                $user_logo_save_path=$up->rootPath.$v['savepath'].$v['savename'];
                $data['park_photo'].=','.ltrim($user_logo_save_path,'./');
                $data['park_photo']= ltrim($data['park_photo'],',');
            }
        }
        
        //将数据返回
        return $data;
        
    
    }
    
    
    //当执行彻底删除时，删除其对应的照片
    public function destory_all_photos($garage_info){
        //先将相册字段字串转为数组
        $garage_photo_arr= explode(',', $garage_info['park_photo']);
        //循环删除多有照片
        foreach( $garage_photo_arr as $k => $v){
            if( file_exists('./'.$v) ){
                unlink($v);
            }
        }
    }
    
    
}

