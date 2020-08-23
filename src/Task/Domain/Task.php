<?php

declare(strict_types = 1);

namespace TimeTracker\Task\Domain;

use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskName;

class Task
{

    private TaskId $id;
    private TaskName $name;
    private TaskTimers $taskTimers;

    public function __construct(TaskId $id, TaskName $name, TaskTimers $taskTimers)
    {
        $this->id        = $id;
        $this->name      = $name;
        $this->taskTimers = $taskTimers;
    }

    public static function create(TaskId $id, TaskName $name): Task
    {
        return new self(
            $id,
            $name,
            new TaskTimers([])
        );
    }

    public function id(): TaskId
    {
        return $this->id;
    }

    public function name(): TaskName
    {
        return $this->name;
    }

    public function taskTimers(): TaskTimers
    {
        return $this->taskTimers;
    }

    public function toArray()
    {
        return [
            'id' => $this->id()->value(),
            'name' => $this->name()->value(),
            'task_timers' => $this->taskTimers()->map( function($taskTimers) {
                return $taskTimers->toArray();
            })
        ];
    }

}
