<?php

/**
 * 商家控制器
 */
class MerchantAction extends BaseAction{
	public function around(){
		$long_lat = D('User_long_lat')->getLocation($_SESSION['openid']);
		$this->assign('long_lat',$long_lat);
		$this->display();
	}
	public function ajaxAround(){
		$this->header_json();
		$list = D('Merchant')->get_merchants_by_long_lat($_POST['lat'], $_POST['lng'],2000);
		echo json_encode($list);
	}

    /**
     * 手机端商家页
     * @update-time: 2017-07-06 10:50:10
     * @author: 王亚雄
     */
	public function index(){
	    $mer_id = I('get.mer_id',0,'intval');
	    if(!$mer_id)  $this->error("无效的mer_id");

	    //商家信息
        $merchant_info = M('merchant')->where('mer_id=%d',$mer_id)->find();

        //商家所有店铺信息
        $store_data = M('merchant_store')
            ->where('mer_id=%d and status<>4 and status=1 and qrcode_id=0',$mer_id)
            ->order('sort asc , store_id desc')
            ->select();

        //店铺链接及名称
        $store_links = array_map(function($v) use ($mer_id) {
            if($v['store_id']==42){
                return "javascript:telphone('邹经理','‭13907172678');";
                //return U('Food/sureorder',array('mer_id'=>$mer_id,'store_id'=>$v['store_id'],'is_reserve'=>0));
            }else{
                return U('Food/menu',array('mer_id'=>$mer_id,'store_id'=>$v['store_id']));
            }
        },$store_data);
        $store_names = array_column($store_data,'name');

        $store_button = array(); 
        for ( $i = 0 ; $i<count($store_names);$i++){
            $store_button[$i]['link'] = $store_links[$i];
            $store_button[$i]['name'] = $store_names[$i];
        }

        //商家图片
        $merchant_info['pic'] =  'upload/merchant/' . str_replace(',','/',$merchant_info['img_info']);

        //最老的店铺信息
        $old_store = end($store_data);
        //商家实景
        $merchant_image_class = new merchant_image();
        $merchant_info['images'] = $merchant_image_class->get_allImage_by_path($merchant_info['pic_info']);
        //商家地址
        $merchant_info['address'] = $old_store['adress'];

        //营业时间
        $merchant_info['office_time'] = unserialize($old_store['office_time'])[0];

        //服务特色
        $merchant_info['feature'] = $old_store['feature'];

        //订单总数
        $store_ids = $store_names = array_column($store_data,'store_id');
        $map = array();
        $map['store_id'] = array('in',$store_ids);
        $merchant_info['sale_counts'] = M('merchant_store_meal')->where($map)->getField('sum(sale_count)');
        echo mysql_error();

        //商家得分
        $map['score_mean'] = array('gt',0);
        $merchant_info['mean'] = M('merchant_store_meal')->where($map)->getField('sum(score_mean)/count(1)');

        //所有评论
        $comments = M('reply')->alias('r')
            ->field(array(
                'u.uid',
                'u.avatar',
                'r.comment',
                'r.add_time',
                'group_concat(rp.pic SEPARATOR \'|\')'=>'comment_pics'
            ))
            ->join('left join __REPLY_PIC__ rp on find_in_set(rp.pigcms_id,r.pic)')
            ->join('left join __USER__ u on u.uid=r.uid')
            ->group('r.pigcms_id')
            ->order('add_time desc')
            ->where('r.mer_id=%d',$mer_id)
            ->select();
        //处理品论数据
        foreach($comments as $key=>&$val){
            //图片地址补全
            $val['comment_pics'] = explode('|',$val['comment_pics']);
            $tmp = array();
            foreach($val['comment_pics'] as $comment_pic){
                $tmp[] = 'upload/reply/meal/' . str_replace(',','/',$comment_pic);
            }
            $val['comment_pics'] = $tmp;
            //时间格式
            $val['add_time'] = date("Y-m-d H:i",$val['add_time']);
        }
        unset($val);

//dump($store_button);exit;

        //获取公告信息
        $notice_model = new NoticeModel();

        $this->assign('merchant_info',$merchant_info);

        $this->assign('store_button',$store_button);

        $this->assign('mer_notice',$notice_model->get_newest_notice($this->mer_id));

        $this->assign('comments',$comments);

        //是否开启商家实景
        $is_view=M('merchant')->where(array('mer_id'=>$this->mer_id))->getField('is_view');
        $this->assign('is_view',$is_view);
       //dump($merchant_info);exit;
//
//        dump($store_button);
//
//        dump($store_data);

        $this->display();









    }


}
?>