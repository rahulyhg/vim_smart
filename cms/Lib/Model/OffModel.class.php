<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11
 * Time: 16:55
 */
class OffModel extends Model
{
    protected $tableName = 'house_village_room';
    protected $village_id;

    public function __construct()
    {
        parent::__construct();
        $this->village_id = I('get.village_id',4);
    }

    /**
     * 获取社区列表 key:village_id val:village_name
     * @return array
     */
    public function get_village_list($search=''){
        //添加搜索条件
        if(!empty($search)){
            foreach ($search as $k=>$v) {
                $map[$k]=$v;
            }
        }
        if(empty($search)){
            $tmp = M('house_village')->field('village_id,village_name')->where(array('status'=>1))->select();
        }else{
            $tmp = M('house_village')->field('village_id,village_name')->where(array('status'=>1))->select();
        }
        $village_list = array();
        foreach($tmp as $row){
            $village_list[$row['village_id']] = $row['village_name'];
        }
        return $village_list;

    }


    /**
     * 表格数据导入 表格数据格式化处理
     * 文件参考格式
     * http://www.hdhsmart.com/upload/example/goods.xls
     */
    public function contract_excel_to_data($file){
        // $arr = import_excel($file,'M');
        $arr = import_excel_sheet($file,'','','',2);
        // var_dump($arr);exit();
        $tmp = array();
        $title = array(
            '序号',
            '合同编号',
            '合同名称',
            '甲方',
            '乙方',
            '丙方',
            '合同类型',
            '经办人',
            '编号日期',
            '存档日期',
            '合同份数',
            '合同日期',
            '合同金额',
            '项目面积',
            '所属分公司'
        );
        $room_pro_name_arr = [];//记录合同名称 
        //为查询是否为重复数据做准备
        foreach($arr as $key=> $row){
            $tmp[] = array(
                'number'           => $row[0],
                'contract_number'  => $row[1],
                'contract_name'    => $row[2],
                'first_party'      => $row[3],
                'second_party'     => $row[4],
                'third_party'      => $row[5],
                'type'             => $row[6],
                'operator'         => $row[7],
                'number_time'      => $row[8],
                'file_time'        => $row[9],
                'count'            => $row[10],
                'contract_time'    => $row[11],
                'money'            => $row[12],
                'area'             => $row[13],
                'company'          => $row[14],
            );
        }

        $data = array(
            'title'=>$title,
            'body'=>$tmp
        );
        // var_dump($data);exit();
        return $data;
    }

    //导入数据库
    public function insert_contract_data_to_database($data){
        // $this->database_id = $id;
        $this->startTrans();
        $flag = 1;
        foreach($data as $row){

            //将数据导入物品数据库
            $oid = $this->insert_to_contractbase($row);
            $row['oid'] = $oid;
            $flag *= $oid;

            if(!$flag) {
                $this->rollback();
                break;
            };
        }

        if($flag){
            $this->commit();
            return true;
        }else{
            return false;
        }

    }

    /**
     * 向合同表添加数据
     * house_village_shequ
     */
    public function insert_to_contractbase($info){
        // //查询项目id
        // $village_id = M('house_village')->where(array('village_name'=>$info['village_name']))->find()['village_id'];
        //查询上传人员信息
        $id = $_SESSION['system']['id'];
        $admin_name = M('admin')->where(array('id'=>$id))->find()['realname'];

        //处理合同日期
        if (strpos($info['contract_time'], '-') == 10) {
            $arr = explode('-', $info['contract_time']);
            $time1 = $arr[0];
            $time2 = $arr[1];
            $array1 = explode('.', $time1);
            $time_start = $array1[0].'-'.$array1[1].'-'.$array1[2];
            $array2 = explode('.', $time2);
            $time_end = $array2[0].'-'.$array2[1].'-'.$array2[2];
        } else {
            $time = $info['contract_time'];
        }
        //处理编号日期
        if ($info['number_time']) {
            $array3 = explode('.', $info['number_time']);
            $time3 = $array3[0].'-'.$array3[1].'-'.$array3[2];
        }
        //处理存档日期
        if ($info['file_time']) {
            $array4 = explode('.', $info['file_time']);
            $time4 = $array4[0].'-'.$array4[1].'-'.$array4[2];
        }
        //处理项目面积和备注共用字段        
        if((strstr($info['area'], '㎡') !== false) || (strstr($info['area'], '/') !== false)){
            $area = $info['area'];
        }else{
            $remarks = $info['area'];
        }

        //查询是否存在重复数据
        // $is_set = M('house_village_shequ')->where(array('contract_name'=>$info['contract_name'],'contract_number'=>$info['contract_number']))->select(); 
        // if (!$is_set) {
        $data = array(
            'village_id'=>'4',
            'contract_number'=>$info['contract_number'],
            'contract_name'=>$info['contract_name'],
            'first_party'=>$info['first_party'],
            'second_party'=>$info['second_party'],
            'third_party'=>$info['third_party'],
            'company'=>$info['company'],
            'type'=>$info['type'],
            'operator'=> $info['operator'],
            'count'=>$info['count'],
            'contract_start'=>$time_start?:'',
            'contract_end'=>$time_end?:'',
            'contract_time'=>$time,
            'money'=>(string)$info['money'],
            'area'=>$area,
            'remarks'=>$remarks,
            'number_time'=>$time3,
            'file_time'=>$time4,
            'admin_id'=>$id,
            'admin_name'=>$admin_name,
            'status'=>'1',
            'create_time'=> time(),
        );
        // var_dump($data);exit;
        $oid = M('house_village_shequ')->add($data);
        if ($oid) {

            $this->set_import_error(1,"合同导入成功",mysql_error());
        } else {
            $this->set_import_error(1,"合同导入失败",mysql_error());
        }
        // } else {
        //     $this->set_import_error(1,"合同名称重复,请核对后再进行导入",mysql_error());
        // }
        // var_dump(M()->_sql());
        return $oid;
    }


