<?php

declare(strict_types=1);

namespace Training\FirePhp\Model;

use Monolog\Handler\FirePHPHandler;
use Psr\Log\LoggerInterface;

class Logger
{
    private \Monolog\Logger $logger;

    public function __construct(\Monolog\LoggerFactory $loggerFactory)
    {
        $this->logger = $loggerFactory->create([
            'name' => 'fire_php',
            'handlers' => [new FirePHPHandler()]
        ]);
    }

    /**
     * @return \Monolog\Logger
     */
    public function getLogger(): \Monolog\Logger
    {
        return $this->logger;
    }

    public function debug(string $message, array $context = []): void
    {
        $this->getLogger()->debug($message, $context);
    }
}
