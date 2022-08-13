<?php

declare(strict_types=1);

namespace Training\ProxyExample\Model\FeaturedProducts;

class FeaturedByCategory implements FeaturedProductsInterface
{
    private $featuredProducts = [];

    public function __construct()
    {
        $this->loadProducts();
    }

    public function getProducts(): array
    {
        return $this->featuredProducts;
    }

    public function getCount(): int
    {
        return count($this->featuredProducts);
    }

    protected function loadProducts(): void
    {
        $this->featuredProducts = [
            'category product 1',
            'category product 2',
            'category product 3',
            'category product 4',
            'category product 5',
            'category product 6',
            'category product 7',
        ];
    }
}
