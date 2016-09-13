<?php

/*
 * This file is part of the IpGeoBase package.
 *
 * (c) Stanislav Pavlov <mail@staspavlov.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PSP\IpGeoBase;

use PSP\IpGeoBase\Response;

/**
 * @group response
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testMethods()
    {
        $r = new Response();

        $this->assertNull($r->getIp());
        $this->assertNull($r->getStatus());
        $this->assertNull($r->getMessage());
        $this->assertNull($r->getInetnum());
        $this->assertNull($r->getCountry());
        $this->assertNull($r->getCity());
        $this->assertNull($r->getRegion());
        $this->assertNull($r->getDistrict());
        $this->assertNull($r->getLatitude());
        $this->assertNull($r->getLongitude());

        $r->setIp('test1');
        $r->setStatus('test2');
        $r->setMessage('test3');
        $r->setInetnum('test4');
        $r->setCountry('test5');
        $r->setCity('test6');
        $r->setRegion('test7');
        $r->setDistrict('test8');
        $r->setLatitude('test9');
        $r->setLongitude('test10');

        $this->assertEquals('test1', $r->getIp());
        $this->assertEquals('test2', $r->getStatus());
        $this->assertEquals('test3', $r->getMessage());
        $this->assertEquals('test4', $r->getInetnum());
        $this->assertEquals('test5', $r->getCountry());
        $this->assertEquals('test6', $r->getCity());
        $this->assertEquals('test7', $r->getRegion());
        $this->assertEquals('test8', $r->getDistrict());
        $this->assertEquals('test9', $r->getLatitude());
        $this->assertEquals('test10', $r->getLongitude());
    }
}
