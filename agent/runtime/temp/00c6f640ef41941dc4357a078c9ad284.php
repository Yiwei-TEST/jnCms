<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:92:"D:\phpstudy_pro\WWW\tp5admin\public/../application/admin\view\statistics\daily_stat_qyq.html";i:1606980026;s:70:"D:\phpstudy_pro\WWW\tp5admin\application\admin\view\public\header.html";i:1606978548;s:70:"D:\phpstudy_pro\WWW\tp5admin\application\admin\view\public\footer.html";i:1606978544;}*/ ?>
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
    .layui-form-label {
        /* float: left; */
        display: block;
        padding: 9px 15px;
        width: 100px;
        font-weight: 400;
        line-height: 20px;
        text-align: right;
    }
</style>
<body class="gray-bg">
<div style="padding: 20px; background-color: #F2F2F2;" id="dailyStat">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">
                    <div class="col-sm-2" style="font-weight: bold;color: red">亲友圈数据统计</div>
                    <div class="col-sm-4">
                                <span class="input-group-btn" id="dateShowBtn" style="height: 50px;">
                                    <input type="text" name="start_time" id="dateSelectorTwo" lay-verify="date" placeholder="开始时间" autocomplete="off"
                                           class="form-control jeinput" value="<?php echo $start_time; ?>">
                                </span>
                        <span class="input-group-btn" id="dateShowBtn1" style="height: 50px;">
                                    <input type="text" name="end_time" id="dateSelectorTwo1" lay-verify="date" placeholder="结束时间" autocomplete="off" class="form-control jeinput" value="<?php echo $end_time; ?>">
                                </span>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">亲友圈Id</label>
                        <div class="layui-input-inline">
                            <input type="text" v-model="uid" class="layui-input"  placeholder="亲友圈ID">
                        </div>
                    </div>
                    <button class="layui-btn" @click="seach()">搜索</button></div>
                <div class="layui-card-body">
                    <div id="containertrend" style="border: 1px solid #e2e2e2;height: 600px"></div>
                </div>
            </div>
        </div>

        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header"></div>
                <div class="layui-card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="long-tr">
                            <th width="9%">开始日期</th>
                            <th width="5%">注册人数</th>
                            <th width="6%">玩牌用户数</th>
                            <th width="5%">玩牌总局数</th>
                            <th width="5%">玩牌小局数</th>
                            <th width="5%">钻石消耗</th>
                            <th width="5%">钻石剩余</th>
                            <!--<th width="5%">钻石总赠送</th>-->
                            <!--<th width="5%">钻石总补偿</th>-->
                        </tr>
                        </thead>
                        <tbody id="list-content">
                            <tr v-for="item in data_list">
                                <td>{{item.tdate}}</td>
                                <td>{{item.xzdata}}</td>
                                <td>{{item.djdata}}</td>
                                <td>{{item.zjs}}</td>
                                <td>{{item.xjs}}</td>
                                <td style="color: red;font-weight: bold">{{item.card_xh}}</td>
                                <td style="color: green">{{item.card_sy}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>

    </div>
</div>
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
        el: '#dailyStat',
        data: {
            dateData: [],
            zcdata: [1,2,3,4,5,6,7],
            hydata: [3,7,8,9,10,11,12],
            czdata: [98,71,66,113,212,31,31],
            dldata: [198,171,266,13,212,31,31],
            fkdata: [298,271,366,53,22,312,311],
            zjsdata: [398,371,466,113,212,31,31],
            xdata: [9,7,6,13,12,33,21],
            myChart: '',
            start_time: "<?php echo $start_time; ?>",
            end_time: "<?php echo $end_time; ?>",
            data_list: [],
            uid: '',
        },
        created () {
            this.myChart = echarts.init(document.getElementById('containertrend'));
        },
        methods: {
                seach () {
                    let vm = this;
                    let start_time = $('#dateSelectorTwo').val();
                    let end_time   = $('#dateSelectorTwo1').val();
                    let uid = vm.uid;
                    axios
                        .post('/admin/statistics/daily_stat_qyq',{start_time: start_time,end_time: end_time,uid:uid})
                        .then(function (response) {
                            if(response.data.code==1) {
                                vm.data_list = response.data.data;
                                vm.options(response.data.tdate,response.data.xzdata,response.data.djdata,response.data.card_sy,response.data.card_xh,response.data.zjs,response.data.xjs);
                            }else{
                                layer.msg(response.data.msg);
                            }
                            console.log(response);
                        })
                        .catch(function (error) { // 请求失败处理
                            console.log(error);
                        });
                },
                options (dateData,zcdata,djdata,card_sy,card_xh,zjs,xjs) {
                    let option = {
                        title: {
                            text: '每日数据统计',
                            subtext: '今日'
                        },
                        tooltip: {
                            trigger: 'axis'
                        },
                        legend: {
                            data: ['注册人数', '对局次数', '钻石剩余', '钻石消耗', '大局数', '小局数']
                        },
                        toolbox: {
                            show: true,
                            feature: {
                                dataZoom: {
                                    yAxisIndex: 'none'
                                },
                                dataView: {readOnly: false},
                                magicType: {type: ['line', 'bar']},
                                restore: {},
                                saveAsImage: {}
                            }
                        },
                        xAxis: {
                            type: 'category',
                            boundaryGap: false,
                            data: dateData
                        },
                        yAxis: {
                            type: 'value',
                            axisLabel: {
                                formatter: '{value} 人'
                            }
                        },
                        series: [
                            {
                                name: '注册人数',
                                type: 'line',
                                data: zcdata,
                                markPoint: {
                                    data: [
                                        {type: 'max', name: '最大值'},
                                        {type: 'min', name: '最小值'}
                                    ]
                                },
                                markLine: {
                                    data: [
                                        {type: 'average', name: '平均值'}
                                    ]
                                }
                            },
                            {
                                name: '对局次数',
                                type: 'line',
                                data: djdata,
                                markPoint: {
                                    data: [
                                        {type: 'max', name: '最大值'},
                                        {type: 'min', name: '最小值'}
                                    ]
                                },
                                markLine: {
                                    data: [
                                        {type: 'average', name: '平均值'}
                                    ]
                                }
                            },
                            {
                                name: '钻石剩余',
                                type: 'line',
                                data: card_sy,
                                markPoint: {
                                    data: [
                                        {type: 'max', name: '最大值'},
                                        {type: 'min', name: '最小值'}
                                    ]
                                },
                                markLine: {
                                    data: [
                                        {type: 'average', name: '平均值'}
                                    ]
                                }
                            },
                            {
                                name: '钻石消耗',
                                type: 'line',
                                data: card_xh,
                                markPoint: {
                                    data: [
                                        {type: 'max', name: '最大值'},
                                        {type: 'min', name: '最小值'}
                                    ]
                                },
                                markLine: {
                                    data: [
                                        {type: 'average', name: '平均值'}
                                    ]
                                }
                            },
                            {
                                name: '大局数',
                                type: 'line',
                                data: zjs,
                                markPoint: {
                                    data: [
                                        {type: 'max', name: '最大值'},
                                        {type: 'min', name: '最小值'}
                                    ]
                                },
                                markLine: {
                                    data: [
                                        {type: 'average', name: '平均值'}
                                    ]
                                }
                            },
                            {
                                name: '小局数',
                                type: 'line',
                                data: xjs,
                                markPoint: {
                                    data: [
                                        {type: 'max', name: '最大值'},
                                        {type: 'min', name: '最小值'}
                                    ]
                                },
                                markLine: {
                                    data: [
                                        {type: 'average', name: '平均值'}
                                    ]
                                }
                            }
                        ]
                    }
                    this.myChart.setOption(option);
                }
        },
        mounted:function(){
        }
    })

    jeDate("#dateSelectorTwo",{
        theme:{bgcolor:"#1ab394",pnColor:"#00CCFF"},
        format: "YYYY-MM-DD hh:mm:ss"
    });
    jeDate("#dateSelectorTwo1",{
        theme:{bgcolor:"#1ab394",pnColor:"#00CCFF"},
        format: "YYYY-MM-DD hh:mm:ss"
    });
</script>
</body>
</html>
