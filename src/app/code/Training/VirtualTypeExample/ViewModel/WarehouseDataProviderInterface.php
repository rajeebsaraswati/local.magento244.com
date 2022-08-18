<?php

namespace Training\VirtualTypeExample\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\DataObject;

interface WarehouseDataProviderInterface
{
    public function getWarehouseData(RequestInterface $request): DataObject;
}
