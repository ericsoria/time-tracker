<?php

declare(strict_types = 1);

namespace TimeTracker\Task\Domain;

use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskName;

interface TaskRepository
{
    public function save(Task $task): void;
    public function all(): Tasks;
    public function find(TaskId $taskId): ?Task;
    public function byName(TaskName $taskName): ?Task;
}