    /**
     * 供应商表格数据导入 表格数据格式化处理
     * 文件参考格式
     * http://www.hdhsmart.com/upload/example/supplier.xls
     */
    public function supplier_excel_to_data($file){
        // $arr = import_excel($file,'M');
        $arr = import_excel_sheet($file,'','','',2);
//         dump($arr);die;
        $tmp = array();
        $title = array(
            '序号',
            '单位名称',
            '联系人',
            '联系电话',
            '联系地址',
            '经营范围',
            '税率',
            '合同日期',
            '经办人',
            // '合作状态',
        );
        $room_pro_name_arr = [];//记录供应商名称 
        //为查询是否为重复数据做准备
        foreach($arr as $key=> $row){
            $tmp[] = array(
                'number'            => $row[0],
                'sup_unit'          => $row[1],
                'sup_name'          => $row[2],
                'phone'             => $row[3],
                'location'          => $row[4],
                'business_scope'    => $row[5],
                'tax_rate'          => $row[6],
                'sup_time'          => $row[7],
                'operator'          => $row[8],
                // 'status'            => $row[9],             
            );
        }

        $data = array(
            'title'=>$title,
            'body'=>$tmp
        );
        // var_dump($data);exit();
        return $data;
    }

    //导入数据库
    public function insert_supplier_data_to_database($data){
        // $this->database_id = $id;
        $this->startTrans();
        $flag = 1;
        foreach($data as $row){

            //将数据导入物品数据库
            $oid = $this->insert_to_supplierbase($row);
            $row['oid'] = $oid;
            $flag *= $oid;

            if(!$flag) {
                $this->rollback();
                break;
            };
        }

        if($flag){
            $this->commit();
            return true;
        }else{
            return false;
        }

    }

    /**
     * 向合同表添加数据
     * supplier_list
     */
    public function insert_to_supplierbase($info){
        // //查询项目id
        // $village_id = M('house_village')->where(array('village_name'=>$info['village_name']))->find()['village_id'];
        //查询上传人员信息
        $id = $_SESSION['system']['id'];
        $admin_name = M('admin')->where(array('id'=>$id))->find()['realname'];

        //处理合同日期
        if (strpos($info['sup_time'], '-') == 10) {
            $arr = explode('-', $info['sup_time']);
            $time1 = $arr[0];
            $time2 = $arr[1];
            $array1 = explode('.', $time1);
            $time_start = $array1[0].'-'.$array1[1].'-'.$array1[2];
            $array2 = explode('.', $time2);
            $time_end = $array2[0].'-'.$array2[1].'-'.$array2[2];
        } else {
            $time = $info['sup_time']?$info['sup_time']:'';
        }

        //处理合同状态
        if ($info['status'] == '正常') {
            $a = 1;
        } else {
            $a = 0;
        }

        //查询是否存在重复数据
        // $is_set = M('house_village_shequ')->where(array('contract_name'=>$info['contract_name'],'contract_number'=>$info['contract_number']))->select(); 
        // if (!$is_set) {
        $data = array(
            'sup_unit'=> $info['sup_unit'],
            'sup_name'=> $info['sup_name'],
            'phone'=> $info['phone'],
            'location'=> $info['location'],
            'business_scope'=> $info['business_scope'],
            'tax_rate'=>$info['tax_rate'],
            'supplier_start'=>$time_start,
            'supplier_end'=>$time_end,
            'supplier_time'=>$time,
            'status'=>$a,
            'operator'=> $info['operator'],
            'add_uid'=>$id,
            'add_name'=>$admin_name,
            'add_time'=> time(),
        );
        // var_dump($data);exit;
        $oid = M('supplier_list')->add($data);
        // var_dump(M()->_sql());
        if ($oid) {

            $this->set_import_error(1,"供应商数据导入成功",mysql_error());
        } else {
            $this->set_import_error(1,"供应商数据导入失败",mysql_error());
        }
        // } else {
        //     $this->set_import_error(1,"合同名称重复,请核对后再进行导入",mysql_error());
        // }
        // var_dump(M()->_sql());
        return $oid;
    }


