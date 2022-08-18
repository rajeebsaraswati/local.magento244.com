<?php

declare(strict_types=1);

namespace Training\VirtualTypeExample\Model;

use Training\WarehouseManagement\Model\WarehouseManagement;

class WarehouseManagementExtended extends WarehouseManagement
{
    protected function getAllWarehouses(): array
    {
        $extra = [
            'mon1' => [
                'name' => 'Manchester 1',
                'code' => 'mon1',
                'postcode' => 'NM111'
            ],
            'mon2' => [
                'name' => 'Manchester 2',
                'code' => 'mon2',
                'postcode' => 'NM222'
            ],
            'mon3' => [
                'name' => 'Manchester 3',
                'code' => 'mon3',
                'postcode' => 'NM333'
            ]
        ];
        return $extra + parent::getAllWarehouses();
    }
}
