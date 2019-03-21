<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/1
 * Time: 10:00
 */

/**
 * Class NoticeAction
 * 通知公告
 * @update-time: 2017-07-01 10:01:28
 * @author: 王亚雄
 */
class NoticeAction extends BaseAction
{
    /**
     * 公告列表
     */
    public function index(){
        $model = M('house_village_news');
        $map = array();
        $map['status'] = array('eq',1);
        $map['village_id'] = array('eq',session('merchant.village_id'));
        $map['mer_id'] = array('eq',session('merchant.mer_id'));
        $map['is_hot'] = array('eq', 0 );
        $field = array(
            'news_id',
            'title',
            'add_time',
        );
        $count = $model->where($map)->count();
        import('@.ORG.merchant_page');
        $page = new Page($count, 20);
        $list = $model
            ->field($field)
            ->where($map)
            ->order('add_time desc')
            ->limit($page->firstRow,$page->listRows)
            ->select();

        $this->assign('list',$list);
        $this->assign('page',$page->show());
        $this->display();
    }

    /**
     * 添加公告
     */
    public function add(){
        if(IS_POST){
            $_POST = I('post.');//I 方法默认会htmlspecialchars过滤
           $data = array(
            'title'     =>I('post.title'), //标题
            'content'   =>fulltext_filter($_POST['content']), //内容
            'add_time'  =>time(), //添加时间
            'status'    =>1, //状态
            'is_hot'    =>0,//是否热门
            'cat_id'    =>0,//分类ID
            'village_id'=>session('merchant.village_id'),//社区Id
            'is_notice' =>0,//需要已经微信通知所有业主 1是 0否
            'url'       =>I('post.url'),//外链
            'mer_id'    =>session('merchant.mer_id'),//商家ID
           );
           $num = M('house_village_news')->add($data);
           if($num){
               $this->success("添加成功");
           }else{
               $this->error("发生错误| " . mysql_error());
           }
        }else{
            $this->display();
        }


    }

    public function edit(){
        $model = M('house_village_news');
        $news_id = I('get.news_id');
        if(IS_POST){
            $_POST = I('post.');//I 方法默认会htmlspecialchars过滤
            $data = array(
                'title'     =>I('post.title',""), //标题
                'content'   =>fulltext_filter($_POST['content'])?:"", //内容
                'add_time'  =>time(), //修改时间
                'url'       =>I('post.url',""),//外链
            );
            $num =  $model->where('news_id=%d',$news_id)->save($data);
            if($num){
                $this->success("修改成功");
            }else{
                $this->error("发生错误| " . mysql_error());
            }
        }else{



            $info =  $model->where('news_id=%d',$news_id)->find();
            $info['content'] = htmlspecialchars_decode(fulltext_filter($info['content']));
            $this->assign('image_text',$info);
            $this->display();
        }

    }

    public function del(){
        $model = M('house_village_news');
        $news_id = I('get.news_id');
        $res =  $model->where('news_id=%d',$news_id)->delete();
        if($res){
            $this->success("删除成功");
        }else{
            $this->error(mysql_error());
        }
    }
}