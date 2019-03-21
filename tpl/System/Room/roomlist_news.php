<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a href="{pigcms{:U('PropertyService/room_add')}">
            <button id="sample_editable_1_new" class="btn sbold green">添加房间
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
<!--            <a class="btn green-haze btn-outline 1sbold uppercase" href="javascript:;">-->
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
            <th>SORT</th>
            <th>楼层</th>
            <th>单元</th>
            <th>社区</th>
            <th>业主</th>
            <th>入住单位</th>
            <th>设备</th>
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
                    <div style="color:#eee;width:10px;height:1em;overflow: hidden">{pigcms{$vo.sort}</div>
                </td>

                <td>
                    {pigcms{$vo.floor_name}
                </td>
                <td>
                    <if condition="$vo['room_name']">
                        {pigcms{$vo.room_name}
                        <else />
                        此为楼层
                    </if>

                </td>
                <td>
                    {pigcms{$village_list[$vo['village_id']]}
                </td>
                <td>
                    {pigcms{$vo.ownernames}
                </td>
                <td>
                    {pigcms{$vo.tenantname}
                </td>
                <td>
                    {pigcms{$vo.meter_code}
                </td>

                <td class="button-column">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position: absolute;">
                            <li>
                                <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('modal_room_bind_meter',array('room_id'=>$vo['id']))}">
                                    <i class="icon-docs"></i> 绑定设备
                                </a>
                            </li>
                            <li>
                                <a href="{pigcms{:U('PropertyService/room_update',array('id'=>$vo['id']))}">
                                    <i class="icon-docs"></i> 编辑
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