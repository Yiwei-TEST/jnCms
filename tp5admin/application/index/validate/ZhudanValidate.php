<?php

namespace app\home\validate;
use think\Validate;
class ZhudanValidate extends Validate
{
    protected $rule = [
        ['xiazhu', 'require', '位置不能为空'],
        ['money', 'require', '金额不能为空'],
        ['type', 'require', '场次不能为空'],
        ['id_saishi', 'require', '赛事不能为空'],
        ['huoli', 'require', '获利率不能为空'],
    ];

}
