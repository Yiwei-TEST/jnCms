<?php
use think\Db;
use think\Request;
use think\Config as Configs;
use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;

use Org\QRcode;
/**
 * 字符串截取，支持中文和其他编码
 */
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
	if (function_exists("mb_substr"))
		$slice = mb_substr($str, $start, $length, $charset);
	elseif (function_exists('iconv_substr')) {
		$slice = iconv_substr($str, $start, $length, $charset);
		if (false === $slice) {
			$slice = '';
		}
	} else {
		$re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all($re[$charset], $str, $match);
		$slice = join("", array_slice($match[0], $start, $length));
	}
	return $suffix ? $slice . '...' : $slice;
}



/**
 * 读取配置
 * @return array
 */
function load_config(){
    $list = Db::name('config')->select();
    $config = [];
    foreach ($list as $k => $v) {
        $config[trim($v['name'])]=$v['value'];
    }

    return $config;
}


/**
* 验证手机号是否正确
* @author honfei
* @param number $mobile
*/
function isMobile($mobile) {
    if (!is_numeric($mobile)) {
        return false;
    }
    return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
}


/**
 * 阿里云云通信发送短息
 * @param string $mobile    接收手机号
 * @param string $tplCode   短信模板ID
 * @param array  $tplParam  短信内容
 * @return array
 */
function sendMsg($mobile,$tplCode,$tplParam){
    if( empty($mobile) || empty($tplCode) ) return array('Message'=>'缺少参数','Code'=>'Error');
    if(!isMobile($mobile)) return array('Message'=>'无效的手机号','Code'=>'Error');

    require_once '../extend/aliyunsms/vendor/autoload.php';
    Config::load();             //加载区域结点配置
    $accessKeyId = config('alisms_appkey');
    $accessKeySecret = config('alisms_appsecret');
    if( empty($accessKeyId) || empty($accessKeySecret) ) return array('Message'=>'请先在后台配置appkey和appsecret','Code'=>'Error');
    $templateParam = $tplParam; //模板变量替换
    //$signName = (empty(config('alisms_signname'))?'阿里大于测试专用':config('alisms_signname'));
	$signName = config('alisms_signname');
    //短信模板ID
    $templateCode = $tplCode;
    //短信API产品名（短信产品名固定，无需修改）
    $product = "Dysmsapi";
    //短信API产品域名（接口地址固定，无需修改）
    $domain = "dysmsapi.aliyuncs.com";
    //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
    $region = "cn-hangzhou";
    // 初始化用户Profile实例
    $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
    // 增加服务结点
    DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
    // 初始化AcsClient用于发起请求
    $acsClient= new DefaultAcsClient($profile);
    // 初始化SendSmsRequest实例用于设置发送短信的参数
    $request = new SendSmsRequest();
    // 必填，设置雉短信接收号码
    $request->setPhoneNumbers($mobile);
    // 必填，设置签名名称
    $request->setSignName($signName);
    // 必填，设置模板CODE
    $request->setTemplateCode($templateCode);
    // 可选，设置模板参数
    if($templateParam) {
        $request->setTemplateParam(json_encode($templateParam));
    }
    //发起访问请求
    $acsResponse = $acsClient->getAcsResponse($request);
    //返回请求结果
    $result = json_decode(json_encode($acsResponse),true);

    return $result;
}



//生成网址的二维码 返回图片地址
function Qrcode($token, $url, $size = 8){
    $md5 = md5($token);
    $dir = date('Ymd'). '/' . substr($md5, 0, 10) . '/';
    $patch = 'qrcode/' . $dir;
    if (!file_exists($patch)){
        mkdir($patch, 0755, true);
    }
    $file = 'qrcode/' . $dir . $md5 . '.png';
    $fileName =  $file;
    if (!file_exists($fileName)) {

        $level = 'L';
        $data = $url;
        QRcode::png($data, $fileName, $level, $size, 2, true);
    }
    return $file;
}

