<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/27
 * Time: 11:30
 */

namespace common\utils;


use yii\base\Exception;

class CurlUtil {

    /**
     * 使用curl发送请求.
     *
     * @use 使用示例:
     * get请求:         WebUtils::request('http://www.cnweike.cn/',false,array('weikeID'=>2323));
     *
     * @param $url 请求的url
     * @param $isPost 请求方式, true使用post
     * @param $data post的数据
     * @param int $asynch 是否异步请求  默认 1同步   0异步
     * @param int $format 请求格式  0:原始格式; 1:json; 2:数组
     * @return mixed
     * @author brook
     * @since 2016年01月15日 支持get方式
     */
    protected static function request($url,$isPost,$data,$asynch=1,$format=2){
        $curl = curl_init();
        $postData=array();
        if($data && !empty($data)){
            foreach($data as $key=>$value){
                $postData[$key]=$value;
            }
        }
        $post = http_build_query($postData);  //多维数组时使用这个
        if($isPost){
            curl_setopt($curl, CURLOPT_POST, true); // 发送一个常规的Post请求
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        }else{
            if(is_array($data) && !empty($data)){
                $url .='?'.http_build_query($data);
            }
        }
        curl_setopt($curl, CURLOPT_URL, $url);

        if(!$asynch){
            curl_setopt ( $curl,  CURLOPT_NOSIGNAL, true);// 是可以支持毫秒级别超时设置的
            curl_setopt($curl,CURLOPT_TIMEOUT_MS,200);//设置过时时间，最小为1秒 by John

        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, $asynch);//设置为1时，不默认输出返回信息，保存在变量，return ，但会堵塞进程
        $result = curl_exec($curl); //modify by chenzsh 返回值
        //$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //$data = curl_getinfo($curl);
        //return $data;
        curl_close($curl);
        return $result ;//modify by chenzsh
    }

    public static function postData($url,$data ,$asynch = 0,$format=2){
        return self::request($url,true,$data,$asynch,$format);

       /* $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true); // 发送一个常规的Post请求
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_TIMEOUT,1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;*/

    }


}