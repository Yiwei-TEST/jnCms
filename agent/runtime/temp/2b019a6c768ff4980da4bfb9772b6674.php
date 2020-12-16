<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:75:"D:\phpstudy_pro\WWW\agent\public/../application/index\view\index\index.html";i:1607910969;s:67:"D:\phpstudy_pro\WWW\agent\application\index\view\public\header.html";i:1607650850;s:64:"D:\phpstudy_pro\WWW\agent\application\index\view\public\nav.html";i:1607767370;s:65:"D:\phpstudy_pro\WWW\agent\application\index\view\public\nav1.html";i:1607908717;}*/ ?>
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
<style>
    ul.indexNav li {
        width: 50%;
    }
    .list-group-item{
        margin-bottom: 0.2rem;
    }
</style>
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

    <div class="sidy__content" id="index">
        <div class="panel panel-success"style="margin-top: 20%"></div>
        <div class="list-group">
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">亲友圈id</h4>
                <p class="list-group-item-text">{{groupId}}</p>
                <button style="position: relative;left:50%;font-size: 2rem" class="btn-success" @click="gs_qyq(groupId)">查看亲友圈统计数据</button>
            </a>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">亲友圈名称</h4>
                <p class="list-group-item-text">{{groupName}}</p>
            </a>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">最大人数</h4>
                <p class="list-group-item-text">{{maxCount}}</p>
            </a>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">成员人数</h4>
                <p class="list-group-item-text">{{currentCount}}</p>
            </a>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">创建时间</h4>
                <p class="list-group-item-text">{{createdTime}}</p>
            </a>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">状态</h4>
                <p class="list-group-item-text">
                    <span class="label label-primary" v-if="groupState==1">
                        开启
                    </span>
                    <span class="label label-primary" v-if="groupState==0">
                        关闭
                    </span>
                </p>
            </a>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">昨日局数</h4>
                <p class="list-group-item-text">{{day_js}}</p>
            </a>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">本月局数</h4>
                <p class="list-group-item-text">{{month_js}}</p>
            </a>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">群主id</h4>
                <p class="list-group-item-text">{{userId}}</p>
            </a>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">群主昵称</h4>
                <p class="list-group-item-text">{{name}}</p>
            </a>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">联系人</h4>
                <p class="list-group-item-text">{{nickname}}</p>
            </a>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">手机号码</h4>
                <p class="list-group-item-text">{{phoneNum}}</p>
            </a>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">群主当前房钻</h4>
                <p class="list-group-item-text" style="color: red;font-weight: bold">{{card}}</p>
            </a>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading"></h4>
                <p class="list-group-item-text"></p>
            </a>
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
        <div class="scroll_top" id="return-to-top">
            <div class="scroll_top_bg"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
        </div>

    </div>
</div>
<!--<script src="/static/index/js/index.js"></script>-->
<script>
</script>
<script src="/static/index/js/side.js"></script>
<script src="/static/index/js/scrollTop.js"></script>
<script src="/static/index/js/main.js"></script>
<script src="/static/index/js/downloadApp.js"></script>
</body>
</html>
<script>
    var app = new Vue({
        el: '#index',
        data: {
            groupId: "<?php echo $groupId; ?>",
            groupName: "<?php echo $groupName; ?>",
            maxCount: "<?php echo $maxCount; ?>",
            currentCount: "<?php echo $currentCount; ?>",
            createdTime: "<?php echo $createdTime; ?>",
            day_js: "<?php echo $yesterday_info; ?>",
            month_js: "<?php echo $month_info; ?>",
            userId: "<?php echo $userId; ?>",
            name: "<?php echo $name; ?>",
            nickname: "<?php echo $nickname; ?>",
            phoneNum: "<?php echo $phoneNum; ?>",
            card: "<?php echo $card; ?>",
            groupState: "<?php echo $groupState; ?>",
        },
        methods: {
            gs_qyq (gid) {
                if(gid) {
                    location.href = "/index/index/statistics?groupId="+gid;
                }
            }
        },
        mounted: function () {
            //_this = this;
            $('#index').show();
            this.getMoney();
            this.get_agent();

        },
        beforeDestroy() {
            _this = this;
            clearInterval(_this.timer);
        }
    })
</script>