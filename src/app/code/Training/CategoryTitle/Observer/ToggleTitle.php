<?php

namespace Training\CategoryTitle\Observer;

use Magento\Catalog\Model\Layer\Resolver;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Element\AbstractBlock;

class ToggleTitle implements ObserverInterface
{

    private Resolver $resolver;

    public function __construct(
        Resolver $resolver
    )
    {
        $this->resolver = $resolver;
    }

    public function execute(Observer $observer)
    {
        /** @var AbstractBlock $block */
        $block = $observer->getBlock();
        $fullActionName = $block->getRequest()->getFullActionName();
        $blockName = $block->getNameInLayout();
        $category = $this->resolver->get()->getCurrentCategory();

        if ($fullActionName === 'catalog_category_view' &&
            $blockName === 'page.main.title' &&
            ((bool) $category->getHideTitle()) === true
        ) {
            $cssClass = $block->getCssClass()
                ? $block->getCssClass() . ' ' . 'category-title-hidden'
                : 'category-title-hidden';
            $block->setCssClass($cssClass);
        }
    }
}
