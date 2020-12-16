<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class MemberModel extends Model
{
    protected $name = 'member';
    protected $autoWriteTimestamp = true;   // 开启自动写入时间戳

    /**
     * 根据搜索条件获取用户列表信息
     */
    public function getMemberByWhere($map, $Nowpage, $limits)
    {
        return $this->field('cms_member.*,group_name')->join('cms_member_group', 'cms_member.group_id = cms_member_group.id')
            ->where($map)->page($Nowpage, $limits)->order('group_id asc')->select();
    }

    /**
     * 根据搜索条件获取所有的用户数量
     * @param $where
     */
    public function getAllCount($map)
    {
        return $this->where($map)->count();
    }


    /**
     * 插入信息
     */
    public function insertMember($param)
    {
        try{
            if($param['group_id']==6){
                $param['gdp']=0;
            }
            $result = $this->validate('MemberValidate')->allowField(true)->insertGetId($param);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' =>$result, 'msg' => '添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 编辑信息
     * @param $param
     */
    public function editMember($param)
    {
        try{
            $result =  $this->validate('MemberValidate')->allowField(true)->save($param, ['id' => $param['id']]);
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
     * 根据管理员id获取角色信息
     * @param $id
     */
    public function getOneMember($id)
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
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];

        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    public function delMember($id)
    {
        try{
            $map['closed']=1;
            $this->save($map, ['id' => $id]);
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
    /**
     * 根据用户id 获取用户下级信息
     */
    public function levelInfo($id){
        try{
            $map['s_nid']=$id;
            $this->where($map)->select();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

//    public function _deleteSubNode($ids ,$status){
//        $info = $this->_getSubNode($ids);
//        $map = "id = $ids ".$info;
//        return Db::name('member')->where($map)->setField(['status'=>$status]);
//    }

     public function _getSubNode($id){
        $list  = Db::name('member')->where('s_nid',$id)->field('id')->select();
        $str = '';
        $newarray = ' ';
        foreach ($list as $k => $node){
            $str .= " or foot_member.id=".$node['id'];
            $newarray .= $this->_getSubNode($list[$k]['id']);
        }
        $arrs = $str.$newarray;
        return $arrs;
    }

}
