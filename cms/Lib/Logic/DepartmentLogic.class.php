<?php
/**
 * 控制的逻辑层MODEL
 * 祝君伟
 * Date: 2017/6/13
 * Time: 9:59
 */
class DepartmentLogic extends Model{

    protected $tableName = 'department';

    public function tree_array_to_option($tree_list){
        //返回数组
        $returnArray = array();
        //主体循环
        foreach ($tree_list as $key=>$value){
            $returnArray[$value['id']]['name'] = $value['text'];
            $returnArray[$value['id']]['id'] = $value['id'];
            if(isset($value['children'])){
                foreach ($value['children'] as $key1=>$value1){
                    $returnArray[$value1['id']]['name'] = '|_'.$value1['text'];
                    $returnArray[$value1['id']]['id'] = $value1['id'];
                    if(isset($value1['children'])){
                        foreach ($value1['children'] as $key2=>$value2){
                            $returnArray[$value2['id']]['name'] = '|__'.$value2['text'];
                            $returnArray[$value2['id']]['id'] = $value2['id'];
                            if(isset($value2['children'])){
                                foreach ($value2['children'] as $key3=>$value3){
                                    $returnArray[$value3['id']]['name'] = '|___'.$value3['text'];
                                    $returnArray[$value3['id']]['id'] = $value3['id'];
                                    if(isset($value3['children'])){
                                        foreach ($value3['children'] as $key4=>$value4){
                                            $returnArray[$value4['id']]['name'] = '|____'.$value4['text'];
                                            $returnArray[$value4['id']]['id'] = $value4['id'];
                                            if(isset($value4['children'])){
                                                foreach ($value4['children'] as $key5=>$value5){
                                                    $returnArray[$value5['id']]['name'] = '|_____'.$value5['text'];
                                                    $returnArray[$value5['id']]['id'] = $value5['id'];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $returnArray;
    }
}