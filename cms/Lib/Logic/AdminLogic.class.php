<?php
/**
 * 管理员个人中心数据提供
 * @author 祝君伟
 * @time 2018年1月5日 10:13:43
 */
class AdminLogic extends Model
{


    //后台人员ID
    protected $adminId;

    //角色
    protected $roleId;

    //可处理报修的人员角色ID
    protected $repairRoleArray =
        array(
        37,40,43,49,50,51,52,53,54,55,60,63,65
        );

    //可处理投诉建议的角色ID
    protected $suggessRoleArray =
        array(
           38,42,43,45,46,48,63,65
        );

    //可处理预约信息的角色ID
    protected $appointRoleArray =
        array(
            38,42,43,45,46,48,63,65
        );

    public function __construct()
    {

       $this->adminId = session('system.id');

       $this->roleId = session('system.role_id');

    }


    /**
     * 获取最全面的admin信息
     * @param int $adminId 后台人员ID
     * @return mixed
     */
    public function getAdminInfo($adminId=0)
    {
       $id = $adminId?:$this->adminId;

       $field = array(
           'a.*',
           'v.village_name',
           'c.company_name',
           'r.role_name',
           'cr.role_name',
           'd.deptname',
           'b.usernum',
           'b.tenantname'
       );

       $info = M('admin')
           ->alias('a')
           ->field($field)
           ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=a.village_id')
           ->join('LEFT JOIN __COMPANY__ c on c.company_id=a.company_id')
           ->join('LEFT JOIN __ROLE__ r on r.role_id=a.role_id')
           ->join('LEFT JOIN smart_role cr on r.car_role_id=cr.role_id')
           ->join('LEFT JOIN __DEPARTMENT__ d on d.id=a.department_id')
           ->join('LEFT JOIN __HOUSE_VILLAGE_USER_BIND__ b on b.pigcms_id=a.tid')
           ->where(array('a.id'=>$id))
           ->find();

       return $info;
    }


    /**
     * 获取系统警告信息
     * @return array
     */
    public function getSystemWarn()
    {

        $warning_count = M('system_warning_control')->where(array('is_deal'=>0,'system_id'=>array('neq',10)))->count();

        $warning_array = M('system_warning_control')->where(array('is_deal'=>0,'system_id'=>array('neq',10)))->order('create_time desc')->limit(10)->select();

        foreach ($warning_array as $key=>$value)
        {
            $warning_array[$key]['timediffer'] = timeDiff($value['create_time'],time());
        }

        return array('count'=>$warning_count,'list'=>$warning_array);
    }

    /**
     * 按角色获取列表显示信息
     * @param int $adminId
     * @return array
     */
    public function getThingList($adminId=0)
    {
        $id = $adminId?:$this->adminId;

        if($id == SUPER_ID)
        {
            $noDealThingCount = M('house_village_repair_list')->where(array('is_read'=>array('neq',1)))->count();

            $noDealThingArray = M('house_village_repair_list')->where(array('is_read'=>array('neq',1)))->limit(10)->select();

            foreach ($noDealThingArray as $key=>$value)
            {
                $noDealThingArray[$key]['timediffer'] = timeDiff($value['time'],time());
            }

            return array('count'=>$noDealThingCount,'list'=>$noDealThingArray);
        }
        else
        {

           /**
            * 判断是何种类型的角色，根据角色提取列表
            * 1.客服类型角色，添加投诉建议，预约信息，审核信息
            * 2.工程部类型角色，添加报修信息
            * 3.秩序部类型角色，添加报修信息
            */

           $list = array();

            //显示报修信息
            $repairArray = M('house_village_repair_list')->where(array('is_read'=>array('neq',1),'type'=>array('eq',1)))->limit(10)->select()?:array();

            //显示建议信息
            $suggessArray = M('house_village_repair_list')->where(array('is_read'=>array('neq',1),'type'=>array('eq',3)))->limit(10)->select()?:array();

            //显示预约信息
            $appointArray = M('house_village_repair_list')->where(array('is_read'=>array('neq',1),'type'=>array('eq',4)))->limit(10)->select()?:array();

            foreach ($repairArray as $key=>$value)
            {
                $repairArray[$key]['timediffer'] = timeDiff($value['time'],time());
                $repairArray[$key]['url'] = U('PropertyService/repair_list_news');
            }

            foreach ($suggessArray as $key=>$value)
            {
                $suggessArray[$key]['timediffer'] = timeDiff($value['time'],time());
                $suggessArray[$key]['url'] = U('PropertyService/suggess_list_news');
            }

            foreach ($appointArray as $key=>$value)
            {
                $appointArray[$key]['timediffer'] = timeDiff($value['time'],time());
                $appointArray[$key]['url'] = U('PropertyService/appointment_list_news');
            }

            //vd($repairArray);exit;

            if(in_array($this->roleId,$this->repairRoleArray) && in_array($this->roleId,$this->suggessRoleArray) && in_array($this->roleId,$this->appointRoleArray))
            {

                $list = array_merge($repairArray,$suggessArray);

                //vd($list);exit;

                $list = array_merge($list,$appointArray);


            }
            else if(!in_array($this->roleId,$this->repairRoleArray) && in_array($this->roleId,$this->suggessRoleArray) && in_array($this->roleId,$this->appointRoleArray))
            {

                $list = array_merge($suggessArray,$appointArray);

            }
            else if(!in_array($this->roleId,$this->repairRoleArray) && !in_array($this->roleId,$this->suggessRoleArray) && in_array($this->roleId,$this->appointRoleArray))
            {

                $list = $appointArray;

            }
            else if(in_array($this->roleId,$this->repairRoleArray) && in_array($this->roleId,$this->suggessRoleArray) && !in_array($this->roleId,$this->appointRoleArray))
            {
                $list = array_merge($repairArray,$suggessArray);

            }
            else if(in_array($this->roleId,$this->repairRoleArray) && !in_array($this->roleId,$this->suggessRoleArray) && !in_array($this->roleId,$this->appointRoleArray))
            {
                $list = $repairArray;
            }
            else if(!in_array($this->roleId,$this->repairRoleArray) && in_array($this->roleId,$this->suggessRoleArray) && !in_array($this->roleId,$this->appointRoleArray))
            {
                $list = $suggessArray;
            }
            else if(!in_array($this->roleId,$this->repairRoleArray) && in_array($this->roleId,$this->suggessRoleArray) && !in_array($this->roleId,$this->appointRoleArray))
            {
                $list = array_merge($repairArray,$appointArray);
            }

        }


        return array('count'=>0,'list'=>$list);
    }


}