    /**
     * 供应商商品信息数据导入 表格数据格式化处理
     * 文件参考格式
     * http://www.hdhsmart.com/upload/example/supplier.xls
     */
    public function supplier_goods_excel_to_data($file){
        // $arr = import_excel($file,'M');
        $arr = import_excel_sheet($file,'','','',2);
        // var_dump($arr);exit();
        $tmp = array();
        $title = array(
            '序号',
            '商品名称',
            '规格参数',
            '单位',
            '单价/元',
            // '数量',           
            '品牌',
            '父分类',
            '子分类',
            '备注',
            // '供应商单位',
        );
        $room_pro_name_arr = [];//记录供应商名称 
        //为查询是否为重复数据做准备
        foreach($arr as $key=> $row){
            $tmp[] = array(
                'number'            => $row[0],
                'goods_name'        => $row[1],
                'specification'     => $row[2],
                'unit'              => $row[3],
                'price'             => $row[4],
                // 'quantity'          => $row[5],
                'brand'             => $row[5],
                'type'              => $row[6],
                'type_child'        => $row[7],
                'remark'            => $row[8],
                // 'sup_name'          => $row[10],           
            );
        }

        $data = array(
            'title'=>$title,
            'body'=>$tmp
        );
        // var_dump($data);exit();
        return $data;
    }

    //导入数据库
    public function insert_supplier_goods_data_to_database($data){
        // $this->database_id = $id;
        $this->startTrans();
        $flag = 1;
        foreach($data as $row){

            //将数据导入物品数据库
            $oid = $this->insert_to_supplier_goodsbase($row);
            $row['oid'] = $oid;
            $flag *= $oid;

            if(!$flag) {
                $this->rollback();
                break;
            };
        }

        if($flag){
            $this->commit();
            return true;
        }else{
            return false;
        }

    }

    /**
     * 向供应商商品表添加数据
     * supplier_goods_list
     */
    public function insert_to_supplier_goodsbase($info){
        // //查询项目id
        // $village_id = M('house_village')->where(array('village_name'=>$info['village_name']))->find()['village_id'];
        //查询上传人员信息
        $id = $_SESSION['system']['id'];
        $admin_name = M('admin')->where(array('id'=>$id))->find()['realname'];

        //处理分类
        $re = M('off_type1')->where(array('pid'=>$info['type'],'info'=>$info['type_child']))->find();
        if ($re) {
            $type_id = $re['id'];
        } else {
            if ($info['type_child']) {

                $parameters = array(
                    'pid' => $info['type'],
                    'info' => $info['type_child'],
                    'check_name' => $admin_name,
                    'create_time' => time(),
                );
                $res = M('off_type1')->add($parameters);
                $type_id = $res;

            } else {
                $type_id = $info['type'];
            }
        }

        //处理供应商
        // $supplier = M('supplier_list')->where(array('sup_unit'=>$info['sup_name']))->find();
        $sup_id = (int)$_COOKIE['sup_id'];

        //查询是否存在重复数据
        // $is_set = M('house_village_shequ')->where(array('contract_name'=>$info['contract_name'],'contract_number'=>$info['contract_number']))->select(); 
        // if (!$is_set) {
        $data = array(
            'goods_name'=> $info['goods_name'],
            'specification'=> $info['specification'],
            'unit'=> $info['unit'],
            'price'=> $info['price'],
            // 'quantity'=> $info['quantity'],
            'brand'=>$info['brand'],
            'type'=>(int)$type_id,
            'remark'=>$info['remark'],
            'sup_id'=>$sup_id,
            'status'=>1,
            'add_uid'=>$id,
            'add_name'=>$admin_name,
            'add_time'=> time(),
        );
        // var_dump($data);exit;
        $oid = M('commodity_list')->add($data);
        // var_dump(M()->_sql());
        if ($oid) {

            $this->set_import_error(1,"供应商商品数据导入成功",mysql_error());
        } else {
            $this->set_import_error(1,"供应商商品数据导入失败",mysql_error());
        }
        // } else {
        //     $this->set_import_error(1,"合同名称重复,请核对后再进行导入",mysql_error());
        // }
        // var_dump(M()->_sql());
        return $oid;
    }


