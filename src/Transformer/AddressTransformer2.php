<?php

namespace SoboLAN\RestNegotiatorExampleBundle\Transformer;

use SoboLAN\RestNegotiatorExampleBundle\Entity\Address;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use SoboLAN\RestNegotiator\Transformers\SerializedClassInterface;

class AddressTransformer2 implements NormalizerInterface, DenormalizerInterface, SerializedClassInterface
{
    /**
     * {@inheritdoc}
     */
    public function getSerializedClass()
    {
        return Address::CLASS_NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return [
            'street' => $object->getStreet(),
            'city' => $object->getCity(),
            'country' => $object->getCountry()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return ($data instanceof Address);
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $nullData = [
            'street' => null,
            'city' => null,
            'country' => null
        ];

        $values = array_merge($nullData, $data);

        $address = new Address();
        $address->setStreet($values['street']);
        $address->setCity($values['city']);
        $address->setCountry($values['country']);

        return $address;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return ($type == Address::CLASS_NAME);
    }
}
