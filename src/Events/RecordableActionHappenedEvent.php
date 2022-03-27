<?php

declare(strict_types = 1);

namespace Uc\Recorder\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Junges\Kafka\Message\Message;
use Uc\Recorder\Record;

use function config;

/**
 * Fire this event whenever some recordable action happened.
 */
class RecordableActionHappenedEvent
{
    use Dispatchable;

    /**
     * @var string Key of the Kafka message where the records will be stored.
     */
    protected string $key;

    /**
     * @var array|\Uc\Recorder\Record[] List of the records.
     */
    protected array $records;

    public function __construct(string $key, Record ...$records)
    {
        $this->key = $key;
        $this->records = $records;
    }

    /**
     * Get a new instance of Kafka message based on the initialized key and records.
     *
     * @return \Junges\Kafka\Message\Message
     */
    public function getKafkaMessage() : Message
    {
        return $this->createKafkaMessage($this->key, ...$this->records);
    }

    /**
     * Create a new instance of Kafka message based on the given key and records.
     *
     * @param string              $key
     * @param \Uc\Recorder\Record ...$records
     *
     * @return \Junges\Kafka\Message\Message
     */
    protected function createKafkaMessage(string $key, Record ...$records) : Message
    {
        $message = Message::create(config('recorder.sink_topic'));

        return $message
            ->withKey($key)
            ->withBody($records);
    }
}
