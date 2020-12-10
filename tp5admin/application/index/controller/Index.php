<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Index extends Controller
{
    public function _initialize()
    {
        if (!session('uid') || !session('username')) {
            $this->redirect('login/login');
        }
    }

    public function index()
    {
                    //热门赛事
        $map = " 1";
        $map .= " and isjiesuan = 0";
        $limits = 15;// 获取总条数
        $lists = Db::name('zhudan')
                        ->where($map)
                        ->field('sum(money) as m , id_saishi')
                        ->group('id_saishi')
                        ->order("m desc")
                        ->limit(4)
                        ->select();
        foreach ($lists as $k =>$v){
            $lists[$k]['info'] = $this->get_info($lists[$k]['id_saishi']);
        }
        $this->assign('list',$lists);
        return $this->fetch();
    }

    private  function  get_info($id) {
        return Db::name('saishi')->where('id',$id)->find();
    }

	public function announce() {
        return $this->fetch();
	}
    public function companyinfo() {
        return $this->fetch();
    }
    public function deposits() {
        return $this->fetch();
    }
    public function gameresult() {
        return $this->fetch();
    }
    public function help() {
        return $this->fetch();
    }
    public function help_alipay() {
        return $this->fetch();
    }
    public function help_bank() {
        return $this->fetch();
    }
    public function help_checkout() {
        return $this->fetch();
    }
    public function help_order() {
        return $this->fetch();
    }

    public function help_process() {
    return $this->fetch();
    }
    public function help_QQchat() {
        return $this->fetch();
    }
    public function help_transfer() {
        return $this->fetch();
    }
    public function help_wechat() {
        return $this->fetch();
    }
    public function history() {
        $uid  = session('uid');
        $map['uid'] = $uid;
        $time1 = strtotime(get_w_start());
        $etime1= strtotime(get_w_end());
        $time2 = strtotime(get_w_start2());
        $etime2= strtotime(get_w_end2());
        $time3 = strtotime(thismonth_start_time());
        $etime3= strtotime(thismonth_end_time());
        $time4 = strtotime(lastmonth_start_time());
        $etime4= strtotime(lastmonth_end_time());
        $where = " 1 and add_time >= $time1 and add_time<= $etime1";  //本周
        $where1 = " 1 and add_time >= $time2 and add_time<= $etime2"; //上周
        $where2 = " 1 and add_time >= $time3 and add_time<= $etime3"; //本月
        $where3 = " 1 and add_time >= $time4 and add_time<= $etime4"; //上月
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 15;// 获取总条数
        $count = Db::name('money_log')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $list = Db::name('money_log')
            ->field("type,sum(money) as money,sum(if(type=0 ,money,0)) as money1,FROM_UNIXTIME(add_time,'%d') as add_time1")
            ->where($map)
            ->where($where)
            ->page($Nowpage, $limits)
            ->group('add_time1 desc')
            ->order('id desc')
            ->select();
        $list2 = Db::name('money_log')
            ->field("type,sum(money) as money,sum(if(type=0 ,money,0)) as money1,FROM_UNIXTIME(add_time,'%d') as add_time1")
            ->where($map)
            ->where($where1)
            ->page($Nowpage, $limits)
            ->group('add_time1 desc')
            ->order('id desc')
            ->select();
        $list3 = Db::name('money_log')
            ->field("type,sum(money) as money,sum(if(type=0 ,money,0)) as money1,FROM_UNIXTIME(add_time,'%d') as add_time1")
            ->where($map)
            ->where($where2)
            ->page($Nowpage, $limits)
            ->group('add_time1 desc')
            ->order('id desc')
            ->select();
        $list4 = Db::name('money_log')
            ->field("type,sum(money) as money,sum(if(type=0 ,money,0)) as money1,FROM_UNIXTIME(add_time,'%d') as add_time1")
            ->where($map)
            ->where($where3)
            ->page($Nowpage, $limits)
            ->group('add_time1 desc')
            ->order('id desc')
            ->select();
        foreach ($list as $k =>$v){
           // $list[$k]['add_time'] = date("m/d",$list[$k]['add_time']);
        }
        foreach ($list2 as $k =>$v){
           // $list2[$k]['add_time'] = date("m/d",$list2[$k]['add_time']);
        }
        foreach ($list3 as $k =>$v){
           // $list3[$k]['add_time'] = date("m/d",$list3[$k]['add_time']);
        }
        foreach ($list4 as $k =>$v){
           // $list4[$k]['add_time'] = date("m/d",$list4[$k]['add_time']);
        }

        $this->assign('list',$list);
        $this->assign('list2',$list2);
        $this->assign('list3',$list3);
        $this->assign('list4',$list4);
        return $this->fetch();
    }
    public function market() {
        $date = date('Y-m-d H:i:s');
        $where = " 1";
        $where1 = " 1";
        $where2 = " 1";
        $where3 = " 1";
        $star_time = get_today_start();  //今天开始时间
        $end_time  = get_today_end(); //今天结束时间
        $star_time1 = get_tomorrow_start();
        $end_time1  = get_tomorrow_end();
        $star_time2 = get_today_start();
        $end_time2  = get_tomorrow_end();
        $where1 .= " and start_time >= '$star_time' and start_time<= '$end_time'";
        $where2 .= " and start_time >= '$star_time1' and start_time<= '$end_time1'";
        $where3 .= " and start_time >= '$star_time2' and start_time<= '$end_time2'";
        $where .= " and start_time > '$date'";
        $list = Db::name("saishi")->where($where)->where($where1)->field("id,start_time,team_home,team_guest,title")->select();
        $list1 = Db::name("saishi")->where($where)->where($where2)->field("id,start_time,team_home,team_guest,title")->select();
        $list2 = Db::name("saishi")->where($where)->where($where3)->field("id,start_time,team_home,team_guest,title")->select();
        $sum = count($list);
        $sum1 = count($list1);
        $sum2 = count($list2);
        $this->assign('list',$list);
        $this->assign('list1',$list1);
        $this->assign('list2',$list2);
        $this->assign('sum',$sum);
        $this->assign('sum1',$sum1);
        $this->assign('sum2',$sum2);
        return $this->fetch();
    }

    public function marketorder() {
        $id = input('id');
        if(empty($id)){
            return $this->jsonData(['data'=>[]]);
        }
        $list = $this->get_info($id);
        $odd = $this->getOdd($id);
        $bosum  =  Db::name('zhudan')->where('type',1)->where('id_saishi',$id)->sum('money');
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
        $this->assign('money',intval(getMoney()));//总成交量
        $this->assign('bosum',$bosum);//总成交量
        $this->assign('bbosum',$bbosum);//总成交量
        $this->assign('ysum',$res1);//总成交量
        $this->assign('bysum',$res2);//总成交量
        $this->assign('list',$list);
        $this->assign('id',$id);
        return $this->fetch();
    }

    public function monrecord() {
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
        $limits = 1000;// 获取总条数
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
        $this->assign('lists', $lists); //
        if(input('get.page'))
        {
            return json($lists);
        }
        return $this->fetch();
    }
    public function my() {
        return $this->fetch();
    }
    public function news_info() {
        return $this->fetch();
    }
    public function orderinfo() {
        $uid  = session('uid');
        $map['id_user'] = $uid;
        $map['isjiesuan'] = 0;
        $time1 = strtotime(get_w_start());
        $etime1= strtotime(get_w_end());
        $time2 = strtotime(get_w_start2());
        $etime2= strtotime(get_w_end2());
        $time3 = strtotime(thismonth_start_time());
        $etime3= strtotime(thismonth_end_time());
        $time4 = strtotime(lastmonth_start_time());
        $etime4= strtotime(lastmonth_end_time());
        $where = " 1 and add_time >= $time1 and add_time<= $etime1";  //本周
        $where1 = " 1 and add_time >= $time2 and add_time<= $etime2"; //上周
        $where2 = " 1 and add_time >= $time3 and add_time<= $etime3"; //本月
        $where3 = " 1 and add_time >= $time4 and add_time<= $etime4"; //上月
        $sumMoney = Db::name('zhudan')->where($map)->sum('money');
        $sumHuoli = Db::name('zhudan')->where($map)->sum('cangetmoney');
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 15;// 获取总条数
        $count = Db::name('zhudan')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $list = Db::name('zhudan')->where($map)->where($where)->page($Nowpage, $limits)->order('id desc')->select();
        $list2 = Db::name('zhudan')->where($map)->where($where1)->page($Nowpage, $limits)->order('id desc')->select();
        $list3 = Db::name('zhudan')->where($map)->where($where2)->page($Nowpage, $limits)->order('id desc')->select();
        $list4 = Db::name('zhudan')->where($map)->where($where3)->page($Nowpage, $limits)->order('id desc')->select();
        foreach ($list as $k =>$v){
            $list[$k]['add_time'] = date("m/d",$list[$k]['add_time'])."<br>".date("H:i:s",$list[$k]['add_time']);
            $list[$k]['s_info'] = $this->getSinfo($list[$k]['id_saishi']);
        }
        foreach ($list2 as $k =>$v){
            $list2[$k]['add_time'] = date("m/d",$list2[$k]['add_time'])."<br>".date("H:i:s",$list2[$k]['add_time']);
            $list2[$k]['s_info'] = $this->getSinfo($list2[$k]['id_saishi']);
        }
        foreach ($list3 as $k =>$v){
            $list3[$k]['add_time'] = date("m/d",$list3[$k]['add_time'])."<br>".date("H:i:s",$list3[$k]['add_time']);
            $list3[$k]['s_info'] = $this->getSinfo($list3[$k]['id_saishi']);
        }
        foreach ($list4 as $k =>$v){
            $list4[$k]['add_time'] = date("m/d",$list4[$k]['add_time'])."<br>".date("H:i:s",$list4[$k]['add_time']);
            $list4[$k]['s_info'] = $this->getSinfo($list4[$k]['id_saishi']);
        }
        $this->assign('sumMoney',$sumMoney);
        $this->assign('sumHuoli',$sumHuoli);
        $this->assign('list',$list);
        $this->assign('list2',$list2);
        $this->assign('list3',$list3);
        $this->assign('list4',$list4);
        return $this->fetch();
    }
    private function getSinfo($id) {
        $a  = Db::name('saishi')->where('id',$id)->find();
        return "【".$a['title']."】"."</br>".$a['team_home']."<font color='red'>[主]</font>"."</br>"."VS"."</br>".$a['team_guest'];
        //主队；
    }
    public function receive() {
        return $this->fetch();
    }
    public function rules() {
        return $this->fetch();
    }
    public function service() {
        return $this->fetch();
    }
    public function statistics() {
        return $this->fetch();
    }

    public function order() {
        return $_POST;
    }
    public function login() {
        return $this->fetch();
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
        $uid = session('uid');
        $map['id_user'] = $uid;
        $map['isjiesuan'] = 0;
        $total = Db::name('zhudan')->where($map)->count();
        $nmoney = Db::name('zhudan')->where($map)->sum('money');
        $account =  getAccount();
        $money   = intval(getMoney());
        return  $this->jsonData(["code"=>1,
                                'money'=>$money,
                                'account'=> $account,
                                'total'=>$total,
                                'nmoney'=>$nmoney
        ]);
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

