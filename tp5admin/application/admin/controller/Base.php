<?php

namespace app\admin\controller;
use app\admin\model\Node;
use think\Controller;

class Base extends Controller
{
    public function _initialize()
    {

        if(!session('mid')||!session('username')){
            $this->redirect('login/index');
        }

        $auth = new \com\Auth();
        $module     = strtolower(request()->module());
        $controller = strtolower(request()->controller());
        $action     = strtolower(request()->action());
        $url        = $module."/".$controller."/".$action;

        //跳过检测以及主页权限
        if(session('mid')!=1){
            if(!in_array($url, ['admin/index/index',
                'admin/index/indexpage',
                'admin/member/index',
                'admin/upload/upload',
                'admin/index/uploadface',
                'admin/member/get_money',
                'admin/member/get_cc',
                'admin/member/recharge',
                'admin/member/add_member',
                'admin/member/reset_password',
                'admin/member/recharge_money',
                'admin/index/qr_code',
                'admin/statistics/onlin_curve',
                'admin/statistics/daily_stat',
                'admin/statistics/daily_stat_qyq',
                'admin/statistics/onlin_curves',
                'admin/statistics/get_tdata',
                'admin/statistics/daily_stat_qyq',
                'admin/statistics/get_tdata_qyq',
            ])){
                if(!$auth->check($url,session('mid'))){
                    $this->error('抱歉，您没有操作权限');
                }
            }
        }

        $node = new Node();
        $this->assign([
            'username' => session('username'),
            'portrait' => session('portrait'),
            'rolename' => session('rolename'),
            'menu' => $node->getMenu(session('rule'))
        ]);

        $config = cache('db_config_data');

        if(!$config){
            $config = load_config();
            cache('db_config_data',$config);
        }
        config($config);

        if(config('web_site_close') == 0 && session('mid') !=1 ){
            $this->error('站点已经关闭，请稍后访问~');
        }

        if(config('admin_allow_ip') && session('mid') !=1 ){
            if(in_array(request()->ip(),explode('#',config('admin_allow_ip')))){
                $this->error('403:禁止访问');
            }
        }

    }
}
