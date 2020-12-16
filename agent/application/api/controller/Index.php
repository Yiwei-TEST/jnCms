<?php
namespace app\api\controller;
use app\api\model\StatisticsPt;
use app\api\model\StatisticsQyq;
use think\Db;
use think\Config;
class Index
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }

    /**
     * 定时移动当天平台统计数据
    */
    public function get_t_data() {
        $parm['xzdata'] = get_xzdata();
        $parm['hydata'] = get_hydata();
        $parm['djdata'] = get_djdata();
        $parm['zjs'] = get_zjs();
        $parm['xjs'] = get_xjs();
        $parm['card_xh'] = get_card_xh();
        $parm['card_sy'] = get_card_sy();
        $parm['tdate']   = date('Y-m-d H:i;s',strtotime('-1 day'));
        $s_model = new StatisticsPt();
        $res = $s_model->insertStatistics($parm);
        return json($res);
    }

    /**
     * 定时移动当天亲友圈统计数据
     */
    public function get_qyq_data() {
        $group_list = get_group_list();
        $s_model = new StatisticsQyq();
        $res = $s_model->insertStatistics($group_list);
        return json($res);
    }

    /**
     * 统计在线人数
     */
    public function get_nump() {
        $list = get_nump();
        if(count($list)>0){
            $cont = 0;
            foreach ($list as $key=>$v) {
                $data[$key]['type'] = $v['name'];
                $data[$key]['number'] = $v['onlineCount'];
                $data[$key]['addtime'] = date('Y-m-d H:i:s');
                $cont += $v['onlineCount'];
            }
            $data1['type'] = 0;
            $data1['number'] = $cont;
            $data1['addtime'] = date('Y-m-d H:i:s');
            $res = Db::name('onlin')->insertAll($data);
            Db::name('onlin')->insert($data1);
            if(!empty($res)){
                apilog('在线人数数据添加成功',1);
                return json(['code'=>1,'msg'=>'记录成功']);
            }
        }
    }

    /**
     *会员绑定业务员
     */
    public  function bind_agent() {
        header("Access-Control-Allow-Origin:*");
        header("Access-Control-Allow-Methods:GET, POST, OPTIONS, DELETE");
        header("Access-Control-Allow-Headers:DNT,X-Mx-ReqToken,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type, Accept-Language, Origin, Accept-Encoding");
             $package = input('get.package'); //区分包名
             $package_info = Db::name('packages')->where('name',$package)->find();
             if(empty($package_info)) {
                 $r_data['code']= -1;
                 $r_data['message']= "权限不足请重试";
                 $r_datas = json_encode($r_data);
                 $r_datass = encrypt_info($r_datas);
                 return urlencode($r_datass);
             }
             $data      =  file_get_contents("php://input");
             apilog($data);
             if(empty($data)){
                 $r_data['code']= -1;
                 $r_data['message']= "参数错误";
                 $r_datas = json_encode($r_data);
                 $r_datass = encrypt_info($r_datas);
                 return urlencode($r_datass);
                 return json($r_data);
             }
             $data = urldecode($data);
             $data_info = decrypt_info($data);
             $sign  = $data_info['sign'];
             unset($data_info['sign']);
             if(checkSigns($data_info) !=$sign) {
                 $r_data['code']= -2;
                 $r_data['message']= "签名错误";
                 $r_datas = json_encode($r_data);
                 $r_datass = encrypt_info($r_datas);
                 return urlencode($r_datass);
             }
             $userinfo = Db::name('member')->where('payBindId',$data_info['payBindId'])->find();
             if(empty($userinfo)) {
                 $r_data['code']= -3;
                 $r_data['message']= "推广码无效";
                 $r_datas = json_encode($r_data);
                 $r_datass = encrypt_info($r_datas);
                 return urlencode($r_datass);
             }
            $db2 = Config::get('db2');
            $userId =  $data_info['userId'];
            $payBindId = $data_info['payBindId'];
            $date      = date('Y-m-d H:i:s');
            $sql = "UPDATE user_inf SET `payBindId`='$payBindId', payBindTime='$date' WHERE `userId`='$userId'";
            $bind_info = Db::connect($db2)->query($sql);
             if($bind_info!==false) {
                 $r_data['code']= 0;
                 $r_data['message']= "绑定成功";
                 $r_datas = json_encode($r_data);
                 $r_datass = encrypt_info($r_datas);
                 return urlencode($r_datass);
             }
    }

    /**
     *查询会员绑定业务员
     */
    public  function get_bind_agent() {
        header("Access-Control-Allow-Origin:*");
        header("Access-Control-Allow-Methods:GET, POST, OPTIONS, DELETE");
        header("Access-Control-Allow-Headers:DNT,X-Mx-ReqToken,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type, Accept-Language, Origin, Accept-Encoding");
        $package = input('get.package'); //区分包名
        $package_info = Db::name('packages')->where('name',$package)->find();
        if(empty($package_info)) {
            $r_data['code']= -1;
            $r_data['message']= "权限不足请重试";
            $r_datas = json_encode($r_data);
            $r_datass = encrypt_info($r_datas);
            return urlencode($r_datass);
        }
        $data      =  file_get_contents("php://input");
        if(empty($data)){
            $r_data['code']= -1;
            $r_data['message']= "参数错误";
            $r_datas = json_encode($r_data);
            $r_datass = encrypt_info($r_datas);
            return urlencode($r_datass);
        }
        $data = urldecode($data);
        $data_info = decrypt_info($data);
        $sign  = $data_info['sign'];
        unset($data_info['sign']);
        if(checkSigns($data_info) !==$sign) {
            $r_data['code']= -2;
            $r_data['message']= "签名错误";
            $r_datas = json_encode($r_data);
            $r_datass = encrypt_info($r_datas);
            return urlencode($r_datass);
        }
        $db2 = Config::get('db2');
        $userId =  $data_info['userId'];
        $sql = " SELECT payBindId FROM user_inf WHERE userId='$userId'";
        $bind_info = Db::connect($db2)->query($sql);
        if($bind_info!==false) {
            $r_data['code']= 0;
            $r_data['message']= "此已经绑定payBindId";
            $r_datas = json_encode($r_data);
            $r_datass = encrypt_info($r_datas);
            return urlencode($r_datass);
        }else{
            $r_data['code']= 1;
            $r_data['message']= "未绑定payBindId";
            $r_datas = json_encode($r_data);
            $r_datass = encrypt_info($r_datas);
            return urlencode($r_datass);
        }
    }

}
