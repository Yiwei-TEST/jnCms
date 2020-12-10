<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:81:"D:\phpstudy_pro\WWW\tp5admin\public/../application/admin\view\qyq\qyq_detail.html";i:1607420981;s:70:"D:\phpstudy_pro\WWW\tp5admin\application\admin\view\public\header.html";i:1606978548;s:70:"D:\phpstudy_pro\WWW\tp5admin\application\admin\view\public\footer.html";i:1606978544;}*/ ?>
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
                                        <span v-if="kf_start==1" class="layui-badge layui-bg-green">开启</span>
                                        <span v-if="kf_start==0" class="layui-badge layui-bg-gray">暂停</span>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md2">
                                <div class="layui-card">
                                    <div class="layui-card-header">昨日局数</div>
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
                    <div style="padding: 20px; background-color: #F2F2F2;" v-show="is_newqz">
                        <div class="layui-row layui-col-space15">
                            <div class="layui-col-md3">
                                <div class="layui-card">
                                    <div class="layui-card-header">新群主id</div>
                                    <div class="layui-card-body" style="color:red">
                                        <input type="text" v-model="newUserid" class="input-group" style="margin-bottom: 20px">
                                        <button class="btn btn-primary" style="margin-right: 20px;width: 77px" @click="move_qz()">确定</button>
                                        <button class="btn btn-danger" style="width: 77px" @click="closes(1)">取消</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 20px; background-color: #F2F2F2;" v-show="is_maxCount">
                        <div class="layui-row layui-col-space15">
                            <div class="layui-col-md3">
                                <div class="layui-card">
                                    <div class="layui-card-header">设置群最大人数</div>
                                    <div class="layui-card-body" style="color:red">
                                        <input type="text" v-model="maxCounts" class="input-group" style="margin-bottom: 20px">
                                        <button class="btn btn-primary" style="margin-right: 20px;width: 77px" @click="up_max_number()">确定</button>
                                        <button class="btn btn-danger" style="width: 77px" @click="closes(2)" >取消</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="col-sm-2 btn btn-danger"  @click="stop_qyq(1)" v-show="kf_start==1">暂停亲友圈</button>
                        <button class="col-sm-2 btn btn-primary"  @click="stop_qyq(0)" v-show="kf_start==0">开启亲友圈</button>
                        <button class="col-sm-2 btn btn-warning" @click="show_qz()" style="margin-left: 10px">转移群主</button>
                        <button class="col-sm-2 btn btn-info"     @click="show_qs()" style="margin-left: 10px">修改群最大人数</button>
                        <button class="col-sm-2 btn btn-info"     @click="show_list()" style="margin-left: 10px">查看群成员列表</button>
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
            is_newqz: false,
            is_maxCount: false,
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
            newUserid: '',
            maxCounts: '',
            kf_start: 1,
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
                                vm.day_js      = response.data.y_info;
                                vm.month_js   = response.data.m_info;
                                vm.kf_start   = response.data.data.kf_start;
                        }else{
                              layer.msg(response.data.msg);
                        }
                        console.log(response);
                    })
                    .catch(function (error) { // 请求失败处理
                        console.log(error);
                    });
            },
            show_qz() {
               this.is_newqz = true;
               this.is_maxCount = false;
            },
            show_qs() {
                this.is_newqz = false;
                this.is_maxCount = true;
            },
            closes(i) {
                if(i===1) {
                    this.is_newqz = false;
                }else{
                    this.is_maxCount = false;
                }
            },
            stop_qyq (start) {
                let vm = this;
                let msg;
                if(start===0 ){
                    msg = "您确定要开启亲友圈吗！";
                }else{
                    msg = "您确定要暂停亲友圈吗！";
                }
                let groupId = vm.groupId;
                layer.confirm(msg, {
                        btn: ['确定','取消'] //按钮
                    }, function() {
                    axios
                        .post('/admin/qyq/stop_qyq', {groupId: groupId,stat:start})
                        .then(function (response) {
                            if (response.data.code == 0) {
                                layer.msg(response.data.message);
                                vm.seach();
                            } else {
                                layer.msg(response.data.message);
                            }
                            console.log(response);
                        })
                        .catch(function (error) { // 请求失败处理
                            console.log(error);
                        });
                });
            },
            move_qz() {
                let vm = this;
                let groupId = vm.groupId;
                let userId  = vm.newUserid;
                let is_newqz = vm.is_newqz;
                if(!is_newqz) {
                    vm.is_newqz = true;
                    return;
                }
                if(!userId || !groupId){
                    layer.msg('参数错误！');
                    return;
                }
                layer.confirm('您确定要转换群主吗？', {
                        btn: ['确定','取消'] //按钮
                    }, function() {
                    axios
                        .post('/admin/qyq/move_qz', {userId: userId, groupId: groupId})
                        .then(function (response) {
                            if (response.data.code == 0) {
                                layer.msg(response.data.message);
                                vm.is_newqz = false;
                            } else {
                                layer.msg(response.data.message);
                            }
                        })
                        .catch(function (error) { // 请求失败处理
                            console.log(error);
                        });
                });
            },
            up_max_number() {
                let vm = this;
                let groupId = vm.groupId;
                let maxCount= vm.maxCounts;
                let is_maxCount = vm.is_maxCount;
                if(!is_maxCount) {
                    vm.is_maxCount = true;
                    return;
                }
                if(!maxCount){
                    layer.msg('请填写需要修改最大群人数');
                    return;
                }
                if(!groupId){
                    layer.msg('请填写亲友圈Id');
                    return;
                }
                layer.confirm('您确定要修改最大人数吗？', {
                        btn: ['确定','取消'] //按钮
                    }, function() {
                    axios
                        .post('/admin/qyq/up_max_number', {groupId: groupId, maxCount: maxCount})
                        .then(function (response) {
                            if (response.data.code == 0) {
                                layer.msg(response.data.message);
                                vm.is_maxCount = false;
                                vm.seach();
                            } else {
                                layer.msg(response.data.message);
                            }
                            console.log(response);
                        })
                        .catch(function (error) { // 请求失败处理
                            console.log(error);
                        });
                });
            },
            show_list() {
                let vm = this;
                let groupId = vm.groupId;
                if(!groupId) {
                    layer.msg("请填写groupId!");
                    return;
                }
                location.href = '/admin/qyq/qyq_list/?key='+groupId;
            },
        },
        mounted:function(){
        }
    })
</script>
</body>
</html>