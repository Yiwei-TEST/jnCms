<?php

namespace app\admin\controller;
use think\Config;
use think\Loader;
use app\admin\model\UserInfModel;
use think\Db;

class Qyq extends Base
{
    /**
     *添加亲友圈
    */
    public function add_qyq() {
        return $this->fetch();
    }

    public function get_user() {
        $uid = input('post.uid');
        $u_mode = new UserInfModel();
        if($uid &&$uid>0){
            $userinfo = $u_mode->getuid_byinfo($uid);
            $apiurl = Config::get('api_url').Config::get('api_prefix');
            return json(['code'=>1,'data'=>$userinfo[0],'apiurl'=>$apiurl]);
        }else{
            return json([]);
        }
    }

    /**
     *亲友圈资料
     */
    public function qyq_detail() {

        return $this->fetch();
    }

    /**
     *根据亲友圈id获取资料
     */
    public function getid_by_detail() {
        $gid = input('post.groupId');
        $u_mode = new UserInfModel();
        if($gid &&$gid>0){
            $userinfo = $u_mode->getgId_byinfo($gid);
            $apiurl = Config::get('api_url').Config::get('api_prefix');
            return json(['code'=>1,'data'=>$userinfo[0],'apiurl'=>$apiurl]);
        }else{
            return json([]);
        }
    }
}
