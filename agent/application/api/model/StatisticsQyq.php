<?php
namespace app\api\model;

use think\Db;
use think\Model;

class StatisticsQyq extends Model
{
    protected $name = 'statistics_qyq';

    /**
     * 插入亲友圈统计数据
     * @param $param
     */
    public function insertStatistics($group_list)
    {
        try{
            if(count($group_list)<1){
                return ['code' => -1, 'msg' => '异常'];
            }
            foreach ($group_list as $key=>$v) {
                     $data[$key]['groupId'] = $v['groupId'];
                     $data[$key]['userId']  = $v['promoterId1'];
                     $data[$key]['tdate']   = date('Y-m-d H:i;s',strtotime('-1 day'));
                     $data[$key]['xzdata']  = get_qyq_xzdata($v['groupId']);
                     $data[$key]['djdata']  = get_qyq_hydata($v['groupId']);
                     $data[$key]['zjs']     = get_qyq_zjs($v['groupId']);
                     $data[$key]['xjs']     = get_qyq_xjs($v['groupId']);
                     $data[$key]['card_xh'] = get_qyq_card_xh($v['groupId']);
                     $data[$key]['card_sy'] = get_qyq_card_sy($v['promoterId1']);
            }
            Db::name('statistics_qyq')->insertAll($data);
            apilog('亲友圈数据添加成功',1);
            return ['code' => 1, 'data' => '', 'msg' => '添加数据成功'];
                }catch( PDOException $e){
                return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
            }
    }
}