    /**
     * 库存商品信息数据导入 表格数据格式化处理
     * 文件参考格式
     * http://www.hdhsmart.com/upload/example/supplier.xls
     */
    public function inventory_excel_to_data($file){
        // $arr = import_excel($file,'M');
        $arr = import_excel_sheet($file,'','','',2);
        // var_dump($arr);exit();
        $tmp = array();
        $title = array(
            '序号',
            '商品名称',
            '规格参数',
            '库存数量',
            '分类',
            '供应商单位',
            '备注',
        );
        $room_pro_name_arr = [];//记录供应商名称 
        //为查询是否为重复数据做准备
        foreach($arr as $key=> $row){
            $tmp[] = array(
                'number'            => $row[0],
                'goods_name'        => $row[1],
                'specification'     => $row[2],
                'count'             => $row[3],
                'type'              => $row[4],
                'sup_name'          => $row[5],
                'remark'            => $row[6],
            );
        }

        $data = array(
            'title'=>$title,
            'body'=>$tmp
        );
        // var_dump($data);exit();
        return $data;
    }

    //导入数据库
    public function insert_inventory_data_to_database($data){
        // $this->database_id = $id;
        $this->startTrans();
        $flag = 1;
        foreach($data as $row){

            //将数据导入物品数据库
            $oid = $this->insert_to_inventory_base($row);
            $row['oid'] = $oid;
            $flag *= $oid;

            if(!$flag) {
                $this->rollback();
                break;
            };
        }

        if($flag){
            $this->commit();
            return true;
        }else{
            return false;
        }

    }

    /**
     * 向合同表添加数据
     * supplier_list
     */
    public function insert_to_inventory_base($info){
        // //查询项目id
        // $village_id = M('house_village')->where(array('village_name'=>$info['village_name']))->find()['village_id'];
        //查询上传人员信息
        $id = $_SESSION['system']['id'];
        $admin_name = M('admin')->where(array('id'=>$id))->find()['realname'];

        //处理商品id
        $commodity = M('commodity_list')->where(array('goods_name'=>$info['goods_name'],'specification'=>$info['specification']))->find();

        //查询是否存在重复数据
        // $is_set = M('house_village_shequ')->where(array('contract_name'=>$info['contract_name'],'contract_number'=>$info['contract_number']))->select(); 
        // if (!$is_set) {
        $data = array(
            'goods_id'=> $commodity['id'],
            'count'=> $info['count'],
            'type'=> $info['type'],
            'remark'=>$info['remark'],
            'sup_id'=>$commodity['sup_id'],
            'status'=>1,
            'add_uid'=>$id,
            'add_name'=>$admin_name,
            'add_time'=> time(),
        );
        // var_dump($data);exit;
        $oid = M('inventory_list')->add($data);
        // var_dump(M()->_sql());
        if ($oid) {

            $this->set_import_error(1,"库存商品数据导入成功",mysql_error());
        } else {
            $this->set_import_error(1,"库存商品数据导入失败",mysql_error());
        }
        // } else {
        //     $this->set_import_error(1,"合同名称重复,请核对后再进行导入",mysql_error());
        // }
        // var_dump(M()->_sql());
        return $oid;
    }


    /**
     * 进出库商品信息数据导入 表格数据格式化处理
     * 文件参考格式
     * http://www.hdhsmart.com/upload/example/supplier.xls
     */
    public function inventory_turnover_excel_to_data($file){
        // $arr = import_excel($file,'M');
        $arr = import_excel_sheet($file,'','','',2);
        // var_dump($arr);exit();
        $tmp = array();
        $title = array(
            '序号',
            '商品名称',
            '规格参数',
            '进/出库',
            '进/出库时间',
            '进/出库数量',
            '操作人',
            '备注',
        );
        $room_pro_name_arr = [];//记录供应商名称 
        //为查询是否为重复数据做准备
        foreach($arr as $key=> $row){
            $tmp[] = array(
                'number'            => $row[0],
                'goods_name'        => $row[1],
                'specification'     => $row[2],
                'info'              => $row[3],
                'info_time'         => $row[4],
                'info_count'        => $row[5],
                'operator'          => $row[6],
                'remark'            => $row[7],
            );
        }

        $data = array(
            'title'=>$title,
            'body'=>$tmp
        );
        // var_dump($data);exit();
        return $data;
    }

    //导入数据库
    public function insert_inventory_turnover_data_to_database($data){
        // $this->database_id = $id;
        $this->startTrans();
        $flag = 1;
        foreach($data as $row){

            //将数据导入物品数据库
            $oid = $this->insert_to_inventory_turnover_base($row);
            $row['oid'] = $oid;
            $flag *= $oid;

            if(!$flag) {
                $this->rollback();
                break;
            };
        }

        if($flag){
            $this->commit();
            return true;
        }else{
            return false;
        }

    }


