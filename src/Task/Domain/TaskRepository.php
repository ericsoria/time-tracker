<?php

declare(strict_types = 1);

namespace TimeTracker\Task\Domain;

use TimeTracker\Task\Domain\ValueObjects\TaskId;

interface TaskRepository
{
    public function save(Task $task): void;
    public function all(): Tasks;
    public function find(TaskId $taskId): ?Task;
}
