<?php

namespace app\index\model;
use think\Model;
use think\Db;

class MemberModel extends Model
{
    protected $name = 'member';
    public function insert($param) {
        try{
            if($param['password']!==$param['password1']) {
                return ['code' => 0, 'data' => '', 'msg' => '两次输入的密码不一样'];
            }
            unset($param['password1']);
            $param['create_time'] = time();
            $param['status']      = 1;
            $param['group_id']    = 4;
            $param['password']    = md5(md5($param['password']) . config('auth_key'));
            $result = $this->validate('MemberValidate')->allowField(true)->save($param);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                writelog(session('uid'),$param['nickname'],'用户【'.$param['nickname'].'】注册成功',1);
                return ['code' => 1, 'data' => '', 'msg' => '用户注册成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}
