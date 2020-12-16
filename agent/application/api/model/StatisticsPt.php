<?php
namespace app\api\model;

use think\Model;

class StatisticsPt extends Model
{
    protected $name = 'statistics_pt';

    /**
     * 插入日统计数据
     * @param $param
     */
    public function insertStatistics($param)
    {
        try{
            $result = $this->validate('StatisticsValidate')->allowField(true)->save($param);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                apilog('平台数据添加成功',1);
                return ['code' => 1, 'data' => '', 'msg' => '添加数据成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
}