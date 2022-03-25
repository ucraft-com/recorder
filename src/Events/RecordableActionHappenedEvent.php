<?php

declare(strict_types = 1);

namespace Uc\Recorder\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Junges\Kafka\Message\Message;
use Uc\Recorder\Record;

class RecordableActionHappenedEvent
{
    use Dispatchable;

    protected string $key;
    protected array $records;

    public function __construct(string $key, Record ...$records)
    {
        $this->key = $key;
        $this->records = $records;
    }

    public function getKafkaMessage() : Message
    {
        return $this->createKafkaMessage($this->key, ...$this->records);
    }

    protected function createKafkaMessage(string $key, Record ...$records) : Message
    {
        $message = Message::create(config('recorder.sink_topic'));

        return $message
            ->withKey($key)
            ->withBody($records);
    }
}
