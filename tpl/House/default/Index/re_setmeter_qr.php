<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="width:90%;margin:0 auto">
<volist name="re_setmeter" id="row">
    <if condition="$row['is_use'] eq t">
        <div class="pwrap">
            <h3>{pigcms{$row['desc']}</h3>
            <volist name="row" id="rr">
                <php>if(is_array($rr) && $rr['is_use']=='t'){</php>
                    <div class="img_wrap" style="display: inline-block;width:33%;" >
                        <img src="{pigcms{$rr.img_src}" alt="{pigcms{$rr.pdesc}" style="width:98%">
                        <a target="_blank" href="{pigcms{$rr.print_url}"><button class="print">打印</button></a>
                        <p>楼层：{pigcms{$rr.tdesc}</p>
                        <p>类型：{pigcms{$rr.desc}</p>
                        <p>单位价格:{pigcms{:sprintf("%.2f", $rr['unit_price'])}{pigcms{$rr['unit']} </p>
                        <div>硬件编号: <span style="width:150px;height:1.2em;display: inline-block" is_edit="0" onclick="edit_device_code(this,'{pigcms{$rr.device_code}','{pigcms{$rr.tid}','{pigcms{$rr.sign}')" >{pigcms{$rr.device_code}(点击修改)</span>
                        </div>
                    </div>
                <php>}</php>
            </volist>
        </div>
    </if>
</volist>
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script>
    /**
     * 编辑硬件码
     * @param el 修改标签
     * @param code 硬件码
     * @param tid 楼层ID
     * @param sign 设备类型
     */
    function edit_device_code(el,code,tid,sign){
        var is_edit = $(el).attr('is_edit');
        if(is_edit==="0"){
            $(el).attr('is_edit','1');
            var old_html = $(this).html();
            var input = $('<input type="text"  value="'+code+'">');

            $(el).html(input);
            input.focus().select();
            input.blur(function(){
                var new_code = input.val();
                $.ajax({
                    url:'{pigcms{:U("edit_device_code")}',
                    type:'post',
                    data:{device_code:new_code,tid:tid,sign:sign},
                    dataType:'json',
                    success:function(re){
                        if(re.err===0){
                            $(el).attr('is_edit','0');
                            $(el).html(old_html);
                            $(el).text(new_code);

                        }else{
                            alert('发生错误');
                        }
                        console.log(re);
                    }
                })

            });
        }

    }

</script>
</body>
</html>
