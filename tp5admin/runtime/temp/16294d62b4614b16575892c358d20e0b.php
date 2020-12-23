<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:90:"D:\phpstudy_pro\WWW\test\jnCms\tp5admin\public/../application/admin\view\qyq\qyq_list.html";i:1608705051;s:81:"D:\phpstudy_pro\WWW\test\jnCms\tp5admin\application\admin\view\public\header.html";i:1607912643;s:81:"D:\phpstudy_pro\WWW\test\jnCms\tp5admin\application\admin\view\public\footer.html";i:1607912643;}*/ ?>
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
                <li class="active"><a href="<?php echo url('index'); ?>">用户列表</a></li>
            </ul>
        </div>
        <div class="ibox-content">
            <!--搜索框开始-->
            <div class="row">
                <div class="col-sm-12">
                    <div  class="col-sm-2" style="width: 100px">
                    </div>
                    <form name="admin_list_sea" class="form-search" method="post" action="<?php echo url('qyq_list'); ?>">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" id="key" class="form-control" name="key" value="<?php echo $val; ?>" placeholder="輸入需査詢亲友圈ID" />
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> 搜索</button>
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
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="long-tr">
                            <th width="9%">Id</th>
                            <th width="9%">昵称</th>
                            <th width="5%">角色</th>
                            <th width="5%">比赛分</th>
                            <th width="5%">上级Id</th>
                            <th width="5%">操作</th>
                        </tr>
                        </thead>
                        <script id="list-template" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}
                            <tr class="long-td">
                                <td>{{d[i].userId}}</td>
                                <td>{{d[i].userNickname}}</td>
                                {{# if(d[i].userRole==1){ }}
                                     <td class="label-danger">群主</td>
                                    {{# }else if(d[i].userRole==2){ }}
                                     <td class="label-info">管理员</td>
                                    {{# }else if(d[i].userRole==10000){ }}
                                     <td class="label-warning">合伙人</td>
                                    {{# }else if(d[i].userRole==90000){ }}
                                     <td class="label-default" style="color: #fff">成员</td>
                                    {{# }else{ }}
                                {{# } }}
                                <td style="color: red">{{d[i].credit / 100}}</td>
                                <td>{{d[i].promoterId}}</td>
                                <td><a href="javascript:;" onclick="fireUser({{d[i].userId}})" class="btn btn-primary btn-outline btn-xs">
                                    <i class="fa fa-paste"></i> 踢出亲友圈</a>&nbsp;&nbsp;
                                </td>
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
<!--模态1-->
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
    //laypage分页
    Ajaxpage();
    function Ajaxpage(curr){
        var key=$('#key').val();
        $.getJSON('<?php echo url("Qyq/qyq_list"); ?>', {page: curr || 1,key:key}, function(data){
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

    //重置密码
    function fireUser(uid){
        let groupId = "<?php echo $val; ?>";
        if(!groupId){
            layer.msg('亲友圈id不能为空');
            return;
        }
        layer.open({
            content: '确定提出此会员出亲友圈吗？',
            yes: function(index, layero){
                $.post('<?php echo url("Qyq/fireUser"); ?>',{userId:uid,groupId:groupId},function(res){
                    if(res.code==0) {
                        layer.msg(res.message,{time:500},function(){
                            location.reload();
                        })
                    }else{
                        layer.msg(res.message,{time:500},function(){
                        })
                    }
                })
            }
        })
    }
</script>
</body>
</html>
