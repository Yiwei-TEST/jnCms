<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:86:"D:\phpstudy_pro\WWW\agent\public/../application/admin\view\statistics\onlin_curve.html";i:1606980395;s:67:"D:\phpstudy_pro\WWW\agent\application\admin\view\public\header.html";i:1606978548;s:67:"D:\phpstudy_pro\WWW\agent\application\admin\view\public\footer.html";i:1606978544;}*/ ?>
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
    td{
        text-align: center;
    }
</style>
<body class="gray-bg">
<div style="padding: 20px; background-color: #F2F2F2;" id="dailyStat">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">
                    <div class="col-sm-2" style="font-weight: bold;color: red">在线人数统计</div>
                    <div class="col-sm-4">
                                <span class="input-group-btn" id="dateShowBtn" style="height: 50px;">
                                    <input type="text" name="start_time" id="dateSelectorTwo" lay-verify="date" placeholder="开始时间" autocomplete="off"
                                           class="form-control jeinput" value="<?php echo $start_time; ?>">
                                </span>
                        <span class="input-group-btn" id="dateShowBtn1" style="height: 50px;">
                                    <input type="text" name="end_time" id="dateSelectorTwo1" lay-verify="date" placeholder="结束时间" autocomplete="off" class="form-control jeinput" value="<?php echo $end_time; ?>">
                                </span>
                    </div>
                    <button class="layui-btn" @click="seach()">搜索</button></div>
                <div class="layui-card-body">
                    <div id="containertrend" style="border: 1px solid #e2e2e2;height: 600px"></div>
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
            myChart: '',
            start_time: "<?php echo $start_time; ?>",
            end_time: "<?php echo $end_time; ?>",
        },
        created () {
            this.myChart = echarts.init(document.getElementById('containertrend'));
            this.get_data();
        },
        methods: {
            get_data() {
                let vm = this;
                axios
                    .post('/admin/statistics/onlin_curves',{start_time: '',end_time: ''})
                    .then(function (response) {
                        if(response.data.code ==1) {
                            vm.options(response.data.tdate,response.data.cont_f,response.data.cont_f1,response.data.cont_f2,response.data.cont_f3,response.data.cont_f4,response.data.cont_f5
                            ,response.data.cont_f6);
                        }else{

                        }
                        console.log(response);
                    })
                    .catch(function (error) { // 请求失败处理
                        console.log(error);
                    });
            },
            seach () {
                let vm = this;
                let start_time = $('#dateSelectorTwo').val();
                let end_time   = $('#dateSelectorTwo1').val();
                axios
                    .post('/admin/statistics/onlin_curves',{start_time: start_time,end_time: end_time})
                    .then(function (response) {
                        if(response.data.code==1) {
                            vm.options(response.data.tdate,response.data.cont_f,response.data.cont_f1,response.data.cont_f2,response.data.cont_f3,response.data.cont_f4,response.data.cont_f5
                                ,response.data.cont_f6);
                        }else{

                        }
                        console.log(response);
                    })
                    .catch(function (error) { // 请求失败处理
                        console.log(error);
                    });
            },
            options (dateData,cont_f,cont_f1,cont_f2,cont_f3,cont_f4,cont_f5,cont_f6) {
                let option = {
                    title: {
                        text: '每日数据统计',
                        subtext: '今日'
                    },
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        data: ['总服在线人数', '1服', '2服', '3服', '4服', '5服', '6服']
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
                            name: '总服在线人数',
                            type: 'line',
                            data: cont_f,
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
                            name: '1服',
                            type: 'line',
                            data: cont_f1,
                            markPoint: {
                                data: [

                                ]
                            },
                            markLine: {
                                data: [
                                    {type: 'average', name: '平均值'},
                                    [{
                                        symbol: 'none',
                                        x: '90%',
                                        yAxis: 'max'
                                    }, {
                                        symbol: 'circle',
                                        label: {
                                            position: 'start',
                                            formatter: '最大值'
                                        },
                                        type: 'max',
                                        name: '最高点'
                                    }]
                                ]
                            }
                        },
                        {
                            name: '2服',
                            type: 'line',
                            data: cont_f2,
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
                            name: '3服',
                            type: 'line',
                            data: cont_f3,
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
                            name: '4服',
                            type: 'line',
                            data: cont_f4,
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
                            name: '5服',
                            type: 'line',
                            data: cont_f5,
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
                            name: '6服',
                            type: 'line',
                            data: cont_f6,
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
