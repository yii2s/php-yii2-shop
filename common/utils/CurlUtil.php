<?php
/**
 * Created by PhpStorm.
 * Date: 2016/9/27
 * Time: 11:30
 */

namespace common\utils;


class CurlUtil {

    public static function postData($url,$data){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0); //不返回内容
        curl_setopt ($ch, CURLOPT_NOSIGNAL, true);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 50); //超时时间
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}