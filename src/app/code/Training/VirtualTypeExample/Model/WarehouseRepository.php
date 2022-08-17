<?php

namespace Training\VirtualTypeExample\Model;

use Magento\Framework\DataObject;
use Training\VirtualTypeExample\Api\WarehouseManagementInterface;
use Training\VirtualTypeExample\Api\WarehouseRepositoryInterface;

class WarehouseRepository implements WarehouseRepositoryInterface
{

    private WarehouseManagementInterface $warehouseManagement;

    public function __construct(
        WarehouseManagementInterface $warehouseManagement
    )
    {
        $this->warehouseManagement = $warehouseManagement;
    }

    public function newWarehouse(string $code): DataObject
    {
        return new DataObject($this->warehouseManagement->getWarehouseInfo($code));
    }
}
