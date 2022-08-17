<?php

namespace Training\VirtualTypeExample\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Verify extends Action implements HttpGetActionInterface
{

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    )
    {
        parent::__construct($context);
        $this->resultFactory = $pageFactory;
    }

    public function execute()
    {
        return $this->resultFactory->create();
    }
}
