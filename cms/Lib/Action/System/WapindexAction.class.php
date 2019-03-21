<?php
/**
 * 手机端Wap管理类
 * @author 祝君伟
 * Date: 2017/6/12
 * Time: 13:55
 * 规范方法命名规则 [wap]_[动作名]？_[自定义]
 */
class WapindexAction extends BaseAction
{

    /*
     * 关于Wap端所显示的内容展示
     * TODO：主要方法等同于index页面展示
     * 加入权限过滤
     * */
    public function  wap_control_list_news(){
        //字段查询
        $field = array(
            'a.*',
            'v.village_name',
            't.type_name',
            't.type_desc',

        );

        //过滤权限
        $_map = array(
            'a.fid'=>0
        );
        if($_SESSION['system']['account'] != SUPER_ADMIN){
            $_map['a.village_id'] = $_SESSION['system']['village_id'];
        }
        //读取当前Wap内容页的所有内容显示到页面
        $wap_content_array = M('adver')
            ->alias('a')
            ->field($field)
            ->join('LEFT JOIN pigcms_house_village v on a.village_id=v.village_id')
            ->join('LEFT JOIN pigcms_wap_group_type t on a.type_id=t.type_id')
            ->where($_map)
            ->select();

        $this->assign('wap_content_array',$wap_content_array);
        $this->display();

    }

    /*
     * 添加主要内容
     *
     * */
    public function wap_content_add_news(){
        if(IS_POST){
            //做添加操作
            $adver = D('Wap','Logic');
            $data = $adver->create();
            //vd($data);
            if($data['village_id'] == 1){
                $data['is_general'] =1;
            }
            $res = $adver->data($data)->add();
            if($res){
                $this->success('添加完成');
            }else{
                $this->error('添加失败');
            }

        }else{
            if($_SESSION['system']['account'] != SUPER_ADMIN){
                $village_array[0]=M('house_village')->where(array('village_id'=>$_SESSION['system']['village_id']))->find();
            }else{
                //读出所有项目
                $village_array = M('house_village')->where(array('status'=>1))->select();
            }
            

            //读出所有的类型
            $group_type_array = M('wap_group_type')->where(array('is_del'=>0))->select();

            $this->assign('village_array',$village_array);
            $this->assign('group_type_array',$group_type_array);
            $this->display();
        }



    }


    /*
     *
     * 主内容更新
     * */
    public function wap_content_edit_news(){
        if(IS_POST){
            //做更新操作
            $adver = D('Wap','Logic');
            $data = $adver->create();
            //vd($data);
            $res = $adver->save($data);
            if($res){
                $this->success('更新完成',U('Wapindex/wap_control_list_news'));
            }else{
                $this->error('更新失败');
            }

        }else{
            $ad_id = I('get.id');
            //查询当前id的内容
            $adver_array = M('adver')->where(array('id'=>$ad_id))->find();

            //读出所有项目
            $village_array = M('house_village')->where(array('status'=>1))->select();

            //读出所有的类型
            $group_type_array = M('wap_group_type')->where(array('is_del'=>0))->select();

            $this->assign('village_array',$village_array);
            $this->assign('group_type_array',$group_type_array);
            $this->assign('adver_array',$adver_array);
            $this->display();

        }
    }


    /*
     * 主内容删除
     * */
    public function wap_content_delete_news(){
        $id = I('get.id');
        $res = M('adver')->where(array('id'=>$id))->delete();
        if($res){
            $this->success('删除完成');
        }else{
            $this->error('删除失败');
        }

    }


    /*
     * 子内容列表
     * */
    public function wap_children_list_news(){
        //接受父级id
        $fid = I('get.fid');
        $WapLogic = D('Wap','Logic');
        $f_list_array = $WapLogic->where(array('fid'=>$fid))->select();
        $f_name = $WapLogic->where(array('id'=>$fid))->getField('name');
        $this->assign('f_name',$f_name);
        $this->assign('f_list_array',$f_list_array);
        $this->display();

    }

    /*
     * 添加子内容
     * */
    public function wap_children_add_news(){
        if(IS_POST){
            $WapLogic = D('Wap','Logic');
            $fid = I('get.fid');
            $data = $WapLogic->create();
            $f_info = $WapLogic->where(array('id'=>$fid))->find();
            $data['village_id']=$f_info['village_id'];
            $data['type_id'] = $f_info['type_id'];
            $data['fid'] = $f_info['id'];
            $data['is_general'] = $f_info['is_general'];
            //执行添加操作
            //vd($_POST);
            if($_FILES['upload']['error'] !=4) {
                import('ORG.Net.UploadFile');
                $upload = new UploadFile();// 实例化上传类
                $upload->maxSize = 3145728;// 设置附件上传大小
                $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->savePath = './upload/adver/';// 设置附件上传目录
                $upload->autoSub = true; //使用子目录上传模式
                $upload->subType = 'date';  //使用date作为子目录的名称
                $upload->dateFormat = 'Y/m/d';//指定date的格式
                if (!$upload->upload()) {
                    // 上传错误提示错误信息
                    $this->error($upload->getErrorMsg());
                } else {
                    // 上传成功 获取上传文件信息
                    $info = $upload->getUploadFileInfo();
                    $data['pic'] = $info[0]['savename'];

                }
            }
            $res = $WapLogic->data($data)->add();
            if($res){
                $this->success('添加完成');
            }else{
                $this->error('添加失败');
            }

        }else{
            //未上线的url链接
            $not_online_url = M('config')->getFieldByName('not_online_url','value');
            $this->assign('not_online_url',$not_online_url);
            $this->display();
        }
    }


