<?php

declare(strict_types = 1);

namespace TimeTracker\Task\Domain;

use TimeTracker\Task\Domain\ValueObjects\EndTime;
use TimeTracker\Task\Domain\ValueObjects\StartTime;
use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskStatus;
use TimeTracker\Task\Domain\ValueObjects\TaskTimeId;

class TaskTime
{

    private TaskTimeId $id;
    private TaskId $taskId;
    private StartTime $startTime;
    private EndTime $endTime;
    private TaskStatus $status;

    public function __construct(TaskTimeId $id, TaskId $taskId, StartTime $startTime, EndTime $endTime, TaskStatus $status)
    {
        $this->id        = $id;
        $this->taskId    = $taskId;
        $this->startTime = $startTime;
        $this->endTime   = $endTime;
        $this->status    = $status;
    }

    public function id(): TaskTimeId
    {
        return $this->id;
    }

    public function taskId(): TaskId
    {
        return $this->taskId;
    }

    public function startTime(): StartTime
    {
        return $this->startTime;
    }

    public function endTime(): EndTime
    {
        return $this->endTime;
    }

    public function status(): TaskStatus
    {
        return $this->status;
    }

    public function toArray()
    {
        return [
            'id' => $this->id()->value(),
            'taskId' => $this->taskId()->value(),
            'startTime' => $this->startTime()->value(),
            'endTime' => $this->endTime()->value(),
            'status' => $this->status()->value()
        ];
    }

}