    /**
     * 向合同表添加数据
     * supplier_list
     */
    public function insert_to_inventory_turnover_base($info){
        // //查询项目id
        // $village_id = M('house_village')->where(array('village_name'=>$info['village_name']))->find()['village_id'];
        //查询上传人员信息
        $id = $_SESSION['system']['id'];
        $admin_name = M('admin')->where(array('id'=>$id))->find()['realname'];

        //处理商品id
        $commodity = M('commodity_list')->where(array('goods_name'=>$info['goods_name'],'specification'=>$info['specification']))->find();

        //处理进出库时间
        $array = explode('.', $info['info_time']);
        $time = $array[0].'-'.$array[1].'-'.$array[2];

        //查询是否存在重复数据
        // $is_set = M('house_village_shequ')->where(array('contract_name'=>$info['contract_name'],'contract_number'=>$info['contract_number']))->select(); 
        // if (!$is_set) {
        $data = array(
            'goods_id'=> $commodity['id'],
            'info'=> $info['info'],
            'info_time'=> $time,
            'info_count'=> $info['info_count'],
            'operator'=>$info['operator'],
            'remark'=>$info['remark'],
            'status'=>1,
            'add_uid'=>$id,
            'add_name'=>$admin_name,
            'add_time'=> time(),
        );
        // var_dump($data);exit;
        $oid = M('inventory_turnover_list')->add($data);
        // var_dump(M()->_sql());
        if ($oid) {

            $this->set_import_error(1,"进出库商品数据导入成功",mysql_error());
        } else {
            $this->set_import_error(1,"进出库商品数据导入失败",mysql_error());
        }
        // } else {
        //     $this->set_import_error(1,"合同名称重复,请核对后再进行导入",mysql_error());
        // }
        // var_dump(M()->_sql());
        return $oid;
    }

    //导入数据库
    public function insert_staff_data_to_database($data){
        //dump($data);die;
        // $this->database_id = $id;
        $this->startTrans();
        $flag = 1;
        foreach($data as $row){
            //将数据导入宿舍表
            $oid = $this->insert_to_staff_base($row);
            $row['oid'] = $oid;
            $flag *= $oid;
            if(!$flag) {
                $this->rollback();
                break;
            };
        }

        if($flag){
            $this->commit();
            return true;
        }else{
            return false;
        }

    }

    /**
     * 向合同表添加数据
     * supplier_list
     */
    public function insert_to_staff_base($info){
        // //查询项目id
        // $village_id = M('house_village')->where(array('village_name'=>$info['village_name']))->find()['village_id'];
        //查询上传人员信息
//        $id = $_SESSION['system']['id'];
//        $admin_name = M('admin')->where(array('id'=>$id))->find()['realname'];
        //查询village_id
        $village_id = M('house_village')->where(array('village_name'=>trim($info['project'])))->find()['village_id'];
        if(empty($village_id)){
            $oid = 0;
        }else{
            //查询是否存在相同宿舍
            $village = M('staff')->alias('a')
                ->join('left join pigcms_house_village b ON a.village_id = b.village_id')
                ->field('a.*,b.village_name')
                ->where(array('a.village_id'=>$village_id,'a.room'=>$info['room']))
                ->find();
            if($village){
                $this->set_import_error(1,$village['village_name']."-".$village['room']."宿舍名称重复",mysql_error());
                $oid = 0;
                return $oid;
            }else{
                //加入表
                $name_ids = explode(',',$info['name']);
                if(empty($name_ids[0])){
                    $num = 0;
                }else{
                    $num = count($name_ids);
                }
                $arr = array(
                    'village_id'=>$village_id,
                    'room'      =>$info['room'],
                    'bed_number'=>$info['bed_number'] - $num,
                    'department'=>$info['department'],
                    'comment'   =>$info['comment']
                );
                $insert_id = M('staff')->add($arr);
                if($insert_id !== false){
                    $i = 1;
                    foreach($name_ids as $v){

                        $name_id = M('staff_name')->add(array('name'=>trim($v)));
                        $i *=$name_id;
                        if(!$i){
                            $oid = 0;
                        }else{
                            //将name_id加入宿舍表
                            $staff = M('staff')->where(array('staff_id'=>$insert_id))->find();
                            $ids = explode(',',$staff['name_id']);
                            array_push($ids,$name_id);
                            $str = trim(implode(',',$ids),',');
                            $result = M('staff')->where(array('staff_id'=>$insert_id))->save(array('name_id'=>$str));
                            //加入记录表
                            $arr['start_time'] = time();
                            $arr['name'] = trim($v);
                            M('staff_record')->add($arr);
                            if($result !== false){
                                $oid = 1;
                            }else{
                                $oid = 0;
                            }
                        }
                    }
                }else{
                    $oid = 0;
                }
            }
        }

        if ($oid) {
            $this->set_import_error(1,"宿舍数据导入成功",mysql_error());
        } else {
            $this->set_import_error(1,"宿舍数据导入失败",mysql_error());
        }
        // } else {
        //     $this->set_import_error(1,"合同名称重复,请核对后再进行导入",mysql_error());
        // }
        // var_dump(M()->_sql());
        return $oid;
    }


