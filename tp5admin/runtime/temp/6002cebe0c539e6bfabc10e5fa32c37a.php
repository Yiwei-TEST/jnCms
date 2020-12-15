<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:90:"D:\phpstudy_pro\WWW\test\jnCms\tp5admin\public/../application/admin\view\member\index.html";i:1607912643;s:81:"D:\phpstudy_pro\WWW\test\jnCms\tp5admin\application\admin\view\public\header.html";i:1607912643;s:89:"D:\phpstudy_pro\WWW\test\jnCms\tp5admin\application\admin\view\member\recharge_money.html";i:1607912643;s:81:"D:\phpstudy_pro\WWW\test\jnCms\tp5admin\application\admin\view\public\footer.html";i:1607912643;}*/ ?>
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
                        <div class="input-group" >
                            <a href="<?php echo url('add_member'); ?>"><button class="btn btn-outline btn-primary" type="button">添加管理员</button></a>
                        </div>
                    </div>
                    <form name="admin_list_sea" class="form-search" method="post" action="<?php echo url('index'); ?>">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" id="key" class="form-control" name="key" value="<?php echo $val; ?>" placeholder="輸入需査詢的用戶帳號" />
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
                            <th width="9%">账号</th>
                            <th width="9%">昵称</th>
                            <th width="5%">手机号</th>
                            <th width="5%">登录次数</th>
                            <th width="6%">状态</th>
                            <th width="10%">操作</th>
                        </tr>
                        </thead>
                        <script id="list-template" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}
                            <tr class="long-td">
                                <td>{{d[i].account}}</td>
                                <td>{{d[i].nickname}}</td>
                                <td>{{d[i].mobile}}</td>
                                <td>{{d[i].login_num}}</td>
                                <td>
                                    {{# if(d[i].status==1){ }}
                                    <a class="red" href="javascript:;" onclick="member_status({{d[i].id}});">
                                        <div id="zt{{d[i].id}}"><span class="label label-info">开启</span></div>
                                    </a>
                                    {{# }else{ }}
                                    <a class="red" href="javascript:;" onclick="member_status({{d[i].id}});">
                                        <div id="zt{{d[i].id}}"><span class="label label-danger">禁用</span></div>
                                    </a>
                                    {{# } }}
                                </td>
                                <td>
                                    <a href="javascript:;" onclick="edit_member({{d[i].id}})" class="btn btn-primary btn-outline btn-xs">
                                    <i class="fa fa-paste"></i> 编辑</a>&nbsp;&nbsp;
                                    <a href="javascript:;" onclick="del_member({{d[i].id}})" class="btn btn-danger btn-outline btn-xs">
                                    <i class="fa fa-trash-o"></i>删除用户</a>
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
<div class="modal fade" id="myModal1"  role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">充值余额</h4>
            </div>
            <div class="modal-body" id="ajax-data">
                <div class="ibox-content">
    <div class="form-group">
        <a class="btn btn-danger btn-outline btn-xs"><i class="fa fa-rmb">会员余额</i></a><span id="xmoney" style="font-weight: bold;margin-left: 20px;font-size: 16px;color: #F37B1D"><?php echo $xmoney; ?></span>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <a style="margin-left:10px" class="btn btn-warning btn-outline btn-xs" id="cz"><i class="fa fa-rmb"></i>充值</a>
        <a style="margin-left:100px" class="btn btn-success btn-outline btn-xs" id="tl"><i class="fa fa-rmb"></i>提领</a>
        <a style="margin-left:100px" class="btn btn-success btn-outline btn-xs" id="tlall"><i class="fa fa-rmb"></i>提领全部</a>
    </div>
</div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
        var type = '<?php echo $type; ?>';
        $.getJSON('<?php echo url("Member/index"); ?>', {page: curr || 1,key:key,type:type}, function(data){
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

    //编辑会员
    function edit_member(id){
        var type = "<?php echo $type; ?>";
        if(type){
            location.href = '../../edit_member/id/'+id+'.html';
        }else{
            location.href = './edit_member/id/'+id+'.html';
        }
    }


    //充值
    var RECHARGE_URL = "/admin/member/recharge_money";
    var RESETPSS_URL = "/admin/member/reset_password";  //重置密码
    var RECHAR_URL = "/admin/member/recharge"; //充值
    let rtype = 0;
    function recharge_money(id){
        $.post(RECHARGE_URL,{id:id},function(res){
            if(res) {
                $("#ajax-data").html(res);
                $(document).ready(function(){
                    $("#cz").click(function(){
                        layer.prompt({
                            formType: 0,
                            value: "",
                            title: '请输入需要充值的金额',
                            area: ['100px', '50px'] //自定义文本域宽高
                        }, function(value, index, elem){
                            if(parseInt(value)>parseInt("<?php echo $money; ?>")){
                                layer.msg('金额不足');
                                return false;
                            }else{
                                rtype = 1;
                                recharge(id,rtype,value ,function(res){
                                    if(res.code==1){
                                        layer.msg('充值成功',{time:500},function(){
                                            $("#money").text(res.money);
                                            $("#xmoney").text(res.xmoney);
                                        });
                                    }else{
                                        layer.msg(res.msg);
                                    }
                                });
                            }
                            layer.close(index);
                        });
                    })

                    $("#tl").click(function(){
                        var oDate = new Date();
                        var hh    = oDate.getHours();
                        var mm=oDate.getMinutes();
                            layer.prompt({
                                formType: 0,
                                value: "",
                                title: '请输入需要提领的金额',
                                area: ['100px', '50px'] //自定义文本域宽高
                            }, function(value, index, elem){
                                rtype = 2;
                                recharge(id,rtype,value ,function(res){
                                    if(res.code==1){
                                        layer.msg('提领成功',{time:500},function(){
                                            $("#money").text(res.money);
                                            $("#xmoney").text(res.xmoney);
                                        });
                                    }else{
                                        layer.msg(res.msg);
                                    }
                                });
                                layer.close(index);
                            });
                    })

                    $("#tlall").click(function(){
                        var oDate = new Date();
                        var hh    = oDate.getHours();
                        var mm=oDate.getMinutes();
                            layer.open({
                                content: '确定提领全部？',
                                yes: function(index, layero){
                                    rtype = 3;
                                    recharge(id,rtype,0,function(res){
                                        if(res.code==1){
                                            layer.msg('全部提领成功',{time:500},function(){
                                                $("#money").text(res.money);
                                                $("#xmoney").text(res.xmoney);
                                            });
                                        }else{
                                            layer.msg(res.msg);
                                        }
                                    });
                                }
                            });
                    })
                })
            }
        })
    }
    function recharge(id,rtype,value ,callback) {
        $.post(RECHAR_URL,{id:id,type:rtype,money:value},function(res){
            callback(res);
        })
    }
    //重置密码
    function reset_password(id){
        layer.open({
            content: '确定重置密码吗？',
            yes: function(index, layero){
                $.post(RESETPSS_URL,{id:id},function(res){
                    console.log(res);
                    if(res.code==1) {
                        layer.msg(res.msg,{time:500},function(){
                            location.reload();
                        })
                    }
                })
            }
        })
    }

    //查看下级
    function level_info(id){
        location.href = './level_info/id/'+id+'.html';
    }

    //删除会员
    function del_member(id){
        lunhui.confirm(id,'<?php echo url("del_member"); ?>');
    }

    //用户会员
    function member_status(id){
        lunhui.status(id,'<?php echo url("member_status"); ?>');
    }

</script>
</body>
</html>
