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

/**
 * IpGeoBase response
 */
class Response
{
    /**
     * IP address
     *
     * @var string
     */
    protected $ip;

    /**
     * Status
     *
     * @var boolean
     */
    protected $status;

    /**
     * Message
     *
     * @var string
     */
    protected $message;

    /**
     * Inetnum
     *
     * @var string
     */
    protected $inetnum;

    /**
     * Country
     *
     * @var string
     */
    protected $country;

    /**
     * City
     *
     * @var string
     */
    protected $city;

    /**
     * Region
     *
     * @var string
     */
    protected $region;

    /**
     * District
     *
     * @var string
     */
    protected $district;

    /**
     * Latitude
     *
     * @var string
     */
    protected $latitude;

    /**
     * Longitude
     *
     * @var string
     */
    protected $longitude;

    /**
     * Get IP address
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set IP address
     *
     * @param string $ip
     *
     * @return Response
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Response
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Response
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get inetnum
     *
     * @return string
     */
    public function getInetnum()
    {
        return $this->inetnum;
    }

    /**
     * Set inetnum
     *
     * @param string $inetnum
     *
     * @return Response
     */
    public function setInetnum($inetnum)
    {
        $this->inetnum = $inetnum;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Response
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Response
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Response
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set district
     *
     * @param string $district
     *
     * @return Response
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Response
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Response
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }
}
