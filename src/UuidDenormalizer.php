<?php

namespace GBProd\UuidNormalizer;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Normalizer for Uuid
 * 
 * @author gbprod <contact@gb-prod.fr>
 */
class UuidDenormalizer implements DenormalizerInterface
{
    /**
     * @inheritdoc
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (null === $data) {
            return null;
        }

        return Uuid::fromString($data);
    }

    /**
     * @inheritdoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return Uuid::class === $type 
            && $this->isValid($data)
        ;
    }

    private function isValid($data)
    {
        return $data === null
            || (is_string($data) && Uuid::isValid($data))
        ;
    }
}