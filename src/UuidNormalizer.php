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
     * @param array<mixed> $context
     */
    public function normalize($object, $format = null, array $context = []): string
    {
        if (!$object instanceof UuidInterface) {
            throw new \InvalidArgumentException('Expected a UuidInterface.');
        }

        return $object->toString();
    }

    /**
     * @param array<mixed> $context
     */
    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return $data instanceof UuidInterface;
    }

    /**
     * @return array<string, bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            UuidInterface::class => true,
        ];
    }
}
