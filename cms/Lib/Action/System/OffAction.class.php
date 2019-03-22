<?php
/**
 * 关于办公物品的类
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/5/30
 * Time: 9:14
 */

class OffAction extends BaseAction{

    public function _initialize()
    {

        parent::_initialize();

        $this->admin_id = session('system.id');
        $this->village_id = filter_village(0, 2);

    }

    /**
     *物品管理
     **/
    public function off_list_news(){

        //获取下拉框各项目的id和名称
        $model = new OffModel();
        $villageStr = $model->get_village_list();
        $villageArray = array();
        foreach ($villageStr as $k => $v) {
            $villageArray[$k]['village_id'] = $k;
            $villageArray[$k]['village_name'] = $v;
        }
        //获取各项目的物品总数量
        foreach ($villageArray as $k => &$v) {
            $r_num_v = D('off_products_ercode')->alias('e')
                ->join('left join __OFF_PRODUCTS__ p on p.pro_code = e.pro_code')
                ->where(array('p.is_del'=>0,'e.receive'=>1,'e.village_id'=>$v['village_id']))
                ->count();
            $villageArray[$k]['count'] = $r_num_v ? $r_num_v : 0;
            unset($v);
        }
        //筛选： 获取下拉框项目的id信息
        $villageId = $_GET['villageId'];
        if ($villageId) {
            $this->assign('villageId',$villageId);
            $map['e.village_id'] = array('eq',$villageId);
        }
        $map['p.is_del'] = array('eq',0);

        if ($_GET['type_id'] || $_GET['type_id'] === '0') $map['p.off_pro_type'] = array('eq',$_GET['type_id']);
        if($_GET['zone_id']) $map['p.zone_id']=$_GET['zone_id'];
        $offArr = D('off_products')->alias('p')
            ->field('p.*,t.type_name,t.pid,oz.zone_name')
            ->join('left join __OFF_TYPE__ t on t.id = p.off_pro_type')
            ->join('left join __OFF_ZONE__ oz on oz.id = p.zone_id')
            ->join('left join __OFF_PRODUCTS_ERCODE__ e on e.pro_code = p.pro_code')
            ->where($map)
            ->group('p.pro_name')
            ->order('p.pro_id desc')
            ->select();
        foreach ($offArr as &$v) {
            $pro_code = $v['pro_code'];
            $r_num = D('off_products_ercode')->where(array('receive'=>1,'pro_code'=>$pro_code))->count();    //每一类物品绑定的数量
            $v['r_num'] = $r_num ? $r_num : 0;
            $Count += $r_num;  //所有物品的总数量
            //该项目每一类物品的数量
            $r_num_v = D('off_products_ercode')->where(array('receive'=>1,'pro_code'=>$pro_code,'village_id'=>$villageId))->count();
            $v['r_num_v'] = $r_num_v ? $r_num_v : 0;
            $v['rate'] = round(($v['r_num_v']/$v['r_num'])*100,0); //各项目占每一类物品数量的比率
            unset($v);
        }

        //当筛选社区信息为空时，显示内容，但数量显示为0
        if ($villageId && $offArr == '') {
            if ($_GET['type_id'] || $_GET['type_id'] === '0') $map['p.off_pro_type'] = array('eq',$_GET['type_id']);
            if($_GET['zone_id']) $map['p.zone_id']=$_GET['zone_id'];
            $offArr = D('off_products')->alias('p')
                ->field('p.*,t.type_name,t.pid,oz.zone_name')
                ->join('left join __OFF_TYPE__ t on t.id = p.off_pro_type')
                ->join('left join __OFF_ZONE__ oz on oz.id = p.zone_id')
                ->join('left join __OFF_PRODUCTS_ERCODE__ e on e.pro_code = p.pro_code')
                ->where(array('p.is_del'=>0))
                ->group('p.pro_name')
                ->order('p.pro_id desc')
                ->select();
            foreach ($offArr as &$v) {
                $pro_code = $v['pro_code'];
                //被领取数量
                $r_num = D('off_products_ercode')->where(array('receive'=>1,'pro_code'=>$pro_code))->count();
                $v['r_num'] = $r_num?:0;
                $Count += $r_num;  //所有物品的总数量
                //查询各社区物品的使用情况
                $v['r_num_v'] = 0;
                $v['rate'] = 0;
                unset($v);
            }
        }
        //各社区绑定物品的总数量占用率
        foreach ($villageArray as $k => $v) {
            $villageArray[$k]['rate'] = round(($villageArray[$k]['count']/$Count)*100,0);
        }
        unset($villageArray['']);
        $this->assign('Count',$Count);
        $this->assign('offArr',$offArr);
        $this->assign('villageArray',$villageArray);
        $this->display();
    }


    //供应商管理
    public function supplier_list_news(){
        //查询所有供应商信息
        $supplier_list = M('supplier_list')->select();
        //处理经营范围数据

        foreach ($supplier_list as $ke => $val) {
            $business = $val['business_scope'];
            $business = explode(",", $business);
            $arr = '';
            foreach ($business as $k => $v) {
                $type = M('off_type1')->where(array('id'=>$v))->find();
                $arr .= $type['info'].',';
            }
            $arr = rtrim($arr, ",");
            $supplier_list[$ke]['business_name'] = $arr;
        }

        $this->assign('supplier_list',$supplier_list);
        $this->display();
    }


    /*
     *供应商的状态，终止与正常
     */
    public function supplier_status(){
        $id = I('post.sup_id');
        $status = I('post.status');
        if ($status == 0) {//终止
            $data=array('status'=>1);
            $re=M('supplier_list')->where(array('id'=>$id))->data($data)->save();
            echo $re;
        } else {//正常
            $data=array('status'=>0);
            $re=M('supplier_list')->where(array('id'=>$id))->data($data)->save();
            echo $re;
        }
    }


    /**
     * 供应商详情
     *
     */
    public function supplier_detail(){
        $id = I('get.id');

        //查询当前记录的信息
        $supplier = M('supplier_list')->where(array('id'=>$id))->find();

        //处理经营范围
        $arr = explode(',',$supplier['business_scope']);
        $bus_name = '';
        foreach ($arr as $k => $v) {
            $type = M('off_type1')->where(array('id'=>$v))->find();
            $bus_name .= $type['info'].',';
        }
        $bus_name = rtrim($bus_name, ",");
        $supplier['bus_name'] = $bus_name;

        //处理上传文件
        // var_dump($supplier['pic_info']);exit;
        $arr1 = explode(';',$supplier['pic_info']);
        // var_dump($arr1);exit;
        $pic_arr = array();
        foreach ($arr1 as $ke => $val) {
            $path = explode(',',$val);
            $pic_arr[$ke] = $path[0].'/'.$path[1];
        }
        // var_dump($pic_arr);exit;
        $supplier['pic_arr'] = $pic_arr;

        $this->assign('supplier',$supplier);
        $this->display();
    }


    //供应商添加
    public function supplier_add() {
        //查询分类信息
        $type_array = M('off_type1')->where(array('status'=>1))->select();

        $this->assign('type_array',$type_array);
        $this->display();
    }


    //供应商添加保存
    public function supplier_save() {
        //获取数据
        $data = $_POST;
        $data['pic_info'] = implode(';',$_POST['pic']);
        unset($data['pic']);

        $id = $_SESSION['system']['id'];
        $name = M('admin')->where(array('id'=>$id))->find()['realname'];

        $business = $data['business_scope'];
        unset($data['business_scope']);
        $arr = '';
        foreach ($business as $k => $v) {
            $arr .= $v.',';
        }
        $arr = rtrim($arr, ",");
        $data['business_scope'] = $arr;

        $data['add_uid'] = $id;
        $data['add_name'] = $name;
        $data['add_time'] = time();
        // var_dump($data);exit;
        $add = M('supplier_list')->add($data);

        if ($add) {

            $this->success('添加供应商成功',U('Off/supplier_list_news'));
        } else {
            $this->error('添加供应商失败',U('Off/supplier_add'));
        }
    }


    /*
     * 删除合同图片
     */

    public function store_ajax_del_pic(){
        $this->del_image_by_path($_POST['path']);
    }

    /*根据商品数据表的图片字段来删除图片*/
    public function del_image_by_path($path){

        if(!empty($path)){

            $image_tmp = explode(',',$path);

            unlink('./upload/store/'.$image_tmp[0].'/'.$image_tmp['1']);
            return true;

        }else{
            return false;

        }

    }

    /*
     * 添加合同图片
     */
    public function store_ajax_upload_pic() {
        $fileArr = $_FILES['imgFile'];
        $type = explode('/',$fileArr['type'])[0];//判断文件类型
//        dump($fileArr);
//        dump(explode('/',$fileArr['type']));exit;
        if ($fileArr['error'] != 4) {
            if ($fileArr['size'] < 500000) {
                $image = D('Image')->handleTwo($this->merchant_session['mer_id'], 'contract', 1);
                if ($image['error']) {
                    exit(json_encode($image));
                } else {
                    $title = $image['title']['imgFile'];
                    $url = $this->get_image_by_path($title);
                    exit(json_encode(array('error' => 0, 'url' => $url, 'title' => $title )));
                }
            } else {
                exit(json_encode(array('error' => 1,'message' =>'文件过大')));
            }
        } else {
            exit(json_encode(array('error' => 1,'message' =>'没有选择文件')));
        }
    }

    /*
    * 查看合同大图
    */
    public function look_img() {
        $url = I('get.url');
        $this->assign('url',$url);
        $this->display();
    }

    /*根据商品数据表的图片字段的一段来得到图片*/

    public function get_image_by_path($path){

        if(!empty($path)){

            $image_tmp = explode(',',$path);

            $return = C('config.site_url').'/upload/contract/'.$image_tmp[0].'/'.$image_tmp['1'];

            return $return;

        }else{

            return false;

        }

    }


    //供应商更新
    public function supplier_edit() {
        if ($_POST) {

            //获取数据
            $data = $_POST;
            $data['pic_info'] = implode(';',$_POST['pic']);
            unset($data['pic']);
            // var_dump($data);exit;

            //供应商id
            $sup_id = $data['id'];
            unset($data['id']);

            $id = $_SESSION['system']['id'];
            $name = M('admin')->where(array('id'=>$id))->find()['realname'];

            $business = $data['business_scope'];
            unset($data['business_scope']);
            $arr = '';
            foreach ($business as $k => $v) {
                $arr .= $v.',';
            }
            $arr = rtrim($arr, ",");
            $data['business_scope'] = $arr;

            $data['add_uid'] = $id;
            $data['add_name'] = $name;
            $data['add_time'] = time();
            // var_dump($data);exit;
            $save = M('supplier_list')->where(array('id'=>$sup_id))->save($data);
            if ($save) {

                $this->success('更新供应商成功',U('Off/supplier_list_news'));
            } else {
                $this->error('更新供应商失败',U('Off/supplier_edit',array('id'=>$sup_id)));
            }

        } else {
            $id = I('get.id');

            //查询供应商信息
            $supplier = M('supplier_list')->where(array('id'=>$id))->find();
            //处理经营范围数据
            $supplier['scope_list'] = explode(',',$supplier['business_scope']);
            // var_dump($supplier);
            //
            //处理上传文件
            $arr1 = explode(';',$supplier['pic_info']);
            $pic_arr = array();
            foreach ($arr1 as $ke => $val) {
                $path = explode(',',$val);
                $pic_arr[$ke] = $path[0].'/'.$path[1];
            }
            $supplier['pic_arr'] = $pic_arr;
            //查询分类信息
            $type_array = M('off_type1')->where(array('status'=>1))->select();
            // var_dump($supplier);exit;
            $this->assign('supplier',$supplier);
            $this->assign('type_array',$type_array);
            $this->display();
        }
    }


    //供应商删除
    public function supplier_delete(){
        $sup_id = I('post.id');
        $re = D('supplier_list')->where(array('id'=>$sup_id))->delete();

        //删除对应的商品信息 commodity_list
        $res = D('commodity_list')->where(array('sup_id'=>$sup_id))->delete();

        if ($re) {
            echo 1;
        } else {
            echo 2;
        }

    }


    /**
     * 供应商表格数据导入
     * 第一步上传表格
     */
    public function supplier_import_step(){
        //导航设置
        $breadcrumb_diy = array(
            array('固定资产','#'),
            array('供应商管理',U('supplier_list_news')),
            array('批量导入','#'),
        );
        $model = new OffModel();
        // $this->assign('village_list',$model->get_village_list());
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }

