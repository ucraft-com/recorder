<?php

declare(strict_types = 1);

namespace Uc\Recorder;

/**
 * Value object for representing some action that has been already happened and should be persisted somehow.
 */
class Record
{
    /**
     * Initialize properties.
     *
     * @param array $document   Document that should contain the main information and stored in the Elasticsearch.
     * @param array $transports Transports which should send corresponding data on the consumer end.
     */
    public function __construct(
        protected array $document,
        protected array $transports
    ) {
    }

    public function getDocument() : array
    {
        return $this->document;
    }

    public function getTransports() : array
    {
        return $this->transports;
    }
}
