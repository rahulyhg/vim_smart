<?php
/**
 * 关于整合的后台管理员类
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/7/17
 * Time: 10:58
 */
class AdminAction extends BaseAction{

    /**
     * 显示所有的账号列表页
     */
    public function index_news(){
        //条件
        $role_id = I('get.role_id');

        $map = array(

            'a.level'=>array('neq',2)
        );

        $field = array(
            'a.*',
            'c.company_name',
            'v.village_name',
            'm.name'
        );


        //修改多角色显示
        $admins = D('Admin')
            ->alias('a')
            ->field($field)
            ->join('LEFT JOIN pigcms_company c on a.company_id=c.company_id')
            ->join('LEFT JOIN pigcms_house_village v on a.village_id=v.village_id')
            ->join('LEFT JOIN pigcms_merchant m on a.mer_id=m.mer_id')
            ->where($map)
            ->select();

        foreach ($admins as $key => &$v) {
            $role_idArr = explode(',',$v['role_id']);
            foreach ($role_idArr as $vv) {
                $role_name = D('role')->where(array('role_id'=>$vv))->getField('role_name');
                $v['role_name'] .= $role_name.',';
            }
            $v['role_name'] = trim($v['role_name'],',');

            if(!empty($role_id)){
                if (!in_array($role_id,$role_idArr)) {
                    unset($admins[$key]);
                }
            }
        }

        unset($v);

        $this->assign('admins', $admins);

        $this->display();
    }

//    public function admin_add_news(){
//        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
//
//        $admin = D('Admin')->field(true)->where(array('id' => $id))->find();
//        if($admin['openid']){
//            $admin['nickname'] = M('user')->where('openid="%s"',$admin['openid'])->getField('nickname');
//        }
//        //全公司
//        if($id){
//            $admin_village_id = M('admin')->where(array('id'=>$id))->getField('village_id');
//            $company_array = M('company')->where(array('village_id'=>$admin_village_id))->select();
//        }else{
//            $company_array = M('company')->select();
//        }
//
//        //项目下所属商户
//        if($id){
//            $admin_village_id = M('admin')->where(array('id'=>$id))->getField('village_id');
//            $merchant_array = M('merchant')->where(array('village_id'=>$admin_village_id))->select();
//        }else{
//            $merchant_array = M('merchant')->select();
//        }
//
//        //dump($company_array);
//
//        //全社区
//        $village_array = M('house_village')->where(array('status'=>1))->select();
//
//        //全角色
//        $role_array = M('role')->select();
//
//        //全入住公司
//        $tenant_array = M('house_village_user_bind')->where('type=1 and tenantname!=""')->select();
//
//        $this->assign('merchant_array', $merchant_array);
//
//        $this->assign('company_array', $company_array);
//
//        $this->assign('village_array', $village_array);
//
//        $this->assign('role_array', $role_array);
//
//        $this->assign('tenant_array', $tenant_array);
//
//        $this->assign('admin', $admin);
//
//        $this->assign('bg_color', '#F3F3F3');
//
//        $this->display();
//    }

