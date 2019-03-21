<?php
namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
class ConfigController extends RbacController {
    //定义配置组号
    protected $config_group_gf=30;
    protected $config_group_yl=31;
    /*
     *陈琦
     * 2017.3.xx
     * */
    public function index(){
        if(IS_POST){
            $a=new \Admin\Model\ConfigModel();
            //dump($_FILES);exit;
            $z=$a->get_and_update($_POST, $_FILES);//处理前台所传数据，包括上传的文件
            if($z){
                $this->success('管理员信息更新成功！',U('index'),1);
            }else{
                $this->error('管理员信息更新失败，请检查！',U('index',1));
            }
        }else{
            $config = M('config')->field('name,value')->select();
            //dump($config);
            $payconfig=array();
            foreach ($config as $k=>$v){
                $payconfig[$v['name']] = $v['value'];//变成关联数组
            }
            //dump($payconfig);exit;
            $this->assign('payconfig',$payconfig);
            $this->display();
        }
    }


    /**
     * 停车系统配置项
     * @author 祝君伟
     * @time 2017年12月8日16:01:23
     */
    public function config_car(){
        if(IS_POST){
            //dump($_POST);exit;
            //接受前台传过来的post
            //设立标志位
            $update_flag = false;

            $garage_data = array(
                'garage_id'=>I('post.garage_id'),
                'garage_free_time'=>I('post.garage_free_time'),
                'garage_unit_price'=>I('post.garage_unit_price'),
                'garage_max_price'=>I('post.garage_max_price'),
                'garage_max_time'=>I('post.garage_max_time'),
                'monthly_fee_fixed'=>I('post.monthly_fee_fixed'),
                'monthly_fee_non_fixed'=>I('post.monthly_fee_non_fixed')
            );

            //dump($garage_data);exit;

            $res = M('garage')->save($garage_data);


            if($res!==false){
                unset($_POST['garage_id']);
                unset($_POST['garage_free_time']);
                unset($_POST['garage_unit_price']);
                unset($_POST['garage_max_price']);
                unset($_POST['garage_max_time']);
            }else{
                $this->error('处理失败');
            }

            foreach ($_POST as $key=>$value){
                $data1['name'] = $key;

                $data1['value'] = trim(stripslashes(htmlspecialchars_decode($value)));

                $res = M('config')->save($data1);
                //TP save 缺陷，如果没有更新的内容，会显示失败。
                if($res!==false){
                    $update_flag = true;
                }else{
                    $update_flag = false;
                }
            }
            if($update_flag){
                $this->success('更新成功！');
            }else{
                $this->error('更新失败');
            }
        }else{
            //与停车场配置相关的所有信息

            $garage_id = I('get.garage_id');

            $garage_id = !empty($garage_id) ? $garage_id : 2;

            $model = new \Admin\Model\ConfigModel();

            $configArray = $model->get_car_garage_config($garage_id);

            //所有角色列表
            $role_array = M('role')->select();

            //所有停车场
            $garageArray = M('garage')->select();

            $this->assign('garageInfo',$garageArray);

            $this->assign('role_array',$role_array);

            $this->assign('configArray',$configArray);

            $this->display();
        }

    }

    /*
     * 配置项的添加
     * */
    public function config_add(){
        if(IS_POST){
            $name = I('post.name','','htmlspecialchars');
            $value = I('post.value','','htmlspecialchars');
            $desc = I('post.desc','','htmlspecialchars');
            $garage_id = I('post.garage_id','','htmlspecialchars');
            if(!$name || !$value || !$desc||!$garage_id) $this->error("请完善信息");

            //数据
            $data = array(
                'name'=>'car_'.$name,
                'value'=>$value,
                'desc'=>$desc,
                'info'=>$desc,
                'tab_name'=>'停车场配置',
                'gid'=>$this->config_group,
                'status'=>1
            );
            if($garage_id == 2){
                $data['gid'] = $this->config_group_gf;
            }else{
                $data['gid'] = $this->config_group_yl;
            }
            //dump($data);exit;
            $num = M('config')->add($data);

            if($num){
                $this->success("添加成功",U('config_car'));
            }else{
                $this->error("添加失败");
            }

        }else{
            $garage_array = M('garage')->where(array('is_del'=>'0'))->select();
            //dump($garage_array);exit;
            $this->assign('garage_array',$garage_array);
            $this->display();
        }
    }


    public function auto_add_config(){

        $garage_id = I('get.garage_id');

        $garage_id = !empty($garage_id) ? $garage_id : 2;

        $garage_no = M('garage')->find($garage_id)['garage_no'];

        $master = new \Org\JieShunApi\JieshunMaster($garage_no);

        $res = $master->check_garage_info();

        $garagePayInfo = $res['dataItems'][0]['attributes']['tempStandard'];

        $garageArray = explode("\n",$garagePayInfo);

        $maxPay = mb_substr($garageArray[1],mb_stripos($garageArray[1],'费')+1,-1);

        $freeTime = mb_substr($garageArray[2],mb_stripos($garageArray[2],'钟')+1,-2);

        $unitPrice = mb_substr($garageArray[3],mb_stripos($garageArray[3],'费')+1,-1);

        $autoArray = array(
            'garage_max_price'=>(int)$maxPay,
            'garage_free_time'=>$freeTime*60,
            'garage_unit_price'=>(int)$unitPrice,
//            'monthly_fee_fixed'=>(floatval($unitPrice)),
//            'monthly_fee_non_fixed'=>(floatval($unitPrice))
        );

        $res = M('garage')->where(array('garage_id'=>$garage_id))->data($autoArray)->save();

            if($res !== false){
                $this->assign('status',1);
            }else{
                $this->assign('status',0);
            }

        $this->display();


    }
}
























