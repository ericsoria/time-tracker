<?php

namespace TimeTracker\Task\Application\Finder;

use TimeTracker\Task\Domain\TaskTimeRepository;

class TaskTimeFinder
{
    private TaskTimeRepository $repository;

    public function __construct(TaskTimeRepository $repository)
     {

         $this->repository = $repository;
     }

     public function __invoke($taskId)
     {
         return $this->repository->findByTaskId($taskId);
     }
}
