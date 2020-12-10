<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class ZhudanModel extends Model
{
    protected $name = 'zhudan';

    /**
     * 根据搜索条件获取用户列表信息
     */
    public function getMingxiByWhere($map, $Nowpage, $limits)
    {
        return  $this->field('cms_zhudan.*,cms_member.nickname,cms_member.account,cms_saishi.team_home,cms_saishi.team_guest,cms_saishi.team_guest,cms_saishi.title')->join('foot_member','foot_member.id = foot_zhudan.id_user')
                    ->join('cms_saishi','cms_saishi.id = cms_zhudan.id_saishi')
                   ->where($map)
                    ->order('id')
                    ->page($Nowpage, $limits)
                    ->select();
    }


    /**
     * 根据搜索条件获取所有的用户数量
     * @param $where
     */
    public function getAllUsers($where)
    {
        return $this->field('cms_zhudan.*,cms_member.nickname,cms_member.account,cms_saishi.team_home,cms_saishi.team_guest,cms_saishi.team_guest,cms_saishi.title')->join('foot_member','foot_member.id = foot_zhudan.id_user')
            ->join('cms_saishi','cms_saishi.id = cms_zhudan.id_saishi')
            ->where($where)
            ->count();
    }
    public function getXz($where)
    {
        return $this->join('cms_member','cms_member.id = cms_zhudan.id_user')
            ->join('foot_saishi','foot_saishi.id = foot_zhudan.id_saishi')
            ->where($where)
            ->sum('foot_zhudan.money');
    }
    public function getSy($where)
    {
        return $this->join('cms_member','foot_member.id = cms_zhudan.id_user')
            ->join('cms_saishi','cms_saishi.id = cms_zhudan.id_saishi')
            ->where($where)
            ->sum('cms_zhudan.realgetmoney');
    }
    /**
     * 插入管理员信息
     * @param $param
     */
    public function insertUser($param)
    {
        try{
            $result = $this->validate('UserValidate')->allowField(true)->save($param);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                writelog(session('uid'),session('username'),'用户【'.$param['username'].'】添加成功',1);
                return ['code' => 1, 'data' => '', 'msg' => '添加用户成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 编辑管理员信息
     * @param $param
     */
    public function editUser($param)
    {
        try{
            $result =  $this->validate('UserValidate')->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                writelog(session('uid'),session('username'),'用户【'.$param['username'].'】编辑成功',1);
                return ['code' => 1, 'data' => '', 'msg' => '编辑用户成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    /**
     * 根据管理员id获取角色信息
     * @param $id
     */
    public function getOneUser($id)
    {
        return $this->where('id', $id)->find();
    }


    /**
     * 删除管理员
     * @param $id
     */
    public function delUser($id)
    {
        try{

            $this->where('id', $id)->delete();
            Db::name('auth_group_access')->where('uid', $id)->delete();
            writelog(session('uid'),session('username'),'用户【'.session('username').'】删除管理员成功(ID='.$id.')',1);
            return ['code' => 1, 'data' => '', 'msg' => '删除用户成功'];

        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
}
