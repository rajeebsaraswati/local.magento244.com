<?php

declare(strict_types=1);

namespace Training\ProxyExample\Model\FeaturedProducts;

interface FeaturedProductsInterface
{
    public function getProducts(): array;

    public function getCount(): int;
}
