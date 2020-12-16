<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:79:"E:\phpStudy\WWW\foot\tp5admin\public/../application/admin\view\order\index.html";i:1590652491;s:71:"E:\phpStudy\WWW\foot\tp5admin\application\admin\view\public\header.html";i:1590632779;s:71:"E:\phpStudy\WWW\foot\tp5admin\application\admin\view\public\footer.html";i:1590632348;}*/ ?>
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
    .nav-tabs>li>a {
        color: #1ab394;
        font-weight: 600;
        padding: 10px 20px 10px 25px;
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <ul class="nav nav-tabs">
                <li class="active"><a href="<?php echo url('index'); ?>">訂單管理</a></li>
            </ul>
        </div>
        <div class="ibox-content">
            <!--搜索框开始-->
            <div class="row">
                <div class="col-sm-12">
                    <form name="admin_list_sea" class="form-search" method="post" action="<?php echo url('index'); ?>">
                        <div class="row">
                        <div class="col-sm-1">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn">開始時間</label>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                                <span class="input-group-btn" id="dateShowBtn">
                                    <input type="text" name="start_time" id="dateSelectorTwo" lay-verify="date" placeholder="开始时间" autocomplete="off"
                                           class="form-control jeinput" value="<?php echo $start_time; ?>">
                                </span>
                        </div>
                        <div class="col-sm-1">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn">結束時間</label>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                        <span class="input-group-btn" id="dateShowBtn1">
                                    <input type="text" name="end_time" id="dateSelectorTwo1" lay-verify="date" placeholder="结束时间" autocomplete="off" class="form-control jeinput" value="<?php echo $end_time; ?>">
                                </span>
                        </div>
                            <div class="col-sm-1">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn">状态</label>
                                </span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <span class="input-group-btn" >
                                    <select class="form-control m-b chosen-select" name="types" id="types">
                                            <?php if($types==''): ?>
                                            <option value="">全部</option>
                                            <?php elseif($types ==1): ?>
                                            <option value="1">等待驗證</option>
                                            <?php elseif($types ==2): ?>
                                            <option value="2">交易中</option>
                                            <?php elseif($types ==3): ?>
                                            <option value="3">交易成功</option>
                                            <?php elseif($types ==4): ?>
                                            <option value="4">交易失敗</option>
                                            <?php else: endif; ?>
                                            <option value="1">等待驗證</option>
                                            <option value="2">交易中</option>
                                            <option value="3">交易成功</option>
                                            <option value="4">交易失敗</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn">類型</label>
                                </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <span class="input-group-btn" >
                                    <select class="form-control m-b chosen-select" name="typess" id="typess">
                                            <?php if($typess==''): ?>
                                            <option value="">全部</option>
                                             <?php elseif($typess ==1): ?>
                                            <option value="1">ID</option>
                                            <?php elseif($typess ==2): ?>
                                            <option value="2">代币ID</option>
                                            <?php elseif($typess ==3): ?>
                                            <option value="3">收款方地址</option>
                                            <?php elseif($typess ==4): ?>
                                            <option value="4">TXID</option>
                                            <?php elseif($typess ==5): ?>
                                            <option value="5">商戶訂單號</option>
                                             <?php else: endif; ?>
                                            <option value="1">ID</option>
                                            <option value="2">代币ID</option>
                                            <option value="3">收款方地址</option>
                                            <option value="4">TXID</option>
                                            <option value="5">商戶訂單號</option>
                                    </select>
                                </span>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" id="key" class="form-control" name="key" value="<?php echo $val; ?>" placeholder="輸入需査詢的内容" />
                                    <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> 蒐索</button>
                                </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--搜索框结束-->
            <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="long-tr">
                            <th width="9%">商戶訂單號</th>
                            <th width="9%">貨幣</th>
                            <th width="5%">訂單金額</th>
                            <th width="5%">手續費</th>
                            <th width="5%">收款地址</th>
                            <th width="5%">txid</th>
                            <th width="6%">訂單狀態</th>
                            <th width="6%">时间</th>
                        </tr>
                        </thead>
                        <script id="list-template" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}
                            <tr class="long-td">
                                <td>{{d[i].order_number}}</td>
                                <td>{{d[i].order_name}}</td>
                                <td>{{d[i].order_money}}</td>
                                <td>{{d[i].service}}</td>
                                <td>{{d[i].adderss}}</td>
                                <td>{{d[i].txid}}</td>
                                <td>
                                    {{# if(d[i].status==1){ }}
                                         等待驗證
                                    {{# }else if (d[i].status==2){ }}
                                          交易中
                                    {{# }else if (d[i].status==3){ }}
                                          交易完成
                                    {{# }else if (d[i].status==4){ }}
                                          交易失敗
                                    {{# }else{ }}
                                    {{# } }}
                                </td>
                                <td>{{getLocalTime(d[i].add_time) }}</td>
                            </tr>
                            {{# } }}
                        </script>
                        <tbody id="list-content"></tbody>
                    </table>
                    <div id="AjaxPage" style=" text-align: right;"></div>
                    <div id="allpage" style=" text-align: right;"></div>
                </div>
            </div>
            <!-- End Example Pagination -->
        </div>
    </div>
</div>
<!-- End Panel Other -->
</div>

<!-- 加载动画 -->
<div class="spiner-example">
    <div class="sk-spinner sk-spinner-three-bounce">
        <div class="sk-bounce1"></div>
        <div class="sk-bounce2"></div>
        <div class="sk-bounce3"></div>
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
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>

<script type="text/javascript">

    //laypage分页
    Ajaxpage();
    function Ajaxpage(curr){
        var key = $('#key').val();
        var start_time = $('#dateSelectorTwo').val();
        var end_time = $('#dateSelectorTwo1').val();
        var types = $("#types option:selected").val();
        var typess = $("#typess option:selected").val();
        var type = '<?php echo $type; ?>';
        $.getJSON('<?php echo url("Order/index"); ?>', {page: curr || 1,key:key,type:type,start_time:start_time,end_time:end_time,types:types,typess:typess}, function(data){
            $(".spiner-example").css('display','none'); //数据加载完关闭动画
            if(data==''){
                $("#list-content").html('<td colspan="20" style="padding-top:10px;padding-bottom:10px;font-size:16px;text-align:center">暂无数据</td>');
            }else{
                var tpl = document.getElementById('list-template').innerHTML;
                laytpl(tpl).render(data, function(html){
                    document.getElementById('list-content').innerHTML = html;
                });
                laypage({
                    cont: $('#AjaxPage'),//容器。值支持id名、原生dom对象，jquery对象,
                    pages:'<?php echo $allpage; ?>',//总页数
                    skip: true,//是否开启跳页
                    skin: '#1AB5B7',//分页组件颜色
                    curr: curr || 1,
                    groups: 3,//连续显示分页数
                    jump: function(obj, first){
                        if(!first){
                            Ajaxpage(obj.curr)
                        }
                        $('#allpage').html('第'+ obj.curr +'页，共'+ obj.pages +'页');
                    }
                });
            }
        });
    }
    function getLocalTime(nS) {
        return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
    }
    //编辑会员
    function edit_member(id){
        var type = "<?php echo $type; ?>";
        if(type){
            location.href = '../../edit_member/id/'+id+'.html';
        }else{
            location.href = './edit_member/id/'+id+'.html';
        }
    }

    //删除会员
    function del_member(id){
        lunhui.confirm(id,'<?php echo url("del_member"); ?>');
    }

    //用户会员
    function member_status(id){
        lunhui.status(id,'<?php echo url("member_status"); ?>');
    }
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
