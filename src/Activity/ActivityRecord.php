<?php

declare(strict_types = 1);

namespace Uc\Recorder\Activity;

use Uc\Recorder\Record;

use function config;

/**
 * Record for representing runtime activities.
 */
class ActivityRecord extends Record
{
    public function __construct(array $document)
    {
        parent::__construct(config('recorder.activity_index'), $document);
    }

    public function jsonSerialize() : array
    {
        $serialized = parent::jsonSerialize();

        if (isset($serialized['document']['dateTime'])) {
            /** @var \DateTimeImmutable $dateTime */
            $dateTime = $serialized['document']['dateTime'];
            $serialized['document']['dateTime'] = $dateTime->format('Y-m-d H:i:s');
        }

        return $serialized;
    }
}
