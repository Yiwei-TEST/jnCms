<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"D:\phpstudy_pro\WWW\tp5admin\public/../application/admin\view\journal\list_info.html";i:1606959448;s:70:"D:\phpstudy_pro\WWW\tp5admin\application\admin\view\public\header.html";i:1606978548;s:70:"D:\phpstudy_pro\WWW\tp5admin\application\admin\view\public\footer.html";i:1606978544;}*/ ?>
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
                                    <div class="layui-card-header">数字账号:</div>
                                    <div class="layui-card-body">
                                        {{naccount}}
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
                                        {{card}}
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
                <button class="col-sm-2 btn btn-primary">赠送</button>
                <button class="col-sm-2 btn btn-info" style="margin-left: 10px">补偿</button>
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
            card: '',
            payBindId: '',
            card_number: 0,
            userState: '',
        },
        created () {

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
                            vm.nickname = response.data.data.name;
                            vm.create_time = response.data.data.regTime;
                            vm.card = response.data.data.cards + response.data.data.freeCards;
                            vm.payBindId = response.data.data.payBindId;
                            vm.userState = response.data.data.userState;
                        }else{

                        }
                        console.log(response);
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
            }
        },
        mounted:function(){
        }
    })
</script>
</body>
</html>