<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}hui/css/hui.css" />
    <style type="text/css">
        .userinfo{height:80px; text-align:center; color:#FFF; line-height:80px; font-size:22px; margin:5px; background:#3388FF;}
    </style>
</head>
<body>
<header class="hui-header">
    <h1>业主认证</h1>
</header>
<div class="hui-wrap">
    <div style="padding:28px;">
            <button type="button" class="hui-button hui-button-large" id="btn1" name="project_id">选择期数</button>
<!--        <div class="hui-list-text-content">填写房号</div><input type="text" class="hui-input hui-input-large"  style="margin-top:20px;" name="house_number" placeholder="请填写门牌号" />
-->       <input type="text" class="hui-button hui-button-large" id="btn2" style="margin-top:20px;" value="选择房号" onFocus="this.blur();" />
    </div>
    <div id="userinfo" style="display:none;padding:28px;" >
        <button type="button" class="hui-button hui-button-large" id="userinfo_list" style="height: 82px"></button>
            <input type="text" class="hui-input" id="usernum" style="margin-top: 20px;" placeholder="请填写该业主的身份证号后六位来验证身份"/>
        <button type="button" class="hui-blue hui-blue-large" style="margin-top: 30px;" onClick="check_user();">提交</button>
		<button type="button" class="hui-button hui-button-large" style="margin-top: 15px;" onclick="javascript:history.back(-1);">返回</button>
    </div>
</div>
<script type="text/javascript" src="{pigcms{$static_path}hui/js/hui.js" charset="utf-8"></script>
<script type="text/javascript" src="{pigcms{$static_path}hui/js/hui-picker.js" charset="utf-8"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/137/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript">
    /* 普通选择器 非关联型绑定 */
    var picker1 = new huiPicker('#btn1', function(){
        var val = picker1.getVal(0);
        var txt = picker1.getText(0);
        hui('#btn1').html(txt);
        get_room_list(val);
    });
    picker1.bindData({pigcms{$project_list});
    function get_room_list(project_id) {
        $.ajax({
            url:"{pigcms{:U('village_access_control_uptown_ajax')}",
            type:'post',
            data:{'project_id':project_id},
            dataType:'json',
            async:false,
            success:function(res){
                console.log(res.data);
                picker2.bindRelevanceData(res.data);
            }
        });
    }
    /* 地区选择， 关联型数据 */
    var picker2 = new huiPicker('#btn2', function(){
        var build   = picker2.getText(0);
        var unit     = picker2.getText(1);
        var floor      = picker2.getText(2);
        var number      = picker2.getText(3);
        var id      = picker2.getVal(3);
        hui('#btn2').val(build + unit + floor + number);
        get_user_info(id);
    });
    function get_user_info(id) {
        $.ajax({
            url:"{pigcms{:U('village_access_control_uptown_userinfo_ajax')}",
            type:'post',
            data:{'id':id},
            dataType:'json',
            async:false,
            success:function(res){
                if(res.error==0){
                    hui('#userinfo_list').html('该房屋目前没有可以使用的业主信息，<br/>请重新选择');
                    $('#userinfo').css('display','block');
                }else {
                    hui('#userinfo_list').html('业主姓名:'+res.data.name+'<br/>业主身份证号:'+res.data.usernum);
                    $('#userinfo').css('display','block');
                }
            }
        });
    }
    picker2.level = 4;
    /*var name='';
    var phone='';*/
    function check_user() {
        var usernum=$('#usernum').val();
        $.ajax({
            url:"{pigcms{:U('village_access_control_uptown_check_ajax')}",
            type:'post',
            data:{'usernum':usernum,'village_id':'{pigcms{$_GET['village_id']}'},
            dataType:'json',
            async:false,
            success:function(res){
                if(res.error==0){
                    hui.alert('您填写的业主信息不正确！','好的', function(){console.log('ok');});
                }else if(res.error==1){
                    hui.alert('您已成功绑定此房间！','好的', function(){window.location.href="{pigcms{:U('village_uptown_my_room_select',array('village_id'=>$_GET['village_id']))}"});
                }else if(res.error==2){
                    hui.prompt_two('已通过验证<br/>接下来请输入您的真实姓名与电话进行绑定', ['取消','确定'], function(name,phone){
                        add_user_bind(name,phone);
                    }, '此处填写您的真实姓名', '','此处填写您的真实电话','',function(){console.log('您点击了取消')});
                }else{
                    hui.alert('您之前已经绑定过该房间，不能重复绑定','好的', function(){console.log('ok');});
                }
                }
            });
    }
    function add_user_bind(name,phone) {
        console.log('您点击了'+name);
            $.ajax({
                url:"{pigcms{:U('village_access_control_uptown_add_ajax')}",
                type:'post',
                data:{'phone':phone,'name':name,'village_id':'{pigcms{$_GET['village_id']}'},
                    dataType:'json',
                    async:false,
                    success:function(res){
                        if(res.error==0){
                            hui.alert('信息没有填写完整，请务必填写完整信息！','好的', function(){window.location.reload();});
                        }else if(res.error==1){
                            hui.alert('您填入的身份信息已被人绑定，请重试并核对','好的', function(){window.location.reload();});
                        }else{
                            hui.alert('您已成功绑定！','好的', function(){window.location.href="{pigcms{:U('village_uptown_my_room_select',array('village_id'=>$_GET['village_id']))}"});
                        }
                    }
            });
        }

</script>
</body>
</html>