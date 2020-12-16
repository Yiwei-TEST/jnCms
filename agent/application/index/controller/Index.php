<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\admin\model\UserInfModel;
use org\Crypt;
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
        $config = [
            'key' =>"bjdlimsam2019%@)" , //加密key
            'iv' => "bjdlimsam2019%@)" , //保证偏移量为16位
            'method' => 'AES-128-CBC' //加密方式  # AES-256-CBC等
        ];
        $aes = new Crypt($config);
        $gid = input('get.group_id');
        if(empty($gid)) {
            $this->redirect('index/my');
        }
        $u_mode = new UserInfModel();
        if($gid &&$gid>0){
            $userinfo = $u_mode->getgId_byinfo($gid);
            $yesterday_start = date('Y-m-d',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))))." 00:00:00";
            $yesterday_end   = date('Y-m-d',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))))." 23:59:59";
            $month_start     = date('Y-m')."-01 00:00:00";
            $month_end       = date('Y-m-d H:i:s');
            $where = " 1 and tdate >= '$yesterday_start' and tdate<='$yesterday_end' and groupId = $gid";
            $where1 = " 1 and tdate >= '$month_start' and tdate<='$month_end 'and groupId = $gid";
            $yesterday_info =  Db::name('statistics_qyq')->where($where)->sum('zjs');         //昨日局数
            $month_info =   Db::name('statistics_qyq')->where($where1)->sum('zjs');             //本月局数
            if(!empty($userinfo)){
                $userlist = $userinfo[0];
                $userlist['phoneNum'] = $aes->aesDe($userlist['phoneNum']);
                $ext_info = json_decode($userlist['extMsg'],true);
                if(empty($ext_info['forbidden'])){
                    $userlist['kf_start'] = 1;
                }else{
                    $userlist['kf_start'] = 0;
                }
                $card = $userlist['cards'] + $userlist['freeCards'];
            }else{
                $userlist = [];
            }
        }else{
            $userlist = [];
            $card = 0;
            $yesterday_info = 0;
            $month_info = 0;
        }
        $this->assign('yesterday_info',$yesterday_info);
        $this->assign('month_info',$month_info);
        $this->assign('groupId',$gid);
        $this->assign('groupName',$userlist['groupName']);
        $this->assign('maxCount',$userlist['maxCount']);
        $this->assign('currentCount',$userlist['currentCount']);
        $this->assign('createdTime',$userlist['createdTime']);
        $this->assign('userId',$userlist['userId']);
        $this->assign('name',$userlist['name']);
        $this->assign('nickname',$userlist['name']);
        $this->assign('phoneNum',$userlist['phoneNum']);
        $this->assign('card',$card);
        $this->assign('groupState',$userlist['groupState']);
        return $this->fetch();
    }

    private  function  get_info($id) {
        return Db::name('saishi')->where('id',$id)->find();
    }

    public function help_wechat() {
        return $this->fetch();
    }

    public function add_agent() {
        return $this->fetch();
    }

    public function marketorder() {

        return $this->fetch();
    }

    public function my() {
        return $this->fetch();
    }
    public function news_info() {
        return $this->fetch();
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
        $time1 = get_w_start();
        $etime1= get_w_end();
        $time2 = get_w_start2();
        $etime2= get_w_end2();
        $time3 = thismonth_start_time();
        $etime3= thismonth_end_time();
        $time4 = lastmonth_start_time();
        $etime4= lastmonth_end_time();
        $groupId = input('get.groupId')?input('get.groupId') : 666 ;
        if(input('post.')){
            $groupId = input('post.groupId');
            $ainfo =  $this->getAush($groupId);//判断亲友圈是否有权限查询
            if($ainfo===404){
                return json(['code'=>0,"message"=>"亲友圈不存在"]);
            }
            if($ainfo!==1) {
                return json(['code'=>0,"message"=>"暂无权限操作此亲友圈"]);
            }
            $where = " 1 and tdate >= '$time1' and tdate<= '$etime1'  and groupId = '$groupId'";  //本周
            $where1 = " 1 and tdate >= '$time2' and tdate<= '$etime2' and groupId = '$groupId'"; //上周
            $where2 = " 1 and tdate >= '$time3' and tdate<= '$etime3' and groupId = '$groupId'"; //本月
            $where3 = " 1 and tdate >= '$time4' and tdate<= '$etime4' and groupId = '$groupId'"; //上月
            $z_list  = Db::name('statistics_qyq')->where($where)->order('tdate desc')->select();
            $sz_list = Db::name('statistics_qyq')->where($where1)->order('tdate desc')->select();
            $m_list  = Db::name('statistics_qyq')->where($where2)->order('tdate desc')->select();
            $sm_list = Db::name('statistics_qyq')->where($where3)->order('tdate desc')->select();
            return json(['code'=>1,'z_list'=>$z_list,'sz_list'=>$sz_list,'m_list'=>$m_list,'sm_list'=>$sm_list]);
        }
        $this->assign("groupId",$groupId);
        return $this->fetch();
    }
    /**
    */
    private function getAush ($gid) {
        $uid = session('uid');
        $u_mode = new UserInfModel();
        $userinfo = $u_mode->getgId_byinfo($gid);
        if(empty($userinfo)){
            return 404;
        }
        $PayBindid = $userinfo[0]['payBindId'];
        $leven = get_level($uid);
        if($leven==2) {  //包负责人权限
            $where = " 1 and s_nid = $uid and PayBindid = $PayBindid";
            $info = Db::name('member')->where($where)->find();
            if(!empty($info)) {
                return  1;
            }else{
                return  2;
            }
        }
        if($leven==4) {  //业务员的权限
            $where = " 1 and id = $uid and PayBindid = $PayBindid";
            $info = Db::name('member')->where($where)->find();
            if(!empty($info)) {
                return  1;
            }else{
                return  2;
            }
        }
    }

    public function order() {
        return $_POST;
    }
    public function login() {
        return $this->fetch();
    }
    public function get_level() {
        $uid = session('uid');
        $leven = get_level($uid);
        if($leven>=2) {
            return json(['code'=>1,'level'=>$leven]);
        }
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
        $userinfo = Db::name('member')->where('id',$uid)->find();
        return  $this->jsonData(["code"=>1,
                                'nickname'=>$userinfo['nickname'],
                                'PayBindid'=>$userinfo['PayBindid'],
                                'group_id' =>$userinfo['group_id']
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

    /**
     * 获取下级业务员
    */
    public function get_agent() {
        $uid = session('uid');
        $leven = get_level($uid);
        if($leven==2) {
            $where = " 1 and s_nid = $uid";
            $list = Db::name('member')->where($where)->select();
            if(!empty($list)){
                return json(['code'=>-1,'data'=>$list]);
            }else{
                return json(['code'=>0,'messasg'=>"暂无数据"]);
            }
        }
    }

    /**
     * 获取业务员下级群主
     */
    public function get_qz_list() {
        $uid = session('uid');
            //获取群主
        if(input('post.')) {
            $PayBindid = input('post.PayBindid');
            $user_model = new UserInfModel();
            $qz_list   = $user_model->get_qz_list($PayBindid);
            return json(['code'=>1,'data'=>$qz_list]);
        }
    }

}

