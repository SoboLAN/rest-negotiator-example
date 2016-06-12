<?php

namespace SoboLAN\RestNegotiatorExampleBundle\Entity;

class Address
{
    const CLASS_NAME = __CLASS__;

    private $street;
    private $nr;
    private $city;
    private $country;

    public function getStreet()
    {
        return $this->street;
    }

    public function getNr()
    {
        return $this->nr;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function setNr($nr)
    {
        $this->nr = $nr;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }
}