    public function admin_add_news(){      

        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $admin = D('Admin')->field(true)->where(array('id' => $id))->find();
        // var_dump($admin);exit;
        if (!isset($_GET['id'])) {
            $admin['status'] = 1;
        }


        if($admin['openid']){
            $admin['nickname'] = M('user')->where('openid="%s"',$admin['openid'])->getField('nickname');
        }else{
            $uid = M('house_village_user_bind')->where(array('name'=>$admin['realname'],'phone'=>$admin['phone']))->select()[0]['uid'];
            
            $admin['nickname'] = M('user')->where(array('uid'=>$uid))->getField('nickname');
        }
        // var_dump($uid);exit;
        //全公司
        if($id){
            $admin_village_id = M('admin')->where(array('id'=>$id))->getField('village_id');
            $company_array = M('company')->where(array('village_id'=>$admin_village_id))->select();
        }else{
            $company_array = M('company')->select();
        }

        //项目下所属商户
        if($id){
            $admin_village_id = M('admin')->where(array('id'=>$id))->getField('village_id');
            $merchant_array = M('merchant')->where(array('village_id'=>$admin_village_id))->select();
        }else{
            $merchant_array = M('merchant')->select();
        }
        if(!empty($admin_village_id)){
            $village_info=M('house_village')->where('village_id='.$admin_village_id)->find();
            if($village_info['village_type']==1){
                $project_list=M('house_village_project')->where('village_id='.$admin_village_id)->select();
                $choose_project=explode(',',$admin['project_id']);
                $this->assign('project_list',$project_list);
                $this->assign('choose_project',$choose_project);
            }
        }
        //dump($company_array);       
        

        //全社区
        $village_array = M('house_village')->where(array('status'=>1))->select();
        $village_id_all = array();
        $arr = '';
        if ($admin['village_id_list'] == 'all') {
            $village_id_all = M('house_village')->field(array('village_id'))->where(array('status'=>1))->select();

            foreach ($village_id_all as $k => $v) {  //全项目包含已选的项目
                $arr .= $v['village_id'].',';                       
            }
            $arr = rtrim($arr, ",");
            $village_id_list = $arr;
            $admin['village_id_list'] = explode(",", $village_id_list);
        } else {
            $admin['village_id_list'] = explode(',',$admin['village_id_list']);
        }       

        //全角色
        $role_array = M('role')->select();

//        $admin['role_id'] = '16,31,76';
        $admin['role_id'] = explode(',',$admin['role_id']);

        //部门
        $department_list=M('department')->order('add_time asc')->select();	//部门列表
        foreach($department_list as $k=>&$v){
            $v['text']=$v['deptname'];
        }
        $list_tree=$this->list_to_tree($department_list,$pk='id',$pid='pid',$child='children',$root=0,$key='');
        $departmentLogic = D('Department','Logic');
        $optionArray = $departmentLogic->tree_array_to_option($list_tree);

        //真实姓名
        // var_dump($_GET);
        $village_id = $_GET['select_village_id'];
        // var_dump($village_id);
        // $village_id = $admin['village_id'];
        // var_dump($village_id);
        if ($village_id) {
            $name_array = M('house_village_user_bind')
                ->field(array('pigcms_id','name'))
                ->where(array('village_id'=>$village_id))
                ->order('pigcms_id desc')
                // ->limit(20)
                ->select();
        } else {
            $name_array = M('house_village_user_bind')
                ->field(array('pigcms_id','name'))
                ->order('pigcms_id desc')
                // ->limit(20)
                ->select();
        }
        // $str = serialize($name_array);
        
        // setCookie("name_array",$str,time()+3600);
        // var_dump($name_array);
        // var_dump(M()->_sql());exit;  serialize

        //全入住公司
        $tenant_array = M('house_village_user_bind')->where('type=1 and tenantname!=""')->select();

        $this->assign('department_categorys', $optionArray);

        $this->assign('merchant_array', $merchant_array);

        $this->assign('company_array', $company_array);

        $this->assign('village_array', $village_array);

        $this->assign('role_array', $role_array);

        $this->assign('name_array', $name_array);

        $this->assign('tenant_array', $tenant_array);
        // var_dump($admin);exit;
        $this->assign('admin', $admin);

        $this->assign('bg_color', '#F3F3F3');

        $this->display();
    }

    /**
     * 根据id查询其对应的nameArr
     */
    // public function ajax_search_name(){
    //     $content = I('post.q');
    //     if ($content) {
    //         $where['name'] = array('like','%'.$content.'%');
    //     }              
        
    //     //条件
    //     // $where['status']=array('eq',1);

    //     // $village_id = $_GET['select_village_id'];        
    //     $name_array = M('house_village_user_bind')
    //         ->field(array('pigcms_id','name'))
    //         ->where($where)
    //         ->order('pigcms_id desc')
    //         ->limit(20)
    //         ->select(); 
    //     $nameArr = $name_array;
    //     $nameArr = json_encode($nameArr);
    //     echo $nameArr;                    
    // }
    