function domain()
{
    //获取当前域名
    $request = Request::instance();
    $domain=$request->domain();
    return $domain;
}

/**
 * 循环删除目录和文件
 * @param string $dir_name
 * @return bool
 */
function delete_dir_file($dir_name) {
    $result = false;
    if(is_dir($dir_name)){
        if ($handle = opendir($dir_name)) {
            while (false !== ($item = readdir($handle))) {
                if ($item != '.' && $item != '..') {
                    if (is_dir($dir_name . DS . $item)) {
                        delete_dir_file($dir_name . DS . $item);
                    } else {
                        unlink($dir_name . DS . $item);
                    }
                }
            }
            closedir($handle);
            if (rmdir($dir_name)) {
                $result = true;
            }
        }
    }

    return $result;
}



//时间格式化1
function formatTime($time) {
    $now_time = time();
    $t = $now_time - $time;
    $mon = (int) ($t / (86400 * 30));
    if ($mon >= 1) {
        return '一个月前';
    }
    $day = (int) ($t / 86400);
    if ($day >= 1) {
        return $day . '天前';
    }
    $h = (int) ($t / 3600);
    if ($h >= 1) {
        return $h . '小时前';
    }
    $min = (int) ($t / 60);
    if ($min >= 1) {
        return $min . '分钟前';
    }
    return '刚刚';
}

//返回今天开始时间
function get_today_start() {
    return date('Y-m-d')." 00:00:00"; //今天零点
}
//返回今天结束时间
function get_today_end() {
    return date('Y-m-d')." 23:59:59"; //今天零点
}
//返回明天开始时间
function get_tomorrow_start() {
    return date("Y-m-d",strtotime("+1 day"))." 00:00:00";
}
//返回明天结束时间
function get_tomorrow_end() {
    return date("Y-m-d",strtotime("+1 day"))." 23:59:59";
}

function get_saishi($id) {
    return Db::name('saishi')->where('id',$id)->value('title');
}
function get_sinfo($id) {
    $zhu = Db::name('saishi')->where('id',$id)->value('team_home');
    $fu = Db::name('saishi')->where('id',$id)->value('team_guest');
    $info = $zhu."<font color='red'>(主)</font>".$fu;
    return $info;
}

function open_saishitime($id) {
    return Db::name('saishi')->where('id',$id)->value('start_time');
}

function saishi_type($type) {
    $name = "";
   switch ($type) {
       case 0:
           $name = "半场波胆";
            break;
       case 1:
           $name = "全场波胆";
           break;
   }
   return $name;
}


function xiazhu_info($xiazhu) {
    $name ="";
    switch ($xiazhu){
        case 1:
            $name = "0-0";
            break;
        case 2:
            $name = "0-1";
            break;
        case 3:
            $name = "0-2";
            break;
        case 4:
            $name = "0-3";
            break;
        case 5:
            $name = "1-0";
            break;
        case 6:
            $name = "1-1";
            break;
        case 7:
            $name = "1-2";
            break;
        case 8:
            $name = "1-3";
            break;
        case 9:
            $name = "2-0";
            break;
        case 10:
            $name = "2-1";
            break;
        case 11:
            $name = "2-2";
            break;
        case 12:
            $name = "2-3";
            break;
        case 13:
            $name = "3-0";
            break;
        case 14:
            $name = "3-1";
            break;
        case 15:
            $name = "3-2";
            break;
        case 16:
            $name = "3-3";
            break;
        case 17:
            $name = "客队赢进球4球以上";
            break;
        case 18:
            $name = "主队赢进球4球以上";
            break;
        case 19:
            $name = "0-0";
            break;
        case 20:
            $name = "0-1";
            break;
        case 21:
            $name = "0-2";
            break;
        case 22:
            $name = "1-0";
            break;
        case 23:
            $name = "1-1";
            break;
        case 24:
            $name = "1-2";
            break;
        case 25:
            $name = "2-0";
            break;
        case 26:
            $name = "2-1";
            break;
        case 27:
            $name = "2-2";
            break;
        case 28:
            $name = "其他";
            break;
    }
    return $name;
}
function money_type($type) {
    $name = "";
    switch ($type) {
        case 0:
            $name = "结算";
            break;
        case 1:
            $name = "充值";
            break;
        case 2:
            $name = "提领";
            break;
        case 3:
            $name = "下注";
            break;
    }
    return $name;
}
/**
 * 记录日志
 * @param  [type] $uid         [用户id]
 * @param  [type] $username    [用户名]
 * @param  [type] $description [描述]
 * @param  [type] $status      [状态]
 * @return [type]              [description]
 */
