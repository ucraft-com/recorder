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
    public function __construct(string $project, array $document)
    {
        parent::__construct(config('recorder.activity_index'), $project, $document);
    }
}
