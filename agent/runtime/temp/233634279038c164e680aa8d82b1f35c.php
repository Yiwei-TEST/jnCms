<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:72:"D:\phpstudy_pro\WWW\agent\public/../application/index\view\index\my.html";i:1607910257;s:67:"D:\phpstudy_pro\WWW\agent\application\index\view\public\header.html";i:1607650850;s:64:"D:\phpstudy_pro\WWW\agent\application\index\view\public\nav.html";i:1607767370;s:65:"D:\phpstudy_pro\WWW\agent\application\index\view\public\nav1.html";i:1607908717;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=414,user-scalable=no">
    <title>TG</title>
    <link rel="stylesheet" href="/static/index/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/index/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/static/index/css/normalize.css">
    <link rel="stylesheet" href="/static/index/css/tab_style.css">
    <link rel="stylesheet" href="/static/index/css/side.css">
    <link rel="stylesheet" href="/static/index/css/Main_Style.css">
    <link rel="stylesheet" href="/static/index/css/trade_detail.css">
    <link rel="stylesheet" href="/static/index/css/FIFA_marketlist.css">
    <link rel="stylesheet" href="/static/index/css/my_info_chg.css">
    <link rel="stylesheet" href="/static/index/css/statistics.css">
    <link rel="stylesheet" href="/static/index/css/switch.css">
    <!--theme-->
    <link rel="stylesheet" href="/static/index/css/theme/APPui.css">
    <script src="/static/index/js/jquery-3.2.1.min.js"></script>
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/index/js/vue.js"></script>
    <script src="/static/index/js/axios.min.js"></script>
</head>
<body>
<div class="sidy" onclick="siidyy();">
    <nav data-position="left" data-size="65%" data-fx="slide_overlay" class="sidy__panel" id="panel-1">

    <div class="menu_head_bg">
        <div class="menu_head_title" id="menu_head_title"></div>
    </div>
    <div class="menu_block_group">
        <div class="menu_block">
        </div>
        <div class="menu_block">
        </div>
    </div>
    <div class="menu_list">
        <ul>
            <!--<li onclick="location.href='/index/index/statistics'">-->
                <!--<div class="menu_history_stat_icon"></div>-->
                <!--<div class="menu_text">历史统计</div>-->
                <!--<div class="menu_arrow"></div>-->
            <!--</li>-->
            <!--<li onclick="location.href='/index/index/rules'">-->
                <!--<div class="menu_rules_icon"></div>-->
                <!--<div class="menu_text">规则说明</div>-->
                <!--<div class="menu_arrow"></div>-->
            <!--</li>-->
            <li onclick="location.href='/index/login/loginOut'">
                <div class="menu_logout_icon"></div>
                <div class="menu_text">登　出</div>
                <div class="menu_arrow"></div>
            </li>
        </ul>
    </div>
</nav>

    <div class="sidy__content">
        <div class="scroll_top" id="return-to-top">
            <div class="scroll_top_bg"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
        </div>
        <div class="head_banner nav-bar navbar-fixed-top" id="topLink">
    <div data-panel="panel-1" class="sidy--to-open menu_btn" onclick="siidyy();" style="cursor: pointer;">
        <span></span><br>
        <span></span><br>
        <span></span><br>
    </div>
    <input type="hidden" id="memberQuota" name="memberQuota" value="0.00">
</div>
<div class="title_background ">
    <div class="title_market">
        <div id="markettitle" name="markettitle">市场列表</div>
    </div>
    <div class="mail"><img src="/static/index/img/theme/APPui/mail.png" height="18" width="27"><span onclick="document.location.href='announce.html'" class="message_number"></span></div>
</div>
<div class="icon_bar navbar-fixed-bottom" id="navs">
    <div class="icon_bar_row">
        <div class="icon_bar_cell" v-show="level==2">
            <a id="market_a" name="market_a" href="/index/index/add_agent">
                <div class="icon_bar_marketlist"></div>
                <div class="icon_bar_text">添加业务员</div>
            </a>
        </div>
        <!--<div class="icon_bar_cell"><a id="orderinfo_a" name="orderinfo_a" href="/index/index/orderinfo"><div class="icon_bar_trade"></div><div class="icon_bar_text">成员列表</div></a></div>-->
        <div class="icon_bar_cell"><a class="active" href="/index/index/index"><div class="icon_bar_index"></div><div class="icon_bar_text">首　页</div></a></div>
        <!--<div class="icon_bar_cell"><a name="history_a" id="history_a" href="/index/index/history"><div class="icon_bar_history"></div><div class="icon_bar_text">数据统计</div></a></div>-->
        <div class="icon_bar_cell"><a name="my_a" id="my_a" href="/index/index/my"><div class="icon_bar_my"></div><div class="icon_bar_text">我　的</div></a></div>
    </div>
    <div id="Modal_coverchgall" class="cover"></div>
