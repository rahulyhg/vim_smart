<?php
/**
 * 
 * 刘畅 mysql 数据库连接模块 sql语言处理类模块
 * 
 * 当前版本：v 1.0000
 * 
 * 使用说明 : 
 *          先填写数据库配置
 *          默认加载数据库类,文件中直接引入本模块即可
 * 
 * 默认加载：
 *          $db=new liu_mysql();
 * 
 *          调用方式 : $db->子程序();
 * 
 * 
 * 数据库类 : 
 *          liu_mysql (主机，用户，密码，表名);
 * 
 * 
 * 子程序类 :
 *          1.SQL查询程序
 *          select( 表名 ，条件 ，排序， 反回状态(默认一行)， 反回结果(默认全部) ，查询条数(默认全部))
 *          
 *          调用方式 : $db->select($name,$where,$order,$type,$retu,$limit);
 * 
 *          2.SQL更新程序
 *          update( 表名 ，更新内容 ，条件)
 *          
 *          调用方式 : $db->update($name,$set,$where);  
 *       
 *          3.SQL删除程序
 *          del( 表名 ，删除条件)
 *          
 *          调用方式 : $db->del($name,$where);  
 * 
 *          4.SQL添加程序（会返回插入的ID）
 *          info( 表名 ，字段 ，内容)  
 *          
 *          调用方式 : $db->info($name,$title,$val);  
 * 
 *          5.SQL执行程序 (不直接调用)
 *          query( SQL语言)
 *          
 *          调用方式 : $db->query($sql);  
 * 
 *          6.SQL转数组程序 (不直接调用)
 *          arrty( SQL结果 ，数组方式 type 1 全部 2 一行 3 单结果)
 *          
 *          调用方式 : $db->arrty($sql,$type); 
 * 
 *          7.关闭mysql连接
 *          no()
 * 
 *          调用方式 : $db->no();
*/	

/*-----数据库配置 调用小猪cms的数据库连接文件-----*/
$SQL = require  dirname(__FILE__)."/../conf/db.php";




/*-----默认加载数据库类($db变量名，千万不可更改))-----*/

$db=new liu_mysql($SQL['DB_HOST'], $SQL['DB_USER'] , $SQL['DB_PWD'] , $SQL['DB_NAME']);


/*-----连接数据库类-----*/

class liu_mysql{
    
    
    var $conn;  //初始化数据库
    
    
    
    /*--加载类时执行程序--*/
    function __construct($SQL_host, $SQL_user, $SQL_pass, $SQL_name)  
    {
        //执行连接数据库程序
        $this->conn_mysql($SQL_host, $SQL_user, $SQL_pass, $SQL_name);  
    }
    
    
    
    /*--连接数据库程序--*/
    function conn_mysql($SQL_host, $SQL_user, $SQL_pass, $SQL_name) 
    {
        //连接数据库
        $this->conn = @mysql_connect($SQL_host, $SQL_user, $SQL_pass);  
        
        //如果连接数据库错误，输出错误信息
        if (!$this->conn)  
        {
            die('Liuchang Mysql: conn' . mysql_error()); 
        }
        
        //选择数据库表名
        $select = @mysql_select_db($SQL_name, $this->conn);  
        
        //选择数据库表名出错 输出错误信息
        if($select == false)
        {
            die("Liuchang Mysql: select database($SQL_name)"); 
        }
        
        //选择数据库连接编码
        $this->query("set names 'utf8'");
        
        return true;
    }
    
    
    
    /*--数据库语句执行--*/
    function query($sql)
    {
        //开始发送查询SET 
        $res=mysql_query($sql,$this->conn);
        
        //输出错误信息
        if(!$res){
            die('Liuchang Mysql: query ' . mysql_error()); 
        }
        
        //返回结果
        return $res;
    }
    
    
    
    /*--数据库结果转数组  type 1 全部 2 一行 3 单结果--*/
    function arrty($sql,$type=1)
    {
        //反回全部数组
        if($type == 1)
        {
            $arr = array();
            
            //循环取结果，加到arr数组
            while ($row = mysql_fetch_assoc($sql))
            {
                $arr[] = $row;
            }
            
            //反回arr全部数组
            return $arr;
        }
        
        
        //反回一行数组
        if($type == 2)
        {
            //转化成数组
            $arr=mysql_fetch_array($sql,MYSQL_ASSOC);
            
            //反回arr一行数组
            return $arr;
        }
        
        
        //反回单个数组
        if($type == 3)
        {
            //转化成数组 MYSQL_NUM 已数字为索引3
            $arr=mysql_fetch_array($sql,MYSQL_NUM);
            
            //反回arr单个
            return $arr[0];
        }
        
    }
    
    
    /*--SELECT SQL查询程序 表名 条件 排序 反回状态(默认一行) 反回结果(默认全部) 查询条数(默认全部)--*/
    function select($name,$where="",$order="",$type="2",$retu="*",$limit="")
    {
        if(empty($retu))
        {
            $retu="*";
        }
        
        //组合条件 
        if($where <> "")
        {
            $where="where ".$where." ";
        }
        
        //组合排序 
        if($order <> "")
        {
            $order="order by ".$order." ";
        }
        
        //组合条数
        if($limit <> "")
        {
            $limit="limit ".$limit." ";
        }
        
        //执行sql
        $res=$this->query("select $retu from $name $where $order $limit");
        
        //组合数组
        if($res){
            $res=$this->arrty($res,$type);
            return $res;
        }else{
            return false;
        }
        
    }
    
    
    
     /*--UPDATE SQL更新程序 表名 更新内容 条件--*/
    function update($name,$set,$where="")
    {
        //组合条件 
        if($where <> "")
        {
            $where="where ".$where;
        }
        
        //执行sql
        $res=$this->query("UPDATE $name SET $set $where");  
        
        return $res; 
    }
    
    
    
    /*--DELETE SQL删除程序 表名 删除条件--*/
    function del($name,$where)
    {
        //组合删除条件
        $where="where ".$where;
        
        //执行sql
        $res=$this->query("DELETE FROM $name $where");  
        
        return $res; 
    }
    
    
    /*--INSERT SQL添加程序 表名 字段 内容--*/
    function info($name,$title,$val)
    {
        
        //执行sql
        $res=$this->query("INSERT INTO $name($title) VALUES ($val)");  
        
        //返回插入ID
        $res=mysql_insert_id($this->conn);
        
        return $res; 
    }
    
    
    /*--关闭MYSQL连接--*/
    function no()
    {
        mysql_close($this->conn);
    }
    
}



?>