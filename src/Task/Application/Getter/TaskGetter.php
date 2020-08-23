<?php


namespace TimeTracker\Task\Application\Getter;

use TimeTracker\Task\Domain\TaskRepository;
use TimeTracker\Task\Domain\Tasks;

class TaskGetter
{
    private TaskRepository $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $tasks = $this->repository->all();
        $response = [];
        foreach ($tasks as $task) {
            $response[] = (new TaskResponseConverter())->__invoke($task);
        }
        return collect($response);

    }
}
