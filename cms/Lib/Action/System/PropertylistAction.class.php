<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/6/21
 * Time: 16:29
 */
class PropertylistAction extends BaseAction{
    public function _initialize()
    {

        parent::_initialize();

        $this->admin_id = session('system.id');
        $this->village_id = filter_village(0, 2);
        /*$this->project_id =$_GET['project_id'];*/
        if(empty($this->project_id)){
            $this->project_id=$_SESSION['project_id'];
        }else{
            $_SESSION['project_id']=$this->project_id;
        }
        $project_list=M('house_village_project')->where(array('village_id'=>$this->village_id))->select();
        if(empty($this->project_id)){
            $this->project_id=$_SESSION['project_id']=$project_list['0']['pigcms_id'];
        }
        $type_list_all=M('house_village_otherfee_type')->where(array('status'=>1,'village_id'=>$this->village_id,))->select();
        $this->assign('type_list',$type_list_all);
        $this->assign('project_id',$this->project_id);
        $this->assign('project_list',$project_list);

    }
    public function property(){
        $field=array(
            'rp.*',
            'r.room_name',
            'ub.name',
            'ub.phone'
        );
        $where=array(
            'r.village_id'=>$this->village_id,
            'r.project_id'=>$this->project_id,
            'rp.pay_time'=>array('egt',time()-90*24*3600),
            'rp.status'=>1
        );
        $list=M('house_village_room_propertylist')
            ->alias('rp')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_ROOM__ r on r.id=rp.rid')
            ->join('left join __USER__ u on u.uid=rp.uid')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.uid=u.uid')
            ->where($where)
            ->select();
        $this->assign('list',$list);
        $this->display('index');
    }
    public function carspace(){
        $field=array(
            'rp.*',
            'r.room_name',
            'ub.name',
            'ub.phone'
        );
        $where=array(
            'r.village_id'=>$this->village_id,
            'r.project_id'=>$this->project_id,
            'rp.pay_time'=>array('egt',time()-90*24*3600),
            'rp.status'=>1
        );
        $list=M('house_village_room_carspacelist')
            ->alias('rp')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_ROOM__ r on r.id=rp.rid')
            ->join('left join __USER__ u on u.uid=rp.uid')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.uid=u.uid')
            ->where($where)
            ->select();
        $this->assign('list',$list);
        $this->display('index');
    }
    public function other(){
        if(empty($_GET['type_id'])){
            $this->error('参数错误，当前类型不存在');
        }
        $field=array(
            'rp.*',
            'ot.otherfee_type_name',
            'r.room_name',
        );
        $where=array(
            'r.village_id'=>$this->village_id,
            'r.project_id'=>$this->project_id,
            'rp.creattime'=>array('egt',time()-90*24*3600),
            'rp.status'=>1,
            'rp.otherfee_type_id'=>$_GET['type_id']
        );
        $list=M('house_village_otherfee')
            ->alias('rp')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_OTHERFEE_TYPE__ ot on ot.otherfee_type_id=rp.otherfee_type_id')
            ->join('left join __HOUSE_VILLAGE_ROOM__ r on r.id=rp.rid')
            ->where($where)
            ->select();
        //dump(M()->_sql());
        $this->assign('list',$list);
        $this->display('index');
    }
}