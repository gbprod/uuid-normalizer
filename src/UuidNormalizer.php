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
     * @param array<string, mixed> $context
     */
    public function normalize(mixed $data, ?string $format = null, array $context = []): string
    {
        if (!$data instanceof UuidInterface) {
            throw new \InvalidArgumentException('Expected a UuidInterface.');
        }

        return $data->toString();
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
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
