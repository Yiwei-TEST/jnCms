<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class OrderModel extends Model
{
    protected $name = 'order';

    /**
     * 根据搜索条件获取订单列表信息
     */
    public function getOrdersByWhere($map, $Nowpage, $limits)
    {
        return $this->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的订单数量
     * @param $where
     */
    public function getAllorders($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 根据订单id获取角订单信息
     * @param $id
     */
    public function getOneOrder($id)
    {
        return $this->where('id', $id)->find();
    }

}
