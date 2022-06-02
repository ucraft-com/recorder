<?php

declare(strict_types = 1);

namespace Uc\Recorder;

use JsonSerializable;

/**
 * Value object for representing some action that has been already happened and should be persisted somehow.
 */
class Record implements JsonSerializable
{
    /**
     * Initialize properties.
     *
     * @param string $index    Name of the Elasticsearch index where records should be accumulated.
     * @param array  $document Document that should contain the main information and stored in the Elasticsearch.
     * @param array  $params   In some cases actions can hold parameters. The parameters should be passed here.
     */
    public function __construct(
        protected string $index,
        protected array  $document,
        protected array  $params = [],
    )
    {
    }

    public function getIndex() : string
    {
        return $this->index;
    }

    public function getDocument() : array
    {
        return $this->document;
    }

    public function getParams() : array
    {
        return $this->params;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return array data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function jsonSerialize() : array
    {
        return [
            'index'    => $this->getIndex(),
            'document' => $this->getDocument(),
            'params'   => $this->getParams(),
        ];
    }
}
