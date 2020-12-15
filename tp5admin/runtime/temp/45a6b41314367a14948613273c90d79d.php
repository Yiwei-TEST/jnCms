<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:95:"D:\phpstudy_pro\WWW\test\jnCms\tp5admin\public/../application/admin\view\journal\list_info.html";i:1607912643;s:81:"D:\phpstudy_pro\WWW\test\jnCms\tp5admin\application\admin\view\public\header.html";i:1607912643;s:81:"D:\phpstudy_pro\WWW\test\jnCms\tp5admin\application\admin\view\public\footer.html";i:1607912643;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config('WEB_SITE_TITLE'); ?></title>
    <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/animate.min.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="/static/admin/css/jedate.css" rel="stylesheet">
    <link href="/static/home/layui/css/layui.css" rel="stylesheet">
    <style type="text/css">
    .long-tr th{
        text-align: center
    }
    .long-td td{
        text-align: center
    }
    </style>
</head>

<style>
    .ibox-content {
        background-color: #fff;
        color: inherit;
        padding: 15px 20px 120px;
        border-color: #e7eaec;
        -webkit-border-image: none;
        -o-border-image: none;
        border-image: none;
        border-style: solid solid none;
        border-width: 1px 0;
    }
    .layui-input, .layui-textarea {
        display: block;
        width: 20%;
        padding-left: 10px;
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight" id="listInfo">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>账号信息</h5>
        </div>
        <div class="ibox-content">
            <!--搜索框开始-->
            <div class="row">
                <div class="col-sm-12">
                    <form name="admin_list_sea">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" v-model="userId" class="form-control" placeholder="输入需查询的玩家ID" />
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary" @click="seach()"><i class="fa fa-search"></i> 搜索</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--搜索框结束-->
            <div class="hr-line-dashed"></div>

            <div class="example-wrap">
                <div class="example">
                    <div style="padding: 20px; background-color: #F2F2F2;">
                        <div class="layui-row layui-col-space15">
                            <div class="layui-col-md3">
                                <div class="layui-card">
                                    <div class="layui-card-header">账号:</div>
                                    <div class="layui-card-body">
                                            {{userId}}
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md3">
                                <div class="layui-card">
                                    <div class="layui-card-header">昵称:</div>
                                    <div class="layui-card-body">
                                        {{nickname}}
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md3">
                                <div class="layui-card">
                                    <div class="layui-card-header">设备号:</div>
                                    <div class="layui-card-body">
                                        {{os}}
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md3">
                                <div class="layui-card">
                                    <div class="layui-card-header">注册时间:</div>
                                    <div class="layui-card-body">
                                        {{create_time}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-row layui-col-space15">
                            <div class="layui-col-md3">
                                <div class="layui-card">
                                    <div class="layui-card-header">房钻:</div>
                                    <div class="layui-card-body">
                                        {{cards}}
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md3">
                                <div class="layui-card">
                                    <div class="layui-card-header">免费房钻:</div>
                                    <div class="layui-card-body">
                                        {{freeCards}}
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md3">
                                <div class="layui-card">
                                    <div class="layui-card-header">上级邀请码:</div>
                                    <div class="layui-card-body">
                                        {{payBindId}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="layui-form-item">
                                <input type="number" v-model="card_number" autocomplete="off" placeholder="请输入钻石数量" class="layui-input">
                                <span style="display: block;color: red;position: absolute;right: 54%;top: 11%;font-weight: bold">平台可送钻石余额：{{pt_cards}}</span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <button class="col-sm-2 btn btn-warning" v-on:click="add_number(50)">+50</button>
                        <button class="col-sm-2 btn btn-warning" style="margin-left: 10px" v-on:click="add_number(5000)">+5000</button>
                        <button class="col-sm-2 btn btn-warning" style="margin-left: 10px" v-on:click="add_number(100000)">+100000</button>
                        <button class="col-sm-2 btn btn-warning" style="margin-left: 10px" v-on:click="add_number(10000000)">+10000000</button>
                    </div>
                </div>

            </div>
            <!-- End Example Pagination -->
            <div class="hr-line-dashed" style="margin-top: 80px"></div>
            <div class="form-group">
                <button class="col-sm-2 btn btn-primary" @click="add_cards(1)">赠送</button>
                <button class="col-sm-2 btn btn-info" @click="add_cards(2)" style="margin-left: 10px">补偿</button>
            </div>
            <div class="hr-line-dashed" style="margin-top: 80px"></div>
            <div class="form-group">
                <div class="layui-form-item">
                    <input type="number" v-model="kc_number" autocomplete="off" placeholder="请输入需要扣除的钻石数量" class="layui-input">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <button class="col-sm-2 btn btn-primary" style="background: #0a7963" @click="kc_card()">扣除钻石</button>
                <button class="col-sm-2 btn btn-info" style="margin-left: 10px;background: #0e8e90" @click="qc_card()">清除免费钻石</button>
            </div>
        </div>
    </div>
</div>
<!-- End Panel Other -->
</div>
<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/admin/js/content.min.js?v=1.0.0"></script>
<script src="/static/admin/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/static/admin/js/plugins/iCheck/icheck.min.js"></script>
<script src="/static/admin/js/plugins/layer/laydate/laydate.js"></script>
<script src="/static/admin/js/plugins/switchery/switchery.js"></script><!--IOS开关样式-->
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/laypage/laypage.js"></script>
<script src="/static/admin/js/laytpl/laytpl.js"></script>
<script src="/static/admin/js/lunhui.js"></script>
<script src="/static/admin/js/jedate.js"></script>
<script src="/static/admin/js/vue.js"></script>
<script src="/static/admin/js/axios.min.js"></script>
<script src="/static/admin/js/echarts.min.js"></script>
<script src="/static/home/layui/layui.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>

<script type="text/javascript">
    var app = new Vue({
        el: '#listInfo',
        data: {
            userId: '',
            nickname: '',
            naccount: '',
            create_time: '',
            cards: '',
            freeCards: '',
            payBindId: '',
            card_number: 0,
            userState: '',
            os: '',
            pt_cards: 0,
            kc_number: 0,
        },
        created () {
            this.get_pt_cards();
        },
        methods: {
            seach () {
                let vm = this;
                let uid = vm.userId;
                if(!uid){
                    layer.msg("请输入用户id");
                    return;
                }
                axios
                    .post('/admin/qyq/get_user',{uid: uid})
                    .then(function (response) {
                        if(response.data.code==1) {
                            vm.nickname    = response.data.data.name;
                            vm.create_time = response.data.data.regTime;
                            vm.cards        = response.data.data.cards;
                            vm.freeCards   = response.data.data.freeCards;
                            vm.payBindId   = response.data.data.payBindId;
                            vm.userState   = response.data.data.userState;
                            vm.os = response.data.data.os;
                        }else{
                            layer.msg(response.data.msg);
                        }

                    })
                    .catch(function (error) { // 请求失败处理
                        console.log(error);
                    });
            },
            get_pt_cards () {
                let vm = this;
                axios
                    .get('/admin/journal/get_pt_journal',{})
                    .then(function (response) {
                        if(response.data.code==1) {
                            vm.pt_cards = response.data.sums;
                        }
                    })
                    .catch(function (error) { // 请求失败处理
                        console.log(error);
                    });
            },
            add_number(n){
                let vm = this;
                if(!vm.card_number){
                    vm.card_number = 0;
                }
                vm.card_number = parseInt(vm.card_number)+ parseInt(n);
            },
            add_cards (type) {
                let vm = this;
                let card_number = vm.card_number;
                let userId      = vm.userId;
                let cards;
                let freeCards;
                if(!card_number || card_number<1){
                    layer.msg("请输入钻石数量！");
                    return;
                }
                if(!userId) {
                    layer.msg("请输入需要充值的用户id！");
                    return;
                }
                if(type===1) {
                     cards = card_number;
                     freeCards = 0;
                    layer.confirm('您确定要赠送钻石吗？', {
                        btn: ['确定','取消'] //按钮
                    }, function() {
                        axios
                            .post('/admin/journal/add_cards',{userId: userId,cards:cards,freeCards:freeCards,type:type})
                            .then(function (response) {
                                if(response.data.code==0) {
                                    layer.msg(response.data.message);
                                    vm.seach();
                                    vm.get_pt_cards();
                                }else{
                                    layer.msg(response.data.message);
                                }
                            })
                            .catch(function (error) { // 请求失败处理
                                console.log(error);
                            });
                    })
                }else{
                     cards = 0;
                     freeCards = card_number;
                    layer.confirm('您确定要补偿钻石吗？', {
                        btn: ['确定','取消'] //按钮
                    }, function() {
                        axios
                            .post('/admin/journal/add_cards',{userId: userId,cards:cards,freeCards:freeCards,type:type})
                            .then(function (response) {
                                if(response.data.code==0) {
                                    layer.msg(response.data.message);
                                    vm.seach();
                                    vm.get_pt_cards();
                                }else{
                                    layer.msg(response.data.message);
                                }
                            })
                            .catch(function (error) { // 请求失败处理
                                console.log(error);
                            });
                    })
                }
            },
            kc_card() {
                let vm = this;
                let kc_number = vm.kc_number;
                let userId      = vm.userId;
                if(!kc_number || kc_number<1){
                    layer.msg("请输入需要扣除的钻石数量！");
                    return;
                }
                if(!userId) {
                    layer.msg("请输入需要充值的用户id！");
                    return;
                }
                layer.confirm('您确定要扣除用户钻石吗？', {
                        btn: ['确定','取消'] //按钮
                    }, function() {
                    axios
                        .post('/admin/journal/kc_cards',{userId: userId,cards:kc_number,freeCards:0,})
                        .then(function (response) {
                            if(response.data.code==0) {
                                layer.msg(response.data.message);
                                vm.seach();
                                vm.get_pt_cards();
                            }else{
                                layer.msg(response.data.message);
                            }
                        })
                        .catch(function (error) { // 请求失败处理
                            console.log(error);
                        });
                })
            },
            qc_card() {
                let vm = this;
                let kc_number = vm.freeCards;
                let userId      = vm.userId;
                if(!kc_number || kc_number<1){
                    layer.msg("需要清除的免费钻石数量必须大于0！");
                    return;
                }
                if(!userId) {
                    layer.msg("请输入需要清除的用户id！");
                    return;
                }
                layer.confirm('您确定要清除用户免费钻石吗？', {
                    btn: ['确定','取消'] //按钮
                }, function() {
                    axios
                        .post('/admin/journal/qc_cards',{userId: userId,cards:0,freeCards:kc_number,})
                        .then(function (response) {
                            if(response.data.code==0) {
                                layer.msg(response.data.message);
                                vm.seach();
                                vm.get_pt_cards();
                            }else{
                                layer.msg(response.data.message);
                            }
                            console.log(response);
                        })
                        .catch(function (error) { // 请求失败处理
                            console.log(error);
                        });

                })
            },
        },
        mounted:function(){
        }
    })
</script>
</body>
</html>