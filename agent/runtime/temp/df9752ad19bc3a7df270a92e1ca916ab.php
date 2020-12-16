<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:79:"D:\phpstudy_pro\WWW\agent\public/../application/index\view\index\orderinfo.html";i:1607652527;s:67:"D:\phpstudy_pro\WWW\agent\application\index\view\public\header.html";i:1607650850;s:64:"D:\phpstudy_pro\WWW\agent\application\index\view\public\nav.html";i:1607649279;s:65:"D:\phpstudy_pro\WWW\agent\application\index\view\public\nav1.html";i:1607649407;}*/ ?>
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
    <div class="menu_list">
        <ul>
            <li onclick="location.href='/index/index/market'">
                <div class="market_list_icon"></div>
                <div class="menu_text">市场列表</div>
                <div class="menu_arrow"></div>
            </li>
            <li onclick="location.href='/index/index/orderinfo'">
                <div class="trade_detail_icon"></div>
                <div class="menu_text">交易明细</div>
                <div class="menu_arrow"></div>
            </li>
            <li onclick="location.href='/index/index/history'">
                <div class="history_icon"></div>
                <div class="menu_text">历史帐务</div>
                <div class="menu_arrow"></div>
            </li>
            <li onclick="window.open('http://bf.spbo1.com', '_blank')">
                <div class="nowscore_icon_2018"></div>
                <div class="menu_text">即时比分</div>
                <div class="menu_arrow"></div>
            </li>
            <li onclick="location.href='/index/index/gameresult'">
                <div class="game_result_icon"></div>
                <div class="menu_text">赛事结果</div>
                <div class="menu_arrow"></div>
            </li>
        </ul>
    </div>
    <div class="menu_block_group">
        <div class="menu_block">
            <div class="new_icon">NEW</div>
            <div onclick="location.href='/index/index/deposits'" class="menu_block_outline01">
                <div class="menu_wd_icon"></div>

            </div>
        </div>
        <!--<div class="menu_block">-->
            <!--<div id="modify111" name="modify111" class="menu_block_outline02">-->
                <!--<div class="menu_live_icon"></div>-->
                <!--<div class="menu_block_text">会员互转</div>-->
            <!--</div>-->
        <!--</div>-->

        <div class="menu_block">
            <div onclick="location.href='/index/index/service'" class="menu_block_outline03">
                <div class="menu_service_icon"></div>

            </div>
        </div>
    </div>

    <div class="menu_list">
        <ul>
            <li onclick="location.href='/index/index/statistics'">
                <div class="menu_history_stat_icon"></div>
                <div class="menu_text">历史统计</div>
                <div class="menu_arrow"></div>
            </li>
            <li onclick="location.href='/index/index/rules'">
                <div class="menu_rules_icon"></div>
                <div class="menu_text">规则说明</div>
                <div class="menu_arrow"></div>
            </li>
            <li onclick="location.href='/index/index/help'">
                <div class="menu_help_icon"></div>
                <div class="menu_text">帮助中心</div>
                <div class="menu_arrow"></div>
            </li>
            <li onclick="window.open('http://f.tg333.net/index.html', '_blank')">
                <div class="menu_discuss_icon"></div>
                <div class="menu_text">讨论区</div>
                <div class="menu_arrow"></div>
            </li>
            <li onclick="location.href='/index/index/announce'">
                <div class="menu_announce_icon"></div>
                <div class="menu_text">公　告</div>
                <div class="menu_arrow"></div>
            </li>
            <li onclick="location.href='/index/index/memberlogout'">
                <div class="menu_logout_icon"></div>
                <div class="menu_text">登　出</div>
                <div class="menu_arrow"></div>
            </li>
        </ul>
    </div>
</nav>

    <script>
    </script>
    <div class="sidy__content" id="qyqData">
        <div class="scroll_top" id="return-to-top">
            <div class="scroll_top_bg"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
        </div>
        <div class="head_banner nav-bar navbar-fixed-top">
            <div data-panel="panel-1" class="sidy--to-open menu_btn">
                <span></span><br>
                <span></span><br>
                <span></span><br>
            </div>
        </div>
        <div class="title_background">
            <div class="mail"><img src="/static/index/img/icon/mail.png" height="18" width="27"/><span
                    onclick="document.location.href='index/index/announce'" class="message_number"></span></div>
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
<div class="icon_bar navbar-fixed-bottom">
    <div class="icon_bar_row">
        <div class="icon_bar_cell">
            <a id="market_a" name="market_a" href="/index/index/add_agent">
                <div class="icon_bar_marketlist"></div>
                <div class="icon_bar_text">添加代理</div>
            </a>
        </div>
        <div class="icon_bar_cell"><a id="orderinfo_a" name="orderinfo_a" href="/index/index/orderinfo"><div class="icon_bar_trade"></div><div class="icon_bar_text">成员列表</div></a></div>
        <div class="icon_bar_cell"><a class="active" href="/index/index/index"><div class="icon_bar_index"></div><div class="icon_bar_text">首　页</div></a></div>
        <div class="icon_bar_cell"><a name="history_a" id="history_a" href="/index/index/history"><div class="icon_bar_history"></div><div class="icon_bar_text">数据统计</div></a></div>
        <div class="icon_bar_cell"><a name="my_a" id="my_a" href="/index/index/my"><div class="icon_bar_my"></div><div class="icon_bar_text">我　的</div></a></div>
    </div>
    <div id="Modal_coverchgall" class="cover"></div>
