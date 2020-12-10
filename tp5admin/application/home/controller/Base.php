<?php

namespace app\home\controller;
use app\home\model\BaseModel;
use think\Controller;

class Base extends Controller
{
    public function _initialize()
    {
        if(!session('uid')||!session('username')){
            $this->redirect('login/index');
        }

    }
}
