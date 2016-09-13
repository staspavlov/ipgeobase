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

use PSP\IpGeoBase\Exception\IpGeoBaseException;
use PSP\IpGeoBase\Response;
use GuzzleHttp\ClientInterface;

/**
 * IpGeoBase client
 */
class IpGeoBase
{
    /**
     * Webservice URL
     *
     * @var string
     */
    protected $url = 'http://ipgeobase.ru:7020/geo?json=1&ip=%s';

    /**
     * Webservice charset
     *
     * @var string
     */
    protected $charset = 'windows-1251';

    /**
     * HTTP client
     *
     * @var ClientInterface
     */
    protected $client;

    /**
     * Constructor
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Request
     *
     * @param string $ip
     *
     * @return array
     */
    public function request($ip)
    {
        $url = sprintf($this->url, $ip);

        try {
            $res = $this->client->request('GET', $url);
        } catch (\Exception $ex) {
            throw new IpGeoBaseException('HTTP request failed', 0, $ex);
        }

        if (substr($res->getStatusCode(), 0, 1) !== '2') {
            throw new IpGeoBaseException('Unexpected HTTP status');
        }

        $body = @iconv($this->charset, 'utf-8', (string) $res->getBody());
        if (false === $body) {
            throw new IpGeoBaseException('Charset convertion failed');
        }

        $body = json_decode($body, true);
        if (null === $body) {
            throw new IpGeoBaseException('JSON decoding failed');
        }

        if (!isset($body[$ip])) {
            $msg = isset($body['message']);

            throw new IpGeoBaseException(sprintf('Server returned message "%s"', $msg));
        }

        $response = new Response();

        $map = [
            'message'  => 'setMessage',
            'inetnum'  => 'setInetnum',
            'country'  => 'setCountry',
            'city'     => 'setCity',
            'region'   => 'setRegion',
            'district' => 'setDistrict',
            'lat'      => 'setLatitude',
            'lng'      => 'setLongitude',
        ];

        foreach ($map as $attr => $setter) {
            if (isset($body[$ip][$attr])) {
                $response->$setter($body[$ip][$attr]);
            }
        }

        $response->setIp($ip);
        $response->setStatus($response->getInetnum() !== null);

        return $response;
    }
}
