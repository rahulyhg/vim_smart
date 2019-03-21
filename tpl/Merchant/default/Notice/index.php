<include file="Public:header"/>

<div class="main-content">

    <!-- 内容头部 -->

    <div class="breadcrumbs" id="breadcrumbs">

        <ul class="breadcrumb">

            <li>

                <i class="ace-icon fa fa-file-excel-o"></i>

                <a href="{pigcms{:U('index')}">通知公告</a>

            </li>

            <li>公告列表</li>

        </ul>

    </div>

    <!-- 内容头部 -->

    <div class="page-content">

        <div class="page-content-area">

            <div class="row">

                <div class="col-xs-12">

                    <div>

                        <a href="{pigcms{:U('Notice/add')}" class="btn btn-success">添加公告</a>　

                    </div>

                    <div id="shopList" class="grid-view">

                        <table class="table table-striped table-bordered table-hover">

                            <thead>

                            <tr>

                                <th id="shopList_c1" width="100">标题</th>

                                <th id="shopList_c1" width="100">创建时间</th>

                                <th id="shopList_c11" width="180">操作</th>

                            </tr>

                            </thead>

                            <tbody>

                            <if condition="$list">

                                <volist name="list" id="vo">

                                    <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">

                            <td>

                                <a href="">{pigcms{$vo.title}</a>

                            </td>

                            <td>{pigcms{$vo.add_time|date="Y-m-d H:i",###}</td>

                            <td class="button-column" nowrap="nowrap">

                                <if condition="empty($vo['type'])">

                                    <a title="修改" class="green" style="padding-right:8px;" href="{pigcms{:U('edit',array('news_id'=>$vo['news_id']))}">

                                        <i class="ace-icon fa fa-pencil bigger-130"></i>

                                    </a>

                                </if>

                                <a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('del',array('news_id'=>$vo['news_id']))}">

                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>

                                </a>

                            </td>

                            </tr>

                            </volist>

                            <else/>

                            <tr class="odd"><td class="button-column" colspan="3" >无内容</td></tr>

                            </if>

                            </tbody>

                        </table>

                        {pigcms{$page}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script type="text/javascript">

    $(function(){

        jQuery(document).on('click','#shopList a.red',function(){

            if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;

        });

    });

</script>

<include file="Public:footer"/>

