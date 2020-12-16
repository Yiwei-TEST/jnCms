<?php

namespace app\index\validate;
use think\Validate;
class MemberValidate extends Validate
{
    protected $rule = [
        ['s_nid', 'require', '代理商不能为空'],
        ['account', 'require', '账号不能为空'],
        ['password', 'require', '密码不能为空'],
        ['PayBindid', 'require', '推广码不能为空'],
        ['account', 'unique:member','该账号已经被注册'],
        ['nickname', 'unique:member','昵称已经被注册'],
    ];

}
