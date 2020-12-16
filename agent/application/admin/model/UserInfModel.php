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
        $sql = "SELECT c.userId, c.payBindId, a.extMsg, a.groupId,a.groupState ,a.groupName, a.maxCount,a.currentCount, b.promoterId1 ,b.createdTime,b.userName,b.userNickname,c.phoneNum,c.cards,c.freeCards,c.name ,c.os FROM t_group AS a,t_group_user AS b ,user_inf AS c  WHERE a.groupId = b.groupId AND a.groupId = '$groupId' AND c.userId = b.promoterId1 AND a.parentGroup=0 LIMIT 1";
        return Db::connect($db2)->query($sql);
    }

    public function get_qz_list($PayBindid) {
        $db2 = Config::get('db2');
        $sql = "SELECT a.userName,a.userNickname,b.userId,a.groupId FROM t_group_user AS a ,user_inf AS b WHERE a.userId = b.userId AND b.PayBindid = '$PayBindid' AND a.userRole = 1";
        return Db::connect($db2)->query($sql);

    }
}
