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
     * @param string              $index    Name of the Elasticsearch index where records should be accumulated.
     * @param array               $document Document that should contain the main information and stored in the
     *                                      Elasticsearch.
     * @param string              $project  Name of the project where the record was created.
     * @param \Uc\Recorder\Action $action   Action that should be applied to the document through the Elasticsearch.
     * @param array               $params   In some cases actions can hold parameters. The parameters should be passed
     *                                      here.
     */
    public function __construct(
        protected string $index,
        protected string $project,
        protected array  $document,
        protected Action $action = Action::CREATE,
        protected array  $params = [],
    )
    {
    }

    public function getIndex() : string
    {
        return $this->index;
    }

    public function getProject() : string
    {
        return $this->project;
    }

    public function getDocument() : array
    {
        return $this->document;
    }

    public function getAction() : Action
    {
        return $this->action;
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
            'project'  => $this->getProject(),
            'document' => $this->getDocument(),
            'action'   => $this->getAction(),
            'params'   => $this->getParams(),
        ];
    }
}
