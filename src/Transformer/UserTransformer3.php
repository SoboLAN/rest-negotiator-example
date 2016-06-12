<?php

namespace SoboLAN\RestNegotiatorExampleBundle\Transformer;

use SoboLAN\RestNegotiatorExampleBundle\Entity\User;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use SoboLAN\RestNegotiator\Transformers\SerializedClassInterface;

class UserTransformer3 implements NormalizerInterface, SerializedClassInterface
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
        return [
            'name' => $object->getName(),
            'email' => $object->getEmail(),
            'age' => $object->getAge()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return ($data instanceof User);
    }
}
