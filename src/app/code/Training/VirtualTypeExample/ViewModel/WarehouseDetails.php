<?php

declare(strict_types=1);

namespace Training\VirtualTypeExample\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Training\VirtualTypeExample\Api\WarehouseRepositoryInterface;

class WarehouseDetails implements ArgumentInterface
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
