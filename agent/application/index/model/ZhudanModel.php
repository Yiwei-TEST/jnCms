<?php

namespace app\home\model;
use think\Model;
use think\Db;

class ZhudanModel extends Model
{
    protected $name = 'zhudan';

    public function insert($param) {
        try{
            $param['add_time'] = time();
            $param['id_user']      = session('uid');
            $param['ip']          =   request()->ip();
            $money = getMoney();
            $newmoney = intval($money)-intval($param['money']);
            if($newmoney<0) {
                return ['code' => -1, 'data' => $newmoney, 'msg' =>"余额不足请充值"];
            }
            $result = $this->validate('ZhudanValidate')->allowField(true)->save($param);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                Db::name("member")->where("id",$param['id_user'])->update(['money'=>$newmoney]);
                $data = [
                    'before_money'=>$money,
                    'after_money'=>$newmoney,
                    'add_time'=>time(),
                    'type' =>3,
                    'uid' =>$param['id_user'],
                    'money'=>$param['money']
                ];
                Db::name('money_log')->insert($data);
                writelog(session('uid'),session('username'),'用户【'.session('username').'】下注成功',1);
                return ['code' => 1, 'data' => '', 'msg' => '下注成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
}
