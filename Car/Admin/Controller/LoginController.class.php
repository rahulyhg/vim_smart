<?php
namespace Admin\Controller;
use Think\Controller;
use Home\Model\UserModel;
class LoginController extends Controller
{
    //后台管理员登录
    public function admlogin(){
        //优先使用cookie登陆 @update-time: 2017-03-29 09:16:10 @author: 王亚雄
        if($login_info = cookie('login_info')){
            //解密
            $login_info = think_decrypt($login_info,COOKIE_LOGIN_KEY);
            session('admin_id',$login_info['admin_id']);
            session('admin_name',$login_info['admin_name']);
            session('login_time',time());
            $url = get_history_url(0)?:C('WEB_DOMAIN')."/index.php?s=/Admin/Index/index.html";
            redirect($url);
            exit();

        }


        //微信端登陆 @update-time: 2017-03-29 09:16:00 @author: 王亚雄
        if(IS_WECHAT){
            if(!session('admin_id')){

                $model = new UserModel();
                $model->login();

            }else{

                redirect(get_history_url(0)?:C('WEB_DOMAIN')."/index.php?s=/Admin/Index/index.html");
                exit();
            }

        }


        if(session('admin_id') && session('admin_name')){//这里的session为手机端登录停车系统后台时所存，若存在，则进index页面，不存在说明不是通过手机端登录
            header("location:".C('WEB_DOMAIN')."/index.php?s=/Admin/Index/index.html");
        }
        //接收用户名和密码
        $username=$_POST['username'];
        $userpassword=$_POST['userpassword'];

        if(IS_POST){
            /*
            if( !session('checkcode_ok') ){
                $this->error('请输入正确验证码！',U('admlogin'),1);
            }

            //清除验证码标识符
            session('checkcode_ok',null);
            */
            if( empty($username) || empty($userpassword) ){
                $this->error('请输入账号和密码后再登录',U('admlogin'),1);
            }

            //对密码进行md5处理
            $userpassword= md5($userpassword);

            $z=D('admin')->where( array('ad_name'=>$username,'ad_pwd'=>$userpassword) )->find();
            if( $z ){
                if($_SESSION['newinfo']){//存在即为手机端
                    $new_uid=implode(',',array($z['ad_uid'],$_SESSION['user_id']));//拼接uid
                    $update=M('admin')->where(array('ad_name'=>$username,'ad_pwd'=>$userpassword))->setField(array('ad_uid'=>$new_uid));//更新数据库的uid
                    if($update){
                        header("location:".C('WEB_DOMAIN')."/index.php?s=/Admin/Index/index.html");
                        //进行用户信息持久化
                        session('admin_id',$z['ad_id']);
                        session('admin_name',$z['ad_name']);
                        //cookie储存
                        $login_info = array(
                            'admin_id'=>$z['ad_id'],
                            'admin_name'=>$z['ad_name']
                        );
                        //加密
                        $login_info = think_encrypt($login_info,COOKIE_LOGIN_KEY);
                        cookie('login_info',$login_info,COOKIE_VALID_TIME);//cookie储存30天


                    }
                }else{//pc端
                    header("location:".C('WEB_DOMAIN')."/index.php?s=/Admin/Index/index.html");
                    //进行用户信息持久化
                    session('admin_id',$z['ad_id']);
                    session('admin_name',$z['ad_name']);
                    //cookie储存
                    $login_info = array(
                        'admin_id'=>$z['ad_id'],
                        'admin_name'=>$z['ad_name']
                    );
                    //加密
                    $login_info = think_encrypt($login_info,COOKIE_LOGIN_KEY);
                    cookie('login_info',$login_info,COOKIE_VALID_TIME);//cookie储存30天
                }

            }else{
                $this->error('用户名或者密码错误！',U('admlogin'),1);
            }
        }else{
            //调用模板
            $this->display();
        }

    }

    //后台用户退出登录
    public function admlogout(){

        //清除所有session
        session(null);
        cookie('login_info',null);

        //跳转后台后台登录页面
        $this->success('您已成功退出系统！',U('Admin/admlogin'),1);
    }

