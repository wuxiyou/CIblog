<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validate
{
    /**
     * 验证字符串长度
     *
     * @param string $val 字符串名称
     * @param int $length 字符串长度  默认值30
     */
    public static function length($val, $length = 30)
    {
        if (empty($val) || !is_string($val)) {
            return false;
        }
        $count = (strlen($val) + mb_strlen($val, 'utf-8')) / 2;

        if ($count > $length) {
            return false;
        }
        return true;
    }

    /**
     * 验证是否为中文。
     * @param string $char
     * @return bool
     */
    public static function isChinese($char)
    {
        if (strlen($char) === 0) {
            return false;
        }

        return (preg_match("/^[\x7f-\xff]+$/", $char)) ? true : false;
    }

    /**
     * 验证日期时间格式。
     * -- 1、验证$value是否为$format格式。
     * -- 2、只能验证格式，不能验证时间是否正确。比如：2014-22-22
     * @param string $value 日期。
     * @param string $format 格式。格式如：Y-m-d 或H:i:s
     * @return boolean
     */
    public static function isDate($value, $format = 'Y-m-d H:i:s')
    {
        return date_create_from_format($format, $value) !== false;
    }

    /**
     * 判断是否为字母数字。
     * @param string $str
     * @return boolean
     */
    public static function isAlphaNumber($str)
    {
        return preg_match('/^([a-z0-9])+$/i', $str) ? true : false;
    }

    /**
     * 验证IP是否合法。
     * @param string $ip
     * @return bool
     */
    public static function isIp($ip)
    {
        return filter_var($ip, FILTER_VALIDATE_IP) !== false;
    }

    /**
     * 验证URL是否合法。
     * -- 合法的URL：http://www.baidu.com
     * @param string $url
     * @return bool
     */
    public static function isUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * 判断email格式是否正确。
     * @param string $email
     * @return bool
     */
    public static function isEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * 判断是否为邮政编码。
     * @param string $zipcode
     * @return boolean
     */
    public static function isZipCode($zipCode)
    {
        return preg_match('/^[1-9]\d{5}$/', $zipCode) ? true : false;
    }

    /**
     * 判断是否为手机号码。
     * @param string $mobilephone
     * @return boolean
     */
    public static function isMobilePhone($MobilePhone)
    {
        return preg_match('/^13[\d]{9}$|14^[0-9]\d{8}|^15[0-9]\d{8}$|^18[0-9]\d{8}$/', $MobilePhone) ? true : false;
    }

    /**
     * 判断是否为座机号码。
     * @param string $telphone
     * @return boolean
     */
    public static function isTelPhone($telphone)
    {
        $res = preg_match('/^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/', $telphone);

        return $res ? true : false;
    }
}