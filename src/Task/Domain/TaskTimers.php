<?php


namespace TimeTracker\Task\Domain;

use Illuminate\Database\Eloquent\Collection;

class TaskTimers extends Collection
{
    protected function type(): string
    {
        return TaskTime::class;
    }
}
