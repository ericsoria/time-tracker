<?php


namespace TimeTracker\Task\Application\Getter;


use TimeTracker\Task\Domain\TaskRepository;
use TimeTracker\Task\Domain\Tasks;

class TaskGetter
{
    private $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke() : Tasks
    {
        return $this->repository->all();
    }
}
