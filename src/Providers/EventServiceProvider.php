<?php

declare(strict_types = 1);

namespace Uc\Recorder\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Uc\Recorder\Events\RecordableActionHappenedEvent;
use Uc\Recorder\Listeners\ProduceRecordableListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array The event handler mappings for the application.
     */
    protected $listen = [
        RecordableActionHappenedEvent::class => [
            ProduceRecordableListener::class,
        ],
    ];
}
