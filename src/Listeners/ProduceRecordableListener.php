<?php

declare(strict_types = 1);

namespace Uc\Recorder\Listeners;

use Uc\KafkaProducer\Events\ProduceMessageEvent;
use Uc\Recorder\Events\RecordableActionHappenedEvent;
use Illuminate\Events\Dispatcher;

/**
 * Listens for recordable events and stores them in the Kafka topics.
 *
 * @see \Uc\Recorder\Events\RecordableActionHappenedEvent
 */
class ProduceRecordableListener
{
    /**
     * Initialize properties.
     *
     * @param \Illuminate\Events\Dispatcher $dispatcher Reference on the instance of Event dispatcher.
     */
    public function __construct(
        protected Dispatcher $dispatcher
    )
    {
    }

    /**
     * Handle the event.
     *
     * Fire a new ProduceMessageEvent event with the appropriate Kafka message.
     *
     * @param \Uc\Recorder\Events\RecordableActionHappenedEvent $event
     *
     * @return void
     */
    public function handle(RecordableActionHappenedEvent $event) : void
    {
        $this->dispatcher->dispatch(
            new ProduceMessageEvent($event->getKafkaMessage())
        );
    }
}
