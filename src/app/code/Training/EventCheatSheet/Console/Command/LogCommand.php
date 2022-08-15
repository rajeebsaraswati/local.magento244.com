<?php

declare(strict_types=1);

namespace Training\EventCheatSheet\Console\Command;

use Magento\Framework\Event\Config\Reader as EventConfigReader;
use Magento\Framework\Filesystem\Io\File as FileAdapter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LogCommand extends Command
{
    private EventConfigReader $eventConfigReader;
    private FileAdapter $fileAdapter;

    public function __construct(
        EventConfigReader $eventConfigReader,
        FileAdapter $fileAdapter,
        string $name = null
    )
    {
        parent::__construct(null);

        $this->eventConfigReader = $eventConfigReader;
        $this->fileAdapter = $fileAdapter;
    }

    protected function configure()
    {
        parent::configure();
        $this->setName('training:events:log');
        $this->setDescription('Logs observer events.');

        $this->addArgument('scope', InputArgument::OPTIONAL, 'Magento application execution Area');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $areas = ['global', 'adminhtml', 'frontend', 'webapi_rest', 'webapi_soap', 'graphql'];
        $scope = $input->getArgument('scope');
        if (in_array($scope, $areas)) {
            $areas = [$scope];
        }

        $events = [];
        foreach ($areas as $scope) {
            $data = $this->eventConfigReader->read($scope);
            $events[] = $data;
        }

        $this->fileAdapter->write(
            'var/log/events.json',
            json_encode($events, JSON_PRETTY_PRINT)
        );
    }
}