    //生成验证码
    public function checkCode(){

        //自定义配置项
        $cfg=array(
            'expire'    =>  1800,            // 验证码过期时间（s）
            'useZh'     =>  false,           // 使用中文验证码
            'zhSet'     =>  '们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这主中人上为来分生对于学下级地个用同行面说种过命度革而多子后自社加小机也经力线本电高量长党得实家定深法表着水理化争现所二起政三好十战无农使性前等反体合斗路图把结第里正新开论之物从当两些还天资事队批点育重其思与间内去因件日利相由压员气业代全组数果期导平各基或月毛然如应形想制心样干都向变关问比展那它最及外没看治提五解系林者米群头意只明四道马认次文通但条较克又公孔领军流入接席位情运器并飞原油放立题质指建区验活众很教决特此常石强极土少已根共直团统式转别造切九你取西持总料连任志观调七么山程百报更见必真保热委手改管处己将修支识病象几先老光专什六型具示复安带每东增则完风回南广劳轮科北打积车计给节做务被整联步类集号列温装即毫知轴研单色坚据速防史拉世设达尔场织历花受求传口断况采精金界品判参层止边清至万确究书术状厂须离再目海交权且儿青才证低越际八试规斯近注办布门铁需走议县兵固除般引齿千胜细影济白格效置推空配刀叶率述今选养德话查差半敌始片施响收华觉备名红续均药标记难存测士身紧液派准斤角降维板许破述技消底床田势端感往神便贺村构照容非搞亚磨族火段算适讲按值美态黄易彪服早班麦削信排台声该击素张密害侯草何树肥继右属市严径螺检左页抗苏显苦英快称坏移约巴材省黑武培著河帝仅针怎植京助升王眼她抓含苗副杂普谈围食射源例致酸旧却充足短划剂宣环落首尺波承粉践府鱼随考刻靠够满夫失包住促枝局菌杆周护岩师举曲春元超负砂封换太模贫减阳扬江析亩木言球朝医校古呢稻宋听唯输滑站另卫字鼓刚写刘微略范供阿块某功套友限项余倒卷创律雨让骨远帮初皮播优占死毒圈伟季训控激找叫云互跟裂粮粒母练塞钢顶策双留误础吸阻故寸盾晚丝女散焊功株亲院冷彻弹错散商视艺灭版烈零室轻血倍缺厘泵察绝富城冲喷壤简否柱李望盘磁雄似困巩益洲脱投送奴侧润盖挥距触星松送获兴独官混纪依未突架宽冬章湿偏纹吃执阀矿寨责熟稳夺硬价努翻奇甲预职评读背协损棉侵灰虽矛厚罗泥辟告卵箱掌氧恩爱停曾溶营终纲孟钱待尽俄缩沙退陈讨奋械载胞幼哪剥迫旋征槽倒握担仍呀鲜吧卡粗介钻逐弱脚怕盐末阴丰雾冠丙街莱贝辐肠付吉渗瑞惊顿挤秒悬姆烂森糖圣凹陶词迟蚕亿矩康遵牧遭幅园腔订香肉弟屋敏恢忘编印蜂急拿扩伤飞露核缘游振操央伍域甚迅辉异序免纸夜乡久隶缸夹念兰映沟乙吗儒杀汽磷艰晶插埃燃欢铁补咱芽永瓦倾阵碳演威附牙芽永瓦斜灌欧献顺猪洋腐请透司危括脉宜笑若尾束壮暴企菜穗楚汉愈绿拖牛份染既秋遍锻玉夏疗尖殖井费州访吹荣铜沿替滚客召旱悟刺脑措贯藏敢令隙炉壳硫煤迎铸粘探临薄旬善福纵择礼愿伏残雷延烟句纯渐耕跑泽慢栽鲁赤繁境潮横掉锥希池败船假亮谓托伙哲怀割摆贡呈劲财仪沉炼麻罪祖息车穿货销齐鼠抽画饲龙库守筑房歌寒喜哥洗蚀废纳腹乎录镜妇恶脂庄擦险赞钟摇典柄辩竹谷卖乱虚桥奥伯赶垂途额壁网截野遗静谋弄挂课镇妄盛耐援扎虑键归符庆聚绕摩忙舞遇索顾胶羊湖钉仁音迹碎伸灯避泛亡答勇频皇柳哈揭甘诺概宪浓岛袭谁洪谢炮浇斑讯懂灵蛋闭孩释乳巨徒私银伊景坦累匀霉杜乐勒隔弯绩招绍胡呼痛峰零柴簧午跳居尚丁秦稍追梁折耗碱殊岗挖氏刃剧堆赫荷胸衡勤膜篇登驻案刊秧缓凸役剪川雪链渔啦脸户洛孢勃盟买杨宗焦赛旗滤硅炭股坐蒸凝竟陷枪黎救冒暗洞犯筒您宋弧爆谬涂味津臂障褐陆啊健尊豆拔莫抵桑坡缝警挑污冰柬嘴啥饭塑寄赵喊垫丹渡耳刨虎笔稀昆浪萨茶滴浅拥穴覆伦娘吨浸袖珠雌妈紫戏塔锤震岁貌洁剖牢锋疑霸闪埔猛诉刷狠忽灾闹乔唐漏闻沈熔氯荒茎男凡抢像浆旁玻亦忠唱蒙予纷捕锁尤乘乌智淡允叛畜俘摸锈扫毕璃宝芯爷鉴秘净蒋钙肩腾枯抛轨堂拌爸循诱祝励肯酒绳穷塘燥泡袋朗喂铝软渠颗惯贸粪综墙趋彼届墨碍启逆卸航衣孙龄岭骗休借',              // 中文验证码字符串
            'useImgBg'  =>  false,           // 使用背景图片
            'fontSize'  =>  25,              // 验证码字体大小(px)
            'useCurve'  =>  true,            // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点
            'imageH'    =>  60,               // 验证码图片高度
            'imageW'    =>  200,               // 验证码图片宽度
            'length'    =>  5,               // 验证码位数
            'fontttf'   =>  '',              // 验证码字体，不设置随机获取
            'bg'        =>  array(243, 251, 254),  // 背景颜色
        );

        //实例化系统验证码生成类，同时将配置项传入
        $code=new \Think\Verify($cfg);

        ob_end_clean();

        //生成验证码
        $code->entry();

    }


