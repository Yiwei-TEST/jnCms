<?php
use think\Db;

/**
 * 记录日志
 * @param  [type] $uid         [用户id]
 * @param  [type] $username    [用户名]
 * @param  [type] $description [描述]
 * @param  [type] $status      [状态]
 * @return [type]              [description]
 */
function writelog($uid,$username,$description,$status)
{

    $data['menber_id'] = $uid;
    $data['menber_name'] = $username;
    $data['description'] = $description;
    $data['status'] = $status;
    $data['ip'] = request()->ip();
    $data['add_time'] = time();
    $log = Db::name('web_log')->insert($data);

}

function get_byname($uid)
{
    $name = Db::name('member')->where('id',$uid)->value('nickname');
    return mb_substr($name , 0 , 2);

}



function getMoney() {
    $mid = session('uid');
    return Db::name('member')->where('id',$mid)->value('money');
}

function getMoneys($uid) {
    return Db::name('member')->where('id',$uid)->value('money');
}
function getAccount() {
    $mid = session('uid');
    return Db::name('member')->where('id',$mid)->value('account');
}

function getginfo() {
    return Db::name('ann')->order('id desc')->limit(1)->value('content');
}

function toArray($value)
{
    if (!is_object($value)) {
        return (array) $value;
    }

    $array = array();

    foreach ((array) $value as $key => $val) {
        // properties are transformed to keys in the following way:
        // private   $property => "\0Classname\0property"
        // protected $property => "\0*\0property"
        // public    $property => "property"
        if (preg_match('/^\0.+\0(.+)$/', $key, $matches)) {
            $key = $matches[1];
        }

        // See https://github.com/php/php-src/commit/5721132
        if ($key === "\0gcdata") {
            continue;
        }

        $array[$key] = $val;
    }

    // Some internal classes like SplObjectStorage don't work with the
    // above (fast) mechanism nor with reflection in Zend.
    // Format the output similarly to print_r() in this case
    if ($value instanceof \SplObjectStorage) {
        // However, the fast method does work in HHVM, and exposes the
        // internal implementation. Hide it again.
        if (property_exists('\SplObjectStorage', '__storage')) {
            unset($array['__storage']);
        } elseif (property_exists('\SplObjectStorage', 'storage')) {
            unset($array['storage']);
        }

        if (property_exists('\SplObjectStorage', '__key')) {
            unset($array['__key']);
        }

        foreach ($value as $key => $val) {
            $array[spl_object_hash($val)] = array(
                'obj' => $val,
                'inf' => $value->getInfo(),
            );
        }
    }
    return $array;
}
function get_level($uid) {
    return Db::name('member')->where('id',$uid)->value('group_id');
}