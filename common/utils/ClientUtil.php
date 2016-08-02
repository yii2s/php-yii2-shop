<?php
namespace common\utils;

class ClientUtil
{

    /**
     * ��ȡ�ͻ���ip
     *
     * @return string
     * @since 2016-02-27
     */
    public static function getClientIp(){
        $ip = '';
        $xip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        $cip = $_SERVER['HTTP_CLIENT_IP'];
        $rip = $_SERVER['REMOTE_ADDR'];

        //ʹ�ô�����������
        if($xip && strcasecmp($xip, 'unknown')) {
            if(false !== strpos($xip,',')) {
                $ipArr = explode(',',$xip);
                foreach($ipArr as $val) {
                    if(trim(strtolower($val)) != 'unknown') {
                        $ip = $val;
                        break;
                    }
                }
            } else {
                $ip = $xip;
            }
        } elseif($cip && strcasecmp($cip, 'unknown')) {
            $ip = $cip;
        } elseif($rip && strcasecmp($rip, 'unknown')) {
            $ip = $rip;
        }

        preg_match("/[\d\.]{7,15}/", $ip, $match);
        return $match[0] ? $match[0] : 'unknown';
    }

    /**
     * ������������������
     * @var array
     * @since 2016-01-22
     */
    protected static $browsers = array(
        'Edge'            => 'Edge',
        'IE'              => 'MSIE|IEMobile|MSIEMobile|Trident/[.0-9]+',
        'Chrome'          => '(?:\bCrMo\b|CriOS|Android)?.*Chrome/[.0-9]* (Mobile)?',
        'Opera'           => 'Opera.*Mini|Opera.*Mobi|Android.*Opera|Mobile.*OPR/[0-9.]+|Coast/[0-9.]+',
        'Firefox'         => 'fennec|firefox.*maemo|(Mobile|Tablet).*Firefox|Firefox.*Mobile',
        'Safari'          => 'Version.*Mobile.*Safari|Safari.*Mobile|MobileSafari',
        'UCBrowser'       => 'UC.*Browser|UCWEB', //UC������
        'QQBrowser'       => 'MQQBrowser|TencentTraveler', //QQ������
        'The world'       => 'The world', //����֮��������
        'Maxthon'         => 'Maxthon', //����������
        'baiduboxapp'     => 'baiduboxapp',
        'baidubrowser'    => 'baidubrowser',
        'NokiaBrowser'    => 'Nokia',
    );

    /**
     * ����ϵͳ����
     * note:�ƶ��豸��ϵͳ������ƥ��
     *      ��������Ҫ���ڵ���ϵͳǰ��
     * @var array
     * @since 2016-01-22
     */
    protected static $platforms = array(
        'iOS'               => '\biPhone.*Mobile|\biPod|\biPad',
        'Windows Mobile OS' => 'Windows CE.*(PPC|Smartphone|Mobile|[0-9]{3}x[0-9]{3})|Window Mobile|Windows Phone [0-9.]+|WCE;',
        'Windows Phone OS'  => 'Windows Phone 10.0|Windows Phone 8.1|Windows Phone 8.0|Windows Phone OS|XBLWP7|ZuneWP7|Windows NT 6.[23]; ARM;',
        'Android'           => 'Android',
        'BlackBerry OS'     => 'blackberry|\bBB10\b|rim tablet os', //��ݮ
        'SymbianOS'         => 'Symbian|SymbOS|Series60|Series40|SYB-[0-9]+|\bS60\b', //����
        'webOS'             => 'webOS|hpwOS',
        'MicroMessenger'    => 'MicroMessenger', //΢��
        'Windows'           => 'Windows',
        'Windows NT'        => 'Windows NT',
        'Mac OS X'          => 'Mac OS X',
        'Ubuntu'            => 'Ubuntu',
        'Linux'             => 'Linux',
        'Chrome OS'         => 'CrOS',
    );

