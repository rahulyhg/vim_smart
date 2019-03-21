<?php
namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
use Admin\Model\CouponModel;
use Think\Page;

class CouponController extends BaseController  {




    /**
     * 优惠券列表
     * @update-time: 2017-03-24 16:48:10
     * @author: 王亚雄
     */
    public function showlist(){
        C('LAYOUT_ON',true);
        $model = new CouponModel();
        //默认条件
        $map = array();
        $map['c.is_del'] = array('neq','1');
        $map['act.is_del'] = array('neq','1');


        //除了超级管理员 其他人只能查看自己的活动的优惠券
        if(session('admin_id')!=1){
            $map['a.ad_id'] = array('eq',session('admin_id'));//
        }
        // $map['u.is_del'] = array('neq','1');

        //区分停车场
        if($admin_garage_id = use_garage_filter()){
            $map['c.garage_id'] = array('eq',$admin_garage_id);
        }
        //搜索条件
        $get = search_filter($_GET);
        //所属活动
        isset( $get['act_id'] )    && $map['c.act_id']      = array('eq',$get['act_id']);
        //优惠券状态
        isset( $get['is_valid'] )  && $map['c.is_valid']    = array('eq',$get['is_valid']);
        //优惠类型
        isset( $get['attp_id'] )   && $map['type.attp_id']  = array('eq',$get['attp_id']);

        //活动时间
        if($get['start_time']||$get['end_time']){//搜索时间需要完全包含优惠券的有效时间
            $get['start_time'] = strtotime($get['start_time'] ?: "1970-01-01");
            $get['end_time'] = strtotime($get['end_time'] ?: "2100-01-01");
            $map['_complex'] = array(
                'c.start_time' => array('egt',$get['start_time']),
                'c.end_time' => array('elt',$get['end_time']+3600*24-1),//当天的23点59分59秒
                '_logic' => "AND",
            );
        }

//      //搜索条件结束

        $map['c.garage_id'] = $this->garage_id;
        //字段
        $field = array(
            'c.cp_id',
            'c.is_valid',
            'c.cp_no',
            'c.car_no',
            'c.start_time',
            'c.end_time',
            'c.cp_hilt',
            'c.cp_type',
            'act.act_id',
            'act.act_desc',
            'act.act_name',
            'type.attp_name',
            'a.ad_tname',
            'u.user_wxnik',
            //'u1.user_name'=>'u1user_name'

        );

        $count = $model->alias('c')
            ->where($map)
            ->join('left join __ACTIVITY__ act on c.act_id      = act.act_id')
            ->join('left join __ACTTYPE__ type on act.act_type  = type.attp_id')
            ->join('left join __ADMIN__ a      on act.cp_lssuer = a.ad_id')
            ->join('left join __USER__ u       on u.user_id     = c.user_id')
            //->join('left join __USER__ u1      on u1.user_id   = act.cp_lssuer')
            ->count();
        $page = new Page($count,I('get.list_rows',0,'int')?:LIST_ROWS);

        $list = $model->alias('c')
            ->field($field)
            ->where($map)
            ->join('left join __ACTIVITY__ act on c.act_id     = act.act_id')
            ->join('left join __ACTTYPE__ type on act.act_type = type.attp_id')
            ->join('left join __ADMIN__ a      on act.cp_lssuer     = a.ad_id')
            ->join('left join __USER__ u       on u.user_id    = c.user_id')
            //->join('left join __USER__ u1      on u1.user_id   = act.cp_lssuer')
            ->limit($page->firstRow,$page->listRows)
            ->order('c.cp_id desc')
            ->select();

        $this->assign('page_str',bootstrap_page_style($page->show()));
        $this->assign('cp_infos',$list);
        $this->assign('acttype_names',$model->acttype_name());
        $this->assign('act_names',$model->act_name());
        $this->assign('empty_data',"<tr><td colspan='10'>暂无数据</td></tr>>");
        $this->display();

    }


    public function change_coupon_status($is_valid,$cp_id){
        if(!in_array($is_valid,[0,1,2,3,4])){
            $this->error("非法状态");
        }else{
            $model = new CouponModel();
            $re = $model->where('cp_id=%d',$cp_id)->setField('is_valid',$is_valid);
            if($re!==false){
                $this->success("修改成功");
            }else{
                $this->error("修改失败");
            }

        }
    }



