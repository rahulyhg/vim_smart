<?php

namespace Admin\Model;

use Think\Model;

class AdminModel extends Model{
    
    //自动完成方法，系tp系统函数
    protected $_auto=array(
        array('add_time','time',1,'function'), //添加新记录时会触发此自动完成
    );
    
    //字段映射
    protected $_map =array(
        'username' => 'ad_name',
        'userpassword' => 'ad_pwd',
    );
    
    //接收数据并处理，然后将制作好的数据提交到数据库
    public function get_and_add($data,$files){
        
        //只有当正反面照片都上传成功时我们才会进行照片上传操作！
        if( $files['ad_sfzimg1']['error']===0 && $files['ad_sfzimg2']['error']===0 ){
            //进行文件上传操作
            $data=$this->admin_sfzimg_upload($data,$files);
        }
        
        //密码字段md5加密处理
        $data['ad_pwd']= md5($data['ad_pwd']);
        //处理关于停车场id字段1
        if(count($data['garage_id'])>1){
            //有多个停车场则转换为字符串
            $garage_string = join(DELIMITER,$data['garage_id']);
            $data['garage_id']=$garage_string;
        }else{
            $data['garage_id']=$data['garage_id'][0];
        }
        //将数据插入到数据库
        if( $this->add($data) ){
            return true;
        }else{
            return false;
        }
        
    }
    
    //接收数据并处理，然后将制作好的数据更新到数据库
    public function get_and_update($data,$files){
        
        //设置一个标志，当图片切换并且成功上传时，我们就删除原来的图片
        $file_upload_flag=false;
        
        
        //只有当正反面照片都上传成功时我们才会进行照片上传操作！
        if( $files['ad_sfzimg1']['error']===0 && $files['ad_sfzimg2']['error']===0 ){
            //改变标志
            $file_upload_flag=true;
            
            //进行文件上传操作
            $data=$this->admin_sfzimg_upload($data,$files);
        }
        
        //密码字段md5加密处理(更新时需要判断是否已经更改了密码，避免二次加密，导致无法登录)
        if( $data['ad_pwd'] != $data['old_pwd'] ){
            $data['ad_pwd']= md5($data['ad_pwd']);
        }
        //处理关于停车场id字段1
        if(count($data['garage_id'])>1){
            //有多个停车场则转换为字符串
            $garage_string = join(DELIMITER,$data['garage_id']);
            $data['garage_id']=$garage_string;
        }else{
            $data['garage_id']=$data['garage_id'][0];
        }
        //将数据更新到数据库
        if( $this->save($data) ){
            
            if($file_upload_flag){
                
                //删除原来的旧身份证正反面照片
                if(file_exists('./'.$data['old_sfzimg1'])){
                    unlink($data['old_sfzimg1']);
                }
                if(file_exists('./'.$data['old_sfzimg2'])){
                    unlink($data['old_sfzimg2']);
                }
            }
            
            return true;
            
        }else{
            return false;
        }
    }
    
    
    //文件上传
    public function admin_sfzimg_upload($data,$files){
        //图片上传
            $cfg=array(
                'rootPath'      =>  './Common/Uploads/AdminSFZ/', //保存根路径
            );
            $up=new \Think\Upload($cfg);
            
            //上传身份证正面
            $z=$up->uploadOne($files['ad_sfzimg1']);//$up -> uploadOne($_FILES['goods_logo']);
            $user_logo_save_path=$up->rootPath.$z['savepath'].$z['savename'];
            //这里的$data是引用传递，这里进行值的改变可以影响到函数外的$data
            $data['ad_sfzimg1']= ltrim($user_logo_save_path,'./');
            
            //上传身份证反面
            $z2=$up->uploadOne($files['ad_sfzimg2']);//$up -> uploadOne($_FILES['goods_logo']);
            $user_logo_save_path=$up->rootPath.$z2['savepath'].$z2['savename'];
            //这里的$data是引用传递，这里进行值的改变可以影响到函数外的$data
            $data['ad_sfzimg2']= ltrim($user_logo_save_path,'./');
            
            return $data;
    }
    
    
    //当执行管理员删除操作时，同时要删除其对应的照片
    public function destory_all_img($admin_info){
        
        //删除其对应的身份证正反面照片
                if(file_exists('./'.$admin_info['ad_sfzimg1'])){
                    unlink($admin_info['ad_sfzimg1']);
                }
                if(file_exists('./'.$admin_info['ad_sfzimg2'])){
                    unlink($admin_info['ad_sfzimg2']);
                }
    }
    
    
    
}

