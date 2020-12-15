<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class CardsKcinfoModel extends Model
{
    protected $name = 'cards_kcinfo';

    /**
     *
     */
    public function getUsersByWhere($map, $Nowpage, $limits)
    {
        return $this->where($map)->page($Nowpage, $limits)->order('add_time desc')->select();
    }

    /**
     * 根据搜索条件获取所有的用户数量
     * @param $where
     */
    public function getAllUsers($where)
    {
        return $this->where($where)->count();
    }

}
