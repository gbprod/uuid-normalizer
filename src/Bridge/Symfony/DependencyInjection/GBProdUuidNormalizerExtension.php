<?php

declare(strict_types=1);

namespace GBProd\UuidNormalizer\Bridge\Symfony\DependencyInjection;

use GBProd\UuidNormalizer\UuidDenormalizer;
use GBProd\UuidNormalizer\UuidNormalizer;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class GBProdUuidNormalizerExtension extends Extension
{
    /**
     * @param mixed[] $configs
     *
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $container
            ->register(UuidNormalizer::class, UuidNormalizer::class)
            ->addTag('serializer.normalizer');

        $container
            ->register(UuidDenormalizer::class, UuidDenormalizer::class)
            ->addTag('serializer.normalizer');
    }
}
