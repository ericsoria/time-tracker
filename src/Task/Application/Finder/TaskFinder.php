<?php

declare(strict_types = 1);

namespace TimeTracker\Task\Application\Finder;

use TimeTracker\Task\Domain\Task;
use TimeTracker\Task\Domain\TaskRepository;
use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskName;

class TaskFinder
{
    private $repository;

    public function __construct(TaskRepository $repository, TaskFinderDomain $finder)
    {
        $this->repository = $repository;
    }

    public function find(TaskId $id)
    {

    }
}