    /**
     * �汾��ƥ������������ + ����ϵͳ��
     * @var array
     * @since 2016-01-22
     */
    protected static $versionRegexs = array(

        // Browser
        'Maxthon'       => 'Maxthon [VER]', //����
        'Chrome'        => array('Chrome/[VER]', 'CriOS/[VER]', 'CrMo/[VER]'), //�ȸ�
        'Firefox'       => 'Firefox/[VER]', //���
        'Fennec'        => 'Fennec/[VER]', //���
        'IE'            => array('IEMobile/[VER];', 'IEMobile [VER]', 'MSIE [VER];', 'rv:[VER]'),
        'Opera'         => array('OPR/[VER]', 'Opera Mini/[VER]', 'Version/[VER]', 'Opera [VER]'),
        'UC Browser'    => 'UC Browser[VER]', //UC
        'QQBrowser'     => array('MQQBrowser/[VER]','TencentTraveler/[VER]'), //QQ
        'MicroMessenger'=> 'MicroMessenger/[VER]', //΢��
        'baiduboxapp'   => 'baiduboxapp/[VER]', //�ٶȺ���
        'baidubrowser'  => 'baidubrowser/[VER]', //�ٶ�
        'Safari'        => array('Version/[VER]', 'Safari/[VER]' ), //Mac OS X�е������
        'NokiaBrowser'  => 'NokiaBrowser/[VER]', //ŵ����

        // OS
        'iOS'              => '\bi?OS\b [VER][ ;]{1}',
        'BlackBerry'       => array('BlackBerry[\w]+/[VER]', 'BlackBerry.*Version/[VER]', 'Version/[VER]'), //��ݮ�ֻ�
        'Windows Phone OS' => array( 'Windows Phone OS [VER]', 'Windows Phone [VER]'),
        'Windows Phone'    => 'Windows Phone [VER]',
        'Windows NT'       => 'Windows NT [VER]',
        'Windows'          => 'Windows NT [VER]',
        'SymbianOS'        => array('SymbianOS/[VER]', 'Symbian/[VER]'), //����ϵͳ
        'webOS'            => array('webOS/[VER]', 'hpwOS/[VER];'), //LG
        'Mac OS X'         => 'MAC OS X [VER]', //ƻ��ϵͳ
        'BlackBerry OS'    => array('BlackBerry[\w]+/[VER]', 'BlackBerry.*Version/[VER]', 'Version/[VER]'),
        'Android'          => 'Android [VER]',
        'Chrome OS'        => 'CrOS x86_64 [VER]',
    );


    /**
     * ��ȡ�ͻ���������
     * @param $userAgent $_SERVER['HTTP_USER_AGENT']
     * @param bool $isReTurnVersion //�Ƿ�һ�𷵻ذ汾��
     * @return string (���� + �汾��)
     * @since 2016-01-23
     */
    public static function getBrowser($userAgent,$isReTurnVersion = false) {
        if(empty($userAgent)) {
            return '';
        }
        $clientBrowser = '';
        foreach((array)self::$browsers as $key => $browser) {
            if(self::match($browser,$userAgent)) {
                $clientBrowser = $key;
                break;
            }
        }
        if($isReTurnVersion && $clientBrowser) {
            $clientBrowser .= ' '.self::getVersion($clientBrowser,$userAgent);
        }
        return $clientBrowser;
    }

    /**
     * ��ȡ�ͻ��˲���ϵͳ
     * @param $userAgent
     * @param bool $isReTurnVersion //�Ƿ�һ�𷵻ذ汾��
     * @return string
     * @author wuzhc 2016-01-23
     */
    public static function getPlatForm($userAgent,$isReTurnVersion = false) {
        if(empty($userAgent)) {
            return '';
        }
        $clientPlatform = '';
        foreach((array)self::$platforms as $key => $platform) {
            if(self::match($platform,$userAgent)) {
                $clientPlatform = $key;
                break;
            }
        }
        if($isReTurnVersion && $clientPlatform) {
            $clientPlatform .= ' '.self::getVersion($clientPlatform,$userAgent);
        }
        return $clientPlatform;
    }

    /**
     * ��ѯ�汾��
     * @param $propertyName (����ϵͳ���ƺͻ�����������)
     * @see self::$versionRegexs
     * @param $userAgent
     * @return string
     * @author wuzhc 2016-01-22
     */
    public static function getVersion($propertyName,$userAgent) {

        $verRegex = array_key_exists($propertyName,self::$versionRegexs)
            ? self::$versionRegexs[$propertyName] : null;
        if(!$verRegex) {
            return '';
        } else {
            $verRegex = (array)$verRegex;
        }

        $match = self::matchVersion($verRegex,$userAgent); //��ʼƥ��
        if($match && stripos($propertyName,'window') !== false) { //windownϵͳ�汾����Ҫת��
            return self::getWinVersion($match);
        } else {
            return str_replace('_','.',$match);
        }
    }

    /**
     * ����ƥ����ת��windowϵͳ�汾��
     * @param $match
     * @return string
     * @author wuzhc 2016-01-22
     */
    protected static function getWinVersion($match) {
        if($match == '6.0') {
            return 'Vista';
        }
        else if($match == '6.1') {
            return '7';
        }
        else if($match == '6.2') {
            return '8';
        }
        else if($match == '5.1') {
            return 'XP';
        }
    }

    /**
     * ����ƥ��
     * @param array $regex
     * @param $userAgent
     * @return string
     * @author wuzhc 2016-01-22
     */
    protected static function match($regex,$userAgent) {
        return (bool)preg_match(sprintf('#%s#is',$regex),$userAgent,$matches);
    }

    /**
     * �汾������ƥ��
     * @param array $regexs
     * @param $userAgent
     * @return string
     * @author wuzhc 2016-01-22
     */
    protected static function matchVersion($regexs,$userAgent) {
        foreach((array)$regexs as $regex) {
            $regex = str_replace('[VER]','([\w\.]+)', $regex);
            $match = (bool)preg_match(sprintf('#%s#is',$regex),$userAgent,$matches);
            if($match) {
                return $matches[1];
            }
        }
        return '';
    }

}