<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a href="{pigcms{:U('news_add')}">
            <button id="sample_editable_1_new" class="btn sbold green">添加新闻
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
</block>
<block name="body">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th> 编号 </th>
            <th> 新闻title </th>
            <th> 发布时间 </th>
            <th> 热门 </th>
            <th>所属分类</th>
            <th>所属社区</th>
            <th>已微信通知</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <foreach name="news_list" item="v">
            <tr class="odd gradeX">
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$v.news_id} </td>
                <td>{pigcms{$v.title}</td>
                <td>{pigcms{$v.add_time|date='Y-m-d H:i:s',###}</td>
                <td><if condition="$v.is_hot eq '1'">是<else/>否</if></td>
                <td>{pigcms{$v.cat_name}</td>
                <td><if condition="$v.village_name eq ''">全社区通用<else/>{pigcms{$v.village_name}</if></td>
                <td><if condition="$v.is_notice eq '1'">是<else/>否</if></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">
                            <li>
                                <a href="{pigcms{:U('news_edit',array('news_id'=>$v['news_id']))}">
                                    <i class="icon-docs"></i> 编辑 </a>
                            </li>
                            <li>
                                <if condition="$v.status eq '1'">
                                    <if condition="$v.is_notice eq '0'">
                                        <a href="{pigcms{:U('send',array('news_id'=>$v['news_id']))}">
                                            <i class="icon-docs"></i> 微信群发业主 </a>
                                    </if>
                                    <else/>
                                    <a href="#">
                                        <i class="icon-docs"></i>新闻已被关闭 </a>
                                </if>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        </foreach>
        </tbody>
    </table>
</block>