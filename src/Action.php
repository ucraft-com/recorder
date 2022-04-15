<?php

declare(strict_types = 1);

namespace Uc\Recorder;

use InvalidArgumentException;

/**
 * Enumeration of available Elasticsearch actions.
 */
class Action
{
    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';

    /**
     * Assert if given value is one of the constants defined here.
     *
     * @param string $value
     *
     * @return void
     */
    public static function assert(string $value) : void
    {
        assert(
            in_array($value, [
                self::CREATE,
                self::UPDATE,
                self::DELETE,
            ]),
            new InvalidArgumentException(
                sprintf('Invalid constant value was given: %s', $value)
            )
        );
    }
}
