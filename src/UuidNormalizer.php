<?php

namespace GBProd\UuidNormalizer;

use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalizer for Uuid
 *
 * @author gbprod <contact@gb-prod.fr>
 */
class UuidNormalizer implements NormalizerInterface
{
    /**
     * @inheritdoc
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return $object->toString();
    }

    /**
     * @inheritdoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof UuidInterface;
    }
}
