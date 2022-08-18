<?php

namespace Training\VirtualTypeExample\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Training\WarehouseManagement\Api\WarehouseRepositoryInterface;

class AbstractWarehouseDataProvider implements ArgumentInterface, WarehouseDataProviderInterface
{
    private WarehouseRepositoryInterface $warehouseRepository;

    public function __construct(
        WarehouseRepositoryInterface $warehouseRepository
    )
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function getWarehouseData(RequestInterface $request): DataObject
    {
        return $this->warehouseRepository->newWarehouse((string) $request->getParam('code'));
    }
}
