<?php


namespace TimeTracker\Task\Application\Getter;


use TimeTracker\Task\Domain\TaskTime;

class TaskTimeResponseConverter
{
    public function __invoke(TaskTime $taskTime): TaskTimeResponse
    {
        return new TaskTimeResponse(
            $taskTime->id()->value(),
            $taskTime->taskId()->value(),
            $taskTime->dateTime()->value(),
            $taskTime->startTime()->value(),
            $taskTime->endTime()->value(),
            $taskTime->status(),
            $taskTime->elapsedTime()
        );
    }
}