    /*
     * 更新子内容
     * */
    public function wap_children_edit_news(){
        if(IS_POST){
            //执行update的操作
            $WapLogic = D('Wap','Logic');
            $data = $WapLogic->create();
            if($_FILES['upload']['error'] !=4){
                import('ORG.Net.UploadFile');
                $upload = new UploadFile();// 实例化上传类
                $upload->maxSize  = 3145728 ;// 设置附件上传大小
                $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->savePath =  './upload/adver/';// 设置附件上传目录
                $upload->autoSub = true; //使用子目录上传模式
                $upload->subType = 'date';  //使用date作为子目录的名称
                $upload->dateFormat = 'Y/m/d';//指定date的格式
                if(!$upload->upload()) {
                    // 上传错误提示错误信息
                    $this->error($upload->getErrorMsg());
                }else{
                    // 上传成功 获取上传文件信息
                    $info =  $upload->getUploadFileInfo();
                    $data['pic'] = $info[0]['savename'];

                }
            }
            $fid = M('adver')->getFieldById($data['id'],'fid');
            $res = $WapLogic->save($data);
            if($res){
                $this->success('更新完成',U('Wapindex/wap_children_list_news',array('fid'=>$fid)));
            }else{
                $this->error('更新失败');
            }
        }else{
            //显示当前的信息
            $id = I('get.id');
            $adver_array = M('adver')->where(array('id'=>$id))->find();
            //未上线的url链接
            $not_online_url = M('config')->getFieldByName('not_online_url','value');
            $this->assign('not_online_url',$not_online_url);
            $this->assign('adver_array',$adver_array);
            $this->display();

        }
    }

    /*
     * 子内容删除
     * */
    public function wap_children_delete_news(){
        //获取要删除项的id
        $id = I('get.id');
        $res = M('adver')->where(array('id'=>$id))->delete();
        if($res){
            $this->success('删除完成');
        }else{
            $this->error('删除失败');
        }

    }

    /*
     * 内容类型管理列表
     * */
    public function wap_type_list_news(){
        //读出没有被逻辑删除的项
        $type_array = M('wap_group_type')->where(array('is_del'=>0))->select();
        $this->assign('type_array',$type_array);
        $this->display();
    }


    /*
     * 内容类型添加
     * */
    public function wap_type_add_news(){
        if(IS_POST){
            //执行添加操作
            $group_type_model = M('wap_group_type');
            $data = $group_type_model->create();
            $res = $group_type_model->data($data)->add();
            if($res){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }


    /*
     * 内容类型编辑
     * */
    public function wap_type_edit_news(){
        if(IS_POST){
            //执行修改操作
            $group_type_model = M('wap_group_type');
            $data = $group_type_model->create();
            $res = $group_type_model->save($data);
            if($res){
                $this->success('更该成功',U('Wapindex/wap_type_list_news'));
            }else{
                $this->error('更该失败');
            }

        }else{
           //获取当前id下的Type的信息
            $type_id = I('get.type_id');
            $type_array = M('wap_group_type')->where(array('type_id'=>$type_id))->find();
            $this->assign('type_array',$type_array);
            $this->display();
        }
    }

    /*
     * 内容配置页面
     * */
    public function wap_config_news(){
        if(IS_POST){
            //多组上传的标志位
            $edit_flag = false;
            $data = array();
            //处理当前值，适应config表中的结构
            foreach ($_POST as $key=>$value){
                $data['name']=$key;
                $data['value'] = trim(stripslashes(htmlspecialchars_decode($value)));
                //存储信息
                $res = M('config')->save($data);

                if($res!==false){
                    $edit_flag = true;
                }else{
                    $edit_flag = false;
                }
            }
            //多次更新是否成功，有一次上传不成功就会失败
            if($edit_flag){
                $this->success('更新成功！');
            }else{
                $this->error('更新失败');
            }
        }else{
            $wap_content_config = M('config')->where(array('gid'=>33))->select();
            $this->assign('wap_content_config',$wap_content_config);
            $this->display();
        }

    }

    /*
     * 改变其上线的状态
     * */
    public function change_online(){
        $id = I('post.id');
        $adver_info = M('adver')->find($id);
        if($adver_info['is_online']==1){
            //当前上线中，现在希望下线
            $not_online_url = M('config')->getFieldByName('not_online_url','value');
            $res = M('adver')->where(array('id'=>$id))->data(array('is_online'=>0,'url'=>$not_online_url))->save();
            if($res){
                echo 1;
            }else{
                echo 0;
            }

        }else{
            //当前系统下线中，希望上线
            $res =  M('adver')->where(array('id'=>$id))->data(array('is_online'=>1,'url'=>''))->save();
            if($res){
                echo 1;
            }else{
                echo 0;
            }
        }
    }


    /*
     * 元素位置排序
     * */
    public function edit_site(){
        $id = I('post.id');
        $number = I('post.number');
        $adver_info = M('adver')->find($id);
        if($adver_info['number']!=$number){
            //有效更改
            $is_have_number = M('adver')->where(array('village_id'=>$adver_info['village_id'],'type_id'=>$adver_info['type_id'],'number'=>$number))->find();
            if($is_have_number != null){
                //要更改的位置上有元素，那么两个元素对调
                M('adver')->where(array('id'=>$id))->data(array('number'=>$number))->save();
                M('adver')->where(array('id'=>$is_have_number['id']))->data(array('number'=>$adver_info['number']))->save();
            }else{
                //要更改的位置上没有元素，直接更改
                M('adver')->where(array('id'=>$id))->data(array('number'=>$number))->save();
            }
        }else{
            echo 2;
        }
    }

}