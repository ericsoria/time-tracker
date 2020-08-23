<?php

declare(strict_types = 1);

namespace TimeTracker\Task\Application\Terminator;

use TimeTracker\Task\Application\Finder\TaskFinder;
use TimeTracker\Task\Domain\TaskTimeRepository;
use TimeTracker\Task\Domain\ValueObjects\TaskId;

class TaskTerminator
{
    private taskFinder $taskFinder;
    private TaskTimeRepository $taskTimeRepository;

    public function __construct(TaskFinder $taskFinder, TaskTimeRepository $taskTimeRepository)
    {
        $this->taskFinder = $taskFinder;
        $this->taskTimeRepository = $taskTimeRepository;
    }

    public function __invoke(TaskId $taskId)
    {
        $task = $this->taskFinder->__invoke($taskId);

        foreach ($task->taskTimers() as $taskTimer) {
            if ($taskTimer->isRunning()) {
                $this->taskTimeRepository->stop($taskTimer);
            }
        }
    }
}
