<?php

namespace app\api\validate;

use think\Validate;

class StatisticsValidate extends Validate
{
    protected $rule = [
        ['xzdata', 'require', '新增会员数不能为空'],
        ['hydata', 'require', '活跃会员不能为空'],
        ['djdata', 'require', '对局用户数不能为空'],
        ['zjs', 'require', '总局数不能为空'],
        ['xjs', 'require', '小局数不能为空'],
        ['card_xh', 'require', '房卡数消耗不能为空'],
        ['card_sy', 'require', '房卡数剩余不能为空'],
    ];

}