    /**
     * 第二步将表格数据表格化
     */
    public function supplier_import_step1(){
        //导航设置
        $breadcrumb_diy = array(
            array('固定资产','#'),
            array('供应商管理',U('supplier_list_news')),
            array('批量导入','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        //获取社区名
        $model = new OffModel();
        $file = $_FILES['test'];
        // $village_id = session('system.village_id');
        // $village_name = $model->get_village_list()[$village_id];

        if($file){
            //导入数据
            $list = $model->supplier_excel_to_data($file);
            $this->assign_json('list',$list);
            // $this->assign_json('selected_village_id',$village_id);
            // $this->assign_json('selected_village_name',$village_name);
            // $this->assign('selected_village_name',$village_name);
            $this->display();
        }else{
            $this->error("文件格式错误",U('supplier_import_step'));
        }

    }

    /**
     * 第三步导入数据
     */
    public function supplier_import_step2(){
        $data = $_POST;
        $village_id = $_SESSION['system']['village_id'];
        // var_dump($village_id);exit();
        $data['data'] = json_decode(htmlspecialchars_decode($data['data']),true);
        $model = new OffModel();
        $re = $model->insert_supplier_data_to_database($data['data'],$village_id);
        if($re){
            return $this->success("操作成功","",$data);
        }else{
            $error = $model->get_import_error();
            return $this->error($error['msg'],"",$error['data']);
        }

    }


    //供应商商品管理
    public function supplier_goods_list(){
        //获取供应商id
        $id = I('get.id');
        setcookie("sup_id",$id,time()+3600);
        $this->assign('id',$id);

        //查询条件
        if ($id) {
            $where['sup_id'] = $id;
        }
        $where['status'] = 1;

        //查询所有供应商商品信息
        $commodity_list = M('commodity_list')->where($where)->select();

        //数据处理
        foreach ($commodity_list as $ke => $val) {
            //处理经营分类
            $type = $val['type'];
            $type_info = M('off_type1')->where(array('id'=>$type))->find();
            $commodity_list[$ke]['type_name'] = $type_info['info'];

            //处理经营商
            $sup_id = $val['sup_id'];
            $supplier = M('supplier_list')->where(array('id'=>$sup_id))->find();
            $commodity_list[$ke]['sup_name'] = $supplier['sup_unit'];
        }

        //查询所有供应商信息
        $supplier_list = M('supplier_list')->field('id,sup_unit')->where(array('status'=>1))->select();

        $this->assign('commodity_list',$commodity_list);
        $this->assign('supplier_list',$supplier_list);
        $this->display();
    }


    //供应商商品添加
    public function supplier_goods_add() {
        if ($_POST) {

            //获取数据
            $data = $_POST;

            $id = $_SESSION['system']['id'];
            $name = M('admin')->where(array('id'=>$id))->find()['realname'];

            $data['add_uid'] = $id;
            $data['add_name'] = $name;
            $data['add_time'] = time();
            $data['status'] = 1;
            // var_dump($data);exit;
            $add = M('commodity_list')->add($data);

            if ($add) {

                $this->success('添加供应商商品成功',U('Off/supplier_goods_list'));
            } else {
                $this->error('添加供应商商品失败',U('Off/supplier_goods_add'));
            }

        } else {

            //查询分类信息
            $type_array = M('off_type1')->where(array('status'=>1))->select();
            //查询所有供应商信息
            $sup_array = M('supplier_list')->field('id,sup_unit')->where(array('status'=>1))->select();

            $this->assign('type_array',$type_array);
            $this->assign('sup_array',$sup_array);
            $this->display();
        }

    }


    //供应商商品更新
    public function supplier_goods_edit() {
        if ($_POST) {

            //获取数据
            $data = $_POST;

            //供应商id
            $goods_id = $data['id'];
            unset($data['id']);

            $id = $_SESSION['system']['id'];
            $name = M('admin')->where(array('id'=>$id))->find()['realname'];

            $data['add_uid'] = $id;
            $data['add_name'] = $name;
            $data['add_time'] = time();
            $data['status'] = 1;
            // var_dump($data);exit;
            $add = M('commodity_list')->where(array('id'=>$goods_id))->save($data);

            if ($add) {

                $this->success('更新供应商商品成功',U('Off/supplier_goods_list'));
            } else {
                $this->error('更新供应商商品失败',U('Off/supplier_goods_edit',array('id'=>$goods_id)));
            }

        } else {
            $id = I('get.id');

            //查询商品信息
            $goods = M('commodity_list')->where(array('id'=>$id))->find();
            //查询分类信息
            $type_array = M('off_type1')->where(array('status'=>1))->select();
            //查询所有供应商信息
            $sup_array = M('supplier_list')->field('id,sup_unit')->where(array('status'=>1))->select();

            $this->assign('goods',$goods);
            $this->assign('type_array',$type_array);
            $this->assign('sup_array',$sup_array);
            $this->display();
        }
    }


    //供应商商品删除
    public function supplier_goods_delete(){
        $goods_id = I('post.id');
        $re = D('commodity_list')->where(array('id'=>$goods_id))->delete();
        if ($re) {
            echo 1;
        } else {
            echo 2;
        }

    }


    /**supplier
     * 供应商表格数据导入
     * 第一步上传表格
     */
    public function supplier_goods_import_step(){
        //导航设置
        $breadcrumb_diy = array(
            array('固定资产','#'),
            array('供应商管理',U('supplier_list_news')),
            array('供应商商品信息表',U('supplier_goods_list')),
            array('批量导入','#'),
        );
        $model = new OffModel();
        // $this->assign('village_list',$model->get_village_list());
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }

    /**
     * 第二步将表格数据表格化
     */
    public function supplier_goods_import_step1(){
        //导航设置
        $breadcrumb_diy = array(
            array('固定资产','#'),
            array('供应商管理',U('supplier_list_news')),
            array('供应商商品信息表',U('supplier_goods_list')),
            array('批量导入','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        //获取社区名
        $model = new OffModel();
        $file = $_FILES['test'];
        // $village_id = session('system.village_id');
        // $village_name = $model->get_village_list()[$village_id];

        if($file){
            //导入数据
            $list = $model->supplier_goods_excel_to_data($file);
            $this->assign_json('list',$list);
            // $this->assign_json('selected_village_id',$village_id);
            // $this->assign_json('selected_village_name',$village_name);
            // $this->assign('selected_village_name',$village_name);
            $this->display();
        }else{
            $this->error("文件格式错误",U('supplier_goods_import_step'));
        }

    }

    /**
     * 第三步导入数据
     */
    public function supplier_goods_import_step2(){
        $data = $_POST;
        $village_id = $_SESSION['system']['village_id'];
        // var_dump($village_id);exit();
        $data['data'] = json_decode(htmlspecialchars_decode($data['data']),true);
        $model = new OffModel();
        $re = $model->insert_supplier_goods_data_to_database($data['data'],$village_id);
        if($re){
            return $this->success("操作成功","",$data);
        }else{
            $error = $model->get_import_error();
            return $this->error($error['msg'],"",$error['data']);
        }

    }


    //库存管理
    public function inventory_list_news(){

        //查询所有供应商商品信息
        $inventory_list = M('inventory_list')->where($where)->select();

        //数据处理
        foreach ($inventory_list as $ke => $val) {
            //处理商品名称
            $goods_id = $val['goods_id'];
            $commodity = M('commodity_list')->where(array('id'=>$goods_id))->find();
            $inventory_list[$ke]['goods_name'] = $commodity['goods_name'];
            $inventory_list[$ke]['specification'] = $commodity['specification'];

            //处理经营分类
            $type = $val['type'];
            $type_info = M('off_type1')->where(array('id'=>$type))->find();
            $inventory_list[$ke]['type_name'] = $type_info['info'];

            //处理经营商
            $sup_id = $val['sup_id'];
            $supplier = M('supplier_list')->where(array('id'=>$sup_id))->find();
            $inventory_list[$ke]['sup_name'] = $supplier['sup_unit'];
        }

        //查询所有供应商信息
        $supplier_list = M('supplier_list')->field('id,sup_unit')->where(array('status'=>1))->select();

        $this->assign('inventory_list',$inventory_list);
        $this->assign('supplier_list',$supplier_list);
        $this->display();
    }


    //供应商商品添加
    public function inventory_add() {
        if ($_POST) {

            //获取数据
            $data = $_POST;

            $id = $_SESSION['system']['id'];
            $name = M('admin')->where(array('id'=>$id))->find()['realname'];

            //处理商品id
            $commodity = M('commodity_list')->where(array('goods_name'=>$data['goods_name'],'specification'=>$data['specification']))->find();
            $data['goods_id'] = $commodity['id'];
            $data['add_uid'] = $id;
            $data['add_name'] = $name;
            $data['add_time'] = time();
            $data['status'] = 1;
            // var_dump($data);exit;
            $add = M('inventory_list')->add($data);

            if ($add) {

                $this->success('添加库存商品成功',U('Off/inventory_list_news'));
            } else {
                $this->error('添加库存商品失败',U('Off/inventory_add'));
            }

        } else {

            //查询分类信息
            $type_array = M('off_type1')->where(array('status'=>1))->select();
            //查询所有供应商信息
            $sup_array = M('supplier_list')->field('id,sup_unit')->where(array('status'=>1))->select();

            $this->assign('type_array',$type_array);
            $this->assign('sup_array',$sup_array);
            $this->display();
        }

    }


    //供应商商品更新
    public function inventory_edit() {
        if ($_POST) {

            //获取数据
            $data = $_POST;

            //供应商id
            $goods_id = $data['id'];
            unset($data['id']);

            $id = $_SESSION['system']['id'];
            $name = M('admin')->where(array('id'=>$id))->find()['realname'];

            //处理商品id
            $commodity = M('commodity_list')->where(array('goods_name'=>$data['goods_name'],'specification'=>$data['specification']))->find();
            $data['goods_id'] = $commodity['id'];
            $data['add_uid'] = $id;
            $data['add_name'] = $name;
            $data['add_time'] = time();
            $data['status'] = 1;
            // var_dump($data);exit;
            $add = M('inventory_list')->where(array('id'=>$goods_id))->save($data);

            if ($add) {

                $this->success('更新库存商品成功',U('Off/inventory_list_news'));
            } else {
                $this->error('更新库存商品失败',U('Off/inventory_edit',array('id'=>$goods_id)));
            }

        } else {
            $id = I('get.id');

            //查询商品信息
            $inventory = M('inventory_list')->where(array('id'=>$id))->find();
            //处理商品数据
            $commodity = M('commodity_list')->where(array('id'=>$inventory['goods_id']))->find();
            $inventory['goods_name'] = $commodity['goods_name'];
            $inventory['specification'] = $commodity['specification'];

            //查询分类信息
            $type_array = M('off_type1')->where(array('status'=>1))->select();
            //查询所有供应商信息
            $sup_array = M('supplier_list')->field('id,sup_unit')->where(array('status'=>1))->select();

            $this->assign('inventory',$inventory);
            $this->assign('type_array',$type_array);
            $this->assign('sup_array',$sup_array);
            $this->display();
        }
    }


    //供应商商品删除
    public function inventory_delete(){
        $goods_id = I('post.id');
        $re = D('inventory_list')->where(array('id'=>$goods_id))->delete();
        if ($re) {
            echo 1;
        } else {
            echo 2;
        }

    }


    /**supplier
     * 供应商表格数据导入
     * 第一步上传表格
     */
    public function inventory_import_step(){
        //导航设置
        $breadcrumb_diy = array(
            array('固定资产','#'),
            array('库存信息列表',U('inventory_list_news')),
            array('批量导入','#'),
        );
        $model = new OffModel();
        // $this->assign('village_list',$model->get_village_list());
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }

    /**
     * 第二步将表格数据表格化
     */
    public function inventory_import_step1(){
        //导航设置
        $breadcrumb_diy = array(
            array('固定资产','#'),
            array('库存信息列表',U('inventory_list_news')),
            array('批量导入','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        //获取社区名
        $model = new OffModel();
        $file = $_FILES['test'];
        // $village_id = session('system.village_id');
        // $village_name = $model->get_village_list()[$village_id];

        if($file){
            //导入数据
            $list = $model->inventory_excel_to_data($file);
//            dump($list);die;
            $this->assign_json('list',$list);
            // $this->assign_json('selected_village_id',$village_id);
            // $this->assign_json('selected_village_name',$village_name);
            // $this->assign('selected_village_name',$village_name);
            $this->display();
        }else{
            $this->error("文件格式错误",U('inventory_import_step'));
        }

    }

    /**
     * 第三步导入数据
     */
    public function inventory_import_step2(){
        $data = $_POST;
        $village_id = $_SESSION['system']['village_id'];
        // var_dump($village_id);exit();
        $data['data'] = json_decode(htmlspecialchars_decode($data['data']),true);
        $model = new OffModel();
        $re = $model->insert_inventory_data_to_database($data['data'],$village_id);
        if($re){
            return $this->success("操作成功","",$data);
        }else{
            $error = $model->get_import_error();
            return $this->error($error['msg'],"",$error['data']);
        }

    }


    //库存管理
    public function inventory_turnover_list(){

        //查询所有供应商商品信息
        $inventory_list = M('inventory_turnover_list')->select();

        //数据处理
        foreach ($inventory_list as $ke => $val) {
            //处理商品名称
            $goods_id = $val['goods_id'];
            $commodity = M('commodity_list')->where(array('id'=>$goods_id))->find();
            $inventory_list[$ke]['goods_name'] = $commodity['goods_name'];
            $inventory_list[$ke]['specification'] = $commodity['specification'];

        }

        //查询所有供应商信息
        $supplier_list = M('supplier_list')->field('id,sup_unit')->where(array('status'=>1))->select();

        $this->assign('inventory_list',$inventory_list);
        $this->assign('supplier_list',$supplier_list);
        $this->display();
    }


    //供应商商品添加
    public function inventory_turnover_add() {
        if ($_POST) {

            //获取数据
            $data = $_POST;

            $id = $_SESSION['system']['id'];
            $name = M('admin')->where(array('id'=>$id))->find()['realname'];

            //处理商品id
            $commodity = M('commodity_list')->where(array('goods_name'=>$data['goods_name'],'specification'=>$data['specification']))->find();
            $data['goods_id'] = $commodity['id'];
            $data['add_uid'] = $id;
            $data['add_name'] = $name;
            $data['add_time'] = time();
            $data['status'] = 1;
            // var_dump($data);exit;
            $add = M('inventory_turnover_list')->add($data);

            if ($add) {

                $this->success('添加进出库商品成功',U('Off/inventory_turnover_list'));
            } else {
                $this->error('添加进出库商品失败',U('Off/inventory_add'));
            }

        } else {

            //查询分类信息
            $type_array = M('off_type1')->where(array('status'=>1))->select();
            //查询所有供应商信息
            $sup_array = M('supplier_list')->field('id,sup_unit')->where(array('status'=>1))->select();

            $this->assign('type_array',$type_array);
            $this->assign('sup_array',$sup_array);
            $this->display();
        }

    }


    //供应商商品更新
    public function inventory_turnover_edit() {
        if ($_POST) {

            //获取数据
            $data = $_POST;

            //供应商id
            $goods_id = $data['id'];
            unset($data['id']);

            $id = $_SESSION['system']['id'];
            $name = M('admin')->where(array('id'=>$id))->find()['realname'];

            //处理商品id
            $commodity = M('commodity_list')->where(array('goods_name'=>$data['goods_name'],'specification'=>$data['specification']))->find();
            $data['goods_id'] = $commodity['id'];
            $data['add_uid'] = $id;
            $data['add_name'] = $name;
            $data['add_time'] = time();
            $data['status'] = 1;
            // var_dump($data);exit;
            $add = M('inventory_turnover_list')->where(array('id'=>$goods_id))->save($data);

            if ($add) {

                $this->success('更新进出库商品成功',U('Off/inventory_turnover_list'));
            } else {
                $this->error('更新进出库商品失败',U('Off/inventory_turnover_edit',array('id'=>$goods_id)));
            }

        } else {
            $id = I('get.id');

            //查询商品信息
            $inventory = M('inventory_turnover_list')->where(array('id'=>$id))->find();
            //处理商品数据
            $commodity = M('commodity_list')->where(array('id'=>$inventory['goods_id']))->find();
            $inventory['goods_name'] = $commodity['goods_name'];
            $inventory['specification'] = $commodity['specification'];

            //查询分类信息
            $type_array = M('off_type1')->where(array('status'=>1))->select();
            //查询所有供应商信息
            $sup_array = M('supplier_list')->field('id,sup_unit')->where(array('status'=>1))->select();

            $this->assign('inventory',$inventory);
            $this->assign('type_array',$type_array);
            $this->assign('sup_array',$sup_array);
            $this->display();
        }
    }


    //供应商商品删除
    public function inventory_turnover_delete(){
        $goods_id = I('post.id');
        $re = D('inventory_turnover_list')->where(array('id'=>$goods_id))->delete();
        if ($re) {
            echo 1;
        } else {
            echo 2;
        }

    }


    /**supplier
     * 供应商表格数据导入
     * 第一步上传表格
     */
    public function inventory_turnover_import_step(){
        //导航设置
        $breadcrumb_diy = array(
            array('固定资产','#'),
            array('库存信息列表',U('inventory_list_news')),
            array('进出库信息列表',U('inventory_turnover_list')),
            array('批量导入','#'),
        );
        $model = new OffModel();
        // $this->assign('village_list',$model->get_village_list());
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }

    /**
     * 第二步将表格数据表格化
     */
    public function inventory_turnover_import_step1(){
        //导航设置
        $breadcrumb_diy = array(
            array('固定资产','#'),
            array('库存信息列表',U('inventory_list_news')),
            array('进出库信息列表',U('inventory_turnover_list')),
            array('批量导入','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        //获取社区名
        $model = new OffModel();
        $file = $_FILES['test'];
        // $village_id = session('system.village_id');
        // $village_name = $model->get_village_list()[$village_id];

        if($file){
            //导入数据
            $list = $model->inventory_turnover_excel_to_data($file);
            $this->assign_json('list',$list);
            // $this->assign_json('selected_village_id',$village_id);
            // $this->assign_json('selected_village_name',$village_name);
            // $this->assign('selected_village_name',$village_name);
            $this->display();
        }else{
            $this->error("文件格式错误",U('inventory_import_step'));
        }

    }

    /**
     * 第三步导入数据
     */
    public function inventory_turnover_import_step2(){
        $data = $_POST;
        $village_id = $_SESSION['system']['village_id'];
        // var_dump($village_id);exit();
        $data['data'] = json_decode(htmlspecialchars_decode($data['data']),true);
        $model = new OffModel();
        $re = $model->insert_inventory_turnover_data_to_database($data['data'],$village_id);
        if($re){
            return $this->success("操作成功","",$data);
        }else{
            $error = $model->get_import_error();
            return $this->error($error['msg'],"",$error['data']);
        }

    }


    //获取物品申请订单
    public function get_order() {

        //获取数据
        $data = $_POST;
        // var_dump($data);
        $goods_array = array();
        foreach ($data['id'] as $k => $v) {
            $goods = M('commodity_list')->field('id,goods_name,specification,unit')->where(array('id'=>$v))->find();
            $goods_array[] = $goods;
        }
        // var_dump($goods_array);

        $td_list = '';
        //拼接OPTION字符串
        foreach ($goods_array as $value){
            $td_list .= '<tr>';
            // $td_list .= '<td>
            //                 <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
            //                     <input type="checkbox" class="checkboxes" value="'.$value['id'].'" />
            //                     <span></span>
            //                 </label>
            //             </td>';
            $td_list .= '<td align="center">'.$value['goods_name'].'</td>';
            $td_list .= '<td align="center">'.$value['specification'].'</td>';
            $td_list .= '<td align="center">'.$value['unit'].'</td>';
            $td_list .= '<td align="center"><input type="number" name="count_'.$value['id'].'" value="1"/></td>';
            $td_list .= '<td align="center"><a onclick="delete_tr_info(this)" id="'.$value['id'].'">
                             删除 </a></td>';
            $td_list .= '</tr>';

        }
        // var_dump($td_list);
        // $goods_array = json_encode($goods_array);
        // echo $goods_array;
        echo $td_list;

    }


    //处理订单提交
    public function save_order() {

        //获取数据
        $data = $_POST;
        //查询上传人员信息
        $id = $_SESSION['system']['id'];
        $name = M('admin')->where(array('id'=>$id))->find()['realname'];

        // var_dump($data);
        //处理提交的数据
        $info = explode('&amp;', $data['data']);
        // var_dump($info);exit;

        $order_arr = array();
        // $i = 0;
        foreach ($info as $k => $v) {
            $str = explode('=', $v);
            $str1 = explode('_', $str[0]);

            $order_arr[$k]['id'] = $str1[1];
            $order_arr[$k]['count'] = $str[1];
            // $i++;
        }
        // var_dump($order_arr);exit;
        $order_arr = json_encode($order_arr);

        //入表数据
        $arr = array(
            'info' => $order_arr,
            'status' => 1,
            'add_uid' => $id,
            'add_name' => $name,
            'add_time' => time(),
            'storage' => 0,
        );
        $add = M('goods_apply_list')->add($arr);
        // if ($add) {

        //     $this->success('提交物品订单成功',U('Off/supplier_goods_list'));
        // } else {
        //     $this->error('提交物品订单失败',U('Off/supplier_goods_list'));
        // }
        if ($add) {
            echo 1;
        } else {
            echo 2;
        }
    }


    //物品申请管理
    public function goods_apply_list_news(){
        $status = I('get.status');
        if ($status) {
            $where['status'] = $status;
            $this->assign('status',$status);
        }

        //查询所有物品申请信息
        $apply_list = M('goods_apply_list')->where($where)->select();

        //数据处理
        foreach ($apply_list as $k => $v) {
            //订单人信息处理
            $admin = M('admin')->where(array('id'=>$v['add_uid']))->find();
            $village_name = M('house_village')->where(array('village_id'=>$admin['village_id']))->find()['village_name'];
            $company_name = M('company')->where(array('company_id'=>$admin['company_id']))->find()['company_name'];
            $deptname = M('department')->where(array('id'=>$admin['department_id']))->find()['deptname'];
            $apply_list[$k]['village_name'] = $village_name;
            $apply_list[$k]['company_name'] = $company_name;
            $apply_list[$k]['deptname'] = $deptname;

        }
        // var_dump($apply_list);exit;

        $this->assign('apply_list',$apply_list);
        $this->display();
    }


    //获取申请物品详情
    public function get_goods_detail(){
        //获取物品申请id
        $id = I('post.id');
        setcookie("order_id",$id,time()+3600);
        //查询物品申请信息
        $order = M('goods_apply_list')->where(array('id'=>$id))->find();
        //物品信息处理
        $info = json_decode($order['info'],true);
        // var_dump($order);exit;
        $total = '';
        $td_list = '';
        foreach ($info as $ke => $val) {
            $good = M('commodity_list')->field('goods_name,specification,unit,price')->where(array('id'=>$val['id']))->find();
            // var_dump($good);
            $subtotal = (int)$val['count']*(int)$good['price'];
            // $info[$ke]['goods_name'] = $good['goods_name'];
            // $info[$ke]['specification'] = $good['specification'];
            // $info[$ke]['price'] = $good['price'];
            // $goods[$ke]['total'] = $total;
            $total += $subtotal;

            //查询库存数量
            $num = M('inventory_list')->field('count')->where(array('goods_id'=>$val['id']))->find()?:0;
            // $info[$ke]['num'] = $num;

            $td_list .= '<tr>';
            $td_list .= '<td align="center">'.$good['goods_name'].'</td>';
            $td_list .= '<td align="center">'.$good['specification'].'</td>';
            $td_list .= '<td align="center">'.$good['unit'].'</td>';
            $td_list .= '<td align="center">'.$good['price'].'</td>';
            $td_list .= '<td align="center">'.$val['count'].'</td>';
            $td_list .= '<td align="center">'.$subtotal.'</td>';
            if ($num < $val['count']) {
                $td_list .= '<td align="center" style="color: red;">'.$num.'</td>';
            } else {
                $td_list .= '<td align="center">'.$num.'</td>';
            }
            $td_list .= '</tr>';

        }
        $td_list .= '<tr><td colspan="7">物品总价：'.$total.'元</td></tr>';

        echo $td_list;

    }


    //修改订单状态
    public function update_apply_status(){
        $order_id = $_COOKIE['order_id'];
        $status = I('post.status');

        // var_dump($order_id);
        // var_dump($status);exit;
        $data = array(
            'status' => $status,
            'up_uid' => $_SESSION['system']['id'],
            'up_time' => time(),
        );
        $re = M('goods_apply_list')->where(array('id'=>$order_id))->save($data);
        if ($re) {
            echo 1;
        } else {
            echo 2;
        }
    }


    /*
     *订单是否出库
     */
    public function order_storage(){
        $id = I('post.order_id');
        $storage = I('post.storage');
        if ($storage == 0) {//终止
            $data=array('storage'=>1);
            $re=M('goods_apply_list')->where(array('id'=>$id))->data($data)->save();
            echo $re;
        } else {//正常
            $data=array('storage'=>0);
            $re=M('goods_apply_list')->where(array('id'=>$id))->data($data)->save();
            echo $re;
        }
    }


    //自定义二维码管理
    public function products_custom_list(){
        $cusArr = D('off_custom_qrcode')
            ->where(array('direction'=>0))
            ->order('cid desc')
            ->select();
        foreach ($cusArr as &$v) {
            $cid = $v['cid'];
            //被领取数量
            $r_num = D('off_products_ercode')->where(array('type'=>2,'cid'=>$cid,'receive'=>1))->count();
            $v['r_num'] = $r_num?:0;
        }
        $this->assign('cusArr',$cusArr);
        $this->display();
    }


    //自定义二维码管理
    public function products_qrcode_list(){
        $cid = I('get.cid');
        $cid_info=D('off_custom_qrcode')->where(array('cid'=>$cid))->find();
        $page_num=ceil($cid_info['num']/1000);
        /*$qrArr = D('off_products_ercode')->alias('er')
            ->field('er.*,p.pro_name,p.pro_price,p.band')
            ->join('left join __OFF_PRODUCTS__ p on p.pro_code = er.pro_code')
            ->join('left join __OFF_CUSTOM_QRCODE__ cq on cq.cid = er.cid')
            ->where(array('er.type'=>2,'er.cid'=>$cid))
            ->select();*/
//        echo M()->_sql();exit;
//        dump($qrArr);exit;
        $this->assign('page_num',$page_num);
        $this->assign('cid',$cid);
        $this->assign('qrArr',$qrArr);
        $this->display();
    }

    /**
     * @author zhukeqin
     * ajax分页获取qrcode
     */
    public function ajax_qrcode_list(){
        $cid=I('get.cid');
        $start=I('post.start');
        $length=I('post.length');
        //datatable适配  -1则代表显示全部信息
        if($length==-1){
            unset($length);
        }
        $where=array('er.type'=>2,'er.cid'=>$cid);
        if(!empty($_POST['search']['value'])){
            $search_value='%'.$_POST['search']['value'].'%';
            $where['er.pro_qrcode|er.borrower|p.pro_name|p.pro_supplier']=array('like',$search_value);
        }
        if(!empty($length)){
            $list = D('off_products_ercode')->alias('er')
                ->field('er.*,p.pro_name,p.pro_price,p.band')
                ->join('left join __OFF_PRODUCTS__ p on p.pro_code = er.pro_code')
                ->join('left join __OFF_CUSTOM_QRCODE__ cq on cq.cid = er.cid')
                ->where($where)
                ->limit($start,$length)
                ->select();
        }else{
            $list = D('off_products_ercode')->alias('er')
                ->field('er.*,p.pro_name,p.pro_price,p.band')
                ->join('left join __OFF_PRODUCTS__ p on p.pro_code = er.pro_code')
                ->join('left join __OFF_CUSTOM_QRCODE__ cq on cq.cid = er.cid')
                ->where($where)
                ->select();
        }
        $list_dimcount = D('off_products_ercode')->alias('er')
            ->field('er.*,p.pro_name,p.pro_price,p.band')
            ->join('left join __OFF_PRODUCTS__ p on p.pro_code = er.pro_code')
            ->join('left join __OFF_CUSTOM_QRCODE__ cq on cq.cid = er.cid')
            ->where($where)
            ->count();
        $list_count= D('off_products_ercode')->where(array('cid'=>$cid))->count();
        //遍历数组 拼接HTML元素
        foreach ($list as $k=>$v) {
            if(empty($v['trans_time'])){
                $trans_time='';
            }else{
                $trans_time=date('Y-m-d H:i:s',$v['trans_time']);
            }
            $array=array(
                'check_id'=>'<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="checkboxes" value="'.$v['id'].'"><span></span></label>',
                'pro_qrcode'=>$v['pro_qrcode'],
                'pro_name'=>$v['pro_name'],
                'pro_price'=>$v['pro_price'],
                'band'=>$v['band'],
                'admin_name'=>'<input  type="text" style="border: none;text-align: center;height: 30px;" value="'.$v['borrower'].'"  onchange="txtblur(this,'.$v['id'].')"  />',
                'trans_time'=>$trans_time,
                'address'=>'<img src="'.$v['adress'].'" style="width: 40px;height: 40px;" onmouseover="big('.$v['id'].')" onmouseout="small()" id="henfan_'.$v['id'].'" />',
                'history'=>'<a href="'.U('Off/history_qrcode',array('id'=>$v['id'],'cid'=>$cid)).'">历史记录</a>',
                'download'=>'<a onclick="downloadIamge('.$v['id'].')">二维码下载</a>',
            );

            $list_reload[]=$array;
        }
        if(empty($list_reload)){
            $list_reload=array();
        }
        $result_array=array(
            'draw'=>intval(I('post.draw')),
            'recordsTotal'=>$list_count,
            'recordsFiltered'=>$list_dimcount,
            'data'=>$list_reload
        );
        echo json_encode($result_array);
    }

    public function history_qrcode(){
        $id = I('get.id');
        $qrArr = D('off_products_ercode')->where(array('id'=>$id))->find();
        $pro_qrcode = $qrArr['pro_qrcode'];
        $transmitArr = D('off_transmit')->where(array('pro_qrcode'=>$pro_qrcode))->order('transmit_id asc')->select();
        if (!empty($transmitArr)) {
            foreach ($transmitArr as $k=>&$v) {
                if ($k == 0) {
                    $time = $v['transmit_time'] - $v['zero_time'];
                    $s_date = date('Y-m-d H:i:s',$v['zero_time']);
                    $e_date = date('Y-m-d H:i:s',$v['transmit_time']);
                } else {
                    $time = $v['transmit_time'] - $transmitArr[$k-1]['transmit_time'];
                    $s_date = date('Y-m-d H:i:s',$transmitArr[$k-1]['transmit_time']);
                    $e_date = date('Y-m-d H:i:s',$v['transmit_time']);
                }
                $date = $this->Sec2Time($time);
                $v['tt_name'] = $v['old_name'];
                $v['s_date'] = $s_date;
                $v['e_date'] = $e_date;
                $v['xx_time'] = $date;
            }
            unset($v);
            $LastArr = end($transmitArr);
            $new_name = $LastArr['new_name'];
            $new_date = date('Y-m-d H:i:s',$LastArr['transmit_time']);

        } else {
            if ($qrArr['borrower']) {
                $new_name = $qrArr['borrower'];
                $new_date = date('Y-m-d H:i:s',$qrArr['trans_time']);
            } else {
                $this->assign('hello',1);
            }
        }

        if ($new_name) $this->assign('new_name',$new_name);
        if ($new_date) $this->assign('new_date',$new_date);

        $pro_id = $_GET['pro_id']?:0;
        $this->assign('pro_id',$pro_id);

        $cid = $_GET['cid']?:0;
        $this->assign('cid',$cid);

        $this->assign('pro_qrcode',$pro_qrcode);
        $this->assign('transmitArr',$transmitArr);
        $this->display();
    }


    public function web_history_qrcode(){
        $id = I('get.id');
        $qrArr = D('off_products_ercode')->where(array('id'=>$id))->find();
        $pro_qrcode = $qrArr['pro_qrcode'];
        $transmitArr = D('off_transmit')->where(array('pro_qrcode'=>$pro_qrcode))->order('transmit_id asc')->select();
        if (!empty($transmitArr)) {
            foreach ($transmitArr as $k=>&$v) {
                if ($k == 0) {
                    $s_date = date('Y-m-d H:i:s',$v['zero_time']);
                    $e_date = date('Y-m-d H:i:s',$v['transmit_time']);
                } else {
                    $s_date = date('Y-m-d H:i:s',$transmitArr[$k-1]['transmit_time']);
                    $e_date = date('Y-m-d H:i:s',$v['transmit_time']);
                }
                $v['tt_name'] = $v['old_name'];
                $v['s_date'] = $s_date;
                $v['e_date'] = $e_date;
            }
            unset($v);
            $LastArr = end($transmitArr);
            $new_name = $LastArr['new_name'];
            $new_date = date('Y-m-d H:i:s',$LastArr['transmit_time']);

        } else {
            if ($qrArr['borrower']) {
                $new_name = $qrArr['borrower'];
                $new_date = date('Y-m-d H:i:s',$qrArr['trans_time']);
            } else {
                $this->assign('hello',1);
            }
        }

        if ($new_name) $this->assign('new_name',$new_name);
        if ($new_date) $this->assign('new_date',$new_date);

        $this->assign('pro_qrcode',$pro_qrcode);
        $this->assign('transmitArr',$transmitArr);
        $this->display();
    }

    //将秒数转换为时间（年、天、小时、分、秒）
    function Sec2Time($time){
        if(is_numeric($time)){
            $t = '';
            $value = array(
                "years" => 0, "days" => 0, "hours" => 0,
                "minutes" => 0, "seconds" => 0,
            );
            if($time >= 31556926){
                $value["years"] = floor($time/31556926);
                $time = ($time%31556926);
                $t .= $value["years"] ."年";
            }
            if($time >= 86400){
                $value["days"] = floor($time/86400);
                $time = ($time%86400);
                $t .= $value["days"] ."天";
            }
            if($time >= 3600){
                $value["hours"] = floor($time/3600);
                $time = ($time%3600);
                $t .= $value["hours"] ."小时";
            }
            if($time >= 60){
                $value["minutes"] = floor($time/60);
                $time = ($time%60);
                $t .= $value["minutes"] ."分";
            }
            $value["seconds"] = floor($time);
            $t .= $value["seconds"]."秒";
            //return (array) $value;
//            $t=$value["years"] ."年". $value["days"] ."天"." ". $value["hours"] ."小时". $value["minutes"] ."分".$value["seconds"]."秒";
            Return $t;

        }else{
            return (bool) FALSE;
        }
    }

    //自定义二维码保存
    public function products_create_qrcode(){
        $num = I('post.num');
        $type=I('post.type');
        $time = time();
        $mission_log=new Mission_logModel();
        //ajax创建任务 zhukeqin
        if(!empty($num)&&!empty($type)) {
            if (empty($type)) {
                echo false;
                die;
            }
            //创建一条记录到custom表中
            $customArr = array();
            $customArr['create_name'] = $_SESSION['system']['realname'];
            $customArr['create_time'] = $time;
            $customArr['num'] = $num;
            $customArr['direction'] = 0;
            $cid = D('off_custom_qrcode')->add($customArr);
            $data=array(
                'now_num'=>0,
                'num'=>$num,
                'type'=>$type,
                'cid'=>$cid,
                'flag'=>'',
                'type'=>0,
            );
            $return=$mission_log->add_mission_one($data,'Off/products_create_qrcode');
            echo $return;
            die;
        }
        //执行任务 zhukeqin
        $log_id=I('get.log_id');
        if(!empty($log_id)){
            $return=$mission_log->get_mission_one($log_id);
            $num=$return['log_data']['num'];
            $type=$return['log_data']['type'];
            $cid=$return['log_data']['cid'];
            $now_num=$return['log_data']['now_num'];
            $log_flag=$return['log_data']['flag'];
            $status=$return['log_status'];
            //判断是否完成任务 zhukeqin
            if($status==2){
                if(!empty($log_flag)){
                    $this->success('当前任务已完成！其中以下条目出现问题:'.$log_flag,U('Off/products_custom_list'),60);
                    die;
                }else{
                    $this->success('当前任务已完成！',U('Off/products_custom_list'),1);
                    die;
                }
            }
            if ($cid) {
                $dir = date('Y-m-d',$time);
                $flag = array();
                $mt_rand = mt_rand(1000000,9999999);
                //保证字符串总长度 zhukeqin
                $digit=6-mb_strlen($type);
                //检查是否重复 zhukeqin
                while (file_exists("./upload/qrcode/".$dir."/".$type.$mt_rand.sprintf("%0".$digit."d" , '1').'.png')){
                    $mt_rand = mt_rand(1000000,9999999);
                }
                for ($x=$now_num+1,$i=1; $x<=$num; $x++,$i++) {
                    $k = sprintf("%0".$digit."d" , $x);
//                $qr_data['pro_qrcode'] = 'C'.$time.mt_rand(100,999).$k;
                    $qr_data['pro_qrcode'] = $type.$mt_rand.$k;
                    $qr_data['adress'] = "./upload/qrcode/".$dir."/".$qr_data['pro_qrcode'].'.png';
                    $qr_data['type'] = 2;
                    $qr_data['cid'] = $cid;
                    $qr_data['village_id'] = $this->village_id;
                    $re = D('off_products_ercode')->add($qr_data);
                    if ($re) {
                        $url =  C('WEB_DOMAIN') . '/wap.php?g=Wap&c=Off&a=products_qr_detail_C&pro_qrcode=' . $qr_data['pro_qrcode'];
                        $path = "./upload/qrcode/".$dir."/";
                        $this->get_qr($url,$path,$qr_data['pro_qrcode']);
                    } else {
                        if (!$re) $flag[] = $x;
                    }
                    //一次最多生成500个二维码 zhukeqin
                    if($i>=200){
                        break;
                    }

                }


                //计算出错误个数
                if (count($flag) > 1) {
                    $fStr = implode(',',$flag);
                } elseif(count($flag) == 1) {
                    $fStr = $flag[0];
                }
                if(!empty($fStr)) $flag .=','.$fStr;
                if($x>=$num){
                    $status=2;
                }else{
                    $status=1;
                }
                $log_data=array(
                    'now_num'=>$x,
                    'num'=>$num,
                    'type'=>$type,
                    'cid'=>$cid,
                    'flag'=>$flag,
                );
                $return=$mission_log->change_mission_one($log_id,$log_data,$status);
                if(empty($return)) {
                    $this->error('创建中途失败,已停止');
                }else{
                    $cache=$num>$x?$x:$num;
                    $this->success('当前已创建'.$cache.'个,总共需要创建'.$num.'个，创建过程中请不要离开本页面',U('Off/products_create_qrcode',array('log_id'=>$log_id)),1);
                    die;
                }
            } else {
                $this->error('您的操作有误！请重试');
            }
        }else{
            $this->error('您的操作有误！请重试');
        }


    }

    //二维码批量打印
    public function products_qrcode_pre() {
        $ids = I('post.ids');
        $idArr = explode(',',$ids);
        $data = array();
        foreach ($idArr as $k=>$v) {
            $erArr = D('off_products_ercode')->where(array('id'=>$ids,'type'=>2))->find();
            $data[$k]['adress'] = $erArr['adress'];
            $data[$k]['id'] = $v;
            $data[$k]['pro_qrcode'] = $erArr['pro_qrcode'];
        }
        $this->assign('data',$data);
        $this->display();
    }


    /**
     * 物品表格数据导入
     * 第一步上传表格
     */
    public function goods_import_step(){
        //导航设置
        $breadcrumb_diy = array(
            array('办公用品','#'),
            array('物品管理',U('off_list_news')),
            array('批量导入','#'),
        );
        $model = new OffModel();
        // $this->assign('village_list',$model->get_village_list());
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }

    /**
     * 第二步将表格数据表格化
     */
    public function goods_import_step1(){
        //导航设置
        $breadcrumb_diy = array(
            array('办公用品','#'),
            array('物品管理',U('off_list_news')),
            array('批量导入','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        //获取社区名
        $model = new OffModel();
        $file = $_FILES['test'];
        // $village_id = session('system.village_id');
        // $village_name = $model->get_village_list()[$village_id];

        if($file){
            //导入数据
            $list = $model->goods_excel_to_data($file);
            $this->assign_json('list',$list);
            // $this->assign_json('selected_village_id',$village_id);
            // $this->assign_json('selected_village_name',$village_name);
            // $this->assign('selected_village_name',$village_name);
            $this->display();
        }else{
            $this->error("文件格式错误",U('goods_import_step'));
        }

    }

    /**
     * 第三步导入数据
     */
    public function goods_import_step2(){
        $data = $_POST;
        $village_id = $_SESSION['system']['village_id'];
        // var_dump($village_id);exit();
        $data['data'] = json_decode(htmlspecialchars_decode($data['data']),true);
        $model = new OffModel();
        $re = $model->insert_goods_data_to_database($data['data'],$village_id);
        if($re){
            return $this->success("操作成功","",$data);
        }else{
            $error = $model->get_import_error();
            return $this->error($error['msg'],"",$error['data']);
        }

    }


    //物品添加
    public function products_add() {
        $typeArr = $this->get_type_all();
        $zone_list=$this->get_zone_all();
        $this->assign('zone_list',$zone_list);
        $this->assign('typeArr',$typeArr);
        $this->display();
    }


    //物品添加保存
    public function products_save() {
        //查询所属社区
        $village_id = $_SESSION['system']['village_id'];
        $logogram = D('house_village')->where(array('village_id'=>$village_id))->getField('logogram');//社区英文简称

        $data = $_POST;

        if ($_FILES['attachment_id']['size']) {
            $info = $this->upload();
            $data['attachment_name'] = $info[0]['name'];
            $data['attachment_id'] = $info[0]['savepath'].$info[0]['savename'];
        }
        $data['pro_creator'] = $_SESSION['system']['realname'];
        $data['create_time'] = time();
//        $data['pro_code'] = time().mt_rand(1000,9999);
        $data['purch_time'] = strtotime($data['purch_time']);//采购日期
        $data['village_id'] = $village_id;//采购日期
        $add = D('off_products')->add($data);
        if ($add) {
            $pro_code = $logogram.sprintf("%06d" , $add);
            D('off_products')->where(array('pro_id'=>$add))->save(array('pro_code'=>$pro_code));
            //生成二维码
            $proArr = D('off_products')->where(array('pro_id'=>$add))->find();
            $pro_code = $proArr['pro_code'];
            $pro_stock = $proArr['pro_stock']?$proArr['pro_stock']:0;
            $qr_data = array();
            $qr_data['pro_code'] = $pro_code;
            for ($x=1; $x<=$pro_stock; $x++) {
                $k = sprintf("%04d" , $x);
                $qr_data['pro_qrcode'] = $pro_code.$k;
                $qr_data['adress'] = "./upload/qrcode/".$add."/".$qr_data['pro_qrcode'].".png";
                $re = D('off_products_ercode')->add($qr_data);
                if ($re) {
                    $url =  C('WEB_DOMAIN') . '/admin.php?g=System&c=Off&a=products_qr_detail&pro_qrcode=' . $qr_data['pro_qrcode'];
                    $path = "./upload/qrcode/".$add."/";
                    $this->get_qr($url,$path,$qr_data['pro_qrcode']);
                }
            }
            $this->success('添加物品成功',U('Off/off_list_news'));
        } else {
            $this->error('添加物品失败',U('Off/products_add'));
        }
    }



    /**
     * 生成二维码链接 *并且不会生成本文件(更新后，生成本文件)
     * 注：之前不要有输出
     * @param $url 扫描后跳转地址
     * @param string $logo 二维码中间的logo图片地址 默认为汇得行的logo
     * @update-time: 2018-06-2 9:25
     * @author: 曾梦飞
     */
    function get_qr($url,$path,$xxx,$logo="./static/PropertyService/images/xx.png"){
        header("content-type:text/html;charset=utf-8");
        import('@.ORG.phpqrcode');
        // 生成的二维码所在目录+文件名

        if(!file_exists($path)){
            mkdir($path, 0777,true);//创建目录
        }
        $fileName = $path.$xxx.".png";

        $size = $_GET['size'] ? $_GET['size']: 27;
        ob_start();
        QRcode::png(htmlspecialchars_decode(urldecode($url)),false,0,$size,1);
        $QR = ob_get_contents();//截取缓冲区中的二维码图
        ob_end_clean();
        if ($logo !== FALSE) {
            $QR = imagecreatefromstring($QR);
            $logo = imagecreatefromstring(file_get_contents($logo));
            $QR_width = imagesx($QR);//二维码图片宽度
            $QR_height = imagesy($QR);//二维码图片高度
            $logo_width = imagesx($logo);//logo图片宽度
            $logo_height = imagesy($logo);//logo图片高度
            $logo_qr_width = $QR_width / 5;
            $scale = $logo_width/$logo_qr_width;
            $logo_qr_height = $logo_height/$scale;
            $from_width = ($QR_width - $logo_qr_width) / 2;
            //重新组合图片并调整大小
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        }
        //输出图片
        Header("Content-type: image/png");
        ImagePng($QR,$fileName);
        imagedestroy($QR);
        //文件调整dpi
        $file = file_get_contents($fileName);

        //数据块长度为9
        $len = pack("N", 9);
        //数据块类型标志为pHYs
        $sign = pack("A*", "pHYs");
        //X方向和Y方向的分辨率均为300DPI（1像素/英寸=39.37像素/米），单位为米（0为未知，1为米）
        $data = pack("NNC", 300 * 39.37, 300 * 39.37, 0x01);
        //CRC检验码由数据块符号和数据域计算得到
        $checksum = pack("N", crc32($sign . $data));
        $phys = $len . $sign . $data . $checksum;

        $pos = strpos($file, "pHYs");
        if ($pos > 0) {
            //修改pHYs数据块
            $file = substr_replace($file, $phys, $pos - 4, 21);
        } else {
            //IHDR结束位置（PNG头固定长度为8，IHDR固定长度为25）
            $pos = 33;
            //将pHYs数据块插入到IHDR之后
            $file = substr_replace($file, $phys, $pos, 0);
        }
        file_put_contents($fileName,$file);
    }

    //物品更新
    public function products_edit() {
        if (IS_POST) {
            $data = $_POST;
            if ($_FILES['attachment_id']['size']) {
                $info = $this->upload();
                $data['attachment_name'] = $info[0]['name'];
                $data['attachment_id'] = $info[0]['savepath'].$info[0]['savename'];
            }
            $pro_id = $data['pro_id'];
            $data['purch_time'] = strtotime($data['purch_time']);//采购日期
            unset($data['pro_id']);
            $pro_stock = $data['pro_stock'];
            $proArr = D('off_products')->where(array('pro_id'=>$pro_id))->find();
            $stock = $proArr['pro_stock'];
            if ($pro_stock < $stock) {
                $this->error('更新物品失败,库存不能改小',U('Off/products_edit',array('pro_id'=>$pro_id)));
            } elseif($pro_stock > $stock) {
                $c = $pro_stock-$stock;
                $qr_data = array();
                $qr_data['pro_code'] = $proArr['pro_code'];
                for ($x=1; $x<=$c; $x++) {
                    $h = $stock+$x;
                    $k = sprintf("%04d" , $h);
                    $qr_data['pro_qrcode'] = $proArr['pro_code'].$k;
                    $qr_data['adress'] = "./upload/qrcode/".$pro_id."/".$qr_data['pro_qrcode'].".png";
                    $re = D('off_products_ercode')->add($qr_data);
                    if ($re) {
                        $url =  C('WEB_DOMAIN') . '/admin.php?g=System&c=Off&a=products_qr_detail&pro_qrcode=' . $qr_data['pro_qrcode'];
                        $path = "./upload/qrcode/".$pro_id."/";
                        $this->get_qr($url,$path,$qr_data['pro_qrcode']);
                    }
                }
            }

            $re = D('off_products')->where(array('pro_id'=>$pro_id))->save($data);
            if ($re) {
//                $this->success('更新物品成功',U('Off/products_edit',array('pro_id'=>$pro_id)));
                $this->success('更新物品成功',U('Off/off_list_news'));
            } else {
                $this->error('更新物品失败',U('Off/products_edit',array('pro_id'=>$pro_id)));
            }
        } else {
            $pro_id = I('get.pro_id');
            $proArr = D('off_products')->where(array('pro_id'=>$pro_id))->find();
            $typeArr = $this->get_type_all();
            $zone_list=$this->get_zone_all();
            $this->assign('zone_list',$zone_list);
            $this->assign('typeArr',$typeArr);
            $this->assign('proArr',$proArr);
            $this->display();
        }

    }

    //物品删除
    public function products_delete(){
        $pro_id = I('post.pro_id');
        $re = D('off_products')->where(array('pro_id'=>$pro_id))->save(array('is_del'=>1));
        if ($re) {
            echo 1;
        } else {
            echo 2;
        }

    }

    //物品二维码展示
    public function products_qr_code(){
        $pro_id = I('get.pro_id');
        $proArr = D('off_products')->field("pro_name,pro_code")->where(array('pro_id'=>$pro_id))->find();
        $codeArr = D('off_products_ercode')->where(array('pro_code'=>$proArr['pro_code']))->select();
        foreach ($codeArr as &$v) {
            $v['url'] =  C('WEB_DOMAIN') . '/admin.php?g=System&c=Off&a=products_qr_detail&pro_qrcode=' . $v['pro_qrcode'];
            $v['qr_img'] =  U('QR') . '&url=' . urlencode($v['url']);
            $v['uni'] =  ltrim(substr($v['pro_qrcode'],-4),0);
        }

        $this->assign('codeArr',$codeArr);
        $this->assign('proArr',$proArr);
        $this->display();
    }

    //物品管理
    // public function products_operate_list(){
    //     // $pro_id = I('get.pro_id');
    //     // $proArr = array();
    //     $codeArray = D('off_products')
    //         ->alias('p')
    //         ->field(array('p.*','e.pro_qrcode','e.adress','e.borrower','e.trans_time','e.id'))
    //         ->join('LEFT JOIN __OFF_PRODUCTS_ERCODE__ e ON e.pro_code=p.pro_code')
    //         ->where(array('is_del'=>0))
    //         ->select();
    //     // var_dump(M()->_sql());
    //     // var_dump($proArr);die();
    //     // $codeArray = array();
    //     // foreach ($proArr as  $value) {
    //     //     $codeArr = D('off_products_ercode')
    //     //         ->field('*')
    //     //         ->where(array('pro_code'=>$value['pro_code']))
    //     //         ->order('id desc')
    //     //         ->select();
    //     //     $codeArray[] = $codeArr;
    //     // }
    //     // var_dump($proArr);
    //     // var_dump($codeArray);die();
    //     foreach ($codeArray as &$v) {
    //         $v['uni'] =  ltrim(substr($v['pro_qrcode'],-4),0);
    //     }
    //     // $this->assign('pro_id',$pro_id);
    //     $this->assign('codeArray',$codeArray);
    //     // $this->assign('proArr',$proArr);
    //     $this->display();
    // }


    //物品管理
    public function products_operate(){

        //下拉框项目数据
        $model = new OffModel();
        $villageStr = $model->get_village_list();
        $villageArray = array();
        foreach ($villageStr as $k => $v) {
            $villageArray[$k]['village_id'] = $k;
            $villageArray[$k]['village_name'] = $v;
        }

        //获取下拉框选中项目id
        $villageId = I('get.villageId');
        $pro_id = I('get.pro_id');
        $proArr = D('off_products')->where(array('pro_id'=>$pro_id))->find();
        if ($villageId) {
            $codeArr = D('off_products_ercode')
                ->alias('er')
                ->field('er.*,v.village_name')
                ->join('left join __HOUSE_VILLAGE__ v on v.village_id = er.village_id')
                ->where(array('er.pro_code'=>$proArr['pro_code'],'er.receive'=>1,'er.village_id'=>$villageId))
                ->order('er.id desc')
                ->select();
        } else {
            $codeArr = D('off_products_ercode')
                ->alias('er')
                ->field('er.*,v.village_name')
                ->join('left join __HOUSE_VILLAGE__ v on v.village_id = er.village_id')
                ->where(array('er.pro_code'=>$proArr['pro_code'],'er.receive'=>1))
                ->order('er.id desc')
                ->select();
        }

        //获取搜索框内容
        $borrower = I('post.search_borrower');
        if ($borrower) {
            $codeArr = D('off_products_ercode')->alias('er')
                ->field(array('er.*','p.pro_name','p.band','p.pro_price'))
                ->join('left join __OFF_PRODUCTS__ p on p.pro_code = er.pro_code')
                // ->join('left join __OFF_TYPE__ t on t.id=p.off_pro_type')
                ->where(array('borrower'=>$borrower))
                ->order('id desc')
                ->select();
        }
        $this->assign('borrower',$borrower);
        // var_dump(M()->_sql());
        // var_dump($codeArr);exit();
        foreach ($codeArr as &$v) {
            $v['uni'] =  ltrim(substr($v['pro_qrcode'],-4),0);
        }
        $this->assign('villageId',$villageId);
        $this->assign('villageArray',$villageArray);
        $this->assign('pro_id',$pro_id);
        $this->assign('codeArr',$codeArr);
        $this->assign('proArr',$proArr);
        $this->display();
    }


    //aJax领取
    public function products_operate_save(){
        $id = I('post.id');
        $borrower = I('post.borrower');
        $time = time();
        //是否是第一次领取
        $recArr = D('off_products_ercode')->where(array('id'=>$id))->find();
        //不是第一次领取就加入transmit表存到数据库
        if ($recArr['receive'] == 1 && $recArr['borrower']) {
            $pro_qrcode = $recArr['pro_qrcode'];
            $rec = D('off_transmit')->where(array('pro_qrcode'=>$pro_qrcode))->find();
            $transmitArr = array();
            //是否首次转交
            if ($rec) {
                //不是
                $transmitArr['zero_time'] = $rec['zero_time'];
            } else {
                //第一次转交
                $transmitArr['zero_time'] = $recArr['trans_time'];
            }
            $transmitArr['old_name'] = $recArr['borrower'];
            $transmitArr['new_name'] = $borrower;
            $transmitArr['pro_qrcode'] = $pro_qrcode;
            $transmitArr['transmit_time'] = $time;
            D('off_transmit')->add($transmitArr);
        }

        $re = D('off_products_ercode')->where(array('id'=>$id))->save(array('receive'=>1,'borrower'=>$borrower,'trans_time'=>$time));
        if ($re) {
            $date = date('Y-m-d H:i:s');
            echo json_encode(array('err'=>0,'date'=>$date));
        } else {
            echo json_encode(array('err'=>1));
        }
    }


    //aJax批量领取
    public function products_operate_save_all(){
        $ids = I('post.ids');
        $borrower = I('post.borrower');

        $id_arr = explode(',',$ids);
        $flag = array();
        foreach ($id_arr as $v) {
            //是否是第一次领取
            $recArr = D('off_products_ercode')->where(array('id'=>$v))->find();
            //不是第一次领取就加入transmit表存到数据库
            if ($recArr['receive'] == 1 && $recArr['borrower']) {
                $pro_qrcode = $recArr['pro_qrcode'];
                $rec = D('off_transmit')->where(array('pro_qrcode'=>$pro_qrcode))->find();
                $transmitArr = array();
                //是否首次转交
                if ($rec) {
                    //不是
                    $transmitArr['zero_time'] = $rec['zero_time'];
                } else {
                    //第一次转交
                    $transmitArr['zero_time'] = $recArr['trans_time'];
                }
                $transmitArr['old_name'] = $recArr['borrower'];
                $transmitArr['new_name'] = $borrower;
                $transmitArr['pro_qrcode'] = $pro_qrcode;
                $transmitArr['transmit_time'] = time();
                D('off_transmit')->add($transmitArr);
            }


            $re = D('off_products_ercode')->where(array('id'=>$v))->save(array('receive'=>1,'borrower'=>$borrower,'trans_time'=>time()));
            if (!$re) $flag[] = $v;
        }
        //计算出错误个数
        if (count($flag) > 1) {
            $fStr = implode(',',$flag);
        } elseif(count($flag) == 1) {
            $fStr = $flag[0];
        }
        //返回到ajax
        if ($flag) {
            echo $fStr;
        } else {
            echo 1;
        }


    }


    //打包下载
    public function products_zip_z(){
//        $ids = I('post.ids');
//        $ids = "225,226,227";
        $cid=I('get.cid');
        if($cid){
            $page=I('get.page');
            if(empty($page)) $this->error('参数错误');
            $start=($page-1)*1000;
            $id_arr=D('off_products_ercode')->field('id,pro_qrcode,adress')->where(array('cid'=>$cid))->limit($start.',1000')->select();
            $data = array();
            $pro_name = "类目打包下载".$page.".zip";
            foreach ($id_arr as $k => $v) {
                $name = $v['pro_qrcode'].'.png';
                $data[$name] =  $v['adress'];
            }
        }else{
            $ids = I('get.ids');
            $id_arr = explode(',',$ids);
            $data = array();
            $pro_name = "zdy.zip";
            foreach ($id_arr as $k => $v) {
                $Arr = D('off_products_ercode')
                    ->field('id,pro_qrcode,adress')
                    ->where(array('id'=>$v))
                    ->find();
                $name = $Arr['pro_qrcode'].'.png';
                $data[$name] =  $Arr['adress'];
            }
        }
//        echo json_encode($data);
        $this->excu_zip($data,$pro_name);

    }

    //打包下载
    public function products_zip(){
//        $ids = I('post.ids');
//        $ids = "225,226,227";
        $ids = I('get.ids');
        $id_arr = explode(',',$ids);
        $data = array();
        $pro_name = '';
        foreach ($id_arr as $k => $v) {
            $Arr = D('off_products_ercode')
                ->field('pro_qrcode,adress,pro_code')
                ->where(array('id'=>$v))->find();
            if (empty($pro_name)) {
                $pro_name = D('off_products')->where(array('pro_code'=>$Arr['pro_code']))->getField('pro_name');
                $pro_name = $pro_name.".zip";
            }
//            $name = $Arr['pro_qrcode'].'.png';
            $name = $Arr['pro_qrcode'].'.png';
            $data[$name] =  $Arr['adress'];
        }
//        echo json_encode($data);
        $this->excu_zip($data,$pro_name);

    }



    public function excu_zip($data,$zipName) {
        $dfile =  tempnam('/tmp', 'tmp');//产生一个临时文件，用于缓存下载文件
        import('@.ORG.zipfile');
        $zip = new zipfile();

        //----------------------
        if ($zipName) {
            $filename = $zipName;//下载的默认文件名
        } else {
            $filename = 'image.zip'; //下载的默认文件名
        }

        //以下是需要下载的图片数组信息，将需要下载的图片信息转化为类似即可
//        $image = array(
//            array('image_src' => 'pic1.jpg', 'image_name' => '图片1.jpg'),
//            array('image_src' => 'pic2.jpg', 'image_name' => 'pic/图片2.jpg'),
//        );

        foreach($data as $k => $v){
            $zip->add_file(file_get_contents($v), $k);
            // 添加打包的图片，第一个参数是图片内容，第二个参数是压缩包里面的显示的名称, 可包含路径
            // 或是想打包整个目录 用 $zip->add_path($image_path);
        }
        //----------------------
        $zip->output($dfile);

        // 下载文件
        ob_clean();
        header('Pragma: public');
        header('Last-Modified:'.gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control:no-store, no-cache, must-revalidate');
        header('Cache-Control:pre-check=0, post-check=0, max-age=0');
        header('Content-Transfer-Encoding:binary');
        header('Content-Encoding:none');
        header('Content-type:multipart/form-data');
        header('Content-Disposition:attachment; filename="'.$filename.'"'); //设置下载的默认文件名
        header('Content-length:'. filesize($dfile));
        $fp = fopen($dfile, 'r');
        while(connection_status() == 0 && $buf = @fread($fp, 8192)){
            echo $buf;
        }
        fclose($fp);
        @unlink($dfile);
        @flush();
        @ob_flush();
        exit();
    }


    //Ajax批量下载
    public function products_pixia(){
        $ids = I('post.ids');
        $id_arr = explode(',',$ids);
        $data = array();
        foreach ($id_arr as $k => $v) {
            $pro_qrcode = D('off_products_ercode')->where(array('id'=>$v))->getField('pro_qrcode');
            $data[$k] =  ltrim(substr($pro_qrcode,-4),0);
        }
        echo json_encode($data);

    }


    /**
     * 传递json数组到模板 通过app_json.name获取
     * @param $name
     * @param array $val
     */
    public function assign_json($name,$val=array()){
        static $is_init = false;
        $name = "app_json.".$name;
        $val = json_encode($val)?:"{}";
        $json_str =  '<script>'.$name.' = '.$val.';</script>';
        if(!$is_init){//第一此传入的时候需要初始化
            $init = '<script>var app_json ={};</script>';
            $json_str = $init . $json_str;
            $is_init = true;
        }
        print_r($json_str);
    }


    public function get_url(){
        $id = I('post.id');
        $adress = D('off_products_ercode')->where(array('id'=>$id))->getField('adress');
        echo $adress;
    }


    /**
     * @param $url url路径
     * 生成二维码
     */
    public function QR($url){
        qr($url,'./static/PropertyService/images/xx.png');
    }


    //二维码详情
    public function products_qr_detail() {
        if (IS_POST) {
            $borrower = I('post.borrower');
            $pro_qrcode = I('post.pro_qrcode');
            $data = array();
            $data['borrower'] = $borrower;
            $data['trans_time'] = time();
            $data['receive'] = 1;
            //是否是第一次领取
            $recArr = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->find();
            //不是第一次领取就加入transmit表存到数据库
            if ($recArr['receive'] == 1 && $recArr['borrower']) {
                $rec = D('off_transmit')->where(array('pro_qrcode'=>$pro_qrcode))->find();
                $transmitArr = array();
                //是否首次转交
                if ($rec) {
                    //不是
                    $transmitArr['zero_time'] = $rec['zero_time'];
                } else {
                    //第一次转交
                    $transmitArr['zero_time'] = $recArr['trans_time'];
                }
                $transmitArr['old_name'] = $recArr['borrower'];
                $transmitArr['new_name'] = $borrower;
                $transmitArr['pro_qrcode'] = $pro_qrcode;
                $transmitArr['transmit_time'] = $data['trans_time'];
                D('off_transmit')->add($transmitArr);
            }
            $res = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->save($data);
            if ($res) {
                $this->success('更新成功',U('Off/products_qr_detail',array('pro_qrcode'=>$pro_qrcode)));
            } else {
                $this->error('更新失败',U('Off/products_qr_detail',array('pro_qrcode'=>$pro_qrcode)));
            }
        } else {
            $role_id = $_SESSION['admin_id'];
            if ($role_id) $this->assign('isOpen',1);
            $pro_qrcode = I('get.pro_qrcode');
            //创建物品时生成的二维码
            $field = array(
                'p.*',
                'er.pro_qrcode',
                'er.receive',
                'er.borrower',
                'er.trans_time',
                'er.id'=>'qid',
                't.id'=>'tid',
                't.type_name'=>'tname',
            );
            $proArr = D('off_products_ercode')->alias('er')
                ->field($field)
                ->join('left join __OFF_PRODUCTS__ p on p.pro_code = er.pro_code')
                ->join('left join __OFF_TYPE__ t on t.id=p.off_pro_type')
                ->where(array('er.pro_qrcode'=>$pro_qrcode))
                ->find();
            $this->assign('proArr',$proArr);
            $this->assign('pro_qrcode',$pro_qrcode);
            $this->display();
        }

    }


    //自定义二维码详情
    public function products_qr_detail_C() {
        if (IS_POST) {
            $pro_id = I('post.pro_id');
            $borrower = I('post.borrower');
            $pro_qrcode = I('post.pro_qrcode');
            $re = D('off_products')->where(array('pro_id'=>$pro_id))->setInc('pro_stock');
            if ($re) {
                $pro_code = D('off_products')->where(array('pro_id'=>$pro_id))->getField('pro_code');
                $data = array();
                $data['borrower'] = $borrower;
                $data['pro_code'] = $pro_code;
                $data['trans_time'] = time();
                $data['receive'] = 1;
                $res = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->save($data);
                if ($res) {
                    $this->success('更新成功',U('Off/products_qr_detail',array('pro_qrcode'=>$pro_qrcode)));
                } else {
                    $this->error('更新失败',U('Off/products_qr_detail_C',array('pro_qrcode'=>$pro_qrcode)));
                }
            } else {
                $this->error('更新失败',U('Off/products_qr_detail_C',array('pro_qrcode'=>$pro_qrcode)));
            }

        } else {
            header("location:http://www.hdhsmart.com/wap.php?g=Wap&c=Off&a=products_qr_detail_C&pro_qrcode=".$_GET['pro_qrcode']);
            $pro_qrcode = I('get.pro_qrcode');
            $role_id = $_SESSION['admin_id'];
            if ($role_id) $this->assign('isOpen',1);
            $receive = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->getField('receive');
            if ($receive == 1) {
                $this->redirect(U('Off/products_qr_detail',array('pro_qrcode'=>$pro_qrcode)));
            }
            $typeArr = $this->get_type_all();
            $this->assign('typeArr',$typeArr);
            $this->assign('pro_qrcode',$pro_qrcode);
            $this->display();
        }


    }


    //得到物品信息
    public function get_pro_list() {
        $type_id = I('get.type_id');
        $proArr = D('off_products')->where(array('is_del'=>0,'off_pro_type'=>$type_id))->select();
        $str = '<option value="0">请选择</option>';
        foreach ($proArr as $v) {
            $pro_name = $v['pro_name'];
            $pro_id = $v['pro_id'];
            $str .= "<option value='$pro_id'>$pro_name</option>";
        }
        echo $str;
    }


    //得到物品信息
    public function get_pro_one() {
        $pro_id = I('get.pro_id');
        $proArr = D('off_products')->where(array('pro_id'=>$pro_id))->find();
        $pro_name = $proArr['pro_name'];
        $pro_price = $proArr['pro_price'];
        $band = $proArr['band'];
        $pro_supplier = $proArr['pro_supplier'];
        $purch_time = date('Y-m-d',$proArr['purch_time']);
        $create_time = date('Y-m-d H:i:s',$proArr['create_time']);
        $str = '';
        $str .= "<div class=\"shtx_xm\">
            <div class=\"kkw\">物品名称&nbsp;:&nbsp;</div>
            <div class=\"shtx_kek\">$pro_name
            </div>
            <div class=\"both\"></div>
        </div>";

        $str .= "<div class=\"shtx_xm\">
            <div class=\"kkw\">物品单价&nbsp;:&nbsp;</div>
            <div class=\"shtx_kek\">$pro_price
            </div>
            <div class=\"both\"></div>
        </div>";

        $str .= "<div class=\"shtx_xm\">
            <div class=\"kkw\">物品品牌&nbsp;:&nbsp;</div>
            <div class=\"shtx_kek\">$band
            </div>
            <div class=\"both\"></div>
        </div>";

        $str .= "<div class=\"shtx_xm\">
            <div class=\"kkw\">采购日期&nbsp;:&nbsp;</div>
            <div class=\"shtx_kek\">$purch_time
            </div>
            <div class=\"both\"></div>
        </div>";


        $str .= "<div class=\"shtx_xm\">
            <div class=\"kkw\">物品供应商&nbsp;:&nbsp;</div>
            <div class=\"shtx_kek\">$pro_supplier
            </div>
            <div class=\"both\"></div>
        </div>";

        $str .= "<div class=\"shtx_xm\">
            <div class=\"kkw\">入库时间&nbsp;:&nbsp;</div>
            <div class=\"shtx_kek\">$create_time
            </div>
            <div class=\"both\"></div>
        </div>";

        echo $str;
    }


    // 文件上传
    public function upload() {
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg','pdf','doc','docx','xls','xlsx','txt');// 设置附件上传类型
        $upload->savePath =  './upload/system/fujian/';// 设置附件上传目录
        if(!$upload->upload()) {// 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
        }else{// 上传成功
            $info = $upload->getUploadFileInfo();
            return $info;
        }
    }

    //分类管理
    public function off_type_news(){
        $typeArr = $this->get_type_all();
        $this->assign('typeArr',$typeArr);
        $this->display();
    }

    //获得分类方法
    public function get_type_all(){
        $typeArr = D('off_type')->where(array('pid'=>0,'is_del'=>0))->order('id asc')->select();
        foreach ($typeArr as $k => &$v) {
            $son = D('off_type')->where(array('pid'=>$v['id'],'is_del'=>0))->order('pid asc')->select();
            foreach ($son as $sk => &$sv) {
                $g_son = D('off_type')->where(array('pid'=>$sv['id'],'is_del'=>0))->order('pid asc')->select();
                $son[$sk]['g_son'] = $g_son;
            }
            $typeArr[$k]['son'] = $son;
        }
        unset($v);
        unset($sv);
        return $typeArr;
    }

    //分类删除
    public function off_type_delete(){
        $id = I('post.id');
        $tArr = D('off_type')->where(array('pid'=>$id,'is_del'=>0))->find();
        if ($tArr) {
            echo 2;
        } else {
            $re = D('off_type')->where(array('id'=>$id))->save(array('is_del'=>1));
            if ($re) {
                echo 1;
            } else {
                echo 2;
            }
        }

    }


    //分类添加
    public function off_type_add() {
        $typeArr = $this->get_type_all();
        $this->assign('typeArr',$typeArr);
        $this->display();
    }

    public function off_type_save() {
        $data = array();
        $data['pid'] = I('post.pid');
        $data['type_name'] = I('post.type_name');
        $data['check_name'] = $_SESSION['system']['realname'];
        $data['create_time'] = time();
        $re = D('off_type')->add($data);
        if ($re) {
            $this->success('添加成功',U('Off/off_type_add'));
        } else {
            $this->error('添加失败',U('Off/off_type_add'));
        }
    }

    //分类更新
    public function off_type_update() {
        if (IS_POST) {
            $data = array();
            $id = I('post.id');
            $data['pid'] = I('post.pid');
            $data['type_name'] = I('post.type_name');
            $data['up_name'] = $_SESSION['system']['realname'];
            $data['up_time'] = time();
            $re = D('off_type')->where(array('id'=>$id))->save($data);
            if ($re) {
                $this->success('更新成功',U('Off/off_type_news'));
            } else {
                $this->error('更新失败',U('Off/off_type_news'));
            }
        } else {
            $id = $_GET['id'];
            $tArr = D('off_type')->where(array('id'=>$id))->find();
            $typeArr = $this->get_type_all();
            $this->assign('typeArr',$typeArr);
            $this->assign('tArr',$tArr);
            $this->display();
        }

    }

    /**
     * @author zhukeqin
     * 区域管理增加相关方法
     */
    //区域管理
    public function off_zone_news(){
        $typeArr = $this->get_zone_all();
        $this->assign('typeArr',$typeArr);
        $this->display();
    }

    //区域分类方法
    public function get_zone_all(){
        $typeArr = D('off_zone')->where(array('pid'=>0,'is_del'=>0,'village_id'=>$this->village_id))->order('id asc')->select();
        foreach ($typeArr as $k => &$v) {
            $son = D('off_zone')->where(array('pid'=>$v['id'],'is_del'=>0,'village_id'=>$this->village_id))->order('pid asc')->select();
            foreach ($son as $sk => &$sv) {
                $g_son = D('off_zone')->where(array('pid'=>$sv['id'],'is_del'=>0,'village_id'=>$this->village_id))->order('pid asc')->select();
                $son[$sk]['g_son'] = $g_son;
            }
            $typeArr[$k]['son'] = $son;
        }
        unset($v);
        unset($sv);
        return $typeArr;
    }

    //区域删除
    public function off_zone_delete(){
        $id = I('post.id');
        $tArr = D('off_zone')->where(array('pid'=>$id,'is_del'=>0,'village_id'=>$this->village_id))->find();
        if ($tArr) {
            echo 2;
        } else {
            $re = D('off_zone')->where(array('id'=>$id,'village_id'=>$this->village_id))->save(array('is_del'=>1));
            if ($re) {
                echo 1;
            } else {
                echo 2;
            }
        }

    }


    //区域添加
    public function off_zone_add() {
        $typeArr = $this->get_zone_all();
        $this->assign('typeArr',$typeArr);
        $this->display();
    }

    public function off_zone_save() {
        $data = array();
        $data['pid'] = I('post.pid');
        $data['zone_name'] = I('post.zone_name');
        $data['check_name'] = $_SESSION['system']['realname'];
        $data['create_time'] = time();
        $data['village_id'] = $this->village_id;
        $re = D('off_zone')->add($data);
        if ($re) {
            $this->success('添加成功',U('Off/off_zone_add'));
        } else {
            $this->error('添加失败',U('Off/off_zone_add'));
        }
    }

    //区域更新
    public function off_zone_update() {
        if (IS_POST) {
            $data = array();
            $id = I('post.id');
            $data['pid'] = I('post.pid');
            $data['zone_name'] = I('post.zone_name');
            $data['up_name'] = $_SESSION['system']['realname'];
            $data['up_time'] = time();
            $re = D('off_zone')->where(array('id'=>$id))->save($data);
            if ($re) {
                $this->success('更新成功',U('Off/off_zone_news'));
            } else {
                $this->error('更新失败',U('Off/off_zone_news'));
            }
        } else {
            $id = $_GET['id'];
            $tArr = D('off_zone')->where(array('id'=>$id,'village_id'=>$this->village_id))->find();
            $typeArr = $this->get_zone_all();
            $this->assign('typeArr',$typeArr);
            $this->assign('tArr',$tArr);
            $this->display();
        }

    }

    /**
     * @author zhukeqin
     * 宿舍管理123
     */
    public function staff_news()
    {
        //查询所有宿舍信息
        $house = M('staff')->alias('a')->join('pigcms_house_village b ON a.village_id=b.village_id')->field('a.*,b.village_name')->select();

        foreach($house as &$v){
            $str = '';
            $v['name_id'] = explode(',',$v['name_id']);
            $where['id'] = array('in',$v['name_id']);
            $staff_name = M('staff_name')->where($where)->field('name')->select();
            //连接员工姓名
            foreach($staff_name as $s){
                $str.=$s['name'].',';
            }
            $str = substr($str,0,-1);
            $v['name'] = $str;
            /*if(empty($v['name_id'][0])){
                $count = 0;
            }else{
                $count = count($v['name_id']);
            }
            $v['bed_count'] = $v['bed_number'] + $count;*/
            if($v['bed_number'] == 0){
                $v['bed_number'] = "床位已满";
            }
        }
        unset($v);
//        dump($house);die;
        //取出宿舍表所有项目信息
        $village = M('staff')->alias('a')
            ->join('left join pigcms_house_village b ON a.village_id=b.village_id')
            ->field('a.village_id,b.village_name,count(a.room) room,sum(a.bed_number) bed_number')
            ->group('a.village_id')
            ->select();

        //总床位
        $staff = M('staff')->field('village_id,bed_number,name_id')->select();
        $count = 0;
        foreach($village as &$s){
            foreach($staff as $v){
                if($v['village_id'] == $s['village_id']){
                    if(empty($v['name_id'])){
                        $count += 0;
                    }else{
                        $arr = explode(',',$v['name_id']);
                        $count += count($arr);
                    }
                }
            }
            $s['bed_count'] = $s['bed_number'] + $count;
            $count = 0;
        }
        $this->assign('village',$village);
        $this->assign('staff',$house);
        $this->display('staff_news_list');
    }

    /**
     *staff_village_edit
     * 修改项目宿舍
     */
    public function staff_house_village_edit()
    {
        if($_POST){
            //获取数据
            $data = $_POST;
            $data['room'] = strtoupper($data['room']);
            //计算当前数据表中占用的床位
            $info = M('staff')->where(array('village_id'=>$data['village_id'],'room'=>$data['room']))->field('name_id')->find();
            if($info['name_id'] == ""){
                $bed_number = 0;
            }else{
                $bed_number = count(explode(',',$info['name_id']));
            }
            //住宿员工不能超过床位数
            if(count($data['name_id'])-$bed_number > $data['bed_number']){
                $this->error('宿舍员工数不能大于床位数',U('Off/staff_house_edit',array('id'=>$data['village_id'])));
            }
            //床位数自动改变
            $data['bed_number'] = $data['bed_number'] - count($data['name_id'])+$bed_number;
            //删除原宿舍员工
            if(isset($data['name_id'])){
                $staff_data = M('staff')->field('staff_id,name_id,bed_number')->select();
                foreach($data['name_id'] as $v){
                    foreach($staff_data as $s){
                        $array = explode(',',$s['name_id']);
                        for($i=0;$i<count($array);$i++){
                            if($v == $array[$i]){
                                //删除员工id，增加房间数
                                unset($array[$i]);
                                $s['name_id'] = trim(implode(',',$array),',');
                                $s['bed_number'] = $s['bed_number'] + 1;
                                $result = M('staff')->save($s);
                            }
                        }
                    }
                }
                //修改记录表
                $this->staff_edit_record($staff_data,$data);
                $data['name_id'] = $data['name_id'] = implode(',',$data['name_id']);
                $re = M('staff')->where(array('village_id'=>$data['village_id'],'room'=>$data['room']))->save($data);
                if ($re !== false) {
                    $this->success('更新成功',U('Off/staff_news'));
                } else {
                    $this->error('更新失败',U('Off/staff_house_edit',array('id'=>$data['village_id'])));
                }
            }else{
                $data['name_id'] = implode(',',$data['name_id']);
                $re = M('staff')->where(array('village_id'=>$data['village_id'],'room'=>$data['room']))->save($data);
                if ($re !== false) {
                    $this->success('更新成功',U('Off/staff_news'));
                } else {
                    $this->error('更新失败',U('Off/staff_house_edit',array('id'=>$data['village_id'])));
                }
            }
        }else{
            $village_id = I('get.id');
            $village = M('house_village')->where(array('village_id'=>$village_id))->find();
            //取出项目下所有宿舍
            $room = M('staff')->where(array('village_id'=>$village_id))->select();
            $this->assign('village',$village);
            $this->assign('room',$room);
            $this->display();
        }
    }

    /**
     *staff_house_village_room
     * 获取房间信息
     */
    public function staff_house_village_room()
    {
        $village_id = I('post.village_id');
        $room = I('post.room');
        $where = array('village_id'=>$village_id,'room'=>$room);
        $staff_house_info = M('staff')->where($where)->field('bed_number,department,comment,name_id,staff_id')->find();
        $arr = explode(',',$staff_house_info['name_id']);
//        foreach($arr as $v){
//            $array[] = M('staff_name')->where(array('id'=>$v))->find()['name'];
//        }
//        $staff_house_info['name'] = $array;
        $staff_house_info['name_id'] = $arr;
        //取出所有员工信息
        $info = M('staff_name')->select();
        $staff_house_info['name'] = $info;
        echo json_encode($staff_house_info);
    }

    /**
     * @author zhukeqin
     * 更新宿舍员工
     */
    public function staff_house_edit()
    {
        if($_POST){
            //获取数据
            $data = $_POST;
            $data['room'] = strtoupper($data['room']);
            //计算当前数据表中占用的床位
            $info = M('staff')->where(array('staff_id'=>$data['staff_id']))->field('name_id')->find();
            if($info['name_id'] == ""){
                $bed_number = 0;
            }else{
                $bed_number = count(explode(',',$info['name_id']));
            }
            //住宿员工不能超过床位数
            if(count($data['name_id'])-$bed_number > $data['bed_number']){
                $this->error('宿舍员工数不能大于床位数',U('Off/staff_house_edit',array('id'=>$data['staff_id'])));
            }
            //床位数自动改变
            $data['bed_number'] = $data['bed_number'] - count($data['name_id'])+$bed_number;
            //删除原宿舍员工
            if(isset($data['name_id'])){
                $staff_data = M('staff')->field('staff_id,name_id,bed_number')->select();
                foreach($data['name_id'] as $v){
                    foreach($staff_data as $s){
                        $array = explode(',',$s['name_id']);
                        for($i=0;$i<count($array);$i++){
                            if($v == $array[$i]){
                                //删除员工id，增加房间数
                                unset($array[$i]);
                                $s['name_id'] = trim(implode(',',$array),',');
                                $s['bed_number'] = $s['bed_number'] + 1;
                                $result = M('staff')->save($s);
                            }
                        }
                    }
                }
                //修改记录表
                $this->staff_edit_record($staff_data,$data);
                $data['name_id'] = implode(',',$data['name_id']);
                $re = M('staff')->save($data);
                if ($re !== false) {
//                        $data['start_time'] = time();
//                        M('staff_record')->add($data);
                    $this->success('更新成功',U('Off/staff_news'));
                } else {
                    $this->error('更新失败',U('Off/staff_house_edit',array('id'=>$data['staff_id'])));
                }
            }else{
                $data['name_id'] = implode(',',$data['name_id']);
                $re = M('staff')->save($data);
                if ($re !== false) {
                    $this->success('更新成功',U('Off/staff_news'));
                } else {
                    $this->error('更新失败',U('Off/staff_house_edit',array('id'=>$data['staff_id'])));
                }
            }
        }else{
            $staff_id = I('get.id');
            $staff = M('staff')->alias('a')
                ->join('pigcms_house_village b ON a.village_id=b.village_id')
                ->field('a.*,b.village_name')
                ->where(array('a.staff_id'=>$staff_id))
                ->find();
            $staff['name_id'] = explode(',',$staff['name_id']);
            //取出所有员工
//            $data = M('staff')->field('staff_id,name_id')->select();
//            $staff_info = M('staff_name')->select();
//            foreach($staff_info as $s){
//                $arr[]=$s['id'];
//            }
//            foreach($arr as $k=>$v){
//                foreach($data as $s){
//                    $arr1 = explode(',',$s['name_id']);
//                    if(in_array($v,$arr1)){
//                        unset($arr[$k]);
//                    }
//                }
//            }
//            foreach($staff['name_id'] as $v){
//                array_push($arr,$v);
//            }
//            $where['id'] = array('in',$arr);
//            $staff_name = M('staff_name')->where($where)->select();
            //取出所有员工
            $staff_name = M('staff_name')->select();
            //取出所有项目信息
            $vallage = M('house_village')->field('village_id,village_name')->select();
            $this->assign('staff',$staff);
            $this->assign('vallage',$vallage);
            $this->assign('staff_name',$staff_name);
            $this->display();
        }
    }

    /**
     *staff_edit_record
     * @param $staff_data
     * @param $names
     * 加入记录表
     */
    public function staff_edit_record($staff_data,$data)
    {
        foreach($data['name_id'] as $id){
            //判断是否已经在当前宿舍,如果在则结束时间不更新
            //获取宿舍id
            foreach($staff_data as $d){
                $array = explode(',',$d['name_id']);
                if(in_array($id,$array)){
                    $staff_id = $d['staff_id'];
                }
            }
            if(!empty($staff_id) && $staff_id != $data['staff_id']){
                $name = M('staff_name')->where(array('id'=>$id))->find()['name'];
                $res = M('staff')->where(array('staff_id'=>$staff_id))->find();
                M('staff_record')->where(array('village_id'=>$res['village_id'],'room'=>$res['room'],'name'=>$name))->setField('end_time',time());
                $data['start_time'] = time();
                $data['name'] = $name;
                M('staff_record')->add($data);
            }
        }
    }

    /**
     * @author zhukeqin
     * 删除员工宿舍
     */
    public function staff_house_delete()
    {
        $staff_id = I('post.id');
        $staff = M('staff')->where(array('staff_id'=>$staff_id))->find();
        $name_ids = explode(',',$staff['name_id']);
        foreach($name_ids as $id){
            //加入记录表
            $name = M('staff_name')->where(array('id'=>$id))->find()['name'];
            $where = array('village_id'=>$staff['village_id'],'room'=>$staff['room'],'name'=>$name);
            M('staff_record')->where($where)->setField('end_time',time());
            //删除对应员工
            M('staff_name')->where(array('id'=>$id))->delete();
        }
        $res = M('staff')->where(array('staff_id'=>$staff_id))->delete();
        if ($res) {
            echo 1;
        } else {
            echo 2;
        }
    }
    /**
     * @author zhukeqin
     * 员工列表
     */
    public function staff_list()
    {
        $data = M('staff_name')->select();
        $info = M('staff')->field('staff_id,name_id')->select();
        foreach ($data as &$s) {
            //获取宿舍id
            foreach ($info as $v) {
                $array = explode(',', $v['name_id']);
                if (in_array($s['id'], $array)) {
                    $staff_id = $v['staff_id'];
                    $s['info'] = M('staff')->alias('a')
                        ->join('pigcms_house_village b ON a.village_id=b.village_id')
                        ->field('a.*,b.village_name')
                        ->where(array('a.staff_id' => $staff_id))
                        ->find();
                }
            }
        }
        $this->assign('info', $data);
        $this->display();
    }

    /**
     * @author zhukeqin
     * 添加员工
     */
    public function staff_add()
    {
        if($_POST){
            $data = $_POST;
            $staff = M('staff')->where(array('village_id'=>$data['village_id'],'room'=>$data['room']))->find();
            if($staff == null){
                $this->error('请填写完整',U('Off/staff_add'));
            }
            //减少对应床位数
            $data['bed_number'] = $staff['bed_number'] - 1;
            if($data['bed_number'] < 0){
                $this->error('该宿舍床位不足',U('Off/staff_add'));
            }
            $add = M('staff_name')->add($data);
            if ($add !== false) {
                $arr = explode(',',$staff['name_id']);
                array_push($arr,$add);
                $data['name_id'] = trim(implode(',',$arr),',');
                //dump($data);die;
                $where = array(
                    'village_id'=>$data['village_id'],
                    'room' => $data['room']
                );
                $res = M('staff')->where($where)->save($data);
                if($res !== false){
                    //加入记录表
                    $staff['start_time'] = time();
                    $staff['name'] = $data['name'];
                    M('staff_record')->add($staff);
                    $this->success('添加员工成功',U('Off/staff_list'));
                }else{
                    $this->error('添加宿舍失败',U('Off/staff_add'));
                }
            } else {
                $this->error('添加员工失败',U('Off/staff_add'));
            }
        }else{
            //取出所有项目和宿舍信息
            $village = M('staff')->alias('a')
                ->join('left join pigcms_house_village b ON a.village_id=b.village_id')
                ->field('a.village_id,b.village_name')
                ->group('a.village_id')
                ->select();
            $this->assign('village',$village);
            $this->display();
        }
    }

    /**
     * @author zhukeqin
     * 员工详情
     */
    public function staff_detail()
    {
        $id = I('get.id');
        $data = M('staff')->field('staff_id,name_id')->select();
        //获取宿舍id
        foreach($data as $v){
            $array = explode(',',$v['name_id']);
            if(in_array($id,$array)){
                $staff_id = $v['staff_id'];
            }
        }
        if($staff_id){
            $staff_data = M('staff')->alias('a')
                ->join('pigcms_house_village b ON a.village_id=b.village_id')
                ->field('a.*,b.village_name')
                ->where(array('a.staff_id'=>$staff_id))
                ->find();
        }else{
            $staff_data = array();
        }
        $staff_name = M('staff_name')->where(array('id'=>$id))->find();
        $this->assign('staff_data',$staff_data);
        $this->assign('staff_name',$staff_name);
        $this->display();
    }

    /**
     * @author zhukeqin
     * 删除员工
     */
    public function staff_delete()
    {
        $id = I('post.id');
        $name = M('staff_name')->where(array('id'=>$id))->find()['name'];
        $re = M('staff_name')->where(array('id'=>$id))->delete();
        if($re){
            //删除对应宿舍该员工
            $data = M('staff')->field('staff_id,name_id')->select();
            //获取宿舍id
            foreach($data as $v){
                $array = explode(',',$v['name_id']);
                if(in_array($id,$array)){
                    $staff_id = $v['staff_id'];
                }
            }
            if($staff_id){
                $staff = M('staff')->where(array('staff_id'=>$staff_id))->find();
                $array = explode(',',$staff['name_id']);
                foreach($array as $k=>$s){
                    if($id == $s){
                        unset($array[$k]);
                    }
                }
                $where = array(
                    'staff_id'=>$staff_id,
                    'name_id'=>trim(implode(',',$array),','),
                    'bed_number'=>$staff['bed_number'] + 1
                );
                $res = M('staff')->save($where);
                //加入记录表
                $where = array('village_id'=>$staff['village_id'],'room'=>$staff['room'],'name'=>$name);
                M('staff_record')->where($where)->setField('end_time',time());
            }
            echo 1;
        }else{
            echo 2;
        }

    }

    /**
     * @author zhukeqin
     * 批量删除员工
     */
    public function staff_deletes()
    {
        $ids = I('post.ids');
        $arr = explode(',',$ids);
        M('arr')->startTrans();
        $flag = 1;
        foreach($arr as $id){
            //修改对应宿舍记录
            $re = $this->staff_edit_data($id);
            $flag *= $re;
        }
        if($flag){
            echo 1;
        }else{
            echo 2;
        }
    }

    public function staff_edit_data($id)
    {
        $name = M('staff_name')->where(array('id'=>$id))->find()['name'];
        $re = M('staff_name')->where(array('id'=>$id))->delete();
        if($re !== false){
            //删除对应宿舍记录
            $data = M('staff')->field('staff_id,name_id')->select();
            //获取宿舍id
            foreach($data as $v){
                $array = explode(',',$v['name_id']);
                if(in_array($id,$array)){
                    $staff_id = $v['staff_id'];
                }
            }
            if($staff_id){
                $staff = M('staff')->where(array('staff_id'=>$staff_id))->find();
                $array = explode(',',$staff['name_id']);
                foreach($array as $k=>$s){
                    if($id == $s){
                        unset($array[$k]);
                    }
                }
                $where = array(
                    'staff_id'=>$staff_id,
                    'name_id'=>trim(implode(',',$array),','),
                    'bed_number'=>$staff['bed_number'] + 1
                );
                M('staff')->save($where);
                //加入记录表
                M('staff_record')->where(array('village_id'=>$staff['village_id'],'room'=>$staff['room'],'name'=>$name))->setField('end_time',time());

            }
        }
        return $re;
    }
    /**
     *staff_record
     * 人员住宿历史记录
     */
    public function staff_record()
    {
        $info = M('staff_record')->alias('a')
            ->join('left join pigcms_house_village b ON a.village_id = b.village_id')
            ->field('a.*,b.village_name')
            ->select();
        $this->assign('info',$info);
        $this->display();
    }

    /**
     *staff_record_delete
     * 删除记录信息
     */
    public function staff_record_delete()
    {
        $id = I('post.id');
        $re = M('staff_record')->where(array('id'=>$id))->delete();
        if($re){
            echo 1;
        }else{
            echo 0;
        }
    }

    /**
     * @author zhukeqin
     * 批量删除记录信息
     */
    public function staff_record_deletes()
    {
        $ids = I('post.ids');
        $where['id'] = array('in',$ids);
        $re = M('staff_record')->where($where)->delete();
        if($re){
            echo 1;
        }else{
            echo 0;
        }
    }
    /**
     * @author zhukeqin
     * 更新员工
     */
    public function staff_edit()
    {
        if($_POST){
            $data = $_POST;
            //dump($data);die;
            //不能大于剩余床位
            if($data['bed_number'] <=0){
                $this->error('该宿舍床位不足',U('Off/staff_edit',array('id'=>$data['name_id'])));
            }
            //修改员工姓名
            $name_id = $data['name_id'];
            M('staff_name')->where(array('id'=>$name_id))->save($data);
            //员工去了其他宿舍删除该宿舍员工
            $staff_data = M('staff')->field('staff_id,name_id')->select();
            //获取宿舍id
            foreach($staff_data as $v){
                $array = explode(',',$v['name_id']);
                if(in_array($name_id,$array)){
                    $staff_id = $v['staff_id'];
                }
            }
            //加入记录表
            $name = M('staff_name')->where(array('id'=>$data['name_id']))->find()['name'];
            if(!empty($staff_id) && $staff_id != $data['staff_id']){
                $res = M('staff')->where(array('staff_id'=>$staff_id))->find();
                M('staff_record')->where(array('village_id'=>$res['village_id'],'room'=>$res['room'],'name'=>$name))->setField('end_time',time());
                $staff = M('staff')->where(array('staff_id'=>$staff_id))->field('name_id,bed_number')->find();
                $array = explode(',',$staff['name_id']);
                foreach($array as $k=>$s){
                    if($name_id == $s){
                        unset($array[$k]);
                    }
                }
                $where = array(
                    'staff_id'=>$staff_id,
                    'name_id'=>implode(',',$array),
                    'bed_number'=>$staff['bed_number']+1
                );
                $res = M('staff')->save($where);
            }
            $data['start_time'] = time();
            $data['name'] = $name;
            M('staff_record')->add($data);
            //将员工加入宿舍
            $where=array('village_id'=>$data['village_id'],'room'=>$data['room']);
            $info = M('staff')->where($where)->find();
            $arr = explode(',',$info['name_id']);
            if(!in_array($data['name_id'],$arr)){
                array_push($arr,$data['name_id']);
                //减少对应宿舍床位
                $bed_number = $info['bed_number'] - 1;
            }else{
                $bed_number = $info['bed_number'];
            }
            $id = trim(implode(',',$arr),',');
            $where1 = array(
                'staff_id'=>$data['staff_id'],
                'village_id'=>$data['village_id'],
                'room'=>$data['room'],
                'name_id'=>$id,
                'bed_number'=>$bed_number
            );
            $re = M('staff')->save($where1);
            if($re){
                $this->success('修改成功',U('Off/staff_list'));
            }else{
                $this->error('修改失败',U('Off/staff_edit',array('id'=>$name_id)));
            }
        }else{
            $id = I('get.id');
            //取出宿舍表所有项目信息
            $village = M('staff')->alias('a')
                ->join('left join pigcms_house_village b ON a.village_id=b.village_id')
                ->field('a.village_id,b.village_name')
                ->group('a.village_id')
                ->select();
            //员工姓名
            $staff_name = M('staff_name')->where(array('id'=>$id))->find();
            //取出当前项目房间号
            $data = M('staff')->field('staff_id,village_id,name_id')->select();
            //获取宿舍id和项目id
            foreach($data as $v){
                $array = explode(',',$v['name_id']);
                if(in_array($id,$array)){
                    $village_id = $v['village_id'];
                    $staff_id = $v['staff_id'];
                }
            }
            $room = M('staff')->field('room')->where(array('village_id'=>$village_id))->select();
            $staff_data = M('staff')->alias('a')
                ->join('pigcms_house_village b ON a.village_id=b.village_id')
                ->field('a.*,b.village_name')
                ->where(array('a.staff_id'=>$staff_id))
                ->find();
            $this->assign('vallage',$village);
            $this->assign('room',$room);
            $this->assign('staff_name',$staff_name);
            $this->assign('staff',$staff_data);
            $this->display();
        }
    }

    /**
     * @author zhukeqin
     * 获取剩余床位数
     */
    public function staff_house_info()
    {
        $village_id = I('post.village_id');
        $room = I('post.room');
        $where = array('village_id'=>$village_id,'room'=>$room);
        $staff_house_info = M('staff')->where($where)->field('bed_number,department,comment,staff_id')->find();
        if($staff_house_info['bed_number'] == 0){
            $staff_house_info['bed_number'] = "床位已满";
        }
        echo json_encode($staff_house_info);
    }

    /**
     * @author zhukeqin
     * 获取房间号
     */
    public function staff_room()
    {
        $village_id = I('post.village_id');
        $room = M('staff')->where(array('village_id'=>$village_id))->select();
        $room = json_encode($room);
        echo $room;
    }
    /**
     * @author zhukeqin
     * 添加宿舍
     */
    public function staff_house_add()
    {
        if($_POST) {
            $data = $_POST;
            $data['room'] = strtoupper($data['room']);
            $names = explode(',',$data['name']);
            //房间号不能重复
            $result = M('staff')->where(array('room' => $data['room'], 'village_id' => $data['village_id']))->find();
            if ($result) {
                $this->error('房间号不能重复', U('Off/staff_house_add'));
            }
            //住宿员工不能超过床位数
            if (count($names) > $data['bed_number']) {
                $this->error('宿舍员工数不能大于床位数', U('Off/staff_house_add'));
            }
            //床位数自动改变
            $data['bed_number'] = $data['bed_number'] - count($data['name_id']);
            //增加员工数加入记录表
            foreach($names as $name){
                $insertId = M('staff_name')->add(array('name'=>$name));
                if($insertId !== false){
                    $data['name_id'][] = $insertId;
                    $data['start_time'] = time();
                    $data['name']       = $name;
                    M('staff_record')->add($data);
                }
            }
            $data['name_id'] = implode(',',$data['name_id']);
            /* $data['name_id'] = implode(',',$data['name_id']);
             if(!empty($data['name_id'])){
                 $arr1 = explode(',',$data['name_id']);
                 //删除原宿舍员工
                 $staff_data = M('staff')->select();
                 foreach($arr1 as $v){
                     foreach($staff_data as &$s){
                         $array = explode(',',$s['name_id']);
                         for($i=0;$i<count($array);$i++){
                             if($v == $array[$i]){
                                 //删除员工id，增加房间数
                                 unset($array[$i]);
                                 $s['name_id'] = implode(',',$array);
                                 $s['bed_number'] = $s['bed_number'] + 1;
                                 //加入记录表
                                 $name = M('staff_name')->where(array('id'=>$v))->find()['name'];
                                 $where = array('village_id'=>$s['village_id'],'room'=>$s['room'],'name'=>$name);
                                 M('staff_record')->where($where)->setField('end_time',time());
                                 $result = M('staff')->save($s);
                             }
                         }
                     }
                 }
                 if($result){
                     $re = M('staff')->add($data);
                     if ($re) {
                         $arr2 = explode(',',$data['name_id']);
                         foreach($arr2 as $id){
                             $data['name'] = M('staff_name')->where(array('id'=>$id))->find()['name'];
                             $data['start_time'] = time();
                             M('staff_record')->add($data);
                         }
                         $this->success('添加宿舍成功',U('Off/staff_news'));
                     } else {
                         $this->error('添加宿舍失败',U('Off/staff_house_add'));
                     }
                 }else{
                     $this->error('添加员工失败',U('Off/staff_house_add'));
                 }
             }*/
            $re = M('staff')->add($data);
            if ($re) {
                $this->success('添加宿舍成功', U('Off/staff_news'));
            } else {
                $this->error('添加宿舍失败', U('Off/staff_house_add'));
            }
        }else{
            //取出所有项目信息
            $vallage = M('house_village')->field('village_id,village_name')->select();
            $this->assign('vallage',$vallage);
            $this->display();
        }
    }

    /**
     * @author zhukeqin
     * 批量导入宿舍信息
     */
    public function staff_import_step()
    {
        //导航设置
        $breadcrumb_diy = array(
            array('固定资产','#'),
            array('宿舍信息列表',U('staff_news')),
            array('批量导入','#'),
        );
        // $this->assign('village_list',$model->get_village_list());
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }

    /**
     * @author zhukeqin
     * 批量导入
     */
    public function staff_import_step1()
    {
        //导航设置
        $breadcrumb_diy = array(
            array('固定资产','#'),
            array('宿舍信息列表',U('staff_news')),
            array('批量导入','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        //获取社区名
        $model = new OffModel();
//        echo 1;die;
        $file = $_FILES['test'];
//        dump($file);die;
        // $village_id = session('system.village_id');
        // $village_name = $model->get_village_list()[$village_id];

        if($file){
            //导入数据
            $list = $model->staff_excel_to_data($file);
//            dump($list);die;
            foreach($list['body'] as $k=>&$v){
                if(!is_numeric($v['number'])){
                    unset($list['body'][$k]);
                }
            }
            $this->assign_json('list',$list);
            // $this->assign_json('selected_village_id',$village_id);
            // $this->assign_json('selected_village_name',$village_name);
            // $this->assign('selected_village_name',$village_name);
            $this->display();
        }else{
            $this->error("文件格式错误",U('supplier_import_step'));
        }
    }

    /**
     * 第三步导入数据
     */
    public function staff_import_step2(){
        $data = $_POST;
        $village_id = $_SESSION['system']['village_id'];
        // var_dump($village_id);exit();
        $data['data'] = json_decode(htmlspecialchars_decode($data['data']),true);
        // echo $village_id;
        $model = new OffModel();
        $re = $model->insert_staff_data_to_database($data['data'],$village_id);
        if($re){
            return $this->success("操作成功","",$data);
        }else{
            $error = $model->get_import_error();
            return $this->error($error['msg'],"",$error['data']);
        }

    }
}