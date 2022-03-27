<?php

declare(strict_types = 1);

namespace Uc\Recorder\Activity;

use JsonSerializable;

/**
 * Value object for representing UserAgent data.
 */
final class UserAgent implements JsonSerializable
{
    /**
     * Initialize properties.
     *
     * @param string $browser Name and version of the browser.
     * @param string $operatingSystem Name and version of the operating system.
     */
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
