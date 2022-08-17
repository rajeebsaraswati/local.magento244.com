<?php

declare(strict_types=1);

namespace Training\VirtualTypeExample\Model;

use Training\VirtualTypeExample\Api\WarehouseManagementInterface;

class WarehouseManagement implements WarehouseManagementInterface
{

    public function getWarehouseInfo(string $code): array
    {
        $allWarehouses = $this->getAllWarehouses();

        if(array_key_exists($code, $allWarehouses)) {
            return $allWarehouses[$code];
        }

        return [];
    }

    protected function getAllWarehouses(): array
    {
        return [
            'lon1' => [
                'name' => 'London 1',
                'code' => 'lon1',
                'postcode' => 'ABC111'
            ],
            'lon2' => [
                'name' => 'London 2',
                'code' => 'lon2',
                'postcode' => 'ABC222'
            ],
            'lon3' => [
                'name' => 'London 3',
                'code' => 'lon3',
                'postcode' => 'ABC333'
            ]
        ];
    }
}
