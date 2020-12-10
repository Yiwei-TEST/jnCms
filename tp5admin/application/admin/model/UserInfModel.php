<?php

namespace app\admin\model;
use think\Db;
use think\Config;
class UserInfModel
{

    public function getuid_byinfo($uid) {
        $db2 = Config::get('db2');
        $sql = "SELECT * FROM user_inf WHERE `userId` = '$uid'";
        return Db::connect($db2)->query($sql);
    }

    public function getgId_byinfo($groupId) {
        $db2 = Config::get('db2');
        $sql = "SELECT a.extMsg, a.groupId,a.groupState ,a.groupName, a.maxCount,a.currentCount, b.promoterId1 ,b.createdTime,b.userName,b.userNickname,c.phoneNum,c.cards,c.freeCards,c.name ,c.os FROM t_group AS a,t_group_user AS b ,user_inf AS c  WHERE a.groupId = b.groupId AND a.groupId = '$groupId' AND c.userId = b.promoterId1 AND a.parentGroup=0 LIMIT 1";
        return Db::connect($db2)->query($sql);
    }

    public function getgId_bylist($groupId, $Nowpage, $limits) {
        $db2 = Config::get('db2');
        $start_p = ($Nowpage-1) * $limits;
        $end_p   = $Nowpage * $limits;
        $sql = "SELECT * FROM t_group_user  WHERE  groupId = '$groupId' order by userRole LIMIT $start_p , $end_p";
        return Db::connect($db2)->query($sql);
    }

    public function getgId_count ($groupId) {
        $db2 = Config::get('db2');
        $sql = "SELECT count(userId) as numbers FROM t_group_user  WHERE  groupId = '$groupId'";
        return Db::connect($db2)->query($sql);
    }

    public function getUserId_bylist($userId) {
        $db2 = Config::get('db2');
        $sql = "SELECT groupId,groupName FROM t_group_user  WHERE  userId = '$userId'";
        return Db::connect($db2)->query($sql);
    }
}
