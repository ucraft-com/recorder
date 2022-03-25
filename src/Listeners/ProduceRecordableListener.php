<?php

declare(strict_types = 1);

namespace Uc\Recorder\Listeners;

use Uc\KafkaProducer\Events\ProduceMessageEvent;
use Uc\Recorder\Events\RecordableActionHappenedEvent;
use Illuminate\Events\Dispatcher;

class ProduceRecordableListener
{
    public function __construct(
        protected Dispatcher $dispatcher
    )
    {
    }

    public function handle(RecordableActionHappenedEvent $event) : void
    {
        $this->dispatcher->dispatch(
            new ProduceMessageEvent($event->getKafkaMessage())
        );
    }
}