    public function ajax_search_realname(){ 
        $page = I('page',1,'intval'); 
        $q = I('q','','htmlspecialchars,trim'); 
        $offset = I('offset'); 
        $where=array(); 
        if($q){ 
            $where['name']=array('like',$q.'%'); 
        } 
        $list = M('house_village_user_bind')->field('pigcms_id,name')->page($page,$offset)->where($where)->select(); 
        if($page == 1){ 
            array_unshift($list,array('id'=>-1,'name'=>'请选择')); 
        } 
 
        $count=M('house_village_user_bind')->count(); 
        echo json_encode(array('res'=>$list,'total'=>$count));exit; 
    }

    //获取社区village_id
    // function get_villagge_id() {
    //     $village_str = array();
    //     $village_array = M('house_village')->field(array('village_id','village_name'))->where(array('status'=>1))->select();
    //     // var_dump($village_array);
    //     $tmp = array();
    //     $tpl = array();
    //     foreach ($village_array as $k => $v) {
    //         $tmp[] = $v['village_id'];
    //         $tpl[] = $v['village_name'];
    //     }
    //     $village_str[0] = $tmp;
    //     $village_str[1] = $tpl;
    //     // var_dump($tmp);
    //     echo json_encode($village_str);

    // }

    //创建部门整合方法
    function list_to_tree($list,$pk='id',$pid='pid',$child='_child',$root=0,$key=''){
        // 创建Tree
        $tree=array();
        if(is_array($list)){
            // 创建基于主键的数组引用
            $refer=array();
            foreach($list as $k=>$data){
                $refer[$data[$pk]]=&$list[$k];//即$refer[id的值]
            }
            foreach($list as $k=>$data){
                // 判断是否存在parent
                $parentId=$data[$pid];//pid的值
                if($root==$parentId){
                    if($key!=''){
                        $tree[$data[$key]]=&$list[$k];
                    }else{
                        $tree[]=&$list[$k];
                    }
                }else{
                    if(isset($refer[$parentId])){
                        $parent=&$refer[$parentId];
                        if($key!=''){
                            $parent[$child][$data[$key]]=&$list[$k];
                        }else{
                            $parent[$child][]=&$list[$k];
                        }
                    }
                }
            }
        }
        return $tree;
    }

    /*
   * 微信昵称自动完成提供数据方法
   * */
    public function ajax_to_autocomplete(){
        $keyword = I('get.query');
        //制作查询语句
        $map['nickname']=array('like','%'.$keyword.'%');
        $keyword_array = M('user')->where($map)->limit(5)->order('uid desc')->select();
        foreach ($keyword_array as $value){
            $result_array[] =array(
                'label'=>$value['nickname'],
            );
        }
        echo json_encode($result_array);
    }

    /*
      *真实姓名绑定自动完成提供数据方法
      * */
    public function name_to_autocomplete(){
        $keyword = I('get.query');
        //制作查询语句  ->limit(5)
        $map['name']=array('like','%'.$keyword.'%');
        $keyword_array = M('house_village_user_bind')->where($map)->limit(5)->select();
        foreach ($keyword_array as $value){
            $result_array[] =array(
                'label'=>$value['name'],
            );
        }
        echo json_encode($result_array);
    }

    /*
      *真实姓名绑定自动完成提供数据方法
      * */
    public function phone_to_autocomplete(){
        $keyword = I('get.query');
        //制作查询语句
        $map['phone']=array('like','%'.$keyword.'%');
        $keyword_array = M('house_village_user_bind')->where($map)->limit(5)->select();
        foreach ($keyword_array as $value){
            $result_array[] =array(
                'label'=>$value['phone'],
            );
        }
        echo json_encode($result_array);
    }