function moneylog($uid,$before_money,$after_money,$type,$money,$pid)
{
    $data['uid'] = $uid;
    $data['pid'] = $pid;
    $data['money'] = $money;
    $data['before_money'] = $before_money;
    $data['after_money'] = $after_money;
    $data['type'] = $type;
    $data['add_time'] = time();
    $log = Db::name('money_log')->insert($data);
}

//时间格式化2
function pincheTime($time) {
     $today  =  strtotime(date('Y-m-d')); //今天零点
      $here   =  (int)(($time - $today)/86400) ;
      if($here==1){
          return '明天';
      }
      if($here==2) {
          return '后天';
      }
      if($here>=3 && $here<7){
          return $here.'天后';
      }
      if($here>=7 && $here<30){
          return '一周后';
      }
      if($here>=30 && $here<365){
          return '一个月后';
      }
      if($here>=365){
          $r = (int)($here/365).'年后';
          return   $r;
      }
     return '今天';
}


//$today = date("Y-m-d");
////昨天
//$yesterday = date("Y-m-d", strtotime(date("Y-m-d"))-86400);
//本周
function get_w_start() {
   return date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y")));
}
function get_w_end() {
    return date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y")));
}
//本周
function get_w_start2() {
    return date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1-7,date("Y")));
}
function get_w_end2() {
    return date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7-7,date("Y")));
}

function thismonth_start_time() {
    return $thismonth_start = date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),1,date("Y")));
}
function thismonth_end_time() {
    return $thismonth_end = date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("t"),date("Y")));
}
//上月
function lastmonth_start_time() {
    return date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m")-1,1,date("Y")));
}
function lastmonth_end_time() {
    return date("Y-m-d H:i:s",mktime(23,59,59,date("m") ,0,date("Y")));
}
//本季度未最后一月天数

//本季度/
function thisquarter_start_time() {
    return $thisquarter_start = date('Y-m-d H:i:s', mktime(0, 0, 0,date('n')-(date('n')-1)%3,1,date('Y')));
}
function thisquarter_end_time() {
    $getMonthDays = date("t",mktime(0, 0 , 0,date('n')+(date('n')-1)%3,1,date("Y")));
    return $thisquarter_end = date('Y-m-d H:i:s', mktime(23,59,59,date('n')+(date('n')-1)%3,$getMonthDays,date('Y')));
}




function get_date_bym($date,$m) {
    //某天这天 几个月后的日期
    return date("Y-m-d",strtotime("+$m month",strtotime($date)));
}


function getRandomString($len, $chars=null){
    if (is_null($chars)){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    }
    mt_srand(10000000*(double)microtime());
    for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
        $str .= $chars[mt_rand(0, $lc)];
    }
    return $str;
}


function random_str($length){
    //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
    $arr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));

    $str = '';
    $arr_len = count($arr);
    for ($i = 0; $i < $length; $i++)
    {
        $rand = mt_rand(0, $arr_len-1);
        $str.=$arr[$rand];
    }
    return $str;
}

