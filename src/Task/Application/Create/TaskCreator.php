<?php

declare(strict_types = 1);

namespace TimeTracker\Task\Application\Create;

use TimeTracker\Task\Domain\Task;
use TimeTracker\Task\Domain\TaskRepository;
use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskName;

class TaskCreator
{
    private $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(TaskId $id, TaskName $name)
    {
        $task = Task::create($id, $name);
        $this->repository->save($task);
    }
}
