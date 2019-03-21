<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/3
 * Time: 9:02
 */
class DateModel {
    function __construct()
    {
    }
    /**
     * 处理日期加一段时间，兼容闰年和二月份
     * @author zhukeqin
     * @param string $date 日期
     * @param string $type add-往后推移   sub-往前推移
     * @param string $changenum 改变的数值，跟changesuffix一起使用
     * @param string $changesuffix 月-month   天-day
     * @param int 	 $suffix 生成的日期日固定 如果suffix=8 则生成的日期为：'YYYY-MM-08'
     * @param bool 	 $indate 是否包含当天 如：date=2016-11-05,indate=false,结果为:2016-12-05,indate=true,结果为:2016-12-04
     * @param string $return_type 输入所需返回的日期格式
     * @param int $defaultday 设置默认日期如设置30  则在可以状态下设置30
     * @return boolean
     */
    function change_date($date, $changenum = 0, $changesuffix = 'month', $suffix = 0, $type = 'add', $indate = true,$return_type='Y-m-d',$defaultday=0){
        if(!$date || $date == ''){
            return false;
        }
        //对返回格式进行处理
        $ym_list=explode('-',$return_type);
        $ym=$ym_list['0'].'-'.$ym_list['1'].'-';
        $d=$ym_list['2'];
        $ym_first=$ym_list['0'].'-'.$ym_list['1'].'-';
        $ym_first .=$ym_list['2']=='d'?'01':'1';


        if($changenum == 0){
            if((int)$suffix == 0){
                return $date;
            }else{
                return date($return_type,strtotime(date($ym.$suffix,strtotime($date))));
            }
        }else{
            if($changesuffix == 'day'){
                $tempday = date($d,strtotime($date));
                $tempday += $changenum;
            }elseif($changesuffix == 'month'){
                $tempday =$defaultday?$defaultday:date($d,strtotime($date));
            }
            if($type == 'add'){
                $change = '+'.$changenum.' '.$changesuffix;
            }else{
                $change = '-'.$changenum.' '.$changesuffix;
            }
            $tempdate = date($ym_first,strtotime($date));
            $microtempdate = strtotime($change, strtotime($tempdate));
            $enddateallday = date('t',$microtempdate);
            if($tempday > $enddateallday){
                if($suffix > 0){
                    if($enddateallday > $suffix){
                        $enddatetemp = date($return_type,strtotime(date($ym.$suffix,$microtempdate)));
                    }else{
                        $enddatetemp = date($return_type,strtotime(date($ym.$enddateallday,$microtempdate)));
                    }

                }else{
                    if($changesuffix == 'day'){
                        $enddatetemp = date($return_type,strtotime($change, strtotime($date))-86400);
                    }else{
                        $enddatetemp = date($ym.$enddateallday,$microtempdate);
                    }
                }

            }else{
                if($suffix > 0){
                    if($tempday > $suffix){
                        $enddatetemp = date($ym.$suffix,$microtempdate);
                    }else{
                        $enddatetemp = date($ym.$tempday,$microtempdate);
                    }
                }else{
                    if($indate){
                        $enddatetemp = date($return_type,strtotime(date($ym.$tempday,$microtempdate))-86400);
                    }else{
                        $enddatetemp = date($ym.$tempday,$microtempdate);
                    }
                }

            }
            return $enddatetemp;
        }
    }

}