<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">



    <div class="btn-group">
        <a href="{pigcms{:U('add_owner',array('village_id'=>$_GET['village_id']))}">
            <button id="sample_editable_1_new" class="btn sbold green">添加业主
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('owner_import_step1')}">
            <button id="sample_editable_1_new" class="btn sbold green">批量导入业主
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
<!--    <if condition="$admin eq 1">-->
<!--        <div class="btn-group">-->
<!--            <a class="btn green-haze btn-outline sbold uppercase" href="javascript:;" data-toggle="dropdown">-->
<!--                <i class="fa fa-building"></i> 当前:{pigcms{$presentVillage}-->
<!--                <i class="fa fa-angle-down"></i>-->
<!--            </a>-->
<!--            <ul class="dropdown-menu">-->
<!--                <li>-->
<!--                    <a href="{pigcms{:U('')}">-->
<!--                        <i class="fa fa-building-o"></i> 全部显示 </a>-->
<!--                </li>-->
<!--                <foreach name="villageArray" item="vo">-->
<!--                    <li>-->
<!--                        <a href="{pigcms{:U('',array('village_id'=>$vo['village_id']))}">-->
<!--                            <i class="fa fa-building-o"></i> {pigcms{$vo.village_name} </a>-->
<!--                    </li>-->
<!--                </foreach>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <else/>-->
<!--        <div class="btn-group">-->
<!--            <a class="btn green-haze btn-outline sbold uppercase" href="javascript:;">-->
<!--                <i class="fa fa-building"></i> 当前:{pigcms{$presentVillage}-->
<!--            </a>-->
<!--        </div>-->
<!--    </if>-->
</block>

<block name="body">
    <table class="table table-striped table-bordered table-hover table-checkable order-column"  id="sample_1">
        <thead>
        <!--        入驻状态	入驻单位	业主	总面积	缴费状态	操作-->
        <tr>
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th>ID</th>
            <th>房间</th>
            <th>业主</th>
            <th>联系人</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="list" id="vo">
            <tr  class="odd gradeX">
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>
                    {pigcms{$vo.id}
                </td>
                <td>
                    <!--排序需要-->
                    <span style="color:#FBFCFD;text-overflow:ellipsis;display:block;width:0px;height:0">
                            {pigcms{:sprintf("%04d",$vo['room_names']?:9999)}
                        </span>
                    <!--/排序需要-->
                  {pigcms{$vo.room_names}
                </td>
                <td>
                    {pigcms{$vo.ownername}
                </td>
                <td>
                    {pigcms{$vo.name} | {pigcms{$vo.phone}
                </td>


                <td class="button-column">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position: absolute; margin-left:-90px;">
                            <li>
                                <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('modal_owner_bind_room',array('oid'=>$vo['id']))}">
                                    <i class="icon-docs"></i> 绑定房间
                                </a>
                            </li>
                            <li>
                                <a href="{pigcms{:U('edit_owner',array('oid'=>$vo['id']))}">
                                    <i class="icon-docs"></i> 编辑
                                </a>
                            </li>
                            <li>
                                <a href="{pigcms{:U('del_owner_act',array('oid'=>$vo['id']))}" onclick="return window.confirm('删除后不可恢复！确认删除？')">
                                    <i class="icon-docs"></i> 删除
                                </a>
                            </li>
                        </ul>
                    </div>

                </td>
            </tr>
        </volist>
        </tbody>
    </table>
</block>