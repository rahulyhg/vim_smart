<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/2
 * Time: 16:42
 */
class HappyAction extends BaseAction
{
    public function raffle_ticket_step1_news(){

        $this->display('raffle_ticket_step1');
    }

    public function raffle_ticket_step2(){
        $file = $_FILES['test'];
        $data = $this->excel_to_data($file);
        S('raffle_ticket_data',$data['body'],3600);
        $this->assign('data',$data);
        $this->display('raffle_ticket_step2');
    }

    public function raffle_ticket_step3($offset="",$length="150"){
        $list = S('raffle_ticket_data');
        //空白券
        for($i=0; $i<63 ;$i++){
            $list[]=array(
                'ticket_no'=>"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
                'company'=>"&nbsp",
//                'section'=>"&nbsp",
//                'project'=>"&nbsp",
                'name'=>"&nbsp",
            );
        }
        if($offset!==""){
            $list = array_slice($list,$offset,$length);
        }
        $tmp = array();
        foreach($list as $key =>$row){
            $i = floor($key/6);
            $tmp[$i][] = $row;
        }

        $this->assign('list',$tmp);
        $this->display();
    }

    /**
     * 表格数据导入1
     * 文件参考格式
     * http://www.hdhsmart.com/upload/example/cjq.xlsx
     */
    public function excel_to_data($file,$village_id){
        $arr = import_excel($file,'E');
        $title = array_shift($arr);
        $tmp = array();
        foreach ($arr as $key => $row){
            if($row[4]){
                list(
                    $tmp[$key]['ticket_no'],
                    $tmp[$key]['company'],
                    $tmp[$key]['section'],
                    $tmp[$key]['project'],
                    $tmp[$key]['name'])
                    = $row;
            }

        }

        return  ['title'=>$title,'body'=>$tmp];
    }
}