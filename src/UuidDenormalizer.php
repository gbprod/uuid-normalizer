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
     * {@inheritdoc}
     *
     * @param array<mixed> $context
     *
     * @throws UnexpectedValueException
     *
     * @return UuidInterface|null
     */
    public function denormalize($data, $type, $format = null, array $context = [])
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
     * {@inheritdoc}
     *
     * @param array<mixed> $context
     */
    public function supportsDenormalization($data, string $type, string $format = null, array $context = [])
    {
        return Uuid::class === $type || UuidInterface::class === $type;
    }
}
