<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link href="/Car/Admin/Public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
     @media print
     {
         .pageBreak {  page-break-before: always;page-break-after: always;  }
         .noPrint {  display: none;  }
         * {

             text-shadow: none !important;

             background: transparent !important;

             box-shadow: none !important;

         }
         p span{color:#C94239 !important;}

      }
  </style>

    <style>
        *{margin: 0;padding: 0;boder:none}
        p span{color:#C94239;}
        p{
            font-size: 15px;
            line-height: 1.2em;
            font-weight: 400;
        }
        .wrap{
            width:48%;height:100%;display:inline-block;position: relative;
        }
        .data{
            position: absolute;height:100%;width:100%;
        }
        .info{
            height:33%;position: relative;
        }
        .info2{
            position: absolute;left: 77%;top: 43%;
        }
        .info3{
            position: absolute;left: 77%;bottom: 20%;
        }

        .img-container{
            display: inline-block;
        }
    </style>

</head>
<body>
<!--                            </if>-->
<volist name="list" id="row">
    <div style="width:1680px;height:1160px;overflow-y: hidden;" class="pageBreak">
        <!--    左边一个-->
        <div class="wrap">
            <div class="data">
                <foreach name="row" item="rr" key="key">
                    <if condition="$key lt 3">
                        <div class="info">
                            <div class="info2">
                                <if condition="$rr['company']">
                                    <p><span style="color:#C94239">公司：</span>{pigcms{$rr['company']}</p>
                                </if>
                                <if condition="$rr['section']">
                                    <p><span style="color:#C94239">部门：</span>{pigcms{$rr['section']}</p>
                                </if>
                                <if condition="$rr['project']">
                                    <p><span style="color:#C94239">项目：</span>{pigcms{$rr['project']}</p>
                                </if>
                                <if condition="$rr['name']">
                                    <p><span style="color:#C94239">姓名：</span>{pigcms{$rr['name']}</p>
                                </if>
                            </div>
                            <div class="info3">
                                <if condition="$rr['ticket_no']">
                                    <p> NO：{pigcms{$rr['ticket_no']}</p>
                                    <p style="position: absolute;left:-360%;top:0"> NO：{pigcms{$rr['ticket_no']}</p>
                                </if>
                            </div>

                        </div>
                    </if>
                </foreach>
            </div>
            <div class="img-container">
                <img src="./upload/example/cjq_tpl2.jpg" width="100%">
            </div>
        </div>
        <!--    右边一个-->
        <div class="wrap">
            <div class="data">
                <foreach name="row" item="rr" key="key">
                    <if condition="$key egt 3">
                        <div class="info">
                            <div class="info2">
                                <if condition="$rr['company']">
                                    <p><span style="color:#C94239">公司：</span>{pigcms{$rr['company']}</p>
                                </if>
                                <if condition="$rr['section']">
                                    <p><span style="color:#C94239">部门：</span>{pigcms{$rr['section']}</p>
                                </if>
                                <if condition="$rr['project']">
                                    <p><span style="color:#C94239">项目：</span>{pigcms{$rr['project']}</p>
                                </if>
                                <if condition="$rr['name']">
                                    <p><span style="color:#C94239">姓名：</span>{pigcms{$rr['name']}</p>
                                </if>
                            </div>
                            <div class="info3">
                                <if condition="$rr['ticket_no']">
                                    <p> NO：{pigcms{$rr['ticket_no']}</p>
                                    <p style="position: absolute;left:-360%;top:0"> NO：{pigcms{$rr['ticket_no']}</p>
                                </if>
                            </div>

                        </div>
                    </if>
                </foreach>
            </div>
            <div class="img-container">
                <img src="./upload/example/cjq_tpl2.jpg" width="100%">
            </div>
        </div>
    </div>
</volist>
<div style="clear: both"></div>
<div style="height:100px"></div>
<script src="http://libs.baidu.com/jquery/1.10.2/jquery.js"></script>
<script>

</script>
</body>
</html>