<?php

namespace app\admin\controller;
use think\Config;
use think\Loader;
use app\admin\model\OrderModel;
use app\admin\model\MemberGroupModel;
use think\Db;

class Order extends Base
{
    public function index()
    {
        $key = input('key');
        $type = input('type');
        $types =  input('types') ?  (int)input('types') : '';
        $typess = input('typess') ? (int)input('typess') : '';
        $stime = date('Y-m-d')." 00:00:00";
        $etime = date('Y-m-d')." 23:59:59";
        $start_time = input('start_time') ? input('start_time') : $stime;
        $end_time   = input('end_time') ? input('end_time') : $etime;
        $map = " 1";
        if($types&&$types!="")
        {
            $map .= " and status = $types";
        }
        if(!empty($start_time) && !empty($end_time)){
            $start_times = strtotime($start_time);
            $end_times = strtotime($end_time);
            $map .= " and add_time > $start_times and add_time< $end_times";
        }
        if($key&&$key!=="" && $typess!=="" )
        {
            switch ((int)$typess){
                case 1:
                    $map.= " and id = $key";
                    break;
                case 2:
                    $map.= " and bid = $key";
                    break;
                case 3:
                    $map.= " and adderss = $key";
                    break;
                case 4:
                    $map.= " and txid = $key";
                    break;
                case 5:
                    $map.= " and order_number = $key";
                    break;
            }
        }
        $order = new OrderModel();
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = $order->getAllorders($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $order->getOrdersByWhere($map, $Nowpage, $limits);
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val', $key);
        $this->assign('type', $type);
        $this->assign('start_time', $start_time);
        $this->assign('end_time', $end_time);
        $this->assign('types', $types);
        $this->assign('typess', $typess);
        if(input('get.page'))
        {
            return json($lists);
        }
        return $this->fetch();
    }

}
