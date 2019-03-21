<?php

namespace Admin\Model;

use Think\Model;

class ActtypeModel extends Model{
    
    //自动完成方法，系tp系统函数
    protected $_auto=array(
        //array('add_time','time',1,'function'), //添加新记录时会触发此自动完成
        //array('upd_time','time',2,'function'), //更新数据时才会触发此自动完成
    );
    
    
    
}

