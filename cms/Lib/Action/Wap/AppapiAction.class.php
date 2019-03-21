<?php
class AppapiAction extends CommonAction
{
	public function index(){
		$wap_index_top_adver = D('Adver')->get_adver_by_key('wap_index_top',5);
		
		
		$tmp_wap_index_slider = D('Slider')->get_slider_by_key('wap_slider',0);
		$wap_index_slider = array();
		foreach($tmp_wap_index_slider as $key=>$value){
			$tmp_i = floor($key/8);
			$wap_index_slider[$tmp_i][] = $value;
		}
		
		$this->ok_json_return(array('toppic' => $wap_index_top_adver,'menu'=>$wap_index_slider));
	}
	
	
	
	
	
	public function test(){
		$this->error_json_return('错误');
	}
	
	
	
	
	
	private function error_json_return($message)
	{
		$json_arr['err_code'] = 1;
		$json_arr['message'] = $message;
		exit(json_encode($json_arr));
	}
	private function ok_json_return($json_arr)
	{
		$json_arr['err_code'] = 0;
		exit(json_encode($json_arr));
	}
	
}

?>
