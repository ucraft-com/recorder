<?php

declare(strict_types = 1);

namespace Uc\Recorder\Transports;

use RuntimeException;
use Uc\Recorder\RecordDeliveryTransportInterface;

/**
 * Transport for delivering records to Elasticsearch.
 */
class ElasticTransport implements RecordDeliveryTransportInterface
{
    /**
     * @var string
     */
    protected string $identifier = 'elasticsearch';

    /**
     * @var array
     */
    protected array $config;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!empty($config) && !isset($config['index'])) {
            throw new RuntimeException('Elastic Transport requires an "index" key of the Elasticsearch index in its configuration.');
        }

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
