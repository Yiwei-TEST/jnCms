<?php

namespace app\home\validate;

use think\Validate;

class HomeValidate extends Validate
{
    protected $rule = [
        ['username', 'require', '用户名不能为空'],
        ['password', 'require', '密码不能为空'],
    ];

}
