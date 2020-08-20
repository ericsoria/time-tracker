<?php


namespace TimeTracker\Task\Domain;

use Illuminate\Database\Eloquent\Collection;

class Tasks extends Collection
{
    protected function type(): string
    {
        return Task::class;
    }
}
