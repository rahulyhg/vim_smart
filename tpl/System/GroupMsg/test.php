<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">

</block>
<block name="head"></block>

<block name="body">
 <div><button id="start">开始发送</button></div>
 <div><button id="off">停止</button></div>
 <div><button id="on">继续发送</button></div>
    <div id="box"></div>
</block>
<block name="script">
    <script>
        function get_send_data(){
            var timer = setInterval(function() {
                $.ajax({
                    url:app.U('get_send_data'),
                    async: true,
                    cache: false,
                    success:function(re){
//                        if(re.data.openids===undefined||re.data.openids.length===0){
//                            window.clearInterval(timer);
//                        }
                        console.log(re.data.openids);
                        $('#box').html(JSON.stringify(re.data.openids))
                    }
                });
            }, 1000)
        }
        //get_send_data();
        $('#on').click(function(){
            alert("继续发送")
            $.ajax({
                url:app.U('on'),
                success:function(re){
                    console.log(re);
                }
            });
        });
        $('#off').click(function(){
            alert("暂停发送")
            $.ajax({
                url:app.U('off'),
                success:function(re){
                    console.log(re);
                }
            });
        });
        $('#start').click(function(){
            alert("开始发送")

            $.ajax({
                url:app.U('start'),
                async:true,
                success:function(re){
                    console.log(re);
                }
            });

        });
    </script>
</block>
