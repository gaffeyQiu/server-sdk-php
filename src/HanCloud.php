<?php
namespace HanCloud;

use GuzzleHttp\Psr7\Request;
use HanCloud\User\User;

class HanCloud
{
    /**
     * @var string
     */
    public static $appKey;

    /**
     * @var string
     */
    public static $appSecret;


    public static $baseUrl = "http://127.0.0.1:9506";

    /**
     * @var User
     */
    public $user;

    public function __construct($appKey , $appSecret, $baseUrl = "")
    {
        self::$appKey = $appKey;
        self::$appSecret = $appSecret;
        if ($baseUrl) {
            self::$baseUrl = $baseUrl;
        }
        $this->user = new User();
    }

    public function getUser() {
        return $this->user;
    }
}