<?php
namespace HanCloud;

use GuzzleHttp\Client;

class Utils
{
    /**
     * 获取随机数
     * @param int $len
     * @return string
     */
    public static function createRand($len = 6)
    {
        $string = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $result = '';
        $string = str_shuffle($string);
        for ($i = 0; $i < $len; $i++) {
            $result .= $string[mt_rand(0, strlen($string) - 1)];
        }
        return $result;
    }

    /**
     * 签名
     * @param string $secret
     * @return array
     */
    public static function signature(string $secret): array
    {
        srand((double)microtime()*1000000);
        $nonce = self::createRand(); // 获取随机数。
        $timestamp = time()*1000; // 获取时间戳（毫秒）。
        $signature = sha1($secret.$nonce.$timestamp);
        return [$nonce, $timestamp, $signature];
    }
}