    /**
     * 表格数据导入 表格数据格式化处理
     * 文件参考格式
     * http://www.hdhsmart.com/upload/example/goods.xls
     */
    public function goods_excel_to_data($file){
        $arr = import_excel($file,'J');
        // var_dump($arr);exit();
        $tmp = array();
        $title = array(
            '物品名称',
            '所属分类',
            // '所在社区',
            // '所属区域',
            '计量单位',
            // '最大库存',
            '采购日期',
            '品牌',
            '单价',
            '供应商',
            '物品描述',
            '物品规格',
            '物品状态',
        );
        $room_pro_name_arr = [];//记录物品名称 
        //为查询是否为重复数据做准备
        foreach($arr as $key=> $row){
            $tmp[] = array(
                'pro_name'=>$row[0],
                'off_pro_type'=>$row[1],
                // 'village_id'=>$village_id,
                // 'off_zone'=>$row[2], 
                'pro_unit'=>$row[2],
                // 'pro_stock'=>$row[4],
                'purch_time'=>$row[3],
                'band'=>$row[4],
                'pro_price'=>$row[5],
                'pro_supplier'=>$row[6],
                'pro_desc'=>$row[7]?$row[7]:'',
                'pro_specification'=>$row[8]?$row[8]:'',
                'product_status'=>$row[9],
            );
        }

        $data = array(
            'title'=>$title,
            'body'=>$tmp
        );
        // var_dump($data);exit();
        return $data;
    }

    //导入数据库
    public function insert_goods_data_to_database($data,$village_id){
        $this->database_village_id = $village_id;
        $this->startTrans();
        $flag = 1;
        foreach($data as $row){
            //所在区域处理
            // $is_set = $this->is_set_off_zone($row,$village_id);
            // $row['is_set'] = $is_set;
            // $flag *= $is_set;


            //将数据导入物品数据库
            $oid = $this->insert_to_goodsbase($row,$village_id);
            $row['oid'] = $oid;
            $flag *= $oid;

            if(!$flag) {
                $this->rollback();
                break;
            };
        }

        if($flag){
            $this->commit();
            return true;
        }else{
            return false;
        }

    }

    /**
     * 向业主表添加数据
     * pigcms_off_products
     */
    public function insert_to_goodsbase($info,$village_id){
        //查询所属社区
        // $village_id = $village_id;
        $logogram = D('house_village')->where(array('village_id'=>$village_id))->getField('logogram');//社区英文简称
        // 获取物品的分类id
        $off_pro_type = $this->get_off_type_id($info['off_pro_type']);
        //查询是否存在重复数据
        $is_set = D('off_products')->where(array('pro_name'=>$info['pro_name'],'band'=>$info['band'],'pro_supplier'=>$info['pro_supplier']))->select();
        if (!$is_set) {
            $data = array(
                'pro_name'=>$info['pro_name'],
                'off_pro_type'=>$off_pro_type,
                // 'village_id'=>$village_id,
                'pro_unit'=>$info['pro_unit'],
                // 'pro_stock'=>$info['pro_stock'],
                'purch_time'=>strtotime($info['purch_time']),
                'band'=>$info['band'],
                'pro_price'=>$info['pro_price'],
                'pro_supplier'=>$info['pro_supplier'],
                'pro_desc'=>$info['pro_desc'],
                'pro_specification'=>$info['pro_specification'],
                'product_status'=>$info['product_status'],
                'create_time'=> time(),
                'pro_creator' => $_SESSION['system']['realname'],
                'zone_id'=>$zone_id,
            );
            $oid = D('off_products')->add($data);
            if ($oid) {
                $pro_code = strtoupper($logogram).sprintf("%06d" , $oid);
                D('off_products')->where(array('pro_id'=>$oid))->save(array('pro_code'=>$pro_code));
                //生成二维码
                // $proArr = D('off_products')->where(array('pro_id'=>$oid))->find();
                // $pro_code = $proArr['pro_code'];
                // $pro_stock = $proArr['pro_stock'];
                // $qr_data = array();
                // $qr_data['pro_code'] = $pro_code;
                // for ($x=1; $x<=$pro_stock; $x++) {
                //     $k = sprintf("%04d" , $x);
                //     $qr_data['pro_qrcode'] = $pro_code.$k;
                //     $qr_data['adress'] = "./upload/qrcode/".$oid."/".$qr_data['pro_qrcode'].".png";
                //     $re = D('off_products_ercode')->add($qr_data);
                //     if ($re) {
                //         $url =  C('WEB_DOMAIN') . '/admin.php?g=System&c=Off&a=products_qr_detail&pro_qrcode=' . $qr_data['pro_qrcode'];
                //         $path = "./upload/qrcode/".$oid."/";
                //         $this->get_qr($url,$path,$qr_data['pro_qrcode']);
                //     }
                // }
                $this->set_import_error(1,"物品导入成功",mysql_error());
            } else {
                $this->set_import_error(1,"物品导入失败",mysql_error());
            }
        } else {
            $this->set_import_error(1,"物品名称重复,请核对后再进行导入",mysql_error());
        }

        // dump(M()->_sql());
        // if(!$oid){
        //     $this->set_import_error(1,"导入物品时发生错误",mysql_error());
        // }

        return $oid;
    }