    /**
     * @author zhukeqin
     * ajax获取项目信息列表
     */
    public function ajax_project_list(){
        $village_id = I('post.village_id');
        //接受前台传来的数据并且调用封装方法进行处理
        $village_info = M('house_village')->where(array('village_id'=>$village_id))->find();
        $checkbox='';
        if($village_info['village_type']==1){
            $project_list=M('house_village_project')->where(array('village_id'=>$village_id))->select();
            foreach ($project_list as $value){
                $checkbox .="<input type=\"checkbox\" name=\"project_id[]\" value=\"{$value['pigcms_id']}\">{$value['desc']}</input>&nbsp;";
            }
        }else{
            $checkbox='0';
        }

        echo $checkbox;

    }
    /*
     *
     * ajax 选择相应的社区下的公司
     * */
    public function make_company_list(){
        $village_id = I('post.village_id');
        //接受前台传来的数据并且调用封装方法进行处理
        $company_array = M('company')->where(array('village_id'=>$village_id))->select();
        $option_list = '';
        //拼接OPTION字符串
        foreach ($company_array as $value){
            $option_list .= '<option value="'.$value['company_id'].'">'.$value['company_name'].'</option>';
        }

        echo '<select class="form-control" name="company_id" id="company_id"><option value="0">请选择</option>'.$option_list.'</select>';

    }

    /*
     * ajax 获取对应项目下的商户列表
     * */
    public function make_merchant_list(){
        $village_id = I('post.village_id');
        //接受前台传来的数据并且调用封装方法进行处理
        $merchant_array = M('merchant')->where(array('village_id'=>$village_id))->select();
        $option_list = '';
        //拼接OPTION字符串
        foreach ($merchant_array as $value){
            $option_list .= '<option value="'.$value['mer_id'].'">'.$value['name'].'</option>';
        }

        echo '<select class="form-control" name="mer_id" id="mer_id"><option value="0">请选择</option>'.$option_list.'</select>';

    }

    /*
     *ajax 获取对应人的手机号码
     * */
    public function user_bind_phone(){        
        $pigcms_id = I('post.pigcms_id');
        // $village_id = I('post.village_id');   ,'village_id'=>$village_id
        $user_info = M('house_village_user_bind')->where(array('pigcms_id'=>$pigcms_id))->select()[0];
        $weixin_nick = M('user')->getFieldByUid($user_info['uid'],'nickname');
        $show_array = array(
          'phone'=>empty($user_info['phone'])?'':$user_info['phone'],
          'weixin_nick'=>empty($weixin_nick)?'':$weixin_nick,
        );
        echo json_encode($show_array);
    }

    /*
    *ajax 获取对应人的手机号码
    * */
    public function phone_bind_user(){
        $phone = I('post.phone');
        $user_info = M('house_village_user_bind')->getByPhone($phone);
        $weixin_nick = M('user')->getFieldByUid($user_info['uid'],'nickname');
        $show_array = array(
            'name'=>empty($user_info['name'])?'':$user_info['name'],
            'weixin_nick'=>empty($weixin_nick)?'':$weixin_nick,
        );
        echo json_encode($show_array);
    }

    /*
    *ajax 获取对应微信昵称的人信息
    * */
    public function weixin_bind_user(){
        $nickname = I('post.nickname');
        $uid = M('user')->getFieldByNickname($nickname,'uid');
        //vd(M()->_sql());exit;
        if($uid!=null){
            $user_info = M('house_village_user_bind')->getByUid($uid);
            $show_array = array(
                'phone'=>empty($user_info['phone'])?'':$user_info['phone'],
                'name'=>empty($user_info['name'])?'':$user_info['name'],
            );
        }else{
            $user_info = M()->table('smart_user')->getByUser_wxnik($nickname);
            $show_array = array(
                'phone'=>empty($user_info['user_phone'])?'':$user_info['user_phone'],
                'name'=>empty($user_info['user_t_name'])?'':$user_info['user_t_name'],
            );
        }

        echo json_encode($show_array);
    }