    //优惠券生成【系统自动执行】
    public function cp_add($act_id,$shop_id,$user_name,$car_no,$cp_token){
        //实例化cpModel
        $cp=new \Admin\Model\CouponModel();

        //查询是否存在对应的活动【并且未过期】
        $act_info=D('activity')->where(array('act_id'=>$act_id,'cp_lssuer'=>$shop_id))->find();

        //如果没有任何对应正在进行的活动，那么禁止生成优惠券
        if(!$act_info){
            //$this->error('当前没有可创建优惠请的活动或者活动与商户不匹配',U('showlist'),1);
            return 4;
        }
        //判断活动是否结束
        if($act_info['is_over']=='1' || time()>$act_info['act_end_time']){
            return 11;
        }

        //判断发放数量，如果已经超过了商家规定的上限，禁止生成优惠券
        $exists_cp_count=count($cp->where(array('act_id'=>$act_id))->getField('cp_id',true));
        $top_limit=D('activity')->where(array('act_id'=>$act_id))->getField('cp_count');
        if($exists_cp_count>=$top_limit){
            return 12;
        }

        //防止同一辆车或者同一个用户多次参与同一次优惠活动

            //用户名和车牌号需要进行简单的数据制作
            if($user_name){
                $use_id=D('user')->where(array('user_name'=>$user_name))->getField('user_id');
                //如果用户不存在，返回对应的错误
                if(!$use_id){
                    return 5;
                }
                $data['user_id']=$use_id;   //数据制作
                $is_have_cp=$cp->where(array('user_id'=>$data['user_id'],'act_id'=>$act_id))->getField('cp_id');
                if($is_have_cp){    //已经享受过本活动优惠
                    return 10;
                }

            }elseif($car_no){
                $data['car_no']=$car_no;    //数据制作
                $is_have_cp=$cp->where(array('car_no'=>$car_no,'act_id'=>$act_id))->getField('cp_id');
                if($is_have_cp){    //已经享受过本活动优惠
                    return 10;
                }
            }

            //校验优惠活动口令
            $cp_token_check=D('activity')->where('act_id='.$act_id)->getField('cp_token');
            if($cp_token_check){
                if($cp_token!==$cp_token_check){
                    return 6;
                }
            }

            //随机生成优惠券码(时间戳+商户id+1万到9.9万的随机数+1千到0.9万随机数)
            $data['cp_no']=time().$shop_id.rand(10000,99999).rand(1000.9999);

            //生效时间和失效时间
            $data['start_time']=$act_info['act_start_time'];
            $data['end_time']=$act_info['act_end_time'];

            //优惠类型(即结算方式)
            $data['cp_type']=$act_info['cp_type'];

            //校验发行者是否合法(商户在发起活动时被平台强制管制的，禁止其优惠券进行继续发放，减少平台损失)
            if($shop_id){
                $check_shop_id=D('admin')->where(array('ad_id'=>$shop_id,'is_check'=>'1'))->getField('ad_id');
                if(!$check_shop_id){
                    return 7;
                }
            }

            //优惠券单张面额
            $data['cp_hilt']=D('activity')->where('act_id='.$act_id)->getField('cp_hilt');

            //指定对应的优惠活动
            $data['act_id']=$act_id;
            
            //将数据插入到数据库
            $data['add_time']=time();

            $z=$cp->add($data);
            if($z){
                //$this->success('优惠券添加成功！',U('showlist'),1);
                return 8;
            }else{
                //$this->error('优惠券添加失败，请检查！',U('add'),1);
                return 9;
            }
    }
    
    
    //优惠券删除(逻辑删除)
    public function delete(){
        //接收要被删除的对应的记录id
        $cp_id=I('get.cp_id');
        //将对应的记录进行逻辑删除
        $z=D('coupon')->where(array('cp_id'=>$cp_id))->save(array('is_del'=>'1'));
        if($z){
            echo json_encode('1');//逻辑删除操作成功！
        }else{
            echo json_encode('2');//逻辑删除操作失败！
        }
    }
    
    
    //优惠券彻底删除(物理删除，不可恢复！)
    public function destroy(){
        //接收要被删除的对应的记录id
        $cp_id=I('get.cp_id');
        //将对应的记录进行逻辑删除
        $z=D('coupon')->where(array('cp_id'=>$cp_id))->delete();
        if($z){
            echo json_encode('1');//删除操作成功！
        }else{
            echo json_encode('2');//删除操作失败！
        }
    }
    
    
    //优惠券回收站列表展示
    public function recycle(){
        //查询所有被逻辑删除的车辆信息
        //为了减轻服务器的压力，建议使用条件进行查询，涉及默认全部查询时我们只显示最近500条（后期可设置到配置项）
        $cp_infos=D('coupon')->where(array('is_del'=>'1'))->limit(500)->select();
        
        //将查询到的数据返回模板
        $this->assign('cp_infos',$cp_infos);
        
        //调用模板
        $this->display();
    }
    
    
    //优惠券逻辑删除数据恢复
    public function recover(){
        //接收要被恢复的对应的记录id
        $cp_id=I('get.cp_id');
        //将对应的记录进行恢复
        $z=D('coupon')->where(array('cp_id'=>$cp_id))->save(array('is_del'=>'0'));
        if($z){
            echo json_encode('1');//恢复操作成功！
        }else{
            echo json_encode('2');//恢复操作失败！
        }
    }
    
    
    //优惠券详情页
    public function detail(){
        C('LAYOUT_ON',true);
        //接收对应的car_id
        $cp_id=I('get.cp_id');
        //echo $cp_id;exit;
        //查询对应的优惠券详情信息
        $cp_info=M('coupon')->where(array('cp_id'=>$cp_id))->find();
        
        //将数据返回模板
        $this->assign('cp_info',$cp_info);
        //dump($cp_info);exit;
        //调用模板
        $this->display();
    }