</div>
<script>
    var app = new Vue({
        el : "#navs",
        data: {
                is_y : 0,
                level : 0,
        },
        created () {
            this.get_level();
        },
        methods: {
            get_level () {
                let vm = this;
                axios
                    .get('/index/index/get_level')
                    .then(function (response) {
                        console.log(response);
                        if(response.data.code==1) {
                            vm.level = response.data.level;
                        }
                    })
                    .catch(function (error) { // 请求失败处理
                        console.log(error);
                    });
            },
        }
    });

</script>
        <div id="Modal_coverchgall" class="cover"></div>
        <link rel="stylesheet" href="/static/index/css/my.css">
        <div class="title_background ">
            <div class="title">我　的</div>
        </div>
        <div class="content" style="margin-top:0px;padding: 0px 0px 0px 0px; display: none" id="topApp" >
            <div class="head_bg">
                <div class="my_profile">
                    <div class="arrow_left" onclick="javascript:window.history.go(-1);"><i class=" fa fa-angle-left"
                                                                                           aria-hidden="true"></i></div>
                    <div class="head"><img src="/static/index/img/icon/user.png" height="67" width="67"></div>
                    <div class="acc_name">{{username}}</div>
                    <button class="logout" onclick="location.href='/index/login/loginOut'">登　出</button>
                    <div class="color_border_bottom"></div>
                </div>
            </div>
            <div class="my_detail">
                <div class="line"></div>
                <div class="line2"></div>
                <div class="detail_bg">
                    <div class=""></div>
                    <div class="block">
                        <div class="block_title">昵称</div>
                        <div class="block_num">{{nickname}}</div>
                    </div>
                    <div class="block">
                        <div class="block_title">推广码</div>
                        <div class="block_num">{{PayBindid}}</div>
                    </div>
                    <div class="block">
                        <div class="block_title">级别</div>
                        <div class="block_num" v-if="group_id==2">包负责人</div>
                        <div class="block_num" v-if="group_id==4">业务员</div>
                    </div>
                </div>
            </div>
            <div class="service_padding">
                <div class="service_title">个人中心</div>
                <div>
                    <div class="service_block" v-if="group_id==4" @click ="get_qz_list(PayBindid)" >
                        <div><img src="/static/index/img/icon/menu-icon.png" height="22" width="22"></div>
                        <div class="service_text">昵称:{{nickname}}</div>
                    </div>
                    <div class="service_block" v-for="item in agent" @click ="get_qz_list(item.PayBindid)" >
                        <div><img src="/static/index/img/icon/menu-icon.png" height="22" width="22"></div>
                        <div class="service_text">业务员昵称:{{item.nickname}}</div>
                    </div>
                    <div class="service_block" style="background: #ade0d3"  v-for="item in qz_list"  v-on:click ="qyq_info(item.groupId)">
                        <div><img src="/static/index/img/icon/menu-icon.png" height="22" width="22"></div>
                        <div class="service_text">群主昵称:{{item.userName}}</div>
                        <div class="service_text">群主id:{{item.userId}}</div>
                        <div class="service_text">亲友圈id:{{item.groupId}}</div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <script>
            $('.icon_bar_cell > a').removeClass('active');
            $('.icon_bar_cell > #my_a').addClass('active');
        </script>
    </div>
</div>
<script src="/static/index/js/jquery.cookies.2.2.0.js"></script>
<script src="/static/index/js/side.js"></script>
<script src="/static/index/js/trade_detail.js"></script>
<script src="/static/index/js/main.js"></script>
<script src="/static/index/js/scrollTop.js"></script>
<script src="/static/index/js/history_stat.js"></script>
<script src="/static/index/js/downloadApp.js"></script>
</body>
</html>
<script>
    var app = new Vue({
        el: '#topApp',
        data: {
            username: null,
            njmoney: 0,
            total: 0,
            money: 0,
            timer: '',
            nickname: '',
            PayBindid: '',
            agent: [],
            group_id: '',
            qz_list: [],
        },
        methods: {
            getMoney() {
                _this = this;
                axios
                    .get('/index/index/getMoney')
                    .then(function (response) {
                        _this.PayBindid = response.data.PayBindid;
                        _this.nickname = response.data.nickname;
                        _this.group_id = response.data.group_id;
                    })
                    .catch(function (error) { // 请求失败处理
                        console.log(error);
                    });
            },
            get_agent() {
                _this = this;
                axios
                    .get('/index/index/get_agent')
                    .then(function (response) {
                        _this.agent = response.data.data;
                    })
                    .catch(function (error) { // 请求失败处理
                        console.log(error);
                    });
            },
            get_qz_list(a) {
                _this = this;
                axios
                    .post('/index/index/get_qz_list',{PayBindid:a})
                    .then(function (response) {
                        _this.qz_list = response.data.data;
                    })
                    .catch(function (error) { // 请求失败处理
                        console.log(error);
                    });
            },
            qyq_info(gid){
                console.log(gid);
                if(!gid) {
                    alert(gid);
                    return;
                }
                location.href="/index/index?group_id="+gid;
            }

        },
        mounted: function () {
            //_this = this;
            this.getMoney();
            this.get_agent();
            $('#topApp').show();
        },
        beforeDestroy() {
            _this = this;
            clearInterval(_this.timer);
        }
    })
</script>
