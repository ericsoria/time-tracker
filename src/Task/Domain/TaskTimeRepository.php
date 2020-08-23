<?php

declare(strict_types = 1);

namespace TimeTracker\Task\Domain;

use TimeTracker\Task\Domain\ValueObjects\TaskId;

interface TaskTimeRepository
{
    public function save(TaskTime $taskTime): void;
    public function findByTaskId(TaskId $taskId): TaskTimers;
    public function stop(TaskTime $taskTime): void;
}