    //获得物品分类id,如果没有则新建为一级分类
    public function get_off_type_id($info) {
        $off_pro_type = D('off_type')->where(array('type_name'=>$info,'is_del'=>0))->getField('id');
        if (!$off_pro_type) {
            $data = array();
            $data['pid'] = 0;
            $data['type_name'] = $info;
            $data['check_name'] = $_SESSION['system']['realname'];
            $data['create_time'] = time();
            $re = D('off_type')->add($data);
            // var_dump(M()->_sql());
            $off_pro_type = D('off_type')->where(array('type_name'=>$info,'is_del'=>0))->getField('id');
            // var_dump(M()->_sql());
        }

        return $off_pro_type;
    }

    //所属区域处理
    // public function is_set_off_zone($info,$village_id) {
    // 	$is_set = D('off_zone')->where(array('zone_name'=>$info['off_zone'],'village_id'=>$village_id,'is_del'=>0))->getField('id');
    // 	if (!$is_set) {
    // 		$data = array();
    //      $data['pid'] = 0;
    //      $data['zone_name'] = $info['off_zone'];
    //      $data['check_name'] = $_SESSION['system']['realname'];
    //      $data['create_time'] = time();
    //      $data['village_id'] = $village_id;
    //      $re = D('off_zone')->add($data);
    //      $is_set = D('off_zone')->where(array('zone_name'=>$data['off_zone'],'village_id'=>$village_id,'is_del'=>0))->getField('id');
    // 	}
    // 	return $is_set;
    // }

    /**
     * 生成二维码链接 *并且不会生成本文件(更新后，生成本文件)
     * 注：之前不要有输出
     * @param $url 扫描后跳转地址
     * @param string $logo 二维码中间的logo图片地址 默认为汇得行的logo
     * @update-time: 2018-06-2 9:25
     */
    // function get_qr($url,$path,$xxx,$logo="./static/PropertyService/images/xx.png"){
    //     header("content-type:text/html;charset=utf-8");
    //     import('@.ORG.phpqrcode');
    //     // 生成的二维码所在目录+文件名

    //     if(!file_exists($path)){
    //         mkdir($path, 0777,true);//创建目录
    //     }
    //     $fileName = $path.$xxx.".png";

    //     $size = $_GET['size'] ? $_GET['size']: 27;
    //     ob_start();
    //     QRcode::png(htmlspecialchars_decode(urldecode($url)),false,0,$size,1);
    //     $QR = ob_get_contents();//截取缓冲区中的二维码图
    //     ob_end_clean();
    //     if ($logo !== FALSE) {
    //         $QR = imagecreatefromstring($QR);
    //         $logo = imagecreatefromstring(file_get_contents($logo));
    //         $QR_width = imagesx($QR);//二维码图片宽度
    //         $QR_height = imagesy($QR);//二维码图片高度
    //         $logo_width = imagesx($logo);//logo图片宽度
    //         $logo_height = imagesy($logo);//logo图片高度
    //         $logo_qr_width = $QR_width / 5;
    //         $scale = $logo_width/$logo_qr_width;
    //         $logo_qr_height = $logo_height/$scale;
    //         $from_width = ($QR_width - $logo_qr_width) / 2;
    //         //重新组合图片并调整大小
    //         imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
    //     }
    //     //输出图片
    //     Header("Content-type: image/png");
    //     ImagePng($QR,$fileName);
    //     imagedestroy($QR);
    //     //文件调整dpi
    //     $file = file_get_contents($fileName);

    //     //数据块长度为9
    //     $len = pack("N", 9);
    //     //数据块类型标志为pHYs
    //     $sign = pack("A*", "pHYs");
    //     //X方向和Y方向的分辨率均为300DPI（1像素/英寸=39.37像素/米），单位为米（0为未知，1为米）
    //     $data = pack("NNC", 300 * 39.37, 300 * 39.37, 0x01);
    //     //CRC检验码由数据块符号和数据域计算得到
    //     $checksum = pack("N", crc32($sign . $data));
    //     $phys = $len . $sign . $data . $checksum;

