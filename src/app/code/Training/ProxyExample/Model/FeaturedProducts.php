<?php

declare(strict_types=1);

namespace Training\ProxyExample\Model;

use Training\ProxyExample\Model\FeaturedProducts\FeaturedByCategory;
use Training\ProxyExample\Model\FeaturedProducts\FeaturedBySales;

class FeaturedProducts
{
    private FeaturedByCategory $featuredByCategory;
    private FeaturedBySales $featuredBySales;

    public function __construct(
        FeaturedByCategory $featuredByCategory,
        FeaturedBySales $featuredBySales
    )
    {
        $this->featuredByCategory = $featuredByCategory;
        $this->featuredBySales = $featuredBySales;
    }

    public function getFeaturedProducts(): array
    {
        if ($this->featuredByCategory->getCount() < 6) {
            return $this->featuredBySales->getProducts();
        }
        return $this->featuredByCategory->getProducts();
    }
}
