<?php

declare(strict_types=1);

namespace Training\CategoryTitle\Setup\Patch\Data;

use Magento\Catalog\Model\Category;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddHideTitleAttribute implements DataPatchInterface
{

    private EavSetupFactory $eavSetupFactory;
    private ModuleDataSetupInterface $moduleDataSetup;

    public function __construct(
        EavSetupFactory $eavSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(Category::ENTITY, 'hide_title', [
            'type' => 'int',
            'label' => 'Hide Title',
            'input' => 'boolean',
            'source' => Boolean::class,
            'visible' => true,
            'default' => '0',
            'required' => false,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'Display Settings'
        ]);
    }
}
