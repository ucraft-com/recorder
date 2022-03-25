<?php

declare(strict_types = 1);

namespace Uc\Recorder\Activity;

use JsonSerializable;

final class UserAgent implements JsonSerializable
{
    public function __construct(
        protected string $browser,
        protected string $operatingSystem,
    )
    {
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
            'browser'         => $this->browser,
            'operatingSystem' => $this->operatingSystem,
        ];
    }
}
