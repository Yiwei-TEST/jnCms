<?php

namespace app\home\model;
use think\Model;
use think\Db;

class MoneyLogModel extends Model
{
    protected $name = 'money_log';

    /**
     * 用户该下注的输赢金额
     * $uid 用户id
     * $zid  注单id
     * $qid 赛事id
     * $type 下注类型 0 半场  1全场
     * $xiazhu  下注位置
     */
     public function IsWin($zid) {
           $info = Db::name('zhudan')->where('id',$zid)->where('isjiesuan',0)->find();
           if(empty($info)){
            return json(['code'=>-1,'msg'=>"获取参数错误"]);
            }
           $money = $info['money'];
           $type = $info['type'];
           $qid = $info['id_saishi'];
           $uid = $info['id_user'];
           $xiazhu = $info['xiazhu'];
           $odd = Db::name('zhudan')->where('id',$zid)->value('huoli');
           $result = $this->get_result($qid,$type);  //比分
           if(empty($result)){
               return json(['code'=>-1,'msg'=>"未获取到比赛比分"]);
           }
           $info =$this->get_win($result,$xiazhu);
           var_dump($money);
           exit;
           $jmoney = 0;
           if($info ===1) { //赢
             $jmoney = number_format( ($money*$odd*0.95),2);
           }
           $fuwu = $money - $jmoney;
        $data = ['isjiesuan'=>1,
            'jiesuan_time'=>time(),
            'realgetmoney'=>$jmoney,
            'fuwufei' =>$fuwu,
        ];
           Db::startTrans();
           $info = Db::name('zhudan')->where('id',$zid)->update($data);
           $info1 = $this->MoneyLog($uid,$type,$jmoney,$info,$money);
           if($info1) {
               Db::commit();
               return 1;
           }
           Db::rollback();
    }

    public function get_result($qihao,$type) {
        if($type===0){
            return Db::name("saishi")->where('id',$qihao)->value('result_half');   //半场比分
        }else{
            return Db::name("saishi")->where('id',$qihao)->value('result_full');   //全场比分
        }
    }

     public function get_win($result,$xiazhu) {
       $bifen = explode('-',$result);
       $zbifen = $bifen[0];
       $fbifen = $bifen[1];
       if($xiazhu===17) {
           if($fbifen>$zbifen && $fbifen>=4) {
               return 0;
           }else{
               return 1;
           }
       }else if($xiazhu ===18) {
           if($zbifen>$fbifen && $zbifen>=4) {
               return 0;
           }else{
               return 1;
           }
       }else if($xiazhu ===28) {
           $array = ["0-0","0-1","0-2","1-0","1-1","1-2","2-0","2-1","2-2"];
            if(in_array($result, $array)){
                return 1;
            }else{
                return 0;
            }
       }else{
           $array1 = [
                     "0-0","0-1","0-2","0-3","1-0","1-1","1-2","1-3","2-0",
                     "2-1","2-2","2-3","3-0","3-1","3-2","3-3","1-1","0-0",
                     "0-0","0-1","0-2","1-0","1-1","1-2","2-0","2-1","2-2",
                  ];
           if($result=== $array1[$xiazhu]){
               return 0;
           }else{
               return 1;
           }
       }
    }

     public function MoneyLog($uid,$type,$jmoney,$money){
            $userMoney = getMoney();
            $after_money =  intval($userMoney) + intval($money) + intval($jmoney);
            $data = [
               'before_money'=>$userMoney,
                'after_money'=>$after_money,
                'add_time'=>time(),
                'type' =>$type,
                'uid' =>$uid,
                'money'=>$jmoney
            ];
           $res = self::insert($data);
           if($res) {
               $datas = ['money'=>$after_money];
               $info = Db::name('member')->where('id',$uid)->update($datas);
               if($info) {
                    return 1;
               }
           }
    }
}
