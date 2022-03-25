<?php

declare(strict_types = 1);

namespace Uc\Recorder;

use JsonSerializable;

class Record implements JsonSerializable
{
    /**
     * @param string              $index
     * @param array               $document
     * @param \Uc\Recorder\Action $action
     * @param array               $params
     */
    public function __construct(
        protected string $index,
        protected array  $document,
        protected Action $action = Action::CREATE,
        protected array  $params = [],
    )
    {
    }

    /**
     * @return string
     */
    public function getIndex() : string
    {
        return $this->index;
    }

    /**
     * @return array
     */
    public function getDocument() : array
    {
        return $this->document;
    }

    /**
     * @return \Uc\Recorder\Action
     */
    public function getAction() : Action
    {
        return $this->action;
    }

    /**
     * @return array
     */
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
            'action'   => $this->getAction(),
            'params'   => $this->getParams(),
        ];
    }
}
