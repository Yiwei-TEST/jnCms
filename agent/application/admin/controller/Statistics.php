<?php

namespace app\admin\controller;
use think\Db;
use think\Session;
use think\Config;

class Statistics extends Base
{

    /**
     *@在线人数统计
    */
    public function onlin_curve() {
        $s_time = date('Y-m-d',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))))." 00:00:00";
        $e_time    = date('Y-m-d',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))))." 23:59:59";
        $this->assign('start_time', $s_time); //当前页
        $this->assign('end_time', $e_time); //总页数
        return $this->fetch();
    }
    public function onlin_curves(){
        if(input('post.'))
        {
            $parm = input('post.');
            $start_time = $parm['start_time'];
            $end_time   = $parm['end_time'];
            if(!empty($start_time) && !empty($end_time)){
                $where = " 1 and addtime >= '$start_time' and addtime<='$end_time'";
            }else{
                $where = " 1";
            }
            $date_f = Db::name('onlin')->where($where)->where('type',0)->column('addtime');
            $cont_f = Db::name('onlin')->where($where)->where('type',0)->column('number');
            $cont_f1 = Db::name('onlin')->where($where)->where('type',"1服")->column('number');
            $cont_f2 = Db::name('onlin')->where($where)->where('type',"2服")->column('number');
            $cont_f3 = Db::name('onlin')->where($where)->where('type',"3服")->column('number');
            $cont_f4 = Db::name('onlin')->where($where)->where('type',"4服")->column('number');
            $cont_f5 = Db::name('onlin')->where($where)->where('type',"5服")->column('number');
            $cont_f6 = Db::name('onlin')->where($where)->where('type',"6服")->column('number');
            return json(["code"=>1,"tdate"=>$date_f,"cont_f"=>$cont_f,"cont_f1"=>$cont_f1,"cont_f2"=>$cont_f2,"cont_f3"=>$cont_f3,"cont_f4"=>$cont_f4,"cont_f5"=>$cont_f5,"cont_f6"=>$cont_f6]);
        }
    }
    /**
     *@每日数据
     */
    public function daily_stat() {
        $s_time = date('Y-m-d',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))))." 00:00:00";
        $e_time    = date('Y-m-d',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))))." 23:59:59";
        if(input('post.'))
        {
            $parm = input('post.');
            $start_time = $parm['start_time'];
            $end_time   = $parm['end_time'];
            if(!empty($start_time) && !empty($end_time)){
                $where = " 1 and tdate >= '$start_time' and tdate<='$end_time'";
            }else{
                $where  = " 1";
            }
            $cont_list = Db::name('statistics_pt')->where($where)->select();
            return json(['data'=>$cont_list,'code'=>1]);
        }
        $this->assign('start_time', $s_time); //当前页
        $this->assign('end_time', $e_time); //总页数
        return $this->fetch();
    }

    public function get_tdata() {
        $date = date('Y-m-d');
        $end_date = date('Y-m-d',strtotime('-7 day'));
        $wheres = " 1 and tdate>='$end_date'";
        $tdate = Db::name('statistics_pt')->where($wheres)->column('tdate');
        $zcdata = Db::name('statistics_pt')->where($wheres)->column('xzdata');
        $hydata = Db::name('statistics_pt')->where($wheres)->column('hydata');
        $djdata = Db::name('statistics_pt')->where($wheres)->column('djdata');
        $zjs = Db::name('statistics_pt')->where($wheres)->column('zjs');
        $xjs = Db::name('statistics_pt')->where($wheres)->column('xjs');
        $card_xh = Db::name('statistics_pt')->where($wheres)->column('card_xh');
        $card_sy = Db::name('statistics_pt')->where($wheres)->column('card_sy');
        return json(["code"=>1,"tdate"=>$tdate,"xzdata"=>$zcdata,"hydata"=>$hydata,"djdata"=>$djdata,"zjs"=>$zjs,"xjs"=>$xjs,"card_xh"=>$card_xh,"card_sy"=>$card_sy]);
    }

    /**
     *@亲友圈数据
     */
    public function daily_stat_qyq() {
        $s_time = date('Y-m-d',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))))." 00:00:00";
        $e_time    = date('Y-m-d',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))))." 23:59:59";
        if(input('post.'))
        {
            $parm = input('post.');
            $start_time = $parm['start_time'];
            $end_time   = $parm['end_time'];
            $uid        = $parm['uid'];
            if(empty($uid)){
                return json(['data'=>[],'code'=>0,'msg'=>"请输入亲友圈id"]);
            }
            if(empty($start_time) || empty($end_time)){
                $start_times = date('Y-m-d',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))))." 00:00:00";
                $end_times    = date('Y-m-d',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))))." 23:59:59";
            }
            if (!empty($start_time) && !empty($end_time)){
                $start_times = $start_time;
                $end_times    =$end_time;
            }
            $where = " 1 and tdate >= '$start_times' and tdate<='$end_times' and groupId = '$uid'";
            $cont_list = Db::name('statistics_qyq')->where($where)->order('tdate desc')->select();
            $tdate = Db::name('statistics_qyq')->where($where)->column('tdate');
            $zcdata = Db::name('statistics_qyq')->where($where)->column('xzdata');
            $djdata = Db::name('statistics_qyq')->where($where)->column('djdata');
            $zjs = Db::name('statistics_qyq')->where($where)->column('zjs');
            $xjs = Db::name('statistics_qyq')->where($where)->column('xjs');
            $card_xh = Db::name('statistics_qyq')->where($where)->column('card_xh');
            $card_sy = Db::name('statistics_qyq')->where($where)->column('card_sy');
            if(!empty($cont_list)){
                return json(['data'=>$cont_list,"tdate"=>$tdate,"xzdata"=>$zcdata,"djdata"=>$djdata,"zjs"=>$zjs,"xjs"=>$xjs,"card_xh"=>$card_xh,"card_sy"=>$card_sy,'code'=>1]);
            }else{
                return json(['data'=>[],'code'=>0,'msg'=>"暂无数据"]);
            }
        }
        $this->assign('start_time', $s_time); //当前页
        $this->assign('end_time', $e_time); //总页数
        return $this->fetch();
    }

    public function get_tdata_qyq() {
        $uid = input('uid');
        if($uid && $uid >0){
            $date = date('Y-m-d');
            $end_date = date('Y-m-d',strtotime('-7 day'));
            $wheres = " 1 and tdate>='$end_date'";
            $tdate = Db::name('statistics_qyq')->where($wheres)->column('tdate');
            $zcdata = Db::name('statistics_qyq')->where($wheres)->column('xzdata');
            $hydata = Db::name('statistics_qyq')->where($wheres)->column('hydata');
            $djdata = Db::name('statistics_qyq')->where($wheres)->column('djdata');
            $zjs = Db::name('statistics_qyq')->where($wheres)->column('zjs');
            $xjs = Db::name('statistics_qyq')->where($wheres)->column('xjs');
            $card_xh = Db::name('statistics_qyq')->where($wheres)->column('card_xh');
            $card_sy = Db::name('statistics_qyq')->where($wheres)->column('card_sy');
            return json(["code"=>1,"tdate"=>$tdate,"xzdata"=>$zcdata,"hydata"=>$hydata,"djdata"=>$djdata,"zjs"=>$zjs,"xjs"=>$xjs,"card_xh"=>$card_xh,"card_sy"=>$card_sy]);
        }else{
            return json(["code"=>0,"msg"=>"暂无数据"]);
        }

    }

    private function get_last_day($year, $month)
    {
        return date('t', strtotime($year . '-' . $month . ' -1'));
    }
/**
 *
*/
    public function p_data_dc() {
            $parm = input('get.');
            $start_time = $parm['start_time'];
            $end_time   = $parm['end_time'];
            $where = " 1";
            if(empty($start_time) || empty($end_time)){
                return json(["code"=>0,"msg"=>"请选择需要导出的日期"]);
            }
            $where .=" and tdate >='$start_time' and tdate< '$end_time'";
            $title = "平台数据导出";
            $headers = ['日期','注册人数','活跃人数','玩牌人数','大局数','小局数','钻石消耗','钻石剩余'];
            $datas = Db::name('statistics_pt')->where($where)->select();
            $filename=date('Y-m-d')."平台数据导出";
            dc_execl($title,$headers,$datas,$filename);
            exit();
    }

}
