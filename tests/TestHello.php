<?php
namespace HanCloud\Tests;

use HanCloud\HanCloud;
use PHPUnit\Framework\TestCase;

class HanCloudTest extends TestCase
{
    public function testHello()
    {
        $HanCloud = new HanCloud();
        $echo = $HanCloud->echoHello();
        $this->assertSame("Hello HanCloud", $echo);
    }
}


