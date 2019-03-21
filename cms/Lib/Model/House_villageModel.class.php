<?php
class House_villageModel extends Model{
	/*得到用户关注的小区*/
	public function get_bind_list($uid,$phone = '',$flag = false){
		if(!empty($phone)){
			D('House_village_user_bind')->bind($uid,$phone);
		}
		//$village_list = D('')->field('`hv`.*,`hvub`.*')->table(array(C('DB_PREFIX').'house_village'=>'hv',C('DB_PREFIX').'house_village_user_bind'=>'hvub'))->where("`hv`.`status`='1' AND`hv`.`village_id`=`hvub`.`village_id` AND `hv`.`city_id`='".C('config.now_city')."' AND `hvub`.`uid`='$uid'")->order('`hvub`.`pigcms_id` DESC')->group('`hv`.`village_id`')->select();
		$condition_table=array(
			C('DB_PREFIX').'house_village'=>'hv',
			C('DB_PREFIX').'house_village_user_bind'=>'hvub'
		);
		$condition_where="hv.status='1' AND hv.village_id=hvub.village_id AND hvub.role!='2' AND hv.city_id='".C('config.now_city')."' AND hvub.uid='$uid' AND (hvub.ac_status='2' OR hvub.ac_status='4')";
		$village_list=D('')->field('hv.*,hvub.*')->table($condition_table)->where($condition_where)->order('hvub.pigcms_id DESC')->group('hv.village_id')->select();
		if($flag == true && $village_list){
			$village_list[0]['first_test'] = true;
		}
		return $village_list;
	}
	
	/*得到小区列表，支持经纬度*/
	public function wap_get_list($long_lat,$keyword){
		if ($long_lat) {
			$order = "ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$long_lat['lat']} * PI() / 180- `lat` * PI()/180)/2),2)+COS({$long_lat['lat']} *PI()/180)*COS(`lat`*PI()/180)*POW(SIN(({$long_lat['long']} *PI()/180- `long`*PI()/180)/2),2)))*1000) ASC";
		} else {
			$order = "`village_id` ASC";
		}
		import('@.ORG.wap_group_page');
		$condition_village = array(
			'status'=>'1',
		);
		//'city_id'=>C('config.now_city')
		if(!empty($keyword)){
			$condition_village['village_name'] = array('like','%'.$keyword.'%');
		}
		$count = $this->where($condition_village)->count('village_id');
		$p = new Page($count,10,'page');
		$village_list = $this->field(true)->where($condition_village)->order($order)->limit($p->firstRow.','.$p->listRows)->select();
		if($long_lat && $village_list){
			foreach($village_list as &$village_value){
				$village_value['range'] = getRange(getDistance($village_value['lat'],$village_value['long'],$long_lat['lat'],$long_lat['long']));
			}
		}
		$return = array();
		if($village_list){
			$return['village_list'] = $village_list;
			$return['totalPage'] = ceil($count/10);
			$return['village_count'] = count($village_list);
		}
		return $return;
	}
	
	public function get_one($village_id){
		return $this->field(true)->where(array('village_id'=>$village_id))->find();
	}

    public function get_village_tree($where,$sort='village_id ASC'){
        $list=$this->where($where)->order($sort)->select();
        $return=array();
        foreach ($list as $value){
            $return[$value['village_id']]=$value['village_name'];
        }
        return $return;
    }
}
?>