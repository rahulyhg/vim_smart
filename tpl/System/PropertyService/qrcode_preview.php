<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>无标题文档</title>
    <link href="./static/PropertyService/css/style.css" rel="stylesheet" type="text/css" />
    <style>

        body
        {
            zoom:50%;
        }
        .jl {
            width: 100px;
            height: 72px;
            font-size: 36px;
            color: #444444;
            font-weight: bold;
            word-wrap:break-word;
        }
        .jt{
            /*border-collapse: separate;
            border-spacing: 0px 24px;*/
            width: 360px;
            font-size: 36px;
            color: #444444;
            font-weight: bold;
            table-layout:fixed;
        }
        .jk-s {
            width: 240px;
            font-size: 30px;
            color: #444444;
            font-weight: bold;
            margin-bottom: 38px;
            word-wrap:break-word;
        }

        /*body
        {
            zoom:50%;
        }
        .jl {
            width: 120px;
            height: 72px;
            font-size: 36px;
            color: #444444;
            font-weight: bold;
        }
        .jt{
            !*border-collapse: separate;
            border-spacing: 0px 24px;*!
            width: 360px;
            font-size: 36px;
            color: #444444;
            font-weight: bold;
        }
        .jk-s {
            width: 240px;
            font-size: 30px;
            color: #444444;
            font-weight: bold;
            margin-bottom: 38px;
        }*/
    </style>
</head>
<!-- ../images/x5.jpg 210 297 650/x = 210/297 297*650/210-->

<body style="width:2000px">



<volist name="list" id="row">
    <!--    <div class="" style="position: relative;height:650px;width:930px;float:left;margin-left:50px;margin-bottom: 80px;">-->
    <div class="" style="position: relative;height:650px;width:930px;float:left;">
        <img style="position: absolute;height:100%;z-index: -1" src="{pigcms{$bg}" alt="" />
        <div >
            <div class="wz">
            </div>
            <div class="yh" style="margin:0 auto">
                <div class="fe">
                    <div class="rwm" style="margin-top:-10px;width: 435px;height: 445px;">
                        <img src="{pigcms{$row.qr_img}" style="width:100%;hegith:100%;margin:0 auto" />
                    </div>
                    <div class="cw">
                        <div class="xx">
                            <table class="jt">
                                <if condition="$row['code']">
                                    <tr >
                                        <td class="jl">编号:</td>
                                        <if condition="strlen($row['code']) gt 6">
                                            <td class="jk-s">{pigcms{$row.code}</td>
                                            <else />
                                            <td class="jk">{pigcms{$row.code}</td>
                                        </if>
                                    </tr>
                                </if>
                                <tr >
                                    <td class="jl">类别:</td>
                                    <td class="jk">{pigcms{$row.type_name}</td>
                                </tr>
                                <if condition="$row['location']">
                                    <tr >
                                        <td class="jl">位置:</td>
                                        <if condition="strlen($row['location']) gt 10">
                                            <td class="jk-s">{pigcms{$row.location}</td>
                                            <else />
                                            <td class="jk">{pigcms{$row.location}</td>
                                        </if>
                                    </tr>
                                </if>
                                <if condition="$row['orientation']">
                                    <tr >
                                        <td class="jl">方位:</td>
                                        <td class="jk">{pigcms{$row.orientation}</td>
                                    </tr>
                                </if>
                                <if condition="$row['meter_cate']">
                                    <tr >
                                        <td class="jl">分类:</td>
                                        <td class="jk">{pigcms{$row.meter_cate}</td>                                       
                                    </tr>
                                <else/>
                                    <tr >
                                        <td class="jl">倍率:</td>
                                        <td class="jk">{pigcms{$row.rate}</td>
                                    </tr>
                                </if>                                
                            </table>
                            <!--<div class="jk">类别：{pigcms{$row.type_name}</div>
                            <if condition="$row['code']">
                                <if condition="strlen($row['code']) gt 6">
                                    <div class="jk" style="font-size: 27px">编号：{pigcms{$row.code}</div>
                                    <else />
                                    <div class="jk">编号：{pigcms{$row.code}</div>
                                </if>
                            </if>
                            <if condition="$row['location']">
                                <if condition="strlen($row['location']) gt 10">
                                    <div class="jk" style="font-size: 30px">位置：{pigcms{$row.location}</div>
                                    <else />
                                    <div class="jk">位置：{pigcms{$row.location}</div>
                                </if>
                            </if>
                            <if condition="$row['orientation']">
                                <div class="jk">方位：{pigcms{$row.orientation}</div>
                            </if>
                            <if condition="$row['rate']">
                                <div class="jk">倍率：{pigcms{$row.rate}</div>
                            </if>-->
                        </div>
                        <div class="xx2">
                            <div class="wy">
                                <div class="cjy"><img src="./static/PropertyService/images/xlg.jpg" width="26" height="34" /></div>
                                <div class="cjy2">汇得行(中国)集团有限公司</div>
                                <div style="clear:both"></div>
                            </div>
                            <!-- <if condition="$row['village_name']"> -->
                                <div class="cg" style="text-align:left;margin-left:52px">{pigcms{$row.village_name}物业服务中心</div>
                            <!-- <else/>
                                <div class="cg" style="text-align:left;margin-left:52px">广发银行大厦物业服务中心</div>
                            </if> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div style="height:23px;"></div>-->


</volist>
<div style="clear:both"></div>



<script>
    // print.portrait = false;
    print();
</script>
</body>
</html>