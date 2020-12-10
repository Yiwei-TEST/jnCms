<?php

namespace app\home\model;
use think\Model;
use think\Db;

class MemberModel extends Model
{
    protected $name = 'member';
    public function insert($param) {
        try{
            if($param['data']['password']!==$param['data']['password1']) {
                return ['code' => 0, 'data' => '', 'msg' => '两次输入的密码不一样'];
            }
            unset($param['data']['password1']);
            $param['data']['create_time'] = time();
            $param['data']['status']      = 1;
            $param['data']['group_id']    = 3;
            $param['data']['password']    = md5(md5($param['data']['password']) . config('auth_key'));
            $result = $this->validate('MemberValidate')->allowField(true)->save($param['data']);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                writelog(session('uid'),session('username'),'用户【'.$param['data']['nickname'].'】注册成功',1);
                return ['code' => 1, 'data' => '', 'msg' => '用户注册成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}
