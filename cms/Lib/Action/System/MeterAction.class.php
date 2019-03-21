<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/9/10
 * Time: 10:59
 */

/**
 * @author zhukeqin
 * Class MeterAction
 * 后台设备控制器
 */
class MeterAction extends BaseAction{
    public function __construct()
    {
        parent::__construct();
        $this->village_id = session('system.village_id')?:4;
        $this->admin_id=session('admin_id');
        $this->project_id=session('project_id');
        $this->village_info=M('house_village')->where(array('village_id'=>$this->village_id))->find();
    }

    /**
     * @author zhukeqin
     * 批量导入设备
     */
    public function meter_import_record(){
        //导航设置
        $breadcrumb_diy = array(
            array('在线抄表',U('Room/meter_record_news')),
            array('批量导入','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
       if(IS_POST){
           //设置文件路径
           $file = $_FILES['test'];
           $village_id = $this->village_id;
            if(empty($village_id)){
                $this->error('请选择项目');
            }
           if($file){
               //导入数据
               $list = import_excel_sheet($file);
               if(empty($list)){
                   $this->error('文件内容为空');
               }
               $head=$list['0'];
               unset($list['0']);
               foreach ($head as $k=>&$v){
                   //转换时间戳
                   if($k!=0||$k!=1){
                       if(is_numeric($v)){
                           $v=PHPExcel_Shared_Date::ExcelToPHP($v);
                       }else{
                           $v=strtotime($v);
                       }
                   }
               }
               $meter=new MeterModel();
               $re_setmeter=new Re_setmeterModel();
               $error=array();//错误输出缓存数组
               foreach ($list as $key=>$value){
                   if(empty($value['0'])) continue;
                    if(!empty($value['1'])){
                        $meter_hash=M('house_village_meters')->where(array('meter_code'=>$value['0'],'village_id'=>$this->village_id))->find()['meter_hash'];
                        $meter->set_be_cousume($meter_hash,$value['1'],$value['1'],strtotime('-1 month',$head['2']));
                    }
                    $meter_search=array('meter_code'=>$value['0'],'village_id'=>$this->village_id);
                    foreach ($value as $key1=>$value1){
                        unset($return);
                        //新增插入一条数据 并获取返回
                        if($key1==0||$key1==1){
                            continue;
                        }else{
                            $return=$re_setmeter->add_one($meter_search,$value1,$head[$key1],3);
                        }
                        //错误缓存
                        if(!empty($return)){
                            if(empty($error[$key])){
                                $error[$key]='第'.($key+1).'行';
                            }
                            $error[$key] .='第'.PHPExcel_Cell::stringFromColumnIndex($key1).'列'.$return.',';
                        }
                    }
               }
               if(empty($error)){
                   $this->success("导入成功",U('Room/meter_record_news'));
               }else{
                   echo "<center>";
                   echo "以下行数有对应问题，请处理之后再单独导入</br>";
                   foreach ($error as $value){
                       echo $value."</br>";
                   }
                   echo "</center>";
               }

           }else{
               $this->error("文件格式错误");
           }
       }else{
           $this->display();
       }

    }

    /**
     * @author zhukeqin
     * 输出详细信息
     */
    public function output_meter_record_list(){
        $year= empty($_GET['year'])?date('Y'):$_GET['year'];
        if(IS_POST){

        }else{

            $re_setmeter=new Re_setmeterModel();
            $list=$re_setmeter->get_meter_record_list($this->village_id,$year);
            $this->assign('list',$list);
            $this->assign('year',$year);
            $this->assign('title',$this->village_info['village_name']);
            $this->display();
        }
    }

    /**
     * @author libin
     * 输出详细信息
     */
    public function output_meter_record_list1(){
        $year= empty($_GET['year'])?date('Y'):$_GET['year'];
        $month= empty($_GET['month'])?date('m'):$_GET['month'];
        if(IS_POST){

        }else{

            $re_setmeter=new Re_setmeterModel();
            $list=$re_setmeter->get_meter_record_list1($this->village_id,$year);
            $this->assign('list',$list);
            $this->assign('year',$year);
            $this->assign('title',$this->village_info['village_name']);
            $this->display();
        }
    }

    public function demo(){
        $meter_list=M('house_village_meters')->where(array('is_del'=>0))->select();
        foreach ($meter_list as $value){
            $re_setmeter=M('re_setmeter')->where(array('meter_hash'=>$value['meter_hash']))->order('id desc')->limit('0,2')->select();
            if(!empty($re_setmeter)){
                if(count($re_setmeter)==1){
                    $data=array('be_cousume'=>$re_setmeter['0']['total_consume'].','.$re_setmeter['0']['total_consume'],'be_date'=>date('Y-m-d',$re_setmeter['0']['create_time']).','.date('Y-m-d',$re_setmeter['0']['create_time']));
                }else{
                    $data=array('be_cousume'=>$re_setmeter['1']['total_consume'].','.$re_setmeter['0']['total_consume'],'be_date'=>date('Y-m-d',$re_setmeter['1']['create_time']).','.date('Y-m-d',$re_setmeter['0']['create_time']));
                    //M('re_setmeter')->where(array('id'=>$re_setmeter['0']['id']))->data(array('last_total_consume'=>$re_setmeter['1']['total_consume']))->save();
                }
                M('house_village_meters')->where(array('id'=>$value['id']))->data($data)->save();
            }
        }
    }


}