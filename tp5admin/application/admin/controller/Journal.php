<?php

namespace app\admin\controller;
use think\Config;
use think\Loader;
use think\Db;
use app\admin\model\CardsInfoModel;
use app\admin\model\UserInfModel;
use app\admin\model\CardsKcinfoModel;
use org\Crypt;
class Journal extends Base
{
    /**
     *房钻管理
     */
    public function list_info() {
        return $this->fetch();
    }

    /**
     *赠钻记录
     */
    public function journal_log() {
        $key = input('key');
        $map = " 1";
        $start_time = input('start_time');
        $end_time = input('end_time');
        if($key&&$key!=="")
        {
            $key = intval($key);
            $map .= " and userId = $key";
        }
        if(!empty($start_time) && !empty($end_time) ){
            $start_time = $start_time;
            $end_time = $end_time;
        }else{
            $start_time = date('Y-m-d')." 00:00:00";
            $end_time = date('Y-m-d')." 23:59:59";
        }
        $map .= " and add_time >= '$start_time' and add_time <= '$end_time'";
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = Db::name('cards_info')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $cards = new CardsInfoModel();
        $lists =  $cards->getUsersByWhere($map, $Nowpage, $limits);
        foreach ($lists as $k=>$v) {
            if($v['type']==1) {
                $lists[$k]['typename'] = "赠送";
            }else{
                $lists[$k]['typename'] = "补偿";
            }
            $lists[$k]['nickname'] = getuid_byname($v['admin_id']);
        }
        $this->assign('start_time', $start_time);
        $this->assign('end_time', $end_time);
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val',$key );
        if(input('get.page'))
        {
            return json($lists);
        }
        return $this->fetch();
    }

    /**
     *扣除记录
     */
    public function kclist_info() {
        $key = input('key');
        $map = " 1";
        $start_time = input('start_time');
        $end_time = input('end_time');
        if($key&&$key!=="")
        {
            $key = intval($key);
            $map .= " and userId = $key";
        }
        if(!empty($start_time) && !empty($end_time) ){
            $start_time = $start_time;
            $end_time = $end_time;
        }else{
            $start_time = date('Y-m-d')." 00:00:00";
            $end_time = date('Y-m-d')." 23:59:59";
        }
        $map .= " and add_time >= '$start_time' and add_time <= '$end_time'";
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = Db::name('cards_kcinfo')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $cards = new CardsKcinfoModel();
        $lists =  $cards->getUsersByWhere($map, $Nowpage, $limits);
        foreach ($lists as $k=>$v) {
            $lists[$k]['nickname'] = getuid_byname($v['admin_id']);
        }
        $this->assign('start_time', $start_time);
        $this->assign('end_time', $end_time);
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val',$key );
        if(input('get.page'))
        {
            return json($lists);
        }
        return $this->fetch();
    }

    public function add_cards() {
        if(input('post.')){
            $mid = session('mid');
            $parm = input('post.');
            $inser_parm['type'] = $parm['type'];
            $inser_parm['freeCards'] = $parm['freeCards'];
            $inser_parm['cards']     = $parm['cards'];
            $inser_parm['add_time']  = date('Y-m-d H:i:s');
            $inser_parm['admin_id']  = $mid;
            $inser_parm['userId']    = $parm['userId'];
            $sum_card = intval($parm['freeCards'])+intval($parm['cards']);
            $status =  Db::name('cards_stock')->where('id',1)->value('status');
            if($status!=1){
                return json(['code'=>3,"message"=>"充值已经暂停,请联系管理员"]);
            }
            $t_card   = Db::name('cards_stock')->where('id',1)->value('stock');
            if(intval($t_card)<$sum_card) {
              return json(['code'=>3,"message"=>"平台钻石不足,请联系管理员"]);
            }
            unset($parm['type']);
            $parm['time'] = time();
            $parm['changeType'] = 20001;
            $apiurl = Config::get('api_url').Config::get('api_prefix')."changeUserCurrency.do";
            $parm['sign'] = checkSign($parm);
            $info = curl_post($apiurl,$parm);
            $res_info = decrypt_info($info);
            if($res_info['code']===0){
                $inser_parm['status']   = 1;
                Db::startTrans();
                $res2 = Db::name('cards_stock')->where('id',1)->setDec('stock',$sum_card);
                $inser_parm['p_cards'] = $t_card - $sum_card;
                $res = Db::name('cards_info')->insert($inser_parm);
                $res_infos = json_encode($res_info);
                apilog($mid."添加用户钻石成功".$res_infos);
                if(!empty($res) && !empty($res2)){
                    Db::commit();
                    return json($res_info);
                }else{
                    Db::rollback();
                }
            }else{
                return json($res_info);
            }
        }
    }

