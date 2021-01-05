<?php

namespace app\admin\controller;
use Symfony\Component\Yaml\Tests\A;
use think\Config;
use think\Loader;
use app\admin\model\UserInfModel;
use think\Db;
use think\Session;
use org\Crypt;
class Qyq extends Base
{
    /**
     *添加亲友圈
    */
    public function add_qyq() {
        return $this->fetch();
    }
    /**
     *添加亲友圈
     */
    public function add_qyqs() {
            if(input('post.')){
                $mid = session('mid');
                $parm = input('post.');
                $parm['time'] = time();
                unset($parm['gameIds']);
                $apiurl = Config::get('api_url').Config::get('api_prefix')."createGroup.do";
                $parm['sign'] = checkSign($parm);
                $info = curl_post($apiurl,$parm);
                $res_info = decrypt_info($info);
                if($res_info['code']===0){
                    apilog($mid."添加亲友圈成功");
                    return json($res_info);
                }else{
                    return json($res_info);
                }
            }
    }

    public function get_user() {
        $uid = input('post.uid');
        $u_mode = new UserInfModel();
        if($uid &&$uid>0){
            $userinfo = $u_mode->getuid_byinfo($uid);
            if(!empty($userinfo)){
                return json(['code'=>1,'data'=>$userinfo[0]]);
            }else{
                return json(['code'=>-1,'data'=>[],'msg'=>"暂无用户信息"]);
            }
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
        $config = [
            'key' =>"bjdlimsam2019%@)" , //加密key
            'iv' => "bjdlimsam2019%@)" , //保证偏移量为16位
            'method' => 'AES-128-CBC' //加密方式  # AES-256-CBC等
        ];
        $aes = new Crypt($config);
        $gid = input('post.groupId');
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
                return json(['code'=>1,'data'=>$userlist,'y_info'=>$yesterday_info,'m_info'=>$month_info]);
            }else{
                return json(['code'=>-1,'msg'=>"没有查到此亲友圈"]);
            }
        }else{
            return json([]);
        }
    }

    /**
     * [index 亲友圈成员列表]
     *
     */
    public function qyq_list(){

        $key = input('key');
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');//
        $u_mode = new UserInfModel();
        if($key&&$key!=="")
        {
            $gid = $key;
        }else{
            $gid = 666;
        }
        $count = $u_mode->getgId_count($gid);//计算总页面
        $allpage = intval(ceil($count[0]['numbers'] / $limits));
        $lists = $u_mode->getgId_bylist($gid, $Nowpage, $limits);
        if(input('get.page'))
        {
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val', $key);
        return $this->fetch();
    }

    /**
     * [index 亲友圈成员列表]
     *
     */
    public function get_uid_bygroup(){

        $key = input('key');
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');//
        $u_mode = new UserInfModel();
        if($key&&$key!=="")
        {
            $userId = $key;
        }else{
            $userId = 666;
        }
        $lists = $u_mode->getUserId_bylist($userId);
        if(input('get.page'))
        {
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', 1); //总页数
        $this->assign('val', $key);
        return $this->fetch();
    }
    /**
     * 暂停亲友圈
    */
    public function stop_qyq() {
        if(input('post.')){
            $mid = session('mid');
            $parm = input('post.');
            $parm['time'] = time();
            $apiurl = Config::get('api_url').Config::get('api_prefix')."forbidGroup.do";
            $parm['sign'] = checkSign($parm);
            $info = curl_post($apiurl,$parm);
            $res_info = decrypt_info($info);
            if($res_info['code']===0){
                apilog($mid."暂停亲友圈成功");
                return json($res_info);
            }else{
                return json($res_info);
            }
        }
    }

    /**
     * 关闭大联盟
     */
    public function stop_dlm() {
        if(input('post.')){
            $mid = session('mid');
            $parm = input('post.');
            $parm['time'] = time();
            $parm['optType'] = 2;
            $apiurl = Config::get('api_url').Config::get('api_prefix')."updateGroup.do";
            $parm['sign'] = checkSign($parm);
            $info = curl_post($apiurl,$parm);
            $res_info = decrypt_info($info);
            if($res_info['code']===0){
                apilog($mid."关闭大联盟成功");
                return json($res_info);
            }else{
                return json($res_info);
            }
        }
    }

    /**
     * 转移亲友圈成员
     */
    public function zy_cy() {
        if(input('post.')){
            $mid = session('mid');
            $parm = input('post.');
            $parm['time'] = time();
            $parm['retainCredit'] = 0;
            $apiurl = Config::get('api_url').Config::get('api_prefix')."moveGroupUser.do";
            $parm['sign'] = checkSign($parm);
            $info = curl_post($apiurl,$parm);
            $res_info = decrypt_info($info);
            if($res_info['code']===0){
                apilog($mid."转移亲友圈成员成功");
                return json($res_info);
            }else{
                return json($res_info);
            }
        }
    }
    /**
     * 踢出亲友圈
     */
    public function fireUser() {
        if(input('post.')){
            $mid = session('mid');
            $parm = input('post.');
            $parm['time'] = time();
            $apiurl = Config::get('api_url').Config::get('api_prefix')."fireUser.do";
            $parm['sign'] = checkSign($parm);
            $info = curl_post($apiurl,$parm);
            $res_info = decrypt_info($info);
            if($res_info['code']===0){
                apilog($mid."踢出群成员成功");
                return json($res_info);
            }else{
                return json($res_info);
            }
        }
    }
    /**
     * 转换群主
     */
    public function move_qz() {
        if(input('post.')){
            $mid = session('mid');
            $parm = input('post.');
            $parm['time'] = time();
            $apiurl = Config::get('api_url').Config::get('api_prefix')."changeMaster.do";
            $parm['sign'] = checkSign($parm);
            $info = curl_post($apiurl,$parm);
            if(empty($info)){
                return json(['code'=>-1,'message'=>"接口返回数据异常",'data'=>$info]);
            }
            $res_info = decrypt_info($info);
            if($res_info['code']===0){
                apilog($mid."转移群主成功");
                return json($res_info);
            }else{
                return json($res_info);
            }
        }
    }

    /**
     * 修改群最大人数
     */
    public function up_max_number() {
        if(input('post.')){
            $mid = session('mid');
            $parm = input('post.');
            $parm['time'] = time();
            $parm['optType'] = 1;
            $apiurl = Config::get('api_url').Config::get('api_prefix')."updateGroup.do";
            $parm['sign'] = checkSign($parm);
            $info = curl_post($apiurl,$parm);
            $res_info = decrypt_info($info);
            if($res_info['code']===0){
                apilog($mid."修改群最大人数成功");
                return json($res_info);
            }else{
                return json($res_info);
            }
        }
    }

    /**
     * 获取合伙人统计数据
     */
    public function get_hhr_data() {
        $key = input('key');
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');//
        $where = " 1";
        $s_time = date('Y-m-d',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))));
        $start_time = input('start_time') ? input('start_time') : $s_time;
        $end_time   = input('end_time') ? input('end_time') : $s_time;
        $userId     = input('userId') ? input('userId') : 0;
        if($key&&$key!=="")
        {
            $groupId = $key;
        }else{
            $groupId = 666;
        }
        $where .= " and groupId = $groupId and userId = $userId";
        if(!empty($start_time) && !empty($end_time)) {
            $start_date = date('Ymd',strtotime($start_time));
            $end_date = date('Ymd',strtotime($end_time));
            $where .= " and dataDate >= $start_date and dataDate<= $end_date";
            $lists = Db::table('log_group_commission')->where($where)->page($Nowpage, $limits)->order('dataDate desc')->select();
        }else{

            $lists = [];
        }

        if(input('get.page'))
        {
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', 1); //总页数
        $this->assign('val', $key);
        $this->assign('userId', $userId);
        $this->assign('start_time', $start_time);
        $this->assign('end_time', $end_time);
        return $this->fetch();
    }
}
