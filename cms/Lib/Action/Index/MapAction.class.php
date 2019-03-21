<?php
/*
 * 地图处理
 *
 */
class MapAction extends BaseAction{
	public function suggestion(){
		header("Content-type: application/json");
		$city_id = isset($_GET['city_id']) ? intval($_GET['city_id']) : $this->config['now_city'];
		$now_city = D('Area')->field(true)->where(array('area_id' => $city_id))->find();
		$this->assign('city_name',$now_city['area_name']);
		$url = 'http://api.map.baidu.com/place/v2/suggestion?query='.urlencode($_GET['query']).'&region='.urlencode($now_city['area_name']).'&ak=4c1bb2055e24296bbaef36574877b4e2&output=json';
		import('ORG.Net.Http');
		$http = new Http();
		$result = $http->curlGet($url);
		if($result){
			$result = json_decode($result,true);
			if($result['status'] == 0 && $result['result']){
				$return = array();
				foreach($result['result'] as $value){
					$return[] = array(
						'name'=>$value['name'],
						'lat'=>$value['location']['lat'],
						'long'=>$value['location']['lng'],
						'address'=>$value['city'].$value['district'].$value['name']
					);
				}
				exit(json_encode(array('status'=>1,'result'=>$return)));
			}else{
				exit(json_encode(array('status'=>2,'result'=>'没有查找到内容')));
			}
		}else{
			exit(json_encode(array('status'=>0,'result'=>'获取失败')));
		}
	}
}