<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal-head">
    <style>
        .bg-floor{
            background-color: #00f0ff;
        }
    </style>
</block>
<block name="modal_body">
    <div id="owner_bind_room">
        <input type="text" id="search"  />
    </div>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>房间号</th>
            <th>绑定业主</th>
        </tr>
        </thead>
        <tbody id="haha">
        <foreach name="list" item="vo">
            <tr>
                <td>{pigcms{$vo.r_name}</td>
                <td>
                    <if condition="$vo['bind_status'] eq 0"><button class="btn btn-default btn-sm" onclick="bind({pigcms{$vo.id},this)">绑定</button>
                        <else />
                        <button class="btn btn-danger btn-sm" onclick="unbind({pigcms{$vo.id},this)">解绑</button>
                    </if>
                </td>
            </tr>
        </foreach>

        </tbody>
    </table>

</block>
<block name="modal_script">
    <script>
        var oid = "{pigcms{$oid}";
        $("#search").keyup(function(){
            var search = $("#search").val();
            $.ajax({
                url:"{pigcms{:U('Room/modal_owner_bind_room_sq_ajax')}",
                data:'search='+search+"&oid="+oid,
                type:'get',
                success:function(re){
                    $("#haha").html(re);
                }
            })
        })


        function bind(id,el) {
            $.ajax({
                url:"{pigcms{:U('Room/modal_room_ajax_bind')}",
                data:'id='+id+"&oid="+oid,
                type:'get',
                success:function(re){
                    if (re == 1) {
                        alert("绑定成功");
                        $(el).parent().html("<button class=\"btn btn-danger btn-sm\" onclick=\"unbind({pigcms{$vo.id},this)\">解绑</button>");
                    } else {
                        alert("绑定失败");
                    }
                }
            })
        }

        function unbind(id,el) {
            $.ajax({
                url:"{pigcms{:U('Room/modal_room_ajax_unbind')}",
                data:'id='+id+"&oid="+oid,
                type:'get',
                success:function(re){
                    if (re == 1) {
                        alert("解绑成功");
                        $(el).parent().html("<button class=\"btn btn-default btn-sm\" onclick=\"bind({pigcms{$vo.id},this)\">绑定</button>");
                    } else {
                        alert("解绑失败");
                    }
                }
            })
        }
    </script>
</block>
