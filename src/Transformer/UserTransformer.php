<?php

namespace SoboLAN\RestNegotiatorExampleBundle\Transformer;

use SoboLAN\RestNegotiatorExampleBundle\Entity\User;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use SoboLAN\RestNegotiator\Transformers\SerializedClassInterface;

class UserTransformer implements NormalizerInterface, DenormalizerInterface, SerializedClassInterface
{
    /**
     * {@inheritdoc}
     */
    public function getSerializedClass()
    {
        return User::CLASS_NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return array(
            'name' => $object->getName(),
            'email' => $object->getEmail(),
            'age' => $object->getAge()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return ($data instanceof User);
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $nullData = array(
            'name' => null,
            'email' => null,
            'age' => null
        );

        $values = array_merge($nullData, $data);

        $userObject = new User();
        $userObject->setName($values['name']);
        $userObject->setEmail($values['email']);
        $userObject->setAge($values['age']);

        return $userObject;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return ($type == User::CLASS_NAME);
    }
}
