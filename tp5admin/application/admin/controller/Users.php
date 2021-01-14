<?php

namespace app\admin\controller;
use app\admin\model\UserInfModel;
use app\admin\model\UserType;
use think\Db;

class Users extends Base
{

    /**
     * [index 用户列表]
     * @return [type] [description]
     * @author [田建龙] [864491238@qq.com]
     */
    public function index(){

        $key = input('key');
        $usermodel = new UserInfModel();
        if($key&&$key!=="")
        {
            $lists = $usermodel->getuid_byinfo($key);
        }else{
            $lists =  [];
        }
        $this->assign('val', $key);
        if(input('get.page'))
        {
            return json($lists);
        }
        return $this->fetch();
    }

    /**
     * [user_state 用户状态]
     * @return [type] [description]
     * @author [田建龙] [864491238@qq.com]
     */
    public function user_state()
    {
        $id = input('param.id');
        $usermodel = new UserInfModel();
        $lists = $usermodel->getuid_byinfo($id);
        $status = $lists[0]['userState'];//判断当前状态情况
        if($status==1)
        {
            $flag = $usermodel->setField($id,0);
            return json(['code' => 1, 'data' => $flag, 'msg' => '已禁止']);
        }
        else
        {
            $flag = $usermodel->setField($id,1);
            return json(['code' => 0, 'data' => $flag, 'msg' => '已开启']);
        }

    }
}
