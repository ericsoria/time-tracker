<?php

declare(strict_types = 1);

namespace TimeTracker\Task\Application\Create;

use Illuminate\Support\Str;
use TimeTracker\Task\Application\Searcher\TaskSearcher;
use TimeTracker\Task\Domain\Task;
use TimeTracker\Task\Domain\TaskRepository;
use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskName;
use TimeTracker\Task\Domain\ValueObjects\TaskTimeId;

class TaskCreator
{
    private TaskRepository $repository;
    private TaskSearcher $taskSearcher;
    private TaskTimeCreator $taskTimeCreator;

    public function __construct(
        TaskRepository $repository,
        TaskSearcher $taskSearcher,
        TaskTimeCreator $taskTimeCreator
    )
    {
        $this->repository = $repository;
        $this->taskSearcher = $taskSearcher;
        $this->taskTimeCreator = $taskTimeCreator;
    }

    public function create(TaskId $id, TaskName $name)
    {
        $task = $this->taskSearcher->__invoke($name);

        dd($task);

        if (is_null($task)) {
            $task = Task::create($id, $name);
            $this->repository->save($task);
        }

        $this->taskTimeCreator
            ->create(
                new TaskTimeId(Str::uuid()->toString()),
                $task->id()
            );

    }
}