    public function get_pt_journal() {
        $t_card   = Db::name('cards_stock')->where('id',1)->value('stock');
        return json(['code'=>1,'sums'=>$t_card]);
    }

    /**
     扣除钻石
    */
    public function kc_cards () {
        if(input('post.')){
            $mid = session('mid');
            $t_card   = Db::name('cards_stock')->where('id',1)->value('stock');
            $parm = input('post.');
            $cardss = intval($parm['cards']);
            $parm['cards'] = 0-$cardss;
            $inser_parm['freeCards'] = $parm['freeCards'];
            $inser_parm['cards']     = $parm['cards'];
            $inser_parm['add_time']  = date('Y-m-d H:i:s');
            $inser_parm['admin_id']  = $mid;
            $inser_parm['userId']    = $parm['userId'];
            $parm['time'] = time();
            $parm['changeType'] = 20002;
            $apiurl = Config::get('api_url').Config::get('api_prefix')."changeUserCurrency.do";
            $parm['sign'] = checkSign($parm);
            $info = curl_post($apiurl,$parm);
            $res_info = decrypt_info($info);
            if($res_info['code']===0){
                $inser_parm['status']   = 1;
                Db::startTrans();
                $res2 = Db::name('cards_stock')->where('id',1)->setInc('stock',$cardss);
                $inser_parm['p_cards'] = $t_card + $cardss;
                $res = Db::name('cards_kcinfo')->insert($inser_parm);
                $res_infos = json_encode($res_info);
                apilog($mid."扣除钻石成功".$res_infos);
                if(!empty($res) && !empty($res2)){
                    Db::commit();
                    return json($res_info);
                }else{
                    Db::rollback();
                }
            }else{
                return json($res_info);
            }
        }
    }

    /**
    清除钻石
     */
    public function qc_cards () {
        if(input('post.')){
            $mid = session('mid');
            $t_card   = Db::name('cards_stock')->where('id',1)->value('stock');
            $parm = input('post.');
            $cardss = intval($parm['freeCards']);
            $parm['freeCards'] = 0 - $cardss;
            $inser_parm['freeCards'] = $parm['freeCards'];
            $inser_parm['cards']     = $parm['cards'];
            $inser_parm['add_time']  = date('Y-m-d H:i:s');
            $inser_parm['admin_id']  = $mid;
            $inser_parm['userId']    = $parm['userId'];
            $user_m = new UserInfModel();
            $cards = $user_m->getuid_byinfo($parm['userId']);
            if($cards[0]['freeCards']<=0){
                return json(['code'=>5,'message'=>'免费钻石为0,不需要重复清除']);
            }
            $parm['time'] = time();
            $parm['changeType'] = 20002;
            $apiurl = Config::get('api_url').Config::get('api_prefix')."changeUserCurrency.do";
            $parm['sign'] = checkSign($parm);
            $info = curl_post($apiurl,$parm);
            $res_info = decrypt_info($info);
            if($res_info['code']===0){
                $inser_parm['status']   = 1;
                Db::startTrans();
                $res2 = Db::name('cards_stock')->where('id',1)->setInc('stock',$cardss);
                $inser_parm['p_cards'] = $t_card + $cardss;
                $res = Db::name('cards_kcinfo')->insert($inser_parm);
                $res_infos = json_encode($res_info);
                apilog($mid."清除钻石成功".$res_infos);
                if(!empty($res) && !empty($res2)){
                    Db::commit();
                    return json($res_info);
                }else{
                    Db::rollback();
                }
            }else{
                return json($res_info);
            }
        }
    }

}
