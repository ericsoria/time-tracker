<?php

declare(strict_types = 1);

namespace TimeTracker\Task\Domain;

use TimeTracker\Task\Domain\ValueObjects\DateTime;
use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskName;

class Task
{
    private TaskId $id;
    private TaskName $name;
    private DateTime $dateTime;
    private TaskTimers $taskTimers;

    public function __construct(TaskId $id, TaskName $name, DateTime $dateTime, TaskTimers $taskTimers)
    {
        $this->id        = $id;
        $this->name      = $name;
        $this->dateTime  = $dateTime;
        $this->taskTimers = $taskTimers;
    }

    public static function create(TaskId $id, TaskName $name, DateTime $dateTime): Task
    {
        return new self(
            $id,
            $name,
            $dateTime,
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

    public function dateTime(): DateTime
    {
        return $this->dateTime;
    }

    public function taskTimers(): TaskTimers
    {
        return $this->taskTimers;
    }

    public function totalTime(): ?string
    {
        $totalTime = 0;
        $taskTimers = $this->taskTimers();

        if ($taskTimers->isEmpty()) {
            return null;
        }

        foreach ($taskTimers as $taskTimer) {
            $time = $taskTimer->elapsedTime();
            $parts = explode(":", $time);
            $totalTime += $parts[2] + $parts[1]*60 + $parts[0]*3600;
        }

        return gmdate("H:i:s", $totalTime);
    }


}