</div>



        <div id="Modal_coverchgall" class="cover"></div>
        <style>
            .icon_bar_trade {
                display: block;
                background: url(".//static/index/img/02-1.png") no-repeat;
                background-size: cover;
                width: 20px;
                height: 20px;
                position: relative;
                top: 8px;
                margin: 0px auto;
            }

            .history_row {
                display: table-row;
            }

            .no_content {
                font-size: 20px;
                width: 100%;
                font-weight: bold;
                text-align: center;
                letter-spacing: 1px;
                color: #0d3675;
                margin-top: 200px;
            }

        </style>
        <link rel="stylesheet" href="/static/index/css/account_history.css">
        <link rel="stylesheet" href="/static/index/css/public.css">
        <div class="title_background ">
            <div class="title">亲友圈数据</div>
        </div>
        <div class="trade_head">
            <div class="color_border_bottom">
            </div>
            <i onclick="javascript:window.history.go(-1);" class=" fa fa-angle-left" aria-hidden="true"></i>
            <div class="input-group" style="width: 50%">
                <input type="text" class="form-control" placeholder="请输入亲友圈Id" aria-label="...">
                <div class="input-group-btn">
                    <button class="btn btn-primary" type="button" @click="seach()"><i class="glyphicon glyphicon-search"></i>搜索</button>
                </div>
            </div>
        </div>
        <section class="tabs" style="position: relative; margin: 173px auto 0px auto;width: 100%;">
            <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked">
            <label for="tab-1" class="tab-label-1">本周</label>
            <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2">
            <label for="tab-2" class="tab-label-2">上周</label>
            <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3">
            <label for="tab-3" class="tab-label-3">本月</label>
            <input id="tab-4" type="radio" name="radio-set" class="tab-selector-4">
            <label for="tab-4" class="tab-label-4">上月</label>
            <div class="clear-shadow"></div>
            <div style="margin-top:0px;" class="content">
                <div class="content-1">
                    <div class="table_head">
                        <div class="table_head_cell" style="width: 15%">日期</div>
                        <div class="table_head_cell" style="width: 18%;margin-left: 5%">注册人数玩牌人数</div>
                        <div class="table_head_cell" style="width: 14%;margin-left: 9%">总局数小局数</div>
                        <div class="table_head_cell" style="width: 18%;margin-left: 9%">钻石消耗钻石剩余</div>
                    </div>
                    <div class="history_table">
                        <div class="history_row" onclick="">
                            <div class="history_cell" style="width: 15%;text-align: center">1111</div>
                            <div class="history_cell" style="width: 18%;text-align: center">1111</div>
                            <div class="history_cell" style="width: 14%;text-align: center">1111</div>
                            <div class="history_cell" style="width: 18%;text-align: center">1111</div>
                        </div>
                    </div>
                </div>
                <div class="content-2">
                    <div class="table_head">
                        <div class="table_head_cell" style="width: 15%">日期</div>
                        <div class="table_head_cell" style="width: 18%;margin-left: 5%">注册人数玩牌人数</div>
                        <div class="table_head_cell" style="width: 14%;margin-left: 9%">总局数小局数</div>
                        <div class="table_head_cell" style="width: 18%;margin-left: 9%">钻石消耗钻石剩余</div>
                    </div>
                    <div class="history_table">
                        <div class="history_row" onclick="">
                            <div class="history_cell" style="width: 15%;text-align: center">1111</div>
                            <div class="history_cell" style="width: 18%;text-align: center">1111</div>
                            <div class="history_cell" style="width: 14%;text-align: center">1111</div>
                            <div class="history_cell" style="width: 18%;text-align: center">1111</div>
                        </div>
                    </div>
                </div>
                <div class="content-3">
                    <div class="table_head">
                        <div class="table_head_cell date">日期</div>
                        <div class="table_head_cell trade_amount">对战信息</div>
                        <div class="table_head_cell result">下注金额</div>
                    </div>
                    <div class="history_table">
                        <div class="history_row" onclick="">
                            <div class="history_cell date "></div>
                            <div class="history_cell trade_amount" style="text-align: center;width: 40%"></div>
                            <div class="history_cell result color_green" style="width: 20%;text-align: center">
                                <div class="moneycoor_green"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="content-4">
                    <div class="table_head">
                        <div class="table_head_cell date">日期</div>
                        <div class="table_head_cell trade_amount">对战信息</div>
                        <div class="table_head_cell result">下注金额</div>
                    </div>
                    <div class="history_table">
                        <div class="history_row" onclick="">
                            <div class="history_cell date "></div>
                            <div class="history_cell trade_amount" style="text-align: center;width: 40%"></div>
                            <div class="history_cell result color_green" style="width: 20%;text-align: center">
                                <div class="moneycoor_green"></div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
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
        el: '#qyqData',
        data: {
            groupId: '',
        },
        created () {

        },
        methods: {
            seach () {
                let vm = this;
                let groupId= vm.groupId;
                axios
                    .post('/index/index/get_st',{groupId: groupId})
                    .then(function (response) {
                        if(response.data.code==1) {

                        }else{

                        }
                    })
                    .catch(function (error) { // 请求失败处理
                        console.log(error);
                    });
            },
        }

    })
</script>
