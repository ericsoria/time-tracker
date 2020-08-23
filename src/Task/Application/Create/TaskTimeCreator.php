<?php

declare(strict_types = 1);

namespace TimeTracker\Task\Application\Create;

use DateTime;
use TimeTracker\Task\Application\Finder\TaskFinder;
use TimeTracker\Task\Domain\TaskTime;
use TimeTracker\Task\Domain\TaskTimeRepository;
use TimeTracker\Task\Domain\ValueObjects\EndTime;
use TimeTracker\Task\Domain\ValueObjects\StartTime;
use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskStatus;
use TimeTracker\Task\Domain\ValueObjects\TaskTimeId;
use TimeTracker\Task\Domain\ValueObjects\DateTime as DomainDateTime;

class TaskTimeCreator
{
    private TaskTimeRepository $repository;
    private TaskFinder $taskFinder;

    public function __construct(TaskTimeRepository $repository, TaskFinder $taskFinder)
    {
        $this->repository = $repository;
        $this->taskFinder = $taskFinder;
    }

    public function create(TaskTimeId $id, TaskId $taskId)
    {
        $this->taskFinder->__invoke($taskId);

        $now = new DateTime();

        $taskTime = new TaskTime(
            $id,
            $taskId,
            new DomainDateTime($now->format('Y-m-d H:i:s')),
            new StartTime($now->format('Y-m-d H:i:s')),
            new EndTime(null),
            new TaskStatus('running')
        );

        $this->repository->save($taskTime);
    }
}
