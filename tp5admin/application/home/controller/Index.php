<?php
namespace app\home\controller;
use app\home\model\IndexModel;
use app\home\model\MemberModel;
use app\home\model\MoneyLogModel;
use app\home\model\ZhudanModel;
use think\Db;
use think\Cache;
class Index extends Base
{
    public function index(){
        $ginfo = getginfo();
        $this->assign('ginfo',$ginfo);
        return $this->fetch();
    }
    public function register() {
        return $this->fetch('index/register');
    }
    /**注册*/
    public function registerpost() {
        $param = input('post.');
        $group = new MemberModel();
        $flag = $group->insert($param);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    public function game_results() {
        $map = " 1";
        $map .= " and result_half is not null";
        $start_time = input('start_time');
        $end_time = input('end_time');
        if(!empty($start_time) && !empty($end_time)){
            $stime = $start_time." 00:00:00";
            $etime = $end_time." 23:59:59";
        }else{
            $stime = date("Y-m-d",strtotime("-1 day"))." 00:00:00";
            $etime = date('Y-m-d')." 23:59:59";
        }
        $map .= " and start_time > '$stime' and start_time<'$etime'";
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 15;// 获取总条数
        $count = Db::name('saishi')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = Db::name('saishi')->where($map)->page($Nowpage, $limits)->order('start_time asc')->select();

        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('start_time', $start_time); //当前页
        $this->assign('end_time', $end_time); //
        if(input('get.page'))
        {
            return json($lists);
        }
        return $this->fetch();

    }

    /**交易明细*/
    public function mingxi() {
        $uid = session('uid');
        $map = " 1";
        $start_time = input('start_time');
        $end_time = input('end_time');
        if(!empty($start_time) && !empty($end_time)){
            $stime = strtotime($start_time." 00:00:00");
            $etime = strtotime($end_time." 23:59:59");
        }else{
            $stime = strtotime(date('Y-m-d')." 00:00:00");
            $etime = strtotime(date('Y-m-d')." 23:59:59");
        }
        $map .= " and id_user = {$uid}";
        $map .= " and add_time > {$stime} and add_time<{$etime}";
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 15;// 获取总条数
        $count = Db::name('zhudan')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = Db::name('zhudan')->where($map)->page($Nowpage, $limits)->order('id desc')->select();
        foreach ($lists as $key=>$v) {
            $lists[$key]['add_time'] = date('Y-m-d H:i:s',$lists[$key]['add_time']);
            $lists[$key]['type']     = saishi_type($lists[$key]['type']);
            $lists[$key]['xiazhu']   = xiazhu_info($lists[$key]['xiazhu']);
            $lists[$key]['saishi']   = get_saishi($lists[$key]['id_saishi']);
            $lists[$key]['shiinfo']   = get_sinfo($lists[$key]['id_saishi']);
            $lists[$key]['opentime'] = open_saishitime($lists[$key]['id_saishi']);
            if($lists[$key]['isjiesuan']==1){
                $lists[$key]['isjiesuan'] = "<font color='green'>已结算</font>";
            }else{
                $lists[$key]['isjiesuan'] = "<font color='red'>未结算</font>";
            }
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('start_time', $start_time); //当前页
        $this->assign('end_time', $end_time); //
        if(input('get.page'))
        {
            return json($lists);
        }
        return $this->fetch();
    }

    public function tk_account() {
        return $this->fetch();
    }

    public function retrieve_password() {
        return $this->fetch();
    }

    public function finance() {
        $mid = session('uid');
        $map = " 1";
        $start_time = input('start_time');
        $end_time = input('end_time');
        if(!empty($start_time) && !empty($end_time)){
            $stime = strtotime($start_time." 00:00:00");
            $etime = strtotime($end_time." 23:59:59");
        }else{
            $stime = strtotime(date('Y-m-d')." 00:00:00");
            $etime = strtotime(date('Y-m-d')." 23:59:59");
        }
        $map .= " and uid = {$mid}";
        $map .= " and add_time > {$stime} and add_time<{$etime}";
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 15;// 获取总条数
        $count = Db::name('money_log')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = Db::name('money_log')->where($map)->page($Nowpage, $limits)->order('id desc')->select();
        foreach ($lists as $key=>$v) {
            $lists[$key]['add_time'] = date('Y-m-d H:i:s',$lists[$key]['add_time']);
            $lists[$key]['type']     = money_type($lists[$key]['type']);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('start_time', $start_time); //当前页
        $this->assign('end_time', $end_time); //
        if(input('get.page'))
        {
            return json($lists);
        }
        return $this->fetch();
    }

    public function announcement() {
        $list = Db::name('ann')->where('is_delete',0)->order('sort asc')->limit(20)->select();
        foreach ($list as $k=>$v) {
            $list[$k]['addtime'] = date('Y-m-d H:i:s',$list[$k]['addtime']);
        }
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**市场列表*/
    public function datalist() {
        $date = date('Y-m-d H:i:s');
        $where = " 1";
        $datetype = $this->request->param('type',1,'int');
        switch ($datetype){
            case 1:
                $star_time = get_today_start();  //今天开始时间
                $end_time  = get_today_end(); //今天结束时间
                break;
            case 2:
                $star_time = get_tomorrow_start();  //明天开始时间
                $end_time  = get_tomorrow_end();  //明天结束时间
                break;
            case 3:
                $star_time = get_today_start();   //今天开始时间
                $end_time  = get_tomorrow_end();  //明天结束时间
                break;
        }
        $where .= " and start_time >= '$star_time' and start_time<= '$end_time'";
        $where .= " and start_time > '$date'";
        $list = Db::name("saishi")->where($where)->field("id,start_time,team_home,team_guest,title")->select();
        if(isset($list)) {
            $data = ['code'=>1,'data'=>$list,'msg'=>"获取成功"];
            return $this->jsonData($data);
        }else{
            $data = ['code'=>0,'data'=>[],'msg'=>"获取失败"];
            return $this->jsonData($data);
        }
    }

    /***获取详情*/
    public  function get_details() {
        $id   = $this->request->param('id',1,'int');
        if(!empty($id)) {
            $odd = $this->getOdd($id);
            $info = Db::name("saishi")->where('id',$id)->field("id,start_time,team_home,team_guest,title")->find();
            $bosum  =  Db::name('zhudan')->where('type',1)->where('id_saishi',$id)->sum('money');                                   //波胆成交量
            $bbosum =  Db::name('zhudan')->where('type',0)->where('id_saishi',$id)->sum('money');//半场波胆成交量
            $info['bbosum'] = $bbosum;
            $info['bosum'] = $bosum;
            $info['money'] = intval(getMoney());
            $res = [];
            $res1 = [];
            $res2  = [];
            $ysum = $this->getYsum($id,$odd);
            $bysum = $this->getbYsum($id,$odd);
            foreach ($ysum as  $k =>$v){
                $res1[$k-1]['ysum'] = $v['ysum'];
                $res1[$k-1]['odd'] = $v['odd'];
            }
            foreach ($bysum as  $k =>$v){
                $res2[$k-19]['ysum'] = $v['ysum'];
                $res2[$k-19]['odd'] = $v['odd'];
            }
            $res = ["ysum"=>$res1,"bysum"=>$res2];

            $data = ['code'=>1,'data'=>$res,'info'=>$info,'msg'=>"获取成功"];
            return $this->jsonData($data);
        }
    }

    /**下单*/
    public function xiazhu() {
        $param  = input('post.');
        $zhudan = new ZhudanModel();
        $id  = $param['id_saishi'];
        $time = date('Y-m-d H:i:s');
        $jiesutime = Db::name("saishi")->where('id',$id)->value("start_time");
        if($time>$jiesutime) {
            return json(['code' => -1,'msg' =>"比赛已经开始不能下注"]);
        }
        $flag   = $zhudan->insert($param);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    public function jsonData($data){
        header("Content-type:application/json");
        exit(json_encode($data));
    }

    public function getOdd($id) {
        return  Db::name('odd')->where('sid',$id)->find();
    }

    public function getMoney() {
        $account =  getAccount();
        $money   = intval(getMoney());
        return  $this->jsonData(["code"=>1,'money'=>$money,'account'=> $account]);
    }

    public function getYsum($id,$odd) {
        $a = [];
        $i = 0;
        while ($i<18){
            $i++;
            $a[$i]['ysum'] =1000000 - Db::name('zhudan')->where('id_saishi',$id)->where('xiazhu',$i)->sum('money');
            $k = "f".($i);
            $a[$i]['odd'] = $odd[$k];
        }

        if(is_array($a)){
            return $a;
        }else{
            return 0;
        }
    }

    public function getbYsum($id,$odd) {
        $a = [];
        $i =18;
        while ($i<28){
            $i++;
            $a[$i]['ysum'] =1000000 - Db::name('zhudan')->where('id_saishi',$id)->where('xiazhu',$i)->sum('money');
            $k = "f".($i);
            $a[$i]['odd'] = $odd[$k];
        }
        if(is_array($a)){
            return $a;
        }else{
            return 0;
        }
    }

    public function save_password() {
        $mid = session('uid');
        $param = input('post.');
        if($param['newpassword']!==$param['newpassword1']) {
            $this->error("两次输入的密码不一样");
        }
        $muser = MemberModel::get(['id'=>$mid]);
        $pass = $muser->password;
        if(md5(md5($param['password']) . config('auth_key')) !=$pass){
            $this->error("旧密码输入错误");
        }else{
            $muser->password = md5(md5($param['newpassword']) . config('auth_key'));
            $res = $muser->save();
            if($res){
                $this->success("修改成功",'index/index');
            }
        }
    }
}


