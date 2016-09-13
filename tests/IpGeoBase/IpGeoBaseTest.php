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

use PSP\IpGeoBase\IpGeoBase;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Psr7\Response;

/**
 * @group client
 */
class IpGeoBaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException PSP\IpGeoBase\Exception\IpGeoBaseException
     */
    public function testRequestHttpFailed()
    {
        $http = $this->getMockBuilder(Client::class)
            ->setMethods(['request'])
            ->disableOriginalConstructor()
            ->getMock();

        $ex = $this->getMockBuilder(TransferException::class)
            ->disableOriginalConstructor()
            ->getMock();

        $http->expects($this->once())
            ->method('request')
            ->will($this->throwException($ex));

        $geo = new IpGeoBase($http);
        $geo->request('192.168.0.1');
    }

    /**
     * @expectedException PSP\IpGeoBase\Exception\IpGeoBaseException
     */
    public function testRequestHttpNotOK()
    {
        $http = $this->getMockBuilder(Client::class)
            ->setMethods(['request'])
            ->disableOriginalConstructor()
            ->getMock();

        $res = new Response(404);

        $http->expects($this->once())
            ->method('request')
            ->will($this->returnValue($res));

        $geo = new IpGeoBase($http);
        $geo->request('192.168.0.1');
    }

    /**
     * @expectedException PSP\IpGeoBase\Exception\IpGeoBaseException
     */
    public function testRequestHttpInvalidJSON()
    {
        $http = $this->getMockBuilder(Client::class)
            ->setMethods(['request'])
            ->disableOriginalConstructor()
            ->getMock();

        $res = new Response(200, [], 'not a JSON');

        $http->expects($this->once())
            ->method('request')
            ->will($this->returnValue($res));

        $geo = new IpGeoBase($http);
        $geo->request('192.168.0.1');
    }

    /**
     * @expectedException PSP\IpGeoBase\Exception\IpGeoBaseException
     */
    public function testRequestNegative()
    {
        $http = $this->getMockBuilder(Client::class)
            ->setMethods(['request'])
            ->disableOriginalConstructor()
            ->getMock();

        $res = new Response(200, [], json_encode([
            'message' => 'test'
        ]));

        $http->expects($this->once())
            ->method('request')
            ->will($this->returnValue($res));

        $geo = new IpGeoBase($http);
        $geo->request('192.168.0.1');
    }

    public function testRequestPositiveNoResult()
    {
        $http = $this->getMockBuilder(Client::class)
            ->setMethods(['request'])
            ->disableOriginalConstructor()
            ->getMock();

        $res = new Response(200, [], json_encode([
            '192.168.0.1' => [
                'message' => 'test'
            ],
        ]));

        $http->expects($this->once())
            ->method('request')
            ->will($this->returnValue($res));

        $geo = new IpGeoBase($http);
        $r = $geo->request('192.168.0.1');

        $this->assertFalse($r->getStatus());
        $this->assertEquals('test', $r->getMessage());
        $this->assertEquals('192.168.0.1', $r->getIp());
        $this->assertNull($r->getInetnum());
        $this->assertNull($r->getCountry());
        $this->assertNull($r->getCity());
        $this->assertNull($r->getRegion());
        $this->assertNull($r->getDistrict());
        $this->assertNull($r->getLatitude());
        $this->assertNull($r->getLongitude());
    }

    public function testRequestPositiveWithResult()
    {
        $http = $this->getMockBuilder(Client::class)
            ->setMethods(['request'])
            ->disableOriginalConstructor()
            ->getMock();

        $res = new Response(200, [], json_encode([
            '192.168.0.1' => [
                'inetnum'  => 'test1',
                'country'  => 'test2',
                'city'     => 'test3',
                'region'   => 'test4',
                'district' => 'test5',
                'lat'      => 'test6',
                'lng'      => 'test7',
            ],
        ]));

        $http->expects($this->once())
            ->method('request')
            ->will($this->returnValue($res));

        $geo = new IpGeoBase($http);
        $r = $geo->request('192.168.0.1');

        $this->assertTrue($r->getStatus());
        $this->assertNull($r->getMessage());
        $this->assertEquals('192.168.0.1', $r->getIp());
        $this->assertEquals('test1', $r->getInetnum());
        $this->assertEquals('test2', $r->getCountry());
        $this->assertEquals('test3', $r->getCity());
        $this->assertEquals('test4', $r->getRegion());
        $this->assertEquals('test5', $r->getDistrict());
        $this->assertEquals('test6', $r->getLatitude());
        $this->assertEquals('test7', $r->getLongitude());
    }
}