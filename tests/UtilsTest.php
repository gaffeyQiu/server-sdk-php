<?php

namespace HanCloud\Tests;

use HanCloud\HanCloud;
use HanCloud\Utils;
use PHPUnit\Framework\TestCase;

class UtilsTest extends TestCase
{
    public function testCreateRand()
    {
        $rand = Utils::createRand();
        $this->assertEquals(6, strlen($rand));

        $rand = Utils::createRand(10);
        $this->assertEquals(10, strlen($rand));
    }
}