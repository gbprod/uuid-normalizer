<?php

declare(strict_types=1);

namespace GBProd\UuidNormalizer;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Normalizer for Uuid
 *
 * @author gbprod <contact@gb-prod.fr>
 */
class UuidDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     *
     * @param array<mixed> $context
     *
     * @return UuidInterface|null
     *
     * @throws UnexpectedValueException
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
    public function supportsDenormalization($data, $type, $format = null)
    {
        return (Uuid::class === $type || UuidInterface::class === $type);
    }

    /**
     * @param mixed $data
     */
    private function isValid($data): bool
    {
        return $data === null
            || (is_string($data) && Uuid::isValid($data));
    }
}