function trandom_number_sr($length){
    //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
    $arr = array_merge(range(0, 9));

    $str = '';
    $arr_len = count($arr);
    for ($i = 0; $i < $length; $i++)
    {
        $rand = mt_rand(0, $arr_len-1);
        $str.=$arr[$rand];
    }
    return $str;
}
/**
 * 统计平台新注册人数
*/
function get_xzdata(){
    $date = date('Y-m-d')." 00:00:00";
    $date1 = date('Y-m-d',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))))." 00:00:00";
    $db2 = Configs::get('db2');
    $sql = "SELECT COUNT(*) as numbers FROM user_inf WHERE `regTime` >= '$date1' AND `regTime` < '$date'";
    $result2 = Db::connect($db2)->query($sql);
    return $result2[0]['numbers'];
}

/**
 * 统计平台活跃人数
 */
function get_hydata(){
    $date1 = date('Ymd');
    $date = date('Ymd',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))));
    $db2 = Configs::get('db2');
    $sql = "SELECT COUNT(DISTINCT userId) as numbers FROM t_login_data WHERE currentDate >= $date AND currentDate < $date1";
    $result2 = Db::connect($db2)->query($sql);
    return $result2[0]['numbers'];
}

/**
 * 统计平台对局人数
 */
function get_djdata(){
    $date1 = date('Ymd');
    $date = date('Ymd',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))));
    $db2 = Configs::get('db2');
    $sql = "SELECT count(DISTINCT userId) as numbers FROM	log_group_table WHERE  dataDate >= $date AND dataDate < $date1";
    $result2 = Db::connect($db2)->query($sql);
    return $result2[0]['numbers'];
}

/**
 * 统计平台大局数
 */
function get_zjs(){
    $date1 = date('Ymd');
    $date = date('Ymd',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))));
    $db2 = Configs::get('db2');
    $sql = "SELECT ROUND(sum(player2count1 / 2 + player2count2 / 2 + player3Count1 / 3 + player3Count2 / 3 + player4count1 / 4 + player4count2 / 4)) AS Dtotal
	FROM log_group_table WHERE	dataDate >= $date AND dataDate < $date1 ";
    $result2 = Db::connect($db2)->query($sql);
    return $result2[0]['Dtotal'];
}

/**
 * 统计平台小局数
 */
function get_xjs(){
    $date1 = date('Ymd');
    $date = date('Ymd',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))));
    $db2 = Configs::get('db2');
    $sql = "SELECT 	ROUND(sum(player2count3 / 2 + player3Count3 / 3 + player4count3 / 4)) AS Xtotal
	FROM log_group_table WHERE	dataDate >= $date AND dataDate < $date1 ";
    $result2 = Db::connect($db2)->query($sql);
    return $result2[0]['Xtotal'];
}

/**
 * 统计平台房卡消耗
 */
function get_card_xh(){
    $date1 = date('Ymd');
    $date = date('Ymd',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))));
    $db2 = Configs::get('db2');
    $sql = "SELECT sum(dataValue) as valus FROM t_data_statistics WHERE dataType = 'decDiamond' AND dataDate >= $date AND dataDate < $date1 ";
    $result2 = Db::connect($db2)->query($sql);
    return $result2[0]['valus'];
}

/**
 * 统计平台房卡剩余
 */
function get_card_sy(){
    $db2 = Configs::get('db2');
    $sql = "SELECT sum(freeCards) as fcards ,sum(cards) as f1cards FROM user_inf WHERE userId>=0";
    $result2 = Db::connect($db2)->query($sql);
    return $result2[0]['fcards'] + $result2[0]['f1cards'];
}

function apilog($cont) {
    $date['info'] = $cont;
    $date['addtime'] = date('Y-m-d H:i:s');
    Db::name('apilog')->insert($date);
}

/**
 * @
 * 获取亲友圈列表
 */
