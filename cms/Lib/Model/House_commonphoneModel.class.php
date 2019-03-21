<?php
class House_commonphoneModel extends Model{

    protected $tableName = 'house_commonphone';

    public function getlist($column){
        if(!$column['village_id']){
            return '';
        }
        $condition_table  = array(C('DB_PREFIX').'house_commonphone'=>'p',C('DB_PREFIX').'house_commontype'=>'t');
        $condition_where = " p.village_id = t.village_id  AND p.ct_id = t.ct_id AND p.village_id=".$column['village_id'];
//        if($column['status']){
//            $condition_where .= " AND n.status = ".intval($column['status']);
//        }
        $condition_field = 'p.*,t.ct_name';

        $order = 'p.cp_time asc';
        import('@.ORG.merchant_page');
        $count_news = D('')->table($condition_table)->where($condition_where)->count();
//        dump($condition_table);
//        dump($condition_where);
//        dump($count_news);exit;
        $p = new Page($count_news,20,'page');
        $village_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit($p->firstRow.','.$p->listRows)->select();

        $return['pagebar'] = $p->show();
        $return['news_list'] = $village_list;

        return $return;
    }

    /*得到小区的新闻列表*/
    public function get_limit_list($village_id,$limit){
        return $this->field(true)->where(array('village_id'=>$village_id,'status'=>'1'))->order('`is_hot` DESC,`add_time` DESC')->limit($limit)->select();
    }

    /*得到分类下的新闻列表*/
    public function get_list_by_cid($cat_id){
        return $this->field(true)->where(array('status'=>'1','cat_id'=>$cat_id))->order('`is_hot` DESC,`add_time` DESC')->select();
    }

    public function get_one($news_id){
        return $this->field(true)->where(array('status'=>'1','news_id'=>$news_id))->find();
    }
}