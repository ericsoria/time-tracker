<?php

declare(strict_types = 1);

namespace TimeTracker\Task\Application\Finder;

use TimeTracker\Task\Domain\Task;
use TimeTracker\Task\Domain\TaskRepository;
use TimeTracker\Task\Domain\ValueObjects\TaskId;

class TaskFinder
{
    private $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(TaskId $id): Task
    {
        $task = $this->repository->find($id);

        if (null === $task) {
            throw new \Exception('Task doesn\'t exist');
        }

        return $task;
    }
}
