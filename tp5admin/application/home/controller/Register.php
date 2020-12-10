<?php
namespace app\home\controller;
use app\home\model\IndexModel;
use app\home\model\MemberModel;
use app\home\model\MoneyLogModel;
use think\Controller;
use think\Db;
use think\Cache;
class Register extends Controller
{
    public function index(){
        return $this->fetch('index/register');
    }
    /**注册*/
    public function registerpost() {
        $param = input('post.');
        $group = new MemberModel();
        $flag = $group->insert($param);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    public function jiesuan(){
        $zid = Db::name("zhudan")->where('isjiesuan',0)->field('id')->select();
        if(empty($zid)){
            echo "没有可以结算数据";
            exit;
        }
       // $i = 0;
        //while ($i<=10) {
         //   $i++;
        $model = new MoneyLogModel();
            $info = $model->IsWin(1);
        //}
        //foreach ($zid as $k=>$v) {
           // $info = MoneyLogModel::IsWin($zid[$k]['id']);
       // }
        var_dump($info);
    }
}


