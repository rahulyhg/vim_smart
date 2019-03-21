<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'信息审核',
    'describe'=>'',
);
$breadcrumb = array(
    array('分类信息','#'),
    array('信息审核','#'),
);

$add_action = array(

);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>
        <th>
            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                <span></span>
            </label>
        </th>
        <th>ID</th>
        <th>一级分类</th>
        <th>二级分类</th>
        <th>标题</th>
        <th>联系人姓名</th>
        <th>联系人电话</th>
        <th>最后更改时间</th>
        <th>状态</th>
        <th class="textcenter">操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="!empty($needCheck)">
        <volist name="needCheck" id="vo">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$vo.id}</td>
                <td>{pigcms{$ClassifyArr[$vo['fcid']]}</td>
                <td>{pigcms{$ClassifyArr[$vo['cid']]}</td>
                <td>{pigcms{$vo.title}</td>
                <td>{pigcms{$vo.lxname}</td>
                <td>{pigcms{$vo.lxtel}</td>

                <td>{pigcms{$vo.updatetime|date='Y-m-d H:i:s',###}</td>
                <td class="red">未审核</td>
                <td class="textcenter"><a href="javascript:void(0);" onclick="toCheck({pigcms{$vo.id});">审核</a>&nbsp; | &nbsp;<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Classify/infodetail',array('vid'=>$vo['id']))}','查看信息详情',680,560,true,false,false,verifybtn,'edit',true);">查看详细</a>&nbsp; | &nbsp;<a href="javascript:void(0);" onclick="toDelItem({pigcms{$vo.id});">删除</a></td>
            </tr>
        </volist>

        <else/>
        <tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
    </if>
    </tbody>
</table>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script type="text/javascript">
    function toCheck(id){
        if(confirm('您确定审核通过此项吗？')){
            $.post("{pigcms{:U('Classify/toVerify')}",{vid:id},function(data){
                data=parseInt(data);
                if(!data){
                    window.location.reload();
                }
            },'JSON');
        }else{
            return false;
        }
    }
    /***删除***/
    function toDelItem(id){
        if(confirm('您确定删除此项吗？')){
            $.post("{pigcms{:U('Classify/delItem')}",{vid:id},function(data){
                data=parseInt(data);
                if(!data){
                    window.location.reload();
                }
            },'JSON');
        }else{
            return false;
        }
    }
</script>




<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
