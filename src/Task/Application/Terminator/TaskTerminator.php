<?php

declare(strict_types = 1);

namespace TimeTracker\Task\Application\Terminator;

use TimeTracker\Task\Application\Searcher\TaskSearcher;
use TimeTracker\Task\Domain\TaskTimeRepository;
use TimeTracker\Task\Domain\ValueObjects\TaskName;

class TaskTerminator
{
    private TaskSearcher $taskSearcher;
    private TaskTimeRepository $taskTimeRepository;

    public function __construct(TaskSearcher $taskSearcher, TaskTimeRepository $taskTimeRepository)
    {
        $this->taskSearcher = $taskSearcher;
        $this->taskTimeRepository = $taskTimeRepository;
    }

    public function __invoke(TaskName $taskName)
    {
        $task = $this->taskSearcher->__invoke($taskName);

        if (null === $task) {
           throw new \Exception('The task name doesn\'t match today, please start a new task');
        }

        foreach ($task->taskTimers() as $taskTimer) {
            if ($taskTimer->isRunning()) {
                $this->taskTimeRepository->stop($taskTimer);
            }
        }
    }
}