    //校验验证码是否正确
    public function check_code(){

        //接收验证码
        $checkcode=I('post.checkcode');

        //实例化系统验证码生成类
        $code=new \Think\Verify();


        //进行校验

        if( $code->check($checkcode) ){

            //生成session
            session( 'checkcode_ok', str_shuffle( $checkcode.'2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY' ) );

            echo json_encode('1'); //校验成功！
        }else{
            echo json_encode('2'); //校验失败！
        }

    }



    /**
     * 微信端管理员自动登陆接口
     * 调用此接口需要出示签名
     * 错误码或需整理，暂时先这么写
     * @param $user_id
     * @update-time: 2017-03-28 09:23:05
     * @author: 王亚雄
     */

    public function wechat_auto_login($user_id){
        //C('LAYOUT_ON',false);
        //签名验证 参考微信服务器验证

        $timestamp = $_GET['timestamp']; //时间戳

        $nonce  = $_GET['nonce'];//随机数

        $token = ADAUTO_LOGIN_TOKEN;

        $signature = $_GET['signature']; //生成的签名字符串

        $bakurl = urldecode($_GET['bakurl']);


        //验证签名
        if( create_signature($timestamp,$nonce,$token) == $signature ){

            //超时验证，防止链接被抓取，被人重复使用
            $valid_time = 30;//30秒有效期

            $cur_time = time();

            if(!S($signature)){

                S($signature,1, $valid_time);

                if($cur_time-$timestamp<$valid_time){

                    $user_info = user_info($user_id);

                    if($user_info['ad_id']){

                        session('admin_id',$user_info['ad_id']);

                        session('admin_name',$user_info['ad_name']);

                    }else{
                        //如果前台用户不是管理员
                        $this->error("在后台找不到您的身份，您可能不是管理员！",U('Home/User/user_index'));
                        exit();
                    }

                }

            }

        }

        header('location:' . $bakurl );//跳转回去









    }


    public function test(){
        dump(M('admin')->select());
    }

    protected function console($data=null){
        if(is_array($data)){
            $data = json_encode($data);
            echo '<script>console.log(JSON.parse(\''.$data.'\'))</script>';
        }else{
            echo '<script>console.log('+$data+')</script>';
        }
    }

}
























