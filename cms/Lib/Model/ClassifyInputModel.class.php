<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/6
 * Time: 15:28
 * @update-time: 2017-07-06 15:28:46
 * @author: 王亚雄
 */

/**
 * Class ClassifyInputModel
 * classify自定义地段所对应的表单类型
 */
class ClassifyInputModel extends Model
{
    protected $table_name = 'classify_inputtype';
    protected $cid;
    protected $cat_field;
    protected $default_html = '<input type="text" class="input" name="v[]" value="%v%">';

    public function __construct($cid)
    {
        parent::__construct();
        $this->cid = $cid;
        $this->get_cat_field();
    }

    /**
     * 根据短标记获取表单html
     * @param $url 短标记
     * @param $v   值
     * @return mixed
     */
    public function get_input_by_url($url,$v){
        $cat_field = $this->cat_field;
        foreach($cat_field as $field){
            if($field['url']==$url){
                //值处理
                if(is_array($v)){
                    $v = explode(',',$v);
                }

                if($field['type']==1&&isset($field['unit'])&&!empty($field['unit'])){
                    $v = "$v/{$field['unit']}";
                }

                if($field['type']==5 && !empty($v)){
                    $v = htmlspecialchars_decode($v,ENT_QUOTES);
                }

                //替换
                if($field['type']==4){
                    $field['html'] = preg_replace("/%\s*". $v ."\s*%/","selected='selected'",$field['html']);
                }else{
                    $field['html'] = preg_replace('/%v%/',$v,$field['html']);
                }
                //删除所有未替换的标记
                $field['html'] = preg_replace("/%.*?%/","",$field['html']);

                return $field['html'];
            }
        }
    }

    /**
     * 根据分类id获取该分类所有的表单属性
     * @param $cid 分类ID
     * @return array
     */
    public function get_cat_field(){
        $cid = $this->cid;
        $model = M('classify_category');
        $cat_info = $model->where('cid=%d',$cid)->find();
        $cat_field = unserialize($cat_info['cat_field']);
        foreach($cat_field as &$field){
            $field['html'] = $this->build_tpl($field);
        }
        return $this->cat_field = $cat_field;
    }


    /**
     * 创建tpl
     * @param $fileld
     * @return string
     */
    public function build_tpl($fileld){
        $input_type = $fileld['type'];
        $html = "";
        switch($input_type){
            case 0 :
                break;
            case 1 :
                break;
            case 2 :
                break;
            case 3 :
                break;
            case 4 :
                $values = $fileld['opt'];
                $html .= '<select class="decorate" name="v[]">';
                $html .= '<option value="">请选择</option>';
                foreach($values as $k=> $v){
                    $html .= '<option %'.$v.'% value="' .$v. '">' .$v. '</option>';
                }
                $html .= '</select>';
                break;
            case 5 :
                $html = '<textarea name="v[]" id="" cols="90" rows="5">%v%</textarea>';
                break;
        }

        return $html?:$this->default_html;
    }

}


?>

