<?php
/*
 * 基于PDO的封装版model类
 * @time 2016.4.6
 * @author 祝君伟
 */
class PdoDb
{
    protected $tablename='';
    protected $pdo='';


    function __construct($config_array){
        $pdo = new PDO("mysql:host=".$config_array['db_host'].";dbname=".$config_array['db_name'],$config_array['db_username'],$config_array['db_password']);
        $pdo ->exec("set names".$config_array['db_charset']);
        $this->pdo=$pdo;
        //自动获取数据表封装类的名称
        //get_class获取类的名称
        //$this当前的类
        $this->tablename = $config_array['db_table'];

    }
    //获取总记录数
    function count($where=""){
        $where = empty($where) ? "":" WHERE ".$where;
        $sql ="select count(*) as num from {$this->tablename} $where";
         /*return  $sql;
        exit; */
        $pdoS = $this->pdo->query($sql);
        $arr= $pdoS->fetch(PDO::FETCH_ASSOC);
        return $arr['num'];
    }


    //增加
    //array('字段名'=>值,......)
    function insert($arr){
        //把数组转换为sql语句
        //insert into tablename() value()
        $fiedList = "";
        $valueList = "";
        foreach ($arr as $k=>$v){
            $fiedList .= ','.$k;
            $valueList .= ",'".$v."'";
        }
        $fiedList = substr($fiedList, 1);
        $valueList = substr($valueList, 1);
        //拼接sql语句
        $sql="INSERT INTO {$this->tablename}({$fiedList}) VALUE({$valueList})";
        //return $sql;
        //执行sql语句
        $re=$this->pdo->exec($sql);
        if($re){
            return $this->pdo->lastInsertId();
        }else{
            return false;
        }

    }
    //删除
    function delete($where=NULL){
        $where=isset($where)? "WHERE ".$where:'';
        $sql = "DELETE FROM {$this->tablename} $where";
        //return $sql;
        $pdoS = $this->pdo->exec($sql);
        return $pdoS;
        /* if($pdoS>0){
            return "删除成功";
        }else{
            return "删除失败";
        } */
    }
    //修改
    function update($arr,$where=NULL){
        $sql = '';
        foreach ($arr as $k => $v){
            $sql .= ($sql === NULL ? $sql : ',') .  $k . '=\'' . $v . '\'';
        }
        $sql = 'UPDATE '.$this->tablename.' SET '.$sql. ($where === NULL ? $where :' WHERE '.$where);
        /* return $sql;
        exit; */
        $pdoS = $this->pdo->exec($sql);
        return $pdoS;



    }
    //查询
    //查询一条信息
    function findOne($id){
        $pdoS = $this->pdo->query ( "desc " . $this->tablename );
        $arr = $pdoS->fetchAll ( PDO::FETCH_ASSOC );
        foreach ( $arr as $v ) {
            if ($v ['Key'] == 'PRI') {
                $fieldName = $v ['Field'];
                break;
            }
        }
        //拼装sql语句
        $sql ="SELECT * FROM {$this->tablename} WHERE $fieldName=$id";
        //echo $sql;
        $pdoS =  $this->pdo->query($sql);
        return $pdoS->fetch(PDO::FETCH_ASSOC);

    }
    //查询多条信息
    function findAll($arr=array()){
        //select 字段列表 from 表名
        //where 条件 group by 字段 having 条件 order by 字段 desc|asc limit start,length
        //select 字段列表 from 表1 as t1 join 表2 as t2 on t1.字段=t2.字段 join 表3 as t3 on t2.字段=t3.字段
        //拼sql语句
        $field = isset($arr['field']) ? $arr['field'] : "*";
        $where = isset($arr['where']) ? 'where '.$arr['where'] : '';
        $group = isset($arr['group']) ? 'group by '.$arr['group'] : '';
        $having = isset($arr['having']) ? 'having '.$arr['having'] : '';
        $order = isset($arr['order']) ? 'order by '.$arr['order'] : '';
        $limit = isset($arr['limit']) ? "limit ".$arr['limit'] : '';
        $alias = isset($arr['alias']) ? "as ".$arr['alias'] : "";
        $join = isset($arr['join']) ? "join ".$arr['join'] : '';
        $sql = "SELECT $field FROM {$this->tablename} $alias $join $where $group $having $order $limit";
        /* return $sql;
        exit;  */
        $pdoS = $this->pdo->query($sql);
        if(is_object($pdoS)){
            return $pdoS->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return array();
        }

    }
    //特殊用法sql执行语句
    function query($sql){
        if(preg_match("/^select/i", $sql)){
            $pdoS = $this->pdo->query($sql);
            return $pdoS->fetchAll(PDO::FETCH_ASSOC);
        }else {
            return  $this->pdo->exec($sql);
        }
    }
}