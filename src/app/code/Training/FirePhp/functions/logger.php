<?php

declare(strict_types=1);

if(!function_exists('consoleLog')) {

    /**
     * does not work with full page cache enabled
     * you need to clear cache on each reload
     * recommend on developer mode
     *
     * @param string $message
     * @param array $context
     */
    function consoleLog(string $message, array $context = []): void
    {
        \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Training\FirePhp\Model\Logger::class)
            ->debug($message, $context);
    }
}
