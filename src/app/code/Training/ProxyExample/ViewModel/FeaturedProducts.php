<?php

declare(strict_types=1);

namespace Training\ProxyExample\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class FeaturedProducts implements ArgumentInterface
{
    private \Training\ProxyExample\Model\FeaturedProducts $featuredProducts;

    /**
     * @param \Training\ProxyExample\Model\FeaturedProducts $featuredProducts
     */
    public function __construct(
        \Training\ProxyExample\Model\FeaturedProducts $featuredProducts
    )
    {
        $this->featuredProducts = $featuredProducts;
    }

    public function getProducts(): array
    {
        return $this->featuredProducts->getFeaturedProducts();
    }
}
