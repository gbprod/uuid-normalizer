<?php

declare(strict_types=1);

namespace GBProd\UuidNormalizer;

use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalizer for Uuid.
 */
class UuidNormalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     *
     * @param array<mixed> $context
     *
     * @return string
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return $object->toString();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return $data instanceof UuidInterface;
    }
}
