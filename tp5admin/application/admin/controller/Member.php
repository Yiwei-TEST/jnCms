<?php

namespace app\admin\controller;
use app\admin\model\MemberModel;
use app\admin\model\MemberGroupModel;
use think\Db;
use think\Session;

class Member extends Base
{
    //*********************************************会员组*********************************************//
    /**
     * [group 会员组]
     * @author [田建龙] [864491238@qq.com]
     */
    public function group(){

        $key = input('key');
        $map = [];
        if($key&&$key!==""){
            $map['group_name'] = ['like',"%" . $key . "%"];
        }
        $group = new MemberGroupModel();
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');
        $count = $group->getAllCount($map);         //获取总条数
        $allpage = intval(ceil($count / $limits));  //计算总页面
        $lists = $group->getAll($map, $Nowpage, $limits);
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val', $key);
        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }

    /**
     * [add_group 添加会员组]
     * @author [田建龙] [864491238@qq.com]
     */
    public function add_group()
    {
        if(request()->isAjax()){
            $param = input('post.');
            $group = new MemberGroupModel();
            $flag = $group->insertGroup($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        return $this->fetch();
    }


    /**
     * [edit_group 编辑会员组]
     * @author [田建龙] [864491238@qq.com]
     */
    public function edit_group()
    {
        $group = new MemberGroupModel();
        if(request()->isPost()){
            $param = input('post.');
            $flag = $group->editGroup($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');
        $this->assign('group',$group->getOne($id));
        return $this->fetch();
    }


    /**
     * [del_group 删除会员组]
     * @author [田建龙] [864491238@qq.com]
     */
    public function del_group()
    {
        $id = input('param.id');
        $group = new MemberGroupModel();
        $flag = $group->delGroup($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    /**
     * [group_status 会员组状态]
     * @author [田建龙] [864491238@qq.com]
     */
    public function group_status()
    {
        $id=input('param.id');
        $status = Db::name('member_group')->where(array('id'=>$id))->value('status');//判断当前状态情况
        if($status==1)
        {
            $flag = Db::name('member_group')->where(array('id'=>$id))->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '已禁止']);
        }
        else
        {
            $flag = Db::name('member_group')->where(array('id'=>$id))->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '已开启']);
        }
    }


    //*********************************************会员列表*********************************************//
    /**
     * 会员列表
     * @author [田建龙] [864491238@qq.com]
     */
    public function index(){

        $key = input('key');
        $type = input('type');
        $map['closed'] = 0;//0未删除，1已删除
        if($key&&$key!=="")
        {
            $map['account|nickname|mobile'] = ['like',"%" . $key . "%"];
        }
        $map['group_id'] = 3;
        $member = new MemberModel();
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = $member->getAllCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $member->getMemberByWhere($map, $Nowpage, $limits);
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val', $key);
        $this->assign('type', $type);
        if(input('get.page'))
        {
            return json($lists);
        }
        $money = $this->get_money1();
        $this->assign('money',$money);
        $this->assign('xmoney',0);
        return $this->fetch();
    }


    /**
     * 添加会员
     * @author [田建龙] [864491238@qq.com]
     */
    public function add_member()
    {
        if(request()->isAjax()){
            $mid = session('mid');
            $param = input('post.');
            $info  = $this->get_accout($param['account']);
            if($info===1){
                return json(['code' => 0, 'msg' =>"账号已经存在"]);
            }
            $param['s_nid'] = $mid;
            $param['status'] = 1;
            $param['password'] = md5(md5($param['password']) . config('auth_key'));
            $member = new MemberModel();
            $info = $member->save($param);
            if($info){
                return json(['code' => 1, 'msg' =>"添加成功"]);
            }else{
                return json(['code' => 0, 'msg' =>"添加失败"]);
            }

        }
        $group = new MemberGroupModel();
        $this->assign('group',$group->getGroup());
        return $this->fetch();
    }


    /**
     * 编辑会员
     * @author [田建龙] [864491238@qq.com]
     */
    public function edit_member()
    {
        $member = new MemberModel();
        if(request()->isAjax()){
            $param = input('post.');
            if(empty($param['password'])){
                unset($param['password']);
            }else{
                $param['password'] = md5(md5($param['password']) . config('auth_key'));
            }
            $flag = $member->editMember($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
        $group = new MemberGroupModel();
        $this->assign([
            'member' => $member->getOneMember($id),
            'group' => $group->getGroup()
        ]);
        return $this->fetch();
    }


    /**
     * 删除会员
     * @author [田建龙] [864491238@qq.com]
     */
    public function del_member()
    {
        $id = input('param.id');
        $member = new MemberModel();
        $flag = $member->delMember($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    /**
     * 删除会员
     * @author [田建龙] [864491238@qq.com]
     */
    public function level_info()
    {
        $id = input('param.id');
        $key = input('key');
        $type = input('type');
        $map['closed'] = 0;//0未删除，1已删除
        if($key&&$key!=="")
        {
            $map['account|nickname|mobile'] = ['like',"%" . $key . "%"];
        }
        if($type&&$type!=="")
        {
            $map['group_id'] = $type;
        }
        $uid = Session::get('mid');
        if($id&&$id!=="")
        {
            $map['s_nid'] = $id;
        }else{
            $map['s_nid'] = $uid;
        }
        $member = new MemberModel();
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = $member->getAllCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $member->getMemberByWhere($map, $Nowpage, $limits);
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val', $key);
        $this->assign('type', $type);
        $this->assign('id', $id);
        if(input('get.page'))
        {
            return json($lists);
        }
        return $this->fetch();
    }

    /**
     * 会员状态
     * @author [田建龙] [864491238@qq.com]
     */
    public function member_status()
    {
        $id = input('param.id');
        $status = Db::name('member')->where('id',$id)->value('status');//判断当前状态情况
        if($status==1)
        {
            $flag = Db::name('member')->where('id',$id)->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '已禁止']);
        }
        else
        {
            $flag = Db::name('member')->where('id',$id)->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '已开启']);
        }
    }

    public function get_money() {
        $mid = session('mid');
        $money = Db::name('member')->where('id',$mid)->value('money');
        if($money>0){
            return json(['code' => 1, 'money'=>$money]);
        }
    }

    public function get_money1() {
        $mid = session('mid');
        $money = Db::name('member')->where('id',$mid)->value('money');
        return $money;
    }
    public function get_cc() {
        $mid = session('mid');
        $gdp = Db::name('member')->where('id',$mid)->value('gdp');
        if($gdp>0){
            return json(['code' => 1, 'gdp'=>$gdp]);
        }else{
            return json(['code' => 1, 'gdp'=>0]);
        }
    }

    private function get_accout($accout) {
        $info = Db::name('member')->where('account',$accout)->find();
        if(!empty($info)){
            return 1;
        }else{
            return 0;
        }
    }

    public function recharge_money() {
        $param = input('post.');
        if(request()->isAjax()){
            $money = $this->get_money1();
            $xmoney = Db::name("member")->where('id',$param['id'])->value('money');
            $this->assign('money',$money);
            $this->assign('xmoney',$xmoney);
            return $this->fetch();
        }
        return $this->fetch();
    }

    public function recharge() {  //充值
        $param = input('post.');
        $mid   = session('mid');
        if(request()->isAjax()) {
            $money = $this->get_money1();
            $type = intval($param['type']);
            $id = intval($param['id']);
            $member = MemberModel::get($id);
            $cmoney = intval($param['money']);
            if($type == 1){     //充值
                Db::startTrans();
                $beftermoney = $member->money;
                $aftermoney  = $beftermoney+$cmoney;
                $member->money = $aftermoney;
                $res =  $member->save();
                moneylog($id,$beftermoney,$aftermoney,$type,$cmoney,$mid);
                if(!empty($res)) {
                    Db::commit();
                    return json(['code' => 1, 'msg' =>"充值成功",'money'=>$cmoney,'xmoney'=>$aftermoney]);
                }else{
                    Db::rollback();
                }
            } else if ($type == 2){   //提领
                $beftermoney = $member->money;
                if($cmoney>$beftermoney) {
                    return json(['code' => 0, 'msg' =>"余额不足"]);
                }
                Db::startTrans();
                $maftermoney = $money + $cmoney;
                $aftermoney  = $beftermoney-$cmoney;
                $member->money = $aftermoney;
                $res =  $member->save();
                moneylog($id,$beftermoney,$aftermoney,$type,$cmoney,$mid);
                if(!empty($res)) {
                    Db::commit();
                    return json(['code' => 1, 'msg' =>"提领成功",'money'=>$maftermoney,'xmoney'=>$aftermoney]);
                }else{
                    Db::rollback();
                }
            }else{  //全部提领
                $beftermoney = $member->money;
                if($beftermoney<=0) {
                    return json(['code' => 0, 'msg' =>"余额不足"]);
                }
                Db::startTrans();
                $maftermoney = $money + $beftermoney;
                $aftermoney  = 0;
                $member->money = $aftermoney;
                $res =  $member->save();
                moneylog($id,$beftermoney,$aftermoney,2,$cmoney,$mid);
                if(!empty($res)) {
                    Db::commit();
                    return json(['code' => 1, 'msg' =>"提领成功",'money'=>$maftermoney,'xmoney'=>$aftermoney]);
                }else{
                    Db::rollback();
                }
            }
        }
    }

    public function reset_password() {
        $id = input('post.id');
        $param['password'] = md5(md5('123456') . config('auth_key'));
        $info = Db::name('member')->where('id',$id)->update($param);
        if(!empty($info)) {
            return json(['code' => 1, 'msg' =>"重置成功"]);
        }else{
            return json(['code' => 1, 'msg' =>"重置成功"]);
        }
    }

}
