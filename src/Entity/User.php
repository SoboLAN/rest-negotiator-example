<?php
namespace SoboLAN\RestNegotiatorExampleBundle\Entity;

class User
{
    const CLASS_NAME = __CLASS__;

    private $name;
    private $email;
    private $age;

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }
}
