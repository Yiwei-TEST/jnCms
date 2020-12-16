<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"D:\phpstudy_pro\WWW\agent\public/../application/admin\view\qyq\qyq_detail.html";i:1606893885;s:67:"D:\phpstudy_pro\WWW\agent\application\admin\view\public\header.html";i:1606978548;s:67:"D:\phpstudy_pro\WWW\agent\application\admin\view\public\footer.html";i:1606978544;}*/ ?>
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
        padding: 15px 20px 59px;
        border-color: #e7eaec;
        -webkit-border-image: none;
        -o-border-image: none;
        border-image: none;
        border-style: solid solid none;
        border-width: 1px 0;
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight" id="qyqDetail">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>亲友圈资料</h5>
        </div>
        <div class="ibox-content">
            <!--搜索框开始-->
            <div class="row">
                <div class="col-sm-12">
                    <form name="admin_list_sea" class="form-search" method="post">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" v-model="groupId" class="form-control" placeholder="输入需查询的亲友圈ID" />
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
                            <div class="layui-col-md2">
                                <div class="layui-card">
                                    <div class="layui-card-header">亲友圈ID</div>
                                    <div class="layui-card-body" style="color:red">
                                        {{groupId}}
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md2">
                                <div class="layui-card">
                                    <div class="layui-card-header">亲友圈名称</div>
                                    <div class="layui-card-body">
                                        <span v-show="groupName" class="layui-badge">{{groupName}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md2">
                                <div class="layui-card">
                                    <div class="layui-card-header">最大人数</div>
                                    <div class="layui-card-body">
                                        {{maxCount}}
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md2">
                                <div class="layui-card">
                                    <div class="layui-card-header">成员人数</div>
                                    <div class="layui-card-body">
                                        {{currentCount}}
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md2">
                                <div class="layui-card">
                                    <div class="layui-card-header">创建时间</div>
                                    <div class="layui-card-body">
                                        {{createdTime}}
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md2">
                                <div class="layui-card">
                                    <div class="layui-card-header">状态</div>
                                    <div class="layui-card-body">
                                        <span v-if="groupState==1" class="layui-badge layui-bg-green">开启</span>
                                        <span v-if="groupState==0" class="layui-badge layui-bg-gray">暂停</span>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md2">
                                <div class="layui-card">
                                    <div class="layui-card-header">今日局数</div>
                                    <div class="layui-card-body">
                                        {{day_js}}
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md2">
                                <div class="layui-card">
                                    <div class="layui-card-header">本月局数</div>
                                    <div class="layui-card-body">
                                        {{month_js}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="ibox-title">
                        <h5>群主资料</h5>
                    </div>
                    <div style="padding: 20px; background-color: #F2F2F2;">
                        <div class="layui-row layui-col-space15">
                            <div class="layui-col-md2">
                                <div class="layui-card">
                                    <div class="layui-card-header">群主id</div>
                                    <div class="layui-card-body" style="color:red">
                                        {{userId}}
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md2">
                                <div class="layui-card">
                                    <div class="layui-card-header">群主昵称</div>
                                    <div class="layui-card-body">
                                        <span v-show="nickname" class="layui-badge">{{nickname}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md2">
                                <div class="layui-card">
                                    <div class="layui-card-header">联系人</div>
                                    <div class="layui-card-body">
                                        <span v-show="name" class="layui-badge"> {{name}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md2">
                                <div class="layui-card">
                                    <div class="layui-card-header">手机号码</div>
                                    <div class="layui-card-body">
                                        {{phoneNum}}
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md2">
                                <div class="layui-card">
                                    <div class="layui-card-header">群主当前房钻</div>
                                    <div class="layui-card-body" style="color: green;font-weight: bold">
                                        {{card}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <button class="col-sm-2 btn btn-danger">暂停亲友圈</button>
                        <button class="col-sm-2 btn btn-warning" style="margin-left: 10px">转移群主</button>
                        <button class="col-sm-2 btn btn-info" style="margin-left: 10px">修改群最大人数</button>
                        <button class="col-sm-2 btn btn-info" style="margin-left: 10px">查看群成员列表</button>
                    </div>
                </div>
            </div>
            <!-- End Example Pagination -->
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
        el: '#qyqDetail',
        data: {
            groupId: '',
            groupName: '',
            maxCount: '',
            currentCount: '',
            createdTime: '',
            day_js: '',
            month_js: '',
            userId: '',
            name: '',
            nickname: '',
            phoneNum: '',
            card: '',
            groupState: '',

        },
        created () {

        },
        methods: {
            seach () {
                let vm = this;
                let groupId = vm.groupId;
                if(!groupId){
                    layer.msg("请填写亲友圈id!");
                    return;
                }
                axios
                    .post('/admin/qyq/getid_by_detail',{groupId: groupId})
                    .then(function (response) {
                        console.log(response.data.data);
                        if(response.data.code==1) {
                                vm.card = response.data.data.cards + response.data.data.freeCards;
                                vm.currentCount = response.data.data.currentCount;
                                vm.maxCount = response.data.data.maxCount;
                                vm.name      = response.data.data.name;
                                vm.nickname = response.data.data.userNickname;
                                vm.groupState = response.data.data.groupState;
                                vm.groupName = response.data.data.groupName;
                                vm.phoneNum  = response.data.data.phoneNum;
                                vm.userId    = response.data.data.promoterId1;
                                vm.createdTime = response.data.data.createdTime;
                        }else{

                        }
                        console.log(response);
                    })
                    .catch(function (error) { // 请求失败处理
                        console.log(error);
                    });
            },
            add_qyq () {
                let vm = this;
                let start_time = vm.start_time;
                axios
                    .post('',{start_time: start_time})
                    .then(function (response) {
                        if(response.data.code==1) {

                        }else{

                        }
                        console.log(response);
                    })
                    .catch(function (error) { // 请求失败处理
                        console.log(error);
                    });
            },
        },
        mounted:function(){
        }
    })
</script>
</body>
</html>