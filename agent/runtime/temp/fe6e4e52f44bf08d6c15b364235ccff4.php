<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"D:\phpstudy_pro\WWW\agent\public/../application/home\view\index\login.html";i:1559696610;s:67:"D:\phpstudy_pro\WWW\agent\application\home\view\public\headers.html";i:1559485142;}*/ ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta name=”renderer” content=”webkit”>
    <meta  content=”IE=Edge,chrome=1″>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="/static/home/layui/css/layui.css" media="all">
    <link rel="stylesheet" type="text/css" href="/static/home/css/style.css">
    <script src="/static/home/js/jquery-2.2.4.js"></script>
    <script src="/static/admin/js/layer/layer.js"></script>
    <script src="/static/home/layui/layui.js"></script>
    <script src="/static/home/js/rotate.js"></script>
    <script src="/static/home/js/vue.js"></script>
    <script src="/static/home/js/axios.min.js"></script>
    <script src="/static/home/js/index.js"></script>
</head>

<body>
<div class="rotate-canvas" id="rotateFade" >
    <div class="main-top">
        <div class="logo" style="line-height: 40px;margin-top: 10px">
            <img src="/static/home/img/119x27-logo.png">
            <div style="width: 1000px;line-height: 18px;font-size: 12px">
                <span class="on">简体中文</span>
                English Español Deutsch Italiano Português Dansk Svenska Norsk
                 <span style="color: #FFDF1B">繁體中文</span> Български
                Ελληνικά Polski Română Česky Magyar Slovenčina Nederlands Eesti
            </div>
        </div>
        <ul>
            <!--<li>账户余额：<a class="c-orange">0.00</a></li>-->
            <!--<li>账号：<a class="">ch007</a></li>-->
            <!--<li><a class="">充值/提现</a></li>-->
            <!--<li><a class="">我的账户</a></li>-->
            <li><a class="" >注册</a></li>
        </ul>
    </div>
    <!--<div class="rotate-wape">-->
        <!--<div class="rotate-item">-->
            <!--<img src="/static/home/img/5.jpg" />-->
        <!--</div>-->
        <!--<div class="rotate-item">-->
            <!--<img src="/static/home/img/3.jpg" />-->
        <!--</div>-->
        <!--<div class="rotate-item">-->
            <!--<img src="/static/home/img/4.jpg" />-->
        <!--</div>-->
        <!--<div class="rotate-item">-->
            <!--<img src="/static/home/img/10.jpg" />-->
        <!--</div>-->
    <!--</div>-->
    <div class="login-box" >
        <div class="form" >
            <div class="account"><input type="text" placeholder="账号" name="username" value=""></div>
            <div class="password"><input type="password" placeholder="密码" name="password" value=""></div>
            <div class="other">
                <div class="remember-pw"><input type="checkbox" id="jzmima">记住密码</div>
                <div class="forget-pw"><a href="#" id="wjmima">忘记密码</a></div>
            </div>
            <div class="btn-box">
                <a class="loginBtn " id="sub_login">登录</a>
                <a class="registerBtn" href="/home/register/index">注册</a>
            </div>
            <div class="other-txt">
                欢迎加入bet365财富共享平台<br>
                本平台以创新共享概念形态<br>
                提供给广大投资人一个互利.互助.三贏<br>
                三方财富共享的营运模式<br>
                透过此共享概念便可永续创造财富<br>
            </div>
        </div>
        <div class="txt-b">Copyright © 2018 ***共享平台.All rights reserved.</div>

    </div>


</div>



</body>
<script>
    ;(function(){
        var h_w = $(window).height();
        var w_w = $(window).width();
        $(".rotate-canvas").css('height',h_w+"px");
        // $(".rotate-canvas .rotate-item").css('height',h_w+"px");
        // $(".rotate-canvas .rotate-trans").css('height',h_w+"px");
        // $(".wel-content").css('height',h_w+"px");
        // $(".login-box").css('height',h_w+"px");
        // $(".rotate-item img").css('width',w_w+"px");
        // $(".rotate-item img").css('height',h_w+"px");

        // var setting = {
        //         HIDETIME:2000,//消失时间
        //         SHOWTIME:500,//出现时间
        //         INTERVALTIME:5000,//间隔时间
        //         animaChoice:0//0代表渐隐渐现，1代表滚动
        //     }
    })()
</script>
</html>
<script>
    var URL = "<?php echo url('doLogin'); ?>";
    $(document).ready(function(){
        $('#sub_login').click(function(){
            var username = $("input[name='username']").val();
            var password = $("input[name='password']").val();
            $.post(URL,{username:username,password:password},function(res){
                if(res.code==1){
                    window.sessionStorage.setItem('token',res.token);
                    window.sessionStorage.setItem('name',res.name);
                    window.sessionStorage.setItem('uid',res.uid);
                    location.href=res.url;
                }else{
                    alert(res.msg);
                }
            })
        })

        $("#wjmima").click(function(){
            location.href="/home/Login/loginOut";
            })
    })
</script>
