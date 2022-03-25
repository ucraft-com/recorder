<?php

namespace Uc\Recorder;

enum Action: string
{
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';
}
