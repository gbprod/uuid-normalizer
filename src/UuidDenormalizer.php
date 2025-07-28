<?php

declare(strict_types=1);

namespace GBProd\UuidNormalizer;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Normalizer for Uuid.
 */
class UuidDenormalizer implements DenormalizerInterface
{
    /**
     * @param array<mixed> $context
     *
     * @throws UnexpectedValueException
     */
    public function denormalize($data, string $type, ?string $format = null, array $context = []): ?UuidInterface
    {
        if (null === $data) {
            return null;
        }

        if (!\is_string($data) || !Uuid::isValid($data)) {
            throw new UnexpectedValueException('Expected a valid Uuid.');
        }

        return Uuid::fromString($data);
    }

    /**
     * @param array<mixed> $context
     */
    public function supportsDenormalization($data, string $type, ?string $format = null, array $context = []): bool
    {
        return is_a($type, UuidInterface::class, true);
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
