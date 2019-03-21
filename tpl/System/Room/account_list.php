<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a href="{pigcms{:U('tenantlist_news')}">
            <button id="sample_editable_1_new" class="btn sbold green">返回
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('',array('meter_type_id'=>1))}">
            <button id="sample_editable_1_new" class="btn {pigcms{$_meter_type_id=="1"?"btn-lg active":""} sbold green">水费
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('',array('meter_type_id'=>5))}">
            <button id="sample_editable_1_new" class="btn {pigcms{$_meter_type_id=="5"?"btn-lg active":""} sbold green">电费
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('property_account_list')}">
            <button id="sample_editable_1_new"
                    class="btn sbold green">物业费
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('other_account_list')}">
            <button id="sample_editable_1_new"
                    class="btn sbold green">其他费用
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('account_list2')}">
            <button id="sample_editable_1_new"
                    class="btn sbold green">分类查看
            </button>
        </a>
    </div>


    <div class="btn-group">
        <form action="" method="post">
            <select name="y" id="y" class="form-control">
                <option value="0">选择年份</option>
                <for start="2017" end="2030">
                    <option value="{pigcms{$i}" {pigcms{$year==$i?"selected='selected'":""}>{pigcms{$i}</option>
                </for>
            </select>


            <select name="m" id="m" class="form-control">
                <option value="0">选择月份</option>
                <for start="1" end="13">
                    <option value="{pigcms{$i}" {pigcms{$month==$i?"selected='selected'":""}>{pigcms{$i}月</option>
                </for>
            </select>
        </form>
    </div>
    <if condition="$_meter_type_id">
        <div class="btn-group">
            <a href="{pigcms{:U('out_account_list',array('meter_type_id'=>$_meter_type_id,'ym'=>$_ym))}">
                <button id="sample_editable_1_new" class="btn sbold green">导出
                </button>
            </a>
        </div>
    </if>

</block>

<block name="body">
    <table class="table table-striped table-bordered table-hover" id="sample_1">
        <thead>
        <tr>
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th>单元号</th>
            <th>入住单位（客户名称）</th>
            <th>业主</th>
            <th>
                <table>
                    <tr>
                        <th style="color:#3333CC">计费类型</th>
                        <th style="color:#336699">设备号</th>
                        <th style="color:#339966">上月止码</th>
                        <th style="color:#33CC33">本月止码</th>
                        <th style="color:#663366">用量</th>
                        <th style="color:#666699">单价</th>
                        <th style="color:#6699CC">倍率</th>
                        <th style="color:#66CC99">比例</th>
                        <th style="color:#993366">参考费用</th>
                        <th style="color:#993366">实际费用</th>
                    </tr>
                </table>
            </th>
            <th>总计</th>
        </tr>
        </thead>
        <tbody>
        <php>
            $sum_total_consume = 0.00;$sum_total_price = 0.00;
        </php>
        <volist name="list" id="vo">
            <tr style="background-color: #F3F4F6">
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>

                <td>
                    <div>
                        <!--/排序需要-->
                        <span style="color:#FBFCFD;text-overflow:ellipsis;display:block;width:0px;height:0">
                            {pigcms{:sprintf("%04d",$vo['room_names']?:9999)}
                        </span>
                        <!--排序需要-->
                        {pigcms{$vo.room_names}
                    </div>
                </td>
                <td>{pigcms{$vo.tenantname}</td>
                <td>
                    {pigcms{:str_replace(',',"<br >",$vo['ownernames'])}
                </td>
                <td>
                    <div >
                        <php>$total_price = 0.00;</php>
                        <foreach name="vo['room_data']" item="meter_info" key="meter_type_id">
                            <if condition="$meter_type_id eq $_meter_type_id">
                                <table>
                                    <volist name="meter_info" id="rr">
                                    <tr>
                                        <td style="color:#3333CC;cursor: pointer" title="计费类型">
                                            {pigcms{$price_type_list[$rr['price_type_id']]}
                                        </td>
                                        <td style="color:#336699;cursor: pointer" title="设备号">
                                            <a data-toggle="modal" data-target="#common_modal"
                                                href="{pigcms{:U('modal_meter_qr',array('meter_hash'=>$rr['meter_hash']))}"
                                             >
                                                {pigcms{$rr.meter_code}
                                            </a>
                                        </td>
                                        <td style="color:#339966;cursor: pointer" title="上月止码">
                                            {pigcms{$rr['last_total_consume']?:"暂无数据"}
                                        </td>
                                        <td style="color:#33CC33;cursor: pointer" title="本月止码">
                                            {pigcms{$rr['total_consume']?:"暂无数据"}
                                        </td>
                                        <td style="color:#663366;cursor: pointer" title="用量">

                                            <php>
                                                //计算总用量
                                                $sum_total_consume += $rr['consume'] * $rr['scale'];
                                            </php>
                                            {pigcms{:number_format($rr['consume'],2)?:"暂无数据"}
                                        </td>
                                        <td style="color:#666699;cursor: pointer" title="单价">
                                            {pigcms{$rr['unit_price']?:"暂无数据"}
                                        </td>
                                        <td style="color:#6699CC;cursor: pointer" title="倍率">
                                            {pigcms{$rr['rate']?:"暂无数据"}
                                        </td>
                                        <td style="color:#66CC99;cursor: pointer" title="比例">
                                            {pigcms{$rr['scale']?:"暂无数据"}
                                        </td>
                                        <td style="color:#993366;cursor: pointer" title="参考费用">
                                            {pigcms{:number_format($rr['cost'],2)?:"暂无数据"}
                                        </td>

                                        <td style="color:#993366;cursor: pointer" title="实际费用">

                                            {pigcms{:number_format(Floatval($rr['admin_defined_price'])?:$rr['cost'],2)?:"暂无数据"}
                                            <php>
                                                //计算总计费用
                                                $total_price+=Floatval($rr['admin_defined_price'])?:$rr['cost'];
                                            </php>
                                        </td>

                                    </tr>
                                    </volist>
                                </table>
                            </if>
                        </foreach>
                    </div>
                </td>
                <td>
                    <php>
                        //计算总计费用
                        $sum_total_price+=$total_price;
                    </php>
                    {pigcms{:number_format($total_price,2)?:"暂无数据"}
                </td>


            </tr>
        </volist>
        </tbody>
    </table>
    <div>
        <span class="text-right"> <strong>总计用量:{pigcms{:number_format($sum_total_consume,2)?:"暂无数据"}</strong></span>
        <span class="text-right"> <strong>总计费用:{pigcms{:number_format($sum_total_price,2)?:"暂无数据"}</strong></span>
    </div>
</block>
<block name="script">
    <script>
        console.log('123');
            $('#m').change(function(){
                var y = $('#y').val();
                var m = $(this).val();
                console.log(y);
                var ym = y+'-'+pad(m,2);
                var meter_type_id = "{pigcms{$_meter_type_id}";
                window.location.href = app.U("",{meter_type_id:meter_type_id,ym:ym});

            });

            //补0函数
            function pad(num, n) {
                if ((num + "").length >= n) return num;
                return pad("0" + num, n);
            }


    </script>

</block>