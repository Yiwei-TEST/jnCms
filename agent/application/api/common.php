<?php
use think\Config;
use org\Crypt;

/**
 * 解密
 */
function decrypt_info($info) {
    $is_decrypt = Config::get('is_decrypt');
    if($is_decrypt==1){
        $api_key = Config::get('api_key');
        $api_vi = Config::get('api_vi');
        $config = [
            'key' => $api_key, //加密key
            'iv' => $api_vi, //保证偏移量为16位
            'method' => 'AES-128-CBC' //加密方式  # AES-256-CBC等
        ];
        $aes = new Crypt($config);
        $res_info = $aes->aesDe($info);
        $res_info = json_decode($res_info,true);
    }else{
        $res_info = json_decode($info,true);
    }
    return $res_info;
}

/**
 * 加密
 */
function encrypt_info($info) {
    $is_encrypt = Config::get('is_encrypt');
    if($is_encrypt==1){
        $api_key = Config::get('api_key');
        $api_vi = Config::get('api_vi');
        $config = [
            'key' => $api_key, //加密key
            'iv' => $api_vi, //保证偏移量为16位
            'method' => 'AES-128-CBC' //加密方式  # AES-256-CBC等
        ];
        $aes = new Crypt($config);
        $res_info = $aes->aesEn($info);
    }else{
        $res_info = $info;
    }
    return $res_info;
}

/**
 * 签名参数
 * @param params
 * @return
 */

function checkSign($params_info) {
    ksort($params_info);
    $params_infoss = http_build_query($params_info);
    return md5("&".$params_infoss."&key=0NUs3u0qpsfrB4k9");
}
/**
 * 签名参数
 * @param params
 * @return
 */

function checkSigns($params_info) {
    ksort($params_info);
    $params_infoss = http_build_query($params_info);
    return md5($params_infoss."&key=dKPVJ60PJS8mlONb");
}
