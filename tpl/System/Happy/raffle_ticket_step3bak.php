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
         .pageBreak {  page-break-before: always; ,page-break-after: always;  }
         .noPrint {  display: none;  }
      }
  </style>

    <style>
        *{margin: 0;padding: 0;boder:none}
        p span{color:#C94239;}
        p{
            font-size: 17.5px;
            line-height: 2em;
            font-weight: 200;
        }
    </style>

</head>
<body>
<volist name="list" id="row" mod="2">
    <div style="position: relative;left:0;top:0;"  class='<eq name="mod" value="1">class="pageBreak"</eq> col-lg-6'>
        <div style="position: absolute;left: 76.8%;top: 13.5%;">
            <div style="height: 11em;width:25em">
                <if condition="$row[0]['company']">
                    <p><span>公司：</span>{pigcms{$row[0]['company']}</p>
                </if>
                <if condition="$row[0]['section']">
                    <p><span>部门：</span>{pigcms{$row[0]['section']}</p>
                </if>
                <if condition="$row[0]['project']">
                    <p><span>项目：</span>{pigcms{$row[0]['project']}</p>
                </if>
                <if condition="$row[0]['name']">
                    <p><span>姓名：</span>{pigcms{$row[0]['name']}</p>
                </if>
            </div>
            <div style="position: absolute;bottom: 2%">
                <if condition="$row[0]['ticket_no']">
                    <p>NO：{pigcms{$row[0]['ticket_no']}</p>
                    <p style="position: absolute;left:-340%;top:0">NO：{pigcms{$row[0]['ticket_no']}</p>
                </if>
            </div>
        </div>
        <div style="position: absolute;left:76.8%;top:46.3333%">
            <div style="height: 11em;width:25em">
                <if condition="$row[0]['company']">
                    <p><span>公司：</span>{pigcms{$row[1]['company']}</p>
                </if>
                <if condition="$row[0]['section']">
                    <p><span>部门：</span>{pigcms{$row[1]['section']}</p>
                </if>
                <if condition="$row[0]['project']">
                    <p><span>项目：</span>{pigcms{$row[1]['project']}</p>
                </if>
                <if condition="$row[0]['name']">
                    <p><span>姓名：</span>{pigcms{$row[1]['name']}</p>
                </if>
            </div>
            <div style="position: absolute;bottom: 2%">
                <if condition="$row[0]['ticket_no']">
                    <p>NO：</span>{pigcms{$row[1]['ticket_no']}</p>
                    <p style="position: absolute;left:-340%;top:0">NO：</span>{pigcms{$row[1]['ticket_no']}</p>
                </if>
            </div>
        </div>
        <div style="position: absolute;left:76.8%;top:79.6666%">
            <div style="height: 11em;width:25em">
                <if condition="$row[0]['company']">
                    <p><span>公司：</span>{pigcms{$row[2]['company']}</p>
                </if>
                <if condition="$row[0]['section']">
                    <p><span>部门：</span>{pigcms{$row[2]['section']}</p>
                </if>
                <if condition="$row[0]['project']">
                    <p><span>项目：</span>{pigcms{$row[2]['project']}</p>
                </if>
                <if condition="$row[0]['name']">
                    <p><span>姓名：</span>{pigcms{$row[2]['name']}</p>
                </if>
            </div>
            <div style="position: absolute;bottom: 2%">
                <if condition="$row[0]['ticket_no']">
                    <p> NO：{pigcms{$row[2]['ticket_no']}</p>
                    <p style="position: absolute;left:-340%;top:0"> NO：{pigcms{$row[2]['ticket_no']}</p>
                </if>
            </div>
        </div>
        <img src="./upload/example/cjq_tpl2.jpg" width="100%">
    </div>
    <eq name="mod" value="1"><div class="pageBreak"></div></eq>
</volist>
<div style="clear: both"></div>
<div style="height:100px"></div>
<script>

</script>
</body>
</html>