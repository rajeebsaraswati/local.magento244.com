<?php

declare(strict_types=1);

namespace Training\ProxyExample\Model\FeaturedProducts;

class FeaturedBySales implements FeaturedProductsInterface
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
            'sales product 1',
            'sales product 2',
            'sales product 3',
            'sales product 4',
            'sales product 5',
            'sales product 6',
            'sales product 7',
        ];
    }
}
