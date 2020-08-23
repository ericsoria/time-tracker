<?php


namespace TimeTracker\Task\Application\Getter;


use TimeTracker\Task\Domain\Task;


class TaskResponseConverter
{
    public function __invoke(Task $task): TaskResponse
    {
        return new TaskResponse(
            $task->id()->value(),
            $task->name()->value(),
            $task->dateTime()->value(),
            $task->taskTimers()->map( function($taskTime) {
               return (new TaskTimeResponseConverter())->__invoke($taskTime);
            }),
            $task->totalTime(),
        );
    }
}
