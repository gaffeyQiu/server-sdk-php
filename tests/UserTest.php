<?php

namespace HanCloud\Tests;

use HanCloud\HanCloud;
use HanCloud\User\User;
use HanCloud\Utils;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $testBaseUrl = "host.docker.internal:9506";
    private $user;


    /**
     * 判断本地服务是否开启
     * @param $url
     * @return bool
     */
    private function isServiceStart($url): bool
    {
        $ch = curl_init($url);
        curl_exec($ch);
        if(curl_error($ch)) {
            return false;
        }
        curl_close($ch);
        return true;
    }

    public function setUp()
    {
        if (!$this->isServiceStart($this->testBaseUrl)) {
            $this->markTestSkipped(
                '本地 Go 服务未开启, 跳过此次测试'
            );
        }
        $this->user = (new HanCloud("c9kqb3rdc2kgj", "JYV6cKWxNFjHNr", $this->testBaseUrl))->getUser();
    }

    public function testUser()
    {
        $this->assertNotNull($this->user);
    }


    public function testUserConfig()
    {
        $config = $this->user->getUserConfig();
        $this->assertArrayHasKey("register", $config);
        $this->assertArrayHasKey("delete", $config);
        $this->assertArrayHasKey("refresh", $config);
        $this->assertArrayHasKey("info", $config);
    }
}