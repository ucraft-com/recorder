<?php

namespace Uc\Recorder;

/**
 * Enumeration of available Elasticsearch actions.
 */
enum Action: string
{
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';
}