    //     $pos = strpos($file, "pHYs");
    //     if ($pos > 0) {
    //         //修改pHYs数据块
    //         $file = substr_replace($file, $phys, $pos - 4, 21);
    //     } else {
    //         //IHDR结束位置（PNG头固定长度为8，IHDR固定长度为25）
    //         $pos = 33;
    //         //将pHYs数据块插入到IHDR之后
    //         $file = substr_replace($file, $phys, $pos, 0);
    //     }
    //     file_put_contents($fileName,$file);
    // }


    /**
     * 向数据表中插入数据
     * @param 导入的数据
     * @village_id 选择的社区
     */
    //插入数据的village_id
    protected $database_village_id = 0;
    protected $import_error = array();
    protected function set_import_error($err,$msg,$data){
        $this->import_error =  array(
            'err'=>$err,
            'msg'=>$msg,
            'data'=>$data,
        );
        return $this->import_error;
    }

    public function get_import_error(){
        return $this->import_error;
    }

    /**
     * 宿舍表格数据导入 表格数据格式化处理
     * 文件参考格式
     * http://www.hdhsmart.com/upload/example/supplier.xls
     */
    public function staff_excel_to_data($file)
    {
        $arr = import_excel_sheet($file,'','','',1);
//         dump($arr);die;
        $tmp = array();
        $title = array(
            '序号',
            '项目',
            '位置/房间号',
            '床位数',
            '住宿员工姓名',
            '所在部门',
            '备注',
            // '合作状态',
        );
        $room_pro_name_arr = [];//记录供应商名称
        //为查询是否为重复数据做准备
        foreach($arr as $key=> $row){
            $tmp[] = array(
                'number'            => $row[0],
                'project'          => $row[1],
                'room'          => $row[2],
                'bed_number'             => $row[3],
                'name'          => $row[4],
                'department'    => $row[5],
                'comment'          => $row[6],
                // 'status'            => $row[9],
            );
        }

        $data = array(
            'title'=>$title,
            'body'=>$tmp
        );
        // var_dump($data);exit();
        return $data;
    }

    /**
     * 水电费导入
     * 文件参考格式
     * http://www.hdhsmart.com/upload/example/supplier.xls
     */
    public function water_excel_to_data($file)
    {
        $arr = import_excel_sheet($file,'','','',1);
//         dump($arr);die;
        $tmp = array();
        $title = array(
            '序号',
            '房间号',
            '业主姓名',
            '起码',
            '止码',
            '单价',
            // '合作状态',
        );
        $room_pro_name_arr = [];//记录供应商名称
        //为查询是否为重复数据做准备
        foreach($arr as $key=> $row){
            $tmp[] = array(
                'number'            => $row[0],
                'room'              => $row[1],
                'owner_name'        => $row[2],
                'start_code'        => $row[3],
                'end_code'          => $row[4],
                'price'             => $row[5],
            );
        }

        $data = array(
            'title'=>$title,
            'body'=>$tmp
        );
        // var_dump($data);exit();
        return $data;
    }

    //导入数据库
    public function insert_water_data_to_database($data){
        // $this->database_id = $id;
        $this->startTrans();
        $flag = 1;
        foreach($data['data'] as $row){
            //将数据导入水电表
            $oid = $this->insert_to_water_base($row,$data['start_time'],$data['end_time']);
            $row['oid'] = $oid;
            $flag *= $oid;
            if(!$flag) {
                $this->rollback();
                break;
            };
        }

        if($flag){
            $this->commit();
            return true;
        }else{
            return false;
        }

    }

    /**
     * 向合同表添加数据
     * supplier_list
     */
    public function insert_to_water_base($info,$start_time,$end_time){
        //查询是否存在该房间号
        $data = M('house_village_room')->alias('a')
            ->join('left join pigcms_house_village_user_bind b on a.oid = b.pigcms_id')
            ->where(array('a.room_name'=>trim($info['room']),'b.name'=>trim($info['owner_name'])))
            ->find();
//        dump($info);die;
        if(empty($data)){
            $this->set_import_error(1,"没有房间号或业主信息",mysql_error());
            $oid = 0;
            return $oid;
        }
        //存入数据表
        $arr = array(
            'rid'           =>$data['id'],
            'owner_name'    =>$info['owner_name'],
            'start_code'    =>$info['start_code'],
            'end_code'      =>$info['end_code'],
            'price'         =>$info['price'],
            'start_time'    =>$start_time,
            'end_time'      =>$end_time
        );
        $oid = M('house_village_water')->add($arr);
        if ($oid) {
            $this->set_import_error(1,"水电费导入成功",mysql_error());
        } else {
            $this->set_import_error(1,"水电费导入失败",mysql_error());
        }
        return $oid;
    }
}