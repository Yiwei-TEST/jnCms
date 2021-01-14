<?php
namespace app\api\controller;
use app\api\model\StatisticsPt;
use app\api\model\StatisticsQyq;
use think\Db;
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
    public function get_qyq_datad() {
        $date = input('date');
        $info = Db::name('statistics_qyq')->where('tdate',$date)->find();
        if(!empty($info)){
            return json(['code'=>-1,'message'=>$date."日期已存在，无需重复生成"]);
        }
        $group_list = get_group_list();
        $s_model = new StatisticsQyq();
        $res = $s_model->insertStatistics_t($group_list,$date);
        return json($res);
    }

    /**
     * 按日期移动当天平台统计数据
     */
    public function get_t_datad() {
        $date = input('date');
        $info = Db::name('statistics_pt')->where('tdate',$date)->find();
        if(!empty($info)){
            return json(['code'=>-1,'message'=>$date."日期已存在，无需重复生成"]);
        }
        $parm['xzdata'] = get_xzdatad($date);
        $parm['hydata'] = get_hydatad($date);
        $parm['djdata'] = get_djdatad($date);
        $parm['zjs'] = get_zjsd($date);
        $parm['xjs'] = get_xjsd($date);
        $parm['card_xh'] = get_card_xhd($date);
        $parm['card_sy'] = get_card_syd();
        $parm['tdate']   = $date;
        $s_model = new StatisticsPt();
        $res = $s_model->insertStatistics($parm);
        return json($res);
    }

    /**
     * 按日期移动当天亲友圈统计数据
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
     * 转移统计数据
    */
    public function move_qyq_data() {
            $data = get_move_qyq_data();
            $res = Db::table('log_group_commission')->insertAll($data);
            if(!empty($res)){
                apilog('移动亲友圈数据成功',1);
                return json(['code'=>1,'msg'=>'记录成功']);
            }
        }

}
