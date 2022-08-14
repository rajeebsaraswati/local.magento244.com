<?php

declare(strict_types=1);

namespace Training\EventsLogger\Plugin;

use Magento\Framework\Event\Manager as EventManager;
use Magento\Framework\Serialize\Serializer\Json as JsonSerializer;

class Logger
{

//    private static $eventsData = [];

    private JsonSerializer $jsonSerializer;

    public function __construct(
        JsonSerializer $jsonSerializer
    )
    {
        $this->jsonSerializer = $jsonSerializer;
    }

    public function beforeDispatch(
        EventManager $subject,
        $eventName,
        array $data = []
    ): void
    {
//        self::$eventsData[$eventName]
        $event = $eventName . ':' . $this->jsonSerializer->serialize($this->getData($data));
        consoleLog("Events Fired On The Page", ["event" => $event]);
    }

    private function getData(array $data): array
    {
        $dispatchedData = [];

        foreach ($data as $key => $value) {
            if (is_object($value)) {
                $dispatchedData[] = $key . ':' . get_class($value);
            }
            if (is_scalar($value)) {
                $dispatchedData[] = $key . ':' . $value;
            }
            if (is_array($value)) {
                $dispatchedData[] = $this->getData($value);
            }
        }

        return  $dispatchedData;
    }
}