    /*
     *修改或者添加后台用户（多角色）
     * */
    public function admin_save(){

        if (IS_POST) {
            // var_dump($_POST);
            //计算昵称所对应的openid
            $nickname = I('post.nickname');
            $phone = I('post.phone');
            //vd($nickname);exit;
            if($nickname){
                $user_openid =  M('user')->where(array('nickname'=>(string)$nickname,'phone'=>$phone))->getField('openid')?:'';
                // var_dump(M()->_sql());exit();
                $car_openid = M()->table('smart_user')->getFieldByUser_wxnik($nickname,'user_wx_opid')?:'';
                if(empty($user_openid)&&empty($car_openid)){
                    //$this->error('查无此人，不能新建');
                }elseif (!empty($user_openid)&&empty($car_openid)){
                    $_POST['openid'] = $user_openid;
                }elseif (empty($user_openid)&&!empty($car_openid)){
                    $_POST['openid'] = $car_openid;
                }else{
                    $_POST['openid'] = $user_openid;
                }
            }


            //入住公司角色添加的时候

            $role_id = I('post.role_id');

            $tid = I('post.tid',0,'intval');
            if(in_array(19,$role_id) && !$tid){
                $this->error("请选择入住公司！");
            }

            $database_area = M('Admin');

            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

            $account = htmlspecialchars($_POST['account']);

            if (empty($account)) {

                $this->error('请填写账号');

                exit();

            }
            
            
            if (empty($_POST['village_id'])||($_POST['village_id']==0)) {

                $this->error('请选择社区');

                exit();              
            }
            
            //全项目与多项目处理
            $village_id_all = array();
            $arr = '';
            
            if ($_POST['village_id_list'][0] == 1) {  //全项目
                // $village_id_all = M('house_village')->field(array('village_id'))->where(array('status'=>1))->select();
                // foreach ($village_id_all as $k => $v) {  //全项目包含已选的项目
                //     $arr .= $v['village_id'].',';                       
                // }
                // $arr = rtrim($arr, ",");
                // $_POST['village_id_list'] = $arr;
                $_POST['village_id_list'] = 'all';
            } else {  //多项目
                foreach ($_POST['village_id_list'] as $k => $v) {
                    if ($v == $_POST['village_id']) {  //多项目包含已选的项目
                        continue;
                    } else {
                        $arr .= $v.',';
                    }                       
                }
                $arr = $_POST['village_id'].','.$arr;  //把village_id拼接到village_id_list
                $arr = rtrim($arr, ",");
                $_POST['village_id_list'] = $arr;
            }                                    

            $uid = $_POST['realname'];           
            $realname = M('house_village_user_bind')->where(array('pigcms_id'=>$uid))->getField('name');                       
            $_POST['realname'] = $realname;           

            // if (empty($realname)) {

            //     $this->error('请填写真实姓名');

            //     exit();

            // }

            $phone = $_POST['phone'];

            if (empty($phone)) {
                // $this->error('手机号码不能为空');
            } else {
                if (!preg_match('/^1[3|4|5|7|8]\d{9}$/',$phone)) {
                    $this->error('手机号码格式不对');
                } else {
                    $adminArr = $database_area->where("`account`='{$account}' || `realname`='{$realname}' || `phone`='{$phone}'")->find();
                }

            }

            if (!$id && $adminArr) {
                $this->error('账号已存在，请去管理员页面修改');

                exit();

            }


            unset($_POST['id']);

            $_POST['level'] = 0;
            $_POST['project_id']=implode(',',$_POST['project_id']);

            if ($id) {
                if ($_POST['pwd']) {

                    $_POST['pwd'] = md5($_POST['pwd']);

                } else {

                    unset($_POST['pwd']);

                }

                $_POST['role_id'] = implode(',',$role_id);
                // var_dump($_POST);exit;
                $re = $database_area->where(array('id' => $id))->data($_POST)->save();             

                if ($re) {
                    $this->success('修改成功！',U('Admin/index_news')); 
                } else {
                    $this->error('修改失败！');
                }


            } else {
                if (empty($_POST['pwd'])) {

                    $this->error('密码不能为空~');

                }

                $_POST['pwd'] = md5($_POST['pwd']);

                $_POST['role_id'] = implode(',',$role_id);

                $res = $database_area->data($_POST)->add();
                if ($res) {

                    $this->success('添加成功！',U('Admin/index_news'));

                } else {

                    $this->error('添加失败！请重试~');

                }
                

            }

        } else {

            $this->error('非法提交,请重新提交~');

        }

    }


}