function get_group_list(){
    $db2 = Configs::get('db2');
    $sql = "SELECT a.groupId , b.promoterId1 FROM t_group AS a,t_group_user AS b  WHERE a.groupId = b.groupId AND a.parentGroup=0 GROUP BY a.groupId";
    $result2 = Db::connect($db2)->query($sql);
    return $result2;
}


/**
 * @
 * 统计亲友圈新注册人数
 */
function get_qyq_xzdata($groupId){
    $date = date('Y-m-d')." 00:00:00";
    $date1 = date('Y-m-d',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))))." 00:00:00";
    $db2 = Configs::get('db2');
    $sql = "SELECT COUNT(*) as numbers FROM t_group_user WHERE groupId = $groupId AND `createdTime` >= '$date1' AND `createdTime` < '$date'";
    $result2 = Db::connect($db2)->query($sql);
    return $result2[0]['numbers'];
}

/**
 * 统计亲友圈活跃人数
 */
function get_qyq_hydata($groupId){
    $date1 = date('Ymd');
    $date = date('Ymd',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))));
    $db2 = Configs::get('db2');
    $sql = "SELECT COUNT(DISTINCT userId) as numbers FROM log_group_table WHERE groupId = $groupId AND dataDate >= $date AND dataDate < $date1";
    $result2 = Db::connect($db2)->query($sql);
    return $result2[0]['numbers'];
}


/**
 * 统计亲友圈大局数
 */
function get_qyq_zjs($groupId){
    $date1 = date('Ymd');
    $date = date('Ymd',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))));
    $db2 = Configs::get('db2');
    $sql = "SELECT ROUND(sum(player2count1 / 2 + player2count2 / 2 + player3Count1 / 3 + player3Count2 / 3 + player4count1 / 4 + player4count2 / 4)) AS Dtotal
	FROM log_group_table WHERE	dataDate >= $date AND dataDate < $date1 AND groupId = $groupId ";
    $result2 = Db::connect($db2)->query($sql);
    return $result2[0]['Dtotal'];
}

/**
 * 统计亲友圈小局数
 */
function get_qyq_xjs($groupId){
    $date1 = date('Ymd');
    $date = date('Ymd',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))));
    $db2 = Configs::get('db2');
    $sql = "SELECT 	ROUND(sum(player2count3 / 2 + player3Count3 / 3 + player4count3 / 4)) AS Xtotal
	FROM log_group_table WHERE	dataDate >= $date AND dataDate < $date1 AND groupId = $groupId";
    $result2 = Db::connect($db2)->query($sql);
    return $result2[0]['Xtotal'];
}

/**
 * 统计亲友圈房卡消耗
 */
function get_qyq_card_xh($groupId){
    $date1 = date('Ymd');
    $date = date('Ymd',strtotime(date('Y-m-d H:i:s',strtotime('-1 day'))));
    $db2 = Configs::get('db2');
    $sql = "SELECT userId,dataDate,sum(dataValue) as valus FROM t_data_statistics WHERE	dataType = 'decDiamond' AND dataDate >= $date AND dataDate < $date1 AND userId = $groupId ";
    $result2 = Db::connect($db2)->query($sql);
    if(!empty($result2)){
        return intval($result2[0]['valus']);
    }else{
        return 0;
    }
}

/**
 * 统计亲友圈房卡剩余
 */
function get_qyq_card_sy($groupId){
    $db2 = Configs::get('db2');
    $sql = "SELECT sum(freeCards) as fcards ,sum(cards) as f1cards FROM user_inf WHERE userId = $groupId";
    $result2 = Db::connect($db2)->query($sql);
    $number = $result2[0]['fcards'] + $result2[0]['f1cards'];
    return $number ? $number : 0;
}

/**
 * 获取在线人数
 */
function get_nump(){
    $db2 = Configs::get('db2');
    $sql = "SELECT name,onlineCount FROM server_config WHERE serverType = 1";
    $result2 = Db::connect($db2)->query($sql);
    return $result2 ? $result2 : '';
}
