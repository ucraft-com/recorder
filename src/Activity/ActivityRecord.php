<?php

declare(strict_types = 1);

namespace Uc\Recorder\Activity;

use Uc\Recorder\Record;

use function config;

class ActivityRecord extends Record
{
    public function __construct(array $document)
    {
        parent::__construct(config('recorder.activity_index'), $document);
    }
}
