<?php

namespace HanCloud\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use HanCloud\HanCloud;
use HanCloud\Request;
use \GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    protected $hanCloud;
    protected $mockKey = "root";
    protected $mockSecret = "123456";

    protected function setUp()
    {
        $this->hanCloud = new HanCloud($this->mockKey, $this->mockSecret);
    }

    /**
     * 测试 HanCloud 对象是否 提前建立了
     */
    public function testMockHanCloud()
    {
        $hanCloud = $this->hanCloud;
        $this->assertNotNull($hanCloud);
        $this->assertEquals($this->mockKey, $hanCloud::$appKey);
        $this->assertEquals($this->mockSecret, $hanCloud::$appSecret);
        $this->assertNotEmpty($hanCloud::$baseUrl);
    }

    public function testGet()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar']),
            new Response(202, ['Content-Length' => 0]),
        ]);
        $handler = HandlerStack::create($mock);
        $request = new Request($handler);
        $this->assertEquals(200, $request->get("/")->getStatusCode());
        $this->assertEquals(202, $request->get("/")->getStatusCode());
    }


    public function testPost()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar']),
            new Response(202, ['Content-Length' => 0]),
        ]);
        $handler = HandlerStack::create($mock);
        $request = new Request($handler);
        $this->assertEquals(200, $request->post("/", [])->getStatusCode());
        $this->assertEquals(202, $request->post("/", [])->getStatusCode());
    }
}