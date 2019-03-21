<?php/* * 公共文件 * * @  Writers    曾梦飞 * @  BuildTime  2017/12/21 14:42 *  */class  ExamAction extends BaseAction{    public function subject_news() {        $subjectArr = D("Exam_subject")->select();        $this->assign('subjectArr',$subjectArr);		$this->display();    }    //显示添加题库页面    public function subject_add_news() {        $this->display();    }    //执行添加题库    public function subject_save_news() {        if (D("Exam_subject")->add($_POST)) $this->success('添加成功');    }    //更新题库    public function subject_edit_news() {        $id = isset($_GET['id'])?$_GET['id']:0;        $subject_OneArr = D("Exam_subject")->where("id=$id")->find();        $this->assign('subject_OneArr',$subject_OneArr);        $this->display();    }    //更新题库数据    public function subject_edit_save_news() {        $re = D('Exam_subject')->where(array('id'=>$_POST['id']))->save($_POST);        if ($re) {            $this->success('更新成功',U('subject_news'));        }else{            $this->error('更新失败',U('subject_news'));        }    }    //删除题库    public function subject_del_news() {        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;        $re = D('Exam_subject')->where(array('id' => $id))->delete();        if ($re) {            echo 1;        } else {            echo 2;        }    }    //试题管理    public function question_news() {        //显示字段        $field = array(            'q.id',            's.subject_name',            'q.type',            'q.fraction',            'q.question',            'q.difficulty'        );        $questionArr = D('Exam_question')->alias('q')            ->field($field)            ->join('LEFT JOIN __EXAM_SUBJECT__ s on q.subject_id = s.id')            ->order('q.id asc')            ->select();        $this->assign('questionArr',$questionArr);        $this->display();    }    //显示添加试题页面    public function question_add_news() {        $subjectArr = D("Exam_subject")->select();        $this->assign('subjectArr',$subjectArr);        $this->display();    }    //执行添加试题    public function question_save_news() {        $questionArr = $_POST;        if ($_POST['type'] == 1) {            $questionArr['answer'] = $_POST['answer_1'];            unset($questionArr['answer_1']);            $questionArr['fraction'] = 2;        } elseif ($_POST['type'] == 2) {            $questionArr['answer'] = implode(',',$_POST['answer_2']);            unset($questionArr['answer_2']);            $questionArr['fraction'] = 2;        } else {            $questionArr['fraction'] = 10;        }        if ($_POST['type'] == 1 || $_POST['type'] == 2) {            $questionArr['option']['A'] = $_POST['q1'];            $questionArr['option']['B'] = $_POST['q2'];            $questionArr['option']['C'] = $_POST['q3'];            $questionArr['option']['D'] = $_POST['q4'];            $questionArr['option']['E'] = $_POST['q5'];            $questionArr['option']['F'] = $_POST['q6'];        }        $questionArr['option'] = json_encode($questionArr['option']);        $re = D('Exam_question')->add($questionArr);        if ($re) {            $this->success('添加成功');        } else {            $errorString = mysql_error();            $this->error($errorString);        }    }    //更新试题    public function question_edit_news() {        $id = isset($_GET['id'])?$_GET['id']:0;        $question_OneArr = D("Exam_question")->where("id=$id")->find();        $subjectArr = D("Exam_subject")->select();        $question_OneArr['option'] = json_decode($question_OneArr['option'],true);        if ($question_OneArr['type'] == 1 || $question_OneArr['type'] == 2) {            $question_OneArr['q1'] = $question_OneArr['option']['A'];            $question_OneArr['q2'] = $question_OneArr['option']['B'];            $question_OneArr['q3'] = $question_OneArr['option']['C'];            $question_OneArr['q4'] = $question_OneArr['option']['D'];            $question_OneArr['q5'] = $question_OneArr['option']['E'];            $question_OneArr['q6'] = $question_OneArr['option']['F'];        }        $this->assign('question_OneArr',$question_OneArr);        $this->assign('subjectArr',$subjectArr);        $this->display();    }    //更新试题数据    public function question_edit_save_news() {        $questionArr = D('Exam_question')->create();        if ($_POST['type'] == 1 || $_POST['type'] == 2) {            $questionArr['option']['A'] = $_POST['q1'];            $questionArr['option']['B'] = $_POST['q2'];            $questionArr['option']['C'] = $_POST['q3'];            $questionArr['option']['D'] = $_POST['q4'];            $questionArr['option']['E'] = $_POST['q5'];            $questionArr['option']['F'] = $_POST['q6'];        }        $questionArr['option'] = json_encode($questionArr['option']);        $re = D('Exam_question')->where(array('id'=>$questionArr['id']))->save($questionArr);        if ($re) {            $this->success('更新成功',U('question_news'));        }else{            $this->error('更新失败',U('question_news'));        }    }    //删除题库    public function question_del_news() {        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;        $re1 = D('Exam_question')->where(array('id' => $id))->delete();        $re2 = D('Exam_choice')->where(array('qid' => $id))->delete();        if ($re1 && $re2) {            echo 1;        } else {            echo 2;        }    }    //试卷管理    public function paper_news() {        //显示字段        $field = array(            'p.id',            's.subject_name',            'p.totalper',            'p.testtime',            'p.title',            'p.start_time',            'p.status',        );        $paperArr = D('Exam_paper')->alias('p')            ->field($field)            ->join('LEFT JOIN __EXAM_SUBJECT__ s on p.subject_id = s.id')            ->where(array('p.status'=>0))            ->order('p.id asc')            ->select();        //得到选题分数关系式        foreach ($paperArr as &$v) {            $id = $v['id'];            $c_arr = D('Exam_choice')->alias('c')                ->join('LEFT JOIN __EXAM_PAPER__ p on p.id = c.pid')                ->join('LEFT JOIN __EXAM_QUESTION__ q on q.id = c.qid')                ->where("p.id=$id")                ->select();            //算出选题总分            $score = '';            foreach ($c_arr as $sv) {                $score += $sv['fraction'];            }            //算出选题个数            $c_num = count($c_arr);            $v['c_score'] = $score;            $v['c_num'] = $c_num;        }        unset($v);        $this->assign('paperArr',$paperArr);        $this->display();    }    //显示添加试卷页面    public function paper_add_news() {        $subjectArr = D("Exam_subject")->select();        $this->assign('subjectArr',$subjectArr);        $this->display();    }    //执行添加试卷数据    public function paper_save_news() {        $_POST['start_time'] = time();        $re = D("Exam_paper")->add($_POST);        if ($re) {            $this->success('添加成功');        } else {            $errorString = mysql_error();            $this->error($errorString);        }    }    //显示更新试卷页面    public function paper_edit_news() {        $id = isset($_GET['id'])?$_GET['id']:0;        $paper_OneArr = D("Exam_paper")->where("id=$id")->find();        $subjectArr = D("Exam_subject")->select();        $this->assign('paper_OneArr',$paper_OneArr);        $this->assign('subjectArr',$subjectArr);        $this->display();    }    //显示更新试卷页面    public function paper_edit_save_news() {        $_POST['start_time'] = time();        $re = D('Exam_paper')->where(array('id'=>$_POST['id']))->save($_POST);        if ($re) {            $this->success('更新成功',U('paper_news'));        }else{            $this->error('更新失败',U('paper_news'));        }    }    //删除试卷    public function paper_del_news() {        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;        $re = D('Exam_paper')->where(array('id' => $id))->delete();        if ($re) {            echo 1;        } else {            echo 2;        }    }    //选题管理    public function choice_news() {        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;        $field = array(            'q.id',            's.subject_name',            'q.type',            'q.fraction',            'q.question',            'q.difficulty',        );        $questionArr = D('Exam_question')->alias('q')            ->field($field)            ->join('LEFT JOIN __EXAM_SUBJECT__ s on q.subject_id = s.id')            ->join('LEFT JOIN __EXAM_CHOICE__ c on q.id = c.qid')            ->join('LEFT JOIN __EXAM_PAPER__ p on p.id = c.pid')            ->where("p.id=$id")            ->order('q.id asc')            ->select();        $this->assign('s_id',$id);        $this->assign('questionArr',$questionArr);        $this->display();    }    //添加选题    public function choice_add_news() {        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;        $choice_arr = D('Exam_choice')->where(array('pid'=>$id))->select();        $idArr = array();        foreach ($choice_arr as $v) {            $idArr[] = $v['qid'];        }        $field = array(            'q.id',            's.subject_name',            'q.type',            'q.fraction',            'q.question',            'q.difficulty',            'p.totalper'        );        $map = array();        $idArr && $map['q.id']  = array('not in',$idArr);        $questionArr = D('Exam_question')->alias('q')            ->field($field)            ->join('LEFT JOIN __EXAM_SUBJECT__ s on q.subject_id = s.id')            ->join('LEFT JOIN __EXAM_PAPER__ p on s.id = p.subject_id')            ->where(array("p.id"=>$id))            ->where($map)            ->order('q.id asc')            ->select();        //得到选题分数关系式        $c_arr = D('Exam_choice')->alias('c')            ->join('LEFT JOIN __EXAM_PAPER__ p on p.id = c.pid')            ->join('LEFT JOIN __EXAM_QUESTION__ q on q.id = c.qid')            ->where("p.id=$id")            ->select();        //算出选题总分        $score = 0;        foreach ($c_arr as $v) {            $score += $v['fraction'];        }        //把总分传到视图上        $totalper = $questionArr[0]['totalper'];        $this->assign('questionArr',$questionArr);        $this->assign('score',$score);        $this->assign('totalper',$totalper);        $this->assign('s_id',$id);        $this->display();    }    public function choice_add_save_news() {        $idStr = $_GET['idStr'];        $sid = $_GET['sid'];        $pid = $_GET['pid'];        $score = $_GET['score'];        $totalper = $_GET['totalper'];        $id_arr = explode(',',$idStr);        $data = array();        $flag = array();        foreach ($id_arr as $k => $v) {            //算出单题分数            $q_sarr = D("Exam_question")->field('fraction')->where("id=$v")->find();            $q_s = $q_sarr['fraction'];            if (($score + $q_s) <= $totalper) {                $data['pid'] = $sid;                $data['qid'] =  $v;                $res = D('Exam_choice')->add($data);            } else {                $res = false;            }            if (!$res) $flag[] = $v;        }        if (count($flag) > 1) {            $fStr = implode(',',$flag);        } elseif(count($flag) == 1) {            $fStr = $flag[0];        }        if ($flag) {            echo $fStr;        } else {            echo 1;        }    }    //取消选题    public function choice_del_news() {        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;        $pid = isset($_REQUEST['pid']) ? intval($_REQUEST['pid']) : 0;        $re = D('Exam_choice')->where(array('qid'=>$id,'pid'=>$pid))->delete();        if ($re) {            echo 1;        } else {            echo 2;        }    }    //批量移除    public function choice_all_del_news() {        $idStr = I("get.idStr");        $pid = I("get.pid");        if (!strpos($idStr,',')) {            $re = D('Exam_choice')->where(array('qid'=>$idStr,'pid'=>$pid))->delete();            if ($re) {                echo 1;            } else {                echo $idStr;            }        } else {            $id_arr = explode(',',$idStr);            $flag = array();            foreach ($id_arr as $v) {                $re = D('Exam_choice')->where(array('qid'=>$v,'pid'=>$pid))->delete();                if (!$re) $flag[] = $v;            }            //计算出错误个数            if (count($flag) > 1) {                $fStr = implode(',',$flag);            } elseif(count($flag) == 1) {                $fStr = $flag[0];            }            //返回到ajax            if ($flag) {                echo $fStr;            } else {                echo 1;            }        }    }    //自动选题    public function choice_zidong_add_news() {        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;        $choice_arr = D('Exam_choice')->where(array('pid'=>$id))->select();        $idArr = array();        foreach ($choice_arr as $v) {            $idArr[] = $v['qid'];        }        $field = array(            'q.id',            'q.subject_id',            's.subject_name',            'q.type',            'q.fraction',            'q.question',            'q.difficulty',            'p.totalper'        );        $map = array();        $idArr && $map['q.id']  = array('not in',$idArr);        $questionArr = D('Exam_question')->alias('q')            ->field($field)            ->join('LEFT JOIN __EXAM_SUBJECT__ s on q.subject_id = s.id')            ->join('LEFT JOIN __EXAM_PAPER__ p on s.id = p.subject_id')            ->where(array("p.id"=>$id))            ->where($map)            ->order('q.id asc')            ->select();        $s_id = $questionArr[0]['subject_id'];        //得到选题分数关系式        $c_arr = D('Exam_choice')->alias('c')            ->join('LEFT JOIN __EXAM_PAPER__ p on p.id = c.pid')            ->join('LEFT JOIN __EXAM_QUESTION__ q on q.id = c.qid')            ->where("p.id=$id")            ->select();        //算出选题总分        $score = 0;        foreach ($c_arr as $v) {            $score += $v['fraction'];        }        //把总分传到视图上        $totalper = $questionArr[0]['totalper'];        $this->assign('questionArr',$questionArr);        $this->assign('score',$score);        $this->assign('totalper',$totalper);        $this->assign('s_id',$s_id);        $this->display();    }    public function choice_zidong_save_news() {        $pid = I('post.p_id');//试卷ID        $sid = I('post.s_id');//题库类型        $totalper = I('post.totalper');//总分        $score = I('post.score');//当前选题总分        $difficulty = I('post.difficulty');//难度        $mc = I('post.mc');//模式类型        $choice_arr = D('Exam_choice')->alias('c')            ->field('count(*) as num')            ->join('LEFT JOIN __EXAM_QUESTION__ q on q.id = c.qid')            ->where(array('pid'=>$pid))            ->group('q.type')            ->select();        $type_one_num = $choice_arr[0]['num'];//单选题个数        $type_two_num = $choice_arr[1]['num'];//多选题个数        $type_three_num = $choice_arr[2]['num'];//主观题个数        //分差        $poor = $totalper - $score;        //算出已选题目数        $choice_arr = D('Exam_choice')->where(array('pid'=>$pid))->select();        $idArr = array();        foreach ($choice_arr as $v) {            $idArr[] = $v['qid'];        }        $map = array();        $map['s.id'] = array('eq',$sid);        $idArr && $map['q.id']  = array('not in',$idArr);        $difficulty && $map['q.difficulty'] = array('eq',$difficulty);        //添加主观题数量        $d = 4 - $type_three_num;        if ($poor >= 10*$d && $type_three_num < 4 && $mc == 1) {            $arr = D('Exam_question')->alias('q')                    ->field('q.id')                    ->join('LEFT JOIN __EXAM_SUBJECT__ s on q.subject_id = s.id')                    ->where(array('q.type'=>3))                    ->where($map)                    ->order('rand()')                    ->limit($d)                    ->select();            $i = 0;            foreach ($arr as $v) {                $qid = $v['id'];                $data = array('pid'=>$pid,'qid'=>$qid);                D('Exam_choice')->add($data);                $i++;            }            $poor -= $i*10;            //设置选择题数量            $num_all = $poor/2;            $arr2 = D('Exam_question')->alias('q')                ->field('q.id')                ->join('LEFT JOIN __EXAM_SUBJECT__ s on q.subject_id = s.id')                ->where(array('q.type'=>2))                ->where($map)                ->order('rand()')                ->limit($num_all/2)                ->select();            $j = 0;            foreach ($arr2 as $v2) {                $qid = $v2['id'];                $data = array('pid'=>$pid,'qid'=>$qid);                D('Exam_choice')->add($data);                $j++;            }            //最后单选题数量            $num_end = $num_all - $j;            $arr3 = D('Exam_question')->alias('q')                ->field('q.id')                ->join('LEFT JOIN __EXAM_SUBJECT__ s on q.subject_id = s.id')                ->where(array('q.type'=>1))                ->where($map)                ->order('rand()')                ->limit($num_end)                ->select();            foreach ($arr3 as $v3) {                $qid = $v3['id'];                $data = array('pid'=>$pid,'qid'=>$qid);                D('Exam_choice')->add($data);            }            //查询是否达到总分            //得到选题分数关系式            $c_arr = D('Exam_choice')->alias('c')                ->join('LEFT JOIN __EXAM_PAPER__ p on p.id = c.pid')                ->join('LEFT JOIN __EXAM_QUESTION__ q on q.id = c.qid')                ->where("p.id=$pid")                ->select();            //算出选题总分            $score = 0;            foreach ($c_arr as $v) {                $score += $v['fraction'];            }            if ($score == $totalper) {                $this->success('选题完成',U('paper_news'));            } else {                $this->error('选题未完成',U('paper_news'));            }        } else {            //直接分配选择题            $num_all = $poor/2;            $arr2 = D('Exam_question')->alias('q')                ->field('q.id')                ->join('LEFT JOIN __EXAM_SUBJECT__ s on q.subject_id = s.id')                ->where(array('q.type'=>2))                ->where($map)                ->order('rand()')                ->limit($num_all/2)                ->select();            $j = 0;            foreach ($arr2 as $v2) {                $qid = $v2['id'];                $data = array('pid'=>$pid,'qid'=>$qid);                D('Exam_choice')->add($data);                $j++;            }            //最后单选题数量            $num_end = $num_all - $j;            $arr3 = D('Exam_question')->alias('q')                ->field('q.id')                ->join('LEFT JOIN __EXAM_SUBJECT__ s on q.subject_id = s.id')                ->where(array('q.type'=>1))                ->where($map)                ->order('rand()')                ->limit($num_end)                ->select();            foreach ($arr3 as $v3) {                $qid = $v3['id'];                $data = array('pid'=>$pid,'qid'=>$qid);                D('Exam_choice')->add($data);            }            //查询是否达到总分            //得到选题分数关系式            $c_arr = D('Exam_choice')->alias('c')                ->join('LEFT JOIN __EXAM_PAPER__ p on p.id = c.pid')                ->join('LEFT JOIN __EXAM_QUESTION__ q on q.id = c.qid')                ->where("p.id=$pid")                ->select();            //算出选题总分            $score = 0;            foreach ($c_arr as $v) {                $score += $v['fraction'];            }            if ($score == $totalper) {                $this->success('选题完成',U('paper_news'));            } else {                $this->error('选题未完成',U('paper_news'));            }        }    }    public function create_text_news() {        $id = I('get.id');        $this->assign('id',$id);        $this->display();    }    public function create_text_save_news() {        $text_time = strtotime(I('post.text_time'));        $id = I('post.id');        $re = D('Exam_paper')->where(array('id'=>$id))->save(array('status'=>1,'text_time'=>$text_time));        if ($re) {            $this->success('添加成功');        } else {            $this->error('添加失败');        }    }    public function text_news() {        $paper_open_arr = D('Exam_paper')            ->where(array('status'=>1))            ->order('text_time asc')            ->select();        foreach ($paper_open_arr as &$v) {            $re = D('Exam_mark')                ->where(array('userid'=>$_SESSION['admin_id'],'pid'=>$v['id']))                ->find();            $re && $v['m'] = 1;            $v['end_time'] = $v['text_time'] + $v['testtime']*60;        }        unset($v);        $this->assign('paper_open_arr',$paper_open_arr);        $this->display();    }    public function text_del_news() {        $id = I('post.id');        $re = D('Exam_paper')->where(array('id'=>$id))->save(array('status'=>0,'text_time'=>''));        if ($re) {            echo 1;        } else {            echo 2;        }    }    public function text_start_news() {        $id = I('get.id');        $field = array(            'c.id',            'q.subject_id',            'p.title',            'q.type',            'q.fraction',            'q.question',            'q.difficulty',            'p.totalper',            'q.option',            'p.text_time',            'p.testtime'        );        $map['p.id'] = array('eq',$id);        //单选题        $paper_arr_1 = D('Exam_paper')->alias('p')            ->field($field)            ->join('LEFT JOIN __EXAM_CHOICE__ c on p.id = c.pid')            ->join('LEFT JOIN __EXAM_QUESTION__ q on q.id = c.qid')            ->where($map)            ->where(array('q.type'=>1))            ->select();        foreach ($paper_arr_1 as &$v) {            $v['option'] = json_decode($v['option'],1);        }        unset($v);        //多选题        $paper_arr_2 = D('Exam_paper')->alias('p')            ->field($field)            ->join('LEFT JOIN __EXAM_CHOICE__ c on p.id = c.pid')            ->join('LEFT JOIN __EXAM_QUESTION__ q on q.id = c.qid')            ->where($map)            ->where(array('q.type'=>2))            ->select();        foreach ($paper_arr_2 as &$v) {            $v['option'] = json_decode($v['option'],1);        }        unset($v);        //主观题        $paper_arr_3 = D('Exam_paper')->alias('p')            ->field($field)            ->join('LEFT JOIN __EXAM_CHOICE__ c on p.id = c.pid')            ->join('LEFT JOIN __EXAM_QUESTION__ q on q.id = c.qid')            ->where($map)            ->where(array('q.type'=>3))            ->select();        foreach ($paper_arr_3 as &$v) {            $v['option'] = json_decode($v['option'],1);        }        unset($v);//        dump($paper_arr_2[0]['option']);exit;        $title = $paper_arr_1[0]['title'];//标题        $totalper = $paper_arr_1[0]['totalper'];//总分        $text_time = $paper_arr_1[0]['text_time'];//考试开始时间        $testtime = $paper_arr_1[0]['testtime'];//考试时长        $subject_id = $paper_arr_1[0]['subject_id'];//题库id        $end_time = $text_time + $testtime*60;//考试结束时间        $this->assign('pid',$id);        $this->assign('title',$title);        $this->assign('totalper',$totalper);        $this->assign('text_time',$text_time);        $this->assign('testtime',$testtime);        $this->assign('subject_id',$subject_id);        $this->assign('end_time',$end_time);        $this->assign('paper_arr_1',$paper_arr_1);        $this->assign('paper_arr_2',$paper_arr_2);        $this->assign('paper_arr_3',$paper_arr_3);        $this->display();    }    public function text_save_news() {        $userid = $_SESSION['system']['id'];        $field = array(            'a.realname',            'd.deptname',        );        $map['a.id'] = array('eq',$userid);        $admin_arr = D('admin')->alias('a')            ->field($field)            ->join('LEFT JOIN __DEPARTMENT__ d on a.department_id = d.id')            ->where($map)            ->find();        $username = $admin_arr['realname'];        $department = isset($admin_arr['deptname'])?$admin_arr['deptname']:'其他';        $answer_arr = $_POST;        $data = array();        foreach ($answer_arr as $k=>$v) {            if (strpos($k,'s_') > -1) {                $i = substr($k,2);                $data[1][$i] = $v;            } elseif (strpos($k,'d_') > -1) {                $j = substr($k,2);                $sv = implode(',',$v);                $data[2][$j] = $sv;            } elseif (strpos($k,'z_') > -1) {                $s = substr($k,2);                $data[3][$s] = $v;            }        }        $arr['userid'] = $userid;//用户id        $arr['username'] = $username;//真实姓名        $arr['department'] = $department;//所属部门        $arr['data'] = json_encode($data);//答题内容        $arr['submit_time'] = time();//提交时间        $arr['title'] = $answer_arr['title'];        $arr['subject_id'] = $answer_arr['subject_id'];        $arr['pid'] = $answer_arr['pid'];        $re = M('exam_mark')->data($arr)->add();        if ($re) $this->success('提交成功',U('text_news'));    }}