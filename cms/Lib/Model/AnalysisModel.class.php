<?php
    class AnalysisModel extends Model{
        public function get_consumer($areaid,$_type,$tid,$year,$month){
                $check_r = $this->check_area_id($areaid, $_type);
                $area_id = $check_r['area_id'];
                $type = $check_r['type'];
                $area_pname = $check_r['area_pname'];
                $table=array('meal','store','waimai','group','appoint');
                $sql2condition2= '';
                $sql2condition3= '';
                switch ($tid) {
                    case 0:
                        $condition = 'price';
                        $sql2condition1= '';
                        break;
                    case 1:
                        $condition = 'price';
                        $sql2condition1= '';
                        break;
                    case 2:
                        $condition = 'price';
                         $sql2condition1= '';
                        break;
                    case 3:
                        $condition = 'total_money';
                        $sql2condition1= 'b.order_name,';
                        break;
                    case 4:
                        $condition = 'pay_money';
                        $sql2condition1 = ' a.appoint_name, ';
                        $sql2condition2 = " LEFT JOIN ".C('DB_PREFIX')."appoint a ON b.appoint_id=a.appoint_id ";
                        $sql2condition3 = " AND a.appoint_name!='' ";
                        break;
                    default:
                        $condition = 'price';
                        break;
                }
                if($month==''){
                    $time = 'AND year(FROM_UNIXTIME(b.pay_time))= '.$year;
                }else{
                    $time = 'AND year(FROM_UNIXTIME(b.pay_time))= '.$year.' AND  month(FROM_UNIXTIME(b.pay_time))='.$month;
                }

                if ($area_id=='') {
                    $sql="SELECT d.area_id,d.area_name ,e.total_money ,d.area_type FROM ".C('DB_PREFIX')."area d "
                            . "RIGHT JOIN "
                            . "( SELECT c.area_pid,ROUND(SUM(b.".$condition."),2) total_money FROM ".C('DB_PREFIX').$table[$tid]."_order b "
                            . "LEFT JOIN ".C('DB_PREFIX')."merchant a ON a.mer_id = b.mer_id "
                            . "LEFT JOIN ".C('DB_PREFIX')."area c "
                            . "ON a.city_id = c.area_id WHERE b.paid=1  ".$time." AND a.city_id!='' GROUP BY c.area_pid )e "
                            . "ON d.area_id=e.area_pid";
                    $sql2 = "SELECT ".$sql2condition1."c.name ,ROUND(SUM(b.".$condition."),2) money  FROM ".C('DB_PREFIX').$table[$tid]."_order b "
                            . $sql2condition2
                            . " LEFT JOIN ".C('DB_PREFIX')."merchant c ON b.mer_id=c.mer_id "
                            . " LEFT JOIN pigcms_area d ON c.city_id = d.area_id "
                            . "WHERE b.paid=1 ".$time.$sql2condition3." AND d.area_name!='' GROUP BY c.mer_id ORDER BY money DESC LIMIT 0,10";
                }elseif($type==1){
                    $sql="SELECT e.city_id area_id,e.area_name,e.total_money ,e.area_type FROM ".C('DB_PREFIX')."area d "
                            . "RIGHT JOIN "
                            . "( SELECT a.city_id,c.area_pid,c.area_name,c.area_type,ROUND(SUM(b.".$condition."),2) total_money FROM ".C('DB_PREFIX').$table[$tid]."_order b "
                            . "LEFT JOIN ".C('DB_PREFIX')."merchant a ON a.mer_id = b.mer_id "
                            . "LEFT JOIN ".C('DB_PREFIX')."area c "
                            . "ON a.city_id = c.area_id WHERE b.paid=1 ".$time." AND c.area_pid=".$area_id." AND a.city_id!='' GROUP BY a.city_id )e "
                            . "ON d.area_id=e.area_pid";
                    $sql2 = "SELECT ".$sql2condition1." c.name,ROUND(SUM(b.".$condition."),2) money FROM ".C('DB_PREFIX').$table[$tid]."_order b "
                            .$sql2condition2
                            . "LEFT JOIN ".C('DB_PREFIX')."merchant c ON b.mer_id=c.mer_id "
                            ."LEFT JOIN ".C('DB_PREFIX')."area d ON c.city_id = d.area_id "
                            . "WHERE b.paid=1 ".$time.$sql2condition3." AND d.area_pid=".$area_id.
                            " GROUP BY c.mer_id ORDER BY money DESC LIMIT 0,10";

                }elseif($type==2){
                    $sql="SELECT e.city_id,e.area_name,e.total_money ,e.area_type FROM ".C('DB_PREFIX')."area d  " 
                            ."RIGHT JOIN ( "
                                ."SELECT a.city_id,c.area_pid,c.area_name,c.area_type,ROUND(SUM(b.".$condition."),2) total_money FROM ".C('DB_PREFIX').$table[$tid]."_order b  "
                                ."LEFT JOIN "
                                .C('DB_PREFIX')."merchant a ON a.mer_id = b.mer_id   "
                                ."LEFT JOIN ".C('DB_PREFIX')."area c ON a.area_id = c.area_id  "
                                ."WHERE b.paid=1 ".$time." AND c.area_pid=".$area_id." AND a.city_id!='' "
                                ."GROUP BY a.area_id )e "
                            ."ON d.area_id=e.area_pid  ";
                    $sql2 = "SELECT ".$sql2condition1."c.name ,ROUND(SUM(b.".$condition."),2) money FROM ".C('DB_PREFIX').$table[$tid]."_order b "
                            . $sql2condition2
                            . "LEFT JOIN ".C('DB_PREFIX')."merchant c ON b.mer_id=c.mer_id "
                            . "WHERE b.paid=1 ".$time.$sql2condition3. " AND c.city_id=".$area_id
                            ." GROUP BY c.mer_id ORDER BY money DESC LIMIT 0,10";
                }
                $model=new Model();
                $total_money=$model->query($sql);
                $rank=$model->query($sql2);
                $result['msg'] = $total_money;
                $result['area_pname'] = empty($area_pname)?"全国":$area_pname;
                $result['error'] = '';
                $result['rank']=$rank;
                return $result;
            }

            public function  check_area_id($area_id,$type){
                $many_city = D('Config')->field('value') ->where('name="many_city"')->select();
                if (!$many_city[0]['value']) { //单城市
                    if ($type<2) {
                        $city_id = D('Config')->field('value')->where('name="now_city"')->select();
                        $area_id = $city_id[0]['value'];
                        $type = 2;
                    }
                }
                if ($type>0) {
                    if ($type==4) {
                        $r = D('House_village')->field('village_name')->where('village_id='.$area_id)->select();
                        $area_panme=$r[0]['village_name'];
                    }else{
                        $r = D('Area')->field('area_name')->where('area_id='.$area_id)->select();
                        $area_panme=$r[0]['area_name'];
                    }
                }
                $direc_city = array('1','21','42','62'); //直辖市
                if (in_array($area_id,$direc_city)&&$type<2) {
                    $area_id++;
                    $type++;
                }
                $result['area_id']=$area_id;
                $result['type']=$type;
                $result['area_pname']=$area_panme;
                return $result;
            }

            //按地区统计人数
            public function get_count_byAreaId($areaid,$_type,$year,$month) {
                $check_r = $this->check_area_id($areaid,$_type);
                $area_id = $check_r['area_id'];
                $type = $check_r['type'];
                $area_pname = $check_r['area_pname'];
                switch ($type) {
                    case 1:
                            $condition[1] = ' WHERE a.area_pid = ' .$area_id;
                            $condition[2] = C('DB_PREFIX').'user_adress'.' WHERE province = '.$area_id; 
                            $condition[3] = 'city';
                        break;
                    case 2:
                            $condition[1] = ' WHERE a.area_pid = ' .$area_id;
                            $condition[2] = C('DB_PREFIX').'user_adress'.' WHERE city = '.$area_id; 
                            $condition[3] = 'area';
                        break;
                    case 3:
                        break;
                    default:
                            $condition[1] = ' WHERE a.area_type = 1';
                            $condition[2] = C('DB_PREFIX').'user_adress'; 
                            $condition[3] = 'province';
                        break;
                }
                $sql = 'SELECT a.area_id , a.area_name  ,c.counts ,a.area_type FROM '.C('DB_PREFIX').'area AS a '
                        . 'RIGHT JOIN '
                        . '(SELECT province,city,area , COUNT(uid) counts FROM  ' .$condition[2]
                        . ' GROUP BY '.$condition[3].') c '
                        . 'ON a.area_id=c.'.$condition[3]. $condition[1].' ORDER BY c.counts DESC';
                $model=new Model();
                $count=$model->query($sql);
                $result['msg']=$count;
                $result['area_pname']=empty($area_pname)?"全国用户数量统计":$area_pname."用户数量统计";
                $result['error']='';
                return $result;
            }
            
            //获取商家粉丝数量
            public function get_fan_count($area_id,$type) {
                $check_r = $this->check_area_id($area_id,$type);
                $area_pname = empty($check_r['area_pname'])?"全国商家粉丝排行前十":$check_r['area_pname']."地区商家粉丝排行前十";
                if ($check_r['area_id']!='') {
                    $condition = 'WHERE a.city_id='.$check_r['area_id'];
                }
                $sql='select a.mer_id,a.name,count(b.openid) counts from '.C('DB_PREFIX').'merchant_user_relation b  '
                        . 'LEFT JOIN  '.C('DB_PREFIX').'merchant a '
                        . 'ON a.mer_id=b.mer_id '.$condition.' GROUP by b.mer_id ORDER BY counts DESC LIMIT 0,10';
                $model=new Model();
                $fan_count=$model->query($sql);
                $result['msg']=$fan_count;
                $result['area_pname']=$area_pname;
                return $result;
            }
            
            public function get_merchant_count($areaid,$type){
                $check_r = $this->check_area_id($areaid,$type);
                $area_id = $check_r['area_id'];
                $type = $check_r['type'];
                $area_pname = $check_r['area_pname'];
                if ($area_id=='') {
                    $sql = "SELECT c.area_pid AS area_id ,d.area_name ,SUM(counts) counts,d.area_type FROM "
                            . "(SELECT b.area_pid,a.city_id,a.area_id ,COUNT(mer_id) counts FROM ".C('DB_PREFIX')."merchant a "
                            . "LEFT JOIN ".C('DB_PREFIX')."area b ON a.city_id=b.area_id "
                            . "WHERE city_id!=0 GROUP BY city_id )c "
                            . "LEFT JOIN ".C('DB_PREFIX')."area d ON d.area_id=c.area_pid GROUP BY c.area_pid";

                    $sql2 = "SELECT c.area_id ,c.area_name,c.area_type,COUNT(store_id) counts FROM ".C('DB_PREFIX')."merchant_store a "
                            . " LEFT JOIN ".C('DB_PREFIX')."area c ON a.province_id = c.area_id WHERE a.province_id!=0 GROUP BY a.province_id";
                }elseif ($type==1) {
                    $sql = "SELECT a.city_id AS area_id,c.area_name ,COUNT(mer_id) counts,c.area_type FROM ".C('DB_PREFIX')."merchant a "
                            . "LEFT JOIN ".C('DB_PREFIX')."area b ON a.city_id=b.area_id  "
                            . "LEFT JOIN ".C('DB_PREFIX')."area c ON a.city_id=c.area_id "
                            . "WHERE a.city_id!=0 AND a.area_id!=0 AND b.area_pid=".$area_id." GROUP BY a.city_id";
                    $sql2 = "SELECT c.area_id ,c.area_name,c.area_type,COUNT(store_id) counts FROM ".C('DB_PREFIX')."merchant_store a "
                            ."LEFT JOIN ".C('DB_PREFIX')."area c ON a.city_id = c.area_id WHERE a.province_id!=0 AND c.area_pid=".$area_id." GROUP BY a.city_id";
                }elseif($type==2){
                    $sql="SELECT a.area_id ,b.area_name,COUNT(mer_id) counts,b.area_type FROM ".C('DB_PREFIX')."merchant a "
                            . "LEFT JOIN ".C('DB_PREFIX')."area b ON a.area_id=b.area_id "
                            . "WHERE city_id!=0 AND a.area_id!=0 AND a.city_id=".$area_id."  GROUP BY area_id";
                    $sql2="SELECT c.area_id ,c.area_name,c.area_type,COUNT(store_id) counts FROM ".C('DB_PREFIX')."merchant_store a "
                            . " LEFT JOIN ".C('DB_PREFIX')."area c ON a.area_id = c.area_id WHERE a.province_id!=0 AND c.area_pid=".$area_id." GROUP BY a.area_id";
                }
                $model=new Model();
                $mer_count=$model->query($sql);
                $result = array('msg'=>$mer_count,'area_pname'=>$area_pname);
                return $result;
            }
            
            public function get_village_consumer($areaid,$type) {
                $check_r = $this->check_area_id($areaid,$type);
                $area_id = $check_r['area_id'];
                $type = $check_r['type'];
                $area_pname = $check_r['area_pname'];
                $year=$_POST['year'];
                if($_POST['month']==''){
                    $condition = 'WHERE year(FROM_UNIXTIME(pay_time))= '.$year;
                }else{
                    $condition = 'WHERE year(FROM_UNIXTIME(pay_time))= '.$year.' AND  month(FROM_UNIXTIME(pay_time))='.$_POST['month'];
                }
                $model = new Model();
                if ($area_id=='') {
                    $sql = "SELECT c.area_id,c.area_name,SUM(a.money) total_money,c.area_type FROM ".C('DB_PREFIX')."house_village_pay_order a "
                            . "LEFT JOIN ".C('DB_PREFIX')."house_village b ON a.village_id=b.village_id "
                            . "LEFT JOIN ".C('DB_PREFIX')."area c ON b.province_id = c.area_id ".$condition." GROUP BY b.province_id";
                    $sql2 = "select order_name, month(FROM_UNIXTIME(time)) as month,sum(money) as money from ".C('DB_PREFIX')."house_village_pay_order a "
                            .$condition. " group by order_type";
                }elseif ($type==1) {
                    $sql = "SELECT c.area_id,c.area_name,SUM(a.money) total_money,c.area_type FROM ".C('DB_PREFIX')."house_village_pay_order a "
                            ."LEFT JOIN ".C('DB_PREFIX')."house_village b ON a.village_id=b.village_id "
                            ."LEFT JOIN ".C('DB_PREFIX')."area c ON b.city_id = c.area_id  ".$condition." AND b.province_id=".$area_id." GROUP BY b.city_id";
                    $sql2 = "select order_name, month(FROM_UNIXTIME(time)) as month,sum(money) as money from ".C('DB_PREFIX')."house_village_pay_order a "
                            . "LEFT JOIN ".C('DB_PREFIX')."house_village b ON a.village_id=b.village_id "
                            .$condition ." AND b.province_id= ".$area_id
                            . " group by order_type";
                }elseif($type==2){
                    $sql = "SELECT c.area_id,c.area_name,SUM(a.money) total_money,c.area_type FROM ".C('DB_PREFIX')."house_village_pay_order a "
                            . "LEFT JOIN ".C('DB_PREFIX')."house_village b ON a.village_id=b.village_id "
                            . "LEFT JOIN ".C('DB_PREFIX')."area c ON b.area_id = c.area_id  ".$condition." AND b.city_id=".$area_id." GROUP BY b.area_id";
                    $sql2 = "select order_name, month(FROM_UNIXTIME(time)) as month,sum(money) as money from ".C('DB_PREFIX')."house_village_pay_order a "
                            . "LEFT JOIN ".C('DB_PREFIX')."house_village b ON a.village_id=b.village_id "
                            . $condition." AND b.city_id= ".$area_id
                            . " group by order_type";
                }elseif($type==3){
                    $sql = "SELECT b.village_id area_id,b.village_name area_name ,SUM(a.money) total_money ,4 area_type FROM ".C('DB_PREFIX')."house_village_pay_order a "
                            . "LEFT JOIN ".C('DB_PREFIX')."house_village b ON a.village_id=b.village_id  ".$condition." AND b.area_id = ".$area_id." GROUP BY b.village_id";
                    $sql2 = "select order_name, month(FROM_UNIXTIME(time)) as month,sum(money) as money from ".C('DB_PREFIX')."house_village_pay_order a "
                            . "LEFT JOIN ".C('DB_PREFIX')."house_village b ON a.village_id=b.village_id "
                            .$condition ." AND b.area_id= ".$area_id
                            . " group by order_type";
                }elseif($type==4){
                    if($_POST['month']!=''){
                        $condition2='month ,';
                    }
                    $sql2= "SELECT order_name, month(FROM_UNIXTIME(time)) as month,sum(money) as money from ".C('DB_PREFIX')."house_village_pay_order "
                            . $condition." AND village_id=".$area_id
                            . " group by ".$condition2."order_type "
                            . "order by order_type,month";
                    $type_money=$model->query($sql2);
                    $area_pname = empty($area_pname)?:$area_pname;
                    return array('msg'=>'','type_money'=>$type_money,'area_pname'=>$area_pname);
                }
                $total_money=$model->query($sql);
                $type_money=$model->query($sql2);
                return array('msg'=>$total_money,'type_money'=>$type_money,'area_pname'=>$area_pname);
            }
    }
    
?>
