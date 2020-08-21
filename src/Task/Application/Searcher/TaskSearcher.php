<?php

declare(strict_types = 1);

namespace TimeTracker\Task\Application\Searcher;

use TimeTracker\Task\Domain\Task;
use TimeTracker\Task\Domain\TaskRepository;
use TimeTracker\Task\Domain\ValueObjects\TaskName;

class TaskSearcher
{
    private TaskRepository $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(TaskName $name): ?Task
    {
        return $this->repository->byName($name);
    }
}
