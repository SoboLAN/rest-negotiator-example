<?php

namespace SoboLAN\RestNegotiatorExampleBundle\Transformer;

use SoboLAN\RestNegotiatorExampleBundle\Entity\User;
use SoboLAN\RestNegotiatorExampleBundle\Entity\Address;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;
use SoboLAN\RestNegotiator\Transformers\SerializedClassInterface;

class UserTransformer2 implements
    NormalizerInterface,
    DenormalizerInterface,
    SerializedClassInterface,
    SerializerAwareInterface
{
    private $serializer;

    /**
     * {@inheritdoc}
     */
    public function setSerializer(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

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
        return [
            'name' => $object->getName(),
            'email' => $object->getEmail(),
            'age' => $object->getAge(),
            'address' => $this->serializer->normalize($object->getAddress(), $format, $context)
        ];
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

        if (isset($data['address'])) {
            $address = $this->serializer->denormalize($data['address'], Address::CLASS_NAME, $format, $context);

            $userObject->setAddress($address);
        }

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
