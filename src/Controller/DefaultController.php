<?php

namespace SoboLAN\RestNegotiatorExampleBundle\Controller;

use SoboLAN\RestNegotiatorExampleBundle\Entity\User;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use SoboLAN\RestNegotiator\Negotiator\RestNegotiator;
use SoboLAN\RestNegotiator\Representation\EntityRepresentation;

class DefaultController
{
    private $negotiator;

    public function __construct(RestNegotiator $negotiator)
    {
        $this->negotiator = $negotiator;
    }

    public function getAction(Request $request)
    {
        $user = new User();
        $user->setName('sobolan');
        $user->setEmail('radu.murzea@gmail.com');
        $user->setAge(12345);

        return $this->negotiator->getResponse(new EntityRepresentation($user), Response::HTTP_OK);
    }

    public function createAction(Request $request)
    {
        /* @var $userObject User */
        $userObject = $this->negotiator->getDeserialized(User::CLASS_NAME);

        $text = sprintf(
            'Created user object with name=%s, email=%s, age=%d',
            is_null($userObject->getName()) ? 'N/A' : $userObject->getName(),
            is_null($userObject->getEmail()) ? 'N/A' : $userObject->getEmail(),
            is_null($userObject->getAge()) ? 'N/A' : $userObject->getAge()
        );

        return new Response($text, Response::HTTP_CREATED);
    }
}
