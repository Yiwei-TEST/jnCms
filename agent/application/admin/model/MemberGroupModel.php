<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class MemberGroupModel extends Model
{
    protected $name = 'member_group';
    protected $autoWriteTimestamp = true;   // 开启自动写入时间戳

    /**
     * 根据条件获取全部数据
     */
    public function getAll($map, $Nowpage, $limits)
    {
        return $this->where($map)->page($Nowpage,$limits)->order('id asc')->select();
    }


    /**
     * 根据条件获取所有数量
     */
    public function getAllCount($map)
    {
        return $this->where($map)->count();
    }

    /**
     * 获取所有的会员组信息
     */
    public function getGroup()
    {
        //获取当前会员级别下面得会员组
        $mid  = session('mid');
        $map = " 1";
        $gropid = Db::name('member')->where('id',$mid)->value("group_id");
        if($mid !=1){
            $map .= " and id >$gropid  and  id < 4";
        }else{
            $map .= " and id >$gropid";
        }

        return $this->where($map)->select();
    }


    /**
     * 插入信息
     */
    public function insertGroup($param)
    {
        try{
            $result =  $this->validate('MemberGroupValidate')->save($param);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 编辑信息
     */
    public function editGroup($param)
    {
        try{
            $result =  $this->validate('MemberGroupValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '编辑成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 根据id获取一条信息
     */
    public function getOne($id)
    {
        return $this->where('id', $id)->find();
    }


    /**
     * 删除信息
     */
    public function delGroup($id)
    {
        try{
            $this->where('id', $id)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    /**
     * [getRoleInfo 获取角色信息]
     * @author [田建龙] [864491238@qq.com]
     */
    public function getRoleInfo($id){

        $result = Db::name('auth_group')->where('id', $id)->find();
        if(empty($result['rules'])){
            $where = '';
        }else{
            $where = 'id in('.$result['rules'].')';
        }
        $res = Db::name('auth_rule')->field('name')->where($where)->select();

        foreach($res as $key=>$vo){
            if('#' != $vo['name']){
                $result['name'][] = $vo['name'];
            }
        }

        return $result;
    }

}
