<?php

namespace app\home\validate;
use think\Validate;
class MemberValidate extends Validate
{
    protected $rule = [
        ['nickname', 'require', '昵称不能为空'],
        ['account', 'require', '账号不能为空'],
        ['password', 'require', '密码不能为空'],
        ['mobile', 'require', '电话号码不能为空'],
        ['account', 'unique:member','该账号已经被注册'],
        ['password', 'require', '密码不能为空'],
    ];

}
