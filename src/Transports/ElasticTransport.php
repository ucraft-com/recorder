<?php

declare(strict_types = 1);

namespace Uc\Recorder\Transports;

use Uc\Recorder\RecordDeliveryTransportInterface;

class ElasticTransport implements RecordDeliveryTransportInterface
{
    /**
     * @var string
     */
    private string $identifier = 'elastic';

    /**
     * @var array
     */
    protected array $config;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = !empty($config) ? $config : ['index' => config('recorder.activity_index')];
    }

    /**
     * @inheritDoc
     */
    public function getIdentifier() : string
    {
        return $this->identifier;
    }

    /**
     * @inheritDoc
     */
    public function getConfig() : array
    {
        return $this->config;
    }
}
