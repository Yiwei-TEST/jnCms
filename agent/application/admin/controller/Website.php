<?php

namespace app\admin\controller;
use app\admin\model\UserModel;
use app\admin\model\UserType;
use think\Db;

class Website extends Base
{
   
   /*
    * 微站配置设置
    * 
    */
   public function site(){
   	
   	
     return	$this->fetch();
   }

}