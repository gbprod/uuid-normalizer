<?php

declare(strict_types=1);

namespace Tests\GBProd\UuidNormalizer\Bridge\Symfony\DependencyInjection;

use GBProd\UuidNormalizer\Bridge\Symfony\DependencyInjection\GBProdUuidNormalizerExtension;
use GBProd\UuidNormalizer\UuidDenormalizer;
use GBProd\UuidNormalizer\UuidNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class GBProdUuidNormalizerExtensionTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_services(): void
    {
        $extension = new GBProdUuidNormalizerExtension();
        $container = new ContainerBuilder();

        $extension->load([], $container);

        $this->assertTrue(
            $container->has(UuidNormalizer::class)
        );

        $this->assertInstanceOf(
            UuidNormalizer::class,
            $container->get(UuidNormalizer::class)
        );

        $this->assertTrue(
            $container->getDefinition(UuidNormalizer::class)
                ->hasTag('serializer.normalizer')
        );

        $this->assertTrue(
            $container->has(UuidDenormalizer::class)
        );

        $this->assertInstanceOf(
            UuidDenormalizer::class,
            $container->get(UuidDenormalizer::class)
        );

        $this->assertTrue(
            $container->getDefinition(UuidDenormalizer::class)
                ->hasTag('serializer.normalizer')
        );
    }
}
