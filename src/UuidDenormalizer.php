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
        if (!$this->isValid($data)) {
            throw new UnexpectedValueException('Expected a valid Uuid.');
        }

        if (null === $data) {
            return null;
        }

        return Uuid::fromString($data);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return Uuid::class === $type || UuidInterface::class === $type;
    }

    /**
     * @param mixed $data
     */
    private function isValid($data): bool
    {
        return null === $data
            || (\is_string($data) && Uuid::isValid($data));
    }
}
