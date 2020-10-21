<?php

namespace HanCloud\Tests;

use HanCloud\HanCloud;
use HanCloud\User\User;
use HanCloud\Utils;
use PHPUnit\Framework\TestCase;

class TestUser extends TestCase
{
    private $user;

    public function setUp()
    {
        $this->user = (new HanCloud("c9kqb3rdc2kgj", "JYV6cKWxNFjHNr", "host.docker.internal:9506"))->getUser();
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

    public function testUserRegister()
    {
        dd($this->user->register(["user_id" => "1", "name" => "test111", "avatar" => "http://aaa.com"]));

    }
}