    //微信端优惠券分享二维码页面
    /**
     * @param $act_id
     * @author  王亚雄
     */
    public function  share_qrcode_wechat($act_id){
        //关闭布局
        C('LAYOUT_ON',false);
        //将act_id  rand_str timestamp 生成密文
        //act_id 活动ID
        //timestamp 二维码生成的时间戳 ， 可根据它来设置二维码的有效时间
        //rand_str  随机数，为了让同一秒内生成的data也不一样，大大降低重复的可能性
        $data = array(
            'act_id'=>$act_id,
            'rand_str'=>mt_rand(),
            'timestamp'=>time()
        );

        //加密数据
        $coupon_secret = think_encrypt($data,CRYPT_KEY_COUPON);
        //一次性缓存该字符串
        S1($coupon_secret);

        //获取优惠活动信息
        $model = new CouponModel();
        $act_info = $model->act_info($act_id);
        //dump($act_info);



        //扫码后跳转地址
        $url =  ROOT_URL . U('Home/Coupon/show_coupon',array('coupon_secret'=>$coupon_secret));
        //$url = urlencode($url);

        if(IS_AJAX){
            $this->success('获取成功','',array('url'=>$url));
        }else{

            //自定义分享
            $options = array(
                'onMenuShareAppMessage'=>array(
                    'title'=>'广发银行停车'.$act_info['cp_hilt'].'元优惠券', // 分享标题
                    'desc'=>'您有一张优惠券未领取！ （来自' . $act_info['ad_tname'] . ')',  // 分享描述
                    'link'=>$url,  // 分享链接
                    'imgUrl'=>$act_info['act_poster_img'],// 分享图标
                    'type'=>'',     // 分享类型,music、video或link，不填默认为link
                    'dataUrl'=>'',  //如果type是music或video，则要提供数据链接，默认为空
                ),
            );

            $this->wechat_jssdk($options);




            $this->assign('act_id',$act_id);
            $this->assign('url',$url);
            $this->display('share_qrcode_wechat');
        }




    }

    /**
     * PC端优惠券二维码弹出层
     * @update-time: 2017-03-22 09:43:42
     * @author: 王亚雄
     */
    public function modal_qr($act_id){
        C('LAYOUT_ON',false);
        $qr_url = ROOT_URL . U('Home/Coupon/show_static_coupon',array('act_id'=>$act_id));
        $model = new CouponModel();
        $act_info = $model->act_info($act_id);
        $type_name = $model->acttype_name($act_info['act_type']);
        $this->assign('act_info',$act_info);
        $this->assign('qr_url',$qr_url);
        $this->assign('type_name',$type_name);
        $this->display();
    }

    /**
     * 商家审核客户领取的静态优惠券
     * @param $cp_id
     * @update-time: 2017-03-23 15:21:06
     * @author: 王亚雄
     */
    public function audit($cp_id){

        $model = new CouponModel();

        //验证此优惠券的有效性
        if($model->check_coupon($cp_id)->get_coupon_code()){

            $this->error($model->check_coupon($cp_id)->get_coupon_msg());

        }

        $coupon_info =  $model->coupon_info($cp_id);
        $coupon_info['act_type_name'] = $model->acttype_name($coupon_info['act_type']);
        $this->assign('coupon_info',$coupon_info);
        //头部设置
        $this->assign('header',"优惠券审核");
        $this->assign('title',"优惠券审核");
        $this->display();
    }


    public function audit_act($cp_id,$chang_to_status){

        $model = new CouponModel();
        //验证此优惠券的有效性
        if($model->check_coupon($cp_id)->get_coupon_code()){

            $this->error($model->check_coupon($cp_id)->get_coupon_msg());

        }




        $re = $model->where('cp_id=%d',$cp_id)->setField('is_valid',$chang_to_status);

        if($re===false){
            $this->error("操作失败！");
        }
        if($re===0){
           switch($chang_to_status){
               case 1:
                   $this->success("该优惠券以通过审核","",array("reset_text"=>"已审核"));
                   break;
               case 4:
                   $this->success("该优惠券已经作废","",array('reset_text'=>"已作废"));
                   break;
               default:
                   $this->error("非法操作");
           }
        }
        if($re){
            switch($chang_to_status){
                case 1:
                    $this->success("该优惠券已生效","",array('reset_text'=>"已审核"));
                    break;
                case 4:
                    $this->success("已作废该优惠券","",array('reset_text'=>"已作废"));
                    break;
                default:
                    $this->error("非法操作");
            }
        }
    }



    /**
     * 商家审核优惠券列表
     * @update-time: 2017-03-22 15:05:47
     * @author: 王亚雄
     */
    public function audit_list(){
        //获取当前商家
        dump(session());
    }


    public function test(){
        $model = new CouponModel();
        $error_code = $model->check_coupon(140)->get_coupon_msg();
        dump($error_code);
        $this->display();
    }

    

}
























