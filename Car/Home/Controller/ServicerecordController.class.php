<?php
namespace Home\Controller;
use Think\Controller;
class ServicerecordController extends Controller {
    
    //用户停车记录
    public function new_record($car_no){
        
        //实例化model
        $serv=new \Home\Model\ServicerecordModel();
        //实例化第三方捷顺接口类
        $jieshun=new \Org\JieShunApi\Jieshun();
        //①：接收到一个车牌号，调用第三方接口，提交数据申请返回结果
        //②：根据返回的数据生成一条停车记录表和订单表，
        //③：如果为注册用户提交的车牌号，那么还要进行车牌和主人数据关联操作
        if($car_no){
                
            //登录成功后查询是否存在相关车辆
            $serach_car_data=json_decode($jieshun->use_api_is_in($car_no),true);
            //vd($serach_car_data);exit;
            if($serach_car_data['resultCode'] ==1){
                return array('result_code'=>17);
            }

            if( $serach_car_data['attributes'] || $serach_car_data['dataItems'] ){
                //判断是否已经精确匹配到
                if( $serach_car_data['dataItems'][0]['attributes']['carNo']==$car_no ){
                    //精确匹配到，直接生成订单
                    //判断之前是否已经生成过停车记录表，如果没有则直接生成
                    $one_data=$serach_car_data['dataItems'][0]['attributes'];

                    //对时间字串进行处理一下再查询
                    if( is_string($one_data['enterTime']) ){
                        $one_data['enterTime'] = strtotime($one_data['enterTime']);
                    }

                    $serv_recored_info=$serv->where(array('start_time'=>$one_data['enterTime'],'car_no'=>$one_data['carNo']))->find();

                    //如果不存在记录则执行新记录添加，否则就不执行记录生成和订单生成
                    if(!$serv_recored_info){

                        //调用第三方接口方法(api,生成订单协议)，获取到的信息更全面，利于记录表的维护
                        //$api_order_data=$serv->api_make_order($token, $car_no);

                        //生成停车记录表
                        $record_add_result=$serv->make_serv_recored($serach_car_data['dataItems'][0]['attributes']);

                        //成功生成停车记录(返回成功插入的id)然后生成订单记录，否则提示生成停车记录报错
                        if($record_add_result){
                            //生成订单
                            $z=$serv->self_make_order($serach_car_data['dataItems'][0]['attributes'], $record_add_result);
                            if($z['resul_no']==1){
                                //订单生成ok，且同时对停车记录表servicerecord的缴费记录id字段进行维护成功，返回1
                                //跳转到订单详情页
                                //$this->redirect('Payrecord/order_detail',array('pay_id'=>$z['order_add_id'],'car_no'=>$car_no));
                                return array('result_code'=>14,'pay_record'=>$z['order_add_id'],'car_no'=>$car_no);
                            }elseif($z['resul_no']==2){
                                return array('result_code'=>11);
                                //订单生成ok，但是对停车记录表servicerecord的缴费记录id字段进行维护失败，返回2
                                //后期写入异常log文件
                               // $this->error('停车记录和订单已经成功生成，但是此后更新停车记录表的操作失败！请联系管理员处理',U('new_record'),5);
                            }elseif($z==3){
                                return array('result_code'=>11);
                                //订单生成失败，返回3
                                //$this->error('停车记录已经成功生成，但是订单打印失败，请重新输入车牌号打印订单',U('new_record'),5);
                            }
                        }else{
                            return array('result_code'=>11);
                            //$this->error('停车记录表生成失败',U('new_record'),1);
                        }

                    }else{

                        //如果已经存在，直奔对应订单页面
                        //第三方生成时间可能存在误差
                        //如果停车记录存在，但是订单却不存在，则重新再次尝试生成订单(未写)

                        //header("Location:http://car.vhi99.com?m=Home&c=Payrecord&a=order_detail&pay_id=".$serv_recored_info['pay_record']."&car_no=".$car_no);
                        return array('result_code'=>13,'pay_record'=>$serv_recored_info['pay_record'],'car_no'=>$car_no);
                    }
                }else{
                    //如果无精确匹配项，
                    //返回有用数据到用户搜索页面，重新修正数据进行再次检索
                    //返回的数据为模糊匹配结果，将模糊数据返回
                    return array('result_code'=>12,'datas'=>$serach_car_data);
                }
            }else{
                //$this->error('查询不到，请确认后重试',U('new_record'),1);
                return array('result_code'=>11);
            }
            
        }else{
            
            //未输入车牌
            $this->error('请输入车牌',U('Car/binding_car'),0);
        }
    }
    
    //停车记录查询
    public function query_service_record($car_no){
        
        //接收车牌号
        if(!$car_no){
            $car_no=I('post.car_no');
        }
        
        return D('servicerecord')->where(array('car_no'=>$car_no))->find(); //返回对应的停车记录
        
    }
}